<?php 
$th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
$cLat = $_REQUEST['cLat'];
$cLon = $_REQUEST['cLon'];
include_once("../../../wp-config.php");

//ฟังก์ชันคำนวณระยะห่างของ latitude longitude คำนวณออกมาเป็น กิโลเมตร 
function distance($lat1, $lon1, $lat2, $lon2) {
	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	return ($miles * 1.609344);
}

//ถ้า เป็น browser ที่ไม่สามารถ get Lan Lon ได้ ต้องดักไว้ ด้วย Lat Lon ของ center ของ กทม
if($cLat==""){$cLat=13.75;}
if($cLon==""){$cLon=100.516667;}
$sql_allMap = "SELECT * FROM wp_postmeta WHERE meta_key='bistro_map'";
global $wpdb;
$allMap = $wpdb->get_results($sql_allMap);
foreach($allMap AS $map){
	$bLatLon = explode(",",$map->meta_value	);
	$bLat = $bLatLon[0];
	$bLon = $bLatLon[1];
	$dLon = $bLon - $cLon;
	$dLat = $bLat - $cLat; 
	$distance = distance($cLat, $cLon, $bLat, $bLon);
	if($distance<=5){ ////  ใกล้เคียง 5 กิโลเมตร
		$bistroArr[] = $map->post_id; // ได้ ID ของร้านที่อยู่ในละแวกใกล้เคียงแล้ว
	}
}

// เอา ID ของร้านใกล้เคียงมา หา ร้านตามช่วงเวลา
for($i=0;$i<count($bistroArr);$i++){
//เอา ID ร้านทั้งหมดในละแวกใกล้เคียง มา filter เพื่อ หา ID ร้าน ตามช่วงเวลา
	if ( $time  >= "05:00:00" &&  $time  < "10:59:59" ){ 
		$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$bistroArr[$i]."' AND meta_key='check_meal' AND meta_value LIKE '%breakfast%'";
	}elseif ($time  >= "11:00:00" &&  $time  < "14:59:59" ){
		$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$bistroArr[$i]."' AND meta_key='check_meal' AND meta_value LIKE '%lunch%'";
	}elseif ($time  >= "15:00:00" &&  $time  < "18:59:59" ){
		$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$bistroArr[$i]."' AND meta_key='check_meal' AND meta_value LIKE '%dinner%'";
	}elseif ($time  >= "19:00:00" &&  $time  < "21:59:59"){
		$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$bistroArr[$i]."' AND meta_key='check_meal' AND meta_value LIKE '%supper%'";
	}elseif ($time  >= "22:00:00" &&  $time  < "04:59:59"){
		$sqlBistroByMeal = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$bistroArr[$i]."' AND meta_key='check_meal' AND meta_value LIKE '%night%'";
	}
		
	$querysByMeal = $wpdb->get_results($sqlBistroByMeal);
	$numMeal = $wpdb->num_rows;
	
	if($numMeal>0){
		// ทีนี้จะได้ ID ของร้านตามช่วงเวลา และก็ตามสถานที่ออกมาแล้ว เก็บเป็น array $bistroIdByMeal[]
		$bistroIdByMeal[] = $bistroArr[$i];
	}
}

//  นับ ก่อน ว่า มี กี่ตัว ที่เข้าข่าย ตามช่วงเวลาและละแวกใกล้เคียง
$numOfBistro = count($bistroIdByMeal);
$randKey = rand(0,$numOfBistro-1); //random key ของ array เพื่อเอาไป select ข้อมูลขึ้นมา
$sqlSelectBistro = "SELECT * FROM wp_posts WHERE ID ='".$bistroIdByMeal[$randKey]."'";
$bistros = $wpdb->get_results($sqlSelectBistro);


						



foreach($bistros AS $bistro){
	$featureImg = wp_get_attachment_image_src(get_post_thumbnail_id($bistro->ID),array(330,345)); // returns an array
	$bDetail .= '<figcaption style="z-index:2">
		<h3 class="entry-title">
			<a href="'.get_permalink($bistro->ID).'" style="color:#ffffff; text-decoration: none;">'.$bistro->post_title.'</a>
		</h3>
		<span class="entry-owner">โดย  '.get_the_author_meta("display_name", $bistro->post_author).'</span>
    </figcaption>
	<div style="width:330px;height:345px;overflow:hidden;left:-20px;">';
	
	if($featureImg[0]!=""){$bDetail .= imagesize($featureImg[0],330,345);}
 	else{$bDetail .= '<img src="wp-content/themes/bp-default/_inc/images/290x180.jpg" height="345">';}	
	$bDetail .= '</div>'
	;
 } 
 ?>
	
<?php 						//$location = "[";
							for($i=0;$i<count($bistroArr);$i++){
								$sqlNearbyCurrent = "SELECT * FROM wp_postmeta WHERE post_id='$bistroArr[$i]' AND meta_key='bistro_map'";
								$nearbys = $wpdb->get_results($sqlNearbyCurrent);
								
								foreach($nearbys AS $nearby){
									$bLatLon = explode(",",$nearby->meta_value);
									$nearbyId = get_permalink($nearby->post_id);
									$bUrl .= "{'bUrl':'".$nearbyId."'}";
									if($i<count($bistroArr)-1){$bUrl .= ",";}
									$bistroTitle = get_the_title($nearby->post_id);
									//$location .= "['<div align=\"center\" style=\"font-size:12px;font-family:tahoma\">".$bistroTitle."</div>', ".$bLatLon[0].", ".$bLatLon[1]."]";
									$location .= "{'name':'<div align=\"center\" style=\"font-size:12px;font-family:tahoma\">$bistroTitle</div>','blat':$bLatLon[0],'blon':$bLatLon[1]}";
									if($i<count($bistroArr)-1){$location .= ",";}
									if($bistros[0]->ID==$bistroArr[$i]){
										//$bistroidShowed = $bistroArr[$i];
										$icons = "{'icon':'wp-content/themes/bp-default/_inc/images/pinRed.png'}";
										$nearbyLat = $bLatLon[0];
										$nearbyLon = $bLatLon[1];
										$view = do_shortcode( '[hit_count post='.$bistroArr[$i].']' );
										$sql_countReview = "SELECT * FROM wp_postmeta WHERE meta_key='review_bistroid' AND meta_value='".$bistroArr[$i]."'";
										$query_countReview = $wpdb->get_results($sql_countReview);
										$numReview = $wpdb->num_rows;
										$createTime = get_time_ago($bistroArr[$i]);
										
									}else{
										$icons = "{'icon':'wp-content/themes/bp-default/_inc/images/pinBlue.png'}";
									}
									$iconPin .= $icons;
									if($i<count($bistroArr)-1){$iconPin .= ",";}
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
		"countBistro" => count($bistroArr),
		"view"=>$view,
		"numReview"=>$numReview,
		"bUrl"=>$bUrl,
		"createTime"=>$createTime
	));
	

	?>
	
	
	