<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div class="row">
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Новые',
		    'headerIcon' => 'icon-plus icon-white',
		    'content' => $this->renderPartial('_new'),
		)); ?>
	</div>
	<div class="span6">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Популярные',
		    'headerIcon' => 'icon-star icon-white',
		    'content' => $this->renderPartial('_new'),
		)); ?>
	</div>
	<div class="span6">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Избранные',
		    'headerIcon' => 'icon-heart icon-white',
		    'content' => $this->renderPartial('_new'),
		)); ?>
	</div>
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Рекомендуемые',
		    'headerIcon' => 'icon-ok icon-white',
		    'content' => $this->renderPartial('_new'),
		)); ?>
	</div>
</div>
