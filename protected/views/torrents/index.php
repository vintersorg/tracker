<?php
/* @var $this TorrentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Torrents',
);

$this->menu=array(
	array('label'=>'Create Torrents', 'url'=>array('create')),
	array('label'=>'Manage Torrents', 'url'=>array('admin')),
);
?>

<h1>Torrents</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
