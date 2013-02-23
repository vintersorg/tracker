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
		<?php echo $form->labelEx($model,'nameLocal'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'nameLocal',
		    'source'=>array_values($nameLocal),
		    'model' => $model,
		    'attribute' => 'nameLocal',
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'nameLocal'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'nameOrigin'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'nameOrigin',
		    'source'=>array_values($nameOrigin),
		    'model' => $model,
		    'attribute' => 'nameOrigin',
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'nameOrigin'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'year'); ?>	
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'year',
		    'source'=>array_values($year),
		    'model' => $model,
		    'attribute' => 'year',
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'year'); ?>
	</div>		
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Проверить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->