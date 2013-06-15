<?php
$this->pageTitle=Yii::app()->name;
?>

<div class="row">
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Новые',
		    'headerIcon' => 'icon-plus',
		    'content' => $this->renderPartial('list', array('dataProvider'=> $recently), true),
		)); ?>
	</div>
	<div class="span6">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Популярные',
		    'headerIcon' => 'icon-star',
		    'content' => $this->renderPartial('list', array('dataProvider'=> $top), true),
		)); ?>
	</div>
	<div class="span6">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Избранные',
		    'headerIcon' => 'icon-heart',
		    'content' => $this->renderPartial('list', array('dataProvider'=> $favorites), true),
		)); ?>
	</div>
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Рекомендуемые',
		    'headerIcon' => 'icon-ok',
		    'content' => $this->renderPartial('list', array('dataProvider'=> $recommended), true),
		)); ?>
	</div>
</div>
