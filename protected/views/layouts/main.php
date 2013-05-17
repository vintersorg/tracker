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
<div id="body">
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
	                array('label'=>'Видео', 'url'=>array('torrent/category', 'id'=>'video'),
	                'items'=>array(
	                	array('label'=>'Видео', 'url'=>array('torrent/category', 'id'=>'video')),
	                    array('label'=>'Фильмы', 'url'=>array('torrent/category', 'id'=>'films')),
	                    array('label'=>'Клипы', 'url'=>array('torrent/category', 'id'=>'klip')),
	                    array('label'=>'Сериалы', 'url'=>array('torrent/category', 'id'=>'serial')),
	                    array('label'=>'ТВ', 'url'=>array('torrent/category', 'id'=>'tv')),
	                )),
	                array('label'=>'Музыка', 'url'=>array('torrent/category', 'id'=>'music')),
					array('label'=>'Игры', 'url'=>array('torrent/category', 'id'=>'games')),
					array('label'=>'Софт', 'url'=>array('torrent/category', 'id'=>'soft')),
	                array('label'=>'Загрузить', 'url'=>array('/torrent/create'), 'visible'=>!Yii::app()->user->isGuest),
	            ),
	        ),
	        '<form class="navbar-search pull-left" action="/torrent/search"><input type="text" class="search-query span2" name="search" placeholder="Search"></form>',
	        array(
	            'class'=>'bootstrap.widgets.TbMenu',
	            'htmlOptions'=>array('class'=>'pull-right'),
	            'items'=>array(
	                array('label'=> 'Профиль', 'url'=>array('/passport/view/', 'id'=>Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
	                
	                array('label'=>'Войти', 'url'=>array('/passport/login'), 'visible'=>Yii::app()->user->isGuest),
	                array('label'=>'Выйти ('.Yii::app()->user->name.')', 'url'=>array('/passport/logout'), 'visible'=>!Yii::app()->user->isGuest),
	            ),
	        ),
	    ),
	)); ?>
	<!-- mainmenu -->
	<?php if(Yii::app()->controller->id == 'tracker' && Yii::app()->controller->action->id == 'index'): ?> 
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
		            'label' => 'Статическая надпись #6',
		            'caption' => 'Статическая подпись #6',
					),
				array(
		            'image' => '/images/main_slider/6_mini.jpg',
		            'label' => 'Статическая надпись #7',
		            'caption' => 'Статическая подпись #7',
					),
				array(
		            'image' => '/images/main_slider/7_mini.jpg',
		            'label' => 'Статическая надпись #8',
		            'caption' => 'Статическая подпись #8',
					),
				array(
		            'image' => '/images/main_slider/8_mini.jpg',
		            'label' => 'Статическая надпись #9',
		            'caption' => 'Статическая подпись #9',
					),
				array(
		            'image' => '/images/main_slider/9_mini.jpg',
		            'label' => 'Статическая надпись #10',
		            'caption' => 'Статическая подпись #10',
					),
				array(
		            'image' => '/images/main_slider/10_mini.jpg',
		            'label' => 'Статическая надпись #11',
		            'caption' => 'Статическая подпись #11',
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
	<div class="hFooter"></div>
</div>
<div id="footer" class="">
	<div class="container-credit">
		<div class="credit">Copyright &copy; <?php echo date('Y'); ?> by Vintersorg.</div>
	</div>
</div>

<!-- page -->

</body>
</html>