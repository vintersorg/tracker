<div class="span">
<?php foreach ($screens as $key => $file): ?>	
	<!--a href="<?php echo $this->createUrl(Func::getImgSrc('screen', $data->id, 'original').$file);?>">
		<img src="<?php echo $this->createUrl(Func::getImgSrc('screen', $data->id, 'small').$file);?>" class="img-rounded" >
	</a-->
	<?php $this->widget('ext.lyiightbox.LyiightBox2', array(
        'image' => DIRECTORY_SEPARATOR.Func::getImgSrc('screen', $data->id, 'original').$file,	        
        'thumbnail'=> DIRECTORY_SEPARATOR.Func::getImgSrc('screen', $data->id, 'small').$file,
        'title'=> '',
        'group'=>'screens',
        'htmlOptions' =>  array('class'=>'img-rounded'),
    )); ?>
<?php endforeach; ?>
</div>
