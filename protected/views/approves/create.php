<?php
/* @var $this ApprovesController */
/* @var $model Approves */

$this->breadcrumbs=array(
	'Approves'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Approves', 'url'=>array('index')),
	array('label'=>'Manage Approves', 'url'=>array('admin')),
);
?>

<h1>Create Approves</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>