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

	<div id="sidebar-subsidiary" class="sidebar">
		
		<div class="wrap">

			<?php dynamic_sidebar( 'subsidiary' ); ?>
			
		</div><!-- .wrap -->

	</div><!-- #sidebar-subsidiary -->

<?php endif; ?>