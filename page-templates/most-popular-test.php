<?php
/**
 * Template Name: Most Popular Test
 *
 * @package PathChild
 * @subpackage Template
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // my-life_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // my-life_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
			
			<?php if ( $wp_query->have_posts() ) : ?>

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

					<?php do_atomic( 'before_entry' ); // my-life_before_entry ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'thumbnail' ) );?>

						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path-child' ) . '</div>' ); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'my-life' ), 'after' => '</p>' ) ); ?>
						</div><!-- .entry-summary -->
						
						<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Views [entry-views] [entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'path-child' ) . '</div>' ); ?>
						
						<?php do_atomic( 'close_entry' ); // my-life_close_entry ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // my-life_after_entry ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>
						
		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // my-life_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>
		
		<?php wp_reset_query(); // Reset Query ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // my-life_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>