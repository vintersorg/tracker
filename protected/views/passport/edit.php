<?php

$this->pageTitle=Yii::app()->name . ' - Редактирование профиля';
$this->breadcrumbs=array(
	'Мой профиль' => array('/passport/index'),
	'Редактирование профиля',
);
$this->menu=array(
	array('label'=>'Просмотр профиля', 'url'=>array('index')),
);
?>
<h1>Редактирование профиля</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passportedit-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo Yii::app()->flashDesigner->flashSummary();?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->dropDownList(
			$model,
			'gender',
			array( 
				null => '',
				1 => 'Мужской',
				2 => 'Женский',
			)		
		); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
		    'model' => $model,
		    'attribute'=>'birthday',
		    'value'=>$model->birthday,
		    // additional javascript options for the date picker plugin
		    'options'=>array(
				'changeMonth' => true,
				'changeYear' => true,
		        'showAnim'=>'fold',
		        'showButtonPanel'=>true,
    			'autoSize'=>true,
		        'dateFormat'=>'yy-mm-dd',
		        'defaultDate'=>$model->birthday,
		    ),
		    'language' => 'ru',
		));?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passportedit-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<p class="note">Поменять пароль</p>
	<div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>        
        <?php echo $form->passwordField($model, 'password', array('value' => '')) ?>
        <?php echo $form->error($model,'password'); ?>
	</div>
		
	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->