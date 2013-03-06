<?php
/* @var $this ApprovetypesController */
/* @var $model Approvetypes */

$this->breadcrumbs=array(
	'Approvetypes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Approvetypes', 'url'=>array('index')),
	array('label'=>'Create Approvetypes', 'url'=>array('create')),
	array('label'=>'Update Approvetypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Approvetypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Approvetypes', 'url'=>array('admin')),
);
?>

<h1>View Approvetypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'role_id',
	),
)); ?>
