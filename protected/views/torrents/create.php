<?php
/* @var $this TorrentsController */
/* @var $model Torrents */

$this->breadcrumbs=array(
	'Torrents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Torrents', 'url'=>array('index')),
	array('label'=>'Manage Torrents', 'url'=>array('admin')),
);
?>

<h1>Create Torrents</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>