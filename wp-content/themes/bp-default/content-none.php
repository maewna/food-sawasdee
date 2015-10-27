<?php
/**
 * The template for displaying a "No posts found" message.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'bre-bootstrap-ecommerce' ); ?></h1>
		</header>

		<div class="entry-content clearfix">
			<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'bre-bootstrap-ecommerce' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
