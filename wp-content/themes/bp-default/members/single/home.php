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
  $("#btn-slide").click(function(){
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

<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li><a href="<?php echo home_url(); ?>/recipes/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li><a href="<?php echo home_url(); ?>/hilight-trend-likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li><a href="<?php echo home_url(); ?>/shop/"><i class="icon6"> </i>ช้อปเลย</a>
					 <!--<ul>
						<li><a href="#" class="documents">Documents</a></li>
						<li><a href="#" class="messages">Messages</a></li>
						<li><a href="#" class="signout">Sign Out</a></li>
					</ul>-->
			
			</li>
        </ul>
    </nav>	
<div class="social" style="margin-right: 44px;">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
 <div class="content-by-meal" style="height: 195px;">
          
					<?php include_once('wp-content/themes/bp-default/members/bg-time_noti.php');?> 
                   
      
        	</div><!-- End content-by-meal -->	
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
