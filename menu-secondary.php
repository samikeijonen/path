<?php
/**
 * Secondary Menu Template
 *
 * Displays the Secondary Menu if it has active menu items.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
 
 if ( has_nav_menu( 'secondary' ) ) : ?>
 
	<?php do_atomic( 'before_menu_secondary' ); // path_before_menu_secondary ?>
	
	<nav id="menu-secondary-title" class="nav-anchors">
	
		<div class="wrap">
		
			<a id="menu-secondary-anchor" class="menu-secondary-anchor" title="<?php _e( 'Secondary Mobile Menu', 'path' ); ?>" href="#menu-secondary-mobile"><?php _e( 'Secondary Menu', 'path' ); ?></a>

		</div><!-- .wrap -->
	
	</nav><!-- #menu-secondary-title -->
 
	<nav id="menu-secondary" class="menu-container">

		<div class="wrap">
				
			<?php do_atomic( 'open_menu_secondary' ); // path_open_menu_secondary ?>
					
			<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-secondary-items', 'fallback_cb' => '' ) ); ?>
				
			<?php do_atomic( 'close_menu_secondary' ); // path_close_menu_secondary ?>
				
		</div><!-- .wrap -->

	</nav><!-- #menu-secondary .menu-container -->
	
	<?php do_atomic( 'after_menu_secondary' ); // path_after_menu_secondary ?>
	
<?php endif; ?>