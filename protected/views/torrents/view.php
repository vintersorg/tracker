<?php
/* @var $this TorrentsController */
/* @var $model Torrents */

$this->breadcrumbs=array(
	'Torrents'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Torrents', 'url'=>array('index')),
	array('label'=>'Create Torrents', 'url'=>array('create')),
	array('label'=>'Update Torrents', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Torrents', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Torrents', 'url'=>array('admin')),
);
?>

<h1>View Torrents #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'created_dt',
		'created_by',
		'approve_id',
		'description',
	),
)); ?>
