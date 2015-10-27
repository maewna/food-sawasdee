<?php/* Template Name: Articles*/?>

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
          
           		
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
      
        	</div><!-- End content-by-meal -->
 
                     <div class="page" id="blog-archives" role="main">
	
		<div class="trend" style="padding-top: 10px;"> <!-- 1170x720-->
		
		<?php if ( have_posts() ) : ?>
			
			<!-- TrendZone heading word -->
					<div id="trend-zone-title">
						<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/trend-zone-title.png">
					</div>


				<!-- left -->

				<!-- while loop starts here -->
				<?php 
				query_posts(array( 
					'post_type' => 'artiles',
					'showposts' => 1 
				) ); 

				?>
				<?php while (have_posts()) : the_post(); ?>

				<div class="trend-left"> <!-- 640x620 -->
					
					<div class="trend-left-item-thumb">
                    
					<!-- trend-left-thumb 640x300 -->
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
					<a href="<?php the_permalink();?>"><?php echo imagesize($image[0],640,300); ?></a>
					<!-- <img src="images/trend-left-item.jpg"> -->
					</div>

					<div class="trend-left-item-content">
						<!-- content title -->
						<?php $title = get_the_title();?>
						<h3><a href="<?php the_permalink() ?>">	<?php echo substr_utf8( $title, 0 , 40); ?></a></h3>	
						<div>
					
							<span class="likesara-date"> <?php the_time(); ?></span><br/>
							<span class="likesara-pageview"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
						</div>
						<p><?php echo get_excerpt(450);?></p>
						
						<div class="likesara-like-button"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
					</div>
				</div>
				
				<!-- while loop starts here -->
				<?php endwhile;?>
				
				<?php 
				query_posts(array( 
					'post_type' => 'articles',
					'showposts' => 2,
					'offset' => 1
				) ); 

				?>
				
				<div class="trend-right"> <!-- 490 -->
				
				
				<?php while (have_posts()) : the_post(); ?>



				<!-- right -->
				
					<div class="trend-right-item"> <!-- 490x200 -->
						
						<div class="trend-right-item-thumb"><!-- 170x190 -->
							<!-- <img src="images/trend-right-item.jpg"><!-- 160x180 -->
							<div id="trend-right-item-thumb-img">

                            	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
								<a href="<?php the_permalink();?>"><?php echo imagesize($image[0],165,180); ?></a>
							</div>
						</div>

						<div class="trend-right-item-content">
							<?php $title = get_the_title();?>
							<h3><a href="<?php the_permalink() ?>"><?php echo substr_utf8( $title, 0 , 35); ?></a></h3>
							<span class="likesara-date"> <?php the_time(); ?></span><br/>
							<span class="likesara-pageview"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
							<p><?php echo get_excerpt(300);?></p>

							<!-- <img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/like-button.png"> -->
							<div class="likesara-like-button"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
						</div>

						<!-- like section 70x200 -->

					</div>
				
					
					<?php endwhile;?>

					<!-- see all button -->
					<div id="trend-see-all">
						<a href="<?php echo site_url(); ?>/trend/" id="see-all-button"></a>
						<img id="see-all-char" src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/trend-see-all-char.png">
					</div>

				</div>

				

				
				<?php else : ?>
			
			<h2 class="center"><?php _e( 'Not Found', 'buddypress' ); ?></h2>
			<?php get_search_form(); ?>

			<?php endif; ?>

			</div>
			
			<!-- end trendzone -->				
				
				
				
						
		<!-- Start Likesara-->
		
		
		<div class="likesara"> <!-- 1170x1400-->
			
			
			<!-- Like Sara heading word -->
			<div id="likesara-title">
				<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/like-sara-title.png">
			</div>

			<!-- while loop starts here -->

				<div class="likesara-left"> <!-- 790x1400 -->
				
				<ul class="grid effect-3" id="grid">
				
				<?php 
					global $wpdb;
					$posts = $wpdb->get_results("SELECT * FROM $wpdb->posts where post_type='articles' AND post_status = 'publish' LIMIT 15");
					foreach($posts as $post) { 
						$videocheck = $post->post_content;
						$videotag = '[/video]';
						// echo $videocheck;

						$title = get_the_title();
					?>
					
					
					<?php if( strpos($videocheck, $videotag)){ ?>

                        <li>
                            
                                 <div class="box-image">
									<a href="<?php the_permalink(); ?>">
                                	<div class="icon icon-video"></div>
                                	<div class="thumbimage">
										<?php the_post_thumbnail(array(250,9999)); ?> 
										<div class="hovericon"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/box-image-hover-icon.png" /> </div>
									</div>
                                    <div class="likesara-title">

                                         <h3><?php echo substr_utf8( $title, 0 , 65); ?></h3>
                                         
                                    </div>
									</a>
									<div class="likesara-detail">
										
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
										<?php the_post_thumbnail(array(250,9999)); ?> 
										<div class="hovericon"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/box-image-hover-icon.png" /> </div>
									</div>
									
                                    <div class="likesara-title">
                                         <h3><?php echo substr_utf8( $title, 0 , 65); ?></h3>

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
					
					
				<div style="clear: both;"></div>
					
				</div>
				
				



				<div class="likesara-right">
					<div id="likesara-horo">
						<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/horo-banner.png">
					</div>
					<div id="likesara-members">

						<section class="recommend-member">
                            	<h2 class="recommend-member-icon">สมาชิก FoodSawasdee</h2>
                                <div class="wr-member">
									<?php /*$memberArray = array();
										$user_query = new WP_User_Query( array(  'orderby' => 'registered', 'number' => 4 ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
										<figure>
											<?php $user_info = get_userdata($username->ID); 
												  $user_level =  implode(', ', $user_info->roles);
												  if($user_level == 'celeb'){ ?>
													<a href="<?php echo get_author_posts_url($username->ID);?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 68 ); ?></a>
											<?php }else{?>
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 68 ); ?></a>
											<?php }*/?>
											
											<?php $memberArray = array();
										$user_query = new WP_User_Query( array(  'orderby' => 'registered', 'number' => 4 , 'role' => 'Subscriber' ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
										<figure>
											<?php $user_info = get_userdata($username->ID); ?>
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 60 ); ?></a>
											
											
											
										</figure>	
										<?php array_push($memberArray, $username->ID );	?>		
									<?php } }	//end foreach
										$user_query = new WP_User_Query( array( 'orderby' => 'rand', 'number' => 6, 'role' => 'Subscriber', 'exclude' => $memberArray ) );
									
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
										<figure>
											<?php $user_info = get_userdata($username->ID); ?>
												<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 60 ); ?></a>
										</figure>	
									<?php } }//end foreach?>	
								   
                                   <!--<figure><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/pic-ex14.jpg"/></a></figure>-->
                                 
                                   <br class="clear"/>
                                </div>
                      </section><!-- End recommend-member -->
                 
                 <br class="clear"/>
				 
				 
					<?php
					if ( is_user_logged_in() ) {
					} else {
					?>	
						<section class="register-member">
                    			<a href="#" class="regis-button">สมัครสมาชิก</a>
                                <a href="#" class="login-button">Login</a>
						</section><!-- End register-member -->
					 <?php	
					}
					?> 
					  
					  
					</div>
				</div>


	<div style="clear: both;"></div>
		</div>
		<!-- end likesara-->
		
		
			
			
			
			

		</div>
	
	
	
	
	
	
	

		
		
		<?php do_action( 'bp_after_archive' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->
	

	<!-- script for lazy-load grid -->
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