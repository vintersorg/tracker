<div class="span">
<?php foreach ($screens as $key => $file): ?>	
	<a href="<?php echo $this->createUrl('file/screen',array('id' => $data->id, 'file'=>$file));?>">
		<img src="<?php echo $this->createUrl('file/screen',array('id' => $data->id, 'size'=>'small', 'file'=>$file));?>" class="img-rounded" >
	</a>
<?php endforeach; ?>
</div>
