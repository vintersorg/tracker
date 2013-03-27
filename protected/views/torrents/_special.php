<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'torrentEdit-form',
	'htmlOptions'=>array('class'=>'well span8'),
)); ?>
	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>

	<?php echo $form->errorSummary($model); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Перейти к раздаче',
	    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'url'=>array('view', "id"=>$model->torrent_id),
	)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Предпросмотр',
	    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'url'=>array('view', "id"=>$model->torrent_id), //TODO:сделать предпросмотр:)
	)); ?>
	
<?php $this->endWidget(); ?>