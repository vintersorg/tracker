<?php
/* @var $this TorrentsController */
/* @var $model Torrents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'torrentFirst-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	<p class="note">Выберите тип раздачи.</p>
	
	<div class="row">
        <?php echo $form->labelEx($model, 'category'); ?>
 
            <div class="radioCategory">
            <?php
                echo $form->radioButtonList($model, 'category',
                    Func::arrayValToKey(Tags::model()->getTagsByAlias('category')),
					array( 'separator' => " .|. " ) ); // choose your own separator 
            ?>
            </div>
            <?php echo $form->error($model, 'category'); ?>
    </div>
		
	<p class="note">Введите название и год выпуска чтобы проверить наличие такой раздачи.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nameLocal'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'nameLocal',
		    'attribute'=>'nameLocal',
		    'source'=> array_values(Tags::model()->getTagsByAlias('nameLocal')),
		    'model' => $model,
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'nameLocal'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'nameOrigin'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'nameOrigin',
		    'attribute'=>'nameOrigin',
		    'source'=> array_values(Tags::model()->getTagsByAlias('nameOrigin')),
		    'model' => $model,
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'nameOrigin'); ?>
	</div>
	
	<div>
		<?php echo $form->labelEx($model,'year'); ?>	
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
		    'name'=>'year',
		    'attribute'=>'year',
		    'source'=> array_values(Tags::model()->getTagsByAlias('year')),
		    'model' => $model,
		    // additional javascript options for the autocomplete plugin
		    'options'=>array(
		        //'minLength'=>'2',
		    ),
		));?>
		<?php echo $form->error($model,'year'); ?>
	</div>		
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Проверить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->