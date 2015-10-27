<?php

/**
 * BuddyPress - Pictures
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>


<div class="prof-left-1 align-left">
        	<section class="member-profile">
				<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>	
				<span id="btn-slide" style="float:right;">ข้อมูลเพิ่มเติม</span>
				<div id="member-profile-box">
				<?php 
					locate_template( array( 'members/single/profile/profile-loop.php' ), true );
				?>
				</div>
			</section>
  
        	<section class="member-activities">	
				<?php 
				global $wpdb;
				$posts = $wpdb->get_results("SELECT ID,post_type,post_date,meta_value AS bistroId FROM wp_posts
						INNER JOIN wp_postmeta ON 
						post_id=post_parent
						WHERE meta_key='Image_bistroId'
						AND post_status !='trash'
						AND post_author='".bp_displayed_user_id()."'");
				if($posts){ ?>
					<ul class="grid effect-3" id="grid">	
				<?php
					foreach($posts as $post) { 
					$atts = wp_get_attachment_image_src($post->ID, 'medium');
						//$full = wp_get_attachment_image_src($post->ID, 'full'); 
					?>
                        <li>
                            <a href="<?php echo get_permalink($post->bistroId); ?>">
                                 <div class="box-image">
                                	<div class="icon icon-pic"></div>
									<img src="<?php echo $atts[0]?>" width="<?php echo $atts[1]?>" alt='' width="233">
									<?php if ( is_user_logged_in() && bp_is_my_profile() ){ ?>
									<div class="bg-review-edit">
										<a href="#" title="ลบ"><div class="del-icon"></div></a>
									</div>
									<?php }//End if check user login ?>
                                	<div class="bg-review-title">
									    <span class="title-recipe-font"><?php echo substr_utf8(get_the_title($post->ID),0,20);?></span>
                                         <div class="cleaner_h13"></div>
                                    </div>
									<div class="detail-review">
										<span class='addimg'>เพิ่มรูปให้ </span><span class='bistroname'> ร้าน <?php echo get_the_title($post->bistroId);?></span>
										<div class="thetime"></div>
									</div>
                                </div>								
                            </a>
                        </li>
						<?php }//End foreach ?> 
						<?php wp_reset_query(); ?>	
						</ul>
						<?php }else{ ?>
						<p class="no-content">
							<?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?>
						</p>
					<?php }?>		
					
					
	
					
					

			</section>
			
			</div><!-- End left -->
			<div class="prof-right-1 align-left">
				<?php locate_template( array( 'members/single/follow.php' ), true ); ?>
			</div><!-- End right -->
			






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
