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

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'attribute'=>'country',
		    'source'=> array_values(Tags::model()->getTagsByAlias('country')),
		    'model' => $model,
		    'value' => $model->country,
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'country'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'actor'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'attribute'=>'actor',
		    'source'=> array_values(Tags::model()->getTagsByAlias('actor')),
		    'model' => $model,
		    'value' => $model->actor,
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'actor'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'producer'); ?>	
		<?php $form->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'attribute'=>'producer',
		    'source'=> array_values(Tags::model()->getTagsByAlias('producer')),
		    'model' => $model,
		    'value' => $model->producer,
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