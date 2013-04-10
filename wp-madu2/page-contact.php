<?php
/*
Template Name:Contact Template
*/
?>

<? get_header();?>
<div class="clear">&nbsp;</div>
	<section id="content">
		<div id="maincontent" class="full">
			<?php if (have_posts()):
					while(have_posts()):the_post();?>
						<h3><?php the_title();?></h3>
						<article class="content">
					
									<?php the_content();?>
								</article>
					<?php endwhile;
				endif;
			?>
			
		</div>
	
	<div class="clear">&nbsp;</div>
	</section><div class="clear">&nbsp;</div>
<? get_footer();?>