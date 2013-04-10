<!doctype html />  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="utf-8">
		
		<title><?php
		/*
		 * Print the <title> tag based on what is being vfprintf(handle, format, args)iewed.
		 */
		global $page, $paged;
		wp_title( '-', true, 'right' );
		// Add the blog name.
		bloginfo( 'name' );
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' - ' . sprintf( __( 'Page %s', 'Mother Hen' ), max( $paged, $page ) );
		?></title>
		<!--[if IE]>
    		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    	<![endif]-->
		

		<!-- Google Chrome Frame for IE -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"/> -->
		<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
		<link rel="apple-touch-icon" sizes="114x114" href="images/splash/splash-icon.png"> 
		<link rel="apple-touch-startup-image" href="images/splash/splash-screen.png" media="screen and (max-device-width: 320px)" /> 
		<link rel="apple-touch-startup-image" href="images/splash/splash-screen@2x.png" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" /> 
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
		<?php //<?php echo ! empty($h1_title) ? $h1_title : '';?>
		<!--<link rel="shortcut icon" href=<?php //echo get_template_directory_uri();?>/favicon.ico">-->
		
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/wpdefault.css">

		<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('stylesheet_url'); ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri();?>/css/bootstrap-responsive.min.css">


		
		
		<!-- drop Google Analytics Here -->
		<!-- end analytics -->
		
	</head>
	
	<body style="background-color:<?php echo of_get_option('bgcolor');?>">

	<header id="header">
		<nav id="header-nav">
			<div class="header-wrapper">				
			<?php wp_nav_menu( array( 'container_class' => 'header-nav', 'theme_location' => 'headmenu','menu_class' => 'header-nav') ); ?>
			</div>
		</nav>
		
		<div class="header-wrapper">
			<h1 class="logos"><a class="logo" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
			<h2 class="slogan"><a class="tagline" href="<?php echo home_url(); ?>"><?php bloginfo('description'); ?></a></h2>
			<div class="social">
				
				<ul class="">
						<li ><a href="https://www.facebook.com/<?php echo of_get_option('facebook');?>" class="facebook">Facebook</a></li>
						<li ><a href="https://www.twitter.com/<?php echo of_get_option('twitter');?>" class="twitter">Twitter</a></li>
						<li ><a href="http://www.youtube.com/<?php echo of_get_option('youtube');?>" class="youtube">Youtube</a></li>
						<li ><a href="http://plus.google.com/<?php echo of_get_option('googleplus');?>" class="google">Google+</a></li>
					</ul>
			<div class="searchbox">
				<form method="get" id="searchform" action="#">
			        <div class="bgsearch">
			          <input type="text" name="s" id="s2" value="Site Search..." onFocus="if (this.value == 'Site Search...')this.value = '';" onBlur="if (this.value == '')this.value = 'Site Search...';" />
			          <input type="submit" class="searchbutton" value="" />
			        </div>
    			 </form>
			</div>
			</div>
		</div>
		
	</header>
	<?php if(!(is_home())):?>
	<section id="navigation">
		<nav id="main-nav">
						<?php wp_nav_menu( array('container_class' => 'main-menu',  'theme_location' => 'primary','menu_class' => 'main-menu') ); ?>
		</nav>
	</section>
	<?php endif;?>
