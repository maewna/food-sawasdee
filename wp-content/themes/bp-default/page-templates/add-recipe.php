<?php/* Template Name: Add recipe */?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/create-form.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/editRecipe.css">
<style>
.wpuf-submit input[type=submit] {
    background-image: url('<?php bloginfo('stylesheet_directory'); ?>/_inc/images/AddButton.png') !important;
}
#wpuf-sponsor-img-pickfiles{
	width:120px;
}
</style>
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
		
		
            <div class="content-by-meal-page" style="height: 195px;">
			
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?>
					 
					 
        	</div><!-- End content-by-meal -->	
            
			
			<div class="content-create-recipe">
				<h2 class="title"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icons/iconAddRecipe.png" class="iconRecipe">สร้างสูตรอาหาร</h2>
				<div class="recipe-form">
					<section class="recipe-form-in"><?php 
							$page_id = 268; 
							$page_data = get_page( $page_id ); 
							echo apply_filters('the_content', $page_data->post_content); 
						?><br class="clear"/></section>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			
</main>
<?php get_footer(); ?>