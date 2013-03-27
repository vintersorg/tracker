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
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>CHtml::encode(Yii::app()->name),
    'brandUrl'=>'/',
    //'collapse'=>true, // requires bootstrap-responsive.css прикольно, но нахуй
    'htmlOptions' => array('style' => 'position:static'),
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                //array('label'=>'Раздача', 'url'=>'/torrents/index', 'active'=>Yii::app()->request->requestUri == '/torrents/index'),
                array('label'=>'Видео', 'url'=>'/torrents/index', 'active'=>Yii::app()->request->requestUri == '/torrents/index',
                'items'=>array(
                    array('label'=>'Фильмы', 'url'=>'#'),
                    array('label'=>'Клипы', 'url'=>'#'),
                    array('label'=>'Сериалы', 'url'=>'#'),
                    array('label'=>'ТВ', 'url'=>'#'),
                )),
                array('label'=>'Музыка', 'url'=>'#'),
				array('label'=>'Игры', 'url'=>'#'),
				array('label'=>'Софт', 'url'=>'#'),
                array('label'=>'Загрузить', 'url'=>'/torrents/create', 'active'=>Yii::app()->request->requestUri == '/torrents/create', 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
        '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=> 'Профиль', 'url'=>'/passport/view/'.Yii::app()->user->id, 'visible'=>!Yii::app()->user->isGuest, 'active'=>Yii::app()->request->requestUri == '/passport/view'),
                
                array('label'=>'Войти', 'url'=>'/passport/login', 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>'/passport/logout', 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
)); ?>
<!-- mainmenu -->
<?php if(in_array(Yii::app()->request->requestUri, array('/tracker/index', '/'))):?>
	<?php $this->widget('bootstrap.widgets.TbCarouselBg', array(
	    'items' => array(
	        array(
	            'image' => '/images/0.png',
	            'label' => 'Статическая надпись #1',
	            'caption' => 'Статическая подпись #1',
				),
	        array(
	            'image' => '/images/1.png',
	            'label' => 'Статическая надпись #2',
	            'caption' => 'Статическая подпись #2',
				),
			array(
	            'image' => '/images/2.png',
	            'label' => 'Статическая надпись #3',
	            'caption' => 'Статическая подпись #3',
				),
			array(
	            'image' => '/images/3.png',
	            'label' => 'Статическая надпись #4',
	            'caption' => 'Статическая подпись #4',
				),
			array(
	            'image' => '/images/4.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/5.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/6.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/7.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/8.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/9.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/10.png',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
	    ),
	)); ?><!--bigslider-->
<?php endif ?>

<?php if(isset($this->breadcrumbs)):?>
	<div class="container">
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	</div>
<?php endif?>

<?php echo $content; ?>

<div class="clear"></div>

<!--div class="navbar navbar-fixed-bottom">
	Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
	All Rights Reserved.<br/>
	<?php echo Yii::powered(); ?>
</div--><!-- footer -->

<!-- page -->

</body>
</html>
