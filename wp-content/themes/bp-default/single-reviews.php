<?php get_header(); ?>
<!-- Add jQuery library -->

<!-- Add fancyBox main JS and CSS files -->
<!--<script type="text/javascript" src="<?php // echo get_template_directory_uri(); ?>/_inc/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php // echo get_template_directory_uri(); ?>/_inc/css/jquery.fancybox.css?v=2.1.5" media="screen" />-->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/colorbox.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.colorbox.js"></script>

<script type="text/javascript">

	<!--$(function(){ -->
		function formReserve(btype,bid,mail,btitle,timg){	
		
			$.ajax({
				type	: "POST",
				cache	: false,
				url		: "<?php echo get_template_directory_uri(); ?>/formReserve.php",
				data	: { bistroType: btype,bistroId: bid, bistroEmail: mail,bistroTitle: btitle,bistroTableImg :timg},
				success: function(data) {
					//alert(data);
					//$.colorbox({html:data,iframe:true,innerWidth:613, innerHeight:345});
					$.fancybox(data);
				}
			});
			return false;  
		}
	<!-- }); -->  
</script>
<script>
$( document ).ready(function() {
	var url = document.URL;
	//alert(url);
	var findme = "#wpcf7";
	
	if ( url.indexOf(findme) > -1 ) {
		
			$(".inline").colorbox({iframe:true,fastIframe: false,innerWidth:613, innerHeight:345}).trigger('click'); 
			history.pushState("", document.title, window.location.pathname);
			
		
	}
});

</script>
<style type="text/css">
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
	.acf-map {
		width: 420px;
		height: 290px;
		border: #ccc solid 1px;
		margin: 10px 0;
		position: fixed;
		float:left;
	}
	#cboxClose {
		background: url(<?php bloginfo('stylesheet_directory'); ?>/_inc/images/closeReserve.png) no-repeat -2px 0;
		top: 25px;
    	right: 5px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript">
	(function($) {
		function render_map( $el ) {
			var $markers = $el.find('.marker');
			var args = {
				zoom		: 16,
				center		: new google.maps.LatLng(0, 0),
				mapTypeId	: google.maps.MapTypeId.ROADMAP
			};
		
			var map = new google.maps.Map( $el[0], args);// create map
			map.markers = [];// add a markers reference
			$markers.each(function(){// add markers
				add_marker( $(this), map );
			});
			center_map( map );
		}
		
		function add_marker( $marker, map ) {
			var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
			var marker = new google.maps.Marker({// create marker
				position	: latlng,
				map			: map
			});
			map.markers.push( marker );// add to array
			// if marker contains HTML, add it to an infoWindow
			if( $marker.html() ){
				// create info window
				var infowindow = new google.maps.InfoWindow({
					content		: $marker.html()
				});
				// show info window when marker is clicked
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open( map, marker );
				});
			}
		}
		
		function center_map( map ) {
			var bounds = new google.maps.LatLngBounds();
			// loop through all markers and create bounds
			$.each( map.markers, function( i, marker ){
				var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
				bounds.extend( latlng );
			});
			if( map.markers.length == 1 )// only 1 marker?
			{
				map.setCenter( bounds.getCenter() );
				map.setZoom( 16 );
			}
			else
			{
				// fit to bounds
				map.fitBounds( bounds );
			}
		}
		
		$(document).ready(function(){
			$('.acf-map').each(function(){
				render_map( $(this) );
			});
		});
	
	})(jQuery);
</script>
<a class="inline" href="<?php bloginfo('stylesheet_directory'); ?>/thanksReserve.php"></a>

