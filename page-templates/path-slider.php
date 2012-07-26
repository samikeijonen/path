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
			
			/* Loop posts but not sticky ones. Sticky posts are displayd in the slider. That is called in header.php (sticky-slider.php). */
			$sticky = get_option('sticky_posts');
						
			$args = array (
				'post__not_in' => $sticky,
				'posts_per_page' => 10
			);
			
			$loop = new WP_Query( $args );
			$counter = 1;
			
			?>
			
			<?php if ( $loop->have_posts() ) : ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php do_atomic( 'before_entry' ); // path_before_entry ?>

					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); if ( ( $counter % 2 ) == 0 ) echo ' last'; ?>">
					
						<?php do_atomic( 'open_entry' ); // path_open_entry ?>

						<header class="entry-header">
							<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-thumbnail' ) ); ?>
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						</header><!-- .entry-header -->

						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-summary -->
						
						<footer class="entry-footer">
							<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' ) . '</div>' ); ?>
						</footer><!-- .entry-footer -->
						
						<?php do_atomic( 'close_entry' ); // path_close_entry ?>

					</article><!-- .hentry -->
					
					<?php if ( ( $counter % 2 ) == 0 ) echo '<div class="clear path-line"> </div>'; ?>

					<?php do_atomic( 'after_entry' ); // path_after_entry ?>
					
					<?php $counter++; ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>
			
			<?php wp_reset_postdata(); // Reset Query ?>
			
			<div class="hfeed-more-articles">
			
				<h3 class="section-title"><?php _e( 'More Articles', 'path' ); ?></h3>				
					
					<?php

					$args = array (
					'post__not_in' => $sticky, 
					'posts_per_page' => 20,
					'offset' => 10
					);
					
					$loop = new WP_Query( $args );
					$counter = 1;

					?>
					
					<?php if ( $loop->have_posts() ) : ?>
					
						<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		
							<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); if ( ( $counter % 2 ) == 0 ) echo ' last'; ?>">
							
								<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-smaller-thumbnail' ) ); ?>
										
								<header class="entry-header">
									<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' ) . '</div>' ); ?>
								</header><!-- .entry-header -->
								
							</article><!-- .hentry -->
							
							<?php if ( ( $counter % 2 ) == 0 ) echo '<div class="clear path-line"> </div>'; ?>
							
							<?php $counter++; ?>
		
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