<?php
$this->breadcrumbs=array(
	'Загрузить'=>array('torrents/'),
	'Новая раздача',
);
$this->page = true;
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

<?php echo $this->renderPartial('_create', array(
	'model'=>$model,
)); ?>

<?php if(isset($list->itemCount) && $list->itemCount>0): ?>
	<div class="span8">		
		<?php $this->widget('bootstrap.widgets.TbBox', array(
		    'title' => 'Раздача с таким названием уже существует, вы можете добавить в нее свой торрент файл.',
		    'headerIcon' => 'icon-plus',
		    'content' => $this->renderPartial('_chois', array('dataProvider'=> $list), true),
		));?>
	</div>
<?php endif;?>
