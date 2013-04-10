<?php
/**
 * Template Name: Event Page
 * Description: Example for displaying events.
 *
 * These are example queries for displaying event posts
 * on your site.
 */
 
?>

<? get_header();?>
<div class="clear">&nbsp;</div>
	<section id="content">
		<div id="maincontent" class="full">
			<?php if (have_posts()):
					while(have_posts()):the_post();?>
	<article class="content">
			<li>
			<h4><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
			<ul>
				<li>Publish date: <?php the_date('M d Y'); ?></li>
				<?php 
				// Gets the event start month from the meta field
				$month = get_post_meta( $post->ID, '_start_month', true );
				// Converts the month number to the month name
				$month = $wp_locale->get_month_abbrev( $wp_locale->get_month( $month ) );
				// Gets the event start day
				$day = get_post_meta( $post->ID, '_start_day', true );
				// Gets the event start year
				$year = get_post_meta( $post->ID, '_start_year', true );
				?>
				<li>Event start date: <?php echo $month . ' ' . $day . ' ' . $year; ?></li>
				
			</ul>
			</li>
		</article>
		<?php endwhile;
		echo '</ul>';
	endif;
?>

<?php if ( get_next_posts_link() ) : ?>
	<div class="nav-previous"><?php next_posts_link( 'There\'s More Events <span class="meta-nav">&rarr;</span> ' ); ?></div>
<?php endif; ?>

<?php if ( get_previous_posts_link() ) : ?>
	<div class="nav-next"><?php previous_posts_link( '<span class="meta-nav">&larr;</span> Events You\'re About to Miss' ); ?></div>
<?php endif; ?>

<h3>Separate WP_Query</h3>

<p>This displays up to 20 event posts as a list.</p>

<?php
	 $args = array( 'post_type' => 'event',
	'meta_key' => '_start_eventtimestamp',
	'orderby'=> 'meta_value_num',
	'order' => 'ASC',
	'posts_per_page' => 20,
	 );
	 $events = new WP_Query( $args );
	
	if ( $events->have_posts() ) :
		echo '<ul>';
		while ( $events->have_posts() ) : $events->the_post();
			echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
			?>

				<li>Publish date: <?php the_date('M d Y'); ?></li>
				<?php 
				// Gets the event start month from the meta field
				$monthstart = get_post_meta( $post->ID, '_start_month', true );
				$monthend = get_post_meta( $post->ID, '_end_month', true );
				// Converts the month number to the month name
				$monthend = $wp_locale->get_month_abbrev( $wp_locale->get_month( $monthend ) );
				$monthstart = $wp_locale->get_month_abbrev( $wp_locale->get_month( $monthstart ) );
				// Gets the event start day
				$dayend = get_post_meta( $post->ID, '_end_day', true );
				$daystart = get_post_meta( $post->ID, '_start_day', true );
				// Gets the event start year
				$year = get_post_meta( $post->ID, '_start_year', true );
				?>
				<li>Waktu : <?php echo $daystart . ' ' .$monthstart  . ' - '.$dayend . ' ' .$monthend.' '.$year; ?></li>
		

			<?php
		endwhile;
		echo '</ul>';
	endif;
?>

	<div class="clear">&nbsp;</div>
	</section><div class="clear">&nbsp;</div>
<? get_footer();?>