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
	<div class="span5"><img src="<?php echo $this->createUrl(Func::getImgSrc('poster', $model->id, 'big'));?>" class="img-rounded poster-big" ></div>
	
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
	<div class="span12" style="padding-top: 20px;">
		<?php if(!$preview): ?>
			<?php echo $this->renderPartial('_tabs', array(
				'model'=>$model,
				'torrent'=>$torrent,
				'screens'=> $screens,
			)); ?>
		<?php endif; ?>
	</div>
</div>