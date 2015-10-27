<?php include_once("../../../wp-config.php"); ?>
<?php $type = $_REQUEST['t']; ?>
<?php $uid = $_REQUEST['u']; ?>
<?php $sort = $_REQUEST['s'];?>

<div class="h-follow">
  <?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
							$count = bp_follow_total_follow_counts( array(
								'user_id' => $uid
							) );
						if( $type == 'following' ){
							$followings = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE follower_id='.$uid.' ORDER BY id DESC');
							echo '<h2 class="icon-following">Following ('.$wpdb->num_rows.')</h2>';
							
							$mArray = array();
								foreach ($followings as $following) {
									array_push($mArray, $following->leader_id );
								}
						}else if( $type == 'follower' ){
							$followers = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE leader_id='.$uid.' ORDER BY id DESC');
							
							echo '<h2 class="icon-following">Followers ('.$wpdb->num_rows.')</h2>';
							
							$followings = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE follower_id='.$uid.' ORDER BY id DESC');
							
							$mArray = array();
								foreach ($followers as $follower) {
									array_push($mArray, $follower->follower_id );
								}
							$nArray = array();
								foreach ($followings as $following) {
									array_push($nArray, $following->leader_id );
								}	
						} ?>
  <?php endif;?>
  <div class="h-right">เรียงลำดับ
    <select name="users" id="sortby" onchange="showUser('<?php echo $type;?>','<?php echo $uid;?>')">
      <option value="d">จากล่าสุด</option>
      <option value="a">ตามตัวอักษร</option>
    </select>
  </div>
  <br class="clear"/>
</div>
<!-- End h-tab-->
<?php  if( $sort == 'a' ) {
								if( $type == 'following'){
									$users = $wpdb->get_results('
									SELECT * FROM ( SELECT * FROM ( SELECT wp_bp_follow.id as followid, wp_bp_follow.leader_id FROM wp_bp_follow WHERE follower_id='.$uid.') a INNER JOIN ( SELECT wp_bp_xprofile_data.id as xprofileid,wp_bp_xprofile_data.user_id,wp_bp_xprofile_data.value FROM wp_bp_xprofile_data WHERE field_id=1 ) b ON a.leader_id = b.user_id ORDER BY b.value ASC ) c INNER JOIN ( SELECT wp_users.id as ID FROM wp_users ) d ON c.leader_id = d.ID ORDER BY c.value ASC'); 
								}else if( $type == 'follower' ){
									$users = $wpdb->get_results('SELECT * FROM ( SELECT * FROM ( SELECT wp_bp_follow.id as followid, wp_bp_follow.follower_id FROM wp_bp_follow WHERE leader_id='.$uid.') a INNER JOIN ( SELECT wp_bp_xprofile_data.id as xprofileid,wp_bp_xprofile_data.user_id,wp_bp_xprofile_data.value FROM wp_bp_xprofile_data WHERE field_id=1 ) b ON a.follower_id = b.user_id ORDER BY b.value ASC ) c INNER JOIN ( SELECT wp_users.id as ID FROM wp_users ) d ON c.follower_id = d.ID ORDER BY c.value ASC'); 
									}
		} else{
				$user_query = new WP_User_Query( array( 'include' => $mArray ) );
				$users = (array) $user_query->results;
					usort( $users, function( $a, $b ) use( $mArray ) {
						return array_search( $a->ID, $mArray) < array_search( $b->ID, $mArray ) ? -1 : 1;
					} );
					
				
					
					
		}
									
									
if ( count($users) > 0 ) { ?>
<section class="slider" style="width: 534px; margin: 0 auto; padding: 0 50px;">
  <div class="flexslider">
    <ul class="slides">
      <?php $c = 0; 
	  $total_users = count( $users );
			foreach ( $users as $username ) { ?>
      			<?php 
			if( $c % 4 == 0 ) { ?>
      	<li>
        	<?php } ?>
        	<div class="wruser borderuser">
          <img class="loading-image" id="loading-image-<?php echo $username->ID?>" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/loading-1.gif" style="display:none;" /> 
            <div class="show-user" id="show-user-<?php echo $username->ID?>">
          	<figure>
				<?php $user_info = get_userdata($username->ID); ?>
                <a target="_parent" href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 40 ); ?></a> 
            </figure>
          	<h2><?php $disname = xprofile_get_field_data( 1, $username->ID); echo substr_utf8($disname,0,15); ?></h2>
            
            
            	<?php if( bp_loggedin_user_id() == $uid ){ ?>
					<?php if($type == 'follower'){ ?>
                        
                        <?php if ( in_array( $username->ID , $nArray ) ) { ?>
                                    <a href="#" class="following-btn" onclick="unfollowUser('<?php echo $username->ID?>','<?php echo $uid?>','follower')">Following</a>
                        <?php } else {  ?>
                                    <a href="#" class="follower-btn" onclick="refollowUser('<?php echo $username->ID?>','<?php echo $uid?>','follower')">+ Follow</a>
                        <?php } ?>
                        
                    <?php }else if($type == 'following'){ ?>
                        <a href="#" class="following-btn" onclick="unfollowUser('<?php echo $username->ID?>','<?php echo $uid?>','following')">Following</a>
                    <?php } ?>
        		<?php }//End check bp_is_my_profile ?>
        </div><!-- END show-user -->  
        </div>
        <!-- END wruser -->
        <?php if( $c % 4 == 3 || ( $c == $total_users )) { ?>
      </li>
      <?php }?>
      <?php $c++; }//end foreach ?>
      <br class="clear"/>
    </ul>
  </div>
  <!--END flexslider--> 
</section>
<?php } else {
	  echo '<div class="notext">ยังไม่มีข้อมูล</div>';
	  }//end if count($users) > 0 ?>
