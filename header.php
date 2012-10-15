<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other templates call it 
 * somewhere near the top of the file. It is used mostly as an opening wrapper, which is closed with the 
 * footer.php file. It also executes key functions needed by the theme, child themes, and plugins.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<title><?php hybrid_document_title(); ?></title>

<!-- Mobile viewport optimized -->
<meta name="viewport" content="width=device-width,initial-scale=1" />

<!-- My styles -->
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); // wp_head ?>

</head>

<body class="<?php hybrid_body_class(); ?>">

	<?php do_atomic( 'open_body' ); // path_open_body ?>

	<div id="container">

		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

		<?php do_atomic( 'before_header' ); // path_before_header ?>

		<header id="header">

			<?php do_atomic( 'open_header' ); // path_open_header ?>

			<div class="wrap">

				<hgroup id="branding">
				
					<?php if ( get_header_image() ) { /* if header image is set use it as logo. */ ?>
						
						<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></h1>
					
					<?php } else { ?>
					
						<h1 id="site-title"><a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					
					<?php }  ?>
					
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					
				</hgroup><!-- #branding -->

				<?php do_atomic( 'header' ); // path_header ?>

			</div><!-- .wrap -->

			<?php do_atomic( 'close_header' ); // path_close_header ?>

		</header><!-- #header -->

		<?php do_atomic( 'after_header' ); // path_after_header ?>

		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>
		
		<?php do_atomic( 'before_main' ); // path_before_main ?>

		<div id="main">
		
		<?php if ( ( is_home() || is_page_template( 'page-templates/path-slider.php' ) ) && !is_paged() ) get_template_part( 'sticky-slider' ); // Loads the sticky-slider.php template. ?>
		
		<?php get_sidebar( 'before-content' ); // Loads the sidebar-before-content.php template. ?>

			<div class="wrap">

			<?php do_atomic( 'open_main' ); // path_open_main ?>

			<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'container' => 'nav', 'before' => __( 'You are here:', 'path' ), 'separator'  => __( '&#8764;', 'path' ) ) ); ?>