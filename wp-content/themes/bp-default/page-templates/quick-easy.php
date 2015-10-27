<?php/* Template Name: Quick & Easy */?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/cooking.css">
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
        <style>
        	.grid li img { max-width: none!important; }
        </style>

<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal-page" style="height: 195px;">
			
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?>
					 
					 
        	</div><!-- End content-by-meal -->
			<div class="content-quick-easy">
				<div class="wr-quick-easy">
						
							  <ul class="grid effect-3" id="grid">
											<?php 
												$posts = new WP_Query( array( 
																				'post_type' => 'cooking', 
																				'post_status' => 'publish', 
																				'posts_per_page' => -1, 
																				'orderby' => 'date', 
																				'order' => 'DESC',
																				'meta_query' => array(
																										array(
																											'key'     => 'timetocook',
																											'value'   => array( 5, 10, 15, 20, 25 ),
																											'compare' => 'IN',
																										),
																										array(
																											'key'     => 'recipe_rating',
																											'value'   => array( 4, 5 ),
																											'compare' => 'IN',
																										),
																								),																					
																			) 
																		);
												$y = 0;
												$count = 0; 
												if ( $posts->have_posts() ) :
													$total_post =  $posts->post_count;
													$num_show = floor( $total_post / 5 )*5;
														while ( $posts->have_posts() ) : $posts->the_post(); ?>
														<?php if( $count < $num_show) { ?>
																<?php if( $y == 0 ) { ?>
																						<?php if ( $count % 5 == 0 ) { ?>
																							<li style="width: 100%;">
																								<div style="width: 690px; height: 580px; float: left;">
																						<?php } //end $count % 5 == 0  ?>
																						<?php if ( $count % 5 != 4 ){ ?>
																							<a href="<?php the_permalink(); ?>">
																								 <figure class="box-image">
																									<?php $time_cook = get_post_meta( get_the_ID(), 'timetocook', true );?>
																									<div class="icon icon-<?php echo $time_cook;?>min"></div>
																									<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
                                                                                                    <?php echo imagesize($featuredImage,335,280);?>
																											
																									<div class="bg-review-title">
																										<div class="circular">
																											<?php echo get_avatar( get_the_author_meta('ID'),50); ?> 		
																										</div>
																										 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																										 <div class="recipe-info">
																											<a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a>
																											<label for="level" class="recipe-level">ระดับความง่าย</label>
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
																												<label for="ingredient" class="recipe-ingre">วัตถุดิบหลัก</label><span class="recipe-ingretxt"><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span>	
																											<br class="clear"/>
																										</div>
																										 <br class="clear"/>
																									</div>
																								</figure>								
																							</a>
																						<?php }else{ ?>
																						<div style="width: 335px; height: 580px; float: left;">
																							<a href="<?php the_permalink(); ?>">
																								 <figure class="box-image">
																									<?php $time_cook = get_post_meta( get_the_ID(), 'timetocook', true );?>
																									<div class="icon icon-<?php echo $time_cook;?>min"></div>
																									<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
																											<?php echo imagesize($featuredImage,335,570);?>
																									<div class="bg-review-title-v">
																										
																										<div class="circular">
																												<?php echo get_avatar(  get_the_author_meta('ID'),50); ?> 
																										</div>
																										
																										 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																										 <div class="recipe-info">
																												<a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a>
																												<label for="level" class="recipe-level">ระดับความง่าย</label>
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
																												<label for="ingredient" class="recipe-ingre">วัตถุดิบหลัก</label><span class="recipe-ingretxt"><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span>	
																											<br class="clear"/>
																										</div><!--End recipe-info-->
																										 <br class="clear"/>
																									</div>
																								</figure>								
																							</a>
																						</div>
																						<?php  }// end $count % 5 != 4  ?>	
																						<?php if ( $count % 5 == 3 ) { ?>
																							</div>
																						<?php }//end $count % 5 == 3  ?>	
																							
																						<?php if ( $count % 5 == 4 ) { ?>
																							</li>
																						<?php }//end $count % 5 == 4 ?>
															
																<?php } else { ?>
																						<?php if ( $count % 5 == 0 ) { ?>
																							<li style="width: 100%;">
																								<div style="width: 335px; height: 580px; float: left; margin-right: 10px;">
																									<a href="<?php the_permalink(); ?>">
																											 <figure class="box-image">
																												<?php $time_cook = get_post_meta( get_the_ID(), 'timetocook', true );?>
																												<div class="icon icon-<?php echo $time_cook;?>min"></div>
																												<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
																														<?php echo imagesize($featuredImage,335,570);?>
																												<div class="bg-review-title-v">
																													
																													<div class="circular">
																															<?php echo get_avatar(  get_the_author_meta('ID'),50); ?> 
																													</div>
																													
																													 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																													 <div class="recipe-info">
																															<a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a>
																															<label for="level" class="recipe-level">ระดับความง่าย</label>
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
																															<label for="ingredient" class="recipe-ingre">วัตถุดิบหลัก</label><span class="recipe-ingretxt"><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span>	
																														<br class="clear"/>
																													</div><!--End recipe-info-->
																													 <br class="clear"/>
																												</div>
																											</figure>								
																									</a>
																								</div>
																								<div style="width: 690px; height: 580px; float: left;">
																						<?php } else { ?>
																							<a href="<?php the_permalink(); ?>">
																									 <figure class="box-image">
																										<?php $time_cook = get_post_meta( get_the_ID(), 'timetocook', true );?>
																										<div class="icon icon-<?php echo $time_cook;?>min"></div>
																										<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>
																												<?php echo imagesize($featuredImage,335,280);?>
																										<div class="bg-review-title">
																											<div class="circular">
																												<?php echo get_avatar( get_the_author_meta('ID'),50); ?> 		
																											</div>
																											 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																											 <div class="recipe-info">
																												<a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a>
																												<label for="level" class="recipe-level">ระดับความง่าย</label>
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
																													<label for="ingredient" class="recipe-ingre">วัตถุดิบหลัก</label><span class="recipe-ingretxt"><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span>	
																												<br class="clear"/>
																											</div>
																											 <br class="clear"/>
																										</div>
																									</figure>								
																							</a>
																						<?php } //end $count % 5 == 0  ?>
																						
																						<?php if ( $count % 5 == 4 ){ ?>
																								</div>
																							</li>
																						<?php } //end $count % 5 == 4 ?>
																<?php }//end $y==0 
														} //end $count < $num_show  ?> 
														<?php 
															if( $count % 5 == 4 && $count != 0 ){
																if( $y == 0 ){ $y = 1; }else{ $y = 0; }
															}
															$count++; 
														?>
														<?php  endwhile; endif; ?>		
												<?php wp_reset_query(); ?>														
							  </ul>
							
						  
					</div><!--END wr-quick-easy-->
					<br class="clear"/>					
						  
				<div class="content-box">
			
					
						<div class="cleaner_h30"></div>
		
			 </div><!--End content-box-->    
          
						  
						  
						  
						  
						  
				
			</div><!--END content-easy-cook-->	
		
			
						
			
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