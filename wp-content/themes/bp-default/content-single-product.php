<?php
/**
 * The template used for displaying product content in single-tcp_product.php
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store ecommerce
 * @since Boot Store 1.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content clearfix">
		<?php ob_start();
		the_content();
		$out = ob_get_clean();
		if ( strlen( $out ) > 0 ) : ?>
			<h2 class="by-title">
				<small>
					<?php $terms = wp_get_post_terms( get_the_ID(), 'tcp_product_brand', array("fields" => "all"));
					if ( is_array( $terms ) && count( $terms ) > 0 ) foreach( $terms as $term ) : ?>
						<span class="brand-title"> <a href="<?php echo get_term_link( $term->slug, $term->taxonomy ); ?>">by <?php echo $term->name; ?></a></span>
					<?php endforeach; ?>
				</small>
			</h2>
			<?php echo $out; ?>
		<?php endif; ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php //edit_post_link( __( 'Edit', 'bre-bootstrap-ecommerce' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

	</article><!-- #post -->
