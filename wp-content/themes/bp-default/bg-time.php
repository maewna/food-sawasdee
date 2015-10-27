<script type="text/javascript">
			$( document ).ready(function() {
				initGeolocation();
				
			});
			 function initGeolocation(){
				if( navigator.geolocation ){
				   // Call getCurrentPosition with success and failure callbacks
				   navigator.geolocation.getCurrentPosition( foundLocation, noLocation );
				}else{
				   alert("Sorry, your browser does not support geolocation services.");
				}
			 }
			 function foundLocation(position){
				var latitude  = position.coords.latitude; 
				var longitude = position.coords.longitude;
				//var latitude='';
				//var longitude='';
				if(latitude==''||longitude==''){
					noLocation();
				}
				var currentTime = new Date();
				var hours = currentTime.getHours();
				$.ajax({
					type:"POST",
					url: "../../wp-content/themes/bp-default/getLatLon_ajax.php",
					dataType: 'json',
					data: "cLat=" + latitude + "&cLon="+ longitude + "&timeNow=" + hours + "&hitSlc=0",
								
					success: function(data){
						//alert(data);
						var lat = latitude;
						var lng = longitude;
						var latlng = new google.maps.LatLng(lat, lng);
						var geocoder = geocoder = new google.maps.Geocoder();
						geocoder.geocode({ 'latLng': latlng }, function (results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							if (results[1]) {
								var Location= results[1].formatted_address;
								Location = Location.substring(0,40)+".....";
									cLocation.innerHTML = Location; // show current location
								}
								}else{
									noLocation();
								}
						});
					} // close success
					}); //close ajax
			 }
			 function noLocation() {
				var latitude=''; 
				var longitude='';
				var currentTime = new Date();
				var hours = currentTime.getHours();
				$.ajax({
					type:"POST",
					url: "../../wp-content/themes/bp-default/getLatLon_ajax.php",
					dataType: 'json',
					data: "cLat=" + latitude + "&cLon="+ longitude + "&timeNow=" + hours + "&hitSlc=1",
					
					success: function(data){
						document.getElementById("iconMap").style.display = "none";
						document.getElementById("txt-location").style.marginLeft = "20px";
						cLocation.innerHTML = "<input type='text' id='filllocation' placeholder='ระบุพื้นที่'  class='filllocation'/><input type='image' src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/go.jpg' onClick='submitAddr()' style='margin-top:-10px;margin-left:7px;'>";
						
						
					} // close success
					}); //close ajax
			 }
		   </script>  
			<script>
			function submitAddr(){
				//alert('abc');
				var currentTime = new Date();
				var hours = currentTime.getHours();
				var filllocation = document.getElementById("filllocation").value;
				//alert(filllocation);
				
				if(filllocation!=""){
					$.ajax({
						url: "../../wp-content/themes/bp-default/AddrGetLatLon.php",
						type: "POST",
						dataType: "json",
						data: "addr=" + filllocation +"&timeNow=" + hours,
						success: function(data){
								document.getElementById("iconMap").style.display = "none";
								document.getElementById("txt-location").style.marginLeft = "20px";
								cLocation.innerHTML = "<input type='text' id='filllocation' value='"+filllocation+"' class='filllocation'/><input type='image' src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/go.jpg' onClick='submitAddr()' style='margin-top:-10px;margin-left:7px;'>";
								} // close success
					}); //close ajax
				}else{
					return false;
				}
			}
			</script>
			<style>
			
