<?php


$this->breadcrumbs=array(
	'Загрузить'=>array('torrents/'),
	'Новая раздача',
);
?>
<?php Yii::app()->clientScript->registerScript('buttonGroup', "
$(function(){
    $('.btn-group a').click(function(){
        var fieldId = $(this).data('field');
        var value = $(this).data('value');
        $('#TorrentFirstForm_category').val(value); //костыль. TODO: разобраться как сделать нормально
        $('.btn-group a[data-field='+fieldId+']').removeClass('active');
        $(this).addClass('active');
    });
});
", CClientScript::POS_END); ?>

<h1>Новая раздача</h1>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
)); ?>
<?php if(!empty($torrents))
		echo $this->renderPartial('_chois', array(
			'model'=>$modelChois,
			'torrents' => $torrents,
		));
	//VarDumper::dump($modelChois);
?>
