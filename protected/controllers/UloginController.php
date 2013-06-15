<?php

class UloginController extends Controller
{
	public $layout='//layouts/column2';
    public function actionLogin() {

        if (isset($_POST['token'])) {
            $ulogin = new UloginModel();
            $ulogin->setAttributes($_POST);
            $ulogin->getAuthData();
            if ($ulogin->validate() && $ulogin->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }else {
				
                $this->render('error', array('code'=>'501', 'message'=>'Ошибка авторизации'));
            }
        }
        else {

            $this->redirect(Yii::app()->homeUrl, true);
        }
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}