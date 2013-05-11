<?php
$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	$category,
);
$this->page = true;
?>
<?php $this->widget('bootstrap.widgets.TbBox', array(
    'title' => 'Новые',
    'headerIcon' => 'icon-plus',
    'content' => $this->renderPartial('list', array('dataProvider'=> $torrents), true),
)); ?>