<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/specialDetail.css" />
<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal" style="margin-bottom: 5px;">
          
           			 
			
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
      
        	</div><!-- End content-by-meal -->
           <div style="clear:both"></div>
		<div class="padder">
			<?php do_action( 'bp_before_blog_single_post' ); ?>
				
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php 
				$imageBg = get_field('background');
			?>		
			<div class="page" id="blog-single" role="main" >						
						
				<div class="imgBg" style="background-color:white;"><img src="<?php echo $imageBg; ?>" width="1200" style="-webkit-mask-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)))"/></div>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="singlenavigation-darkbg" style="margin-bottom:20px;">
							<a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> >  <a href="<?php echo home_url(); ?>/bistro/">อร่อยนอกบ้าน</a> > <a href="<?php echo home_url(); ?>/special_review/">สเปเชียลรีวิว</a> > <a href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
						</div>	
					
					<!-- <div class="navig">
						
					</div> -->
					<div style="clear:both;"></div>
					<div class="post-content">
						<div class="header">
							<div class="imageHolder2">
								<?php 
								$bheader = get_field('special_bheader');
								?>
								<div style="width:1035px;height:310px;overflow:hidden"><?php echo imagesize($bheader,1035,310);?></div>
								
								
								<div class="title"><br><?php the_field('special_bName'); ?></div> 
								<div class="logo">
									<?php 
										$image = get_field('special_blogo');
										if( !empty($image) ): 
									?>
										<img src="<?php echo $image; ?>" height="75" border="0"/>
									<?php endif; ?>
								</div>
								<?php
									$showFormat = get_field('special_bshow');
									if($showFormat=='วีดีโอ'){
									?>
										<?php  
											$url = get_field('special_burl');
											parse_str( parse_url( $url, PHP_URL_QUERY ), $get_args);
										?>	
										
										<div class="vdoSpecial">
											<iframe class="align-left" width="450" height="280" src="https://www.youtube.com/embed/<?php echo $get_args['v']; ?>" frameborder="0" allowfullscreen></iframe>							
								
										</div>
									<?php
									}else{
								?>
                                	<?php 

									$images = get_field('special_bImg');
									if( $images ): ?>
											<?php 
											$no = 1;
											foreach( $images as $image ): 
												if($no==1){
												?>
                                                	<div class="bistroImg1" style='width:215;height:240;overflow:hidden'>
                                                    	<?php echo imagesize($image['url'],215,240);?>
                                                    </div>
                                                <?php
												}else if($no==2){
												?>
                                                	<div class="bistroImg2" style='width:215;height:240;overflow:hidden'>
                                                		<?php echo imagesize($image['url'],215,240);?>
                                                	</div>
                                                <?php
												}
											?>
											<?php $no++; 
											endforeach; ?>
									<?php endif; ?>
								<?php } ?>
							</div> 
							<div class="excerpt" style='background-color:<?php the_field('special_bbcolor');?>;'>
								<br/><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/quote1.png" border="0"><p></p><?php the_field('special_bdesc');?><p><p><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/quote2.png" border="0"><br/>
							</div>
							<div class="social2"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
						</div>
						<div class="entry">
							<div class="col-left">
                            	<div style="font-family:tahoma;font-size:14px;"><?php echo the_field('special_bdetail');?></div>
                            </div>
                            <!-- end col-left -->
							<div class="col-right">
                            	<?php if( have_rows('special_brel') ):?> <!-- ร้านที่มีสาขาเดียว -->
                               	 	<?php while ( have_rows('special_brel') ) : the_row(); ?>
                                		<?php $bid = get_sub_field('special_bid'); ?>
                            				<div class="detailBistro" >
												<div class="iconBistro"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconBistro.png" border="0"></div>
												<div class="textBistro">&nbsp;รายละเอียดร้าน</div>
												<div class="bistro">
													<div class="bistro-left">
                                       					<div class="bistroName"><a href="<?php echo get_permalink($bid[0]);?>"><?php the_field('special_bName'); ?></a></div>
                                                        <?php
															$sql = "SELECT * FROM wp_postmeta WHERE meta_key='review_bistroid' AND meta_value='".$bid[0]."'"; 
														
															$result = $wpdb->get_results($sql);
															$Img_num_rows = $wpdb->num_rows;
															//echo $Img_num_rows;
															foreach ($result as $key){
																$reviewId = $key->post_id;
																
																$sqlPoint = "SELECT * FROM wp_postmeta WHERE meta_key='review_rating' AND post_id='".$reviewId."'";
																
																$objPoint = $wpdb->get_results($sqlPoint);
																
																foreach ($objPoint as $keyPoint){
																	$point += $keyPoint->meta_value;
																}
															}
															if($Img_num_rows>0){
																$pointCal = $point*(100/(5*$Img_num_rows));
															}else{
																$pointCal = 0;
															}
														?>
                                                        <div class="stars">
															<div class="rating" style="width:<?php echo $pointCal;?>%"></div>
															<input type="radio" name="rating" id="star5" value="5">
															<label for="star5"></label>
															<input type="radio" name="rating" id="star4" value="4">
															<label for="star4"></label>
															<input type="radio" name="rating" id="star3" value="3">
															<label for="star3"></label>
															<input type="radio" name="rating" id="star2" value="2">
															<label for="star2"></label>
															<input type="radio" name="rating" id="star1" value="1">
															<label for="star1"></label>
														</div> <!-- end class stars -->
                                                        <div>
															
                    									</div>
                                        			</div>  <!-- end bistro-left -->
                                        
                                        			<div class="bistro-right">
                            				
                                        			<?php
														$sqlImgBistro = "SELECT * FROM wp_postmeta WHERE meta_key='bistro_img' AND post_id='".$bid[0]."' LIMIT 1"; 
														$resultImg = $wpdb->get_results($sqlImgBistro);
														$row = $wpdb->num_rows;
														foreach ($resultImg as $attachment){
															$image_attributes = wp_get_attachment_image_src($attachment->meta_value,'thumb'); 
														?> 

                                                    		
														<?php  } //end foreach ?>
                                             			<div style='position:relative;margin-bottom:10px;'>
                                                            <?php
                                                        		if($row!=0){echo imagesize($image_attributes[0],100,100);}
                                                        		else{echo '<img src="'.get_template_directory_uri().'/_inc/images/100x100.jpg">';}
															?>
                                                    	</div>
                                        			</div> <!-- end bistro-right-->
                                        
                                  			</div> <!-- end bistro -->
                             			</div> <!-- end detailBistro -->
                                 <?php
                                 		endwhile;
								?>       
                                <?php 
								$sqlReview = "SELECT v1.post_id ,v2.post_author,v2.post_content,v2.post_title,v3.meta_value AS rating
											FROM wp_postmeta v1
											INNER JOIN wp_posts v2
											ON v1.post_id =v2.ID
											LEFT  JOIN wp_postmeta v3
											ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
											WHERE v1.meta_value='".$bid[0]."'  
											AND v1.meta_key='review_bistroid'
											AND v2.post_type='review' 
											ORDER BY v2.post_date DESC 
											LIMIT 2";
								//echo $sqlReview;
								$resultReviews = $wpdb->get_results($sqlReview);
								$rowCount = $wpdb->num_rows;
								//echo $rowCount;
								if($rowCount>0){
								?>  
                              	<div class="latestReview">
									<div class="iconReview"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconReview.png" border="0"></div>
									<div class="textReview">&nbsp;รีวิวล่าสุด</div>
                                    <div style="height:20px"></div>
                                    <?php foreach($resultReviews as $reviewer){ 
										list($rank,$rankImg) = lvMember($reviewer->post_author);
									?>
                                        <div class="review">
                                            <div class="reviewerImg" ><?php echo get_avatar($reviewer->post_author , 50 ); ?></div>
                                            <div class="reviewerName" >
                                            <img src="<?php echo $rankImg;?>" border="0" width="30" height="32" style="vertical-align:middle;"/><?php echo xprofile_get_field_data( 1, $reviewer->post_author);?></div>
                                            <div class="reviewerRate">
                                            	<div class="stars">
															<div class="rating" style="width:<?php echo $reviewer->rating*20;?>%"></div>
															<input type="radio" name="rating" id="star5" value="5">
															<label for="star5"></label>
															<input type="radio" name="rating" id="star4" value="4">
															<label for="star4"></label>
															<input type="radio" name="rating" id="star3" value="3">
															<label for="star3"></label>
															<input type="radio" name="rating" id="star2" value="2">
															<label for="star2"></label>
															<input type="radio" name="rating" id="star1" value="1">
															<label for="star1"></label>
												</div> <!-- end class stars -->
                                            
                                            
                                            </div>
                                            
                                            <div style="clear:both"></div>
                                            <div class="reviewContent"><?php echo "\"".$reviewer->post_title."\"<br/>";?><?php //echo substr_utf8( $reviewer->post_content, 0 , 100);?></div>
                                        
                                        </div> <!-- end review -->
                                    <?php } ?>
                                    <div class="allReview"><a href="<?php echo get_permalink($bid[0]);?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/allReview.png" border="0"></a></div>
                               	</div>   <!-- end latestReview -->
                            	<?php } //end if rowCount>0?>
                                
                            <?php elseif( have_rows('special_brelBranch') ): ?>
								<div id="branchDetail"></div>
							<?php endif //end if have_rows('special_brel') end if have_rows('special_brelbranch')
							?>    
                            	<div class="linktoshop"><a href="/promotion"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/linktoshop.png" border="0"></a></div>    	
							</div>	<!-- end col-right -->
                            
                            
							<div style='clear:both'></div>
                            
							<div class="recommendZone">
								<div class="Mascot"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/recommendMc.jpg" border="0"></div>
								<div style="font-family:tahoma;font-sixe:14px;"><?php echo the_field('special_brcm');?></div>
							</div>
							<div class="mapZone">
                            <?php if( have_rows('special_brel') ):?> <!-- ร้านที่มีสาขาเดียว -->
                            	<?php while ( have_rows('special_brel') ) : the_row(); ?>
                                    <div class="map" style="width:420px;height:290px;">
                                    <?php 
										$location = get_sub_field('special_bmap');
										if( !empty($location) ):
										?>
										<div class="acf-map">
											<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
										</div>
										<?php endif; ?>
                                    </div>	
                                    <div class="address">
                                    <?php $link = get_sub_field('special_bid');?>
                                        <div class="bistroName" style='font-size:16px'><b><a href="<?php echo get_permalink($link[0]);?>"><?php the_field('special_bName')?></a></b></div><br/>
                                        <div class="add-left"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconAdd.png" border="0"> ที่อยู่ : </div><div class="add-right"><?php the_sub_field('special_baddress');?></div><br/>
                                        <div class="add-left"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconTime.png" border="0"> เวลาเปิด-ปิด : </div><div class="add-right"><?php the_sub_field('special_btime');?></div><br/>
                                        <div class="add-left"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconTel.png" border="0"> เบอร์โทรศัพท์ : </div><div class="add-right"><?php the_sub_field('special_btel');?></div><br/>
                                        <?php 
                                            $bistroPlan = get_sub_field('special_btset');
                                            $bistroEmail = get_sub_field('special_bemail');
											//echo $bistroPlan;
											//echo $bistroEmail;
                                            if( ! empty( $bistroPlan ) && ! empty( $bistroEmail ) ) {
                                        ?>
                                        <div class="reserve"><input type="image" name="imageField" id="reserveBtn"  src="<?php echo get_template_directory_uri(); ?>/_inc/images/reserveBtn.png" onClick="formReserve('<?php echo get_field('spacial_bType');?>','<?php echo $link[0];?>','<?php echo $bistroEmail;?>','<?php echo  get_field('special_bName');?>','<?php echo $bistroPlan;?>')"/></div>
                                        <?php } ?>
                                    </div>
                                <?php endwhile; ?>
                            <?php elseif( have_rows('special_brelBranch') ):?> <!-- ร้านที่มีหลายสาขา -->
                            
                            	<script>
                                function queryMap(data){
									//alert(data.value);
									$.ajax({
										type	: "POST",
										cache	: false,
										dataType: "json",
										url		: "<?php echo get_template_directory_uri(); ?>/queryMap.php",
										data	: { bistroId: data.value,postId:"<?php echo get_the_id();?>"},
										success: function(data) {
											//alert(data.branchDetail);
											document.getElementById("branchDetail").innerHTML = data.branchDetail;
											document.getElementById("querymap").innerHTML = data.map;
											document.getElementById("address").innerHTML = data.address;
											
											$('.acf-map').each(function(){
												//alert($(this).find('.marker').attr('data-lat')+" , "+$(this).find('.marker').attr('data-lng'));
												render_map( $(this) );
											});
											
											function render_map( $el ) {
												var $markers = $el.find('.marker');
												var args = {
													zoom		: 16,
													center		: new google.maps.LatLng(0, 0),
													mapTypeId	: google.maps.MapTypeId.ROADMAP
												};
												var map = new google.maps.Map( $el[0], args);// create map
												map.markers = [];// add a markers reference
												$markers.each(function(){// add markers
													add_marker( $(this), map );
												});
												center_map( map );
											}
											function add_marker( $marker, map ) {
												var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
												var marker = new google.maps.Marker({// create marker
													position	: latlng,
													map			: map
												});
												map.markers.push( marker );
												if( $marker.html() ){
													var infowindow = new google.maps.InfoWindow({
														content		: $marker.html()
													});
													google.maps.event.addListener(marker, 'click', function() {
														infowindow.open( map, marker );
													});
												}
											}
											
											function center_map( map ) {
												var bounds = new google.maps.LatLngBounds();
												$.each( map.markers, function( i, marker ){
													var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
													bounds.extend( latlng );
												});
												if( map.markers.length == 1 ){
													map.setCenter( bounds.getCenter() );
													map.setZoom( 16 );
												}
												else{
													map.fitBounds( bounds );
												}
											}
											function formReserve(btype,bid,mail,btitle,timg){
												$.ajax({
													type	: "POST",
													cache	: false,
													url		: "<?php echo get_template_directory_uri(); ?>/formReserve.php",
													data	: { bistroType: btype,bistroId: bid, bistroEmail: mail,bistroTitle: btitle,bistroTableImg :timg},
													success: function(data) {
														//alert(data);
														//$.colorbox({html:data,iframe:true,innerWidth:613, innerHeight:345});
														$.fancybox(data);
													}
												});
												return false;  
											}
											
									}
									});
									return false; 
								}
                                </script>


                                <div class="address">
                                	<div class="bistroName" style='font-size:16px'><b><?php the_field('special_bName')?></b></div>
                                	<div class="styled-select">
                                        <select  id="selectAdd" onChange="queryMap(this)">
                                            <?php $row = 0;?>
                                            <?php while ( have_rows('special_brelBranch') ) : the_row(); ?>
                                            <?php $branchId = get_sub_field('special_bbranchId'); ?>
                                            <option value="<?php echo $row."-".$branchId[0]; ?>"><?php echo get_the_title($branchId[0]); ?></option>
                                            <?php $row++;?>
                                            <?php endwhile;?>
                                        </select>
                                    </div>
                                    <style>
                                    .styled-select select {
									   background: transparent;
									   width: 200px;
									   padding: 5px;
									   font-family:tahoma;
									   font-size: 12px;
									   line-height: 1;
										border: 1px solid #ccc;
									   height: 25px;
									   -webkit-appearance: none;
									   }
									   .styled-select {
											margin-top:10px;
										   width: 200px;
										   height: 25px;
										   overflow: hidden;
										   background: url(<?php echo get_template_directory_uri(); ?>/_inc/images/dropdown_arrow.png) no-repeat right #FFF;
									  
									   }
 
                                    </style>
                                    <script>
									$( document ).ready(function() {
                                     $('#selectAdd').val(<?php echo $row."-".$branchId[0]; ?>).change();
									});
                                    </script>
                                </div>
                                	<div class="map" id="querymap" style="width:420px;height:290px;"></div>
                                    <div class="address" id="address"></div>
                            <?php endif;?>
							</div>
						</div>
				</div>
				

			<?php endwhile; else: ?>

				<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>
			</div>
			<?php endif; ?>

		

		<?php do_action( 'bp_after_blog_single_post' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->
	
	<?php //get_sidebar(); ?>

<?php get_footer(); ?>