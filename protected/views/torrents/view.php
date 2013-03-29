<?php
$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Просмотр раздачи',
);
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
	<div class="span5"><img src="<?php echo Images::src($model->posterview, 'posterview'); ?>" class="img-polaroid"></div>
	<div class="span7">
		<div class="span7"><h3><?php echo $model->nameLocal." / ".$model->nameOrigin." ".$model->year; ?></h3></div>
			<?php $this->widget('bootstrap.widgets.TbDetailView', array(
			    'data'=>$model,
			    'attributes'=>array(
				    array('name'=>'nameLocal'),
				    array('name'=>'nameOrigin'),
				    array('name'=>'year'),
			        array('name'=>'producer'),
			        array('name'=>'actor'),
			    ),
			)); ?>
		</div>
		<div class="span7">
			<?php $ratings = 89515; ?>
			<img src="http://api.pro-kino.com/<?php echo $ratings; ?>.gif" alt="Оценка фильма на Kinopoisk.ru и IMDB.com" title="Оценка фильма на Kinopoisk.ru и IMDB.com" />
		</div>
	</div>
	<!--Info-->
</div>
<div class="row span12">
	<!--Описание-->
</div>
<?php if(!$preview): ?>
	<?php echo $this->renderPartial('_tabs', array(
		'model'=>$model,
	)); ?>
<?php endif; ?>