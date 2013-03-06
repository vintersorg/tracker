<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torrentFirst-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Существуют раздачи с подобным названием, вы можете добавить в одну из них свой торрент файл.</p>
	<div class="row">
	    <?php echo $form->labelEx($model, 'torrentGroup'); ?>
	 
	            <div class="radioTorrentGroup">
	        <?php
	            echo $form->radioButtonList($model, 'torrentGroup',
	                Func::arrayValToKey(CHtml::listData(Torrents::model()->findAllByPk($torrents), 'id', 'id')));
	        ?>
	        </div>
	        <?php echo $form->error($model, 'torrentGroup'); ?>
	</div>
	<div class="row buttons">
			<?php echo CHtml::submitButton('Добавить'); ?>
			<?php //нехуй echo CHtml::submitButton('Все равно создать новую'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->