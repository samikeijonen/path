<?php
/**
 * Subsidiary Menu Template
 *
 * Displays the Subsidiary Menu if it has active menu items.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_menu_subsidiary' ); // path_before_menu_subsidiary ?>

	<nav id="menu-subsidiary" class="menu-container">
		
		<div class="wrap">

			<?php do_atomic( 'open_menu_subsidiary' ); // path_open_menu_subsidiary ?>

			<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-subsidiary-items', 'depth' => 1, 'fallback_cb' => '' ) ); ?>

			<?php do_atomic( 'close_menu_subsidiary' ); // path_close_menu_subsidiary ?>
		
		</div><!-- .wrap -->

	</nav><!-- #menu-subsidiary .menu-container -->

	<?php do_atomic( 'after_menu_subsidiary' ); // path_after_menu_subsidiary ?>

<?php endif; ?>