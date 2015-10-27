<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/likesara.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />

	<!-- Add jQuery library -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4/jquery-1.4.3.min.js"></script>
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

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
			

<!-- end TIME -->


			<?php do_action( 'bp_before_blog_single_post' ); ?>
			
			<div class="page" id="likesara" role="main">
			
			<div class="likeinpost"> <!-- 1200x-->

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div class="singlenavigation" style="margin-bottom:20px;">
							<a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> > <a href="<?php echo home_url(); ?>/hilight-trend-likesara/">Like สาระ</a> > <a href="<?php echo home_url(); ?>/likesara/">บทความ</a> > <a href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
						</div>


				<!-- left -->

				<div id="likeinpost-left">

					<div id="likeinpost-left-content">
						<div id="trendinpost-title-postdate" style="float:right;">
							<span class="likesara-date"> <?php the_time(); ?></span><br/>
							<span class="likesara-pageview"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
						</div>
						
						 <div class="likeinpost-title">
							<div class="likeinpost-title-postdate">
								<span id="postdate"><?php printf( __( '%1$s', 'buddypress' ), get_the_date('d')); ?></span>
								<span id="postmonth"><?php printf( __( '%1$s', 'buddypress' ), strtoupper(get_the_date('M.Y'))); ?></span>
							</div>
							<div class="likeinpost-title-postname"><h3><?php the_title(); ?></h3></div>

							<div style="clear:both;"></div>
							
						 </div>

						 <div style="border-top: dashed 1px #cacaca;padding-top:15px;">
						 
						 <?php the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); ?>
						</div>
						 
						<div class="likeinpost-left-social">
							


							<div class="likesara-like-button"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
						</div>


						
						<div class="likeinpost-gallery">
							
							<div style="padding:20px;"><span>รูปทั้งหมด..</span></div>
							<div id="likeinpost-allimages">
							<ul>
							<?php 

							 $args = array(
							   'post_type' => 'attachment',
							   'numberposts' => -1,
							   'post_status' => null,
							   'post_parent' => $post->ID
							  );

							  $attachments = get_posts( $args );
								 if ( $attachments ) {
									foreach ( $attachments as $attachment ) {
									   echo '<a class="fancybox" rel="group" href="'.wp_get_attachment_url($attachment->ID).'" alt="">';
									   echo wp_get_attachment_image( $attachment->ID, array(70,70) );
									   echo get_post_meta($attachment->ID, _wp_attachment_image_alt, true);
									   echo '</a>';
									  }
								 }

							 ?>
							</ul>
							</div>
						</div> <!-- likeinpost-gallery -->

<!-- comment added 05/07/2015 -->

						<i class="comment-icon"></i>	
			<section class="comment-box">
						
			<?php comments_template(); ?>
			</section>	




					</div> <!-- likeinpost -->
					
					
					<div id="likeinpost-left-nav">
						<a href=" <?php get_site_url(); ?>/hilight-trend-likesara"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/back-to-main-likesaea.png"></a>
					</div>
					
					
				</div>


			
			<?php endwhile; else: ?>

				<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>

			<?php endif; ?>


				<!-- right -->
				<div id="likeinpost-right">
					
					<!-- <div id="likeinpost-right-social">
						<div id="likeinpost-right-likebutton"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div> 
					</div>
					-->
					<div id="likeinpost-right-socialtools">
							<?php // do_action('addthis_widget',get_permalink($post->ID), get_the_title($post->ID), 'large_toolbox');?>
						</div>
					
					
					<div id="likeinpost-right-moretips">
					<h3>สาระอื่นๆ</h3>
						<?php 
							query_posts(array( 
								'post_type' => 'tip',
								'showposts' => 4,
								'orderby' => 'rand'
							) );  
						?>
						<?php while (have_posts()) : the_post(); ?>
								<a href="<?php the_permalink() ?>"><?php echo get_the_post_thumbnail( $post->ID, array(290,9999) );  ?></a>
								<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<div id="likeinpost-right-datebox">
									<span id="likeinpost-right-date"><?php echo get_the_date(); ?> </span>
									<!-- <span id="likeinpost-right-likenumber">222 ชื่นชอบ</span> -->
									
								</div>
						<?php endwhile;?>
					</div>
					
					<div id="likesara-members-likeinpost">
						<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/likesara/members-title-likeinpost.png">
						
						
						<section class="recommend-member-likeinpost">
                            
                                <div class="wr-member">
									<?php $memberArray = array(); if ( bp_has_members( 'type=newest&max=4' ) ) : ?>    
										<?php while ( bp_members() ) : bp_the_member(); ?>                      
											<figure>
												<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=55&height=55') ?></a>
											</figure>
										<?php array_push($memberArray, bp_get_member_user_id() );	?>										
										<?php endwhile; ?>
									<?php endif; ?>
									
									<?php 
									if ( bp_has_members( 'type=random&max=6&exclude='.implode(',',$memberArray)  ) ) :?>         
										<?php while ( bp_members() ) : bp_the_member(); ?>                      
											<figure>
												<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=55&height=55') ?></a>
											</figure>
										<?php endwhile; ?>
									<?php endif; ?>
								
								   
                                   <!--<figure><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/pic-ex14.jpg"/></a></figure>-->
                                 
                                   <br class="clear"/>
                                </div>
						</section><!-- End recommend-member -->
					  
					  <?php
					if ( is_user_logged_in() ) {
					} else {
					?>	
						 <section class="register-member-likeinpost">
                    			<a href="#" class="regis-button-likeinpost">สมัครสมาชิก</a>
                                <a href="#" class="login-button-likeinpost">Login</a>
						</section><!-- End register-member --><!-- End register-member -->
						
					<?php	
					}
					?>
						
					 <br/><br/><br/>
					  
					  
					</div>
					

				</div><!-- likeinpost-right -->
			
			
			<div style="clear:both;"></div>

			</div> <!-- likeinpost-->







			

		</div><!-- page -->

		<?php do_action( 'bp_after_blog_single_post' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->


<?php get_footer(); ?>