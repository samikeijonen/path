<?php
/**
 * Before Content Sidebar Template
 *
 * Displays any widgets for the Before Content dynamic sidebar if they are available.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

if ( is_active_sidebar( 'before-content' ) ) : ?>
	
	<?php do_atomic( 'before_sidebar_before_content' ); // path_before_sidebar_before_content ?>

	<div id="sidebar-before-content" class="sidebar">
	
		<?php do_atomic( 'open_sidebar_before_content' ); // path_open_sidebar_before_content ?>
		
		<div class="wrap">

			<?php dynamic_sidebar( 'before-content' ); ?>
			
		</div><!-- .wrap -->
		
		<?php do_atomic( 'close_sidebar_before_content' ); // path_close_sidebar_before_content ?>

	</div><!-- #sidebar-before-content -->
	
	<?php do_atomic( 'after_sidebar_before_content' ); // path_after_sidebar_before_content ?>

<?php endif; ?>