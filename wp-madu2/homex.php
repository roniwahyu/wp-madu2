<?php get_header();?>

	<section id="slideshow">

		<div id="rotator" class="rounded12 shadowed">

		<!-- 	<div class="controls"></div> -->		

			<a href="#" class="btn prev"></a>

			<a href="#" class="btn next"></a>

			<ul>

		<?php

			wp_reset_query();

			$slide=query_posts("post_type=slideshow");

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

	

	<div id="content-wrap">

	<!-- 	<div id="left-wrap"> -->

			<section id="featured" class="rounded shadowed">
				<div id="maincontent" class="kolom1">

					<?php

						wp_reset_query();

						$home=query_posts("post_type=page&meta_key=page_categories&meta_value=welcome&showposts=1");

							if (have_posts($home)):

								while(have_posts($home)):the_post();?>

									

									<article class="content"><h3 style=""><?php the_title();?></h3><p><?php the_content();?></p></article>

									

								<?php endwhile;

							endif;

					?></div>
				<div class="kolom3">

					<?php

						wp_reset_query();

						$home=query_posts("post_type=page&meta_key=page_categories&meta_value=aboutus&showposts=1");

							if (have_posts($home)):

								while(have_posts($home)):the_post();?>

									

									<?php 

									if(has_post_thumbnail()):

										the_post_thumbnail('medium',array('class'=>'floating'));

									endif;?>

									<h3 style=""><?php the_title();?></h3>

									<p class="text-big"><?php my_excerpt(30);?></p>

									<span class="button"><a class="button" href="<?php the_permalink();?>">More ></a></span>

								<?php endwhile;

							endif;

					?></div>
				<div id="maincontent" class="homeproduct rounded">

					<h3>PRODUK KAMI</h3>

				<?php

					wp_reset_query();

					$produk=query_posts("post_type=produk");

						if (have_posts($produk)):?>
							<article class="content">
							<h3 style="clear:both;"><a href="<?php the_permalink() ?>" rel="bookmark">
						        <?php the_title();?>
						    </a></h3>
							<ul>
							<?php while(have_posts($produk)):the_post();?>

								<?php $meta = get_post_meta( get_the_ID() ); ?>
								<?php if ( get_post_meta(get_the_ID()  )) : ?>
						    <li><?php the_meta();?>
						    
						    <?php
						    	 	$mykey_values = get_post_custom_values('madu_plupload');
								if(!empty($mykey_values)):
									  foreach ( $mykey_values as $key => $value ) {
									    echo "$key  => $value ('madu_plupload')<br />"; 
									  }
								endif;

						    ?>
							</li>
						<?php endif; ?>
								
								

								

							<?php endwhile; ?><ul>
</article>
						<?php endif;

				?></div>
				<div class="kolom3">
					<div class="ads">
						<a href="<?php echo of_get_option('urltopleft');?>" rel="follow"><img src="<?php echo of_get_option('adstopleft');?>" title="<?php  echo of_get_option('topleft-desc');?>" alt="<?php echo of_get_option('topleft-desc');?>"/></a>
					</div>
					<div class="ads">
						<a href="<?php echo of_get_option('urltopright');?>" rel="follow"><img src="<?php echo of_get_option('adstopright');?>" title="<?php  echo of_get_option('topright-desc');?>" alt="<?php echo of_get_option('topright-desc');?>"/></a>
					</div>
					<div class="ads">
						<a href="<?php echo of_get_option('urlbottomleft');?>" rel="follow"><img src="<?php echo of_get_option('adsleftbottom');?>" title="<?php  echo of_get_option('bottomleft-desc');?>" alt="<?php echo of_get_option('bottomleft-desc');?>"/></a>
					</div>
					<div class="ads">
						<a href="<?php echo of_get_option('urlbottomright');?>" rel="follow"><img src="<?php echo of_get_option('adsrightbottom');?>" title="<?php  echo of_get_option('bottomright-desc');?>" alt="<?php echo of_get_option('bottomright-desc');?>"/></a>
					</div>
				
				</div>
			<?php if ( is_active_sidebar( 'homepage2' ) ) : ?>

						<?php dynamic_sidebar( 'homepage2' ); ?>
						
					<?php endif; ?>	
				

				

			<!-- </div> -->

	<!-- 	<div id="right-wrap"> -->
					
				   	<?php if ( is_active_sidebar( 'homepage' ) ) : ?>

						<?php dynamic_sidebar( 'homepage' ); ?>
						
					<?php endif; ?>

               <div class="clear">&nbsp;</div>

	

	<!-- 	</div>  -->

	</section>	



<?php get_footer();?>