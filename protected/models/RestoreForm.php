<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RestoreForm extends CFormModel
{
	public $email;
	private $user_id;

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
		$this->user_id = $user->id;
		
		if(empty($user->email))				
			return false;
		else
			return true;
	}
	public function sendRestoreEmail()
	{
		
		$url = 'http://'.Yii::app()->params['officialAppName'].'/passport/reset?id='.$this->user_id.'&code='.$this->getRestoreCode();
		
		$message = new YiiMailMessage;
		$message->setBody(
			'Для восстановления пароля пройдите по ссылке <a href="'.$url.'">пустая ссылка</a><br>'
			.'Cсылка действительна до конца суток.<br>'
			.'--<br>'
			.'С уважением администрация<br>'
			.'<a href="http://'.Yii::app()->params['officialAppName'].'">'.Yii::app()->params['oficialAppName'].'</a>', 'text/html');
		$message->subject = 'Восстановления пароля '.Yii::app()->params['oficialAppName'];
		$message->addTo($this->email);
		$message->from = Yii::app()->params['registerMail'];
		Yii::app()->mail->send($message);
	}
	public function getRestoreCode()
	{
		//пока так...
		$code = '';
		$salt = md5(date("Ymd"));
		$code = md5($this->user_id.date("Ymd").$salt);
		
		return $code;
	}
}