<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RestoreForm extends CFormModel
{
	public $email;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email', 'required'),
			array('email', 'email'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'Email',
		);
	}
	public function checkEmail(){
		
		$model = new Users;
		$user = $model->findByAttributes(array(), 'email = :email', array(':email' => $this->email));
		
		if(empty($user->email))				
			return false;
		else
			return true;
	}
	public function sendEmail()
	{
		$this->message = new YiiMailMessage;
		$this->message->setBody('Message content here with HTML', 'text/html');
		$this->message->subject = 'My Subject';
		$this->message->addTo('vintersorg61@gmail.com');
		$this->message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($this->message);
	}
}