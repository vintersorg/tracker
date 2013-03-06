<?php
/* @var $this ApprovestatesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Approvestates',
);

$this->menu=array(
	array('label'=>'Create Approvestates', 'url'=>array('create')),
	array('label'=>'Manage Approvestates', 'url'=>array('admin')),
);
?>

<h1>Approvestates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
