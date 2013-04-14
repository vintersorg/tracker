<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'torrentEdit-form',
	'htmlOptions'=>array('class'=>'well span8'),
)); ?>
	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php $this->widget('xupload.XUpload', array(
	                    'url' => Yii::app()->createUrl("site/upload"),
	                    'model' => $model,
	                    'attribute' => 'torrent_file',
	                    'multiple' => true,
	)); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Перейти к раздаче',
	    'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'url'=>array('view', "id"=>Yii::app()->request->getParam('id')),
	)); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>'Предпросмотр',
	    'type'=>'info', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
	    'url'=>array('view', "id"=>Yii::app()->request->getParam('id')), //TODO:сделать предпросмотр:)
	    'htmlOptions'=>array('target'=>'_blank'),
	)); ?>
	
<?php $this->endWidget(); ?>