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
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
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
	add_theme_support( 'hybrid-core-scripts', array( 'drop-downs' ) );
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
	'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/path_bg.png' 
	) );
	
	/* Add support for flexible headers. This means logo in this theme, not header image. @link http://make.wordpress.org/themes/2012/04/06/updating-custom-backgrounds-and-custom-headers-for-wordpress-3-4/ */
	$path_header_args = array(
	'flex-height' => true,
	'height' => 99,
	'flex-width' => true,
	'width' => 300,
	'default-image' => trailingslashit( get_template_directory_uri() ) . 'images/logo.png',
	'header-text' => false,
	//'wp-head-callback' => 'path_head_logo_style',
	);
 
	add_theme_support( 'custom-header', $path_header_args );
	
	/* Set content width. */
	hybrid_set_content_width( 600 );
	
	/* Add respond.js and  html5shiv.js for unsupported browsers. */
	add_action( 'wp_head', 'path_respond_html5shiv' );
	
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
	
	/* Filter footer settings. Add back to the top link. */
	add_filter( "{$prefix}_default_theme_settings", 'path_default_footer_settings' );
	
	/* Add after comments note for good mannners. */
	add_action( 'comment_form_before', 'path_comment_note' );
	
	/* Change [...] to ... Read more. */
	add_filter( 'excerpt_more', 'path_excerpt_more' );
	
	/* Modify excerpt lenght in front page template. */
	add_filter( 'excerpt_length', 'path_excerpt_length', 999 );
	
	/* Exclude sticky posts from home page. */
	add_action( 'pre_get_posts', 'path_exclude_sticky' );
	
	/* Create twitter contact method. */
	add_filter( 'user_contactmethods', 'path_twitter_method' );
	
	/* Add an author box after singular posts. */
	add_action( "{$prefix}_singular-post_after_singular", 'path_author_box', 11 );
	
	/* Filter byline. Use Coauthors list if exist. */
	add_filter( "{$prefix}_byline", 'path_byline' );
	
	/* Filter most viewed widget byline. Use Coauthors list if exist. */
	add_filter( "{$prefix}_byline-most-viewed-widget", 'path_byline_widget' );
	
	/* Add social media buttons after singular post entry. Facebook like, twitter tweet and google+. This uses Social Path Plugin. */
	add_action( "{$prefix}_singular-post_after_singular", 'path_add_social_media' );
	
	/* Add layout option in Customize. */
	add_action( 'customize_register', 'path_customize_register' );
	
	/* Add js to customize. */
	add_action( 'customize_preview_init', 'path_customize_preview_js' );

	/* Add css to customize. */
	add_action( 'wp_enqueue_scripts', 'path_customize_preview_css' );
	
	/* Register additional widgets. */
	add_action( 'widgets_init', 'path_register_widgets' );
	
}

/**
 * Function for help to unsupported browsers understand mediaqueries and html5.
 * @link: https://github.com/scottjehl/Respond
 * @link: http://code.google.com/p/html5shiv/
 * @since 0.1.0
 */
