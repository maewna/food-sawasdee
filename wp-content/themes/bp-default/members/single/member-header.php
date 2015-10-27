<?php

/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<header class="h-profile">

	<?php do_action( 'bp_before_member_header' ); ?>
	<div id="item-header" role="complementary">

		<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_avatar( 'type=full' ); ?></a>
		<div class="bubble-prof">
		

		<?php if ( bp_is_active( 'activity' ) ) : ?>

			<div id="latest-update">

				<?php bp_activity_latest_update( bp_displayed_user_id() ); ?>

			</div>

		<?php endif; ?>	
		

		</div><!--end bubble-prof-->
	
	</div><!-- #item-header -->
	<?php 
			$num_recipe = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author='".bp_displayed_user_id()."' AND (post_type='recipes' OR post_type='celebcook') AND post_status='publish'");
			$num_video = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts as t1 INNER JOIN $wpdb->postmeta as t2 ON t1.ID = t2.post_id WHERE t1.post_author = '".bp_displayed_user_id()."' AND t1.post_type = 'recipes' AND t1.post_status = 'publish' AND t2.meta_key = 'choose-clip' AND (t2.meta_value = 'url' OR t2.meta_value = 'upload') ORDER BY t1.post_date DESC");
			//$num_img = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author='".bp_displayed_user_id()."' AND post_type='attachment' AND post_mime_type LIKE 'image%' AND post_status='inherit'");
			$num_img = $wpdb->get_var("SELECT COUNT(*) FROM wp_posts
						INNER JOIN wp_postmeta ON 
						post_id=post_parent
						WHERE meta_key='Image_bistroId'
						AND post_status !='trash'
						AND post_author='".bp_displayed_user_id()."'");
			$num_review = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author='".bp_displayed_user_id()."' AND post_type='review' AND post_status='publish'");
			$num_bookmark = $wpdb->get_var("SELECT COUNT(*) FROM wp_favourite WHERE fav_by='".bp_displayed_user_id()."'");
			$num_all = $num_recipe + $num_video + $num_img + $num_review;
			
	?>

	<?php 	$nav_link1 = bp_displayed_user_domain() . 'activity/review/';
			$nav_link2 = bp_displayed_user_domain() . 'activity/picture/';
			$nav_link3 = bp_displayed_user_domain() . 'activity/clip/';
			$nav_link4 = bp_displayed_user_domain() . 'activity/recipe/';	
			$nav_link5 = bp_displayed_user_domain() . 'activity/bookmark/';	
			$nav_link6 = bp_displayed_user_domain() . 'notifications/';	
		 ?>
	<nav class="profile-menu">
				<ul>
					<li class="menu-1"><a href="<?php bp_displayed_user_link(); ?>">หน้าแรก<span><?php echo nice_number($num_all);?></span></a></li>
					<li class="menu-2"><a href="<?php echo $nav_link1;?>">รีวิว<span><?php echo nice_number($num_review);?></span></a></li>
					<li class="menu-3"><a href="<?php echo $nav_link2;?>">รูปภาพ<span><?php echo nice_number($num_img);?></span></a></li>
					<li class="menu-4"><a href="<?php echo $nav_link3;?>">วิดีโอ<span><?php echo nice_number($num_video);?></span></a></li>
					<li class="menu-5"><a href="<?php echo $nav_link4;?>">สูตรอาหาร<span><?php echo nice_number($num_recipe);?></span></a></li>
					<li class="menu-6"><a href="<?php echo $nav_link5;?>">ร้านโปรด<span><?php echo nice_number($num_bookmark);?></span></a></li>
					
                    <?php if( bp_is_my_profile() ){ ?>
                    <li class="menu-7"><a href="<?php echo $nav_link6;?>">Notification<span><?php echo nice_number(cg_current_user_notification_count());?></span></a></li>
                    <?php } ?>
				</ul>
	</nav>
<br class="clear"/>
</header>	

<?php do_action( 'bp_after_member_header' ); ?>





