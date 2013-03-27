<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="row">
		<?php if(!empty($this->menu)):?>
			<div class="span9">
		<?php else:?>
			<div class="span12">
		<?php endif ?>
		<?php echo $content; ?>
		</div>
		<!-- content -->
		<div class="span3">
			<?php
				$this->widget('bootstrap.widgets.TbMenu', array(
				    'type'=>'list',
				    'items'=>$this->menu,
				)); ?>
			
		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>