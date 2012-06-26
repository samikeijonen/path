<?php
/**
 * Loop Error Template
 *
 * If no post are found, display error message.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
?>
	<div id="post-0" class="<?php hybrid_entry_class(); ?>">

		<div class="entry-content">

			<p><?php _e( 'Apologies, but no entries were found.', 'path' ); ?></p>

		</div><!-- .entry-content -->

	</div><!-- .hentry .error -->