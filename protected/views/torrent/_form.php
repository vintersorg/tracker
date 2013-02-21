<?php
/* @var $this TorrentsController */
/* @var $model Torrents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torrentFirst-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nameRu'); ?>
		<?php echo $form->textField($model,'nameRu'); ?>
		<?php echo $form->error($model,'nameRu'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'nameOrigin'); ?>
		<?php echo $form->textField($model,'nameOrigin'); ?>
		<?php echo $form->error($model,'nameOrigin'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton('Проверить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->