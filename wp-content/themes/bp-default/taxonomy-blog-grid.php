<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header();

	if ( ! is_active_sidebar( 'sidebar-blog' ) ) $col_width = 'span12';
	else $col_width = 'span9'; ?>

	<section id="primary" class="site-content <?php echo $col_width; ?>">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="entry-header cf">
				<h1 class="entry-title"><?php single_cat_title( '' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

		<?php tcp_the_loop(); /* Start the Loop */ ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-cross' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-cross' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
