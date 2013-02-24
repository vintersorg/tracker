<?php


$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Новая раздача',
);
?>

<h1>Название</h1>

<?php echo $this->renderPartial('_edit', array(
	'model'=>$model,
	//'torrentModel'	=> $torrentModel,
)); ?>
