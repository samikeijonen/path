<?php
/**
 * After Singular Sidebar Template
 *
 * Displays any widgets for the After Singular dynamic sidebar if they are available.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

if ( is_active_sidebar( 'after-singular' ) ) : ?>

	<?php do_atomic( 'before_sidebar_after_singular' ); // path_before_sidebar_after_singular ?>

	<div id="sidebar-after-singular" class="sidebar">
	
		<?php do_atomic( 'open_sidebar_after_singular' ); // path_open_sidebar_after_singular ?>

		<?php dynamic_sidebar( 'after-singular' ); ?>
		
		<?php do_atomic( 'close_sidebar_after_singular' ); // path_close_after_singular ?>

	</div><!-- #sidebar-after-singular -->
	
	<?php do_atomic( 'after_sidebar_after_singular' ); // path_after_sidebar_after_singular ?>

<?php endif; ?>