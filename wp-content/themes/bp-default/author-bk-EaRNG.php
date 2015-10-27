<?php /*Template Name: Tips Page */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/specialReview.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/celeb.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>



<script type="text/javascript" charset="utf-8">
		$(function() {
				var url = window.location.href;
				$("#menu-main_nav_sub a").each(function() {
					if (url == (this.href)) {
						$(this).closest("li").addClass("active");
					}
				});
			});   
		</script>
<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-home_page active"><a href="<?php echo home_url(); ?>/recipes/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
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
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/quick-easy/" >ทำเองได้ง่ายและเร็ว</a></li>
					<li class="menu-quick-easy_page active"><a href="<?php echo home_url(); ?>/celebcook/">เข้าครัวกับคนดัง</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/setmenu/">อาหารเซท</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/tip/">เคล็ดลับคู่หูทำอาหาร</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/create-recipe/"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: -30px;margin-top: 6px;">สร้างรายการอาหาร</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/all-recipes/">เมนูทั้งหมด</a></li>
					<!--<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/local-food/"><i class="icon5"> </i>อาหารรักประเทศไทย</a></li>-->
				</ul>
			</nav>
         
                     
					<?php include_once('/bg-time.php');?> 
             
      
        	</div><!-- End content-by-meal -->
			
			<div class="content-celeb">
					<?php get_query_var('author_name'); $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));?>
				<?php if ( $curauth ) {?>
				<h2 class="title"><i class="celeb-icon4"></i>
					<?php echo xprofile_get_field_data( 1,$curauth->id );?>
				</h2>
				<br class="clear"/>
				<div class="wr-celeb">
					<section class="latest-celebs">
						<?php $posts = new WP_Query( array( 'post_type' => 'celebcook', 'author_name' => $curauth->user_nicename, 'post_status' => 'publish', 'posts_per_page'=> 4, 'orderby' => 'post_date', 
												'order' => 'DESC' ));
											if ( $posts->have_posts() ) :			
												$count = 1; 
												while ( $posts->have_posts() ) : $posts->the_post(); ?>
														<?php if ( $count == 3 ) :?>	
														<div class="celeb-img">
															<h2><?php echo xprofile_get_field_data( 1, get_the_author_ID() );?></h2>
															<?php global $wpdb;
																	$results = $wpdb->get_results( 'SELECT * FROM wp_cimy_uef_data WHERE FIELD_ID = 1 AND USER_ID = '.get_the_author_ID(), OBJECT );
															 foreach($results as $result){?>
																<img src="<?php echo $result->VALUE;?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_ID() );?>" width="333"/>
															 <?php } ?>	
														</div>
														<?php endif; ?>
														<?php if ( $count == 1 || $count == 3 ) :?>	
														<div class="column">
														<?php endif; ?>	
																<?php
																	$ran = array("#ee4036","#8bc53f","#00adee");
																	$randomColor = $ran[array_rand($ran, 1)];
																	?>
																 <div class="box-t-celeb" style="border:2px solid <?php echo $randomColor;?>">
																	<div class="specialTitle"  style="background-color:<?php echo $randomColor;?>;" ><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
																	<?php $post_id = get_the_id();?>
																	<?php if (has_post_thumbnail( $post_id) ): ?>
																	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
																		<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" width="329" alt="<?php the_title(); ?>"/></a>
																	<?php endif; ?>
																	<ul class="celeb-info">
																		<li><label for="level" class="celeb-level">ระดับความง่าย</label>
																			<?php
																				$recipe_rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
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
																		</li>
																		<li><label for="ingredient" class="celeb-ingredient">วัตถุดิบหลัก</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span><br class="clear"/></li>
																		<li><label for="meal" class="celeb-meal">มื้อ</label><span><?php 
																				$values = get_post_meta( get_the_ID(), 'check_meal', true ); 
																				$itemsTH = array('เช้า','กลางวัน','เย็น','ดึก');
																				if($values){
																					foreach($values as $value){ 
																						if($value=='breakfast'){
																							echo 'เช้า ';
																						}else if($value=='lunch'){
																							echo 'กลางวัน ';
																						}else if($value=='dinner'){
																							echo 'เย็น ';
																						}else if($value=='supper'){
																							echo 'ดึก ';
																					}
																				}
																				}
																			?></span></li>
																		<br class="clear"/>
																	</ul>
																	<a class="celeb-more" href="<?php the_permalink();?>" title="<?php the_title(); ?>">ดูวิธีทำ</a>
																</div><!-- End box-t-celeb -->
														<?php if ( $count == 2 || $count == 4 ) :?>	
														</div><!-- End column -->
														<?php endif; ?>	
												<?php $count++; ?>
											<?php endwhile; else: ?>
														<p><?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?></p>
											<?php endif; ?>
											<?php wp_reset_query(); ?>
											<br class="clear"/>
						</section>
						<section style="width: 1040px; margin: 0 auto;">
								<ul class="grid effect-3" id="grid">
									<?php	$posts = new WP_Query( array( 'post_type' => 'celebcook', 'author_name' => $curauth->user_nicename, 'post_status' => 'publish', 'orderby' => 'post_date', 
															'order' => 'DESC' ));
											if ( $posts->have_posts() ) :			
												$count = 0; 
												while ( $posts->have_posts() ) : $posts->the_post(); 
													if ( $count > 3 ) :
													?>
														<li>
														
																<?php
																	$ran = array("#ee4036","#8bc53f","#00adee");
																	$randomColor = $ran[array_rand($ran, 1)];
																	?>
																 <div class="box-image" style="border:2px solid <?php echo $randomColor;?>">
																	<div class="specialTitle"  style="background-color:<?php echo $randomColor;?>;" ><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
																	<?php $post_id = get_the_id();?>
																	<?php if (has_post_thumbnail( $post_id) ): ?>
																	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
																	 <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><img src="<?php echo $image[0]; ?>" width="329" alt="<?php the_title(); ?>"/></a>
																	<?php endif; ?>
																	<div class="celeb-info-lazy">
																		<div>
																			<label for="level" class="celeb-level">ระดับความง่าย</label>
																			<?php
																				$recipe_rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
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
																		</div>
																		<div>
																			<label for="ingredient" class="celeb-ingredient">วัตถุดิบหลัก</label>
																			<span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span><br class="clear"/>
																		</div>
																		<div>
																			<label for="meal" class="celeb-meal">มื้อ</label>
																			<span><?php 
																					$values = get_post_meta( get_the_ID(), 'check_meal', true ); 
																					$itemsTH = array('เช้า','กลางวัน','เย็น','ดึก');
																					if($values){
																						foreach($values as $value){ 
																							if($value=='breakfast'){
																								echo 'เช้า ';
																							}else if($value=='lunch'){
																								echo 'กลางวัน ';
																							}else if($value=='dinner'){
																								echo 'เย็น ';
																							}else if($value=='supper'){
																								echo 'ดึก ';
																						}
																					}
																					}
																				?></span>
																		</div>
																		<br class="clear"/>
																	</div><!-- End celeb-info-lazy -->
																	<a class="celeb-more" href="<?php the_permalink();?>" title="<?php the_title(); ?>">ดูวิธีทำ</a>
																</div>
															
														</li>
														<?php endif; ?>
														<?php $count++; ?>
													<?php endwhile; else: ?>
														<p><?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?></p>
											<?php endif; ?>
											<?php wp_reset_query(); ?>
								</ul>
							<br class="clear"/>
						</section>
				<br class="clear"/>
			</div><!--End wr-celeb-->
			<?php }//End if ?>
            </div><!--End content-celeb-->
                	
					
					
           
				
				
            
            
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