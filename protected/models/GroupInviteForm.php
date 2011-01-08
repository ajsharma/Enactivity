<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 * @property integer $groupId
 * @property string $emails
 */
class GroupInviteForm extends CFormModel {
	
	/**
	 * @var int
	 */
	public $groupId;
	
	/**
	 * @var string
	 */
	public $emails;
	
/**
	 * @return array behaviors that this model should behave as
	 */
	public function behaviors() {
		return array(
			// Set the groupId automatically when user is in only one group
			'DefaultGroupBehavior'=>array(
				'class' => 'ext.behaviors.DefaultGroupBehavior',
			), 
		);
	}
	
	public function rules() {
		return array(
			array('groupId, emails', 'required'),
			array('groupId', 'validateGroupId'),
			array('emails', 'validateEmails'),
		);
	}
	
	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'groupId'=>'Group',
			'emails'=>'Emails',
		);
	}
	
	/**
	 * Validate that the group id is an existing group
	 * @param string $attribute
	 * @param array $params
	 */
	public function validateGroupId($attribute, $params) {
		if(is_null(Group::model()->findByPk($this->$attribute))) {
			$this->addError($attribute, 'Group must be valid');	
		}
	}
	
	/**
	 * Validate that each email in the emails list is a valid 
	 * email.
	 * @param string $attribute
	 * @param array $params
	 */
	public function validateEmails($attribute, $params) {
		$emails = $this->splitEmails($this->$attribute);
		foreach ($emails as $email) {
			$validator = new CEmailValidator;
			if(!$validator->validateValue($email))
			{
				$this->addError($attribute, $email . ' is not a valid email address.');
			}
		}
	}
	
	/**
	 * Split the emails 
	 * @param string $emails
	 * @param array an array containing substrings
	 */
	public function splitEmails($emails) {
		$uncheckedEmails = preg_split('/[\s,;]+/', trim($emails));
		$checkedEmails = array();
		foreach($uncheckedEmails as $email) {
			if('' != $email) {
				$checkedEmails[] = $email;
			}
		}
		return $checkedEmails;
	}
}