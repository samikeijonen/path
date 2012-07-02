<?php
/**
 * Loop Meta Template
 *
 * Displays information at the top of the page about archive and search results when viewing those pages.  
 * It is not shown on the front page or singular views.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */
?>

	<?php if ( is_home() && !is_front_page() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php echo get_post_field( 'post_title', get_queried_object_id() ); ?></h1>

			<div class="loop-description">
				<?php echo apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', get_queried_object_id() ) ); ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_category() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php single_cat_title(); ?></h1>

			<div class="loop-description">
				<?php echo category_description(); ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_tag() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php single_tag_title(); ?></h1>

			<div class="loop-description">
				<?php echo tag_description(); ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_tax() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php single_term_title(); ?></h1>

			<div class="loop-description">
				<?php echo term_description( '', get_query_var( 'taxonomy' ) ); ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_author() ) : ?>

		<?php $user_id = get_query_var( 'author' ); ?>

		<div id="hcard-<?php echo esc_attr( get_the_author_meta( 'user_nicename', $user_id ) ); ?>" class="loop-meta vcard">

			<h1 class="loop-title fn n"><?php the_author_meta( 'display_name', $user_id ); ?></h1>
			
			<?php echo get_avatar( get_the_author_meta( 'user_email', $user_id ), '66' ); ?>

			<div class="loop-description">
				<?php echo wpautop( get_the_author_meta( 'description', $user_id ) ); ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_search() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php echo esc_attr( get_search_query() ); ?></h1>

			<div class="loop-description">
				<p>
				<?php printf( __( 'You are browsing the search results for "%s"', 'path' ), esc_attr( get_search_query() ) ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_date() ) : ?>

		<div class="loop-meta">
			<h1 class="loop-title"><?php _e( 'Archives by date', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing the site archives by date.', 'path' ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_post_type_archive() ) : ?>

		<?php $post_type = get_post_type_object( get_query_var( 'post_type' ) ); ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php post_type_archive_title(); ?></h1>

			<div class="loop-description">
				<?php if ( !empty( $post_type->description ) ) echo wpautop( $post_type->description ); ?>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php elseif ( is_archive() ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php _e( 'Archives', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing the site archives.', 'path' ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->
		
	<?php elseif ( is_page_template( 'page-templates/most-popular.php' ) ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php _e( 'Most popular', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing all time most viewed articles.', 'path' ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->
		
	<?php elseif ( is_page_template( 'page-templates/most-popular-by-year.php' ) ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php _e( 'Most popular by year', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php printf( __( 'You are browsing most viewed articles in the current year %d.', 'path' ), date( 'Y' ) ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->
		
	<?php elseif ( is_page_template( 'page-templates/most-popular-by-month.php' ) ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php _e( 'Most popular by month', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php printf( __( 'You are browsing most viewed articles in current month (%1$s) and year (%2$s).', 'path' ), date( 'm' ), date( 'Y' ) ); ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->
		
	<?php elseif ( is_page_template( 'page-templates/most-popular-by-comments.php' ) ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php _e( 'Most popular by comments', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing most viewed articles by comments.', 'path' ) ; ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->
		
	<?php elseif ( is_page_template( 'page-templates/most-popular-last-30-days.php' ) ) : ?>

		<div class="loop-meta">

			<h1 class="loop-title"><?php _e( 'Most popular articles in the last 30 days', 'path' ); ?></h1>

			<div class="loop-description">
				<p>
				<?php _e( 'You are browsing most viewed articles in the last 30 days.', 'path' ) ; ?>
				</p>
			</div><!-- .loop-description -->

		</div><!-- .loop-meta -->

	<?php endif; ?>