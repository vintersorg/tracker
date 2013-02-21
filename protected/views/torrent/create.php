<?php
/* @var $this TorrentsController */
/* @var $model Torrents */

$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Новая раздача',
);
?>

<h1>Новая раздача</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
