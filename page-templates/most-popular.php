<?php
/**
 * Template Name: Most Popular
 *
 * Displays most popular posts in all time.
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
			
			$wp_query = new WP_Query( $args );
			
			?>
			
			<?php if ( $wp_query->have_posts() ) : ?>

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php do_atomic( 'before_entry' ); // path_before_entry ?>

					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
					
						<?php do_atomic( 'open_entry' ); // path_open_entry ?>

						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail' ) ); ?>

						<header class="entry-header">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' ) . '</div>' ); ?>
						</header><!-- .entry-header -->

						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-summary -->
						
						<footer class="entry-footer">
							<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Views [entry-views] [entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'path' ) . '</div>' ); ?>
						</footer><!-- .entry-footer -->
						
						<?php do_atomic( 'close_entry' ); // path_close_entry ?>

					</article><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // path_after_entry ?>

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