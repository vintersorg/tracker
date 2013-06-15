<?php
/* @var $this TagcategoriesController */
/* @var $model Tagcategories */

$this->breadcrumbs=array(
	'Tagcategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tagcategories', 'url'=>array('index')),
	array('label'=>'Manage Tagcategories', 'url'=>array('admin')),
);
?>

<h1>Create Tagcategories</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>