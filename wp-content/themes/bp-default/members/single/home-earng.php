<?php

/**
 * BuddyPress - Users Home
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

get_header( 'buddypress' ); ?>

				
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/profile.css" />



<div class="customs-bg cover-head"">
 	
	<!-- profile header -->
		<?php do_action( 'bp_before_member_home_content' ); ?>
		<?php locate_template( array( 'members/single/member-header.php' ), true ); ?>
	<!-- End profile header -->	
			
	
	
    
        	<section style="line-height: 20px;">
				<br/>
				
				<?php 
					global $wpdb;
					$posts = $wpdb->get_results("SELECT * FROM $wpdb->posts where post_author='".bp_displayed_user_id()."' AND ( post_type='recipes' OR post_type='bistro' )");
					foreach($posts as $post) { 
						if( get_post_type( $post ) == 'recipes' ){
							echo "recipes<br/>";
						}
						if( get_post_type( $post ) == 'bistro' ){
							echo "bistro<br/>";
						}
					?>
					
							
							
							
								<div style="line-height: 20px;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>	
					<?php } ?>		
				<?php wp_reset_query(); ?>		
	
				
				
				
				
				<br/>
			</section>
        </div><!-- End left -->
        <div class="prof-right align-right">
        	<section style="margin-bottom: 20px;">
			
				<div class="icon-box">
					<img src="<?php echo get_template_directory_uri(); ?>/_inc/images/profile/level-icon-1.png" />
				</div>
				<div class="button-box">
					<?php do_action( 'bp_member_header_actions' ); ?>
					<a href="#" class="e-book-button">E-BOOK</a>
				</div>
				<br class="clear"/>
			
			</section>
			
			<section class="follow-box">
				<h2>Following</h2>
				
				
				
				<?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
					$count = bp_follow_total_follow_counts();
					echo '<div style="line-height: 20px;">Following ('.$count['following'].')</div>';
				endif;?>	

				<?php if ( bp_has_members( 'include=' . bp_get_following_ids( ) ) ) : ?>         
												<?php while ( bp_members() ) : bp_the_member(); ?>                      
													<figure>
														<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=40&height=40') ?></a>
													</figure>
												<?php endwhile; ?>
				<?php endif; ?>
				
				
				
				
				
				
				<h2>Follower</h2>
				
				
				
				
				<?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
					$count = bp_follow_total_follow_counts();
					 echo '<div style="line-height: 20px;">Followers ('.$count['followers'].')</div>';
				endif;?>

				<?php if ( bp_has_members( 'include=' . bp_get_follower_ids( ) ) ) : ?>         
												<?php while ( bp_members() ) : bp_the_member(); ?>                      
													<figure>
														<a href="<?php bp_member_permalink()?>" title="<?php bp_member_name() ?>"><?php bp_member_avatar('type=full&width=40&height=40') ?></a>
													</figure>
												<?php endwhile; ?>
				<?php endif; ?>
		
		
		
			</section><!-- End follow-box -->
        </div><!-- End right -->
   </main>
</div>
 <br class="clear"/>
<?php get_footer( 'buddypress' ); ?>
