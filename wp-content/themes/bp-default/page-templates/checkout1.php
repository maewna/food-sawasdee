<?php
/**
 * Template Name: CheckoutTemplate1
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Boot Store consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>

 <script type="text/javascript">
    $(document).ready(function(){
     $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});                                   
    });    
 </script>
 
<div class="container">



	<main id= "tcp-content">	
	
	   <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
		 <div class="content-by-tcp">
		 <section class="my-location">
             <span class="txt-meal"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/>Good Morning</span>
             <span class="txt-time"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/time-icon.png"/><span id="clock4"></span></span>
             <span class="txt-location"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/location-icon.png"/>Sukhumvit Road Phra Khanong Nuea Watthana Krung Thep</span>
        </section><!-- End my-location -->
		
		

		<section class="tcp_shopping">
		
		<div class="line_br">
		
		</div>
	<div class="tcp_bgshopping">
		
		
		
		<section id="blockrow1">
		<?php
		$shop = new WP_Query( array('post_type' => 'shop', 'showposts' => '1','post_status'=>'publish') );
		if ( $shop->have_posts() ) :
		while (  $shop->have_posts() ) :  $shop->the_post();  ?>	
			<div class="col1" >
			<img src="<?php the_field('piclogo'); ?>" />
			</div>
			
		<?php endwhile; ?>
		<?php endif; ?>	
		</section>		
		
		
		
		<section id="blockrow2">
			<!-- content shoppingcart-->
			<div id="primary" class="site-content span12">
				<div id="content" role="main">

					<?php while ( have_posts() ) : the_post(); ?>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="entry-page-image">
								<?php the_post_thumbnail(); ?>
							</div><!-- .entry-page-image -->
						<?php endif; ?>

						<?php get_template_part( 'content', 'page' ); ?>

					<?php endwhile; // end of the loop. ?>

				</div><!-- #content -->
			</div><!-- #primary -->
			<!-- End content shoppingcart-->
		</section>
		

		
	</div>
		
		
		
	</section>

	
		</div>
	</main>
</div>

<?php get_footer(); ?>