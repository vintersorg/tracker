<a href="<?php echo $this->createUrl('torrent/view',array('id' => $data->id));?>">
	<img src="<?php echo $this->createUrl(Func::getImgSrc('poster', $data->id, 'small'));?>" class="img-rounded poster-small" >
</a>