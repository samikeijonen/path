<?php
/**
 * Template Name: Archives
 *
 * Displays blog archives.
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
								
								<?php $path_published_posts = wp_count_posts(); // How many posts have been published. ?>
								
								<p class="path-published-posts"><?php printf( __( 'There are %1$s posts published.', 'path' ), $path_published_posts->publish ); ?></p>
		
								<?php if ( function_exists( 'smart_archives' ) ) : smart_archives(); /* If Smart Archives Reloaded Plugin is active, use it. Else basic stuff. @link http://wordpress.org/extend/plugins/smart-archives-reloaded/ */ ?>
								
								<?php else : ?>
	
									<h2><?php _e( 'Archives by category', 'path' ); ?></h2>
	
									<ul class="xoxo category-archives">
									
										<?php wp_list_categories( array( 'feed' => __( 'RSS', 'path' ), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) ); ?>
									
									</ul><!-- .xoxo .category-archives -->
	
									<h2><?php _e( 'Archives by month', 'path' ); ?></h2>
	
									<ul class="xoxo monthly-archives">
									
										<?php wp_get_archives( array( 'show_post_count' => true, 'type' => 'monthly' ) ); ?>
									
									</ul><!-- .xoxo .monthly-archives -->
								
								<?php endif; ?>
	
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