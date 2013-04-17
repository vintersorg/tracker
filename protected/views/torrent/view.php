<?php
$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Просмотр раздачи',
);
$this->page = true;
?>
<?php Yii::app()->clientScript->registerScript('buttonGroup', "
$(function(){
	//$('a[href*='+window.location.hash+']').tab('show');
    $('a[href*=#]:not([href=#])').bind('click', function (e) {
    	e.preventDefault();
		$(this).tab('show');
    });
    
});
", CClientScript::POS_END); ?>
<div class="row">
	<div class="span5"><img src="<?php echo $this->createUrl('file/poster',array('id' => $model->id, 'size'=>'big'));?>" class="img-rounded" ></div>
	
	<div class="span7"><h3><?php echo $model->nameLocal." / ".$model->nameOrigin." ".$model->year; ?></h3></div>
	<div class="span7">
		<?php $this->widget('bootstrap.widgets.TbDetailView', array(
		    'data'=>$model,
		    'attributes'=>array(
			    array('name'=>'nameLocal'),
			    array('name'=>'nameOrigin'),
			    array('name'=>'year'),
		        array('name'=>'producer'),
		        array('name'=>'actor'),		    ),
		)); ?>
	</div>
	<div class="span7">
		<?php $ratings = 'tt1442449'; ?>
		<img src="http://imdb.snick.ru/ratefor/03/<?php echo $ratings; ?>.png" alt="Оценка фильма на Kinopoisk.ru и IMDB.com" title="Оценка фильма на Kinopoisk.ru и IMDB.com" />
	</div>
	<!--Info-->
</div>
<div class="row">
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Описание',
		    'headerIcon' => 'icon-ok',
		    'content' => $this->renderPartial('_description', array('data'=> $model), true),
		)); ?>
	</div>
	<!--Описание-->
</div>
<div class="row">
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Скриншоты',
		    'headerIcon' => 'icon-eye-open',
		    'content' => $this->renderPartial('_screen', array('data'=> $model), true),
		)); ?>
	</div>
	<!--Описание-->
</div>
<?php if(!$preview): ?>
	<?php echo $this->renderPartial('_tabs', array(
		'model'=>$model,
	)); ?>
<?php endif; ?>
