<?php
/**
 * Quote Content Template
 *
 * Template used for 'quote' post format.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

do_atomic( 'before_entry' ); // path_before_entry ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // path_open_entry ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'path' ), 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php if ( is_singular() ) 
				echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] published on [entry-published] [entry-edit-link before="| "]<br />[entry-terms taxonomy="category" before="Posted in "] [entry-terms before="Tagged "]', 'path' ) . '</div>' );
			else
				echo apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">' . __( '[post-format-link] published on [entry-published] [entry-permalink before="| "] [entry-comments-link before="| "] [entry-edit-link before="| "]', 'path' ) . '</div>' );
			?>
		</footer><!-- .entry-footer -->

	<?php do_atomic( 'close_entry' ); // path_close_entry ?>

</article><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // path_after_entry ?>