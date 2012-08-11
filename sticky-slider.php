<?php
/**
 * Slider content
 *
 * Displays sticky posts in slider and newest posts after that in page template Slider.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */


/* Get the sticky posts. */
$sticky = get_option( 'sticky_posts' );

if ( ! empty( $sticky ) ) :
 
/* Show sticky posts in the slider. */
$args = array( 'post__in' => $sticky );
	
	$path_slider = new WP_Query( $args );

	if ( $path_slider->have_posts() ) : ?>
	
	<div class="wrap">
		
		<div id="slider-content" class="flexslider">
		
			<ul class="slides">
				
			<?php while ( $path_slider->have_posts() ) : $path_slider->the_post(); ?>
			
				<li>
				   
					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?> featured">
						
						<div class="slider-images">
							<?php if ( current_theme_supports( 'get-the-image' ) ) get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => 'path-slider-thumbnail', 'image_class' => 'path-slider', 'default_image' => trailingslashit( get_template_directory_uri() ) . 'images/path_default_slider_image.png', 'width' => 660, 'height' => 300 ) ); ?>	
						</div>
						
						<div class="slider-title">
						
							<header class="entry-header">
								<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
								<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">' . __( 'Published by [entry-author] on [entry-published] [entry-comments-link before=" | "] [entry-edit-link before=" | "]', 'path' ) . '</div>' ); ?>
							</header><!-- .entry-header -->
							
							<div class="entry-summary">
									<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
							
						</div><!-- .slider-title -->
						
					</article><!-- .featured-post -->	
				
				</li>
				
			<?php endwhile; ?>
			
			<?php wp_reset_postdata(); // Reset Query ?>
			
			</ul>
			
		</div><!-- #slider-content -->
			
	</div><!-- .wrap -->
	
	<?php endif; ?>
	
<?php endif; ?>