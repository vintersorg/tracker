<?php

$this->pageTitle=Yii::app()->name . ' - Редактирование профиля';
$this->breadcrumbs=array(
	'Мой профиль' => array('/passport/register'),
	'Регистрация',
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
	
	<p><? echo CHtml::link('Восстановить пароль', array('passport/restore'))?></p>


<?php $this->endWidget(); ?>


