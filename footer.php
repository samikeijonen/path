<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
?>
				<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

				<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>

				<?php do_atomic( 'close_main' ); // path_close_main ?>

			</div><!-- .wrap -->
			
			<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
			
			<?php get_template_part( 'menu', 'primary-mobile' ); // Loads the menu-primary-mobile.php template. ?>
		
			<?php get_template_part( 'menu', 'secondary-mobile' ); // Loads the menu-secondary-mobile.php template. ?>

		</div><!-- #main -->

		<?php do_atomic( 'after_main' ); // path_after_main ?>

		<?php do_atomic( 'before_footer' ); // path_before_footer ?>

		<footer id="footer">

			<?php do_atomic( 'open_footer' ); // path_open_footer ?>

			<div class="wrap">

				<div class="footer-content">
					<?php hybrid_footer_content(); ?>
				</div>

				<?php do_atomic( 'footer' ); // path_footer ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_footer' ); // path_close_footer ?>

		</footer><!-- #footer -->

		<?php do_atomic( 'after_footer' ); // path_after_footer ?>

		<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

	</div><!-- #container -->

	<?php do_atomic( 'close_body' ); // path_close_body ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>