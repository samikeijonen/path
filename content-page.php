<?php
/**
 * Page Content Template
 *
 * Template used for 'page' post type.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

do_atomic( 'before_entry' ); // path_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // path_open_entry ?>

	<?php if ( is_singular() ) { ?>

		<header class="entry-header">
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[entry-edit-link]</div>' ); ?>
		</footer><!-- .entry-footer -->
			
	<?php } else { ?>

		<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-thumbnail' ) ); ?>

		<header class="entry-header">
			<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
		</header><!-- .entry-header -->
		
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-summary -->

	<?php } ?>

	<?php do_atomic( 'close_entry' ); // path_close_entry ?>

</article><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // path_after_entry ?>