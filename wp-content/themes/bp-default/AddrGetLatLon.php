
<?php
include_once("../../../wp-config.php");
// function to get  the address
function get_lat_long($address){

    $address = str_replace(" ", "+", $address);
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$lat = $response_a->results[0]->geometry->location->lat;
	$long = $response_a->results[0]->geometry->location->lng;
    return $lat.','.$long;
}
?>
<?php 
$hours = $_REQUEST['timeNow'];
$addr = $_REQUEST['addr'];
$latlong    =   get_lat_long($addr); // create a function with the name "get_lat_long" given as below
$map        =   explode(',' ,$latlong);
$cLat         =   $map[0];
$cLon    =   $map[1];  
if($cLat=='' || $cLon==''){
	$hitSlc = '1'; // ถ้า get latitude หรือ longitude ไม่ได้ ให้เลือกร้านฮิตมาแสดง 
} else{
	$hitSlc = '0'; 
}
//hitSlc = 1 คือ ให้เลือกร้านฮิตขึ้นมาแสดงเลย ไม่ต้องวนหาร้านใกล้เคียง เพราะว่าหา current location ของ user มาไม่ได้ 

//ฟังก์ชันคำนวณระยะห่างของ latitude longitude คำนวณออกมาเป็น กิโลเมตร 
function distance($lat1, $lon1, $lat2, $lon2) {
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	return ($miles * 1.609344);
}
if($hitSlc!='1'){
	//ถ้า เป็น browser ที่ไม่สามารถ get Lan Lon ได้ ต้องดักไว้ ด้วย Lat Lon ของ center ของ กทม
	//if($cLat==""){$cLat=13.75;}
	//if($cLon==""){$cLon=100.516667;}
	$sql_allMap = "SELECT * FROM wp_postmeta WHERE meta_key='bistro_map'";
	global $wpdb;
	$allMap = $wpdb->get_results($sql_allMap);
	$min_check = 2;
	$max_check = 5;
	for($i=$min_check;$i<$max_check;$i++):
		if(count($bistroArr)==0){  //ถ้าไม่เจอร้านในละแวก  2 กม เลย
			foreach($allMap AS $map){ // ให้วนร้านที่มีระยะไม่เกิน3กม
				$bLatLon = explode(",",$map->meta_value );
				$bLat = $bLatLon[0];
				$bLon = $bLatLon[1];
				$dLon = $bLon - $cLon;
				$dLat = $bLat - $cLat;
				$distance = distance($cLat, $cLon, $bLat, $bLon); //distance คือ ระยะห่างของร้านเป้าหมายกับร้านที่กำลังวน loop
				if($distance<=$i){ ////  จะเอา id ร้านที่มีระยะห่างไม่เกิน3กม
					$bistroArr[] = $map->post_id; // ได้ ID ของร้านที่อยู่ในละแวกใกล้เคียงแล้ว
				}
			}
		}
		else{ break; }
	endfor;
	//print_r($bistroArr);


	// เอา ID ของร้านใกล้เคียงมา หา ร้านตามช่วงเวลา
	for($i=0;$i<count($bistroArr);$i++){

	//เอา ID ร้านทั้งหมดในละแวกใกล้เคียง มา filter เพื่อ หา ID ร้าน ตามช่วงเวลา
		if ($hours >= 4 && $hours < 11) {
			$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='$bistroArr[$i]' AND meta_key='check_meal' AND meta_value LIKE '%breakfast%'";
		} 
		else if ($hours >= 11 && $hours < 16) {
			$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='$bistroArr[$i]' AND meta_key='check_meal' AND meta_value LIKE '%lunch%'";
		}
		else if ($hours >= 16 && $hours < 20) {
			$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='$bistroArr[$i]' AND meta_key='check_meal' AND meta_value LIKE '%dinner%'";
		}
		else if ($hours >= 20 || $hours < 4) {
			$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='$bistroArr[$i]' AND meta_key='check_meal' AND meta_value LIKE '%supper%'";
		}
		
		$querysByMeal = $wpdb->get_results($sqlBistroByMeal);
		$numMeal = $wpdb->num_rows;
		if($numMeal>0){
			// ทีนี้จะได้ ID ของร้านตามช่วงเวลา และก็ตามสถานที่ออกมาแล้ว เก็บเป็น array $bistroIdByMeal[]
			$bistroIdByMeal[] = $bistroArr[$i];
		}
		else{
			//ถ้าไม่มีร้านละแวกใกล้เคียงตามช่วงเวลาเลย ให้ดึงร้านฮิต
			query_posts(array( 	'post_type' => 'bistro',
							'post__in'  => get_option( 'sticky_posts' ),
							'ignore_sticky_posts' => 0
						) 
					);  
					//echo "no";
			while ( have_posts() ) : the_post();
				$bistroIdByMeal[] = $post->ID;
			endwhile;	
		}
	}
}else{ // hitslc = 0
	if(count($bistroIdByMeal)==0){ //ถ้าไม่มีร้านในละแวกใกล้เคียงตามช่วงเวลาเลย ให้เลือกร้านฮิตขึ้นมา (ร้านฮิต คือ ร้านที่ admin sticky)
		query_posts(array( 	'post_type' => 'bistro',
							'post__in'  => get_option( 'sticky_posts' )
						) 
					);  
					//echo "no";
		while ( have_posts() ) : the_post();
			$bistroIdByMeal[] = $post->ID;
		endwhile;
	}
}
//  นับ ก่อน ว่า มี กี่ตัว ที่เข้าข่าย 

