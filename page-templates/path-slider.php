<?php
/**
 * Template Name: Slider
 *
 * Displays sticky posts in slider.
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
			
			/* Loop posts but not sticky ones. Sticky posts are displayd in the slider. That is called in header.php (content-slider.php). */
			$sticky = get_option('sticky_posts');
						
			$args = array (
				'post__not_in' => $sticky,
				'posts_per_page' => 10
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
			
			<?php wp_reset_postdata(); // Reset Query ?>
			
			<h3 class="section-title"><?php _e( 'More Articles', 'path' ); ?></h3>
				
				<div class="hfeed-more-articles">				
					
					<?php

					$args = array (
					'post__not_in' => $sticky, 
					'posts_per_page' => 20,
					'offset' => 10
					);
					
					$loop = new WP_Query( $args );

					?>
					
					<?php if ( $loop->have_posts() ) : ?>
					
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		
							<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
							
								<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-smaller-thumbnail' ) ); ?>
										
								<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
									
								<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' ) . '</div>' ); ?>
	
							</div><!-- .hentry -->
		
						<?php endwhile; ?>			
		
					<?php else : ?>
		
						<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>
		
					<?php endif; ?>

					<?php wp_reset_postdata(); // Reset Query ?>
		
				</div><!-- .hfeed-more -->
						
		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // path_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // path_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>