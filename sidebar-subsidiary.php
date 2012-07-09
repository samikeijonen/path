<?php
/**
 * Subsidiary Sidebar Template
 *
 * Displays any widgets for the Subsidiary dynamic sidebar if they are available.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

if ( is_active_sidebar( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_sidebar_subsidiary' ); // path_before_sidebar_subsidiary ?>

	<div id="sidebar-subsidiary" class="sidebar">
	
		<?php do_atomic( 'open_sidebar_subsidiary' ); // path_open_sidebar_subsidiary ?>
		
		<div class="wrap">

			<?php dynamic_sidebar( 'subsidiary' ); ?>
			
		</div><!-- .wrap -->
		
		<?php do_atomic( 'close_sidebar_subsidiary' ); // path_close_sidebar_subsidiary ?>

	</div><!-- #sidebar-subsidiary -->
	
	<?php do_atomic( 'after_sidebar_subsidiary' ); // path_after_sidebar_subsidiary ?>

<?php endif; ?>