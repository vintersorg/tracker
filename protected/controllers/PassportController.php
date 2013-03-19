<?php

class PassportController extends RController {
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	private $message;
	/*
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'view' actions
				'actions'=>array('restore', 'register', 'login'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'view' actions
				'actions'=>array('index','logout','edit','view'),
				'users'=>array('@'),
				//'roles'=>array('Developer'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/*
	public function allowedActions() {
		return 'index';
	}*/
	public function filters()
	{
		return array(
			//'rights',
			'accessControl',
		);
	}
	
	public function actionIndex(){
		
		$this->render('index');
	}
	public function actionRestore()
	{
		$model = new RestoreForm;
		
		if(isset($_POST['RestoreForm']))
		{
			$model->attributes=$_POST['RestoreForm'];
			if($model->validate() && $model->checkEmail())
			{
				$model->sendRestoreEmail();
				Yii::app()->user->setFlash('success', "Сообщение отправлено!");
			}else{
				$model->addError('email', 'Введен не корректный Email');			
				
			}	
		}
		$this->render('restore', array(
			'model' => $model
		));
		
	}
	public function actionEdit($id){
		/*
		if(Yii::app()->user->id != $id)
		{
			Yii::app()->user->checkAccess('Admin');
		}
		 * */
		$model = $this->loadModel($id);
		
		if(isset($_POST['Users']))
		{
			$post = $_POST['Users'];
			if(!empty($_POST['Users']['password']))
			{
				$post['password'] = crypt($post['password'],$post['password']);
			}
			$model->attributes = $post;
			
			if($model->save())
				$this->redirect(array('edit'));
		}
		
		$this->render('edit', array(
			'model'=>$model
		));
	}
	public function actionView($id){

		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionRegister(){

		$model = new Users;
		
		if(isset($_POST['Users']))
		{
			
			$post = $_POST['Users'];
			$post['openpassword'] = $post['password'];
			
			//дефолтные значения при регистрации юзера
			$username			= preg_split('/\@/', $post['email']);
			$post['username']	= $username[0];
			$post['role_id']	= Yii::app()->params['defaultRoleID'];			
			$post['password']	= crypt($post['password'],$post['password']);
			$post['sendEmail']	= 'register';
			
			$model->attributes = $post;
			
			if(!$model->save())
			{
				//если имя пользователя уже занято - добаляем к нему случайное число
				$errors = $model->getErrors();
				if(array_key_exists('username', $errors)){
					
					$post['username'] = $post['username'].date('is');
					$model->attributes = $post;
					if($model->save()){						
						//если регистрация прошла успешно сразу авторизуем пользователя
						$post['password']	= $post['openpassword'];
						//логинимся под новым пользователем
						$this->login($post);											
					}
				}									
			}else{
				$post['password']	= $post['openpassword'];
				//логинимся под новым пользователем
				$this->login($post);
			}
		
		}		
		
		$this->render('register', array(
			'model'=>$model
		));
	}
	public function login($params=array())
	{
		if(empty($params)) $this->redirect(array('register'));
		
		$login=new LoginForm;
		
		$login->attributes	= $params;
						
		// validate user input and redirect to the previous page if valid
		if($login->validate() && $login->login())
		{
			if(isset($params['sendEmail']) && $params['sendEmail'] == "register")
				$login->sendRegisterEmail();
			$this->redirect(array('edit'));
		}
		$this->redirect(array('register'));
	}
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}	
}
