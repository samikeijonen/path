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

	<div id="sidebar-before-content" class="sidebar">
		
		<div class="wrap">

			<?php dynamic_sidebar( 'before-content' ); ?>
			
		</div><!-- .wrap -->

	</div><!-- #sidebar-before-content -->

<?php endif; ?>