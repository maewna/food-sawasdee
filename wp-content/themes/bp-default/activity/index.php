<?php  session_start();
//print_r($_SESSION);
?>

<?php get_header(); ?>
<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/home.css" />


<!-----------------------------------------------Script Bistro Location---------------------------------------------------->
<script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobubble/src/infobubble.js" type="text/javascript"></script>
		<script type="text/javascript">
			
			$( document ).ready(function() {
				initGeolocation();
				//google.maps.event.addDomListener(window, 'load', initialize);
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
					url: "wp-content/themes/bp-default/getLatLon_ajax.php",
					dataType: 'json',
					data: "cLat=" + latitude + "&cLon="+ longitude + "&timeNow=" + hours + "&hitSlc=0",
								
					success: function(data){
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
						if(data.countBistro>0){
							result.innerHTML = data.bDetail; //show ร้านอาหาร
							bistroView.innerHTML = data.view; //show จำนวนผู้เข้าชม
							numReview.innerHTML = data.numReview; //show จำนวนรีวิว
							bistroTime.innerHTML = data.createTime; //show เวลาสร้างร้านอาหาร
										/************************************************************************/
							var strLocation = "["+data.location+"]";
							var myObject = eval('(' + strLocation + ')');
							var mapPin = "["+data.iconPin+"]";
							var myObjectPin = eval('(' + mapPin + ')');
							var bUrl = "["+data.bUrl+"]";
							var myObjectbURL = eval('(' + bUrl + ')');
							var name =[];
							var lat=[];
							var lon=[];
							var icon=[];
							var bUrl=[];
							for (i in myObject){
								name.push(myObject[i]["name"]);
								lat.push(myObject[i]["blat"]);
								lon.push(myObject[i]["blon"]);
								icon.push(myObjectPin[i]["icon"]);
								bUrl.push(myObjectbURL[i]["bUrl"]);
							}
							var map = new google.maps.Map(document.getElementById('map'), {
								zoom: 17,
								center: new google.maps.LatLng(data.nearbyLat, data.nearbyLon),
								mapTypeId: google.maps.MapTypeId.ROADMAP
							});			   
							//var infowindow = new google.maps.InfoWindow();
							var infoBubble = new InfoBubble({	shadowStyle: 1,
																padding: 5,
																backgroundColor: 'rgb(255,255,255)',
																borderRadius: 5,
																arrowSize: 10,
																minHeight:25,
																borderWidth: 1,
																borderColor: '#2c2c2c',
																disableAutoPan: true,
																hideCloseButton: true,
																arrowPosition: 30,
																backgroundClassName: 'transparent',
																arrowStyle: 2,
																scroll:false
															});
							var marker,i;
							var iconCounter = 0;
							for (i = 0; i < data.countBistro; i++) {  
								//	var bURL = bistroURL[i]
								marker = new google.maps.Marker({	position: new google.maps.LatLng(lat[i], lon[i]),
																	map: map,
																	icon: icon[iconCounter]
																});
												 
								google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
									return function() {
										infoBubble.setContent(name[i]);
										infoBubble.open(map, marker);
									}
								})(marker, i));
								
								google.maps.event.addListener(marker, 'mouseout', function() {
									infoBubble.close();
								});
											
								google.maps.event.addListener(marker, 'click', (function(marker,i) {
									return function() {
										window.location.href = bUrl[i]
									}
								})(marker, i));
								
								iconCounter++;
							}
						}//end if countBistro> 0
						else{
							/*$("#trigger").fancybox({
							'width' : 200,
							'height': 150}).trigger('click');*/
						}
									/************************************************************************/
					} // close success
				}); //close ajax
			 }//close function success
			 
			 function noLocation() {
				//alert('fail');
				var latitude=''; 
				var longitude='';
				var currentTime = new Date();
				var hours = currentTime.getHours();
				$.ajax({
					type:"POST",
					url: "wp-content/themes/bp-default/getLatLon_ajax.php",
					dataType: 'json',
					data: "cLat=" + latitude + "&cLon="+ longitude + "&timeNow=" + hours + "&hitSlc=1",
					
					success: function(data){
						document.getElementById("txt-location").style.marginLeft = "20px";
						cLocation.innerHTML = "<input type='text' id='filllocation' placeholder='ระบุพื้นที่'  class='filllocation'/><input type='image' src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/go.jpg' onClick='submitAddr()' style='margin-top:-10px;margin-left:7px;'><span id='loader' style='display:none'><img src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/loading_icon_small.gif'/></span>";
						document.getElementById("loader").style.display = "none";
						if(data.countBistro>0){
							result.innerHTML = data.bDetail;
							numReview.innerHTML = data.numReview;
							bistroView.innerHTML = data.view;
							bistroTime.innerHTML = data.createTime;
							/************************************************************************/
							var strLocation = "["+data.location+"]";
							var myObject = eval('(' + strLocation + ')');
							var mapPin = "["+data.iconPin+"]";
							var myObjectPin = eval('(' + mapPin + ')');
							var bUrl = "["+data.bUrl+"]";
							var myObjectbURL = eval('(' + bUrl + ')');
							var name =[];
							var lat=[];
							var lon=[];
							var icon=[];
							var bUrl=[];
							for (i in myObject)
							{
								name.push(myObject[i]["name"]);
								lat.push(myObject[i]["blat"]);
								lon.push(myObject[i]["blon"]);
								icon.push(myObjectPin[i]["icon"]);
								bUrl.push(myObjectbURL[i]["bUrl"]);
							}
							var map = new google.maps.Map(document.getElementById('map'), {
										zoom: 17,
										center: new google.maps.LatLng(data.nearbyLat, data.nearbyLon),
										mapTypeId: google.maps.MapTypeId.ROADMAP
									});			   
									//var infowindow = new google.maps.InfoWindow();
							var infoBubble = new InfoBubble({
												shadowStyle: 1,
												padding: 5,
												backgroundColor: 'rgb(255,255,255)',
												borderRadius: 5,
												arrowSize: 10,
												minHeight:25,
												borderWidth: 1,
												borderColor: '#2c2c2c',
												disableAutoPan: true,
												hideCloseButton: true,
												arrowPosition: 30,
												backgroundClassName: 'transparent',
												arrowStyle: 2,
												scroll:false
											});
							var marker,i;
							var iconCounter = 0;
							for (i = 0; i < data.countBistro; i++) {  
							//	var bURL = bistroURL[i]
								marker = new google.maps.Marker({
											position: new google.maps.LatLng(lat[i], lon[i]),
											map: map,
											icon: icon[iconCounter]
										});
									 
								google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
									return function() {
										infoBubble.setContent(name[i]);
										infoBubble.open(map, marker);
									}
								})(marker, i));
								google.maps.event.addListener(marker, 'mouseout', function() {
									infoBubble.close();
								});
								google.maps.event.addListener(marker, 'click', (function(marker,i) {
									return function() {
										//alert(bistroURL[i]);
										window.location.href = bUrl[i]
									}
								})(marker, i));
								iconCounter++;
							}
						}//end if countBistro>0
						else{
							/*document.getElementById("loader").style.display = "none";
							$("#trigger").fancybox({
							'width' : 200,
							'height': 150}).trigger('click');*/
						}
						/************************************************************************/
					} // close ajax success
					}); //close ajax
			 } //close function fail
		   </script>  
		   <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>-->

