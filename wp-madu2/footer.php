

<footer id="footer">

	<div class="copyright"> Copyright &copy; 2012, <?php bloginfo('name'); ?><br/>

		All Rights Reserved<br/>

		<span class="designby">Design & Developed By: <a href="http://www.roniwahyu.com" title="roniwahyu" alt="http://www.roniwahyu.com" rel="nofollow" />Erway Media Solusi</a></span>

	</div>

	<div class="footer-widget">

			<?php if ( is_active_sidebar( 'footer1' ) ) : ?>

					<?php dynamic_sidebar( 'footer1' ); ?>

			<?php else : ?>

		<?php endif;?>



	</div>

	<div class="footer-widget">

			<?php if ( is_active_sidebar( 'footer2' ) ) : ?>

					<?php dynamic_sidebar( 'footer2' ); ?>

			<?php else : ?>

		<?php endif;?>



	</div>

	<nav id="footermenu">

	<?php wp_nav_menu( array( 'container_class'=>'footermenu','theme_location' => 'footermenu','menu_class' => 'footermenu') ); ?>

</nav>

	<div style="text-indent:-9999px;text-transform:capitalize;text-decoration:none;display:none;float:left;position:relative;">

	   <a href="http://www.roniwahyu.com" title="roniwahyu.com" alt="www.roniwahyu.com" rel="follow">www.roniwahyu.com</a>

	  <a href="http://www.roniwahyu.web.id" title="roniwahyu.web.id" alt="www.roniwahyu.web.id" rel="follow">www.roniwahyu.web.id</a>

	   <a href="http://www.wisatapedia.com" title="wisatapedia.com" alt="www.wisatapedia.com" rel="follow">www.wisatapedia.com</a>

	    <a href="http://www.erwaymedia.com" title="erwaymedia.com" alt="www.erwaymedia.com" rel="follow">www.erwaymedia.com</a>

	     <a href="http://www.buyfatloss.com" title="buyfatloss.com" alt="www.buyfatloss.com" rel="follow">www.buyfatloss.com</a>

	        

  

</div>

</footer>

<div class="clear">&nbsp;</div>

		


		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.7.1.min.js"></script>

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.colorbox.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/modernizr.full.min.js"></script>

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cycle.lite.min.js"></script>




		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>

		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.jcarousel.min.js"></script>



<!--

  jCarousel skin stylesheet

-->

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/tango/skin.css" />



<script type="text/javascript">



$(document).ready(function() {

    $('#mycarousel').jcarousel();
   

});

</script>

		<script type="text/javascript">

$(document).ready(function() {

		/* for top navigation */

	

		$(" #main-nav .main-menu ul ul ").css({display: "none"}); // Opera Fix

		$(" #main-nav .main-menu ul li").hover(function(){

		$(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400);

		},function(){

		$(this).find('ul:first').css({visibility: "hidden"}).slideUp(400);

		});

		/* main page rotator */

			$('#rotator ul').cycle({ 

				fx:     'fade', 

				speed:  300, 

				timeout: 7000,

				pager: '.controls',

				prev: '.prev',

				next: '.next'

			}); 

		

});	

</script>

<script type="text/javascript" charset="utf-8">

			$(document).ready(function() {

				$('#example').dataTable( {

					"sPaginationType": "full_numbers"

				} );

			} );

		</script>

<?php wp_footer(); // js scripts are inserted using this function ?>

		<!--[if lt IE 7 ]>

  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>

  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>

		<![endif]-->

		



	</body>



</html>