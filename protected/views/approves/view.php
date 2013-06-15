<?php
/* @var $this ApprovesController */
/* @var $model Approves */

$this->breadcrumbs=array(
	'Approves'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Approves', 'url'=>array('index')),
	array('label'=>'Create Approves', 'url'=>array('create')),
	array('label'=>'Update Approves', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Approves', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Approves', 'url'=>array('admin')),
);
?>

<h1>View Approves #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_dt',
		'created_by',
		'state_id',
		'type_id',
	),
)); ?>
