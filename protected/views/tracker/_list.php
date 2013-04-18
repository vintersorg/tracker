<a href="<?php echo $this->createUrl('torrent/view',array('id' => $data->id));?>">
	<img width="100px" height="150px"  src="<?php echo $this->createUrl('file/poster',array('id' => $data->id, 'size'=>'small'));?>" class="img-rounded" >
</a>