<div class="span">
	<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'itemView'=>'/torrent/_list',
	    'htmlOptions' => array('style'=>'padding-top:0;'),
	)); ?>
</div>