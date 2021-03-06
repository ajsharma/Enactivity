<?php

/**
 * ActivityAndTasksForm class.
 * ActivityAndTasksForm is the data structure for constructing
 * an activity and it's tasks.
 */
class ActivityAndTasksForm extends CFormModel
{
	const STARTING_TASK_COUNT = 5; //initial number of tasks to create

	const SCENARIO_DRAFT = 'draft';
	const SCENARIO_PUBLISH = 'publish';
	const SCENARIO_UPDATE = 'update';

	private $_activity;
	private $_tasks = array();

	public function rules() {
		return array(
			array(
				'taskCount',
				'numerical',
				'min' => 1,
				'integerOnly'=>true,
				'tooSmall'=>"Activities must have at least one task."
			),
		);
	}

	public function init() {
		$this->activity = new Activity();
		$this->addNewTasks(self::STARTING_TASK_COUNT);
	}

	public function getModels() {
		$models = array($this, $this->activity);
		return array_merge($models, $this->tasks);
	}

	public function getActivity() {
		return $this->_activity;
	}

	public function setActivity($activity) {
		$this->_activity = $activity;
		$this->tasks = $activity->tasks;
	}

	public function getTasks() {
		return $this->_tasks;
	}

	public function setTasks($tasks) {
		$organizedTasks = array();
		
		foreach ($tasks as $task) {
			if(isset($task->id)) {
				$organizedTasks[$task->id] = $task;
			}
			else {
				$organizedTasks[] = $task;
			}
		}

		$this->_tasks = $organizedTasks;
	}

	public function getTaskCount() {
		return sizeof($this->tasks);
	}

	public function addNewTasks($count) {
		for($i = 1; $i <= $count; $i++) {
			$this->addNewTask();
		}
	}

	public function addNewTask() {
		$this->_tasks[] = new Task();
	}

	public function removeTask($index) {
		unset($this->_tasks[$index]);
	}

	/**
	 * Override of CModel::setAttributes
	 * @param array ['activity', 'tasks' ]
	 */
	public function setAttributes($values, $safeOnly = true) {
		$this->activity->attributes = $values['activity'];

		// Load in the new tasks
		foreach($values['tasks'] as $i => $taskAttributes) {
			Yii::trace("Setting attr {$i}: {$taskAttributes['name']}", 'aatf');
			if(!isset($this->_tasks[$i])) {
				$this->_tasks[$i] = new Task();
			}

			$this->_tasks[$i]->attributes = $taskAttributes;
		}

		ksort($this->tasks); // FIXME: Sort by date?
	}

	public function validate() {

		$isValid = true;

		$isValid = $this->activity->validate() && $isValid;

		$this->removeBlankTasks();

		foreach($this->tasks as $id => &$task) {
			Yii::trace("Validating {$i}: {$task->name}", 'aatf');
			$isValid = $task->validate() && $isValid;
		}

		$isValid = parent::validate() && $isValid;

		return $isValid;
	}

	public function draft($activityAttributes = array(), $taskAttributesList = array()) {
		$this->scenario = self::SCENARIO_DRAFT;

		// hacky way to ensure correct activity status
		$this->activity->scenario = Activity::SCENARIO_DRAFT;

		$this->attributes = array(
			'activity' => $activityAttributes,
			'tasks' => $taskAttributesList,
		);

		// Remove the tasks with no attributes
		$this->removeBlankTasks();

		if($this->validate()) {
			$this->activity->draft();

			foreach($this->tasks as $i => &$task) {
				Yii::trace("drafting at {$i}: {$task->name}", 'aatf');
				$task->groupId = $this->activity->groupId;
				$task->activityId = $this->activity->id;
				$task->draft();
			}

			return true;
		}

		return false;
	}

	public function update($activityAttributes = array(), $taskAttributesList = array()) {
		$this->scenario = self::SCENARIO_UPDATE;

		$this->attributes = array(
			'activity' => $activityAttributes,
			'tasks' => $taskAttributesList,
		);

		$isValid = true;

		$isValid = $isValid && $this->activity->updateActivity();

		foreach($this->_tasks as $i => &$task) {

			if($task->isNewRecord) {
				if($task->isBlank) {
					$this->removeTask($i);
				}
				else {
					$task->groupId = $this->activity->groupId;
					$task->activityId = $this->activity->id;

					$isValid = $isValid && $task->publish();
				}
			}
			else {
				$isValid = $isValid && $task->updateTask();
			}
		}

		return $isValid;
	}
	

	public function publish($activityAttributes = array(), $taskAttributesList = array()) {
		if($this->draft($activityAttributes, $taskAttributesList)) {
			$this->scenario = self::SCENARIO_PUBLISH;
			return $this->activity->publish($this->activity->attributes);
		}
		return false;
	}

	public function publishWithoutGroup($activityAttributes = array(), $taskAttributesList = array()) {
		if($this->draft($activityAttributes, $taskAttributesList)) {
			$this->scenario = self::SCENARIO_PUBLISH;
			return $this->activity->publishWithoutGroup($this->activity->attributes);
		}
		return false;
	}

	protected function removeBlankTasks() {
		foreach ($this->tasks as $i => $task) {
			Yii::trace("Checking for blank at {$i}: {$task->name}", 'aatf');
			if($task->isBlank) {
				$this->removeTask($i);
			}
		}
	}
}