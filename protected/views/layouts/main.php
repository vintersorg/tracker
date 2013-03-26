<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" /-->
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" /-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" /-->
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<!--div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div-->
		<div style="height: 40px"></div>
	</div><!-- header -->

	<div class="container">
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
		    //'type'=>'inverse', // null or 'inverse'
		    'brand'=>CHtml::encode(Yii::app()->name),
		    'brandUrl'=>'/tracker/index',
		    //'collapse'=>true, // requires bootstrap-responsive.css прикольно, но нахуй
		    'items'=>array(
		        array(
		            'class'=>'bootstrap.widgets.TbMenu',
		            'items'=>array(
		                array('label'=>'Раздача', 'url'=>'/torrents/index', 'active'=>true),
		                array('label'=>'Новая раздача', 'url'=>'/torrents/create'),
		            ),
		        ),
		        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
		        array(
		            'class'=>'bootstrap.widgets.TbMenu',
		            'htmlOptions'=>array('class'=>'pull-right'),
		            'items'=>array(
		                array('label'=>'Профиль', 'url'=>'/passport/view', 'visible'=>!Yii::app()->user->isGuest),
		                
		                array('label'=>'Login', 'url'=>'/passport/login', 'visible'=>Yii::app()->user->isGuest),
		                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>'/passport/logout', 'visible'=>!Yii::app()->user->isGuest),
		            ),
		        ),
		    ),
		)); ?>
	</div><!-- mainmenu -->
	<div class="container">
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
		
		<?php echo $content; ?>
	</div>
	<div class="clear"></div>

	<!--div class="navbar navbar-fixed-bottom">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div--><!-- footer -->

</div><!-- page -->

</body>
</html>
