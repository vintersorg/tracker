<div class="row span12">
	<?php $this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
	    'stacked'=>false, // whether this is a stacked menu
	    'items'=>array(
	        array('label'=>'Отзывы', 'url'=>'#comment', 'active'=>true, 'data-toggle'=>"tab"),
	        array('label'=>'Скачать', 'url'=>'#download'),
	        array('label'=>'Рецензии', 'url'=>'#review'),
	        //array('label'=>'Просмотр', 'url'=>'#show'),
	    ),
	)); ?>
	<div class="tab-content">
		<div class="tab-pane active" id="comment">
			<?php echo $this->renderPartial('_comment', array(
				'model'=>$model,
			)); ?>
		</div>
			
		<div class="tab-pane" id="download">
			<?php echo $this->renderPartial('_download', array(
				'model'=>$model,
			)); ?>
		</div>
			
		<div class="tab-pane" id="review">
			<?php echo $this->renderPartial('_review', array(
				'model'=>$model,
			)); ?>
		</div>
	</div>
	<!--Табы-->
</div>