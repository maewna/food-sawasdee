<?php/* Template Name: All Review Page*/?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/outsideHome.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>
<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-home_page"><a href="<?php echo home_url(); ?>/recipes/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-home_page active"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/hilight-trend-likesara/"><i class="icon3"> </i>Like สาระ</a></li>
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
		
            <div class="content-by-meal" style="margin-bottom: 5px;">
          
           			 
			 <nav id="navigation-sub" role="navigation">
						<ul id="menu-main_nav_sub">
							<li class="menu-quick-easy_page "><a href="<?php echo home_url(); ?>/special_review/" style="width:220px">สเปเชียลรีวิว</a></li>
							<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/variety/" style="width:220px">วาไรตี้ร้านอร่อย</a></li>
							<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/create-bistro/" style="width:220px"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: -30px;margin-top: 6px;">สร้างร้านอาหาร</a></li>
							<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/allbistro/" style="width:220px">ร้านอาหารทั้งหมด</a></li>
						</ul>
					</nav>
        
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
      
        	</div><!-- End content-by-meal -->

            
           <div style="clear:both"></div>
			<div class="outsideHome">
				
				
				<div class="reviewZone">
					<div class="reviewTitle">
						<div class="iconPos"><div class="imgIcon"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconReviewM.png" width="60" height="62" /></div></div>
						<div class="menuTitle">รีวิวล่าสุด</div>
						<!--<div class="viewAll"><a href="/bistroAll">ดูรายการทั้งหมด <img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/iconAll.png" style='vertical-align:middle'/></a></div>-->
						<div style="clear:both;"></div>
					</div>
					<div class="reviewContent" style="margin-top:20px;" >
						
						<div class="revLeft" style="width:100% !important">
							<ul class="grid effect-3" id="grid" >
							<style>
							.grid{
								max-width: 1200px;
							}
							ul.grid{
								margin:0 !important;
								padding:0 !important;
								width:1200px;
							}
							.grid li {
								width: 365px !important;
								padding-left:14px !important;
								padding-right:14px !important;
								opacity: 0;
							}
							</style>
							<?php
									
									$args = array( 
												'post_type' => 'review',
												'orderby' => 'date', 
												'order' => 'DESC' 
											);
									$thePosts = query_posts($args);
									if ( have_posts() ) : 
									$count=1;
									while ( have_posts() ) : the_post();
										
										$author = get_the_author();
										$review_bistroid = get_field('review_bistroid');
										global $wpdb;
										$sql_getBistro = "SELECT * FROM wp_posts WHERE ID='$review_bistroid'";
										$res_Bistro = $wpdb->get_results($sql_getBistro);
										$bistroName=$res_Bistro[0]->post_title; 
										$link = $res_Bistro[0]->guid;
										$linkToReview = $link."#review_".get_the_id();
									?>
									<li>
										<div class="reviewBox">
											<div <?php if($count==1){?>class="reviewLatest"<?php }else{?>class="review"<?php } ?>>
												<div class="reviewAvatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 65 ); ?></div>
												<div class="reviewAuthor"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/levelMember.png" width="30" height="32" style="vertical-align:middle;display:inline-block;padding-right:5px;"/><?php echo $author;?> <font color="#959595"><?php the_time();?></font></div>
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
									<?php
									if($count==1){
									?>
										<div class="bestMember" style="width:100%">
											<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/include_bestmember.css" />
											<div class="iconBest"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconBestReview.png" width="60" height="62" /></div>
											<div class="bestTitle">สุดยอด Food Sawasdee</div>
											<div class="bestSubTitle">ใน 30 วันที่ผ่านมา</div>
											<div class="rankMember">
												<div class="shopper"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/shopper.png" width="114" height="211" /></div>
												<div class="graph">
													<?php 
														$sql_topmember = "SELECT post_author,
																		COUNT(CASE WHEN post_type like 'review' then 1 ELSE NULL END) as review,
																		COUNT(CASE WHEN post_type like 'recipes' then 1 ELSE NULL END) as recipes,
																		COUNT(*) as allpost
																		FROM wp_posts
																		WHERE post_status='publish'
																		AND post_date > NOW() - INTERVAL 30 DAY
																		AND post_type IN ('review','recipes')
																		GROUP BY post_author 
																		ORDER BY allpost DESC
																		LIMIT 5";
														$query = $wpdb->get_results($sql_topmember);
														//$member_rows =	 $wpdb->num_rows;
														$lv = 5;
														for($i=0;$i<5;$i++){
															$author_id = $query[$i]->post_author;
														?>
															<div class="bar">	
																<?php echo $query[$i]->recipes;?> สูตร <br/><?php echo $query[$i]->review;?> รีวิว
																<?php echo get_avatar( $author_id,40); ?>
																<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/level-<?php echo $lv;?>.jpg" style="margin-top:5px;"/>
																<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/levelMember.png" style="position:absolute;margin-top:-40px;margin-left:-15px;">
															</div>
														<?php 
															$lv--;
														}
														?>
												</div> <!-- end graph-->
												<div style="clear:both"></div>
												<div style="float:left;"><a href="#" class="registerBtn">สมัครสมาชิกคลิกเลย</a></div>
												<div style="float:left;"><a href="#" class="loginBtn">Login</a></div>
											</div> <!---end rank member -->
											<div style="clear:both"></div>
											<div class="memberAll">
												<div class="member"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconMember.png" width="60" height="62" /></div>
												<div class="memberTitle">สมาชิก Foodsawasdee</div>
												
												<div class="memberPic">
													<?php $memberArray = array(); if ( bp_has_members( 'type=newest&max=4' ) ) : ?>    
													<?php while ( bp_members() ) : bp_the_member(); ?>                      
														<div style="display:inline-block;float:left;padding-right:6px;padding-bottom:10px;">
															<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=60&height=60') ?></a>
														</div>
													<?php array_push($memberArray, bp_get_member_user_id() );	?>										
													<?php endwhile; ?>
												<?php endif; ?>
												
												<?php 
												if ( bp_has_members( 'type=random&max=6&exclude='.implode(',',$memberArray)  ) ) :?>         
													<?php while ( bp_members() ) : bp_the_member(); ?>                      
															<div style="display:inline-block;float:left;padding-right:6px;padding-bottom:10px;">
															<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=60&height=60') ?></a>
															</div>
													<?php endwhile; ?>
												<?php endif; ?>
												</div>
											</div>
										</div>
										</div>
									<!---END BEST MEMBER BOX ---->
									<?php
									}
									?>
									</li>
									
								<?php 
								$count++;
								endwhile; 
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