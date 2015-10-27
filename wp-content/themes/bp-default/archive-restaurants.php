<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/outsideHome.css">
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
          
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
      
        	</div><!-- End content-by-meal -->
           <div style="clear:both"></div>
			<div class="outsideHome">
				
				<div class="specialZone">
					<div class="specialTitle">
						<div class="iconPos"><div class="imgIcon"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconSpecial2.png" width="60" height="62" /></div></div>
						<div class="menuTitle">สเปเชียลรีวิว</div>
						<div class="viewAll"><a href="../special_review">ดูรายการทั้งหมด <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconAll.png" style='vertical-align:middle'/></a></div>
						<div style="clear:both;"></div>
					</div>
					<?php
						query_posts(array( 	'post_type' => 'reviews',
											'showposts' => 1,
											'posts_per_page' => 1,
											'post__in'  => get_option( 'sticky_posts' ),
											'orderby' => 'rand'
										) 
								);  
						while ( have_posts() ) : the_post();
							$imageBg = get_field('background');
							/*if( !empty($imageBg) ): 
								$bg = $imageBg['url'];
							endif; */
					?>
					<div class="specialContent">
						<div class="imgBg"  style="background-color:white;"><img src="<?php echo $imageBg; ?>" width="100%" height="620"  style="-webkit-mask-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)));"></div>
						<div class="specialSelected">
						
							<div class="specialImg" style="width:980px;height:460px;overflow:hidden;">
								<?php
                                $bheader = get_field('special_bheader2');
								?>
										<a href="<?php the_permalink();?>"><?php echo imagesize($bheader,980,460); ?></a>
							</div>
							<div class="specialName"><?php the_field('special_bName'); ?></div>
							<div class="specialDetail" style="font-family:supermarket;font-size:22px;display:inline;"><?php the_field('special_bdesc');?></div><div class="readmore" style="display:inline;"><a href="<?php the_permalink();?>">...อ่านต่อ</a></div>
							</div>
					  </div>
				  </div>
					<?php
						endwhile
					?>
				</div><!-- END SPECIAL ZONE-->
				
				<div style="clear:both"></div>
				
				<div class="hitZone">
					<div class="hitTitle">
						<div align="center"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/hitImg.jpg" style="margin-top:-20px"/></div>
					</div>
					<div class="hitContent">
						<?php
						query_posts(array( 	'post_type' => 'restaurants',
											'showposts' => 4,
											'posts_per_page' => 1,
											'post__in'  => get_option( 'sticky_posts' ),
											'ignore_sticky_posts' => 1
										) 
								);  
						while ( have_posts() ) : the_post();
							$sqlHit = "SELECT *, meta_value AS bistroId,COUNT(*) AS reviewAmount
										FROM wp_postmeta 
										WHERE meta_key='review_bistroid'
										AND meta_value = '".get_the_id()."'
										GROUP BY bistroId 
										ORDER BY reviewAmount DESC";
							$resultHit = $wpdb->get_results($sqlHit);
							//echo $sqlHit;
						?>
						<div class="hitBox">
							<!--<div class="iconType"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconType.png" width="80" height="80" /></div>-->
							<div class="hitImg" align="center">
								<?php if (has_post_thumbnail( $post_id) ): ?>
									 <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
										<div class="imgCircle" style="background:url(<?php echo $image[0]; ?>) no-repeat;background-size: auto 255px"></div>
									<?php endif; ?>
							</div>
							<div class="hitDetail">
								<div class="bistroTitle"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconFlag2.png" width="20" height="22" /> <a href="<?php echo get_post_permalink($post_id); ?>"><?php echo the_title(); ?></a></div>
								<div class="bistroExcerp"><?php echo  substr_utf8(get_field('bistro_detail'),0,160);?></div>
								<div class="bistroHilight"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconMenu.png" width="24" height="14" /><font color="ff7b0a"> เมนูเด่น : </font><?php $bistro_hilight = explode("|",get_field('bistro_hilight'));?><?php echo $bistro_hilight[0];?></div>
								<div class="bistroMap"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconPin.png"/><font color="ff7b0a"> สถานที่ตั้ง : </font><?php echo get_field('bistro_path');?></div>
								<div class="bistroReview"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconReviewS.png" style="vertical-align:middle"/>  จำนวนรีวิวทั้งหมด <?php if($resultHit[0]->reviewAmount==''){echo "0";}else{echo $resultHit[0]->reviewAmount;} ?> ครั้ง<!--<img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/iconCommentS.png" width="16" height="13" style="padding-left:10px;" /> 2143 ความคิดเห็น--> </div>
							</div>
						</div><!--END HIT BOX 1-->
					<?php
						endwhile
					?>
				
					</div>
				</div>
				<!-- END HIT ZONE-->
				 <div style="clear:both"></div>
				<div class="varietyZone">
					<div class="varietyTitle">
						<div class="iconPos"><div class="imgIcon"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconVariety.png" width="60" height="62" /></div></div>
						<div class="menuTitle">วาไรตี้ร้านอร่อย</div>
						<div class="viewAll"><a href="/variety">ดูรายการทั้งหมด <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconAll.png" style='vertical-align:middle'/></a></div>
						<div style="clear:both;"></div>
					</div>
					<div class="varietyContent">
					<?php
						query_posts(array( 	'post_type' => 'recommended',
											'showposts' => 1,
											'orderby'=>'modified' ,
											'order' => 'DESC'
										) 
								);  
						while ( have_posts() ) : the_post();
							$vId = get_the_ID();
							$vDetail = get_the_excerpt();
					?>
					
						<div class="vbox1">
							<?php
									if (has_post_thumbnail( $vId) ):
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $vId ), array(380, 540) ); 
									endif;
							?>
							<div style="width:380;height:540;overflow:hidden"><?php echo imagesize($image[0],380,540); ?></div>
							<div class='description'>
								<div class='description_content'>
									<div class="vTitle"><a href="<?php the_permalink();?>"><?php the_title()." ";?></a>
									<?php if(get_field('varietyType')=='แนะนำร้านอาหารตามย่าน'){?>
									<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconMapS.png" width="20" height="27" />
									<?php } ?>
									</div>
									<div class="vDetail"><?php echo substr_utf8($vDetail,0,120);?> 
										<div class="readmore" ><a href="<?php the_permalink();?>">...อ่านต่อ</a></div>
									</div>
								</div>
							</div>
						</div>
						<?php endwhile; ?>
						<div class="vbox2">
							<?php
								query_posts(array( 	'post_type' => 'recommended',
													'showposts' => 4,
													'orderby'=>'modified' ,
													'order' => 'DESC',
													'offset' => '1'
													
												) 
										);  
								while ( have_posts() ) : the_post();
									$vId = get_the_ID();
									$vDetail = get_the_excerpt();
							?>
									<div class="vbox">
										<?php
											if (has_post_thumbnail( $vId) ):
													$image = wp_get_attachment_image_src( get_post_thumbnail_id( $vId ), array(380, 265) ); 
											endif;
										?>
										<div style="width:380;height:265;overflow:hidden"><?php echo imagesize($image[0],380,265); ?></div>
										<div class='description'>
											<div class='description_content'>
												<div class="vTitle"><a href="<?php the_permalink();?>"><?php the_title()." ";?></a> 
												<?php if(get_field('varietyType')=='แนะนำร้านอาหารตามย่าน'){?>
												<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconMapS.png" width="20" height="27" />
												<?php } ?>
												</div>
												<div class="vDetail"><?php echo substr_utf8($vDetail,0,120);?> 
													<div class="readmore" ><a href="<?php the_permalink();?>">...อ่านต่อ</a></div>
												</div>
											</div>
										</div>
									</div> <!-- END VBOX-->
							<?php endwhile; ?>
						</div><!-- END VBOX2-->
						
					</div> <!--END VARIETY CONTENT-->
					
				</div>
				<!-- END VARIETY ZONE-->
				 <div style="clear:both"></div>
				<div class="reviewZone">
					<div class="reviewTitle">
						<div class="iconPos"><div class="imgIcon"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconReviewM.png" width="60" height="62" /></div></div>
						<div class="menuTitle">รีวิวล่าสุด</div>
						<div class="viewAll"><a href="/allreview">ดูรายการทั้งหมด <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconAll.png" style='vertical-align:middle'/></a></div>
						<div style="clear:both;"></div>
					</div>
					<div class="reviewContent">
						<div class="revLeft">
							<div class="reviewBoxLatest">
								<?php
								$thePosts = query_posts(array( 	'post_type' => 'review',
																'showposts' => 1,
																'orderby'=>'date' ,
																'order' => 'DESC'
															) 
														);  
								
									if ( have_posts() ) : 
									while ( have_posts() ) : the_post();
										$author = get_the_author();
										$review_bistroid = get_field('review_bistroid');
										list($rank,$rankImg) = lvMember($post->post_author);
										global $wpdb;
										$sql_getBistro = "SELECT * FROM wp_posts WHERE ID='$review_bistroid'";
										$res_Bistro = $wpdb->get_results($sql_getBistro);
										$bistroName=$res_Bistro[0]->post_title; 
										$link = $res_Bistro[0]->guid;
										$linkToReview = $link."#review_".get_the_id();
										
								?>
									<div class="reviewLatest">
										<div class="reviewAvatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 65 ); ?></div>
										<div class="reviewAuthor"><img src="<?php echo $rankImg;?>" width="30" height="32" style="vertical-align:middle;display:inline-block;padding-right:5px;"/><?php echo $author;?> <font color="#959595"><?php the_time();?></font></div>
										<div class="rating">
										<?php 
											$sqlRating = "SELECT v3.meta_value AS rating
															FROM wp_postmeta v1
															INNER JOIN wp_posts v2
															ON v1.post_id =v2.ID
															LEFT  JOIN wp_postmeta v3
															ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
															WHERE v1.meta_value='".$res_Bistro[0]->ID."'  
															AND v1.meta_key='review_bistroid' AND v2.post_status='publish'";
											$resultRating = $wpdb->get_results($sqlRating);
											$Img_num_rows = $wpdb->num_rows;
											$point=0;
											foreach ($resultRating as $keyRating){
												$point += $keyRating->rating;
											} 
											if($Img_num_rows!=0){
												$percentRating = $point*(100/(5*$Img_num_rows));
											}else{
												$percentRating = 0;
											}
										?>
											<div class="stars" >
												<div class="rate" style="width:<?php echo $percentRating;?>%"></div>
												<input type="radio" name="rating2" id="star5" value="5">
												<input type="radio" name="rating2" id="star4" value="4">
												<input type="radio" name="rating2" id="star3" value="3">
												<input type="radio" name="rating2" id="star2" value="2">
												<input type="radio" name="rating2" id="star1" value="1">
											</div>
										</div>
										<div style="clear:both"></div>
										<div class="reviewBistroTitle">ร้าน <?php echo $bistroName;?></div>
										<div class="reviewBistroExcerp"><?php echo the_title();?></div>
										<div class="reviewBistroDetail"><?php echo substr_utf8(get_the_content(),0,150);?>												
											<div class="readmore"><a href="<?php echo $linkToReview;?>">...อ่านต่อ</a></div>
										</div>
										<?php 
											$sql_img = "SELECT * FROM wp_postmeta WHERE meta_key='review_image' AND post_id='".get_the_id()."' LIMIT 4";
											//echo $sql_img;
											$res_img = $wpdb->get_results($sql_img);
											$rows = $wpdb->num_rows;
											$img_id = $res_img[0]->meta_value;
											$image = wp_get_attachment_image_src($img_id, array(325, 240));
										?>
										<div class="reviewImg"><img src="<?php echo $image[0]?>" width="325"/></div>
										<div class="reviewLikeZone">
											<div class="reviewLike"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
											<div class="reviewOtherImg">
												<div style="padding-left:5px;float:right">
													<?php for($i=1;$i<$rows;$i++){
														$Oimg_id = $res_img[$i]->meta_value;
														$Oimage = wp_get_attachment_image_src($Oimg_id,array(50,50));
													?>
													<img src="<?php echo $Oimage[0];?>" width="50" height="50" />
													<?php } ?>
												</div>
											</div>
										</div>
									</div>
								<?php endwhile; 
								else : 
								?>
								<p>
								<?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								<?php endif; ?> 
							</div>
							<!---END REVIEW LATEST BOX ---->
							<div style="clear:both"></div>
							<div style="position:relative;float:left">
							<div class="bestMember">
								<?php include "include_bestmember.php";?>
								<div class="memberAll">
									<div class="member"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconMember.png" width="60" height="62" /></div>
									<div class="memberTitle">สมาชิก Foodsawasdee</div>
									
									<div class="memberPic">
										<?php $memberArray = array();
										$user_query = new WP_User_Query( array(  'orderby' => 'registered', 'number' => 4 , 'role' => 'Subscriber' ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
											<?php $user_info = get_userdata($username->ID); ?>
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 60); ?></a>
											
										<?php array_push($memberArray, $username->ID );	?>		
									<?php } }	//end foreach
										$user_query = new WP_User_Query( array( 'orderby' => 'rand', 'number' => 6, 'role' => 'Subscriber', 'exclude' => $memberArray ) );
									
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
											<?php $user_info = get_userdata($username->ID); ?>
												<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 60 ); ?></a>
										
									<?php } }//end foreach?>	
									</div>
								</div>
							</div>
							</div>
							<!---END BEST MEMBER BOX ---->
						</div>
						<!---END REVIEW LEFT ---->
						<div class="revRight">
							<ul class="grid effect-3" id="grid">
							<?php
									
									$args = array( 
												'post_type' => 'review',
												'offset' => 1,
												'showposts' => 4,
												'orderby' => 'date', 
												'order' => 'DESC' 
											);
									$thePosts = query_posts($args);
									if ( have_posts() ) : 

									while ( have_posts() ) : the_post();
										$author = get_the_author();
										$review_bistroid = get_field('review_bistroid');
										list($rank,$rankImg) = lvMember($post->post_author);
										global $wpdb;
										$sql_getBistro = "SELECT * FROM wp_posts WHERE ID='$review_bistroid'";
										$res_Bistro = $wpdb->get_results($sql_getBistro);
										$bistroName=$res_Bistro[0]->post_title; 
										$link = $res_Bistro[0]->guid;
										$linkToReview = $link."#review_".get_the_id();
								?>
									<li>
										<div class="reviewBox">
											<div class="review">
												<div class="reviewAvatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 65 ); ?></div>
												<div class="reviewAuthor"><img src="<?php echo $rankImg;?>" width="30" height="32" style="vertical-align:middle;display:inline-block;padding-right:5px;"/><?php echo $author;?> <font color="#959595"><?php the_time();?></font></div>
												<div class="rating">
												<?php 
												
												$sqlRating = "SELECT v3.meta_value AS rating
															FROM wp_postmeta v1
															INNER JOIN wp_posts v2
															ON v1.post_id =v2.ID
															LEFT  JOIN wp_postmeta v3
															ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
															WHERE v1.meta_value='".$res_Bistro[0]->ID."'  
															AND v1.meta_key='review_bistroid' AND v2.post_status='publish'";
															//echo $sqlRating;
												$resultRating = $wpdb->get_results($sqlRating);
												$Img_num_rows = $wpdb->num_rows;
												$point=0;
												foreach ($resultRating as $keyRating){
													$point += $keyRating->rating;
												} 
												if($Img_num_rows!=0){
													$percentRating = $point*(100/(5*$Img_num_rows));
												}else{
													$percentRating = 0;
												}
												?>
													<div class="stars" >
														<div class="rate" style="width:<?php echo $percentRating;?>%"></div>
														<input type="radio" name="rating2" id="star5" value="5">
														<input type="radio" name="rating2" id="star4" value="4">
														<input type="radio" name="rating2" id="star3" value="3">
														<input type="radio" name="rating2" id="star2" value="2">
														<input type="radio" name="rating2" id="star1" value="1">
													</div>
												
												
												</div>
												<div style="clear:both"></div>
												<div class="reviewBistroTitle"><a href="<?php echo get_permalink($res_Bistro[0]->ID);?>">ร้าน <?php echo $bistroName;?></a></div>
												<div class="reviewBistroExcerp"><?php echo the_title();?></div>
												<div class="reviewBistroDetail"><?php echo substr_utf8(get_the_content(),0,150);?>												
													<div class="readmore"><a href="<?php echo $linkToReview;?>">...อ่านต่อ</a></div>
												</div>
												<?php 
											$sql_img = "SELECT * FROM wp_postmeta WHERE meta_key='review_image' AND post_id='".get_the_id()."' LIMIT 4";
											//echo $sql_img;
											$res_img = $wpdb->get_results($sql_img);
											$rows = $wpdb->num_rows;
											$img_id = $res_img[0]->meta_value;
											$image = wp_get_attachment_image_src($img_id, array(325, 240));
										?>
										<div class="reviewImg"><img src="<?php echo $image[0]?>" width="325"/></div>
										<div class="reviewLikeZone">
											<div class="reviewLike"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
											<div class="reviewOtherImg">
												<div style="padding-left:5px;float:right">
													<?php for($i=1;$i<$rows;$i++){
														$Oimg_id = $res_img[$i]->meta_value;
														$Oimage = wp_get_attachment_image_src($Oimg_id,array(50,50));
													?>
													<img src="<?php echo $Oimage[0];?>" width="50" height="50" />
													<?php } ?>
												</div>
											</div>
										</div>
									</div><!---END REVIEW BOX ---->
									</li>
								<?php endwhile; 
								else : 
							?>
								<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
							<?php endif; ?> 
							</ul>
						</div>
						<!---END REVIEW RIGHT ---->
					</div>
					<!---END REVIEW CONTENT ---->
				</div>
				<!-- END REVIEW ZONE-->
				<div style="clear:both"></div>
			</div>
			<?php do_action( 'bp_after_archive' ); ?>
		</div><!-- .padder -->
	</div><!-- #content -->
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