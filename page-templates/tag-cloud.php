<?php
/**
 * Template Name: Tag Cloud
 *
 * Displays Post Tag Cloud.
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
			
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // path_before_entry ?>

					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
					
						<?php do_atomic( 'open_entry' ); // path_open_entry ?>

						<header class="entry-header">
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						</header><!-- .entry-header -->
						
						<div class="entry-content">
								
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'path' ) ); ?>
								
							<p class="term-cloud post_tag-cloud tag-cloud">
								<?php wp_tag_cloud( array( 'number' => 0, 'unit' => 'em', 'smallest' => 0.7, 'largest' => 2 ) ); ?>
							</p><!-- .term-cloud .post_tag-cloud -->
	
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
								
						</div><!-- .entry-content -->
						
						<footer class="entry-footer">
							<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
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

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // path_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>