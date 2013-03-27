<?php


$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Special',
);
$this->page = true;
?>

<?php echo $this->renderPartial('_special', array(
	'model'=>$model,
)); ?>