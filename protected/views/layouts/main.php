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

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<?php Yii::app()->clientScript->registerScript('metrica',
	'<!-- Yandex.Metrika counter -->
	(function (d, w, c) {
	    (w[c] = w[c] || []).push(function() {
	        try {
	            w.yaCounter20884282 = new Ya.Metrika({id:20884282,
	                    webvisor:true,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true});
	        } catch(e) { }
	    });
	
	    var n = d.getElementsByTagName("script")[0],
	        s = d.createElement("script"),
	        f = function () { n.parentNode.insertBefore(s, n); };
	    s.type = "text/javascript";
	    s.async = true;
	    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
	
	    if (w.opera == "[object Opera]") {
	        d.addEventListener("DOMContentLoaded", f, false);
	    } else { f(); }
	})(document, window, "yandex_metrika_callbacks");
	<!-- /Yandex.Metrika counter -->',
	CClientScript::POS_READY); ?>
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
                array('label'=>'Видео', 'url'=>'#',
                'items'=>array(
                	array('label'=>'Видео', 'url'=>array('torrent/category', 'category'=>'video')),
                    array('label'=>'Фильмы', 'url'=>array('torrent/category', 'category'=>'films')),
                    array('label'=>'Клипы', 'url'=>array('torrent/category', 'category'=>'klip')),
                    array('label'=>'Сериалы', 'url'=>array('torrent/category', 'category'=>'serial')),
                    array('label'=>'ТВ', 'url'=>array('torrent/category', 'category'=>'tv')),
                )),
                array('label'=>'Музыка', 'url'=>array('torrent/category', 'category'=>'music')),
				array('label'=>'Игры', 'url'=>array('torrent/category', 'category'=>'games')),
				array('label'=>'Софт', 'url'=>array('torrent/category', 'category'=>'soft')),
                array('label'=>'Загрузить', 'url'=>'/torrent/create', 'active'=>Yii::app()->request->requestUri == '/torrents/create', 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
        '<form class="navbar-search pull-left" action="/torrent/search"><input type="text" class="search-query span2" name="search" placeholder="Search"></form>',
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
	            'image' => '/images/main_slider/0_mini.jpg',
	            'label' => 'Статическая надпись #1',
	            'caption' => 'Статическая подпись #1',
				),
	        array(
	            'image' => '/images/main_slider/1_mini.jpg',
	            'label' => 'Статическая надпись #2',
	            'caption' => 'Статическая подпись #2',
				),
			array(
	            'image' => '/images/main_slider/2_mini.jpg',
	            'label' => 'Статическая надпись #3',
	            'caption' => 'Статическая подпись #3',
				),
			array(
	            'image' => '/images/main_slider/3_mini.jpg',
	            'label' => 'Статическая надпись #4',
	            'caption' => 'Статическая подпись #4',
				),
			array(
	            'image' => '/images/main_slider/4_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/main_slider/5_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/main_slider/6_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/main_slider/7_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/main_slider/8_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/main_slider/9_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
			array(
	            'image' => '/images/main_slider/10_mini.jpg',
	            'label' => 'Статическая надпись #5',
	            'caption' => 'Статическая подпись #5',
				),
	    ),
	)); ?><!--bigslider-->
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="span5"><img src="/images/remont.jpg" class="img-rounded" ></div>
				<div class="span6">
					<span style="font-size: 15px">
						<br><br>Сайт находится в на ранней стадии разработки. Сохранение внесенных данных не гарантируется! Если быть точнее, то все будет удалено :). Заходите позже.
						<br>Жалобы, вопросы, пожелания принимаются на <a href="mailto:mailbox@firebow.org" target="_blank">mailbox@firebow.org</a>
					</span></div>
			</div>
		</div>
	</div>
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