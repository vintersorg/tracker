<?php
$this->breadcrumbs=array(
	'Torrent'=>array('index'),
	'Special',
);
$this->page = true;
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'torrentEdit-form',
	'htmlOptions'=>array('class'=>'well span8','enctype' => 'multipart/form-data'),
)); ?>
	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'photos'); ?>

    <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
	        'id'=>'uploadFile',
	        'config'=>array(
	               'action'=>Yii::app()->createUrl('torrent/uposter', array('id'=>Yii::app()->request->getParam('id'))),
	               'allowedExtensions'=>array("jpg","jpeg","gif","png","bmp"),//array("jpg","jpeg","gif","exe","mov" and etc...
	               'sizeLimit'=>10*1024*1024,// maximum file size in bytes
	               'minSizeLimit'=>10*1024,// minimum file size in bytes
	               //'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName); }",
	               'messages'=>array(
	                                 'typeError'=>"{file} имеер недопустимое расширение. Только {extensions} разрешены.",
	                                 'sizeError'=>"{file} слишком большой, максимальный размер {sizeLimit}.",
	                                 'minSizeError'=>"{file} слишком мал, минимальный размер {minSizeLimit}.",
	                                 'emptyError'=>"{file} is empty, please select files again without it.",
	                                 'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
	                                ),
	               'showMessage'=>"js:function(message){ alert(message); }"
	              )
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