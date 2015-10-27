<?php/* Template Name: Local food page */?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/search.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/cooking.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />


<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.paginate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			 $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});                                   
			});    
		  </script>
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
		
		<?php do_action( 'template_notices' ); ?>
		
		
            <div class="content-by-meal-page" style="height: 195px;">
				  <?php  if (is_page( '1474' ) ) { ?>
			 <nav id="navigation-sub" role="navigation">
				<ul id="menu-main_nav_sub">
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/quick-easy/" ><i class="icon1"> </i>ทำเองได้ง่ายและเร็ว</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/celebcook/"><i class="icon2"> </i>เข้าครัวกับคนดัง</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/setmenu/"><i class="icon3"> </i>อาหารเซท</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/tip/"><i class="icon4"> </i>เคล็ดลับคู่หูทำอาหาร</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/local-food/"><i class="icon5"> </i>อาหารรักประเทศไทย</a></li>
				</ul>
			</nav>
               <?php } ?>  
                     
					<?php include_once('/../bg-time.php');?> 
					 
					 
        	</div><!-- End content-by-meal -->
       
				
			<div class="content-local">
				<div class="top-scroll">
					<a href="#north"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/n-local.png"/></a>
					<a href="#west"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/w-local.png"/></a>
					<a href="#central"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/c-local.png"/></a>
					<a href="#east"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/e-local.png"/></a>
					<a href="#south"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/s-local.png"/></a>
				</div><!--End top-scroll-->
				
				
					
						<section>
								<div class="box-local north">
									<h2 id="north">ภาคเหนือ</h2>
									<ul id="itemContainer" style="list-style: none;">
									<?php  
										$north = new WP_Query( array( 
																				'post_type' => 'recipes', 
																				'post_status' => 'publish', 
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
																										array(
																											'key' => 'recipe_thaifood',
																											'value' => 'north',
																											'compare' => 'LIKE',
																										),
																								),																					
																			) 
																		); ?>
										<?php if ( $north->have_posts() ) :
											while ( $north->have_posts() ) : $north->the_post(); ?>															
															<li>
															<a href="<?php the_permalink(); ?>">
																 <figure class="wr-image" style="width:335px; height: 290px;">
																	<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($north->ID) ); ?>
																			<img src="<?php echo $featuredImage;?>" height="290" alt="<?php the_title(); ?>"/>
																	<div class="bg-review-title">
																		<div class="circular">
																			<?php echo get_avatar(get_the_author_meta('ID'),50); ?> 		
																		</div>
																		 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																		 <ul class="recipe-info">
																			<li><a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a><span></span></li>
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
																		 <br class="clear"/>
																	</div>
																</figure>								
															</a>
															</li>
															
											<?php endwhile; ?>
										<?php endif; ?>	

									<?php wp_reset_query(); ?>
									</ul>
									<br class="clear"/>
									<!-- navigation holder -->
									<div class="holder" style="margin-left: 140px; margin-top: 0px;"></div>
									
								</div><!-- End north -->
								<div class="box-local west">
									<h2 id="west">ภาคตะวันตก</h2>
								
									<?php wp_reset_query(); ?>
								</div><!-- End west -->
								<div class="box-local central">
									<h2 id="central">ภาคกลาง</h2>
									<ul id="itemContainer" style="list-style: none;">
									<?php  
										$central = new WP_Query( array( 
																				'post_type' => 'recipes', 
																				'post_status' => 'publish', 
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
																										array(
																											'key' => 'recipe_thaifood',
																											'value' => 'central',
																											'compare' => 'LIKE',
																										),
																								),																					
																			) 
																		); ?>
										<?php if ( $central->have_posts() ) :
											while ( $central->have_posts() ) : $central->the_post(); ?>															
															<li>
															<a href="<?php the_permalink(); ?>">
																 <figure class="wr-image" style="width:335px; height: 290px;">
																	<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($central->ID) ); ?>
																			<img src="<?php echo $featuredImage;?>" height="290" alt="<?php the_title(); ?>"/>
																	<div class="bg-review-title">
																		<div class="circular">
																			<?php echo get_avatar(get_the_author_meta('ID'),50); ?> 		
																		</div>
																		 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																		 <ul class="recipe-info">
																			<li><a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a><span></span></li>
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
																		 <br class="clear"/>
																	</div>
																</figure>								
															</a>
															</li>
															
											<?php endwhile; ?>
										<?php endif; ?>	

									<?php wp_reset_query(); ?>
									</ul>
									<br class="clear"/>
									<!-- navigation holder -->
									<div class="holder" style="margin-left: 140px; margin-top: 0px;"></div>
									
								</div><!-- End central -->
								<div class="box-local east">
									<h2 id="east">ภาคตะวันออกเฉียงเหนือ</h2>
									<ul id="itemContainer" style="list-style: none;">
									<?php  
										$east = new WP_Query( array( 
																				'post_type' => 'recipes', 
																				'post_status' => 'publish', 
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
																										array(
																											'key' => 'recipe_thaifood',
																											'value' => 'east',
																											'compare' => 'LIKE',
																										),
																								),																					
																			) 
																		); ?>
										<?php if ( $east->have_posts() ) :
											while ( $east->have_posts() ) : $east->the_post(); ?>															
															<li>
															<a href="<?php the_permalink(); ?>">
																 <figure class="wr-image" style="width:335px; height: 290px;">
																	<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($east->ID) ); ?>
																			<img src="<?php echo $featuredImage;?>" height="290" alt="<?php the_title(); ?>"/>
																	<div class="bg-review-title">
																		<div class="circular">
																			<?php echo get_avatar(get_the_author_meta('ID'),50); ?> 		
																		</div>
																		 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																		 <ul class="recipe-info">
																			<li><a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a><span></span></li>
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
																		 <br class="clear"/>
																	</div>
																</figure>								
															</a>
															</li>
															
											<?php endwhile; ?>
										<?php endif; ?>	

									<?php wp_reset_query(); ?>
									</ul>
									<br class="clear"/>
									<!-- navigation holder -->
									<div class="holder" style="margin-left: 140px; margin-top: 0px;"></div>
									
								</div><!-- End east -->
								<div class="box-local south">
									<h2 id="south">ภาคใต้</h2>
									<ul id="itemContainer" style="list-style: none;">
									<?php  
										$south = new WP_Query( array( 
																				'post_type' => 'recipes', 
																				'post_status' => 'publish', 
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
																										array(
																											'key' => 'recipe_thaifood',
																											'value' => 'south',
																											'compare' => 'LIKE',
																										),
																								),																					
																			) 
																		); ?>
										<?php if ( $south->have_posts() ) :
											while ( $south->have_posts() ) : $south->the_post(); ?>															
															<li>
															<a href="<?php the_permalink(); ?>">
																 <figure class="wr-image" style="width:335px; height: 290px;">
																	<?php $featuredImage = wp_get_attachment_url( get_post_thumbnail_id($south->ID) ); ?>
																			<img src="<?php echo $featuredImage;?>" height="290" alt="<?php the_title(); ?>"/>
																	<div class="bg-review-title">
																		<div class="circular">
																			<?php echo get_avatar(get_the_author_meta('ID'),50); ?> 		
																		</div>
																		 <h3 class="title-review-font"><?php echo substr_utf8(get_the_title(),0,30);?></h3>
																		 <ul class="recipe-info">
																			<li><a class="recipe-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?></a><span></span></li>
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
																		 <br class="clear"/>
																	</div>
																</figure>								
															</a>
															</li>
															
											<?php endwhile; ?>
										<?php endif; ?>	

									<?php wp_reset_query(); ?>
									</ul>
									<br class="clear"/>
									<!-- navigation holder -->
									<div class="holder" style="margin-left: 140px; margin-top: 0px;"></div>
									
								</div><!-- End south -->	
						</section>	
				<br class="clear"/>
			</div><!--END content-local-->
			
</main>
<script type="text/javascript">
$(function() {

    $("div.holder").jPages({
      containerID : "itemContainer",
	  perPage: 3,
      <!--first       : "หน้าแรก",-->
      previous    : "หน้าก่อนหน้า",
      next        : "หน้าถัดไป",
      <!--last        : "หน้าสุดท้าย"-->
	  
    });
	
  });
</script>
<?php get_footer(); ?>