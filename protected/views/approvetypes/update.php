<?php
/* @var $this ApprovetypesController */
/* @var $model Approvetypes */

$this->breadcrumbs=array(
	'Approvetypes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Approvetypes', 'url'=>array('index')),
	array('label'=>'Create Approvetypes', 'url'=>array('create')),
	array('label'=>'View Approvetypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Approvetypes', 'url'=>array('admin')),
);
?>

<h1>Update Approvetypes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>