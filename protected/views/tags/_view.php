<?php
/* @var $this TagsController */
/* @var $data Tags */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tag_id), array('view', 'id'=>$data->tag_id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('caption')); ?>:</b>
	<?php echo CHtml::encode($data->caption); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_dt')); ?>:</b>
	<?php echo CHtml::encode($data->created_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->user->username), array('users/view','id'=>$data->user->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approve_id')); ?>:</b>
	<?php echo CHtml::encode($data->approve_id); ?>
	<br />

</div>