<script>
	/*function initialize() {
	  var input = (document.getElementById('filllocation'));
	 // alert(input);
	  var autocomplete = new google.maps.places.Autocomplete(input);
	}*/
	
	function submitAddr(){
		document.getElementById("loader").style.display = "inline";
		var currentTime = new Date();
		var hours = currentTime.getHours();
		var filllocation = document.getElementById("filllocation").value;
		if(filllocation!=""){
			$.ajax({
				url: "wp-content/themes/bp-default/AddrGetLatLon.php",
				type: "POST",
				dataType: "json",
				data: "addr=" + filllocation +"&timeNow=" + hours,
				success: function(data){
						
						document.getElementById("iconMap").style.display = "none";
						document.getElementById("txt-location").style.marginLeft = "20px";
						cLocation.innerHTML = "<input type='text' id='filllocation' value='"+filllocation+"' class='filllocation'/><input type='image' src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/go.jpg' onClick='submitAddr()' style='margin-top:-10px;margin-left:7px;'><span id='loader' style='display:none'><img src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/loading_icon_small.gif'/></span>";
						
						if(data.countBistro>0){
							document.getElementById("loader").style.display = "none";
							result.innerHTML = data.bDetail;
							numReview.innerHTML = data.numReview;
							bistroView.innerHTML = data.view;
							bistroTime.innerHTML = data.createTime;
							/************************************************************************/
							var strLocation = "["+data.location+"]";
							var myObject = eval("(" + strLocation + ")");
							//alert(strLocation);
							var mapPin = "["+data.iconPin+"]";
							var myObjectPin = eval("(" + mapPin + ")");
							var bUrl = "["+data.bUrl+"]";
							var myObjectbURL = eval("(" + bUrl + ")");
							var name =[];
							var lat=[];
							var lon=[];
							var icon=[];
							var bUrl=[];
							for (i in myObject)
							{
								name.push(myObject[i]["name"]);
								lat.push(myObject[i]["blat"]);
								lon.push(myObject[i]["blon"]);
								icon.push(myObjectPin[i]["icon"]);
								bUrl.push(myObjectbURL[i]["bUrl"]);
							}
							var map = new google.maps.Map(document.getElementById('map'), {
										zoom: 17,
										center: new google.maps.LatLng(data.nearbyLat, data.nearbyLon),
										mapTypeId: google.maps.MapTypeId.ROADMAP
									});			   
									//var infowindow = new google.maps.InfoWindow();
							var infoBubble = new InfoBubble({
												shadowStyle: 1,
												padding: 5,
												backgroundColor: 'rgb(255,255,255)',
												borderRadius: 5,
												arrowSize: 10,
												minHeight:25,
												borderWidth: 1,
												borderColor: '#2c2c2c',
												disableAutoPan: true,
												hideCloseButton: true,
												arrowPosition: 30,
												backgroundClassName: 'transparent',
												arrowStyle: 2,
												scroll:false
											});
							var marker,i;
							var iconCounter = 0;
							for (i = 0; i < data.countBistro; i++) {  
							//	var bURL = bistroURL[i]
								marker = new google.maps.Marker({
											position: new google.maps.LatLng(lat[i], lon[i]),
											map: map,
											icon: icon[iconCounter]
										});
									 
								google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
									return function() {
										infoBubble.setContent(name[i]);
										infoBubble.open(map, marker);
									}
								})(marker, i));
								google.maps.event.addListener(marker, 'mouseout', function() {
									infoBubble.close();
								});
								google.maps.event.addListener(marker, 'click', (function(marker,i) {
									return function() {
										//alert(bistroURL[i]);
										window.location.href = bUrl[i]
									}
								})(marker, i));
								iconCounter++;
							}
						}//end if countBistro > 0
						else{
							/*document.getElementById("loader").style.display = "none";
							$("#trigger").fancybox({
							'width' : 200,
							'height': 150}).trigger('click');*/
						}
				}//end success
				
			});//end ajax
		} //end if
		else{
			return false;
		}
	}
