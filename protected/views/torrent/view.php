<?php
$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Просмотр раздачи',
);
$this->page = true;
$viewMenu=array(
	array('label'=>'Редактирование', 'icon'=>'edit', 'url'=>array('edit','id'=>$model->id), 'visible'=>Yii::app()->user->id==$model->created_by,),
	array('label'=>'Загрузки', 'icon'=>'upload', 'url'=>array('special','id'=>$model->id), 'visible'=>Yii::app()->user->id==$model->created_by,),	
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
", CClientScript::POS_READY); ?>
<div class="row">
	<div class="span12">
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
		    'type'=>'pills',
		    'items'=>$viewMenu,		    
		)); ?>
	</div>
</div>
<div class="row">
	<div class="span5">
		<?php $this->widget('ext.lyiightbox.LyiightBox2', array(
	        'image' => DIRECTORY_SEPARATOR.Func::getImgSrc('poster', $model->id, 'original'),	        
	        'thumbnail'=> DIRECTORY_SEPARATOR.Func::getImgSrc('poster', $model->id, 'big'),
	        'title'=> '',
	        'group'=>'poster',
	        'htmlOptions' =>  array('class'=>'img-rounded poster-big'),
	    )); ?>
	</div>
	<div class="span7"><h3><?php echo $model->nameLocal." / ".$model->nameOrigin." ".$model->year; ?></h3></div>
	<div class="span7">
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
	<!--div class="span7">
		<?php $ratings = 'tt1442449'; ?>
		<?php echo CHtml::image('http://imdb.snick.ru/ratefor/03/'.$ratings.'.png', 'Оценка фильма на Kinopoisk.ru и IMDB.com', array('title'=>"Оценка фильма на Kinopoisk.ru и IMDB.com")); ?>
	</div-->
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