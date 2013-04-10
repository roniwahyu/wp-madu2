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

					$home=query_posts("post_type=page&meta_key=page_category&meta_value=product&showposts=1");

						if (have_posts($home)):

							while(have_posts($home)):the_post();?>

								<h3 style="display:none;clear:both;"><?php the_title();?></h3>

								<article class="content"><?php the_content();?></article>

								

							<?php endwhile;

						endif;

				?></div>
				<div class="kolom3">
					<div class="info rounded7">
						<h3 class="rounded7">Transfer Tunai</h3>
						<ul class="banking">
							<li class="bca">554.032.9607<br/>
								Rika Anindyasari Kartika</li>
							<li class="mandiri">127.000.520.8051<br/>
								Rika Anindyasari Kartika</li>
							
						</ul>
						<h5>Konfirmasi Pembayaran/Transfer</h5>
										<a target="_blank" href="http://ymgen.com/chat.php?idne=sarana.sakinah@yahoo.com">
						<img border="0" src="http://opi.yahoo.com/online?u=sarana.sakinah@yahoo.com&m=g&t=1"></a>

					</div><div class="clear">&nbsp;</div>
                </div>	
				

				

			<!-- </div> -->

	<!-- 	<div id="right-wrap"> -->
			<?php if ( is_active_sidebar( 'homepage2' ) ) : ?>

						<?php dynamic_sidebar( 'homepage2' ); ?>
						
					<?php endif; ?>
			<?php if ( is_active_sidebar( 'homepage3' ) ) : ?>

						<?php dynamic_sidebar( 'homepage3' ); ?>
						
					<?php endif; ?>

			<div class="kolom3">

			<h3>Featured 3</h3>

			<p class="text-big">Autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.</p>

                  <p>non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. 

                    Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. 

                    Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.</p>

                

                </div>


                <?php if ( is_active_sidebar( 'homepage' ) ) : ?>

						<?php dynamic_sidebar( 'homepage' ); ?>
						
					<?php endif; ?>

               <div class="clear">&nbsp;</div>

	

	<!-- 	</div>  -->

	</section>	



<?php get_footer();?>