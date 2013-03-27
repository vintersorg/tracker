<?php
/* @var $this TorrentsController */
/* @var $model Torrents */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'torrentFirst-form',
	'htmlOptions'=>array('class'=>'well span8'),
)); ?>
	<?php echo $form->errorSummary($model); ?>
	
	<p class="note">Введите данные чтобы проверить наличие такой раздачи.</p>
	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
	    'type' => 'inverse',
	    'toggle' => 'radio', // 'checkbox' or 'radio'
	    'buttons' => Func::arrayToButton(Tags::model()->getTagsByAlias('category'), 'category'),
	    'htmlOptions'=>array('style'=>'padding-bottom: 8px;',),
	)); ?>
	
	<?php echo CHtml::activeHiddenField($model, 'category');?>
	
	<?php echo $form->error($model,'category'); ?>
	
	<?php echo $form->labelEx($model,'nameLocal'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
	    'name'=>'nameLocal',
	    'attribute'=>'nameLocal',
	    'source'=> array_values(Tags::model()->getTagsByAlias('nameLocal')),
	    'model' => $model,
	    'htmlOptions'=>array('class'=>'span5',),
	));?>
	<?php echo $form->error($model,'nameLocal'); ?>

    <?php echo $form->labelEx($model,'nameOrigin'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
	    'name'=>'nameOrigin',
	    'attribute'=>'nameOrigin',
	    'source'=> array_values(Tags::model()->getTagsByAlias('nameOrigin')),
	    'model' => $model,
	    'htmlOptions'=>array('class'=>'span5',),
	));?>
	<?php echo $form->error($model,'nameOrigin'); ?>

	<?php echo $form->labelEx($model,'year'); ?>	
	<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
	    'name'=>'year',
	    'attribute'=>'year',
	    'source'=> array_values(Tags::model()->getTagsByAlias('year')),
	    'model' => $model,
	    'htmlOptions'=>array('class'=>'span5',),
	));?>
	<?php echo $form->error($model,'year'); ?>
	<br>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Проверить')); ?>

<?php $this->endWidget(); ?>