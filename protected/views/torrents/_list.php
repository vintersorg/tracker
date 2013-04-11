<div class="" style="float: left; margin-right: 5px; margin-left: 5px;">
	<a href="<?php echo $this->createUrl('torrents/view',array('id' => $data->id));?>" target="_blank">
		<img width="150" height="174" src="<?php echo Images::src($data->postermini, 'postermini'); ?>" class="img-rounded" >
	</a>
	<div style="clear: both"></div>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Добавить',
	    //'type'=>'inverse', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'url'=>array('torrents/special', "id"=>$data->id),
	    'htmlOptions' => array('style' => 'width: 126px; margin-top: 5px;') 
	)); ?>
	
</div>