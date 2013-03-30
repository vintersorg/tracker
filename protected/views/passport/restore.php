<?php

$this->pageTitle=Yii::app()->name . ' - Восстановление пароля';
$this->breadcrumbs=array(
	'Паспорт' => array('/passport/restore'),
	'Восстановление пароля',
);
$this->menu=array(
	array('label'=>'Действия'),
	array('label'=>'Войти', 'icon'=>'user', 'url'=>'login'),
	array('label'=>'Регистрация', 'icon'=>'edit', 'url'=>'register'),
);
$this->page = true;
?>
<!--h1>Восстановление пароля</h1-->

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'restore-form',
	'htmlOptions'=>array('class'=>'well span5'),
)); ?>

	<p class="note"><span class="required">*</span> Поля обязательные для заполнения</p>
	
	<p class="note">На указанный Email будет выслано письмо с новым паролем.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php echo FlashDesigner::flashSummary();?>
	<?php $form->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
            'danger'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>
	
	<?php echo $form->textFieldRow($model, 'email', array('class'=>'span3')); ?> <br>
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Отправить')); ?>
		
<?php $this->endWidget(); ?>
