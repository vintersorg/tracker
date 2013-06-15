<?php
/* @var $this ApprovetypesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Approvetypes',
);

$this->menu=array(
	array('label'=>'Create Approvetypes', 'url'=>array('create')),
	array('label'=>'Manage Approvetypes', 'url'=>array('admin')),
);
?>

<h1>Approvetypes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
