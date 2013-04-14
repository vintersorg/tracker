<?php


$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Новая раздача',
);
$this->page = true;
?>

<?php echo $this->renderPartial('_edit', array(
	'model'=>$model,
	//'torrentModel'	=> $torrentModel,
)); ?>
