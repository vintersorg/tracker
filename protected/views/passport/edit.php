<?php

$this->pageTitle=Yii::app()->name . ' - Редактирование профиля';
$this->breadcrumbs=array(
	'Паспорт' => array('/passport/view', 'id'=> $model->id),
	'Редактирование',
);
$this->menu=array(
	array('label'=>'Действия'),
	array('label'=>'Просмотр', 'icon'=>'eye-open', 'url'=>array('view', 'id' => $model->id)),
);
?>
<h1>Редактирование профиля</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'register-form',
	'htmlOptions'=>array('class'=>'well span3'),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>
	<?php echo FlashDesigner::flashSummary();?>

	<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3')); ?>
	<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?>
	<?php echo $form->dropDownListRow($model, 'gender',	Data::$genders, array('class'=>'span3')); ?>	
	
	
	<?php echo $form->labelEx($model,'birthday'); ?>
	<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
	    'model' => $model,
	    'attribute'=>'birthday',
	    'value'=>$model->birthday,
	    // additional javascript options for the date picker plugin
	    'options'=>array(
			'changeMonth' => true,
			'changeYear' => true,
			'yearRange'=>'-100:+0',
	        'showAnim'=>'fold',
	        'showButtonPanel'=>true,
			'autoSize'=>true,
	        'dateFormat'=>'yy-mm-dd',
	        'defaultDate'=>$model->birthday,
	    ),
	    'language' => 'ru',
	    'htmlOptions'=>array('class'=>'span3'),
	));?>
	<?php echo $form->error($model,'birthday'); ?>
	
	<?php echo $form->textAreaRow($model,'description', array('class'=>'span3', 'rows'=>3)); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Сохранить')); ?>


<?php $this->endWidget(); ?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'passportedit-form',
	'htmlOptions'=>array('class'=>'well span3'),
)); ?>
	<p class="note">Поменять пароль</p>
	<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
		
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Сохранить')); ?>



<?php $this->endWidget(); ?>
