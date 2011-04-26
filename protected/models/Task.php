<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id
 * @property integer $goalId
 * @property string $name
 * @property integer $ownerId
 * @property integer $priority
 * @property integer $isCompleted
 * @property integer $isTrash
 * @property string $starts
 * @property string $ends
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Goal $goal
 * @property User $owner
 * @property UserTask[] $userTasks
 * @property integer $userTasksCount number of users who have signed up for the task 
 * @property integer $userTasksCompletedCount number of users who have signed up for the task and marked it complete
 */
class Task extends CActiveRecord
{
	const NAME_MAX_LENGTH = 255;
	
	const SCENARIO_COMPLETE = 'complete';
	const SCENARIO_DELETE = 'delete';
	const SCENARIO_INSERT = 'insert'; // default set by Yii
	const SCENARIO_NOTCOMPLETE = 'uncomplete';
	const SCENARIO_READ = 'read';
	const SCENARIO_SET_OWNER = 'set ownership';
	const SCENARIO_TRASH = 'trash';
	const SCENARIO_UNSET_OWNER = 'unset ownership';
	const SCENARIO_UNTRASH = 'untrash';
	const SCENARIO_UPDATE = 'update';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Task the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'task';
	}
	
	/**
	 * @return array behaviors that this model should behave as
	 */
	public function behaviors() {
		return array(
			// Update created and modified dates on before save events
			'CTimestampBehavior'=>array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created',
				'updateAttribute' => 'modified',
				'setUpdateOnCreate' => true,
			),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goalId, name, priority, isCompleted, isTrash',
				'required'),
			
			// goal and owner can be any integer > 0
			array('goalId, ownerId',
				'numerical',
				'min' => 0,
				'integerOnly'=>true),
						
			// int >= 0
			array('priority',
				'numerical',
				'min' => 0,
				'integerOnly'=>true),
			
			// boolean ints can be 0 or 1
			array('isCompleted, isTrash',
				'numerical',
				'min' => 0,
				'max' => 1,
				'integerOnly'=>true),
			
			// boolean ints defaults to 0
			array('isCompleted, isTrash',
				'default',
				'value' => 0),
			
			array('name',
				'length', 
				'max'=>self::NAME_MAX_LENGTH),
			
			array('name', 
				'filter', 
				'filter'=>'trim'),
			
			array('starts, ends',
				'safe'),
			
			array('ends',
				'validateDateAfter', 
				'beforeDate'=>'starts'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, goalId, name, ownerId, priority, isCompleted, isTrash, starts, ends, created, modified',
			//	'safe',
			//	'on'=>'search'),
		);
	}

	/**
	 * Validate that the given date comes after the specified
	 * 'beforeDate'
	 * @param string $attribute the attribute to test
	 * @param array $params
	 * @return boolean true if date comes after parameter date, false otherwise
	 */
	public function validateDateAfter($attribute, $params) {
		$ends = $this->$attribute;
		$starts = $this->$params['beforeDate'];
		
		$ends = strtotime($ends);
		$starts = strtotime($starts);
		
		if($ends < $starts) {
			$this->addError($attribute, 'End time cannot be before start time.');
		}
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'goal' => array(self::BELONGS_TO, 'Goal', 'goalId'),
			'owner' => array(self::BELONGS_TO, 'User', 'ownerId'),
			'userTasks' => array(self::HAS_MANY, 'UserTask', 'taskId'),
			'userTasksCount' => array(self::STAT, 'UserTask', 'taskId',
				'condition' => '`t`.`isTrash` = 0',
			),
			'userTasksCompletedCount' => array(self::STAT, 'UserTask', 'taskId',
				'condition' => '`t`.`isCompleted` = 1'
					. ' AND `t`.`isTrash` = 0',
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'goalId' => 'Goal',
			'name' => 'Name',
			'ownerId' => 'Owner',
			'priority' => 'Priority',
			'isCompleted' => 'Is Completed',
			'isTrash' => 'Is Trash',
			'starts' => 'Starts',
			'ends' => 'Ends',
			'created' => 'Created',
			'modified' => 'Modified',
			'userTasks' => 'Participants',
			'userTasksCount' => 'Number of Participants',
			'userTasksCompletedCount' => 'Number of Participants Done',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('goalId',$this->goalId);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('ownerId',$this->ownerId);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('isCompleted',$this->isCompleted);
		$criteria->compare('isTrash',$this->isTrash);
		$criteria->compare('starts',$this->starts,true);
		$criteria->compare('ends',$this->ends,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Check if the current user is participating in the task
	 * and hasn't stopped (deleted the connection)
	 * @return true if user is a participant, false if not
	 */
	public function isUserParticipating() {
		
		$model = UserTask::model()->findByAttributes(
			array(
				'userId'=>Yii::app()->user->id,
				'taskId'=>$this->id,
				'isTrash'=>0,
			)
		);
		
		if(isset($model)) {
			return true;
		}
		return false;
	}
	
	/**
	 * Marks the current user as participating in the task.
	 * Saves UserTask
	 * @return Task
	 */
	public function participate() {
		
		// look for the UserTask for this combination
		$userTask = UserTask::model()->findByAttributes(
			array(
				'userId'=>Yii::app()->user->id,
				'taskId'=>$this->id,
			)
		);

		// if no UserTask linker exists, create one
		if(is_null($userTask)) {
			$userTask = new UserTask();
			$userTask->userId = Yii::app()->user->id;
			$userTask->taskId = $this->id;
		}
		
		$userTask->unTrash();
		
		// save linker 
		$userTask->save();
		
		return $this;
	}
	
/**
	 * Marks the current user as not participating in the task.
	 * Saves UserTask
	 * @return Task
	 */
	public function unparticipate() {
			
		// look for the UserTask for this combination
		$userTask = UserTask::model()->findByAttributes(
			array(
				'userId'=>Yii::app()->user->id,
				'taskId'=>$this->id,
			)
		);

		// if no UserTask linker exists, create one
		if(is_null($userTask)) {
			$userTask = new UserTask();
			$userTask->userId = Yii::app()->user->id;
			$userTask->taskId = $this->id;
		}
		
		$userTask->trash();
		
		// save linker 
		$userTask->save();
		
		return $this;
	}
		
	/**
	 * Mark the task as completed, does not save
	 * @return Task
	 */
	public function complete() {
		$this->isCompleted = 1;
		return $this;
	}
	
	/**
	 * Mark the task as not completed, does not save
	 * @return Task
	 */
	public function uncomplete() {
		$this->isCompleted = 0;
		return $this;
	}
	
	/**
	 * Mark the task as trash, does not save
	 * @return Task
	 */
	public function trash() {
		$this->isTrash = 1;
		return $this;
	}
	
	/**
	 * Mark the task as not trash, does not save
	 * @return Task
	 */
	public function untrash() {
		$this->isTrash = 0;
		return $this;
	}
	
	/**
	 * Make the user as the owner, does not save
	 * @return Task
	 */
	public function own() {
		$this->ownerId = Yii::app()->user->id;
		return $this;
	}
	
	/**
	 * Mark the task as not trash, does not save
	 * @return Task
	 */
	public function unown() {
		$this->ownerId = null;
		return $this;
	}
	
	/**
	 * Set the task to have the highest priority.  Updates
	 * sister tasks to compensate.
	 * @return Task
	 */
	public function setToHighestPriority() {
		// if already highest priority, ignore
		if($this->priority <= 0) {
			return $this;
		}
		
		// start a transaction
		$model = Task::model();
		$transaction=$model->dbConnection->beginTransaction();
		try {
			// find sister tasks with higher priority (lower value)
			$tasks = $model->findAllByAttributes(
				array(
					'goalId' => $this->goalId,
				),
				'priority < :priority',
				array(
					':priority' => $this->priority,
				)
			);
			
			// update each priority
			foreach($tasks as $task) {
				$task->priority++;
				$task->save();
			}
			
			// update this task to have highest priority
			$this->priority = 0;
			$this->save();
			
			$transaction->commit();
		}
		catch(Exception $e) {
		    $transaction->rollBack();
		    throw $e;
		}
		
		return $this;
	}
	
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			
			if($this->isNewRecord)
			{
				// Set priority to be highest in rung
				$this->priority = $this->goal->tasksCount;
			}
			return true;
		}
		return false;
	}
}