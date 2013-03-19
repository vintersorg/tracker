<?php
class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть связь role
            return $user->role->caption;
        }
    } 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Users::model()->findByPk($this->id);
        }
        return $this->_model;
    }
	public function checkRole($operation, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getRole();
		
		if ($role === 'Developer') {
            return true; // Developer role has access to everything
        }
		
        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }
	public function checkAccess($operation, $params=array())
    {
    	/*
    	Func::pre(Yii::app()->controller->action->id);
		Func::pre(Yii::app()->controller->id);
		 */
    	if(!$this->checkRole($operation))
			throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
		else 
			return true;
	}
}