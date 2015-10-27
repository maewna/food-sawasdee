<?php

/**
 * BuddyPress - Follow
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<div class="backdrop"></div>
<section style="margin-bottom: 20px;">
  <div class="icon-box">
    <?php global $current_user;
		get_currentuserinfo();
		list($rank,$rankImg) = lvMember(bp_displayed_user_id()); ?>
    <img src="<?php echo $rankImg;?>" /> </div>
  <div class="button-box">
    <?php do_action( 'bp_member_header_actions' ); ?>
  </div>
  <br class="clear"/>
</section>

<section class="follow-box" id="refollow">
<script type="text/javascript">
 
			$(document).ready(function(){
				
				$('#follower, #following').click(function(){
					$('#lbcontent').html('<iframe src="<?php echo get_template_directory_uri(); ?>/formFollow.php?u=<?php echo bp_displayed_user_id()?>&t='+$(this).attr('id')+'&s=d" style="width: 635px; height: 545px;"> </iframe>');
					
					$('.backdrop, .followbox').animate({'opacity':'.50'}, 300, 'linear');
					$('.followbox').animate({'opacity':'1.00'}, 300, 'linear');
					$('.backdrop, .followbox').css('display', 'block');
				});
 
				$('.close').click(function(){
					refreshFollow(<?php echo bp_displayed_user_id()?>);
					close_box();
				});
 
				$('.backdrop').click(function(){
					refreshFollow(<?php echo bp_displayed_user_id()?>);
					close_box();
				});
 
			});
 
			function close_box()
			{
				$('.backdrop, .followbox').animate({'opacity':'0'}, 300, 'linear', function(){
					$('.backdrop, .followbox').css('display', 'none');
				});
			}
			
			function refreshFollow( u ) {
				$.ajax({
					url: "<?php echo get_template_directory_uri(); ?>/refreshFollow.php",
					type: "GET",
					data: "u=" + u ,
					success: function(data){
						document.getElementById('refollow').innerHTML = data;
				
					},
					
				});
				
			}
		</script>
  <div class="h-tab">
    <?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
							$count = bp_follow_total_follow_counts( array(
								'user_id' => bp_displayed_user_id()
							) );
						echo '<h2 class="icon-following">Following ('.$count['following'].')</h2>';
						if( $count > 0 ){ ?>
                        <a href="#" id="following">ดูทั้งหมด</a>
                        <div class="followbox">
                          <div class="close">ปิดหน้านี้ x</div>
                          <div id="lbcontent"></div>
                        </div>
                        <?php } ?>
                        <?php endif;?>
                      </div>
                      <!-- End h-tab-->
                      <?php $followings = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE follower_id=' . bp_displayed_user_id() . ' ORDER BY id DESC LIMIT 20');
								if( $followings ){  
									foreach ($followings as $following) { ?>
										<figure> 
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $following->leader_id ); ?>" title="<?php echo xprofile_get_field_data( 1, $following->leader_id);?>"><?php echo get_avatar( $following->leader_id, 40 ); ?></a>
										</figure>
									<?php } 
								}//End if followings ?>
                      
                      
                     
                      <br class="clear"/>
                      <div class="h-tab clear">
                        <?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
                                     $count = bp_follow_total_follow_counts( array(
                                     'user_id' => bp_displayed_user_id()
                                 ) );
                                echo '<h2 class="icon-follower">Followers ('.$count['followers'].')</h2>';
                             if( $count > 0 ){ ?>
                        <a href="#" id="follower">ดูทั้งหมด</a>
                        <?php } ?>
                        <?php endif;?>
                      </div>
                      <!-- End h-tab-->
                      
                      
                       <?php $followers = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE leader_id=' . bp_displayed_user_id() . ' ORDER BY id DESC LIMIT 20');
								if( $followers ){  
									foreach ($followers as $follower) { ?>
										<figure> 
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $follower->follower_id ); ?>" title="<?php echo xprofile_get_field_data( 1, $follower->follower_id);?>"><?php echo get_avatar( $follower->follower_id, 40 ); ?></a>
										</figure>
									<?php } 
								}//End if followers ?>
                      
                      <br class="clear"/>
                      <a href="#" class="more-friends">มาค้นหาเพื่อนเพิ่มกัน</a> 
                      
                      </section>
                    <!-- End follow-box --> 
                    
