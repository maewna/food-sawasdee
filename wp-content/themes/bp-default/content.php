<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bre-bootstrap-ecommerce' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>

			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<div class="featured-post alert">
				<?php _e( 'Featured post', 'bre-bootstrap-ecommerce' ); ?>
			</div>
			<?php endif; ?>
			<div class="featured-post-image">
				<?php // the_post_thumbnail('width870'); ?>
			</div>

		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content clearfix">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bre-bootstrap-ecommerce' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bre-bootstrap-ecommerce' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">

			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bre-bootstrap-ecommerce' ) . '</span>', __( '1 Reply', 'bre-bootstrap-ecommerce' ), __( '% Replies', 'bre-bootstrap-ecommerce' ) ); ?>
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>

			<?php bre_entry_meta(); ?>

			<?php edit_post_link( __( 'Edit', 'bre-bootstrap-ecommerce' ), '<span class="edit-link">', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="entry-author-info media">
					<div class="author-avatar pull-left">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tcp_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div class="author-description media-body">
						<p class="author-user"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php printf( esc_attr__( 'By %s', 'tcp' ), get_the_author_meta('user_login') ); ?></a></p>
						<?php if ( get_the_author_meta( 'description') ) : // If a user has filled out their description, show a bio on their products  ?>
							<?php the_author_meta( 'description'); ?>
						<?php endif; ?>
					</div><!-- .author-description -->
				</div><!-- .entry-author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
