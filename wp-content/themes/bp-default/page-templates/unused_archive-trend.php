<?php /*Template Name: Trend All */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/likesara.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>


<!-- Add jQuery library -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery-1.10.1.min.js"></script>



	

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>

<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-home_page"><a href="<?php echo home_url(); ?>/recipes/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-home_page active"><a href="<?php echo home_url(); ?>/hilight-trend-likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-home_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-home_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-home_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-home_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>
<main id="content">
		<div class="social">
         	<li ><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
          
        <div class="content-by-meal" style="height: 195px;">
          
           	<nav id="navigation-sub" role="navigation">
				<ul id="menu-main_nav_sub">
					<li class="menu-quick-easy_page active"><a href="<?php echo home_url(); ?>/trend/" style="width: 510px;"><i class="icon1"> </i>เทรนด์โซน</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/likesara/" style="width: 510px;"><i class="icon2"> </i>บทความ</a></li>
				</ul>
			</nav>
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?>  
      
        	</div><!-- End content-by-meal -->

            <!-- Start Likesara-->
			
			
			<div class="trendall"> <!-- 1170x1400-->
				
				<div id="trendall-top">
					<!-- pagination -->
				</div>
				
				<!-- Trend All heading word -->
				<div id="trendall-title">
					<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/trend-zone-title.png">
				</div>

				<!-- while loop starts here -->

					<div class="trendall-grid"> <!-- 1200xauto -->
					
					<ul class="grid effect-3" id="grid">
					
					<?php 
						global $wpdb;
						$posts = $wpdb->get_results("SELECT * FROM $wpdb->posts where post_type='trend' AND post_status = 'publish'");
						foreach($posts as $post) { 
							
							
						?>
						
						
						<?php if(1){ ?>
							<li>
								
									 <div class="box-image">
										<a href="<?php the_permalink(); ?>">
										<!-- <div class="icon icon-video"></div> -->
										<div class="thumbimage">
											<?php the_post_thumbnail(array(360,9999)); ?> 
											<div class="hovericon-trendall"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/box-image-hover-icon.png" /> </div>
										</div>
										<div class="trendall-title-grid">
											 <h3><?php the_title(); ?></h3>
											 
										</div>
										</a>
										<div class="trendall-detail-grid">
											
											<span class="likesara-date"> <?php the_time(); ?></span><br/>
											<span class="likesara-pageview"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
											<p><?php echo get_excerpt(400); ?></p>
											
											
										</div>
									</div>								
								
							</li>
						<?php }else{ ?>
							<li>
								
									 <div class="box-image">
										<a href="<?php the_permalink(); ?>">
										<div class="thumbimage">
											<?php the_post_thumbnail(array(360,9999)); ?> 
											<div class="hovericon-trendall"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/box-image-hover-icon.png" /> </div>
										</div>
										
										<div class="likesara-title">
											 <h3><?php the_title(); ?></h3>

										</div>
										</a>
										<div class="likesara-detail">
											
											<span class="likesara-date"> <?php the_time(); ?></span><br/>
											<span class="likesara-pageview"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
											<p><?php echo get_excerpt(400); ?></p>
											
											
										</div>
									</div>								
								
							</li>	
						
							
						<?php } ?>		
							<?php } ?>		
					<?php wp_reset_query(); ?>		
					
					
						</ul>
					
					
						
					</div> <!-- class="trendall-grid" -->
	
				<br style="clear: both;"/>





				</div>
				<!-- end trendall-->
				
				
				
				
				
		<?php do_action( 'bp_after_blog_home' ); ?>
		
</main>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/masonry.pkgd.min.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/imagesloaded.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/classie.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/AnimOnScroll.js"></script>
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );
		</script>

<?php get_footer(); ?>