$numOfBistro = count($bistroIdByMeal);
///echo $numOfBistro;
$randKey = rand(0,$numOfBistro-1); //random key ของ array เพื่อเอาไป select ข้อมูลขึ้นมา จะได้ point จุดสีแดง (random)
$sqlSelectBistro = "SELECT * FROM wp_posts WHERE ID ='".$bistroIdByMeal[$randKey]."'";
$bistros = $wpdb->get_results($sqlSelectBistro);
///echo $sqlSelectBistro;
foreach($bistros AS $bistro){
	$featureImg = wp_get_attachment_image_src(get_post_thumbnail_id($bistro->ID),array(330,345)); // returns an array
	$bDetail .= '<figcaption style="z-index:2">
		<h3 class="entry-title">
			<a href="'.get_permalink($bistro->ID).'" style="color:#ffffff; text-decoration: none;">'.$bistro->post_title.'</a>
		</h3>
		<span class="entry-owner">โดย  '.get_the_author_meta("display_name", $bistro->post_author).'</span>
    </figcaption>
	<div style="width:330px;height:345px;overflow:hidden;left:-20px;"><img src="'.$featureImg[0].'" height="345" style="margin-left:-30px;"/></div>'
	;
	
 } 
 ?>
	
<?php 						//$location = "[";
							for($i=0;$i<count($bistroIdByMeal);$i++){
								$sqlNearbyCurrent = "SELECT * FROM wp_postmeta WHERE post_id='$bistroIdByMeal[$i]' AND meta_key='bistro_map'";
								$nearbys = $wpdb->get_results($sqlNearbyCurrent);
								
								foreach($nearbys AS $nearby){
									$bLatLon = explode(",",$nearby->meta_value);
									$nearbyId = get_permalink($nearby->post_id);
									$bUrl .= "{'bUrl':'".$nearbyId."'}";
									if($i<count($bistroIdByMeal)-1){$bUrl .= ",";}
									$bistroTitle = get_the_title($nearby->post_id);
									//$location .= "['<div align=\"center\" style=\"font-size:12px;font-family:tahoma\">".$bistroTitle."</div>', ".$bLatLon[0].", ".$bLatLon[1]."]";
									$location .= "{'name':'<div align=\"center\" style=\"font-size:12px;font-family:tahoma\">".$bistroTitle."</div>','blat':".$bLatLon[0].",'blon':".$bLatLon[1]."}";
									if($i<count($bistroIdByMeal)-1){$location .= ",";}
									if($bistros[0]->ID==$bistroIdByMeal[$i]){
										//$bistroidShowed = $bistroIdByMeal[$i];
										$icons = "{'icon':'wp-content/themes/bp-default/_inc/images/pinRed.png'}";
										$nearbyLat = $bLatLon[0];
										$nearbyLon = $bLatLon[1];
										$view = do_shortcode( '[hit_count post='.$bistroIdByMeal[$i].']' );
										$sql_countReview = "SELECT * FROM wp_postmeta WHERE meta_key='review_bistroid' AND meta_value='".$bistroIdByMeal[$i]."'";
										$query_countReview = $wpdb->get_results($sql_countReview);
										$numReview = $wpdb->num_rows;
										$createTime = get_time_ago($bistroIdByMeal[$i]);
										
									}else{
										$icons = "{'icon':'wp-content/themes/bp-default/_inc/images/pinBlue.png'}";
									}
									$iconPin .= $icons;
									if($i<count($bistroIdByMeal)-1){$iconPin .= ",";}
								}
								
							}//$location .= "]";		
?>
	<?php
	echo json_encode(array(
		"bDetail" => $bDetail,
		"location" => $location,
		"nearbyLat" => $nearbyLat,
		"nearbyLon" => $nearbyLon,
		"iconPin" => $iconPin,
		"countBistro" => count($bistroIdByMeal),
		"view"=>$view,
		"numReview"=>$numReview,
		"bUrl"=>$bUrl,
		"createTime"=>$createTime
	));
	
	
	?>
