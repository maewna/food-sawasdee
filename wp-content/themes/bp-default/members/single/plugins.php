<?php

/**
 * BuddyPress - Users Plugins
 *
 * This is a fallback file that external plugins can use if the template they
 * need is not installed in the current theme. Use the actions in this template
 * to output everything your plugin needs.
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php get_header( 'buddypress' ); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/profile.css" />
	
<script> 
$(document).ready(function(){
  $("#btn-slide").click(function(event){
    event.preventDefault();
    $("#member-profile-box").slideToggle("slow");
  });
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#bg-img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#bprpgbp_upload").change(function(){
        readURL(this);
    });
});
</script>

<div class="customs-bg cover-head">
<div id="bg-img"></div>
	<?php do_action( 'bp_before_member_home_content' ); ?>
 	<?php 
			global $bp; 
			$setting_link = $bp->loggedin_user->domain . 'profile/edit/';
			$cus_hd_link = $bp->loggedin_user->domain . 'profile/change-hd/';
	if ( is_user_logged_in() && bp_is_my_profile() ){?>
				<div class="tab-head">
					<div class="line-tab-head"></div><!--End line-tab-->
					<div id="opacity-black-head"></div><!--End line-tab-->
					<a href="<?php echo $setting_link?>" class="profile-setting-link">ตั้งค่า</a>
					<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/profile/txt-cover1.png" width="194" height="23" class="text-cover1"/>
					<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/profile/txt-cover2.png" width="192" height="23" class="text-cover2"/>
					<!-- profile header -->
						<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>
					<!-- End profile header -->
				
				</div>
				
		<?php }else{?>
				<div class="tab-head">
					<!-- profile header -->
						<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>
					<!-- End profile header -->
				
				</div>	
	<?php }?>
			


<main class="wr-prof-cont">
    	

				<?php do_action( 'bp_before_member_body' ); ?>
	
				<?php do_action( 'bp_template_content' ); ?>

				<?php do_action( 'bp_after_member_body' ); ?>
			
				<?php do_action( 'bp_after_member_plugin_template' ); ?>	

		 <br class="clear"/>
</main>


</div>
<br class="clear"/>
<?php get_footer( 'buddypress' ); ?>
