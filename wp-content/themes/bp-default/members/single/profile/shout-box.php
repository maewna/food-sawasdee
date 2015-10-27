<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

				
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/profile.css" />

<script> 
$(document).ready(function(){
  $("#btn-slide").click(function(event){
    event.preventDefault();
    $("#member-profile-box").slideToggle("slow");
  });
  $(".bubble-prof").css("z-index", "50");
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
					<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/profile/txt-update.png" width="240" height="46" class="text-shout-box"/>
					<!-- profile header -->
						<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>
					<!-- End profile header -->
				
				</div>
				
		<?php }else{?>
				<div class="head-padder"></div>		
	<?php }?>
			


<main class="wr-prof-cont">
    	
			
<section class="member-profile">
	<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>	
	<span id="btn-slide" style="float:right;">ข้อมูลเพิ่มเติม</span>
	<div id="member-profile-box">
	<?php 
		locate_template( array( 'members/single/profile/profile-loop.php' ), true );
	?>
	</div>
</section>
<div class="prof-left-2 align-left">
	<ul class="lst-sub-nav">
		<?php bp_get_options_nav(); ?>
		<br class="clear"/>
	</ul>	
</div>
<div class="prof-right-2 align-left">
        	
			<?php do_action( 'template_notices' ); ?>
        	<section>	
			<?php do_action( 'bp_before_member_settings_template' ); ?>

				<?php do_action( 'bp_before_member_body' ); ?>

				<?php do_action( 'bp_template_content' ); ?>
				
				
	<?php do_action( 'bp_before_directory_activity' ); ?>

			<?php if ( !is_user_logged_in() ) : ?>

				<h3><?php _e( 'Site Activity', 'buddypress' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'bp_before_directory_activity_content' ); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php locate_template( array( 'activity/post-form.php'), true ); ?>

			<?php endif; ?>

			<?php do_action( 'template_notices' ); ?>
			
			
			
			<?php do_action( 'bp_before_directory_activity_list' ); ?>

			<div class="activity" role="main" style="display:none;">

				<?php //locate_template( array( 'activity/activity-loop.php' ), true ); ?>

			</div><!-- .activity -->

			<?php do_action( 'bp_after_directory_activity_list' ); ?>
				
				<?php do_action( 'bp_after_member_body' ); ?>

			<?php do_action( 'bp_after_member_settings_template' ); ?>

</section>
</div><!-- End left -->















 <br class="clear"/>
   </main>
</div>
 <br class="clear"/>
<?php get_footer( 'buddypress' ); ?>