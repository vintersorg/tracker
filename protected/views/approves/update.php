<?php
/* @var $this ApprovesController */
/* @var $model Approves */

$this->breadcrumbs=array(
	'Approves'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Approves', 'url'=>array('index')),
	array('label'=>'Create Approves', 'url'=>array('create')),
	array('label'=>'View Approves', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Approves', 'url'=>array('admin')),
);
?>

<h1>Update Approves <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>