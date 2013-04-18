<a href="<?php echo $this->createUrl('torrent/view',array('id' => $data->id));?>">
	<img src="<?php echo $this->createUrl('file/poster',array('id' => $data->id, 'size'=>'small'));?>" class="img-rounded poster-small" >
</a>