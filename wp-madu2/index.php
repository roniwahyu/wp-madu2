<?php

/**

Template Name: Index Template

**/

?>



<? get_header();?>

<div class="clear">&nbsp;</div>

	<section id="content">

		<div id="maincontent">

			<?php if (have_posts()):

					while(have_posts()):the_post();?>

					

						<h3><?php the_title();?></h3>

						<article class="content">

						<header>
							<?php 
							if(has_post_thumbnail()):
								the_post_thumbnail('blogthumb',array('class'=>'image allrounded','style'=>'vertical-align:center'));
							endif;?>
										<div class="entry-meta">

											<div class="postmetadata">

											

												<div class="postdate"><img src="<?php bloginfo('template_url'); ?>/images/date.png" /> <?php the_time('F jS, Y') ?> <img src="<?php bloginfo('template_url'); ?>/images/user.png" /> <?php the_author() ?> <?php if (current_user_can('edit_post', $post->ID)) { ?> <img src="<?php bloginfo('template_url'); ?>/images/edit.png" /> <?php edit_post_link('Edit', '', ''); } ?>

																<?php

																	$tags_list = get_the_tag_list( '', ', ' );

																	if ( $tags_list ):

																?>

																<?php the_tags('<span class="tags">Tags: ', ', ', '</span>'); ?>

																<?php endif; ?>

																<?php //comments_popup_link( 'No comments yet', '1 comment', '% comments', 'post-comments', 'Comments are off for this post'); ?>

																

																



												</div>
												<div class="shareme">
													
												</div>	
									

											

											</div>

										</div><!-- .entry-meta -->

										

									</header>
									<?php the_content();?>
								</article>

					<?php endwhile;

				endif;

			?>

			

		</div>

		<div id="sidebar">

			<?php get_sidebar();?>

		</div>

	<div class="clear">&nbsp;</div>

	</section><div class="clear">&nbsp;</div>

<? get_footer();?>