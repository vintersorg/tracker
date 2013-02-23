<?php


$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Новая раздача',
);
?>

<h1>Название</h1>

<?php $nameLocal	= CHtml::listData($nameLocal, 'id', 'caption');?>
<?php $nameOrigin	= CHtml::listData($nameOrigin, 'id', 'caption');?>
<?php $year			= CHtml::listData($year, 'id', 'caption');?>

<?php echo $this->renderPartial('_edit', array(
	'model'=>$model,
	'nameLocal' => $nameLocal,
	'nameOrigin' => $nameOrigin,
	'year' => $year,
)); ?>
