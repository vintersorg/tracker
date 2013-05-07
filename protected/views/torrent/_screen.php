<div class="span">
<?php foreach ($screens as $key => $file): ?>	
	<a href="<?php echo $this->createUrl(Func::getImgSrc('screen', $data->id, 'original').$file);?>">
		<img src="<?php echo $this->createUrl(Func::getImgSrc('screen', $data->id, 'small').$file);?>" class="img-rounded" >
	</a>
<?php endforeach; ?>
</div>
