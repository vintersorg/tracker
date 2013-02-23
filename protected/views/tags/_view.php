<?php
/* @var $this TagsController */
/* @var $data Tags */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('caption')); ?>:</b>
	<?php echo CHtml::encode($data->caption); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category->caption); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_dt')); ?>:</b>
	<?php echo CHtml::encode($data->created_dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->author->username), array('users/view','id'=>$data->author->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approve_id')); ?>:</b>
	<?php echo CHtml::encode($data->approve_id); ?>
	<br />

</div>