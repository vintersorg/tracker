<?php 
/**
 * @var Comment model
 */
?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>$this->id,
	'action'=>Yii::app()->urlManager->createUrl($this->postCommentAction),
	'htmlOptions'=>array('class'=>'well span6', 'style'=>'margin-left:0;'),
)); ?>
    <?php echo $form->errorSummary($newComment); ?>
    <?php 
        echo $form->hiddenField($newComment, 'owner_name'); 
        echo $form->hiddenField($newComment, 'owner_id'); 
        echo $form->hiddenField($newComment, 'parent_comment_id', array('class'=>'parent_comment_id'));
    ?>
    <?php if(Yii::app()->user->isGuest == true):?>
            <?php echo $form->labelEx($newComment, 'user_name'); ?>
            <?php echo $form->textField($newComment,'user_name', array('style'=>'width:100%')); ?>
            <?php echo $form->error($newComment,'user_name'); ?>
        
        
            <?php echo $form->labelEx($newComment, 'user_email'); ?>
            <?php echo $form->textField($newComment,'user_email', array('style'=>'width:100%')); ?>
            <?php echo $form->error($newComment,'user_email'); ?>
        
    <?php endif; ?>

        <?php echo $form->labelEx($newComment, 'comment_text'); ?>
        <?php echo $form->textArea($newComment, 'comment_text', array('rows' => 10,'style'=>'width:100%')); ?>
        <?php echo $form->error($newComment, 'comment_text'); ?>

    <?php if($this->useCaptcha === true && extension_loaded('gd')): ?>

            <?php echo $form->labelEx($newComment,'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha', array(
                    'captchaAction'=>Yii::app()->urlManager->createUrl(CommentsModule::CAPTCHA_ACTION_ROUTE),
                )); ?>
                <?php echo $form->textField($newComment,'verifyCode'); ?>
                
            </div>
            <div class="hint">
                <?php echo Yii::t('CommentsModule.msg', '
                    Please enter the letters as they are shown in the image above.
                    <br/>Letters are not case-sensitive.
                ');?>
            </div>
            <?php echo $form->error($newComment, 'verifyCode'); ?>

    <?php endif; ?>
<?php $this->endWidget(); ?>
</div><!-- form -->
