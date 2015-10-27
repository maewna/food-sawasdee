<?php /*Template Name: Tips Page */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/specialReview.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/cooking.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/celeb.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>
<style>
.grid li a, .grid li img {
   max-width: none!important; }
</style>
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
  </div>
  <!-- End content-by-meal -->
  
  <div class="content-celeb">
    <?php get_query_var('author_name'); $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));?>
    <?php if ( $curauth ) { ?>
    <h2 class="title"><i class="celeb-icon4"></i> <?php echo xprofile_get_field_data( 1, $curauth->id );?> </h2>
    <br class="clear"/>
    <div class="wr-celeb">
      <section class="latest-celebs">
      
      <div class="celeb-img">
          <h2><?php echo xprofile_get_field_data( 1, $curauth->id ); ?></h2>
          <?php global $wpdb;
				$results = $wpdb->get_results( 'SELECT * FROM wp_cimy_uef_data WHERE FIELD_ID = 1 AND USER_ID = '.$curauth->id, OBJECT );
				foreach($results as $result){ ?>
         			<?php echo imagesize($result->VALUE,333,500); ?>
          <?php } ?>
        </div>
		
        <?php $posts = new WP_Query( array( 'post_type' => 'celebcook', 'author_name' => $curauth->user_nicename, 'post_status' => 'publish',  'orderby' => 'post_date', 'order' => 'DESC','posts_per_page' => 4)); ?>
		
		
		<div class="top-quickeasy">
         <?php if ( $posts ->have_posts() ) : ?>
					<?php 
						$count = 0;
						while ( $posts ->have_posts() ) : $posts ->the_post(); 
						$count++;
						?>
						<?php	$ran = array("#ee4036","#8bc53f","#00adee");
											if($count %4==1){ $randomColor = $ran[0]; }
											else if($count%4==2){$randomColor = $ran[1];}
											else if($count%4==3){$randomColor = $ran[2];}
											else if($count%4==0){$randomColor = $ran[0];}
											
											//$randomColor = $ran[array_rand($ran, 1)]; 
							?>
                                    	<div class="box-t-celeb">
										<a href="<?php the_permalink();?>">
											 <div class="box-quickeasy" style="border:2px solid <?php echo $randomColor;?>;" >
												<div class="quickeasyDetail">
													<div class="quickeasyTitle"  style="background-color:<?php echo $randomColor;?>;" ><?php echo substr_utf8(get_the_title(),0,50);?></div>
													<?php $post_id = get_the_ID();?>
													<?php if (has_post_thumbnail( $post_id) ): ?>
													<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
													<figure class="quickeasy-img">
													 <a href="<?php the_permalink();?>"><?php echo imagesize($image[0],130,130); ?></a> 
													</figure>
													<?php endif; ?>
													<div class="quickeasyExcerp" style="width: 140px;">
														<a href="<?php the_permalink();?>"><?php echo substr_utf8(get_the_excerpt(),0,40); ?></a>
														<label for="ingredient" class="quickeasy-ingredient">วัตถุดิบหลัก</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span><br class="clear"/>
														<label for="type" class="quickeasy-type"></label><span><?php 
							$values = get_post_meta( get_the_ID(), 'recipe_type', true );
							$types = array('alacarte','snacks','noodle','vegetarian','dishes','seafood','dessert','babyfood','shabusuki','grillbarbecue','drinking');
							$typesTH = array('จานเดียว','อาหารว่าง','ประเภทเส้น','มังสวิรัติ/เจ','กับข้าว','ซีฟู้ด','ขนม/ของหวาน','สำหรับเด็ก','ชาบู/สุกี้','ปิ้งย่าง/บาร์บีคิว','เครื่องดื่ม');												
								if($values){
									$c = 0;
									foreach($types as $type){ 
										if (in_array($type, $values)) { echo $typesTH[$c].' ';}
										$c++;
									} 
								}
							?></span>
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
                              </div><!-- End box-t-celeb -->
							<?php
									endwhile; ?>
						    <?php else :
									echo wpautop( 'ยังไม่มีเนื้อหา' );
								endif;
							?>   
							<?php wp_reset_query(); ?>	
        </div>
        <!-- End column -->
        
		
		
		
		
		
		
		
	
		
		
		

		
		
		
        <br class="clear"/>
      </section>
      <section style="width: 1040px; margin: 20px auto;">
        <ul class="grid effect-3" id="grid">
          <?php	$the_query = new WP_Query( array( 'post_type' => 'celebcook', 'author_name' => $curauth->user_nicename, 'post_status' => 'publish', 'orderby' => 'post_date', 'order' => 'DESC', 'offset'=>4 ));
				if ( $the_query ->have_posts() ) :
					$count=0;
					while ( $the_query ->have_posts() ) : $the_query ->the_post(); 
						$count++;
					?>
						<?php	$ran = array("#ee4036","#8bc53f","#00adee");
								if($count %9==1){ $randomColor = $ran[0]; }
											else if($count%9==2){$randomColor = $ran[1];}
											else if($count%9==3){$randomColor = $ran[2];}
											else if($count%9==4){$randomColor = $ran[2];}
											else if($count%9==5){$randomColor = $ran[0];}
											else if($count%9==6){$randomColor = $ran[1];}
											else if($count%9==7){$randomColor = $ran[1];}
											else if($count%9==8){$randomColor = $ran[2];}
											else if($count%9==0){$randomColor = $ran[0];}
											
											//$randomColor = $ran[array_rand($ran, 1)]; 
						?>
                                    	<li>
										<a href="<?php the_permalink();?>">
											 <div class="box-quickeasy" style="border:2px solid <?php echo $randomColor;?>;" >
												<div class="quickeasyDetail">
													<div class="quickeasyTitle"  style="background-color:<?php echo $randomColor;?>;" ><?php echo substr_utf8(get_the_title(),0,50);?></div>
													<?php $post_id = get_the_ID();?>
													<?php if (has_post_thumbnail( $post_id) ): ?>
													<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
													<figure class="quickeasy-img">
													 <a href="<?php the_permalink();?>"><?php echo imagesize($image[0],130,130); ?></a> 
													</figure>
													<?php endif; ?>
													<div class="quickeasyExcerp" style="width: 140px;">
														<a href="<?php the_permalink();?>"><?php echo substr_utf8(get_the_excerpt(),0,40); ?></a>
														<label for="ingredient" class="quickeasy-ingredient">วัตถุดิบหลัก</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span><br class="clear"/>
														<label for="type" class="quickeasy-type"></label><span><?php 
							$values = get_post_meta( get_the_ID(), 'recipe_type', true );
							$types = array('alacarte','snacks','noodle','vegetarian','dishes','seafood','dessert','babyfood','shabu/suki','grill/barbecue','drinking');
							$typesTH = array('จานเดียว','อาหารว่าง','ประเภทเส้น','มังสวิรัติ/เจ','กับข้าว','ซีฟู้ด','ขนม/ของหวาน','สำหรับเด็ก','ชาบู/สุกี้','ปิ้งย่าง/บาร์บีคิว','เครื่องดื่ม');												
								if($values){
									$c = 0;
									foreach($types as $type){ 
										if (in_array($type, $values)) { echo $typesTH[$c].' ';}
										$c++;
									} 
								}
							?></span>
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
										
									
                                    	</li>
                                  
								
							<?php
									endwhile;
								else :
									echo wpautop( 'ยังไม่มีเนื้อหา' );
								endif;
							?>   
							<?php wp_reset_query(); ?>	
        </ul>
        <br class="clear"/>
      </section>
      <br class="clear"/>
    </div>
    <!--End wr-celeb-->
    <?php }//End if ?>
  </div>
  <!--End content-celeb-->
  
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