function path_respond_html5shiv() {
	?>
	
	<!-- Enables media queries and html5 in some unsupported browsers. -->
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/respond/respond.min.js"></script>
	<script type="text/javascript" src="<?php echo trailingslashit( get_template_directory_uri() ); ?>js/html5shiv/html5shiv.js"></script>
	<![endif]-->
	
	<?php
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */
function path_one_column() {

	if ( ! ( is_active_sidebar( 'primary' ) || is_active_sidebar( 'secondary' ) )  || ( is_attachment() && 'layout-default' == theme_layouts_get_layout() ) )
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
	global $wp_query, $wp_customize;

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {
		if ( ! isset( $wp_customize ) ) {
			if ( 'layout-1c' == theme_layouts_get_layout() ) {
				$sidebars_widgets['primary'] = false;
				$sidebars_widgets['secondary'] = false;
			}
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

	add_image_size( 'path-thumbnail', 300, 170, true );
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
 * Path uses FitVids for responsive videos and FlexSlider for Slider.
 * @link http://fitvidsjs.com/
 * @link https://github.com/woothemes/FlexSlider/
 * @since 0.1.0
 */
function path_scripts() {

	$sticky = get_option( 'sticky_posts' );
	
	if ( !is_admin() ) {
		
		/* Enqueue FitVids */
		wp_enqueue_script( 'path-fitvids', trailingslashit( get_template_directory_uri() ) . 'js/fitvids/jquery.fitvids.js', array( 'jquery' ), '20120625', true );
		wp_enqueue_script( 'path-fitvids-settings', trailingslashit( get_template_directory_uri() ) . 'js/fitvids/fitvids.js', array( 'path-fitvids' ), '20120625', true );
		
		/* Enqueue FlexSlider js only when it is used. */
		if ( ! empty( $sticky ) && !is_paged() && ( is_home() || is_page_template( 'page-templates/path-slider.php' ) ) ) {
			wp_enqueue_script( 'path-flexslider', trailingslashit( get_template_directory_uri() ) . 'js/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '20120703', true );
			wp_enqueue_script( 'path-flexslider-settings', trailingslashit( get_template_directory_uri() ) . 'js/flexslider/settings.flexslider.js', array( 'path-flexslider' ), '20120703', true );
		}
		
		/* Enqueue FlexSlider css only when it is used. */
		if ( ! empty( $sticky ) && !is_paged() && ( is_home() || is_page_template( 'page-templates/path-slider.php' ) ) )
			wp_enqueue_style( 'path-flexslider-stylesheet', trailingslashit( get_template_directory_uri() ) . 'css/flexslider/flexslider.css', false, 1.0, 'screen' );
		
		/* Dequeue Pullquote Shortcode plugin styles and add them in style.css. */
		wp_dequeue_style( 'pullquote-shortcode' );
		
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
 * Filter Hybrid footer settings. Add back to top link.
 * @since 0.1.0
 */
function path_default_footer_settings( $settings ) {
    
    $settings['footer_insert'] = '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link].', 'path' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Powered by [wp-link] and [theme-link].', 'path' ) . __( ' <a class="top" href="#container">Back to Top</a>', 'path' ) . '</p>';
    
    return $settings;
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
 * Change [...] to ... Read more.
 * @since 0.1.0
 */
function path_excerpt_more() {

	return '...<span class="path-read-more"><a class="more-link" href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">  ' . __( 'Read more &rarr;', 'path' ) . ' </a></span>';
	 
}

/**
 * Change excerpt length in slider template and home page. 
 * @since 0.1.0
 */
function path_excerpt_length( $length ) {

	/* if is sticky posts. */
	if ( is_sticky() && is_home() || is_page_template( 'page-templates/path-slider.php' ) )
		return 30;
	else
		return 60;
	
}

/**
 * Exclude sticky posts from home page. Sticky posts are in a slider.
 * @since 0.1.0
 */
function path_exclude_sticky( $query ) {
	
	/* Exclude if is home and is main query. */
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post__not_in', get_option( 'sticky_posts' ) );
	
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
		/* If Co-Authors Plus Plugin is activated, use it. Else use normal author box. */
		if( function_exists( 'coauthors_posts_links' ) ) {
			
			$i = new CoAuthorsIterator();
			print $i->count() == 1 ? '<h4>' . __( 'Author of the article', 'path' ) . '</h4> ' : '<h4>' . __( 'Authors of the article', 'path' ) . '</h4> ';
			
			$i->iterate(); ?>
			
			<div class="author-co-profile">
			
				<?php
				the_author_posts_link();
				echo get_avatar( get_the_author_meta( 'user_email' ), '96' );
				?>
			
				<p class="author-description author-bio">
					<?php the_author_meta( 'description' ); ?>
				</p>
			
				<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
					<p class="twitter <?php if ( $i->count() > 1 ) echo 'multi-author'; ?>">
						<?php printf( __( 'Follow %1$s %2$s &#64;%3$s on Twitter.', 'path' ), '<a href="http://twitter.com/' . get_the_author_meta( 'twitter' ) . '"', 'title="' . get_the_author_meta( 'display_name' ) . '">', get_the_author_meta( 'twitter' ) . '</a>' ); ?>
					</p>
				<?php } // End check for twitter ?>
				
			</div>
			
			<?php while( $i->iterate() ) { ?>
			
			<div class="author-co-profile">
			
				<?php
				the_author_posts_link();
				echo get_avatar( get_the_author_meta( 'user_email' ), '96' );
				?>
				
				<p class="author-description author-bio">
					<?php the_author_meta( 'description' ); ?>
				</p>
				
				<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
					<p class="twitter <?php if ( $i->count() > 2 ) echo 'multi-author'; ?>">
						<?php printf( __( 'Follow %1$s %2$s &#64;%3$s on Twitter.', 'path' ), '<a href="http://twitter.com/' . get_the_author_meta( 'twitter' ) . '"', 'title="' . get_the_author_meta( 'display_name' ) . '">', get_the_author_meta( 'twitter' ) . '</a>' ); ?>
					</p>
				<?php } // End check for twitter ?>
				
			</div>
			
			<?php } // end while
		}
		else { ?>

			<h4 class="author-name fn n"><?php echo do_shortcode( __( 'Article written by [entry-author]', 'path' ) ); ?></h4>

			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '96' ); ?>

			<p class="author-description author-bio">
				<?php the_author_meta( 'description' ); ?>
			</p>

			<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
				<p class="twitter">
					<?php printf( __( 'Follow %1$s %2$s &#64;%3$s on Twitter.', 'path' ), '<a href="http://twitter.com/' . get_the_author_meta( 'twitter' ) . '"', 'title="' . get_the_author_meta( 'display_name' ) . '">', get_the_author_meta( 'twitter' ) . '</a>' ); ?>
				</p>
			<?php } // End check for twitter
			
		} // End else ?>
		
	</div>
		
	<?php
}

/**
 * Filter byline. If Co author plus plugin exists, use coauthors_posts_links()-function in byline. Else use basic stuff.
 * @since 0.1.0
 */
function path_byline( $byline ) {
	
	if( function_exists( 'coauthors_posts_links' ) ) {
	
		$byline = '<div class="byline">';
		$byline.= coauthors_posts_links( $between = ', ', $betweenLast = ' ' . __( 'and', 'path' ) . ' ', $before = null, $after = null, $echo = false );
		$byline.=  __( ' [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' );
		$byline.= '</div>';
		
	}
	
	return $byline;
	
}

/**
 * Filter byline in most viewed widget. If Co author plus plugin exists, use coauthors_posts_links()-function in byline. Else use basic stuff.
 * @since 0.1.4
 */
function path_byline_widget( $byline ) {
	
	if( function_exists( 'coauthors_posts_links' ) ) {
	
		$byline = '<div class="byline">';
		$byline.= coauthors_posts_links( $between = ', ', $betweenLast = ' ' . __( 'and', 'path' ) . ' ', $before = null, $after = null, $echo = false );
		$byline.=  __( ' [entry-published]', 'path' );
		$byline.= '</div>';
		
	}
	
	return $byline;
	
}

/**
 * Add social media buttons after singular post entry. Facebook like, twitter tweet and google+. This uses Social Path Plugin.
 *
 * @since 0.1.0
 */
function path_add_social_media() {

	if ( function_exists( 'social_path_media' ) )
		social_path_media();
	
}

/**
 * Add layout option in theme Customize.
 * @link: http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * @since 0.1.0
 */
function path_customize_register( $wp_customize ) {
	
	/* Get blogname and blogdescription settings. */
	
	// if header image is not set
	if ( ! get_header_image() ) {
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	}
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
}

/**
 * This make Theme Customizer live preview reload changes asynchronously.
 * Used with blogname, blogdescription and global layout.
 * @note: credit goes to TwentyEleven theme.
 * @since 0.1.0
 */
function path_customize_preview_js() {

	wp_enqueue_script( 'path-customizer', trailingslashit( get_template_directory_uri() ) . 'js/customize/path-customizer.js', array( 'customize-preview' ), '20120731', true );
	
}

/**
 * Gets posts from last 30 days.
 * @link http://codex.wordpress.org/Class_Reference/WP_Query#Time_Parameters
 * @since 0.1.0
 */
function path_filter_where( $where = '' ) {

	if ( is_page_template( 'page-templates/most-popular-last-30-days.php' ) ) {	
		$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
		return $where;
	}
	
}

/**
 * This make Theme Customizer live preview work with 1 column layout.
 * Used with Primary and Secondary sidebars.
 * 
 * @since 0.1.4
 */
function path_customize_preview_css() {
	global $wp_customize;

	if ( isset( $wp_customize ) ) {
	
		wp_enqueue_style( 'path-customizer-stylesheet', trailingslashit( get_template_directory_uri() ) . 'css/customize/path-customizer.css', false, 20121015, 'screen' );

	}
}

/**
 * Loads extra widget files and registers the widgets.
 * 
 * @since 0.1.4
 * @access public
 * @return void
 */
function path_register_widgets() {

	/* Load and register the most-viewed posts widget. */
	require_once( trailingslashit( THEME_DIR ) . 'includes/widget-most-viewed.php' );
	register_widget( 'Path_Widget_Most_Viewed' );

}

?>