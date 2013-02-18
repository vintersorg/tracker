<?php
/* @var $this TagsController */
/* @var $model Tags */

$this->breadcrumbs=array(
	'Tags'=>array('index'),
	$model->tag_id,
);

$this->menu=array(
	array('label'=>'List Tags', 'url'=>array('index')),
	array('label'=>'Create Tags', 'url'=>array('create')),
	array('label'=>'Update Tags', 'url'=>array('update', 'id'=>$model->tag_id)),
	array('label'=>'Delete Tags', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tag_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tags', 'url'=>array('admin')),
);
?>

<h1>View Tags #<?php echo $model->tag_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tag_id',		
		'caption',
		'created_dt' =>array(               // related city displayed as a link
            'label'=>'Автор',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode($model->user->username),
                                 array('users/view','id'=>$model->user->id)),
        ),
		'created_dt',
		'approve_id',
	),
)); ?>
