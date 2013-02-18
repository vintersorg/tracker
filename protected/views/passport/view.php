<?php

$this->pageTitle=Yii::app()->name . ' - Просмотр профиля';
$this->breadcrumbs=array(
	'Мой профиль' => array('/passport/index'),
	'Просмотр профиля',
);
$this->menu=array(
	array('label'=>'Редактирование профиля', 'url'=>array('edit')),
);
?>
<h1>Просмотр профиля</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passportedit-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<p class="note"><?php echo $model->username?></p>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php $genders = array(
				1 => 'Мужской',
				2 => 'Женский',
			)?>
		<p class="note"><?php echo (empty($model->gender))?'':$genders[$model->gender]?></p>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<p class="note"><?php echo $model->birthday?></p>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<p class="note"><?php echo $model->description?></p>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->