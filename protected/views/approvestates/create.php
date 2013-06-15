<?php
/* @var $this ApprovestatesController */
/* @var $model Approvestates */

$this->breadcrumbs=array(
	'Approvestates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Approvestates', 'url'=>array('index')),
	array('label'=>'Manage Approvestates', 'url'=>array('admin')),
);
?>

<h1>Create Approvestates</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>