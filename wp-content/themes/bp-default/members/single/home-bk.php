<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

<br/>
------------------------------------------------------------------<br/>
		<?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
			$count = bp_follow_total_follow_counts();
			echo '<div style="line-height: 20px;">Following ('.$count['following'].')</div>';
		endif;?>	

		<?php if ( bp_has_members( 'include=' . bp_get_following_ids( ) ) ) : ?>         
										<?php while ( bp_members() ) : bp_the_member(); ?>                      
											<figure>
												<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=68&height=68') ?></a>
											</figure>
										<?php endwhile; ?>
		<?php endif; ?>
<br class="clear"/>
------------------------------------------------------------------
<br class="clear"/>
		<?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
			$count = bp_follow_total_follow_counts();
			 echo '<div style="line-height: 20px;">Followers ('.$count['followers'].')</div>';
		endif;?>

		<?php if ( bp_has_members( 'include=' . bp_get_follower_ids( ) ) ) : ?>         
										<?php while ( bp_members() ) : bp_the_member(); ?>                      
											<figure>
												<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=68&height=68') ?></a>
											</figure>
										<?php endwhile; ?>
		<?php endif; ?>
<br class="clear"/>

<div style="line-height: 20px;">ABOUT ME</div>
<br class="clear"/>

<div style="line-height: 20px;">
		<?php if ( bp_has_profile() ) : ?>
		  <?php while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
		 
		 
		 
		 
			------------------------------------------------------------------
			<br class="clear"/>
			<div style="line-height: 20px;">BLOG</div>
			
			<?php echo "<div style='line-height: 20px;'>username = ".bp_displayed_user_id()."</div>";?>
			<?php echo '<div style="line-height: 20px;">My Blogs ('.get_usernumposts( bp_displayed_user_id()).')</div>';?>
					<?php $blog = new WP_Query( array('author' => bp_displayed_user_id(), 'post_type' => 'post', 'showposts' => '5', 'post_status' => 'publish') );
							if ( $blog->have_posts() ) :
								while ( $blog->have_posts() ) : $blog->the_post(); ?>
											<div style="line-height: 20px;">
											<figure>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('recipe'); ?> </a>
											</figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
												<?php the_time(); ?>
											</div>			
								<?php endwhile; ?>
							<?php endif; ?>
								
			<br class="clear"/>
			------------------------------------------------------------------
			<br class="clear"/>
			<br class="clear"/>
			------------------------------------------------------------------
			<br class="clear"/>
		 
		 
		 
		 
			<ul id="profile-groups">
			<?php if ( bp_profile_group_has_fields() ) : ?>
		 
			  <li>
				<?php bp_the_profile_group_name() ?>
		 
				<ul id="profile-group-fields">
				<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
		 
				  <?php if ( bp_field_has_data() ) : ?>
				  <li>
					<?php bp_the_profile_field_name() ?>
					<?php bp_the_profile_field_value() ?>
				  </li>
				  <?php endif; ?>
		 
				<?php endwhile; ?>
				</ul>
			  <li>
		 
			<?php endif; ?>
			</ul>
		 
		  <?php endwhile; ?>
		 
		<?php else: ?>
		 
		  <div id="message" class="info">
			<p>This user does not have a profile.</p>
		  </div>
		 
		<?php endif;?>
</div>
					
<br class="clear"/>
------------------------------------------------------------------
<br class="clear"/>
<div style="line-height: 20px;">MY PICTURES</div>
<br class="clear"/>

<div style="line-height: 20px;">

<?php 

global $wpdb;
		$post_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts where post_author='".bp_displayed_user_id()."' and post_type='attachment' and post_mime_type='image/jpeg'" );
		echo "<p><a href='http://foodsawasdee.cpf.co.th/my-pictures/?uid=".bp_displayed_user_id()."' target=''>Pictures (".$post_count.")</a></p>"; 
?>
</div>
					
<br class="clear"/>
------------------------------------------------------------------

<br class="clear"/>
	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_member_home_content' ); ?>

			<div id="item-header" role="complementary">

				<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>

			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>

						<?php bp_get_displayed_user_nav(); ?>

						<?php do_action( 'bp_member_options_nav' ); ?>

					</ul>
				</div>
			</div><!-- #item-nav -->

			<div id="item-body">

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

			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

<?php get_sidebar( 'buddypress' ); ?>
<?php get_footer( 'buddypress' ); ?>
