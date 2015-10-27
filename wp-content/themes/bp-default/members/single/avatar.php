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
  $(".avatar").css("z-index", "50");
  
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#avatar-img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#file").change(function(){
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
					<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/profile/txt-avatar.png" width="306" height="55" class="text-avatar"/>
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
    	
			
			

				<?php do_action( 'bp_before_member_body' );

				if ( bp_is_user_activity() || !bp_current_component() ) :
					locate_template( array( 'members/single/activity.php'  ), true );

				 elseif ( bp_is_user_blogs() ) :
					locate_template( array( 'members/single/blogs.php'     ), true );

				elseif ( bp_is_user_friends() ) :
					locate_template( array( 'members/single/friends.php'   ), true );

				elseif ( bp_is_user_groups() ) :
					locate_template( array( 'members/single/groups.php'    ), true );

				elseif ( bp_is_user_messages() ) :
					locate_template( array( 'members/single/messages.php'  ), true );

				elseif ( bp_is_user_profile() ) :                                                                                                                                                                                           
					locate_template( array( 'members/single/profile.php'   ), true );

				elseif ( bp_is_user_forums() ) :
					locate_template( array( 'members/single/forums.php'    ), true );

				elseif ( bp_is_user_settings() ) :
					locate_template( array( 'members/single/settings.php'  ), true );

				elseif ( bp_is_user_notifications() ) :
					locate_template( array( 'members/single/notifications.php' ), true );
	
				// If nothing sticks, load a generic template
				else :
					locate_template( array( 'members/single/plugins.php'   ), true );

				endif;

				do_action( 'bp_after_member_body' ); ?>

			

			<?php do_action( 'bp_after_member_home_content' ); ?>
		 <br class="clear"/>
   </main>
</div>
 <br class="clear"/>
<?php get_footer( 'buddypress' ); ?>
