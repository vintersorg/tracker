<div class="span12">
	<?php $this->widget('bootstrap.widgets.TbThumbnails', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'itemView'=>'_list',
	    'htmlOptions' => array('style'=>'padding-top:0;'),
	    //'url'	=> '#',
	)); ?>
</div>