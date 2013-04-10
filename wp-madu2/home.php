<?php get_header(); ?>
<section id="slideshow">

		<div id="rotator" class="rounded12 shadowed">

		<!-- 	<div class="controls"></div> -->		

			<a href="#" class="tombol prev madu"></a>

			<a href="#" class="tombol next madu"></a>

			<ul>

		<?php

			wp_reset_query();

			$slide=query_posts("post_type=produk");

				if (have_posts($slide)):

					while(have_posts($slide)):

						the_post();

				?>

						<li><?php 

							if(has_post_thumbnail()):

								the_post_thumbnail('featured',array('class'=>'image allrounded','style'=>'vertical-align:center'));

							endif;



						?>

							<div class="span6 right rounded7">

                  				<h2><?php the_title();?></h2>

									<p class="text-big"><?php my_excerpt(50);?></p>

							</div>

						</li>

					<?php endwhile;

				endif;

		?>

		</ul>

			

			

					

				</div><div class="clear">&nbsp;</div>

	</section>

	

		<section id="navigation">

		<nav id="main-nav">

						<?php wp_nav_menu( array('container_class' => 'main-menu',  'theme_location' => 'primary','menu_class' => 'main-menu') ); ?>

		</nav>

	</section>
<?php include_once('loadimages.php');?>
<?php get_footer(); ?>