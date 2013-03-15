<?php

$this->pageTitle=Yii::app()->name . ' - Восстановление пароля';
$this->breadcrumbs=array(
	'Мой профиль' => array('/passport/restore'),
	'Восстановление пароля',
);
?>
<h1>Восстановление пароля</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'restore-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	
	<p class="note">На указанный Email будет выслано письмо с новым паролем.</p>
	
	<?php echo $form->errorSummary($model); ?>
	<?php echo FlashDesigner::flashSummary();?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->