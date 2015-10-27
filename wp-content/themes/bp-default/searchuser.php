<?php include_once("../../../wp-config.php"); ?>
<?php
	$term = strip_tags(substr( $_POST['searchit'],0, 100 ));
	$term = mysql_escape_string( $term ); // Attack Prevention
	if ( $term == "" ) {
		echo '<div class="search-result">';
		echo "Enter Something to search";
		echo '</div>';
	} else {
		$query = mysql_query( " SELECT * FROM wp_bp_xprofile_data WHERE field_id = '1' AND value like '{$term}%' " );
		$string = '';
		
			if ( mysql_num_rows( $query ) ) { ?>
  <section class="slider" style="width: 534px; margin: 0 auto; padding: 0 50px;">
    <div class="flexslider2">
                <ul class="slides">
                  <?php  $uid = $_POST['u'];
				  			$followers = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE leader_id='.$uid.' ORDER BY id DESC');
							$followings = $wpdb->get_results('SELECT * FROM wp_bp_follow WHERE follower_id='.$uid.' ORDER BY id DESC');
							
							$mArray = array();
								foreach ( $followers as $follower ) {
									array_push( $mArray, $follower->follower_id );
								}	
						    $nArray = array();
								foreach ( $followings as $following ) {
									array_push( $nArray, $following->leader_id );
								}	?>	
			 <?php 	$c = 0; 
					$total_users = mysql_num_rows( $query ); ?>				
			<?php while( $row = mysql_fetch_assoc( $query ) ) {
                         $fid = $row['user_id']; ?>
                  <?php if( $c % 4 == 0 ) { ?>
                    <li>
                  <?php } ?>
                    <div class="wruser borderuser">
                      <img class="loading-image" id="loading-image-<?php echo $fid?>" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/loading-1.gif" style="display:none;" /> 
                      <div class="show-user" id="show-user-<?php echo $fid?>">
                      <figure>
							<?php $user_info = get_userdata( $fid ); ?>
                            <a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $fid ); ?>" title="<?php echo xprofile_get_field_data( 1, $fid );?>"><?php echo get_avatar( $fid, 40 ); ?></a> 
                     </figure>
                      <h2>
                        <?php $disname = xprofile_get_field_data( 1, $fid ); echo substr_utf8( $disname, 0, 15 ); ?>
                      </h2>
                      <?php if( $fid != $uid & bp_loggedin_user_id() == $uid ){ ?>
							<?php if ( in_array( $fid , $nArray ) ) { ?>
                                <a class="following-btn" onclick="searchunfollowUser('<?php echo $fid?>','<?php echo $uid?>','follower')">Following</a>
                            <?php } else {  ?>
                                <a class="follower-btn" onclick="searchrefollowUser('<?php echo $fid?>','<?php echo $uid?>','follower')">+ Follow</a>
                            <?php } ?>
                       <?php } //End check bp_is_my_profile ?>
                        </div><!-- END show-user -->  
                      
                      </div>
                    <!-- END wruser --> 
                    
                  <?php if( $c % 4 == 3 || ( $c == $total_users )) { ?>
                    </li>
                    <?php }?>
                    <?php $c++; } //End while ?>
                  <br class="clear"/>
                </ul> 
          </div>
    <!--END flexslider--> 
  </section>
	  <?php } else {
				$string = '<div class="search-result"><blockquote>ไม่พบ " <span class="text-search">' .$term.'</span> " ในเพื่อนสมาชิก</blockquote></div>';
			}
			echo $string;
	}
?>

<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.flexslider.js"></script> 
<!-- FlexSlider Earng--> 
<script type="text/javascript">
    $(document).ready(function(){
		
	 $(".following-btn").hover(function(){
						$(this).text("Unfollow");
						$(this).parent().parent().addClass( "borderuser-active" );
						$(this).parent().parent().removeClass( "borderuser" );
					},function(){
						$(this).text("Following");
						$(this).parent().parent().removeClass( "borderuser-active" );
						$(this).parent().parent().addClass( "borderuser" );
		});
			
	
      $('.flexslider2').flexslider({
        animation: "slide",
		controlNav: false,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
					
					
	  
    });
	
	
	
	
	function searchunfollowUser(lid,fid,t) {
      $.ajax({
           type: "GET",
           url: '<?php echo get_template_directory_uri(); ?>/formUnfollow.php',
           data: "l=" + lid + "&f=" + fid + "&t" + t,
           success:function(data) {
				$.ajax({
					   type: "POST",
					   url: '<?php echo get_template_directory_uri(); ?>/searchuser.php',
					   data: "searchit=<?php echo $term;?>&u=<?php echo $uid;?>",
					   beforeSend: function() {
						  $("#show-user-" + lid).hide();
						  $("#loading-image-" + lid).show();
					   },
					   success:function(data) {
						  $("#display_results").html(data);
					   }
				  });
           }

		  });
	 }
 
 
 function searchrefollowUser(lid,fid,t) {
      $.ajax({
           type: "GET",
           url: '<?php echo get_template_directory_uri(); ?>/formRefollow.php',
           data: "l=" + lid + "&f=" + fid + "&t" + t,
           success:function(data) {
					$.ajax({
					   type: "POST",
					   url: '<?php echo get_template_directory_uri(); ?>/searchuser.php',
					   data: "searchit=<?php echo $term;?>&u=<?php echo $uid;?>",
					   beforeSend: function() {
						  $("#show-user-" + lid).hide();
						  $("#loading-image-" + lid).show();
					   },
					   success:function(data) {
						  $("#display_results").html(data);
					   }
				  });
			   }
	
		  });
	 }
  </script>