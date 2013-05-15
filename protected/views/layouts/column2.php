<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="row">
		<div class="span"  style="float: left">		
			<?php echo $content; ?>
		</div>
		<!-- content -->
		<div class="span3" style="float: right">
			<?php
				$this->widget('bootstrap.widgets.TbMenu', array(
				    'type'=>'list',
				    'items'=>$this->menu,
				)); ?>
			
		</div><!-- sidebar -->
	</div>
</div>

<?php $this->endContent(); ?>
