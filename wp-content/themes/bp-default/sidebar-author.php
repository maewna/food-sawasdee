<?php
/**
 * Sidebar containing the author widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
?>
	<?php $out = bre_is_active_sidebar_and_empty( 'sidebar-author' );
	if ( strlen( $out ) > 0 ) : ?>
		<div id="secondary" class="widget-area span3" role="complementary">
			<?php echo $out; ?>
		</div><!-- #secondary -->
	<?php endif; ?>

