<?php

/**
 * BuddyPress - All
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
			
				<ul class="grid effect-3" id="grid">
				
				<?php 
					global $wpdb;
					/*$posts = $wpdb->get_results("SELECT ID,post_type,post_date FROM $wpdb->posts WHERE post_author='".bp_displayed_user_id()."' AND ( post_type='recipes' OR post_type='celebcook' OR post_type='review' ) AND post_status='publish' 
					UNION 
					SELECT ID,post_type,post_date FROM $wpdb->posts INNER JOIN $wpdb->postmeta ON meta_value=ID WHERE meta_key = 'bistro_img' AND post_author='".bp_displayed_user_id()."' AND post_type='attachment' AND post_mime_type LIKE 'image/%' AND post_status='inherit' 
					ORDER BY post_date DESC");*/
						//$user_ID = get_current_user_id();
						$posts = $wpdb->get_results("SELECT ID,post_type,post_date,ID AS bistroId  FROM $wpdb->posts WHERE post_author='".bp_displayed_user_id()."' AND ( post_type='recipes' OR post_type='celebcook' OR post_type='review' ) AND post_status='publish' 
						UNION 
						SELECT ID,post_type,post_date,meta_value AS bistroId FROM wp_posts
						INNER JOIN wp_postmeta ON 
						post_id=post_parent
						WHERE meta_key='Image_bistroId'
						AND post_status !='trash'
						AND post_author='".bp_displayed_user_id()."' ORDER BY post_date DESC"
						);
					/*
					SELECT * FROM $wpdb->posts WHERE post_author='".bp_displayed_user_id()."' AND ( post_type='recipes' OR post_type='celebcook' OR post_type='review' ) AND post_status='publish' ORDER BY post_date DESC ) UNION (SELECT * FROM $wpdb->posts INNER JOIN $wpdb->postmeta ON meta_value=ID WHERE meta_key = 'bistro_img' AND post_author='".bp_displayed_user_id()."' AND post_type='attachment' AND post_mime_type LIKE 'image/%' AND post_status='inherit' ORDER BY post_date DESC
					
					
					SELECT * FROM(

					(SELECT * FROM wp_posts
						INNER JOIN wp_postmeta ON 
						post_id=post_parent
						WHERE meta_key='Image_bistroId'
						AND post_status !='trash'
						AND post_author='4'
					)
					union
					(SELECT * FROM wp_posts
						INNER JOIN wp_postmeta ON meta_value=ID 
						WHERE  meta_key = 'bistro_img'
						AND post_status !='trash'
						AND post_author='4'
					)
					) bImg

					GROUP BY  bImg.ID

					*/
					
					
					foreach($posts as $post) { ?>
					<?php if( get_post_type( $post ) == 'review' ){ ?>
                        <li>
							<?php
							global $wpdb;
							$review_bistroid = get_field('review_bistroid');
							$sql_getBistro = "SELECT * FROM wp_posts WHERE ID='$review_bistroid'";
							$res_Bistro = $wpdb->get_results($sql_getBistro);
							$bistroName=$res_Bistro[0]->post_title; 
							$link = get_permalink($review_bistroid);
							$linkToReview = $link."#review_".get_the_id();
							$reviewId = get_the_id();
							?>
                            <a href="<?php echo $linkToReview; ?>">
                                 <div class="box-image">
                                	<div class="icon icon-bistro"></div>
                                	<?php the_post_thumbnail(array(233,9999)); ?>
									<?php if ( is_user_logged_in() && bp_is_my_profile() ){ ?>
									<div class="bg-review-edit review">
										<?php
											if ( wpuf_get_option( 'enable_post_edit', 'wpuf_dashboard', 'yes' ) == 'yes' ) {
												$disable_pending_edit = wpuf_get_option( 'disable_pending_edit', 'wpuf_dashboard', 'on' );
												$edit_page = (int) wpuf_get_option( 'edit_page_id', 'wpuf_general' );
												$url = add_query_arg( array('pid' => $post->ID), get_permalink( $edit_page ) );

												if ( $post->post_status == 'pending' && $disable_pending_edit == 'on' ) {
													// don't show the edit link
												} else {
													?>
													<a href="<?php echo wp_nonce_url( $url, 'wpuf_edit' ); ?>" title="แก้ไข"><div class="edit-icon"></div></a>
													<?php
												}
											} ?>
										<a href="<?php echo get_delete_post_link( $post->ID ) ?>" title="ลบ" onclick="return confirm('ยืนยันการลบ?');"><div class="del-icon"></div></a>
									</div>
									<?php }//End if check user login ?>
									<div class="detail-review">
										<div class="title-bistro-font"> <?php echo get_the_title(get_field('review_bistroid')); ?></div>
										<div class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></div>
										<div class="review-rating" >
											<span>ให้คะแนน</span>
											<div class="userRate"style="margin-top:-5px;">
												<div class='rating_bar'>
													<?php $userRate = get_post_meta( get_the_ID(), 'review_rating', true ) * 20;?>
													 <div class='rating' style='width:<?php echo $userRate;?>%;'></div>
												</div>
											</div>
											<div class="cleaner_h13"></div>
										 </div>
										
										<div class="detail-review-font"><?php echo substr_utf8(get_post_field('post_content', get_the_ID()),0,100);?><span class="read-more"><a href="<?php echo $linkToReview;?>">อ่านต่อ</a></span></div>
										<div style='margin-top:5px;height:15px;'>
											<?php
												$user_ID = get_current_user_id();
												$user_status = $wpdb->get_var("SELECT COUNT(*) FROM wp_ulike WHERE post_id = '".get_the_ID()."'");
											?>
											<span class="recipe-like" style='color:#a7a7a7;font-size:11px'><?php echo nice_number($user_status);?> ชื่นชอบ</span>
											<span class="recipe-comment" style='color:#a7a7a7;font-size:11px'><?php echo nice_number(get_post_field('comment_count', get_the_ID())); ?> ความคิดเห็น</span>
											<span class="recipe-date" style='color:#a7a7a7;font-size:11px'><?php echo get_time_ago(get_the_ID()); ?></span>
										</div>
									</div>
                                </div>								
                            </a>
                        </li>
					<?php } ?>			
					<?php if( get_post_type( $post ) == 'recipes' || get_post_type( $post ) == 'celebcook' ){ ?>
						<?php  $recipeId = get_the_id();?>
						<li>
                            <a href="<?php the_permalink(); ?>">
                                 <div class="box-image">
                                	<div class="icon icon-recipe"></div>
                                	<?php the_post_thumbnail(array(233,9999)); ?> 
									<?php if ( is_user_logged_in() && bp_is_my_profile() ){ ?>
									<div class="bg-review-edit">
										<?php
											if ( wpuf_get_option( 'enable_post_edit', 'wpuf_dashboard', 'yes' ) == 'yes' ) {
												$disable_pending_edit = wpuf_get_option( 'disable_pending_edit', 'wpuf_dashboard', 'on' );
												$edit_page = (int) wpuf_get_option( 'edit_page_id', 'wpuf_general' );
												$url = add_query_arg( array('pid' => $post->ID), get_permalink( $edit_page ) );

												if ( $post->post_status == 'pending' && $disable_pending_edit == 'on' ) {
													// don't show the edit link
												} else {
													?>
													<a href="<?php echo wp_nonce_url( $url, 'wpuf_edit' ); ?>" title="แก้ไข"><div class="edit-icon"></div></a>
													<?php
												}
											} ?>
										<a href="<?php echo get_delete_post_link( $post->ID ) ?>" title="ลบ" onclick="return confirm('ยืนยันการลบ?');"><div class="del-icon"></div></a>
									</div>
									<?php }//End if check user login ?>
                                    <div class="bg-review-title">
                                         <span class="title-recipe-font"><?php echo substr_utf8(get_the_title($post->ID),0,20);?></span>
                                         <div class="cleaner_h13"></div>
                                    </div>
									<div class="detail-review">										
											<div><label for="level" class="recipe-level">ระดับความง่าย</label>
											<?php 		$recipe_rating = get_post_meta( $post->ID, 'recipe_rating', true );
														if($recipe_rating!=0){$smileRating = $recipe_rating*(100/5);}
														else{$smileRating = 0;}
													?>
																				<div class="smile">
																					<div class="smileRating" style="width:<?php echo $smileRating;?>%"></div>
																					<input type="radio" name="smileRating" id="smile5" value="5">
																					<label for="smile5"></label>
																					<input type="radio" name="smileRating" id="smile4" value="4">
																					<label for="smile4"></label>
																					<input type="radio" name="smileRating" id="smile3" value="3">
																					<label for="smile3"></label>
																					<input type="radio" name="smileRating" id="smile2" value="2">
																					<label for="smile2"></label>
																					<input type="radio" name="smileRating" id="smile1" value="1">
																					<label for="smile1"></label>
																				</div>
											
											
											
													<div class="cleaner_h13"></div>							
											</div>
											<div><label for="ingredient" class="recipe-ingredient">วัตถุดิบ</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></div>
											<div><label for="meal" class="recipe-meal">มื้อ</label><span>
											<?php 
													$ccv = get_post_meta( get_the_ID(), 'check_meal', true ); 
													$ccts = array('breakfast','lunch','dinner','supper');
													$cctsTH = array('เช้า','กลางวัน','เย็น','ดึก');											
														if($ccv){
															$ccx = 0;
															foreach($ccts as $cct){ 
																if (in_array($cct, $ccv)) { echo $cctsTH[$ccx].' ';}
																	$ccx++;
																} 
															}
											?>
											</span></div>
											<p>
													<span class="recipe-like"></span>
													<span class="recipe-comment"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?> </span>
													<span class="recipe-date"><?php echo get_time_ago(get_the_ID()); ?></span>
											</p>
											<br class="clear"/>
									</div><!-- End detail-review -->
                                </div>								
                            </a>
                        </li>	
					<?php } ?>
					<?php if( get_post_type( $post ) == 'attachment' ){ 
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
					<?php } ?>	
					
						<?php } ?>		
				<?php wp_reset_query(); ?>		
					</ul>
	
					
					

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
