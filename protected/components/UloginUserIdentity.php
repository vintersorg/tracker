<?php

class UloginUserIdentity extends CUserIdentity
{

	private $_id;
    private $name;
    private $isAuthenticated = false;
    private $states = array();

    public function __construct()
    {
    }

    public function authenticate($uloginModel = null)
    {

        $criteria = new CDbCriteria;
        $criteria->condition = 'identity=:identity AND network=:network';
        $criteria->params = array(
            ':identity' => $uloginModel->identity,
        	':network' => $uloginModel->network
        );
        $user = Users::model()->find($criteria);
        if (null !== $user) {
			$this->_id=$user->id;
			$this->name = $user->username;
            $this->setState('name', $user->username);
			//сохраняем данные о пользователе
        }
        else {
            $user = new Users();
            $user->identity = $uloginModel->identity;
            $user->network = $uloginModel->network;
            $user->email = $uloginModel->email;
            $user->username = $uloginModel->username;
			$user->role_id = Yii::app()->params['defaultRoleID'];
			$user->password = 'ulogin';
            if(!$user->save()){
            	$this->isAuthenticated = false;
        		return false;
            }

            $this->_id=$user->id;
			$this->name = $user->username;
			//сохраняем данные о пользователе
            $this->setState('name', $user->username);
        }
        $this->isAuthenticated = true;
        return true;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }
	
	public function getName()
    {
        return $this->name;
    }
	
    public function getPersistentStates()
    {
        return $this->states;
    }
}