<?php
/**
 * Attachment Template
 *
 * This is the default image attachment template.
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
						
							<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'class' => 'aligncenter' ) ); ?>
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'path' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
							
						</div><!-- .entry-content -->
						
						<footer class="entry-footer">
							<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( 'Published on [entry-published] [entry-edit-link before="| "]', 'path' ) . '</div>' ); ?>
						</footer><!-- .entry-footer -->
						
						<?php do_atomic( 'close_entry' ); // path_close_entry ?>

					</article><!-- .hentry -->
					
					<?php do_atomic( 'after_entry' ); // path_after_entry ?>
					
					<div class="attachment-meta">
					
						<?php $gallery = do_shortcode( sprintf( '[gallery id="%1$s" exclude="%2$s" columns="8"]', $post->post_parent, get_the_ID() ) ); ?>
						
						<?php if ( !empty( $gallery ) ) { ?>
							<div class="image-gallery">
								<h3><?php _e( 'Gallery', 'path' ); ?></h3>
								<?php echo $gallery; ?>
							</div>
						<?php } ?>
						
					</div><!-- .attachment-meta -->
						
					<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

					<?php do_atomic( 'after_singular' ); // path_after_singular ?>

					<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // path_close_content ?>
		
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // path_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>