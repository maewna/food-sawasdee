<?php
include_once("../../../wp-config.php");
$bistroId = $_REQUEST['bistroId'];
$row = explode("-",$bistroId);
$postId = $_REQUEST['postId'];
if( have_rows('special_brelBranch',$postId)):
$bType = get_field('spacial_bType');
endif;
if( have_rows('special_brelBranch',$postId)):
	$count = 0;
	while(has_sub_field('special_brelBranch',$postId)):
		if($row[0]==$count):
			$link = get_sub_field('special_bbranchId');
			$permalink = get_permalink($link[0]);
			$uri = get_template_directory_uri();
			$special_baddress = get_sub_field('special_bbranchAdd');
			$special_btime = get_sub_field('special_bbranchTime');
			$special_btel = get_sub_field('special_bbranchTel');
			$bistroPlan = get_sub_field('special_bbranchTset');
			$bistroEmail = get_sub_field('special_bbranchEmail');
			$location = get_sub_field('special_bbranchMap');
			$map = "<div class='acf-map'>
						<div class='marker' data-lat='".$location['lat']."' data-lng='".$location['lng']."'></div>
					</div>";
           	$address = '<div class="add-left"><img src="'.$uri.'/_inc/images/iconAdd.png" border="0"> ที่อยู่ : </div><div class="add-right">'.$special_baddress.'</div><br/>
            			<div class="add-left"><img src="'.$uri.'/_inc/images/iconTime.png" border="0"> เวลาเปิด-ปิด : </div><div class="add-right">'.$special_btime.'</div><br/>
           				<div class="add-left"><img src="'.$uri.'/_inc/images/iconTel.png" border="0"> เบอร์โทรศัพท์ : </div><div class="add-right">'.$special_btel.'</div><br/>';
            
            if( ! empty( $bistroPlan ) && ! empty( $bistroEmail ) ) {
             	$address .= '<div class="reserve">
							<input type="image" name="imageField" id="reserveBtn" 
							 src="'.get_template_directory_uri().'/_inc/images/reserveBtn.png" 
							 onCLick="formReserve(\'ร้านหลายสาขา\',\''.$link[0].'\',\''.$bistroEmail.'\',\''.get_the_title($link[0]).'\',\''.$bistroPlan.'\')"/><div>';
			}
			/*zone detail branch*/
			$branchDetail = '<div class="detailBistro" >
								<div class="iconBistro"><img src="'.get_template_directory_uri().'/_inc/images/iconBistro.png" border="0"></div>
									<div class="textBistro">&nbsp;รายละเอียดร้าน</div>
										<div class="bistro">
											<div class="bistro-left">
                                       			<div class="bistroName"><a href="'.get_permalink($link[0]).'">'.get_the_title($link[0]).'</a></div>';
            
			$sql = "SELECT * FROM wp_postmeta WHERE meta_key='review_bistroid' AND meta_value='".$link[0]."'"; 
														
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
			
                               $branchDetail .= '<div class="stars">
													<div class="rating" style="width:'.$pointCal.'%"></div>
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
														</div>
                                        			</div>
                                        			<div class="bistro-right">';
                            				
       
			$sqlImgBistro = "SELECT * FROM wp_postmeta WHERE meta_key='bistro_img' AND post_id='".$link[0]."' LIMIT 1"; 
			$resultImg = $wpdb->get_results($sqlImgBistro);
			foreach ($resultImg as $attachment){
				$image_attributes = wp_get_attachment_image_src($attachment->meta_value,'thumb'); 
			 
                               			$branchDetail .= '<div style="position:relative;margin-bottom:10px;">'.imagesize($image_attributes[0],100,100).'</div>';
			} //end foreach
                                             
                                        $branchDetail .= '</div>
                                  			</div>
                             			</div>';
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
				$resultReviews = $wpdb->get_results($sqlReview);
				$rowCount = $wpdb->num_rows;
				if($rowCount>0){
                              			$branchDetail .= '<div class="latestReview">
															<div class="iconReview"><img src="'.get_template_directory_uri().'/_inc/images/iconReview.png" border="0"></div>
																<div class="textReview">&nbsp;รีวิวล่าสุด</div>
                                    							<div style="height:20px"></div>';
                foreach($resultReviews as $reviewer){ 
					list($rank,$rankImg) = lvMember($reviewer->post_author);
					$point = $reviewer->rating*20;
                                        		$branchDetail .= '<div class="review">
                                            						<div class="reviewerImg" >'.get_avatar($reviewer->post_author , 50 ).'</div>
                                            							<div class="reviewerName" >
                                            								<img src="'.$rankImg.'" border="0" width="30" height="32" style="vertical-align:middle;"/>'.xprofile_get_field_data( 1, $reviewer->post_author).'</div>
                                            									<div class="reviewerRate">
																				<div class="stars">
																					<div class="rating" style="width:'.$point.'%"></div>
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
																				</div>
                                            
                                            </div>
                                            <div style="clear:both"></div>
                                            <div class="reviewContent">"'.$reviewer->post_title.'"<br/></div>
                                        
                                        </div>';
				}
                                    $branchDetail .= '<div class="allReview"><a href="'.get_permalink($link[0]).'"><img src="'.get_template_directory_uri().'/_inc/images/allReview.png" border="0"></a></div>
                               	</div>';
                            	} //end if rowCount>0
			
		/*zone detail branch*/	
			
		endif;
		$count++;
	endwhile;
endif;


$json_arr = array( "branchDetail" => $branchDetail,"map" => $map, "address" => $address);
echo json_encode( $json_arr );

?>
