<?php /* Template Name: Create Cooking page */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/cooking.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery-1.8.2.min.js"></script>
		<!-- FlexSlider Earng -->
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.flexslider.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
<script type="text/javascript">

			$(document).ready(function(){
			 $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});  
			 
			  $('.flexslider').flexslider({
				animation: "slide",
				controlNav: false,
				start: function(slider){
				  $('body').removeClass('loading');
				}
			  });      
			                             
			});    
		  </script>
<?php 	$th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
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
		
		
            <div class="content-by-meal-page" style="height: 195px;">

			
              
 			<?php include_once('wp-content/themes/bp-default/bg-time.php');?>
					 
        	</div><!-- End content-by-meal -->
            
			<div class="content-easy-cook">
				<h2 class="title"><i class="easy-cook-icon"></i>เมนูทำเองได้ง่ายและเร็ว</h2>
				<a href="<?php echo get_site_url().'/quick-easy';?>" class="link-more">ดูรายการทั้งหมด</a>
				<br class="clear"/>
                
                
                
				<div class="wr-easy-cook">
						<section class="slider">
							<div class="flexslider">
							  <ul class="slides">
											<?php $posts = new WP_Query( array( 
																				'post_type' => 'cooking', 
																				'post_status' => 'publish', 
																				'posts_per_page' => 25, 
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
																								),																					) 
																		);
												$count = 0; 
												if ( $posts->have_posts() ) :
													$total_post =  $posts->post_count;
													$num_show = floor( $total_post / 5 )*5;
														while ( $posts->have_posts() ) : $posts->the_post(); ?>
																<?php if( $count < $num_show) {?>
																<?php if ( $count % 5 == 0 ) { ?>
																	<li>
																		<div style="width: 690px; height: 580px; float: left;">
																<?php }//End $count % 5 == 0 ?>
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
																				</div><!--End recipe-info-->
																				 <br class="clear"/>
																			</div>
																		</figure>								
																	</a>
																<?php }else{ ?>
																<div style="width: 330px; height: 580px; float: left;">
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
																<?php  } //End $count % 5 != 4 ?>	
																<?php if ( $count % 5 == 3 ) { ?>
																	</div>
																<?php } //End $count % 5 == 3 ?>	
																<?php if ( $count % 5 == 4 ) { ?>
																	</li>
																<?php } //End $count % 5 == 4 ?>
															
														<?php } $count++; endwhile; 
												endif; ?>		
												<?php wp_reset_query(); ?>														
							  </ul>
							</div><!--END flexslider-->
						  </section>
				</div><!--END wr-easy-cook--><br class="clear"/>
			</div><!--END content-easy-cook-->
			<div class="content-celeb">
				<h2 class="title h-left"><i class="celeb-icon"></i>เข้าครัวกับคนดัง</h2>
				<h2 class="title h-right"><i class="celeb-icon"></i>กระทะร้อนกับเซเลบ</h2>
				<br class="clear"/>
					<div class="wr-celeb">
						<div class="bg-celeb">
							<section class="post-celeb">
								<?php	$sticky = get_option( 'sticky_posts' ); 
										$celebcook = new WP_Query( array( 'post__in' => $sticky, 'post_type' => 'celeb-cooking', 'posts_per_page' => '1', 'post_status' => 'publish', 'orderby' => 'post_date', 'order' => 'DESC') ); ?>	
								<?php	$celebcookID = 0; ?>
								<?php if ( $celebcook->have_posts() ) :
									while ( $celebcook->have_posts() ) : $celebcook->the_post(); 
										$celebcookID = $post->ID; ?>
											<article>					
													<figure class="avatar-celeb">
														<a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>" title="<?php echo xprofile_get_field_data( 1, $post->post_author);?>">
															<?php echo get_avatar( $post->post_author, 280 ); ?>	
														</a>
													</figure>		
													<figure class="thumb-celeb" style="width: 360px; height:340px; overflow: hidden;">
													<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
														<?php /*<img src="<?php echo $featuredImage;?>" height="340"/>	*/?>
	
														<a href="<?php the_permalink();?>"><?php echo imagesize($featuredImage,360,300); ?></a>		

																																			
													</figure>
													<br class="clear"/>
														
													<div class="about-celeb">
														<div class="celeb-bg-sticky">
															<a class="name" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>" title="<?php echo xprofile_get_field_data( 1, $post->post_author);?>"><?php echo xprofile_get_field_data( 1, $post->post_author);?></a>
															<span class="view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
															<span class="date"><?php the_time(); ?></span>
														</div>
                                                        <div class="celeb-detail">
                                                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php echo substr_utf8(get_the_title(),0,55); ?></a></h3>
                                                        <p>
                                                            <?php echo get_excerpt(680); ?>
                                                        </p>
                                                        </div>
													<br class="clear"/>
													</div><!--End about-celeb-->
                                                    <div class="detail-celeb">
													<ul>
														<li><label for="level" class="recipe-level">ระดับความง่าย</label>
																			<?php	
																				$recipe_rating = get_post_meta( $post->ID, 'recipe_rating', true );
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
														<li>
														<label for="ingredient" class="recipe-ingre">วัตถุดิบหลัก</label><span class="recipe-ingretxt"><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></li>
														<li><label for="meal" class="recipe-meal">มื้อ</label><span><?php 
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
												?></span></li>
														<br class="clear"/>
													</ul>
													<div class="align-right" style="margin-top: 50px;margin-right: -98px;">  
														<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?>
													</div>
													<br class="clear"/> 
												</div><!--End detail-celeb-->
											</article>
									<?php endwhile; ?>
								<?php endif; ?>	
								<?php wp_reset_query(); ?>	
							</section>
							<aside class="side-bar-celeb">
								<section class="celeb-members">
										<ul>			
										<?php 
										$user_query = new WP_User_Query( array( 'role' => 'Celeb', 'orderby' => 'registered', 'number' => 3 ) );
										$recent_users = $user_query->get_results();
										foreach ($recent_users as $username) { ?>
										<li>
											<a href="<?php echo get_author_posts_url($username->ID);?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 80 ); ?></a>
										</li>					
										<?php		
											}	//end foreach
										?>
									   <br class="clear"/>
									   </ul>
									<?php wp_reset_query(); ?>
								</section><!--End celeb-members-->
								<section class="latest-celeb-recipe">
									<h2 class="title h-right"><i class="varity-icon"></i>เมนูล่าสุด</h2>
									
									<?php 
									$args = array(  
										'post__not_in' => array($celebcookID),
										'post_type'		 => 'celeb-cooking',
										'post_status'    => 'publish',
										'date_query'     => array( array( 'after' => '-1 month' ) )
									); 
									$latest = new WP_Query( $args ); 
									$count = 0; 
									?>
										<?php if ( $latest->have_posts() ) :
												$total_latest =  rand ( 1 , $latest->post_count );
											while ( $latest->have_posts() ) : $latest->the_post(); 
													$count++;
													if ($count == $total_latest) :
											?>												
															<a href="<?php the_permalink(); ?>">
																 <figure class="box-image" style="width:320px; height: 330px;">
																	<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($latest->ID) ); ?>
																			<img src="<?php echo $featuredImage;?>" height="330" alt="<?php the_title(); ?>"/> 
																	<div class="bg-review-title">
																		<div class="circular">
																			<?php echo get_avatar( get_the_author_meta('ID'), 50 ); ?>	
																		</div>
																		 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																		 <div class="recipe-info">
																			<a class="recipe-user" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' ));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a>
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
												<?php 		endif; 
														endwhile; ?>
												<?php endif; ?>	
												<?php wp_reset_query(); ?>		
									<br class="clear"/>
								</section><!--End latest-celeb-recipe-->
							</aside>
							<br class="clear"/>								
						</div><!--END bg-celeb-->
					</div><!--END wr-celeb-->	
					
				
			</div><!--END content-celeb-->
			<div class="content-set">
				<h2 class="title align-left"><i class="set-icon"></i>อาหารเซท</h2>
				<a href="<?php echo get_site_url().'/setmenu';?>"  class="link-more">ดูรายการทั้งหมด</a>
				<br class="clear"/>
				<div class="wr-set">
						<h2>อาหารเซทสำหรับคนรักสุขภาพ</h2><br class="clear"/>
						<section class="show-set">							
							<?php   $setmenu = new WP_Query( array( 'post_type' => 'set-menu', 'posts_per_page' => '1', 'post_status' => 'publish', 'orderby' => 'post_date', 'order' => 'DESC') ); ?>
								<?php if ( $setmenu->have_posts() ) :
									while ( $setmenu->have_posts() ) : $setmenu->the_post(); ?>		
										<div class="box-set">
											<div class="set-dessert">
												<?php $p2s = get_field('iddessert'); $p2surl = wp_get_attachment_url( get_post_thumbnail_id( $p2s[0] ) ); ?>
      <?php echo imagesize($p2surl,307,307); ?>
												<h3><?php echo substr_utf8( get_the_title ( $p2s[0] ),0,50 );?></h3>
											</div><!--End set-dessert-->
											<p class="h-dessert">อาหารหวาน</p>
										</div>
										<div class="box-set">
											
											<div class="set-main-course">
											<div class="icon-add-l"></div>
											<div class="icon-add-r"></div>
												<?php $p1s = get_field('idmaincourse'); $p1surl = wp_get_attachment_url( get_post_thumbnail_id( $p1s[0] ) ); ?>
      <?php echo imagesize($p1surl,357,367); ?>
												<h3><?php echo substr_utf8( get_the_title ( $p1s[0] ),0,50 );?></h3>
											</div><!--End set-main-course-->
											<p>อาหารคาว</p>
										</div>
										<div class="box-set">
											<div class="set-drink">
												<?php $p3s = get_field('iddrink'); $p3surl = wp_get_attachment_url( get_post_thumbnail_id( $p3s[0] ) ); ?>
      <?php echo imagesize($p3surl,307,307); ?>
												<h3><?php echo substr_utf8( get_the_title ( $p3s[0] ),0,50 );?></h3>
											</div><!--End set-drink-->
											<p class="h-drink">เครื่องดื่ม</p>
										</div>
									<?php endwhile; ?>
									<?php endif; ?>	
									<?php wp_reset_query(); ?>									
						</section>
						<br class="clear"/>
				</div><!--END wr-set-->
				<div class="wr-etc">
					<section class="show-tip">
						<h2 class="title"><i class="tip-icon"></i>เคล็ดลับคู่หูทำอาหาร</h2>
						<?php $setmenu = new WP_Query( array( 'post_type' => 'kitchen-tips', 'posts_per_page' => '1', 'post_status' => 'publish', 'orderby' => 'post_date', 'order' => 'DESC') ); ?>
								<?php if ( $setmenu->have_posts() ) :
									while ( $setmenu->have_posts() ) : $setmenu->the_post(); ?>	
										<figure class="thumb-tip">
											
											<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
											<a href="<?php the_permalink();?>"><?php echo imagesize($featuredImage,330,210); ?></a>

											<h3><?php echo substr_utf8(get_the_title(),0,30);?></h3>												
										</figure>
																				
									<?php endwhile; ?>
								<?php endif; ?>	
						<?php wp_reset_query(); ?>		
					</section>
					<section class="show-highlight">
						<h2 class="title"><i class="tip-icon"></i>เมนู highlight</h2>
						<?php	$stick = get_option( 'sticky_posts' ); 
										$highlight = new WP_Query( array( 'post__in' => $stick, 'post_type' => 'cooking', 'posts_per_page' => '1', 'post_status' => 'publish', 'orderby' => 'rand') ); ?>
								<?php if ( $highlight->have_posts() ) :
									while ( $highlight->have_posts() ) : $highlight->the_post(); ?>	
								
													<figure class="thumb-highlight" style="width: 325px; height: 450px; overflow: hidden;">
														
														<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
														
														<a href="<?php the_permalink();?>"><?php echo imagesize($featuredImage,325,450); ?></a>

														<div class="bg-review-title-h">
															<div class="circular">
																<?php echo get_avatar( $post->post_author, 50 ); ?>	
															</div>
															<h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
															<div class="recipe-info">
																<a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $post->post_author ); ?>" title="<?php echo xprofile_get_field_data( 1, $post->post_author);?>"><?php echo xprofile_get_field_data( 1, $post->post_author);?></a><span></span>
																<label for="level" class="recipe-level">ระดับความง่าย</label>
																<?php	
																				$recipe_rating = get_post_meta( $post->ID, 'recipe_rating', true );
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
															</div><!-- End recipe-info-->
														</div><!--End bg-review-title-->
													</figure>	
									<?php endwhile; ?>
								<?php endif; ?>	
								<?php wp_reset_query(); ?>
						
					</section>
					<section class="show-others">
						<h2 class="title">อาหารอื่น</h2>
						<h3>อาหารคาว</h3>
						<p>
							<?php 	global $wpdb;
								$alacartes = $wpdb->get_results("SELECT ID,post_title FROM wp_posts LEFT JOIN wp_postmeta ON ID = post_id WHERE post_status = 'publish' AND post_type = 'cooking' AND meta_key = 'recipe_type' AND ( meta_value LIKE '%alacarte%' OR meta_value LIKE '%dishes%' )  ORDER BY post_date DESC LIMIT 3");
									if ( $alacartes) { foreach ( $alacartes as $alacarte){ ?>
										<a href="<?php echo get_permalink( $alacarte->ID ); ?>" title="<?php echo $alacarte->post_title; ?>"><?php echo $alacarte->post_title; ?></a>
							<?php	} } ?>
						</p>
						<h3>อาหารหวาน</h3>
						<p>
							<?php 	$snacks = $wpdb->get_results("SELECT ID,post_title FROM wp_posts LEFT JOIN wp_postmeta ON ID = post_id WHERE post_status = 'publish' AND post_type = 'cooking' AND meta_key = 'recipe_type' AND ( meta_value LIKE '%dessert%' OR meta_value LIKE '%snacks%' )  ORDER BY post_date DESC LIMIT 3");
									if ( $snacks) { foreach ( $snacks as $snack){ ?>
										<a href="<?php echo get_permalink( $snack->ID ); ?>" title="<?php echo $snack->post_title; ?>"><?php echo $snack->post_title; ?></a>
							<?php	} } ?>
						</p>
						<h3>เครื่องดื่ม</h3>
						<p>
							<?php 	$drinkings = $wpdb->get_results("SELECT ID,post_title FROM wp_posts LEFT JOIN wp_postmeta ON ID = post_id WHERE post_status = 'publish' AND post_type = 'cooking' AND meta_key = 'recipe_type' AND meta_value LIKE '%drinking%' ORDER BY post_date DESC LIMIT 3");
									if ( $drinkings) { foreach ( $drinkings as $drinking){ ?>
										<a href="<?php echo get_permalink( $drinking->ID ); ?>" title="<?php echo $drinking->post_title; ?>"><?php echo $drinking->post_title; ?></a>
							<?php	} } ?>
						</p>
						<h3>ซีฟู้ด</h3>
						<p>
							<?php 	$drinkings = $wpdb->get_results("SELECT ID,post_title FROM wp_posts LEFT JOIN wp_postmeta ON ID = post_id WHERE post_status = 'publish' AND post_type = 'cooking' AND meta_key = 'recipe_type' AND meta_value LIKE '%seafood%' ORDER BY post_date DESC LIMIT 3");
									if ( $drinkings) { foreach ( $drinkings as $drinking){ ?>
										<a href="<?php echo get_permalink( $drinking->ID ); ?>" title="<?php echo $drinking->post_title; ?>"><?php echo $drinking->post_title; ?></a>
							<?php	} } ?>
						</p>
					</section>
					<br class="clear"/>
				</div>
			</div><!--END content-set-->
			<?php /*
			<div class="content-thai">
				<h2 class="title"><i class="thai-icon"></i>อาหารรักประเทศไทย</h2>
				<a href="<?php echo get_site_url().'/local-food';?>" class="link-more">ดูรายการทั้งหมด</a>
				<br class="clear"/>
				<div class="wr-thai">
					
						<section>
						<?php	$args = array( 
														'post_type' => 'cooking', 
														'post_status' => 'publish',
														'posts_per_page' => 6, 	
														'orderby' => 'date', 
														'order' => 'DESC',
														'meta_query' => array(
																					'relation' => 'AND',
																					array(
																							'key' => 'admin_approve',
																							'value' => 'yes',
																							'compare' => 'LIKE',
																						),
																					array(
																							'key' => 'regis_thaifood',
																							'value' => 'yes',
																							'compare' => 'LIKE',
																						),
																					array(
																							'key' => 'recipe_national',
																							'value' => 'thai',
																							'compare' => 'LIKE',
																						),
																				),																					
																			); 
								$thaifood = new WP_Query( $args ); ?>
								<?php if ( $thaifood->have_posts() ) {
									$count = 0;
									while ( $thaifood->have_posts() ) : $thaifood->the_post(); ?>		
									<figure class="thumb-thailand">
									<?php if($count == 1){ ?>
										<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/thailand-banner.jpg" width="335" height="290" />
									<?php }else{?>
											<?php $post_id = get_the_id();?>
											<?php if (has_post_thumbnail( $post_id) ): ?>
												 <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
												 <a href="<?php the_permalink();?>"><img src="<?php echo $image[0]; ?>" width="335" /></a>
											<?php endif; ?>	
											<div class="bg-review-title">
												<div class="circular">
													<?php echo get_avatar( $post->post_author, 50 ); ?>		
												</div>
												<h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
													<ul class="recipe-info">
														<li><a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $post->post_author ); ?>" title="<?php echo xprofile_get_field_data( 1, $post->post_author);?>"><?php echo xprofile_get_field_data( 1, $post->post_author);?></a><span></span></li>
														<li><label for="level" class="recipe-level">ระดับความง่าย</label>
																			<?php	
																				$recipe_rating = get_post_meta( $post->ID, 'recipe_rating', true );
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
														<li><label for="ingredient" class="recipe-ingredient">วัตถุดิบหลัก</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></li>	
														<br class="clear"/>
													</ul>
											</div><!--End bg-review-title-->
									<?php }?>				
									</figure>
													
												
												
											
													
									<?php   $count++;
											endwhile; ?>
								<?php }//endif ?>	
								<?php wp_reset_query(); ?>	
							<br class="clear"/>					
						</section>	
				</div><!--END wr-thai--><br class="clear"/>
			</div><!--END content-thai--> */?>
			
</main>


<?php get_footer(); ?>