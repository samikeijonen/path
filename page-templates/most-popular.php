<?php
/**
 * Template Name: Most Popular
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
						
			$args = array (
				'ignore_sticky_posts' => true,
				'meta_key' => 'Views',
				'orderby' => 'meta_value_num',
				'posts_per_page' => get_option( 'posts_per_page' ),
				'paged' => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 )
			);
			
			$popular_query = new WP_Query( $args );
			
			/* @link http://wordpress.stackexchange.com/questions/54509/query-with-pre-get-posts-to-get-pagination */
			global $wp_query;
			// Put default query object in a temp variable
			$tmp_query = $wp_query;
			// Now wipe it out completely
			$wp_query = null;
			// Re-populate the global with our custom query
			$wp_query = $popular_query;
			
			?>
			
			<?php if ( $popular_query->have_posts() ) : ?>

				<?php while ( $popular_query->have_posts() ) : $popular_query->the_post(); ?>

					<?php do_atomic( 'before_entry' ); // path_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-thumbnail' ) );?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						
						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' ) . '</div>' ); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-summary -->
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Views [entry-views] [entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'path' ) . '</div>' ); ?>
						
						<?php do_atomic( 'close_entry' ); // path_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // path_after_entry ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>
						
		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // path_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>
		
		<?php $wp_query = $tmp_query; // Restore original query object ?>
		
		<?php wp_reset_postdata(); // Reset Query ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // path_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>