<?php
session_start();
$_SESSION['pid']=$_REQUEST['pid'];
?>
<?php/* Template Name: Bistro Image Page*/?>
<?php get_header(); ?>
<?php $bistroName = get_the_title( $_REQUEST['pid'] );?>
<script>
$( document ).ready(function() {
	document.getElementById('Image_bistroid').value = <?php echo $_REQUEST['pid'];?>;
	document.getElementsByClassName('Image_bistroid')[0].style.display = "none";
	});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/bistroImage.css" />
<style>
	ul.wpuf-form li .wpuf-fields a.file-selector {
		width:165px;
	}
	ul.wpuf-form li .wpuf-fields ul.wpuf-attachment-list li {
		width:180px;
	}
	ul.wpuf-form li .wpuf-fields ul.wpuf-attachment-list li a.attachment-delete {
		margin-top: -190px;
		margin-left: 162px;
	}
	ul.wpuf-form li .wpuf-fields ul.wpuf-attachment-list li {
		width: 165px;
	}
</style>
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
			<div class="content-create-bistro">
			
				<h2 class="title"><i class="create-bistro-icon"></i>เพิ่มภาพ ร้าน<?php echo $bistroName; ?> </h2>
				<div class="bistro-form">
					<section class="bistro-form-in">
						<?php 
						echo do_shortcode('[wpuf_form id="702"]');
						?>
						<div style="clear:both"></div>
					</section>
				</div><!--END bistro-form--><br class="clear"/>
			</div><!--END content-create-bistro-->
			
</main>
<?php get_footer(); ?>