.filllocation{
	margin-top:-10px;
	 background-color : #e8e8e7; 
    border: 0px; 
    height:20px; 
    width: 310px; 
    outline:0; 
	padding:5px;
	color:#724f34;
	font-size:14px;
}
			</style>
 <!-------------------------- Start time ----------------------------------------->   		
			<?php	
						$args = array( 'post_type' => 'post');		
						$post_type_data = new WP_Query( $args );
						while($post_type_data->have_posts()): $post_type_data->the_post();
					?>
                 <!--------------------------Morning----------------------------------------->   
                   <?php //if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                       
								<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img ) {
                                            
                                              $img = get_field('picture-' . $img ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px; width:1200px;"   >';
                                  
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
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                                
                <!--------------------------Afternoon----------------------------------------->             
                        <?php //} elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                          
                          			<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img2 ) {
                                            
                                              $img2 = get_field('picture-2-' . $img2 ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"   >';
                                  
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
                                            
                                            foreach( $keep as $img2 ) {
                                            
                                              $img2 = get_field('picture-2-' . $img2 ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                                         
  				<!--------------------------Evening----------------------------------------->   
                  
                          <?php //} elseif ( $time  >= "16:00:00" && $time  < "20:00:00"){ ?>  
                          
                          			<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img3 ) {
                                            
                                              $img3 = get_field('picture-3-' . $img3 ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"   >';
                                  
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
                                            
                                            foreach( $keep as $img3 ) {
                                            
                                              $img3 = get_field('picture-3-' . $img3 ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                          
                          <!--------------------------Night----------------------------------------->   
                  
                          <?php //} elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?>  
                          
                          			<?php if ((get_field('date')) == date("Ymd") ){ ?> 
                                    <?php
                                        $keep = array();
                                            for( $x = 1; $x <= 5; $x++ ) {
                                            
                                             $keep[$x] = $x;
                                            }
                                            
                                            shuffle( $keep );
                                            
                                            foreach( $keep as $img4 ) {
                                            
                                              $img4 = get_field('picture-4-' . $img4 ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"   >';
                                  
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
                                            
                                            foreach( $keep as $img4 ) {
                                            
                                              $img4 = get_field('picture-4-' . $img4 ); 
                    
                                
                                              //echo '<img src="'. $img .'"  style="position:absolute; z-index: -1;"   >';
                                  
                                             break;
                                            }
                                            }  
                                         ?>
                          
                          <?php //} ?> 
                                <img src="" alt=""  id="imgtime"  style="position:absolute; z-index: -200; height:575px;  width:1200px;"  />			
                                  <?php break;  endwhile;  ?>	
                                 
         <!-------------------------- END time ----------------------------------------->      
 
                     <section class="my-location my-location-home" style="top:40px; height: 115px;">
                         <span class="txt-meal" style="margin-top:5px;">
								
								     <!--
								  <?php if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                                   
                         			  	Beautiful Morning
                                      
                         			<?php } elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                         
                         				Lovely Afternoon
                         
                         			<?php } elseif ($time  >= "16:00:00" &&  $time  < "20:00:00" ){ ?>  
                                    	
                                       Delicious Evening
                         
                         			<?php } elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?> 
                         
                         				Party Eating
                                        
                                    <?php } ?>-->

								</span>
                                 <span class="txt-time">
                               
                                   <!-- <?php if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                                   
                         			  	<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/> <span id="clock4"></span>
                                      
                         			<?php } elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                         
                         				<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/afternoon-icon.png"/> <span id="clock4"></span>
                         
                         			<?php } elseif ($time  >= "16:00:00" &&  $time  < "20:00:00" ){ ?>  
                                    	
                                        <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>
                         
                         			<?php } elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?> 
                         
                         				<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>
                                        
                                    <?php } ?>-->
                                </span>
                                <span class="txt-location" id="txt-location"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/location-icon.png" style="margin-right:10px; margin-top: -15px;" id="iconMap"/>
									<div id="cLocation" style="display:inline;"></div>
								</span>
                            </section><!-- End my-location -->
                         
                         <section style="width: 1050px; margin: 0 auto;">
                              <?php //get_search_form(); ?><?php echo do_shortcode( '[wpdreams_ajaxsearchpro id=1]' ); ?>
                         </section><!-- End search -->

<script type="text/javascript">
      var currentTime = new Date()
      var hours = currentTime.getHours()
      var elem = document.getElementById('imgtime')
         if (hours >= 4 && hours < 12) {
             elem.src = '<?php echo $img ;?>';
             elem.alt = 'Morning';
          }
		else if (hours >= 12 && hours < 16) {
            elem.src = '<?php echo $img2 ;?>';
            elem.alt = 'Afternoon';
        }
		else if (hours >= 16 && hours < 22) {
            elem.src = '<?php echo $img3 ;?>';
            elem.alt = 'Evening';
        }
        else if (hours >= 22 || hours < 4) {
            elem.src = '<?php echo $img4 ;?>';
            elem.alt = 'Night';
        }
		
	 if (hours >= 4 && hours < 12) {
         $(".txt-meal").html("Beautiful Morning");	
    }
	else if (hours >= 12 && hours < 16) {
        $(".txt-meal").html("Lovely Afternoon");
    }
	else if (hours >= 16 && hours < 22) {
        $(".txt-meal").html("Delicious Evening");
    }
    else if (hours >= 22 || hours < 4) {
        $(".txt-meal").html("Party Eating");
    }
	
	 if (hours >= 4 && hours < 12) {
         $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/> <span id="clock4"></span>');	
     }
	else if (hours >= 12 && hours < 16) {
        $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/afternoon-icon.png"/> <span id="clock4"></span>');	
    }
	else if (hours >= 16 && hours < 22) {
        $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>');	
    }
    else if (hours >= 22 || hours < 4) {
        $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>');	
    }
</script>