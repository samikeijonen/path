<?php
/**
 * The functions.php file is used to initialize everything in the theme. It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters. If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).
 *
 * @package Path
 * @subpackage Functions
 * @version 0.1.0
 * @author Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2012, Sami Keijonen
 * @link http://foxnet.fi
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/* Load Hybrid Core theme framework. */
require_once( trailingslashit( TEMPLATEPATH ) . 'library/hybrid.php' );
new Hybrid();

/* Theme setup function using 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'path_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function path_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();
	
	/* Add theme settings. */
	if ( is_admin() )
	    require_once( trailingslashit ( get_template_directory() ) . 'admin/functions-admin.php' );

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'after-singular', 'before-content', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'about', 'footer' ) );
	add_theme_support( 'hybrid-core-drop-downs' );
	add_theme_support( 'hybrid-core-seo' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	
	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c' ) );
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'dev-stylesheet' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'entry-views' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'cleaner-caption' );
	
	/* Add theme support for WordPress features. */
	
	/* Add content editor styles. */
	add_editor_style( 'css/editor-style.css' );
	
	/* Add support for auto-feed links. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Add support for post formats. */
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) );
	
	/* Add custom background feature. */
	add_theme_support( 'custom-background', array(
	// Background default color
	'default-color' => 'e9edf1',
	// Background image default
	'default-image' => get_template_directory_uri() . '/images/path_bg.png' 
	) );
	
	/* Add support for flexible headers. This means logo in this theme, not header image. @link http://make.wordpress.org/themes/2012/04/06/updating-custom-backgrounds-and-custom-headers-for-wordpress-3-4/ */
	$path_header_args = array(
	'flex-height' => true,
	'height' => 99,
	'flex-width' => true,
	'width' => 300,
	'default-image' => get_template_directory_uri() . '/images/logo.png',
	'header-text' => false,
	//'wp-head-callback' => 'path_head_logo_style',
	);
 
	add_theme_support( 'custom-header', $path_header_args );
	
	/* Set content width. */
	hybrid_set_content_width( 600 );
	
	/* Add respond.js for unsupported browsers. */
	add_action( 'wp_head', 'path_respond_mediaqueries' );
	
	/* Disable primary sidebar widgets when layout is one column. */
	add_filter( 'sidebars_widgets', 'path_disable_sidebars' );
	add_action( 'template_redirect', 'path_one_column' );
	
	/* Add custom image sizes. */
	add_action( 'init', 'path_add_image_sizes' );
	
	/* Add <blockquote> around quote posts if user have forgotten about it. */
	add_filter( 'the_content', 'path_quote_content' );
	
	/* Enqueue script. */
	add_action( 'wp_enqueue_scripts', 'path_scripts' );
	
	/* Enqueue Google fonts */
	add_action( 'wp_enqueue_scripts', 'path_google_fonts' );
	
	/* Set logo under Appearance >> Header to site title. */
	add_filter( "{$prefix}_site_title", 'path_site_title' );
	
	/* Filter footer settings. Add back to the top link. */
	add_filter( "{$prefix}_default_theme_settings", 'path_default_footer_settings' );
	
	/* Set global layout. */
	add_filter( 'get_theme_layout', 'path_theme_layout' );
	
	/* Add after comments note for good mannners. */
	add_action( 'comment_form_before', 'path_comment_note' );
	
	/* Create twitter contact method. */
	add_filter( 'user_contactmethods', 'path_twitter_method' );
	
	/* Add an author box after singular posts. */
	add_action( "{$prefix}_singular-post_after_singular", 'path_author_box', 11 );
	
}

/**
 * Add logo styles if logo is added.
 * @link http://css-tricks.com/examples/ImageReplacement/
 * @since 0.1.0
 */
function path_head_logo_style() {

	/* Get header image url, width and height. */
	$path_logo_image_url = get_header_image();
	$path_header_image_width  = get_custom_header()->width;
	$path_header_image_height = get_custom_header()->height;
	
	?>
	
	<style type="text/css">
		.custom-header #site-title {
		max-width: <?php echo $path_header_image_width; ?>px;
		height: auto;
	}
	.custom-header #site-title a {
		background: url(<?php echo $path_logo_image_url; ?>) 50% 50%;
		-webkit-background-size: auto;
		-moz-background-size: auto;
		background-size: auto;
		display: block;
		overflow: hidden;
		text-indent: -9999em;
		white-space: nowrap;
		max-width: <?php echo $path_header_image_width; ?>px;
		height: <?php echo $path_header_image_height; ?>px;
	}
	</style>
	
	<?php }

/**
 * Function for help to unsupported browsers understand mediaqueries.
 * @link: https://github.com/scottjehl/Respond
 * @since 0.1.0
 */
