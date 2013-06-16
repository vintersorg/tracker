<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 
	private $_id;
    public function authenticate()
    {
        $record=Users::model()->findByAttributes(array($this->getFieldName($this->username)=>$this->username, 'identity'=>null));
        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==crypt($this->password,$record->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$record->id;
			//сохраняем данные о пользователе
            $this->setState('name', $record->username);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
	
	public function getFieldName($str)
    {
    	$email = new CEmailValidator;
    	$valid = $email->validateValue($str);	
		if($valid)
			return 'email';
		else
			return 'username';
    }
}