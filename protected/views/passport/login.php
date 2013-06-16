<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Авторизация';
$this->breadcrumbs=array(
	'Авторизация',
);
$this->menu=array(
	array('label'=>'Действия'),
	array('label'=>'Регистрация', 'icon'=>'edit', 'url'=>'register'),
	array('label'=>'Восстановление пароля', 'icon'=>'trash', 'url'=>'restore'),	
);
?>

<!--h1>Авторизация</h1-->

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'htmlOptions'=>array('class'=>'well span6'),
)); ?>
	
	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
	<?php echo $form->checkboxRow($model, 'rememberMe'); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Войти')); ?>
	
	<div style="padding-top: 30px">
		<?php  $this->widget('application.components.UloginWidget', array(
		    'params'=>array(
		    	//Адрес, на который ulogin будет редиректить браузер клиента.
		    	//Он должен соответствовать контроллеру ulogin и действию login
		        'redirect'=>'http://'.$_SERVER['HTTP_HOST'].'/ulogin/login' 
		    )
		)); ?>
	</div>
<?php $this->endWidget(); ?>

