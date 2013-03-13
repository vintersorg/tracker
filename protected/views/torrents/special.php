<?php


$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Special',
);
?>

<h1>Special</h1>

<?php echo $this->renderPartial('_special', array(
	'model'=>$model,
)); ?>