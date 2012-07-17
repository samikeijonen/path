<?php
/**
 * Primary Menu Mobile Template
 *
 * Displays the Primary Menu Mobile if it has active menu items.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
 
 if ( has_nav_menu( 'primary' ) ) : ?>
 
	<?php do_atomic( 'before_menu_primary_mobile' ); // path_before_menu_primary_mobile ?>
 
		<nav id="menu-primary-mobile" class="menu-container">

			<div class="wrap">
			
				<div id="search-primary-mobile"><?php get_search_form(); // Loads the searchform.php template. ?></div>
				
				<?php do_atomic( 'open_menu_primary_mobile' ); // path_open_menu_primary_mobile ?>
				
				<h3 class="menu-primary-mobile-title"><?php _e( 'Primary Menu', 'path' ); ?></h3>
					
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu-mobile', 'menu_class' => '', 'menu_id' => 'menu-primary-mobile-items', 'fallback_cb' => '' ) ); ?>
				
				<?php do_atomic( 'close_menu_primary_mobile' ); // path_close_menu_primary_mobile ?>
						
			</div><!-- .wrap -->

		</nav><!-- #menu-primary-mobile .menu-container -->
	
	<?php do_atomic( 'after_menu_primary_mobile' ); // path_after_menu_primary_mobile ?>
	
<?php endif; ?>