<?php

$this->pageTitle=Yii::app()->name . ' - Просмотр профиля';
$this->breadcrumbs=array(
	'Паспорт' => array('/passport/view', 'id'=> $model->id),
	'Просмотр',
);
$this->menu=array(
	array('label'=>'Действия'),
	array('label'=>'Редактирование', 'icon'=>'cog', 'url'=>array('edit', 'id' => $model->id)),
);
$this->page = true;
?>
<!--h1>Просмотр профиля</h1-->

<div class="span8">
	<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	    'data'=>$model,
	    'attributes'=>array(
	        array('name'=>'username'),
	        array('name'=>'gendername'),
	        array('name'=>'birthday'),
	        array('name'=>'description'),
	    ),
	)); ?>
</div>