</script>	
		<a id="trigger" href="#noBistro" style="display:none"></a>
		<div style="display:none;" id="noBistro">
			เพิ่มร้านสิ
		</div>
		<?php
		//ฟังก์ชันคำนวณระยะห่างของ latitude longitude คำนวณออกมาเป็น กิโลเมตร 
		/*function distance($lat1, $lon1, $lat2, $lon2) {
			$theta = $lon1 - $lon2;
			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$miles = $dist * 60 * 1.1515;
			return ($miles * 1.609344);
		}*/
		?>
		<!-----------------------------------------------End Script Bistro Location---------------------------------------------------->
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
<main id="content" >
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
		
            <div class="content-by-meal">
			
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
                                <img src="" alt=""  id="imgtime"  style="position:absolute; z-index: -1; height:575px;  width:1200px;"  />			
                                  <?php break;  endwhile;  ?>	
                                 
         <!-------------------------- END time ----------------------------------------->      
                         
				
                        <section class="my-location my-location-home">
						<span class="txt-meal">
                                <!--
								  <?php if ( $time  >= "04:00:00" &&  $time  < "11:00:00" ){   ?> 
                                   
                         			  	Good Morning
                                      
                         			<?php } elseif ($time  >= "11:00:00" &&  $time  < "16:00:00" ){ ?>  
                         
                         				Good Afternoon
                         
                         			<?php } elseif ($time  >= "16:00:00" &&  $time  < "20:00:00" ){ ?>  
                                    	
                                       Good Evening
                         
                         			<?php } elseif ($time  >= "20:00:00" &&  $time  < "04:00:00" ){ ?> 
                         
                         				Enjoy Eating
                                        
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
                                <span class="txt-location" id="txt-location"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/location-icon.png" style="margin-top: -15px;" id="iconMap"/>
									<div id="cLocation" style="display:inline;"></div>
								</span>
								 

                            </section><!-- End my-location -->
                         
                         <section style="width: 1035px; margin: 0 auto;">
                              <?php //get_search_form(); ?><?php echo do_shortcode( '[wpdreams_ajaxsearchpro id=1]' ); ?>
                         </section><!-- End search -->
                                <div class="wr-highlight-content">
                                     <figure class="recipe-by-meal">
										<span class="timesmeal"></span>
									   </figure><!-- End recipe-by-meal -->
							
														
          <!--------------------------------------------- End TIME--------------------------------------------->
						  <figure class="review-by-meal">
												
          <!--------------------------------------------- Start TIME Review --------------------------------------------->					  
		
<div id="result">

<div id="loading" style="height:343px;margin-top:130px"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ajax-loader2.gif" /></div>

</div>

<div id="map" style="width: 150px; height: 345px;position:absolute;right:10px;top:10px;"></div>
<div>
    <figcaption class="entry-meta-header">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/comment-icon.png"/> <span id="numReview" ></span> รีวิว  <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/view-icon.png"/> <span id="bistroView"></span> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/calendar-icon.png"/> <span id="bistroTime"></span>
    </figcaption>
	</div>
    <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/eat-out-icon.png"/> 

			  <!--------------------------------------------------------End Time Review ---------------------------------------------------->
								 </figure><!-- End review-by-meal -->
                                </div><!-- End wr-highlight-content -->
                                <div class="highlight-content">
                                	<h2 class="align-left">อร่อยในบ้าน</h2>
                                	<h2 class="align-right">อร่อยนอกบ้าน</h2>
                                </div><!-- End highlight-content -->
                         
        	</div><!-- End content-by-meal -->
            
			
											

            <div class="content-section-1">
				 <div style="height:60px; background-color:#ffecd7; margin-bottom:10px;">
				 <h2 class="title varity-icon">วาไรตี้ร้านอร่อย</h2>
				 </div>
            		
				
                    <section class="review-by-user">
                    	<ul>
							<?php 
								$variety = new WP_Query( array('post_type' => 'variety', 'posts_per_page' => '2', 'post_status' => 'publish','orderby'=>'modified' ,'order' => 'DESC') );
								if ( $variety->have_posts() ) :
								while ( $variety->have_posts() ) : $variety->the_post(); ?>
									<li>
										<article>
											<figure><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
											<?php $image_src = wp_get_attachment_url( get_post_thumbnail_id($variety->ID) ); ?>
											<?php echo imagesize($image_src,370,240); ?></a></figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php echo substr_utf8(get_the_title(),0,50);?></a></h3>
											<p style="min-height: 110px;">
												<?php echo get_excerpt(500); ?>
											</p>
										
										<span class="cleaner_h30"></span>
										<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?>
                                      
                                       
                                       
										</article>
									</li>										
							<?php endwhile; ?>
							<?php endif; ?>		
							<?php //wp_reset_query(); ?>
                           </ul>
                    </section><!-- End review-by-user -->
					
                    <section class="review-by-admin">
                    	<ul>
						<?php 
								//$sticky = get_option( 'sticky_posts' );
								$variety_sticky = new WP_Query( array('post_type' => 'variety', 'posts_per_page' => '1', 'post_status' => 'publish','orderby'=>'modified' ,'order' => 'DESC','offset' => '2' ));
								if ( $variety_sticky->have_posts() ) :
								while ( $variety_sticky->have_posts() ) : $variety_sticky->the_post(); ?>
                        	<li>
										<article>
											<figure>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
											<?php $sticky_src = wp_get_attachment_url( get_post_thumbnail_id($variety_sticky->ID) ); ?>
											<?php echo imagesize($sticky_src,320,240); ?></a>
											</figure>
											
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php echo substr_utf8(get_the_title(),0,50);?></a></h3>
											<p style="margin-bottom: 97px;">
												<?php echo get_excerpt(500); ?>
											</p>
										<span class="cleaner_h20"></span>
										<?php if(function_exists('wp_ulike')) wp_ulike('get'); ?>
                                        
										</article>
									</li>
							<?php endwhile; ?>
							<?php endif; ?>	
                        </ul>
                    </section>
					
					<!-- End review-by-admin -->
            		<br class="clear"/>
					
					 <div style="height:60px; background-color:#ffecd7; margin-bottom:10px;">
						 <h2 class="title celeb-icon" style="color:#f48335;">เข้าครัวกับคนดัง</h2>
					</div>
                    <div class="box-l">
                        <section class="recipe-by-celeb">
                        	<ul>
							<?php 
								$celebcook = new WP_Query( array('post_type' => 'celebcook', 'posts_per_page' => '1', 'post_status' => 'publish') );
								if ( $celebcook->have_posts() ) :
								while ( $celebcook->have_posts() ) : $celebcook->the_post(); ?>
									<li>	
										<article>
											<figure>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
													<?php $cover_image = get_field('cover_img');
														if( !empty($cover_image) ): ?>
															<?php echo imagesize( $cover_image, 580, 330 ); ?>
														<?php endif; ?>
												</a>
											</figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
											<p>
												<?php echo get_excerpt(720); ?>
											</p>
											<ul class="recipe-info">
												<li><label for="level" class="recipe-level">ระดับความง่าย</label>
												<?php	
														$recipe_rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
														if($recipe_rating!=0){$smileRating = $recipe_rating*(100/5);}
														else{$smileRating = 0;}
													?>
															<div class="smile">
																	<div class="smileRating" style="width:<?php echo $smileRating;?>%"></div>
																		<input type="radio" name="smileRating" id="smile5" value="5">
																		<label for="smile5"></label>
																		<input type="radio" name="smileRating" id="smile4" value="4">
																		<label for="smile4"></label>
																		<input type="radio" name="smileRating" id="smile3" value="3">
																		<label for="smile3"></label>
																		<input type="radio" name="smileRating" id="smile2" value="2">
																		<label for="smile2"></label>
																		<input type="radio" name="smileRating" id="smile1" value="1">
																		<label for="smile1"></label>
																	</div>
												
												</li>
												<li><label for="ingredient" class="recipe-ingredient">วัตถุดิบ</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></li>
												<li><label for="meal" class="recipe-meal">มื้อ</label><span>
												<?php	$v = get_post_meta( get_the_ID(), 'check_meal', true ); 
														$ts = array('breakfast','lunch','dinner','supper');
														$tsTH = array('เช้า','กลางวัน','เย็น','ดึก');											
															if($v){
																$x = 0;
																foreach($ts as $t){ 
																	if (in_array($t, $v)) { echo $tsTH[$x].' ';}
																$x++;
																} 
															} 
												?></span></li>
											</ul>
											<div class="recipe-author">
												<figure>
												<a href="<?php echo home_url(); ?>/author/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?>">
													<?php bp_activity_avatar(array('user_id' => get_the_author_meta('ID'))); ?>
												</a>
												</figure>
												<p>
													<span class="recipe-celeb-name">โดย<a href="<?php echo home_url(); ?>/author/<?php the_author_meta( 'user_nicename', get_the_author_meta('ID') ); ?>" title="<?php echo xprofile_get_field_data( 1, $post->post_author);?>"><?php echo xprofile_get_field_data( 1, $post->post_author);?></a></span>
													<span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
													<span class="recipe-date"><?php the_time(); ?></span>
												</p>
												
												<br class="clear"/>
											</div>
											<div style="  margin-top: -45px;margin-left: 330px; float:left;"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
										</article>
									</li>			
							<?php endwhile; ?>
							<?php endif; ?>		
							<?php wp_reset_query(); ?>						
                        	</ul>
                            <section class="recommend-celeb">
                            	<h2>กระทะร้อนกับเซเลบ</h2>
                                <div class="wr-celeb">
								<?php 
								$user_query = new WP_User_Query( array( 'role' => 'Celeb','number' => 6));
								if ( ! empty( $user_query->results ) ) {
									
									foreach ( $user_query->results as $celeb ) {
								 ?>    
										<figure>
											<li style="list-style: none;">
											<a href="<?php echo home_url(); ?>/author/<?php the_author_meta( 'user_nicename', $celeb->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $celeb->ID);?>">
												 <div class="box-image">
													<?php echo get_avatar( $celeb->ID,70); ?> 
													<div class="bg-review-title">
														 <div class="cleaner_h13"></div>
													</div>
												</div>								
											</a>
										</li>
									
										</figure>
								<?php	 
										}//End foreach
								}//End if	?>		
							<?php wp_reset_query(); ?>	                      
                                   <br class="clear"/>
                                </div>
                        	</section>
                        </section><!-- End recipe-by-celeb -->
                        
                    </div><!-- End box-l -->
                    <div class="box-r">
						<div class="bg-bag-image"></div>
                        <h2 class="title recipe-icon" style="color:#f48335;">สูตรอาหารเด็ด</h2>
                        <section class="recipe-by-user">
                        	<ul>
							<?php 
								$recipe = new WP_Query( array('post_type' => 'recipes', 'posts_per_page' => '2', 'post_status' => 'publish') );
								if ( $recipe->have_posts() ) :
								while ( $recipe->have_posts() ) : $recipe->the_post(); ?>
									<li>	
										<article>
											<figure>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                                                    <?php $recipe_src = wp_get_attachment_url( get_post_thumbnail_id($recipe->ID) ); ?>
													<?php echo imagesize($recipe_src,226,330); ?> 
                                                </a>
											</figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php echo substr_utf8(get_the_title(),0,50);?></a></h3>
											<p>
												<?php echo get_excerpt(150); ?>
											</p>
											
											
											<ul class="recipe-info">
												<li style="height: 10px;"><label for="level" class="recipe-level">ระดับความง่าย</label>
												<?php	
														$recipe_rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
														if($recipe_rating!=0){$smileRating = $recipe_rating*(100/5);}
														else{$smileRating = 0;}
													?>
															<div class="smile">
																	<div class="smileRating" style="width:<?php echo $smileRating;?>%"></div>
																		<input type="radio" name="smileRating" id="smile5" value="5">
																		<label for="smile5"></label>
																		<input type="radio" name="smileRating" id="smile4" value="4">
																		<label for="smile4"></label>
																		<input type="radio" name="smileRating" id="smile3" value="3">
																		<label for="smile3"></label>
																		<input type="radio" name="smileRating" id="smile2" value="2">
																		<label for="smile2"></label>
																		<input type="radio" name="smileRating" id="smile1" value="1">
																		<label for="smile1"></label>
																	</div>
												
												</li>
												<li style="height: 10px;"><label for="ingredient" class="recipe-ingredient">วัตถุดิบ</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></li>
												<li><label for="meal" class="recipe-meal">มื้อ</label><span>
												<?php	$cv = get_post_meta( get_the_ID(), 'check_meal', true ); 
														$cts = array('breakfast','lunch','dinner','supper');
														$ctsTH = array('เช้า','กลางวัน','เย็น','ดึก');											
															if($cv){
																$cx = 0;
																foreach($cts as $ct){ 
																	if (in_array($ct, $cv)) { echo $ctsTH[$cx].' ';}
																$cx++;
																} 
															} ?></span></li>
											</ul>
											<div class="recipe-author">
												<figure>
												<a href="<?php echo bp_core_get_user_domain( get_the_author_meta('ID') ) ?>" title="<?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?>">
													<?php bp_activity_avatar(array('user_id' => get_the_author_meta('ID'))); ?>
												</a>
												</figure>
												<p style="margin-top: -64px; margin-left: 55px;">
													<span class="recipe-name">โดย <?php echo bp_core_get_userlink(get_the_author_meta('ID'));?></span>
													<span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
													<span class="recipe-date"><?php the_time(); ?></span>
												</p>
												<br class="clear"/>
											</div><!-- End recipe-author -->
											<div style="margin-top: -43px; margin-bottom: 30px;"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div><br class="clear"/>
										</article>
									</li>			
							<?php endwhile; ?>
							<?php endif; ?>		
							<?php wp_reset_query(); ?>		
							
                              <?php /*
								$setmenu = new WP_Query( array('post_type' => 'setmenu', 'posts_per_page' => '1', 'post_status' => 'publish') );
								if ( $setmenu->have_posts() ) :
								while ( $setmenu->have_posts() ) : $setmenu->the_post(); ?>
									<li>	
										<article>
											<figure>
												<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('recipe'); ?> </a>
											</figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
											<p>
												<?php echo get_excerpt(500); ?>
											</p>
											
											
											<ul class="recipe-info">
												<li style="height: 10px;"><label for="level" class="recipe-level">ระดับความง่าย</label>
												<?php	
														$recipe_rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
														if($recipe_rating!=0){$smileRating = $recipe_rating*(100/5);}
														else{$smileRating = 0;}
													?>
															<div class="smile">
																	<div class="smileRating" style="width:<?php echo $smileRating;?>%"></div>
																		<input type="radio" name="smileRating" id="smile5" value="5">
																		<label for="smile5"></label>
																		<input type="radio" name="smileRating" id="smile4" value="4">
																		<label for="smile4"></label>
																		<input type="radio" name="smileRating" id="smile3" value="3">
																		<label for="smile3"></label>
																		<input type="radio" name="smileRating" id="smile2" value="2">
																		<label for="smile2"></label>
																		<input type="radio" name="smileRating" id="smile1" value="1">
																		<label for="smile1"></label>
																	</div>
												
												
												</li>
												<li style="height: 10px;"><label for="ingredient" class="recipe-ingredient">วัตถุดิบ</label><span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></li>
												<li><label for="meal" class="recipe-meal">มื้อ</label><span><?php 
													$values = get_post_meta( get_the_ID(), 'check_meal', true ); 
													$itemsTH = array('เช้า','กลางวัน','เย็น','ดึก');
													if($values){
														foreach($values as $value){ 
															if($value=='breakfast'){
																echo 'เช้า ';
															}else if($value=='lunch'){
																echo 'กลางวัน ';
															}else if($value=='dinner'){
																echo 'เย็น ';
															}else if($value=='supper'){
																echo 'ดึก ';
														}
													}
													}
												?></span></li>
											</ul>
											<div class="recipe-author">
												<figure>
												<a href="<?php echo bp_core_get_user_domain( get_the_author_meta('ID') ) ?>" title="<?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?>">
													<?php bp_activity_avatar(array('user_id' => get_the_author_meta('ID'))); ?>
												</a>
												</figure>
												<p style="margin-top: -64px; margin-left: 55px;">
													<span class="recipe-name">โดย <?php echo bp_core_get_userlink(get_the_author_meta('ID'));?></span>
													<span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span>
													<span class="recipe-date"><?php the_time(); ?></span>
												</p>
												<br class="clear"/>
											</div><!-- End recipe-author -->
											<div style="padding-top: 22px; margin-top: -125px; margin-bottom: 32px;"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
										</article>
									</li>			
							<?php endwhile; ?>
							<?php endif; ?>		
							<?php wp_reset_query(); */?>		
                        	</ul>
                        </section><!-- End recipe-by-user -->
                    </div><!-- End box-r -->
                    <br class="clear"/>
                    
            </div><!-- End content-section-1 -->
         <div style="height:60px; background-color:#ffecd7;"></div>   
        <div  class="content-section-2">
		
        		<div class="box-l">
        			<h2 class="title trend-icon green">เทรนด์โซน</h2>
            		
                    <section class="trend-zone">
                    	<ul>
							<?php 
								$trend_zone = new WP_Query( array('post_type' => 'trend', 'posts_per_page' => '1', 'post_status' => 'publish') );
								if ( $trend_zone->have_posts() ) :
								while ( $trend_zone->have_posts() ) : $trend_zone->the_post(); ?>
									<li>	
										<article>
											<figure><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                                            <?php $trend_src = wp_get_attachment_url( get_post_thumbnail_id($trend_zone->ID) ); ?>
											<?php echo imagesize($trend_src,445,350); ?>
                                            </a></figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
											<p>
												<?php echo get_excerpt(500); ?>
											</p>
										</article>
									</li>			
							<?php endwhile; ?>
							<?php endif; ?>		
							<?php wp_reset_query(); ?>
							
                        </ul>
                    </section>
					<div style="margin-top: -40px;">
					<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
					<?php //if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
                 </div><!-- End box-l -->
				 
                 <div class="box-r">
        			
                    <div class="bestMember" style="margin-top:-24px">
						<?php include "include_bestmember.php";?>
                        <style>
                        .bestTitle{
							font-size: 30px;
							margin-top:-5px;
						}
						.btn_regis{
							margin-left:30px;
						}
                        </style>
                        
                    </div>
					
                   
                    <section class="recommend-member" style="margin-left: 20px;margin-top: 15px;">
                            	<h2 class="recommend-member-icon">สมาชิก FoodSawasdee</h2>
                                <div class="wr-member">
									<?php /*$memberArray = array();
										$user_query = new WP_User_Query( array(  'orderby' => 'registered', 'number' => 4 ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
										<figure>
											<?php $user_info = get_userdata($username->ID); 
												  $user_level =  implode(', ', $user_info->roles);
												  if($user_level == 'celeb'){ ?>
													<a href="<?php echo get_author_posts_url($username->ID);?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 68 ); ?></a>
											<?php }else{?>
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 68 ); ?></a>
											<?php }*/?>
											
											<?php $memberArray = array();
										$user_query = new WP_User_Query( array(  'orderby' => 'registered', 'number' => 4 , 'role' => 'Subscriber' ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
										<figure>
											<?php $user_info = get_userdata($username->ID); ?>
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 65 ); ?></a>
											
											
											
										</figure>	
										<?php array_push($memberArray, $username->ID );	?>		
									<?php } }	//end foreach
										$user_query = new WP_User_Query( array( 'orderby' => 'rand', 'number' => 6, 'role' => 'Subscriber', 'exclude' => $memberArray ) );
									
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
										<figure>
											<?php $user_info = get_userdata($username->ID); ?>
												<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 65 ); ?></a>
										</figure>	
									<?php } }//end foreach?>	
								   
                                   <!--<figure><a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/pic-ex14.jpg"/></a></figure>-->
                                 
                                   <br class="clear"/>
                                </div>
                      </section><!-- End recommend-member -->
                 </div><!-- End box-r -->
                 <br class="clear"/>
        </div>
        
        
        
        <div class="content-section-3">
        	<div class="box-l">
        		<section class="tiptechnique">
                    	<ul>
						<?php 
								$likesara = new WP_Query( array('post_type' => 'likesara', 'posts_per_page' => '2', 'post_status' => 'publish') );
								if ( $likesara->have_posts() ) :
								while ( $likesara->have_posts() ) : $likesara->the_post(); ?>
									<li>
										<article>
											<figure><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                                            <?php $likesara_src = wp_get_attachment_url( get_post_thumbnail_id($likesara->ID) ); ?>
											<?php echo imagesize($likesara_src,340,235); ?>
                                            </a></figure>
											<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
											<p>
												<?php echo get_excerpt(600); ?>
											</p>
											<div style="margin-top: 58px"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
										</article>
										
									</li>										
							<?php endwhile; ?>
							<?php endif; ?>		
							<?php wp_reset_query(); ?>
							
                        </ul>
                    </section><!-- End tiptechnique -->
        	</div><!--  End box-l -->
            <div class="box-r"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/banner-1.png"/>
            </div><!--  End box-r -->
        </div><!-- End content-section-3 -->
		
		<?php do_action( 'bp_after_blog_home' ); ?>
		
