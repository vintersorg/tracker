<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Авторизация';
$this->breadcrumbs=array(
	'Авторизация',
);

?>

<h1>Авторизация</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

		<?php echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
		<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
		<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
	
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Войти')); ?>
	
	<p><?php echo CHtml::link('Регистрация', array('passport/register')); ?><br>
	<?php echo CHtml::link('Восстановить пароль', array('passport/restore')); ?></p>
	

<?php $this->endWidget(); ?>