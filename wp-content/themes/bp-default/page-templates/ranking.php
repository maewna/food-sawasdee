<?php
/**
 * Template Name: Ranking Member
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 ?>
<?php get_header(); ?>

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>
<script type="text/javascript">
			$( document ).ready(function() {
				initGeolocation();
			});
			 function initGeolocation(){
				if( navigator.geolocation ){
				   // Call getCurrentPosition with success and failure callbacks
				   navigator.geolocation.getCurrentPosition( success, fail );
				}else{
				   alert("Sorry, your browser does not support geolocation services.");
				}
			 }
			 function success(position){
				var latitude  = position.coords.latitude; 
				var longitude = position.coords.longitude;
				$.ajax({
					type:"POST",
					url: "<?php echo bloginfo('stylesheet_directory'); ?>/getLatLon_ajax.php",
					dataType: 'json',
					data: "cLat=" + latitude + "&cLon="+ longitude,
					
					success: function(data){
						var lat = latitude;
						var lng = longitude;
						//alert(lat);
						var latlng = new google.maps.LatLng(lat, lng);
						var geocoder = geocoder = new google.maps.Geocoder();
						geocoder.geocode({ 'latLng': latlng }, function (results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								if (results[1]) {
									var Location= results[1].formatted_address;
									cLocation.innerHTML = Location;
								}
							}else{
								alert('cn');
							}
						});
					} // close success
					}); //close ajax
			 }
			 function fail() {
				var latitude  = 13.75; //bangkok center
				var longitude = 100.516667;
				$.ajax({
					type:"POST",
					url: "<?php echo bloginfo('stylesheet_directory'); ?>/getLatLon_ajax.php",
					dataType: 'json',
					data: "cLat=" + latitude + "&cLon="+ longitude,
					
					success: function(data){
						cLocation.innerHTML = "<input type='text' name='test' placeholder='à¸£à¸°à¸šà¸¸à¸žà¸·à¹‰à¸™à¸—à¸µà¹ˆ'/>";
						
					} // close success
					}); //close ajax
			 }
		   </script> 
<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal" style="margin-bottom: 3px;">
          
           		<?php	
						$args = array( 'post_type' => 'post');		
						$post_type_data = new WP_Query( $args );
						while($post_type_data->have_posts()): $post_type_data->the_post();
					
					?>
                <!--------------------------Morning----------------------------------------->   
                   <?php if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                       
								<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            
                                         ?>
                                
                              <?php  } else if ((get_field('date')) == ''){   ?>	
                                
                                <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                                
                <!--------------------------Afternoon----------------------------------------->             
                        <?php } elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                          
                          			<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-2-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            
                                         ?>
                                
                              <?php  } else if ((get_field('date')) == ''){   ?>	
                                
                                <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-2-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                                         
  				<!--------------------------Evening----------------------------------------->   
                  
                          <?php } elseif ( $time  >= "16:00:00" && $time  < "20:00:00"){ ?>  
                          
                          			<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-3-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            
                                         ?>
                                
                              <?php  } else if ((get_field('date')) == ''){   ?>	
                                
                                <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-3-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                          
                          <!--------------------------Night----------------------------------------->   
                  
                          <?php } elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?>  
                          
                          			<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-4-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            
                                         ?>
                                
                              <?php  } else if ((get_field('date')) == ''){   ?>	
                                
                                <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-4-' . $img ); 
                    
                                
                                              echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                          
                          <?php } ?> 
                               
                                  <?php break;  endwhile;  ?>	
                                  
         <!-------------------------- END time ----------------------------------------->   
 
                     <section class="my-location my-location-home">
                         <span class="txt-meal" style="margin-top:5px;">
								
								  <?php if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                                   
                         			  	Good Morning
                                      
                         			<?php } elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                         
                         				Good Afternoon
                         
                         			<?php } elseif ($time  >= "16:00:00" &&  $time  < "20:00:00" ){ ?>  
                                    	
                                       Good Evening
                         
                         			<?php } elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?> 
                         
                         				Enjoy Eating
                                        
                                    <?php } ?>

								</span>
                                 <span class="txt-time">
                               
                                  <?php if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                                   
                         			  	<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/> <span id="clock4"></span>
                                      
                         			<?php } elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                         
                         				<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/afternoon-icon.png"/> <span id="clock4"></span>
                         
                         			<?php } elseif ($time  >= "16:00:00" &&  $time  < "20:00:00" ){ ?>  
                                    	
                                        <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>
                         
                         			<?php } elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?> 
                         
                         				<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>
                                        
                                    <?php } ?>
                                </span>
                                <span class="txt-location"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/location-icon.png" style="margin-right:10px; margin-top: -15px;"/>
									<div id="cLocation" style="display:inline;"></div>
								</span>
                            </section><!-- End my-location -->
                         
                         <section style="width: 1050px; margin: 0 auto;">
                              <?php get_search_form(); ?>
                         </section><!-- End search -->
        	</div><!-- End content-by-meal -->
            
            <div class="content-promotion">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ranking-member.jpg"/>
            </div><!-- End content-promotion-->
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/ranking.css">
            <div class="member">
				<div class="arrow_box"><!----LV1----->
				<?php
					global $wpdb;
					$sqlLv1 = "SELECT * FROM 
									(	SELECT post_author,COUNT(*) AS numReview 
										FROM wp_posts 
										WHERE (post_type='review' OR post_type='recipes')
										AND post_status='publish' 
										GROUP BY post_author) r1
								WHERE r1.numReview<5 ";
					$resLv1 = $wpdb->get_results($sqlLv1);
					$numLv1 = $wpdb->num_rows;
					?>
					<div class="memberul">
					
					<?php
					for($i=0;$i<4;$i++){
						if($resLv1[$i]->post_author!=''){	
							echo "<a href='".home_url()."/members/".get_the_author_meta( 'user_nicename', $resLv1[$i]->post_author )."'><div class='eachmem' >".get_avatar( $resLv1[$i]->post_author,60)."</div></a>";
						}else{
							echo "<div class='eachmem'><img src='".get_template_directory_uri()."/_inc/images/defaultUser.jpg'/></div>";
						}
					}
					if($numLv1>2){
					$numOther = $numLv1-2;
					echo "<div class='omem' style='color:#d58033'>และเพื่อนสมาชิกอีก ".$numOther." คน</div>";
					}
					?>
					</div>
				</div>
				<div class="arrow_box"><!---LV2---->
				<?php
					global $wpdb;
					$sqlLv2 = "SELECT * FROM 
									(	SELECT post_author,COUNT(*) AS numReview 
										FROM wp_posts 
										WHERE (post_type='review' OR post_type='recipes')
										AND post_status='publish' 
										GROUP BY post_author) r2
								WHERE r2.numReview<20 AND r2.numReview>=5";
					$resLv2 = $wpdb->get_results($sqlLv2);
					$numLv2 = $wpdb->num_rows;
					?>
					<div class="memberul">
					
					<?php
					for($i=0;$i<4;$i++){
						if($resLv2[$i]->post_author!=''){	
							echo "<a href='".home_url()."/members/".get_the_author_meta( 'user_nicename', $resLv2[$i]->post_author )."'><div class='eachmem' >".get_avatar( $resLv2[$i]->post_author,60)."</div></a>";
						}else{
							echo "<div class='eachmem'><img src='".get_template_directory_uri()."/_inc/images/defaultUser.jpg'/></div>";
						}
					}
					if($numLv2>4){
					$numOther = $numLv2-4;
					echo "<div class='omem' style='color:#cb5120'>และเพื่อนสมาชิกอีก ".$numOther." คน</div>";
					}
					?>
					</div>
				</div>
				<div class="arrow_box"><!---LV3---->
				<?php
					global $wpdb;
					$sqlLv3 = "SELECT * FROM 
									(	SELECT post_author,COUNT(*) AS numReview 
										FROM wp_posts 
										WHERE (post_type='review' OR post_type='recipes')
										AND post_status='publish' 
										GROUP BY post_author) r3
								WHERE r3.numReview<30 AND r3.numReview>=20";
					$resLv3 = $wpdb->get_results($sqlLv3);
					$numLv3 = $wpdb->num_rows;
					?>
					<div class="memberul">
					
					<?php
					for($i=0;$i<4;$i++){
						if($resLv3[$i]->post_author!=''){	
							echo "<a href='".home_url()."/members/".get_the_author_meta( 'user_nicename', $resLv3[$i]->post_author )."'><div class='eachmem' >".get_avatar( $resLv3[$i]->post_author,60)."</div></a>";
						}else{
							echo "<div class='eachmem'><img src='".get_template_directory_uri()."/_inc/images/defaultUser.jpg'/></div>";
						}
					}
					if($numLv3>4){
					$numOther = $numLv3-4;
					echo "<div class='omem' style='color:#378dc0'>และเพื่อนสมาชิกอีก ".$numOther." คน</div>";
					}
					?>
					</div>
				</div>
				<div class="arrow_box"><!---LV4---->
				<?php
					global $wpdb;
					$sqlLv4 = "SELECT * FROM 
									(	SELECT post_author,COUNT(*) AS numReview 
										FROM wp_posts 
										WHERE (post_type='review' OR post_type='recipes')
										AND post_status='publish' 
										GROUP BY post_author) r4
								WHERE r4.numReview<60 AND r4.numReview>=30";
					$resLv4 = $wpdb->get_results($sqlLv4);
					$numLv4 = $wpdb->num_rows;
					?>
					<div class="memberul">
					<?php
					for($i=0;$i<4;$i++){
						if($resLv4[$i]->post_author!=''){	
							echo "<a href='".home_url()."/members/".get_the_author_meta( 'user_nicename', $resLv4[$i]->post_author )."'><div class='eachmem' >".get_avatar( $resLv4[$i]->post_author,60)."</div></a>";
						}else{
							echo "<div class='eachmem'><img src='".get_template_directory_uri()."/_inc/images/defaultUser.jpg'/></div>";
						}
					}
					if($numLv4>4){
					$numOther = $numLv4-4;
					echo "<div class='omem' style='color:#80a00e'>และเพื่อนสมาชิกอีก ".$numOther." คน</div>";
					}
					?>
					</div>
				</div>
				<div class="arrow_box"><!---LV5---->
				<?php
					global $wpdb;
					$sqlLv5 = "SELECT * FROM 
									(	SELECT post_author,COUNT(*) AS numReview 
										FROM wp_posts 
										WHERE (post_type='review' OR post_type='recipes')
										AND post_status='publish' 
										GROUP BY post_author) r5
								WHERE r5.numReview>=60";
					$resLv5 = $wpdb->get_results($sqlLv5);
					$numLv5 = $wpdb->num_rows;
					?>
					<div class="memberul">
					<?php
					for($i=0;$i<4;$i++){
						if($resLv5[$i]->post_author!=''){	
							echo "<a href='".home_url()."/members/".get_the_author_meta( 'user_nicename', $resLv5[$i]->post_author )."'><div class='eachmem' >".get_avatar( $resLv5[$i]->post_author,60)."</div></a>";
						}else{
							echo "<div class='eachmem'><img src='".get_template_directory_uri()."/_inc/images/defaultUser.jpg'/></div>";
						}
					}
					if($numLv5>4){
						$numOther = $numLv5-4;
						echo "<div class='omem' style='color:#009a90'>และเพื่อนสมาชิกอีก ".$numOther." คน</div>";
					}
					?>
					</div>
				</div>
			</div>
		<?php do_action( 'bp_after_blog_home' ); ?>
		
</main>

<?php get_footer(); ?>