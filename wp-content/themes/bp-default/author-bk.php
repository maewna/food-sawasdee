<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header(); 
if ( ! is_active_sidebar( 'sidebar-shoppingcart-checkout' ) ) $col_width = 'span12';
else $col_width = 'span9';
?>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
     $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});                                   
    });    
 </script>

 <main id="content">
 
	<?php do_action( 'bp_before_blog_home' ); ?>
	<?php do_action( 'template_notices' ); ?>
	<div class="tcp_content ">	
	<section class="tcp_content">
		<section class="my-location">
             <span class="txt-meal"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/>Good Morning</span>
             <span class="txt-time"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/time-icon.png"/><span id="clock4"></span></span>
             <span class="txt-location"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/location-icon.png"/>Sukhumvit Road Phra Khanong Nuea Watthana Krung Thep</span>
        </section><!-- End my-location -->
		<section class="tcp_search">
		
		
		</section>
							
		<section class="contain_group_allproduct">
		
			<div  class="contain_group_product">
			
			
				
			<div class="author-header media">
				<div class="author-avatar pull-left">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'tcp_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- #author-avatar -->
				
				
				<div class="author-description media-body">
				<?php if ( function_exists( 'bp_is_active' ) && bp_is_active( 'xprofile' ) ) { ?>
						<h2><?php printf( esc_attr__( 'Author &#187; %s', 'tcp' ), get_the_author_meta('display_name') ); ?></h2>
						<?php if ( get_the_author_meta( 'description') ) { // If a user has filled out their description, show a bio on their products
							the_author_meta( 'description');
						} ?>
					<?php } else { ?>
						<h2><?php printf( esc_attr__( 'Author: &#187; %s', 'tcp' ), get_the_author_meta('display_name') ); ?></h2>
						<?php if ( get_the_author_meta( 'description') ) { // If a user has filled out their description, show a bio on their products
							the_author_meta( 'description');
						}
					} ?>
					</div>
			</div>
				
				
			<?php /* Start the Loop */ ?>

			<?php $out = array();
			while ( have_posts() ) : the_post();
				ob_start();
				get_template_part( 'content', 'search' );
				$html = ob_get_clean();
				$post_type = get_post_type( get_the_ID() );
				$out[$post_type][] = $html;
			endwhile; ?>
		
		
		<?php foreach( $out as $post_type => $post_types ) :
				$post_type_def = get_post_type_object($post_type); ?>
		
				<h3 class="posttype-title box-title"><a href="#post-type-tab-<?php echo $post_type; ?>" data-toggle="tab"><?php echo $post_type_def->labels->name; ?></a></h3>

				<?php foreach( $post_types as $html ) : ?>

					<?php echo $html; ?>

				<?php endforeach; ?>					

			<?php endforeach; ?>
		
		
		
			</div>
		</section>					



		
	</section><!-- #primary -->
	</div><!-- #content -->
</main>

<?php get_sidebar('author'); ?>
<?php get_footer(); ?>
