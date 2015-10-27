<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/likesara.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/jquery.fancybox.css?v=2.1.5" />
    
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'promotion_lightbox.php',
					type : 'iframe',
					padding : 5
				});
			});
		});
	</script>

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
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
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
			

<!-- end TIME -->


			<?php do_action( 'bp_before_blog_single_post' ); ?>
			
			<div class="page" id="trendinpost" role="main">
			
			<!-- <div class="trendinpost"> <!-- 1200x-->

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				


				<div id="trendinpost" style="margin-bottom:20px;">
				
				<div class="singlenavigation" style="margin-bottom: 10px;">
							<a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> > <a href="<?php echo home_url(); ?>/hilight-trend-likesara/">Like สาระ</a> > <a href="<?php echo home_url(); ?>/trend/">Trend Zone</a> > <a href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
						</div>

					<div id="trendinpost-content">
						
						 <div class="trendinpost-title">
						 	<div id="trendinpost-title-postdate" style="float:right;">
						 		<span class="likesara-date"> <?php the_time(); ?></span><br/>
								<span class="likesara-pageview"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
						 	</div>
							<div class="likeinpost-title-postdate">
								<span id="postdate"><?php printf( __( '%1$s', 'buddypress' ), get_the_date('d')); ?></span>
								<span id="postmonth"><?php printf( __( '%1$s', 'buddypress' ), strtoupper(get_the_date('M.Y'))); ?></span>
							</div>
							<div class="trendinpost-title-postname"><h3><?php the_title(); ?></h3>

							</div>

							<div style="clear:both;"></div>
							

							
						 </div>

						 <div style="border-top: dashed 1px #cacaca;padding-top:15px;">
						 <?php the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); ?>
						</div>
						 
						
						
							
							
							<?php endwhile; else: ?>

						<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>

					<?php endif; ?>

			
			
					<div id="trendinpost-related-head"><h2>คุณอาจสนใจเทรนด์อื่นๆ...</h2></div>
					
					<div id="trendinpost-seealltext" style="float:right;"><a href=" <?php get_site_url(); ?>/trend">ดูเทรนด์ทั้งหมด</a></div>
					<div style="clear:both;"></div>



					<?php

					//get tag ids for related post



					$tag_ids = array();
					foreach( get_the_tags($post->ID) as $tag ) {
					    $tag_ids[] = $tag->term_id;
					    //echo $tag->slug;
					}

					?>

					<div id="trendinpost-related">
							
							
							<?php 
							query_posts(array( 
								'post_type' => 'trend',
								'showposts' => 3,
								//'tag_slug__in' => array('trend1', 'trend2')
								'tag__in' => $tag_ids,
								'post__not_in' => array(get_the_ID())
							) );  
						?>
						
						<?php 
						$countpost = 0;
						$relatedpostbytag = array();
						while (have_posts()) : the_post(); 


						?>

							<a href="<?php the_permalink() ?>">
							<div class="trendrelated-item">
								<div id="trendrelated-item-thumb"><?php echo get_the_post_thumbnail( $post->ID, array(75,75) );  ?> </div>
								<div id="trendrelated-item-title">
									<a href="<?php the_permalink() ?>"><h2><?php echo substr_utf8(get_the_title() , 0 , 60); ?></h2></a>
									<p><?php echo get_excerpt(200) ?></p>
								</div>
						
							</div>
							</a>
						
						<?php 
						$countpost++;
						
						endwhile;

						
						?>

						<!-- if no other post with same tags, random any other post in same post type -->

						

						<?php

						$leftpost = 3-$countpost;
						if($countpost < 3){
							query_posts(array( 
								'post_type' => 'trend',
								'showposts' => $leftpost,
								'post__not_in' => array(get_the_ID()),
								'orderby' => 'rand'
							) );  

							while (have_posts()) : the_post(); ?>

							<a href="<?php the_permalink() ?>">
							<div class="trendrelated-item">
								<div id="trendrelated-item-thumb"><?php echo get_the_post_thumbnail( $post->ID, array(75,75) );  ?> </div>
								<div id="trendrelated-item-title">
									<a href="<?php the_permalink() ?>"><h2><?php echo substr_utf8(get_the_title() , 0 , 60); ?></h2></a>
									<p><?php echo get_excerpt(200) ?></p>
								</div>
						
							</div>
							</a>

							<?php 
							endwhile;

						} //end if
							
						?>
						
						<div style="clear:both;"></div>
						</div> <!-- trendinpost-relate -->
						
						
					
					<div id="trendinpost-nav">
						<a href=" <?php get_site_url(); ?>/hilight-trend-likesara"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/back-to-main-likesaea.png"></a>
					</div>



					
					</div> <!-- likeinpost -->
					
				



				</div>


			
			

				
			
			
			<div style="clear:both;"></div>

			<!-- </div> <!-- likeinpost-->







			

		</div><!-- page -->

		<?php do_action( 'bp_after_blog_single_post' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->


<?php get_footer(); ?>