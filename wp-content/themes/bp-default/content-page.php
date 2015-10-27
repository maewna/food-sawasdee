<?php
/**
 * The template used for displaying page content in page.php
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bre-bootstrap-ecommerce' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

	</article><!-- #post -->
