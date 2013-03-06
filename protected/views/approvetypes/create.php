<?php
/* @var $this ApprovetypesController */
/* @var $model Approvetypes */

$this->breadcrumbs=array(
	'Approvetypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Approvetypes', 'url'=>array('index')),
	array('label'=>'Manage Approvetypes', 'url'=>array('admin')),
);
?>

<h1>Create Approvetypes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>