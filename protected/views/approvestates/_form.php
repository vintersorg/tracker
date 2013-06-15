<?php
/* @var $this ApprovestatesController */
/* @var $model Approvestates */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'approvestates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'caption'); ?>
		<?php echo $form->textField($model,'caption',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'caption'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_dt'); ?>
		<?php echo $form->textField($model,'created_dt'); ?>
		<?php echo $form->error($model,'created_dt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->