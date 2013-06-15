<?php
/* @var $this ApprovestatesController */
/* @var $model Approvestates */

$this->breadcrumbs=array(
	'Approvestates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Approvestates', 'url'=>array('index')),
	array('label'=>'Create Approvestates', 'url'=>array('create')),
	array('label'=>'Update Approvestates', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Approvestates', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Approvestates', 'url'=>array('admin')),
);
?>

<h1>View Approvestates #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'caption',
		'created_dt',
		'created_by',
	),
)); ?>
