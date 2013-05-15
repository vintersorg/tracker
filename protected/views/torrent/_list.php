<div class="torrent-list">
	<div class="torrent-list-row">
		<a href="<?php echo $this->createUrl('torrent/view',array('id' => $data->id));?>"
			<?php if(Yii::app()->controller->action->id == 'create'): ?> 
				target="_blank"
			<?php endif; ?>	>
			<img src="<?php echo $this->createUrl(Func::getImgSrc('poster', $data->id, 'small'));?>" class="img-rounded" >
		</a>
	</div>
	<div class="torrent-list-row">
		<p><?php echo Func::reduceContent(empty($data->nameLocal)?$data->nameOrigin:$data->nameLocal, 30, $data->id, 'torrent/view', '...');?></p>
	</div>
	<div class="torrent-list-row">
		<?php if(Yii::app()->controller->action->id == 'create'): ?>
			<?php $this->widget('bootstrap.widgets.TbButton', array(
			    'label'=>'Добавить',
			    //'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			    'url'=>array('torrents/special', "id"=>$data->id),
			    'htmlOptions' => array('style' => 'width: 126px; margin-top: 5px;') 
			)); ?>
		<?php endif; ?>
	</div>
</div>