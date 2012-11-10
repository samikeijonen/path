<?php
/**
 * Most viewed posts widget.
 *
 * @package Path
 * @subpackage Includes
 * @since 0.1.4
 * @author Justin Tadlock <justin@justintadlock.com>
 * @author Sami Keijonen <sami.keijonen@foxnet.fi>
 * @copyright Copyright (c) 2012, Justin Tadlock
 * @link: http://themeforest.net/item/unique-customizable-wordpress-magazine-theme/3004185?ref=greenshady
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Most viewed posts widget.
 *
 * @since 0.1.4
 */
class Path_Widget_Most_Viewed extends WP_Widget {

	/**
	 * Set up the widget's path name, ID, class, description, and other options.
	 *
	 * @since 0.1.4
	 */
	function __construct() {

		/* Set up the widget options. */
		$widget_options = array(
			'classname' => 'most-viewed',
			'description' => __( 'Display top viewed posts.', 'path' )
		);

		/* Set up the widget control options. */
		$control_options = array(
			'width' => 250,
			'height' => 350,
			'id_base' => 'most-viewed'
		);

		/* Create the widget. */
		$this->WP_Widget( 'most-viewed', __( 'Most Viewed', 'path' ), $widget_options, $control_options );
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.1.4
	 */
	function widget( $sidebar, $instance ) {
		extract( $sidebar );

		/* Arguments for the query. */
		$args = array(
			'orderby' => 'meta_value_num',
			'order' => 'DESC',
			'post_type' => ( isset( $instance['post_type'] ) ? $instance['post_type'] : 'post' ),
			'posts_per_page' => ( isset( $instance['posts_per_page'] ) ? intval( $instance['posts_per_page'] ) : 10 ),
			'post_status' => array( 'publish', 'inherit' ),
			'ignore_sticky_posts' => true,
			'meta_key' => 'Views'
		);

		/* Only add arguments if they're set. */
		if ( !empty( $instance['day'] ) )
			$args['day'] = absint( $instance['day'] );
		if ( !empty( $instance['monthnum'] ) )
			$args['monthnum'] = absint( $instance['monthnum'] );
		if ( !empty( $instance['year'] ) )
			$args['year'] = absint( $instance['year'] );

		/* Open the before widget HTML. */
		echo $before_widget;

		/* Output the widget title. */
		if ( $instance['title'] )
			echo $before_title . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . $after_title;

		/* Query the popular posts. */
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {
		
			/* If thumbnail or byline or excerpt is set show article html. */
			if ( $instance['show_thumbnail'] || $instance['show_byline'] || $instance['show_excerpt'] ) {
						
				while ( $loop->have_posts() ) {
					$loop->the_post();
				
				?>
					
				<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
				
					<?php 
					if ( $instance['show_thumbnail'] ) {
						if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-smaller-thumbnail' ) );
					}
					?>
					
					<header class="entry-header">
						<?php the_title( '<a class="post-link" href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">', '</a> ' ); ?>
						<span class="views-number">
						<?php echo '(' . entry_views_get() . ')'; ?>
						<span>
					</header><!-- .entry-header -->
		
					<div class="entry-summary">
						<?php if ( $instance['show_excerpt'] ) the_excerpt(); ?>
						<?php if ( $instance['show_byline'] ) echo apply_atomic_shortcode( 'byline-most-viewed-widget', '<div class="byline">' . __( '[entry-author] [entry-published]', 'path' ) . '</div>' ); ?>
					</div><!-- .entry-summary -->
					
				</article><!-- .hentry -->
		
			<?php } // End while
			
			} // End if
			
			/* Else show list of titles. */
			else {

			echo '<ul class="xoxo most-viewed">';

			while ( $loop->have_posts() ) {
				$loop->the_post();

				/* Create a list item, add the post title (w/link) and view count (w/link). */
				echo '<li>';
				//if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-smaller-thumbnail' ) );
				the_title( '<a class="post-link" href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '">', '</a> ' );
				echo '<span class="views-number">';
				echo '(' . entry_views_get() . ')';
				echo '<span>';
				echo '</li>';
			
			} // End while

			echo '</ul>';
			
			} // End else
		}

		/* Close the after widget HTML. */
		echo $after_widget;
	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.1.4
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Set the instance to the new instance. */
		$instance = $new_instance;

		/* Sanitize input elements. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['year'] = strip_tags( $new_instance['year'] );
		$instance['posts_per_page'] = intval( $new_instance['posts_per_page'] );
		$instance['show_thumbnail'] = strip_tags( $new_instance['show_thumbnail'] );
		$instance['show_byline'] = strip_tags( $new_instance['show_byline'] );
		$instance['show_excerpt'] = strip_tags( $new_instance['show_excerpt'] );

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.1.4
	 */
	function form( $instance ) {

		/* Set up the defaults. */
		$defaults = array(
			'title' => __( 'Most Viewed', 'path' ),
			'post_type' => 'post',
			'posts_per_page' => 10,
			'year' => '',
			'monthnum' => '',
			'day' => '',
			'show_thumbnail' => 0,
			'show_byline' => 0,
			'show_excerpt' => 0,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$months = array( '', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 );
		$days = array( '', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31 );
		$post_types = get_post_types( array( 'public' => true ), 'objects' );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'path' ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><?php _e( 'Post Type:', 'path' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>">
				<?php foreach ( $post_types as $type ) {
					if ( post_type_supports( $type->name, 'views' ) || post_type_supports( $type->name, 'trackbacks' ) ) { ?>
						<option value="<?php echo esc_attr( $type->name ); ?>" <?php selected( $instance['post_type'], $type->name ); ?>><?php echo esc_html( $type->labels->singular_name ); ?></option>
					<?php }
				} ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>"><?php _e( 'Limit:', 'path' ); ?></label>
			<input style="float:right;width:66px;" type="text" class="widefat" id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo $instance['posts_per_page']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'year' ); ?>"><?php _e( 'Year:', 'path' ); ?></label>
			<input style="float:right;width:66px;" type="text" class="widefat" id="<?php echo $this->get_field_id( 'year' ); ?>" name="<?php echo $this->get_field_name( 'year' ); ?>" value="<?php echo $instance['year']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'monthnum' ); ?>"><?php _e( 'Month:', 'path' ); ?></label> 
			<select style="float:right;max-width:66px;" class="widefat" id="<?php echo $this->get_field_id( 'monthnum' ); ?>" name="<?php echo $this->get_field_name( 'monthnum' ); ?>">
				<?php foreach ( $months as $month ) { ?>
					<option value="<?php echo esc_attr( $month ); ?>" <?php selected( $instance['monthnum'], $month ); ?>><?php echo $month; ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'day' ); ?>"><?php _e( 'Day:', 'path' ); ?></label> 
			<select style="float:right;max-width:66px;" class="widefat" id="<?php echo $this->get_field_id( 'day' ); ?>" name="<?php echo $this->get_field_name( 'day' ); ?>">
				<?php foreach ( $days as $day ) { ?>
					<option value="<?php echo esc_attr( $day ); ?>" <?php selected( $instance['day'], $day ); ?>><?php echo $day; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<input type="checkbox" value="1" <?php checked( '1', $instance['show_thumbnail'] ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e( 'Display Thumbnail?' , 'path' ); ?></label> 
		</p>
		
		<p>
			<input type="checkbox" value="1" <?php checked( '1', $instance['show_byline'] ); ?> id="<?php echo $this->get_field_id( 'show_byline' ); ?>" name="<?php echo $this->get_field_name( 'show_byline' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_byline' ); ?>"><?php _e( 'Display Byline?' , 'path' ); ?></label> 
		</p>
		
		<p>
			<input type="checkbox" value="1" <?php checked( '1', $instance['show_excerpt'] ); ?> id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_excerpt' ); ?>"><?php _e( 'Display Excerpt?' , 'path' ); ?></label> 
		</p>

		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}

?>