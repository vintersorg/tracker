<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
    	array('label'=>'Описание', 'url'=>'#description', 'active'=>true, 'data-toggle'=>"tab"),
        array('label'=>'Отзывы', 'url'=>'#comment'),
        array('label'=>'Скачать', 'url'=>'#download'),
        array('label'=>'Скриншоты', 'url'=>'#screen'),		        
    ),
)); ?>
<div class="tab-content">
	<div class="tab-pane active" id="description">
		<?php echo $this->renderPartial('_description', array(
			'model'=>$model,
		)); ?>			
	</div>
	
	<div class="tab-pane" id="comment">
		<?php echo $this->renderPartial('_comment', array(
			'model'=>$model,
		)); ?>
	</div>
		
	<div class="tab-pane" id="download">
		<?php echo $this->renderPartial('_download', array(
			'model'=>$model,
			'torrent'=>$torrent,
		)); ?>
	</div>
	
	<div class="tab-pane" id="screen">
		<?php echo $this->renderPartial('_screen', array(
			'data'=>$model,
			'screens'=>$screens,
		)); ?>				
	</div>
</div>
<!--Табы-->
