<?php
/**
 * The template for displaying content serarch and content author archive.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?>

<div class="media">
	<?php if (has_post_thumbnail()) {  ?>
		<div class="entry-post-thumbnail pull-left">
			<a class="media-object" href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() ) the_post_thumbnail( 'height195' ); ?></a>
		</div><!-- .entry-post-thumbnail -->
	<?php } else { 
		if ( ! isset( $instance ) ) $instance = get_option( 'ttc_settings' );
		$suffix = '-' . get_post_type( get_the_ID() );
		if ( ! isset( $instance['title_tag' . $suffix] ) ) $suffix = '';
		$image_size = isset( $instance['image_size' . $suffix] ) ? $instance['image_size' . $suffix] : 'thumbnail'; ?>
		<div class="entry-post-thumbnail pull-left tcp-no-image">
			<a class="tcp_size-<?php echo $image_size;?> media-object" href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/tcp-no-image.jpg" alt="No image" title="" width="150" height="auto" /></a>
		</div><!-- .entry-post-thumbnail -->
	<?php } ?>	

	<div class="media-body">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h2 class=entry-title><a href="<?php the_permalink( );?>" class="media-heading"><?php the_title(); ?></a></h2>
			</header>

			<?php if ( function_exists( 'tcp_is_saleable' ) && tcp_is_saleable( $post->ID ) ) : ?>
				<div class="wrapper-prices">
					<div class="entry-price">
					<?php tcp_the_price_label();?>
					</div><!-- entry-price -->
					<?php if ( function_exists( 'tcp_has_discounts' )) : ?>
						<?php if ( tcp_has_discounts() ) : ?>
							<span class="loop-discount">-<?php tcp_the_discount_value(); ?></span>
						<?php endif; ?>
					<?php endif; ?>

					<?php $stock = tcp_get_the_stock( get_the_ID() );
					if ( $stock == 0 ) : ?>
						<span class="loop-out-stock"><?php _e( 'Out of stock', 'bre-bootstrap-ecommerce' ); ?></span>
					<?php endif; ?>

				</div><!-- .wrapper-prices -->
			<?php endif; ?>

			<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_content', 'sharing_display', 19 ); ?>
			<?php if ( function_exists( 'sharing_display' ) ) remove_filter( 'the_excerpt', 'sharing_display', 19 ); ?>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

			<?php if ( !is_author( ) && is_multi_author() ) : ?>
				<div class="entry-author-info media">
					<div class="author-description media-body">
						<p class="author-user"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php printf( esc_attr__( 'By %s', 'tcp' ), get_the_author_meta('user_login') ); ?></a></p>
					</div><!-- .author-description -->
				</div><!-- .entry-author-info -->
			<?php endif; ?>

		</article><!-- #post -->
	</div><!-- .media-body -->
</div><!-- .media --> 
