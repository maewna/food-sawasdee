<?php include_once("../../../wp-config.php"); ?>
<?php $uid = $_REQUEST['u']; ?>
<div class="backdrop"></div>
 <div class="followbox">
     <div class="close"></div>
     <div id="lbcontent"></div>
 </div>
<script type="text/javascript">
			$(document).ready(function(){
				$('#more-friends').click(function(){
					$('#lbcontent').html('<iframe src="<?php echo get_template_directory_uri(); ?>/formSearchUser.php?u=<?php echo $uid?>" style="width: 635px; height: 545px;"> </iframe>');
					
					$('.backdrop, .followbox').animate({'opacity':'.50'}, 300, 'linear');
					$('.followbox').animate({'opacity':'1.00'}, 300, 'linear');
					$('.backdrop, .followbox').css('display', 'block');
				});
				
				$('#follower, #following').click(function(){
					$('#lbcontent').html('<iframe src="<?php echo get_template_directory_uri(); ?>/formFollow.php?u=<?php echo $uid?>&t='+$(this).attr('id')+'&s=d" style="width: 635px; height: 545px;"> </iframe>');
					
					$('.backdrop, .followbox').animate({'opacity':'.50'}, 300, 'linear');
					$('.followbox').animate({'opacity':'1.00'}, 300, 'linear');
					$('.backdrop, .followbox').css('display', 'block');
				});
 
				$('.close').click(function(){
					refreshFollow(<?php echo $uid?>);
					close_box();
				});
 
				$('.backdrop').click(function(){
					refreshFollow(<?php echo $uid?>);
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
						$('#refollow').html(data);
					}
				});
				
			}
		</script>

  <div class="h-tab">
    <?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
							$count = bp_follow_total_follow_counts( array(
								'user_id' => $uid
							) );
						echo '<h2 class="icon-following">Following ('.$count['following'].')</h2>';
						if( $count > 0 ){ ?>
                        <a href="#" id="following">ดูทั้งหมด</a>
                        <?php } ?>
                        <?php endif;?>
                      </div>
                      <!-- End h-tab-->
                      <?php $followings = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE follower_id=' . $uid . ' ORDER BY id DESC LIMIT 20');
								if( $followings ){  
									foreach ($followings as $following) { ?>
										<figure> 
											<a class="f-link" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $following->leader_id ); ?>" title="<?php echo xprofile_get_field_data( 1, $following->leader_id);?>"><?php echo get_avatar( $following->leader_id, 40 ); ?></a>
										</figure>
									<?php } 
								}//End if followings ?>
                     
                      <br class="clear"/>
                      <div class="h-tab clear">
                        <?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
                                     $count = bp_follow_total_follow_counts( array(
                                     'user_id' => $uid
                                 ) );
                                echo '<h2 class="icon-follower">Followers ('.$count['followers'].')</h2>';
                             if( $count > 0 ){ ?>
                        <a href="#" id="follower">ดูทั้งหมด</a>
                        <?php } ?>
                        <?php endif;?>
                      </div>
                      <!-- End h-tab-->
                      
                       <?php $followers = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE leader_id=' . $uid . ' ORDER BY id DESC LIMIT 20');
								if( $followers ){  
									foreach ($followers as $follower) { ?>
										<figure> 
											<a class="f-link" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $follower->follower_id ); ?>" title="<?php echo xprofile_get_field_data( 1, $follower->follower_id);?>"><?php echo get_avatar( $follower->follower_id, 40 ); ?></a>
										</figure>
									<?php } 
								}//End if followers ?>
                                
                      <br class="clear"/>
                     <?php if( bp_loggedin_user_id() == $uid ){ ?>
                      	<a href="#" id="more-friends">ค้นหาเพื่อน</a> 
                      <?php  } ?>
                    <!-- End follow-box -->