<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="<?php echo $meta_description; ?>">
<meta name="keywords" content="<?php echo $meta_keywords; ?>">
<meta http-equiv="Copyright" content="<?php echo $meta_author; ?>">
<meta name="author" content="<?php echo $meta_author; ?>">

<link href="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/css/3slider.css" rel="stylesheet" type="text/css" />
<title><?php echo $title.''.$GLOBALS['site_title'].' - '.$GLOBALS['site_quotes']; ?></title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script> 
<script src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/js/tabmenu.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/js/tabcontent.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/js/s3Slider.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/js/jquery.ticker.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/css/tab.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/css/breadcrumb.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function() { 
	$(function () {
	     // start the ticker 
		$('#js-news').ticker();
		
		// hide the release history when the page loads
		$('#release-wrapper').css('margin-top', '-' + ($('#release-wrapper').height() + 20) + 'px');

		// show/hide the release history on click
		$('a[href="#release-history"]').toggle(function () {	
			$('#release-wrapper').animate({
				marginTop: '0px'
			}, 600, 'linear');
		}, function () {
			$('#release-wrapper').animate({
				marginTop: '-' + ($('#release-wrapper').height() + 20) + 'px'
			}, 600, 'linear');
		});	
	});
   $("a.tab").click(function () {
	$(".active").removeClass("active");
	$(this).addClass("active");
	$(".content").slideUp();
	var content_show = $(this).attr("title");
	$("#"+content_show).slideDown();
	});
});
</script>
</head>

<body>
<div id="top-line-header">
	<div id="inner-top-line-header">
		<div id="left-inner-top-line-header">
			<?php echo $menu_atas; ?>
		</div>
		<div id="right-inner-top-line-header">
			<div style="float:left; padding-top:5px;">Selamat Datang di Situs Berita <?php echo $GLOBALS['site_title']; ?>...! Follow us on </div>
			<div style="float:left; padding-left:10px;"><img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/fb-icon.png" /><img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/twitter-icon.png" /><img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/g+-icon.png" /></div>
		</div>
	</div>
</div>

<div id="header">
	<div id="inner-header">
		<div class="cleaner_h0"></div>
		<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/logo.png" style="float:left;" />
		<img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/space-iklan-1.png" style="float:right;" />
	</div>
</div>

<div id="second-top-line-header">
	<div id="second-inner-top-line-header">
	<div id="mainmenu"> <!-- main menu items -->
		<div class="tabmenucss" id="tabmenu">
		<div style="width:60px; float:left; margin-top:-22px; position:relative;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>asset/theme/<?php echo $GLOBALS['site_theme']; ?>/images/bg-homebutton.png" border="0" /></a></div>
			<?php echo $menu_bawah; ?>
		</div>

		<div class="tabcontainer">
			<div class="tabcontent" id="sc01" style="display: block;">
				<div id="submenu">
					<div style="float:left; width:200px;">
						<strong>Hot News on <?php echo $GLOBALS['site_title']; ?> : </strong>
					</div>

					<div id="hot-news">
						<ul id="js-news" class="js-hidden">
							<?php echo $home_terpopuler; ?>
						</ul>
					</div>
				</div>
			</div>

		</div> 
		</div>
	</div>
</div>
<div id="second-bottom-top-line-header"></div>

<div id="content">