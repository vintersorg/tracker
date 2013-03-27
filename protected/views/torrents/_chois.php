<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'torrentChois-form',
	'htmlOptions'=>array('class'=>'well span8'),
)); ?>
	<p class="note">Раздача с таким названием уже существует, вы можете добавить в нее свой торрент файл.</p>
	
	<?php echo $form->labelEx($model, 'torrentGroup'); ?>
	 
	<div class="radioTorrentGroup">
	<?php	
		echo $form->radioButtonList($model, 'torrentGroup',
		Func::arrayValToKey(CHtml::listData(Torrents::model()->findAllByPk($torrents), 'id', 'id'))); ?>
	</div>
    <?php echo $form->error($model, 'torrentGroup'); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Добавить')); ?>
	<?php //нехуй echo CHtml::submitButton('Все равно создать новую'); ?>
	

<?php $this->endWidget(); ?>
