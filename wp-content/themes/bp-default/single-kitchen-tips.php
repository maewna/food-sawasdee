<?php /*Template Name: Tips Page */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/specialReview.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>



<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal" style="margin-bottom: 5px;">
          
           
  
					<?php include_once('/bg-time.php');?> 
        	</div><!-- End content-by-meal -->
			
			
            <div class="content-tip">
				<div class="singlenavigation" style="margin-bottom:330px;">
					<?php while (have_posts()) : the_post(); ?>
								<a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> > <a href="<?php echo home_url(); ?>/recipes/">อร่อยในบ้าน</a> > <a href="<?php echo home_url(); ?>/tip/">เคล็ดลับคู่หูทำอาหาร</a> > <a href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
					<?php endwhile;?>
				</div>
			
					<?php
						$ran = array("#ee4036","#8bc53f","#00adee");
						$randomColor = $ran[array_rand($ran, 1)];
					?>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="box-tip" style="border:2px solid <?php echo $randomColor;?>">
									<div class="tipTitle"  style="background-color:<?php echo $randomColor;?>;" ><?php the_title(); ?></div>
									
						<?php the_content(); ?>
						

						<?php endwhile; else: ?>
								<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>
						<?php endif; ?>
						
						<?php wp_reset_query(); ?>
									
									
									
									
									
									
                </div><!--End box-image-->
                
            </div><!-- End content-tips-->  
		<?php do_action( 'bp_after_blog_home' ); ?>
		
</main>
<?php get_footer(); ?>