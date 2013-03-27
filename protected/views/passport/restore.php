<?php

$this->pageTitle=Yii::app()->name . ' - Восстановление пароля';
$this->breadcrumbs=array(
	'Мой профиль' => array('/passport/restore'),
	'Восстановление пароля',
);
$this->menu=array(
	array('label'=>'Действия'),
	array('label'=>'Войти', 'icon'=>'user', 'url'=>'login'),
	array('label'=>'Регистрация', 'icon'=>'edit', 'url'=>'register'),
);
?>
<h1>Восстановление пароля</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'restore-form',
	'htmlOptions'=>array('class'=>'well span5'),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	
	<p class="note">На указанный Email будет выслано письмо с новым паролем.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php echo FlashDesigner::flashSummary();?>
	
	<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?> <br>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Отправить')); ?>
		
<?php $this->endWidget(); ?>
