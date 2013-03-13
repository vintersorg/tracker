<?php
/* @var $this TorrentsController */
/* @var $model Torrents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torrentEdit-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Перейти к раздаче'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->