<?php
include_once("../../../wp-config.php");
$meal = $_REQUEST['meal'];
$national  = $_REQUEST['national'];
$foodtype = $_REQUEST['foodtype'];
$bistrotype = $_REQUEST['bistrotype'];
$service = $_REQUEST['service'];
$price = $_REQUEST['price'];
$numMeal = count($meal);
$numNational = count($national);
$numFoodtype = count($foodtype);
$numBistrotype = count($bistrotype);
$numService = count($service);
$numPrice = count($price);



$sql = "SELECT DISTINCT(post_id) FROM wp_postmeta INNER JOIN wp_posts ON post_id=id WHERE post_type='recipes' AND post_status='publish'";

	$roundMeal=1;
	if($numMeal>0){
		foreach($meal AS $meal){
			if($roundMeal!=1){
				$sql .= " OR ";
			}else{
				$sql .= " AND (";
			}
			if($meal=='all'){
				$sql .= "meta_value LIKE '%breakfast%' AND meta_value LIKE '%lunch%' AND meta_value LIKE '%dinner%' AND meta_value LIKE '%supper%'";
			}else{
				$sql .= "meta_value LIKE '%".$meal."%'";
			}
			if($numMeal==$roundMeal){
				$sql .= ")";
			}
			$roundMeal++;
		}
	}
	$roundNational=1;
	if($numNational>0){
		foreach($national AS $national){
			if($roundNational!=1){
				$sql .= " OR ";
			}else{
				$sql .= " AND (";
			}
			$sql .= "meta_value LIKE '%".$national."%'";
			
			if($numNational==$roundNational){
				$sql .= ")";
			}
			$roundNational++;
		}
	}
	$roundFoodtype=1;
	if($numFoodtype>0){
		foreach($foodtype AS $foodtype){
			if($roundFoodtype!=1){
				$sql .= " OR ";
			}else{
				$sql .= " AND (";
			}
			$sql .= "meta_value LIKE '%".$foodtype."%'";
			if($numFoodtype==$roundFoodtype){
				$sql .= ")";
			}
			$roundFoodtype++;
		}
	}

global $wpdb;
$results = $wpdb->get_results($sql);
$numRow = $wpdb->num_rows;
$liArr = array();
if($numRow<=0){
	//no result
	$liArr[] = '<div class="img_not_fond">
					<a href="../add-recipe/"><img src="'.get_template_directory_uri().'/_inc/images/add-recipe-search.png" class="add-recipes"></a>
					<a href="../create-bistro/"><img src="'.get_template_directory_uri().'/_inc/images/add-bistro-search.png" class="add-bistro"></a>
				</div>
				<style>
					#grid{height:100% !important;}
				</style>';
}else{
	foreach($results AS $result){
		$li = '<li class="box_red_one" style="margin-right:3px;z-index:20">
					<div class="box_title">
						<span class="box_red_one_text">'.substr_utf8( get_the_title($result->post_id), 0 , 28).'</span>';
		$li .= '<div style="width:291px; height:180px; overflow:hidden;margin-left:-8px">';
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $result->post_id ), array(290,185) );
					if($image!=""){
						$li .= imagesize($image[0],290,185);
					}
					 else{
                     	$li .= "<img src='".get_template_directory_uri()."/_inc/images/290x180.jpg'>";
					}
		// $li .= '<img src="'.$image[0].'" width="290" />
		$li .=	'</div>';
		$li .= '<div class="icon_red_search_content" style="width:90%">
					<img src="'.get_template_directory_uri().'/_inc/images/recipes/icon-ingre.png" style="float:left;">
					<div class="detail-data" style="font-size:13px;width: 90% ;margin-left: 5px;text-indent:0px;line-height: 20px;height: 20px !important;overflow:hidden">วัตถุดิบหลัก ';
		$li .= get_post_meta($result->post_id, 'main-ingredient', true );
		
		$li .= '</div>               
					<div class="cleaner_h5"></div>
						<img src="'.get_template_directory_uri().'/_inc/images/typefood_icon_search.png" style="float:left;">
						<div class="detail-data" style="font-size:13px">ประเภท ';
						//$li .= substr_utf8 (get_field("bistro_type",$result->post_id),0,28)." ";
						$values = get_post_meta($result->post_id, 'recipe_type', true );
								  //echo $values;
								   $types = array('alacarte', 'maincourse', 'toorder', 'snacks', 'fusion', 'vegetarian', 'jfood', 'southfood', 'northfood', 'northeastfood', 'seafood', 'somtum', 'dishes', 'dessert', 'babyfood', 'shabu/suki', 'grill/barbecue', 'drinking');
								   $typesTH = array('อาหารจานเดียว', 'อาหารจานหลัก', 'อาหารตามสั่ง', 'อาหารว่าง', 'อาหารฟิวชั่น', 'อาหารมังสวิรัติ', 'อาหารเจ', 'อาหารปักษ์ใต้', 'อาหารเหนือ', 'อาหารอีสาน',
								 'อาหารซีฟู้ด', 'ส้มตำ น้ำตก', 'กับข้าว', 'ขนม/ของหวาน', 'สำหรับเด็ก', 'ชาบู/สุกี้', 'ปิ้งย่าง/บาร์บีคิว', 'เครื่องดื่ม');            
									if($values){
									 $c = 0;
									 foreach($types as $type){ 
									  if (in_array($type, $values)) { $li .= $typesTH[$c].' ';}
									  $c++;
									 } 
									}
						$li .= '</div>
					</div>
					<div class="cleaner"></div>
					<div class="bg_readmore_search" style="margin-top:16px !important;">
						<span class="text_readmore">
							<a href="';
							$li .= get_permalink($result->post_id);
							$li .= '">อ่านต่อ
								<img src="'.get_template_directory_uri().'/_inc/images/readmore_search_icon.png" class="bt_readmore"  /></a>
						</span>
					 </div>';
		$li .= '</li>';
		$liArr[] = $li;
	}// end foreach
}//end else
echo json_encode($liArr);
flush();
?>
