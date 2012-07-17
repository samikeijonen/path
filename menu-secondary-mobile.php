<?php
/**
 * Secondary Menu Mobile Template
 *
 * Displays the Secondary Menu Mobile if it has active menu items.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
 
 if ( has_nav_menu( 'secondary' ) ) : ?>
 
	<?php do_atomic( 'before_menu_secondary_mobile' ); // path_before_menu_secondary_mobile ?>
 
		<nav id="menu-secondary-mobile" class="menu-container">

			<div class="wrap">
				
				<?php do_atomic( 'open_menu_secondary_mobile' ); // path_open_menu_secondary_mobile ?>
				
				<h3 class="menu-secondary-mobile-title"><?php _e( 'Secondary Menu', 'path' ); ?></h3>
					
				<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => 'menu-mobile', 'menu_class' => '', 'menu_id' => 'menu-secondary-mobile-items', 'fallback_cb' => '' ) ); ?>
				
				<?php do_atomic( 'close_menu_secondary_mobile' ); // path_close_menu_secondary_mobile ?>
						
			</div><!-- .wrap -->

		</nav><!-- #menu-secondary-mobile .menu-container -->
	
	<?php do_atomic( 'after_menu_secondary_mobile' ); // path_after_menu_secondary_mobile ?>
	
<?php endif; ?>