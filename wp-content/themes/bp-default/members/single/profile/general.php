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
					<div id="opacity-head"></div><!--End line-tab-->
					<a href="<?php echo $setting_link?>" class="profile-setting-link">ตั้งค่า</a>
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

				<form action="<?php echo bp_displayed_user_domain() . 'profile/general'; ?>" method="post" class="account-form" id="settings-form">

					<?php if ( !is_super_admin() ) : ?>
						<div class="editfield">
						<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'buddypress' ); ?></label>
						<div class="wr-input">
							<input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small" /> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'buddypress' ); ?>"><?php _e( 'Lost your password?', 'buddypress' ); ?></a>
						</div>
                        <br class="clear"/>
						</div>
					<?php endif; ?>
						<div class="editfield">
							<label for="email"><?php _e( 'Account Email', 'buddypress' ); ?></label>
							<div class="wr-input">
								<input type="text" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input" disabled />
                                <input type="hidden" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input"/>
							</div>
							<br class="clear"/>
						</div>
						<div class="editfield">
							<label for="pass1"><?php _e( 'Change Password <span>(leave blank for no change)</span>', 'buddypress' ); ?></label>
							<div class="wr-input">
								<input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small" /> 
							</div>
							<div class="wr-visibility"><?php _e( '*New Password', 'buddypress' ); ?></div>
							<div class="wr-input">	
								<input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small" /> 
							</div>
							<div class="wr-visibility"><?php _e( '*Repeat New Password', 'buddypress' ); ?></div>
							<br class="clear"/>
						</div>
					<?php do_action( 'bp_core_general_settings_before_submit' ); ?>
						<div class="submit">
							<input type="submit" name="submit" value="<?php esc_attr_e( 'บันทึกการเปลี่ยนแปลง', 'buddypress' ); ?>" id="submit" class="auto" />
						</div>
					<?php do_action( 'bp_core_general_settings_after_submit' ); ?>

					<?php wp_nonce_field( 'bp_settings_general' ); ?>

				</form>
				<?php do_action( 'bp_after_member_body' ); ?>

			

			<?php do_action( 'bp_after_member_settings_template' ); ?>

</section>
</div><!-- End left -->















 <br class="clear"/>
   </main>
</div>
 <br class="clear"/>
<?php get_footer( 'buddypress' ); ?>