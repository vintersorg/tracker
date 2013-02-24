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
		<?php echo $form->labelEx($model,'country'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'country',
		    'source'=>array_values($country),
		    'model' => $model,
		    'attribute' => 'country',
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'country'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'actors'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'actors',
		    'source'=>array_values($actors),
		    'model' => $model,
		    'attribute' => 'actors',
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'actors'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'producer'); ?>	
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'producer',
		    'source'=>array_values($producer),
		    'model' => $model,
		    'attribute' => 'producer',
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'producer'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'description'); ?>	
		<?php echo $form->textArea($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>		
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->