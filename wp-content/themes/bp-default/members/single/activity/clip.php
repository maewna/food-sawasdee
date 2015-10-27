<?php

/**
 * BuddyPress - Clips
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
				$posts = $wpdb->get_results(" SELECT * FROM $wpdb->posts as t1 INNER JOIN $wpdb->postmeta as t2 ON t1.ID = t2.post_id WHERE t1.post_author = '".bp_displayed_user_id()."' AND t1.post_type = 'recipes' AND t1.post_status = 'publish' AND t2.meta_key = 'choose-clip' AND (t2.meta_value = 'url' OR t2.meta_value = 'upload') ORDER BY t1.post_date DESC ");
				if($posts){ ?>
					<ul class="grid effect-3" id="grid">	
				<?php
					foreach($posts as $post) { ?>
					<?php if( get_post_type( $post ) == 'recipes' || get_post_type( $post ) == 'celebcook' ){ ?>
					<?php  $recipeId = get_the_id();?>
						<li>
                        
                        
                        
                        
                        
                        
                            <a href="<?php the_permalink(); ?>">
                                 <div class="box-image">
                                	<div class="icon icon-recipe"></div>
                                	 
                                     
                                     
                          <?php $ch_clips = get_post_meta( $recipeId, 'choose-clip' );
						 	  if( $ch_clips ){
								  foreach($ch_clips as $ch_clip){ 
										if( $ch_clip == 'url' ){
											$urls = get_post_meta( $recipeId, 'url-clip' );
											if( $urls ){
												foreach($urls as $url){ 
												  parse_str( parse_url( $url, PHP_URL_QUERY ), $get_args); ?>
													<iframe width="227" src="https://www.youtube.com/embed/<?php echo $get_args['v']; ?>" frameborder="0" allowfullscreen></iframe><?php 
													}
											}
										}else if( $ch_clip == 'upload' ){
											$uploads = get_post_meta( $recipeId, 'upload-clip' );
											if( $uploads ){
												foreach($uploads as $upload){ 
        										$path = wp_get_attachment_url($upload);
													echo do_shortcode( '[video mp4="'.$path.'" width="227" height="150"]' );
												}
											}
										}
									}//End clip foreach
									
									
									
							
									
							  }//End if $ch_clips?>
                                     
                                     
                                     
                                     
                                     
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
									</div>
									<?php }//End if check user login ?>
                                    <div class="bg-review-title">
                                         <span class="title-recipe-font"><?php the_title(); ?></span>
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
											<?php 		$ccv = get_post_meta( get_the_ID(), 'check_meal', true ); 
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
