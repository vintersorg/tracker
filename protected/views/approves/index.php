<?php
/* @var $this ApprovesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Approves',
);

$this->menu=array(
	array('label'=>'Create Approves', 'url'=>array('create')),
	array('label'=>'Manage Approves', 'url'=>array('admin')),
);
?>

<h1>Approves</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
