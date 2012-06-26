<?php
/**
 * Secondary Sidebar Template
 *
 * Displays widgets for the secondary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

if ( is_active_sidebar( 'secondary' ) ) : ?>

	<?php do_atomic( 'before_sidebar_secondary' ); // path_before_sidebar_secondary ?>

	<div id="sidebar-secondary" class="sidebar">

		<?php do_atomic( 'open_sidebar_secondary' ); // path_open_sidebar_secondary ?>

		<?php dynamic_sidebar( 'secondary' ); ?>

		<?php do_atomic( 'close_sidebar_secondary' ); // path_close_sidebar_secondary ?>
	
	</div><!-- #sidebar-secondary -->

	<?php do_atomic( 'after_sidebar_secondary' ); // path_after_sidebar_secondary ?>

<?php endif; ?>