</main>
 <script type="text/javascript">
      var currentTime = new Date()
      var hours = currentTime.getHours()
      var elem = document.getElementById('imgtime')
         if (hours >= 4 && hours < 11) {
             elem.src = '<?php echo $img ;?>';
             elem.alt = 'Morning';
          }
		else if (hours >= 11 && hours < 16) {
            elem.src = '<?php echo $img2 ;?>';
            elem.alt = 'Afternoon';
        }
		else if (hours >= 16 && hours < 20) {
            elem.src = '<?php echo $img3 ;?>';
            elem.alt = 'Evening';
        }
        else if (hours >= 20 || hours < 4) {
            elem.src = '<?php echo $img4 ;?>';
            elem.alt = 'Night';
        }
		
	 if (hours >= 4 && hours < 11) {
         $(".txt-meal").html("Good Morning");	
    }
	else if (hours >= 11 && hours < 16) {
        $(".txt-meal").html("Good Afternoon");
    }
	else if (hours >= 16 && hours < 20) {
        $(".txt-meal").html("Good Evening");
    }
    else if (hours >= 20 || hours < 4) {
        $(".txt-meal").html("Enjoy Eating");
    }
	
	 if (hours >= 4 && hours < 11) {
         $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/> <span id="clock4"></span>');	
     }
	else if (hours >= 11 && hours < 16) {
        $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/afternoon-icon.png"/> <span id="clock4"></span>');	
    }
	else if (hours >= 16 && hours < 20) {
        $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>');	
    }
    else if (hours >= 20 || hours < 4) {
        $(".txt-time").html('<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/evening-icon.png"/> <span id="clock4"></span>');	
    }
	
	var html = '<?php $args = array( 'post_type' => 'recipes', 'posts_per_page' => 1, 'orderby' => 'rand' , 'meta_query' => array(array('key'=>'check_meal','value'=>'breakfast','compare' => 'LIKE'),),);$post_type_data = new WP_Query( $args );while($post_type_data->have_posts( )):$post_type_data->the_post();?><figcaption><h3 class="entry-title"><a href="<?php echo the_permalink(); ?>" style="color:#ffffff; text-decoration: none;"><?php echo the_title(); ?></a></h3><span class="entry-owner">โดย <?php echo xprofile_get_field_data( 1, $post->post_author);?></span></figcaption><?php if(has_post_thumbnail()): ?><?php $default=array('class'=>'img-responsive');the_post_thumbnail('recipe2', $default); ?><?php endif; ?><figcaption class="entry-meta-header"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/view-icon.png"/> <?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/comment-icon.png"/> <?php comments_number( 'ไม่มีความคิดเห็น', '1 ความคิดเห็น', '%  ความคิดเห็น' ); ?> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/calendar-icon.png"/>&nbsp;<?php the_time(); ?>&nbsp;</figcaption><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/cooking-icon.png"/> <?php endwhile; ?>';   
	if (hours >= 4 && hours < 11) {
    $(".timesmeal").html( html ); 
	} 
	else if (hours >= 11 && hours < 16) {
	$(".timesmeal").html( html ); 
	}
	else if (hours >= 16 && hours < 20) {
	$(".timesmeal").html( html ); 
	}
	else if (hours >= 20 || hours < 4) {
	$(".timesmeal").html( html ); 
	}
	
	
</script>
                                              
<?php get_footer(); ?>

