<?php/* Template Name: Create Celeb page */?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/celeb.css" />

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

<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
		
            <div class="content-by-meal-page">
                      
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
			</div><!--END content-by-meal-page-->
            
			<div class="content-celeb">
				<h2 class="title"><i class="celeb-icon"></i>เข้าครัวกับคนดัง</h2>
				<div class="wr-celeb">
					
						<section class="latest-celeb">
							<?php $latest_post = new WP_Query( array('post_type' => 'celeb-cooking', 'showposts' => '1', 'post_status' => 'publish', 'orderby' => 'post_date', 'order'   => 'DESC',) );
								if ( $latest_post->have_posts() ) :
									while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>
										<figure>
												<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>">
													<?php echo get_avatar( get_the_author_meta('ID'), 335 ); ?>	
												</a>
										</figure>
										<figure>
												<a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>">
													<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
													
													<a href="<?php the_permalink();?>">
													<?php echo imagesize($featuredImage,335,335); ?>
                                                    </a>
												</a>
										</figure>
										
										<div class="celeb-detail">
											<div class="celeb-author">
													<span class="celeb-name">
														<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>">
															<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>
														</a>
													</span>
													<span class="celeb-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
													<span class="celeb-date"><?php the_time(); ?></span>
													<br class="clear"/>
											</div><!-- End celeb-author -->
											<div class="celeb-author">
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
													/*$values = get_post_meta( get_the_ID(), 'check_meal', true ); 
													$row_count = count($values); $count = 0;
													if($values){ foreach($values as $value){
																    $count++; echo  $value; if($row_count > 1 && $count != $row_count ){ echo ', '; } }
														}*/
													$v = get_post_meta( get_the_ID(), 'check_meal', true ); 
													$ts = array('breakfast','lunch','dinner','supper');
													$tsTH = array('เช้า','กลางวัน','เย็น','ดึก');											
														if($v){
															$x = 0;
															foreach($ts as $t){ 
																if (in_array($t, $v)) { echo $tsTH[$x].' ';}
															$x++;
															} 
														}
												?>
												</span></li>
												<br class="clear"/>
											</ul>
											</div><!-- End celeb-author -->
											<div class="celeb-excerpt">
												<h3>เมนูล่าสุด</h3><h3><a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php echo the_title(); ?></a></h3>
												<p><?php echo substr_utf8(get_the_excerpt(),0,280);?><a href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>">อ่านต่อ</a></p>
											</div><!-- End celeb-excerpt  -->
										</div><!-- End celeb-author -->
									<?php endwhile; ?>
								<?php endif; ?>		
						<?php wp_reset_query(); ?>	
							<br class="clear"/>						
						</section>
						<ul class="grid effect-3 all-celeb" id="grid">
				
							<?php 
								$user_query = new WP_User_Query( array( 'role' => 'Celeb' ));
								if ( ! empty( $user_query->results ) ) {
									$count = 0;
									foreach ( $user_query->results as $celeb ) {
								 ?>  <?php $userceleb = $celeb->user_login; ?>
									<?php if($count == 1){ ?>
											<li>
												<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/banner-celeb.jpg">
											</li>
									<?php } if($count == 6){ ?> 
										<li>
											<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/banner-cooking.jpg">
										</li>
									<?php } if($count == 11){ ?> 
										<li>
											<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/banner-chef.jpg">
										</li>
									<?php }?>
										<li>
											<a href="<?php echo get_author_posts_url($celeb->ID);?>" title="<?php echo xprofile_get_field_data( 1, $celeb->ID);?>">
													<div class="box-image">
													<?php echo get_avatar( $celeb->ID,335); ?> 
													
													<div class="bg-review-title">
													<!-- pichchapa added all recipes count 19/05/2015-->
														<?php $post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" . $celeb->ID . "' AND post_type = 'celeb-cooking' AND post_status = 'publish'"); ?>
														 <span class="title-review-font"><?php echo xprofile_get_field_data( 1, $celeb->ID); ?></span>
														 <div style="margin-top:9px; width: 355px; background: url(<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/icon-menu.png) top left no-repeat;"><span style="font-family: supermarket;font-size: 15px; color: #333333; margin-left:30px;"><?php if( $post_count == 0 ){ echo 'ยังไม่มีสูตรอาหาร'; } else{ echo $post_count.' สูตรอาหาร'; } ?></span></div>
														 <div class="cleaner_h13"></div>
													</div>
													
												</div>								
											</a>
										</li>
								<?php	  $count++;
										}//End foreach
								}//End if ?>		
							<?php wp_reset_query(); ?>		
					</ul>
						
					
				</div><!--END wr-bistro--><br class="clear"/>
			</div><!--END content-celeb-->
			
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


