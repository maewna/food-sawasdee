<?php

/**
 * BuddyPress - Reviews
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
				$posts = $wpdb->get_results("SELECT * FROM wp_favourite WHERE fav_by='".bp_displayed_user_id()."'");
				if($posts){ ?>
					<ul class="grid effect-3" id="grid">	
				<?php
					foreach($posts as $post) { ?>
					<?php if( get_post_type( $post->post_id ) == 'bistro' ){ ?>
                        <li>
                            <a href="<?php echo get_permalink($post->post_id); ?>">
                                 <div class="box-image">
                                	<div class="icon icon-recipe"></div>
                                	<?php echo get_the_post_thumbnail($post->post_id,array(233,9999)); ?> 
                                    <div class="bg-review-title">
                                         <span class="title-recipe-font"><?php echo get_the_title($post->post_id); ?></span>
                                         <div class="cleaner_h13"></div>
                                    </div>
									<!--
									<div style='margin-top:5px;height:15px;'>
											<?php
												$user_ID = get_current_user_id();
												$user_status = $wpdb->get_var("SELECT COUNT(*) FROM wp_ulike WHERE post_id = '".get_the_ID()."'");
											?>
											<span class="recipe-like" style='color:#a7a7a7;font-size:11px'><?php echo nice_number($user_status);?> ชื่นชอบ</span>
											<span class="recipe-comment" style='color:#a7a7a7;font-size:11px'><?php echo nice_number(get_post_field('comment_count', get_the_ID())); ?> ความคิดเห็น</span>
											<span class="recipe-date" style='color:#a7a7a7;font-size:11px'><?php echo get_time_ago($post->post_id); ?></span>
									</div>-->
                                </div>								
                            </a>
                        </li>
					<?php } ?>			
					<?php if( get_post_type( $post ) == 'recipes' ){ ?>
						<li>
                            <a href="<?php the_permalink(); ?>">
                                 <div class="box-image">
                                	<div class="icon icon-recipe"></div>
                                	<?php the_post_thumbnail(array(233,9999)); ?> 
                                    <div class="bg-review-title">
                                         <span class="title-recipe-font"><?php the_title(); ?></span>
                                         <div class="cleaner_h13"></div>
                                    </div>
									<div class="detail-review">
										
											<div><label for="level" class="recipe-level">ระดับความยาก</label><span><?php echo get_post_meta( bp_displayed_user_id(), 'celeb_recipe-level', true ); ?></span></div>
											<div><label for="ingredient" class="recipe-ingredient">วัตถุดิบ</label><span>หมู</span></div>
											<div><label for="meal" class="recipe-meal">มื้อ</label><span><?php echo get_post_meta( bp_displayed_user_id(), 'celeb_meal', true ); ?></span></div>
											<p>
													<span class="recipe-like">like</span>
													<span class="recipe-comment"><?php comments_number( 'ไม่มีความคิดเห็น', '1 ความคิดเห็น', '%  ความคิดเห็น' ); ?> </span>
													<span class="recipe-date"><?php the_time(); ?></span>
											</p>
											<br class="clear"/>
									</div>
                                </div>								
                            </a>
                        </li>	
					<?php } ?>		
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
