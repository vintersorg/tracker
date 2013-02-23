<?php
/* @var $this TagcategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tagcategories',
);

$this->menu=array(
	array('label'=>'Create Tagcategories', 'url'=>array('create')),
	array('label'=>'Manage Tagcategories', 'url'=>array('admin')),
);
?>

<h1>Tagcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
