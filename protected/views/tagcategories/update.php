<?php
/* @var $this TagcategoriesController */
/* @var $model Tagcategories */

$this->breadcrumbs=array(
	'Tagcategories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tagcategories', 'url'=>array('index')),
	array('label'=>'Create Tagcategories', 'url'=>array('create')),
	array('label'=>'View Tagcategories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tagcategories', 'url'=>array('admin')),
);
?>

<h1>Update Tagcategories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>