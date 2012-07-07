<?php
/**
 * Template Name: Slider
 *
 * Displays sticky posts or newest posts in slider.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // path_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // path_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
			
			<?php
			
			/* Loop for most viewed articles. entry-views extension is used. */
			$sticky = get_option('sticky_posts');
						
			$args = array (
				'post__not_in' => $sticky,
				'posts_per_page' => get_option( 'posts_per_page' ),
				'paged' => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 )
			);
			
			$wp_query = new WP_Query( $args );
			
			?>
			
			<?php if ( $wp_query->have_posts() ) : ?>

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>
						
		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // path_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>
		
		<?php wp_reset_postdata(); // Reset Query ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // path_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>