function path_respond_mediaqueries() {
	?>
	
	<!-- Enables media queries in some unsupported browsers. -->
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	
	<?php
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */
function path_one_column() {

	if ( !is_active_sidebar( 'primary' ) || ( is_attachment() && 'layout-default' == theme_layouts_get_layout() ) )
		add_filter( 'get_theme_layout', 'path_theme_layout_one_column' );

}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.1.0
 * @param string $layout The layout of the current page.
 * @return string
 */
function path_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 * @param array $sidebars_widgets A multidimensional array of sidebars and widgets.
 * @return array $sidebars_widgets
 */
function path_disable_sidebars( $sidebars_widgets ) {
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
	}

	return $sidebars_widgets;
}

/**
 * Adds custom image sizes for thumbnail images. 
 *
 * @since 0.1.0
 */
function path_add_image_sizes() {

	add_image_size( 'path-thumbnail', 194, 120, true );
	add_image_size( 'path-smaller-thumbnail', 80, 80, true );
	add_image_size( 'path-slider-thumbnail', 660, 300, true );
	
}

/**
 * Wraps the output of the quote post format content in a <blockquote> element if the user hasn't added a 
 * <blockquote> in the post editor.
 *
 * @since 0.1.0
 * @param string $content The post content.
 * @return string $content
 */
function path_quote_content( $content ) {

	if ( has_post_format( 'quote' ) ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}

/**
 * Path uses FitVids for responsive videos.
 * @link http://fitvidsjs.com/
 * @since 0.1.0
 */
function path_scripts() {
	
	if ( !is_admin() ) {
		
		/* Enqueue FitVids */
		wp_enqueue_script( 'path-fitvids', get_template_directory_uri() . '/js/fitvids/jquery.fitvids.js', array( 'jquery' ), '20120625', true );
		wp_enqueue_script( 'path-fitvids-settings', get_template_directory_uri() . '/js/fitvids/fitvids.js', array( 'path-fitvids' ), '20120625', true );
		
		/* Enqueue Flexslider */
		if ( is_page_template( 'page-templates/path-slider.php' ) ) {
			wp_enqueue_script( 'path-flexslider', get_template_directory_uri() . '/js/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '20120703', true );
			wp_enqueue_script( 'path-flexslider-settings', get_template_directory_uri() . '/js/flexslider/settings.flexslider.js', array( 'path-flexslider' ), '20120703', true );
		}
		
		/* Enqueue Styles */
		if ( is_page_template( 'page-templates/path-slider.php' ) )
			wp_enqueue_style( 'path-flexslider-stylesheet', get_template_directory_uri() . '/css/flexslider/flexslider.css', false, 1.0, 'screen' );
		
	}
}

/**
 * Enqueue Google fonts.
 *
 * @since 0.1.0
 */
function path_google_fonts() {
	
	wp_enqueue_style( 'font-oswald', 'http://fonts.googleapis.com/css?family=Oswald:400,300,700', false, 1.0, 'screen' );
	
}

/**
 * Grabs the first URL from the post content of the current post.  This is meant to be used with the link post 
 * format to easily find the link for the post. 
 *
 * @since 0.1.0
 * @return string The link if found.  Otherwise, the permalink to the post.
 *
 * @note This is a modified version of the twentyeleven_url_grabber() function in the TwentyEleven theme. And this modified version is from MyLife (themehybrid.com) theme.
 * @author wordpressdotorg
 * @copyright Copyright (c) 2011, wordpressdotorg
 * @link http://wordpress.org/extend/themes/twentyeleven
 * @license http://wordpress.org/about/license
 */
function path_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return get_permalink( get_the_ID() );

	return esc_url_raw( $matches[1] );
}

/**
 * Filter Hybrid site title and replace text with logo, which can be set under Appearance >> Header.
 * @since 0.1.0
 */
function path_site_title( $title ) {

	/* If viewing the front page of the site, use an <h1> tag. Otherwise, use a <div> tag. */
	$tag = ( is_front_page() ) ? 'h1' : 'div';
	
	/* Get header image url, width and height. */
	$path_logo_image_url = get_header_image();
	$path_header_image_width  = get_custom_header()->width;
	$path_header_image_height = get_custom_header()->height;
	
	$path_logo_image = '<img src="' .$path_logo_image_url .'" width="' . $path_header_image_width . '" height="' . $path_header_image_height . '" alt="' .  get_bloginfo( 'name' ) . '" />';

	if ( !empty( $path_logo_image_url ) ) {
	
		if ( $title = get_bloginfo( 'name' ) )
			$title = sprintf( '<%1$s id="site-title"><a href="%2$s" title="%3$s" rel="home">%4$s<span>%5$s</span></a></%1$s>', tag_escape( $tag ), home_url(), esc_attr( $title ), $path_logo_image, $title );
	
	} 
	else { 
	/* Get the site title.  If it's not empty, wrap it with the appropriate HTML. */
	if ( $title = get_bloginfo( 'name' ) )
		$title = sprintf( '<%1$s id="site-title"><a href="%2$s" title="%3$s" rel="home"><span>%4$s</span></a></%1$s>', tag_escape( $tag ), home_url(), esc_attr( $title ), $title );
	
	}
	
	return $title;
}

/**
 * Filter Hybrid footer settings. Add back to top link.
 * @since 0.1.0
 */
function path_default_footer_settings( $settings ) {
    
    $settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link].', 'path' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Powered by [wp-link] and [theme-link].', 'path' ) . __( ' <a class="top" href="#container">Back to Top</a>', 'path' ) . '</p>';
    
    return $settings;
}

