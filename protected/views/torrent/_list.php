<div class="" style="float: left; margin-right: 5px; margin-left: 5px;">
	<a href="<?php echo $this->createUrl('torrent/view',array('id' => $data->id));?>" target="_blank">
		<img src="<?php echo $this->createUrl(Func::getImgSrc('poster', $data->id, 'small'));?>" class="img-rounded" >
	</a>
	<div style="clear: both"></div>
	<?php if(Yii::app()->controller->action->id == 'chois'): ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		    'label'=>'Добавить',
		    //'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'url'=>array('torrents/special', "id"=>$data->id),
		    'htmlOptions' => array('style' => 'width: 126px; margin-top: 5px;') 
		)); ?>
	<?php endif; ?>	
</div>