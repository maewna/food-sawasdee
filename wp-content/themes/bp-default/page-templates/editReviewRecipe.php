<?php/* Template Name: edit review recipe page */?>
<?php get_header(); ?>


<?php 
if( get_post_type($_REQUEST['pid']) == 'review' ){ ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/editReview.css">
<?php
}else if( get_post_type($_REQUEST['pid']) == 'recipes' ){ ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/editRecipe.css">
<?php } ?>

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>
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
					<li class="menu-quick-easy_page active"><a href="<?php echo home_url(); ?>/create-recipe/"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: -30px;margin-top: 6px;">สร้างรายการอาหาร</a></li>
					<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/all-recipes/">เมนูทั้งหมด</a></li>
					<!--<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/local-food/"><i class="icon5"> </i>อาหารรักประเทศไทย</a></li>-->
				</ul>
			</nav>
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?>
					 
					 
        	</div><!-- End content-by-meal -->	
			
<?php 
if( get_post_type($_REQUEST['pid']) == 'review' ){ ?>
	
	<div class="content-create-bistro">
		<h2 class="title"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icons/iconAddReview.png" class="iconReview">แก้ไขรีวิว</h2>
		<div class="bistro-form">
			<section class="bistro-form-in"><?php echo do_shortcode('[wpuf_edit]');?></section>
		</div>
	</div>
<?php
}else if( get_post_type($_REQUEST['pid']) == 'recipes' ){ ?>
	
	<div class="content-create-recipe">
		<h2 class="title"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icons/iconAddRecipe.png" class="iconRecipe">แก้ไขสูตรอาหาร</h2>
		<div class="recipe-form">
			<section class="recipe-form-in"><?php echo do_shortcode('[wpuf_edit]');?><br class="clear"/></section>
		</div>
	</div>
<?php
}else if( get_post_type($_REQUEST['pid']) == 'bistro' ){ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/createReview.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/createBistro.css" />
	<script>
		$( document ).ready(function() {
			document.getElementById("wpuf-map-add-bistro_map").placeholder = "ระบุชื่อสถานที่ ถนน หรือพิกัดละติจูด ลองติจูด";
		});
	</script>
	
	<style>
	ul.wpuf-form .wpuf-submit input[type=submit] {
	  background-image: url('<?php echo get_template_directory_uri(); ?>/_inc/images/editBistro.png');
	}
	</style>
			<div class="content-create-bistro">
				<h2 class="title"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconAddBistro.png" class="iconReview"/>แก้ไขร้านอาหาร</h2>
				<div class="bistro-form">
					<section class="bistro-form-in">
						<?php echo do_shortcode('[wpuf_edit]');?>
						<div style="clear:both"></div>
					</section>
				</div><!--END bistro-form--><br class="clear"/>
			</div><!--END content-create-bistro-->
<?php }
else{
	echo do_shortcode('[wpuf_edit]');
}
?>
					
			
			
			
			
			
			
			
			
			
</main>
<?php get_footer(); ?>