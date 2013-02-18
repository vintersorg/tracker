<?php

$this->pageTitle=Yii::app()->name . ' - Редактирование профиля';
$this->breadcrumbs=array(
	'Мой профиль' => array('/passport/register'),
	'Регистрация',
);
?>
<h1>Регистрация</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>        
        <?php echo $form->passwordField($model, 'password') ?>
        <?php echo $form->error($model,'password'); ?>
	</div>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>
	<p><? echo CHtml::link('Восстановить пароль', array('passport/restore'))?></p>


<?php $this->endWidget(); ?>

</div><!-- form -->