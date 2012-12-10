<?php

Yii::import("application.components.db.ar.ActiveRecord");
Yii::import("application.components.db.ar.EmailableRecord");
Yii::import("application.components.db.ar.LoggableRecord");

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property string $groupId
 * @property string $creatorId
 * @property string $model
 * @property string $modelId
 * @property string $content
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property Group $group
 * @property User $creator
 */
class TaskComment extends Comment implements EmailableRecord, LoggableRecord
{
	const MODELTYPE = 'Task';
	
    /**
     * Returns the static model of the specified AR class.
     * @return TaskComment the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array behaviors that this model should behave as
    */
    public function behaviors() {
    	$behaviors = parent::behaviors();
    	$behaviors = CMap::mergeArray($behaviors, array(
    		// Add new behaviors here
            'ActiveRecordLogBehavior'=>array(
                'class' => 'ext.behaviors.ActiveRecordLogBehavior',
                'scenarios' => array(
                    self::SCENARIO_INSERT => array(),
                ),
            ),
            'EmailNotificationBehavior'=>array(
                'class' => 'ext.behaviors.model.EmailNotificationBehavior',
                //flag to enable or disable notification emails for EmailNotificationBehavior
                'enabled' => Yii::app()->params['emailNotificationsOn'],
                'ignoreAttributes' => array('modified'),
            ),
    	));
    	return $behaviors;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
    	$rules = parent::rules();
        $rules = CMap::mergeArray($rules, array(
    		// Add new rules here
    	));
    	return $rules;
    }
    
    /**
     * Ensure model is set to 'Task'
     * @see ActiveRecord::beforeValidate()
     */
    public function beforeValidate() {
    	if(parent::beforeValidate()) {
    		$this->model = self::MODELTYPE;
    		
    		return true;
    	}
    	return false;
    }
    
    // public function defaultScope() {
    // 	return array(
    // 		'model' => self::MODELTYPE,
    // 	);
    // }
    
    /**
     * Set the TaskComment's Task
     * @param Task $task
     */
    public function setTask(Task $task) {
    	$this->modelId = $task->id;
    	$this->groupId = $task->groupId;
    }

    /**
     * @see LoggableRecord
     **/
    public function getFocalModelClassForLog() {
        return get_class($this->modelObject);
    }

    /**
     * @see LoggableRecord
     **/
    public function getFocalModelIdForLog() {
        return $this->modelObject->primaryKey;
    }

    /**
     * @see LoggableRecord
     **/
    public function getFocalModelNameForLog() {
        return $this->modelObject->name;
    }

    public function getEmailName() {
        return $this->modelObject->name;
    }
}