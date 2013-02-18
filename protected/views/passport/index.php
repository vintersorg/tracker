<?php

$this->pageTitle=Yii::app()->name . ' - Мой профиль';
$this->breadcrumbs=array(
	'Мой профиль',
);
$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Редактирование профиля', 'url'=>array('edit')),
	array('label'=>'Manage Users', 'url'=>array('register')),
	array('label'=>'Manage Users', 'url'=>array('restore')),
	array('label'=>'Manage Users', 'url'=>array('view')),
);
?>

<h1>Мой профиль</h1>
