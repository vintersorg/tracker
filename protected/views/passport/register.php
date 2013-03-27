<?php

$this->pageTitle=Yii::app()->name . ' - Редактирование профиля';
$this->breadcrumbs=array(
	'Паспорт' => array('/passport/register'),
	'Регистрация',
);
$this->menu=array(
	array('label'=>'Действия'),
	array('label'=>'Войти', 'icon'=>'user', 'url'=>'login'),
	array('label'=>'Восстановление пароля', 'icon'=>'trash', 'url'=>'restore'),
);
?>
<h1>Регистрация</h1>



<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-form',
	'htmlOptions'=>array('class'=>'well span3'),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>
	
    <?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
	<br	>

	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Сохранить')); ?>

<?php $this->endWidget(); ?>


