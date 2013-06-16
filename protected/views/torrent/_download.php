<div style="float:left;padding: 10px;">
	<p>
		<?php echo CHtml::link($model->torrent_file, $this->createUrl('file/torrent',array('id' => $model->id)));?>
	</p>
</div>
<div style="float:left;padding: 10px;">
	<?php echo CHtml::link(CHtml::image('/images/download.jpg','', array('style'=>'width:50px;heigth:50px;')), $this->createUrl('file/torrent',array('id' => $model->id)));?>
</div>
