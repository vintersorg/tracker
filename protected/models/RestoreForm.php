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
	public function sendRestoreEmail()
	{
		$message = new YiiMailMessage;
		$message->setBody(
			'Для восстановления пароля пройдите по ссылке <a href="#">пустая ссылка</a><br>'
			.'--<br>'
			.'С уважением администрация<br>'
			.'<a href="http://'.Yii::app()->params['officialAppName'].'">'.Yii::app()->params['oficialAppName'].'</a>', 'text/html');
		$message->subject = 'Восстановления пароля '.Yii::app()->params['oficialAppName'];
		$message->addTo($this->email);
		$message->from = Yii::app()->params['registerMail'];
		Yii::app()->mail->send($message);
	}
}