/**
 * Filter global layout, which is defined under Appearance >> Theme Settings.
 * @since 0.1.0
 */
function path_theme_layout( $layout ) {

	/* Get global layout. */
	$path_global_layout = hybrid_get_setting( 'path_global_layout' );
	
	if ( !$path_global_layout )
		return $layout;

	if ( 'layout-default' == $layout )
		$layout = $path_global_layout;

	return $layout;
	
}

/**
 * Comment note for good manners.
 * @since 0.1.0
 */
function path_comment_note() { ?>

	<p class="comment-text comment-note"><?php _e( 'Please comment with your real name using good manners.', 'path' ); ?></p>

<?php
}

/**
 * Adds twitter on the edit user screen.
 * @since 0.1.0
 */
function path_twitter_method( $meta ) {

	$meta['twitter'] = __( 'Twitter Username', 'path' );
	return $meta;
	
}

/**
 * Adds an author box at the end of single posts.
 * @note if Co Author Plus plugin is found, use multiple Co Authors loop. Else use normal info.
 * @since 0.1.0
 */
function path_author_box() { ?>

	<div class="author-profile vcard">
	
		<?php
		
		if( function_exists( 'coauthors_posts_links' ) ) {
			
			$i = new CoAuthorsIterator();
			print $i->count() == 1 ? '<h4>' . __( 'Author of the article', 'path' ) . '</h4> ' : '<h4>' . __( 'Authors of the article', 'path' ) . '</h4> ';
			
			$i->iterate();
			the_author_posts_link();
			echo get_avatar( get_the_author_meta( 'user_email' ), '96' );
			
		?>
			
			<div class="author-description author-bio clear">
				<?php the_author_meta( 'description' ); ?>
			</div>
			
			<?php if ( get_the_author_meta( 'Twitter' ) ) { ?>
				<p class="twitter clear">
					<a href="http://twitter.com/<?php the_author_meta( 'twitter' ); ?>" title="<?php printf( esc_attr__( 'Follow %1$s on Twitter', 'path' ), get_the_author_meta( 'display_name' ) ); ?>"><?php printf( __( 'Follow %1$s on Twitter', 'path' ), get_the_author_meta( 'display_name' ) ); ?></a>
				</p>
			<?php } // End check for twitter 
			
			while( $i->iterate() ) {
			
				the_author_posts_link();
				echo get_avatar( get_the_author_meta( 'user_email' ), '96' );
				
				?>
				
				<div class="author-description author-bio clear">
					<?php the_author_meta( 'description' ); ?>
				</div>
				
				<?php if ( get_the_author_meta( 'Twitter' ) ) { ?>
					<p class="twitter clear">
						<a href="http://twitter.com/<?php the_author_meta( 'twitter' ); ?>" title="<?php printf( esc_attr__( 'Follow %1$s on Twitter', 'path' ), get_the_author_meta( 'display_name' ) ); ?>"><?php printf( __( 'Follow %1$s on Twitter', 'path' ), get_the_author_meta( 'display_name' ) ); ?></a>
					</p>
				<?php } // End check for twitter 
				
				} // end while
		}
		else {
		?>

			<h4 class="author-name fn n"><?php echo do_shortcode( __( 'Article written by [entry-author]', 'path' ) ); ?></h4>

			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '96' ); ?>

			<div class="author-description author-bio">
				<?php the_author_meta( 'description' ); ?>
			</div>

			<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
				<p class="twitter clear">
					<?php printf( __( 'Follow %1$s %2$s &#64;%3$s on Twitter.', 'path' ), '<a href="http://twitter.com/' . get_the_author_meta( 'twitter' ) . '"', 'title="' . get_the_author_meta( 'display_name' ) . '">', get_the_author_meta( 'twitter' ) . '</a>' ); ?>
				</p>
			<?php } // End check for twitter 
		} // End else
		?>
	</div>
	<?php
}

/**
 * Gets posts from last 30 days.
 * @link http://codex.wordpress.org/Class_Reference/WP_Query#Time_Parameters
 * @since 0.1.0
 */
function path_filter_where( $where = '' ) {
	
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
		return $where;
		
}

?>