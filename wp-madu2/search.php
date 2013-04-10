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
					
						<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<article class="content">
							<header>
										<div class="entry-meta">
											<div class="postmetadata">
											
												<div class="postdate">
													<img src="<?php bloginfo('template_url'); ?>/images/date.png" /> <?php the_time('F jS, Y') ?> <img src="<?php bloginfo('template_url'); ?>/images/user.png" /> <?php the_author() ?> <?php if (current_user_can('edit_post', $post->ID)) { ?> <img src="<?php bloginfo('template_url'); ?>/images/edit.png" /> <?php edit_post_link('Edit', '', ''); } ?>
																<?php
																	$tags_list = get_the_tag_list( '', ', ' );
																	if ( $tags_list ):
																?>
																<?php the_tags('<span class="tags">Tags: ', ', ', '</span>'); ?>
																<?php endif; ?>
																<?php //comments_popup_link( 'No comments yet', '1 comment', '% comments', 'post-comments', 'Comments are off for this post'); ?>
												</div>
											</div>
										</div><!-- .entry-meta -->
							</header>
							<?php my_excerpt(30);?>
							<span class="button"><a class="button" href="<?php the_permalink();?>">More ></a></span>
							<div class="clearfix">&nbsp;</div>
						</article>
					<?php endwhile;
					 if (function_exists('page_navi')) { // if expirimental feature is active ?>
							
							<?php page_navi(); // use the page navi function ?>
							
						<?php } else { // if it is disabled, display regular wp prev & next links ?>
							<nav class="wp-prev-next">
								<ul class="clearfix">
									<li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
									<li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
								</ul>
							</nav>
						<?php }
				else:
				
				?>
				<article class="content">
					
					
					 <h1 class="center" style="font-size:40px">TIDAK KETEMU</h1>
					 <h3 style="font-family:'PTSansNarrowBold';text-transform:capitalize;" >Maaf,  Anda tidak menemukan apa yang Anda cari disini...</h3>
					 <?php include (TEMPLATEPATH . "/searchform.php"); ?>
									
				</article>
				<?php endif;
			?>
			
		</div>
		<div id="sidebar">
			<?php get_sidebar();?>
		</div>
	<div class="clear">&nbsp;</div>
	</section><div class="clear">&nbsp;</div>
<? get_footer();?>