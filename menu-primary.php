<?php
/**
 * Primary Menu Template
 *
 * Displays the Primary Menu if it has active menu items.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
 
 if ( has_nav_menu( 'primary' ) ) : ?>
 
	<?php do_atomic( 'before_menu_primary' ); // path_before_menu_primary ?>
	
	<nav id="menu-primary-title" class="nav-anchors">
	
		<div class="wrap">
				
			<a id="menu-primary-anchor" class="menu-primary-anchor" title="<?php _e( 'Primary Mobile Menu', 'path' ); ?>" href="#menu-primary-mobile"><?php _e( 'Primary Menu', 'path' ); ?></a>
			
			<a id="search-primary-anchor" class="search-primary-anchor" title="<?php _e( 'Search', 'path' ); ?>" href="#search-primary-mobile"><?php _e( 'Search', 'path' ); ?></a>
			
		</div><!-- .wrap -->
	
	</nav><!-- #menu-primary-title -->
 
	<nav id="menu-primary" class="menu-container">

		<div class="wrap">
				
			<?php do_atomic( 'open_menu_primary' ); // path_open_menu_primary ?>	
					
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '' ) ); ?>
				
			<?php do_atomic( 'close_menu_primary' ); // path_close_menu_primary ?>
				
			<?php if ( !is_admin_bar_showing() ) get_search_form(); // Loads the searchform.php template. ?>
						
		</div><!-- .wrap -->

	</nav><!-- #menu-primary .menu-container -->
	
	<?php do_atomic( 'after_menu_primary' ); // path_after_menu_primary ?>
	
<?php endif; ?>