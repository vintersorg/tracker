<?php
/* @var $this TorrentsController */
/* @var $model Torrents */

$this->breadcrumbs=array(
	'Torrents'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Torrents', 'url'=>array('index')),
	array('label'=>'Create Torrents', 'url'=>array('create')),
	array('label'=>'View Torrents', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Torrents', 'url'=>array('admin')),
);
?>

<h1>Update Torrents <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>