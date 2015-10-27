<?php/* Template Name: Create restaurant page */?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/createReview.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/createBistro.css" />
<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
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
		
            <div class="content-by-meal" style="margin-bottom: 5px;">
          
        
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?>
      
        	</div><!-- End content-by-meal -->
			<script>
				$( document ).ready(function() {
				   document.getElementById("wpuf-map-add-bistro_map").placeholder = "ระบุชื่อสถานที่ ถนน หรือพิกัดละติจูด ลองติจูด";
				});

			</script>
			<div class="content-create-bistro">
				<h2 class="title"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconAddBistro.png" class="iconReview"/>สร้างร้านอาหาร</h2>
				<div class="bistro-form">
					<section class="bistro-form-in">
						<?php echo do_shortcode('[wpuf_form id="200"]');?>
						<div style="clear:both"></div>
					</section>
				</div><!--END bistro-form--><br class="clear"/>
			</div><!--END content-create-bistro-->
			
</main>
<?php get_footer(); ?>