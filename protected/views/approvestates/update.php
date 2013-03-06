<?php
/* @var $this ApprovestatesController */
/* @var $model Approvestates */

$this->breadcrumbs=array(
	'Approvestates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Approvestates', 'url'=>array('index')),
	array('label'=>'Create Approvestates', 'url'=>array('create')),
	array('label'=>'View Approvestates', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Approvestates', 'url'=>array('admin')),
);
?>

<h1>Update Approvestates <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>