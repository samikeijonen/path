<?php
/**
 * Template Name: Authors
 *
 * Displays authors who have capability to edit or publish posts or pages.
 *
 * @package Path
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // path_before_content ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // path_open_content ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>
			
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // path_before_entry ?>

					<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // path_open_entry ?>

						<header class="entry-header">
							<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
						</header><!-- .entry-header -->
						
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

						<?php $users = get_users(); ?>

						<?php foreach ( $users as $author ) : ?>

							<?php $user = new WP_User( $author->ID ); ?>

								<?php if ( $user->has_cap( 'publish_posts' ) || $user->has_cap( 'edit_posts' ) || $user->has_cap( 'publish_pages' ) || $user->has_cap( 'edit_pages' ) ) : ?>

									<div id="hcard-<?php echo str_replace( ' ', '-', get_the_author_meta( 'user_nicename', $author->ID ) ); ?>" class="author-profile vcard clear">

										<a href="<?php echo get_author_posts_url( $author->ID ); ?>" title="<?php the_author_meta( 'display_name', $author->ID ); ?>">
											<?php echo get_avatar( get_the_author_meta( 'user_email', $author->ID ), '100', '', get_the_author_meta( 'display_name', $author->ID ) ); ?>
										</a>
										
										<h2 class="author-name fn n">
											<a href="<?php echo get_author_posts_url( $author->ID ); ?>" title="<?php the_author_meta( 'display_name', $author->ID ); ?>"><?php the_author_meta( 'display_name', $author->ID ); ?></a>
										</h2>
										
										<p class="author-bio">
											<?php the_author_meta( 'description', $author->ID ); ?>
										</p><!-- .author-bio -->

									</div><!-- .author-profile .vcard -->

								<?php endif; ?>

						<?php endforeach; ?>

					</article><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // path_after_entry ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>
						
		</div><!-- .hfeed -->
		
		<?php do_atomic( 'close_content' ); // path_close_content ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // path_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>