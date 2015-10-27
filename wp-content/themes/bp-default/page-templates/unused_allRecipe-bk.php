<?php/* Template Name: All recipes Back Up page */?>
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
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal-page" style="height: 195px;">
			<nav id="navigation-sub" role="navigation">
				<ul id="menu-main_nav_sub">
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/quick-easy/" >ทำเองได้ง่ายและเร็ว</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/celebcook/">เข้าครัวกับคนดัง</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/setmenu/">อาหารเซท</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/tip/">เคล็ดลับคู่หูทำอาหาร</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/create-recipe/"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: -30px;margin-top: 6px;">สร้างรายการอาหาร</a></li>
					<li class="menu-quick-easy_page active"><a href="<?php echo home_url(); ?>/all-recipes/">เมนูทั้งหมด</a></li>
					<!--<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/local-food/"><i class="icon5"> </i>อาหารรักประเทศไทย</a></li>-->
				</ul>
			</nav> 
                     
					<?php include_once('/../bg-time.php');?> 
					 
					 
        	</div><!-- End content-by-meal -->
			<div class="content-quick-easy">
				<div class="wr-quick-easy">
				<div class="content-box">
					<div class="box-left">
							<ul class="grid effect-3" id="grid">
							<?php   $the_query  = new WP_Query( array( 
																'post_type' => 'recipes', 
																'post_status' => 'publish', 
																'orderby' => 'date', 
																'order' => 'DESC',
																'posts_per_page' => -1, 
																) 
															);
									if ( $the_query ->have_posts() ) :
									$count = 1; 
										while ( $the_query ->have_posts() ) : $the_query ->the_post(); 	
								?>
									<?php   $boxColor = "#ed4036"; 
												if($count%8 == 1 | $count%8 == 4 | $count%8 == 0){
													$boxColor = "#ed4036";
												}else if($count%8 == 2 | $count%8 == 5 | $count%8 == 6){
													$boxColor = "#8ac53e";
												}else if($count%8 == 3 | $count%8 == 7){
													$boxColor = "#00aced";
												}
										?>
									<?php if($count%8 == 1){?>
                                    	<li style="width: 100%;">
                                    <?php }?>
									
										<a href="<?php the_permalink();?>">
											 <div class="box-quickeasy" style="border:2px solid <?php echo $boxColor;?>; <?php if($count%8 == 4){ echo 'width: 61.3%;';} else{ echo 'width: 30%;';}?>" >
												<div class="quickeasyDetail">
													<div class="quickeasyTitle"  style="background-color:<?php echo $boxColor;?>;" ><?php echo substr_utf8(get_the_title(),0,50);?></div>
													<?php $post_id = get_the_ID();?>
													<?php if (has_post_thumbnail( $post_id) ): ?>
													<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
													 <a href="<?php the_permalink();?>"><img src="<?php echo $image[0]; ?>"  height="130" class="quickeasy-img"/></a>
													<?php endif; ?>
													<div class="quickeasyExcerp" style="width: <?php if($count%8 == 4){ echo '460';} else{ echo '140';}?>px;">
														<a href="<?php the_permalink();?>"><?php if($count%8 == 4){ echo substr_utf8(get_the_excerpt(),0,280);} else{ echo substr_utf8(get_the_excerpt(),0,50);} ?></a>
														<a class="quickeasy-user" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID'));?>"><?php if($count%8 == 4){ echo substr_utf8(xprofile_get_field_data( 1, get_the_author_meta('ID')),0,100);} else{ echo substr_utf8(xprofile_get_field_data( 1, get_the_author_meta('ID')),0,14);}?></a>
														<label for="ingredient" class="quickeasy-ingredient">วัตถุดิบหลัก</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span>
													</div><!--End quickeasyExcerp-->													
												</div><!--End quickeasyDetail-->
												
												<div class="quickeasyReadmore">
													<a href="<?php the_permalink();?>">อ่านทั้งหมด </a>
													<div class="circular">
														<?php echo get_avatar(  get_the_author_meta('ID'),50); ?> 
													</div>
												</div>
											</div>
										</a>
										
									<?php if($count%8 == 0){?>
                                    	</li>
                                    <?php }?>
								<?php $count++; ?>
							<?php
									endwhile;
								else :
									echo wpautop( 'Sorry, no posts were found' );
								endif;
							?>   
							<?php wp_reset_query(); ?>	

						
							</ul>
						  </div><!--End box-left-->
						<div class="cleaner_h30"></div>
		
			 </div><!--End content-box-->    
          
						  
						  
						  
						  
						  
			</div><!--End wr-quick-easy-->	
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