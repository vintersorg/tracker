<?php
/* @var $this TagcategoriesController */
/* @var $model Tagcategories */

$this->breadcrumbs=array(
	'Tagcategories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Tagcategories', 'url'=>array('index')),
	array('label'=>'Create Tagcategories', 'url'=>array('create')),
	array('label'=>'Update Tagcategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tagcategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tagcategories', 'url'=>array('admin')),
);
?>

<h1>View Tagcategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'caption',
		'description',
		'approve_id',
	),
)); ?>
