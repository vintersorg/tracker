<?php


$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Новая раздача',
);
?>

<h1>Название</h1>

<?php $country		= CHtml::listData($country, 'id', 'caption');?>
<?php $actors		= CHtml::listData($actors, 'id', 'caption');?>
<?php $producer		= CHtml::listData($producer, 'id', 'caption');?>

<?php echo $this->renderPartial('_edit', array(
	'model'=>$model,
	'country'=> $country,
	'actors'=> $actors,
	'producer'=>$producer,
)); ?>
