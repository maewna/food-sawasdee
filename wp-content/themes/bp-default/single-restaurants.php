<?php get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/colorbox.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.colorbox.js"></script>

<script type="text/javascript" src="<?php echo includes_url();?>js/bistroSlider/jssor.js"></script>
<script type="text/javascript" src="<?php echo includes_url();?>js/bistroSlider/jssor.slider.js"></script>
<script type="text/javascript" src="<?php echo includes_url();?>js/bistroSlider/sliderStyle.js"></script>
<link rel="stylesheet" href="<?php echo includes_url();?>css/sliderCss.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/bistroDetail.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />

<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/lightbox.js"></script>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/lightbox.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/promotion.css">


<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".iframe").colorbox({iframe:true, width:"753px", height:"520px", overflow: "hidden"});
	});
</script>
<script>
	function formReport(reviewId,reporter,mail){
		
	$.colorbox({
			
				fastIframe:true,
				innerWidth:'550',
				innerHeight:'355',
				href:"<?php echo get_template_directory_uri(); ?>/formReport.php?bistroName=<?php echo get_the_title($bistroId);?>&reporter="+reporter+"&reviewId="+reviewId+"&email="+mail+"&pmlink=<?php echo get_permalink($bistroId);?>",
				onComplete:function(){ 
					$('#cboxLoadingGraphic').attr("style", "display: none !important");
					$('#cboxLoadingOverlay').attr("style", "display: none !important");
				}
	})
	
	}
	function formDupBistro(reporter,mail){
	$.colorbox({
				/*fastIframe:true,*/
				innerWidth:'550',
				innerHeight:'355',
				href:"<?php echo get_template_directory_uri(); ?>/formDupBistro.php?bistroName=<?php echo get_the_title($bistroId);?>&reporter="+reporter+"&email="+mail+"&pmlink=<?php echo get_permalink($bistroId);?>",
				onComplete:function(){ 
					$('#cboxLoadingGraphic').attr("style", "display: none !important");
					$('#cboxLoadingOverlay').attr("style", "display: none !important");
					
				}
	})
	}
	function formEditBistro(reporter,mail){
	$.colorbox({
				fastIframe:true,
				innerWidth:'550',
				innerHeight:'355',
				href:"<?php echo get_template_directory_uri(); ?>/formEditBistro.php?bistroName=<?php echo get_the_title($bistroId);?>&reporter="+reporter+"&email="+mail+"&pmlink=<?php echo get_permalink($bistroId);?>",
				onComplete:function(){ 
					$('#cboxLoadingGraphic').attr("style", "display: none !important");
					$('#cboxLoadingOverlay').attr("style", "display: none !important");
				}
	})
	}
	function showHideStat(){
		 var div = document.getElementById('stat');
		if (div.style.display !== 'none') {
			div.style.display = 'none';
		}else {
			div.style.display = 'block';
		}
	}
	function fav(post_id){
		$.ajax({
			type: "POST",
			data:{ post_id: post_id},
			url: '<?php echo get_template_directory_uri(); ?>/fav_save.php',
			success: function(data){
			   if(data=='1'){
					document.getElementById("favImg").src = "<?php echo get_template_directory_uri(); ?>/_inc/images/bookmarkBtn2.png";
			   }else{
					document.getElementById("favImg").src = "<?php echo get_template_directory_uri(); ?>/_inc/images/bookmarkBtn.png";
			   }
			}
		});
	}
</script>

<script>
	$( document ).ready(function() { 
		$("#review").show();
		$("#tabImg").hide();
		$("#tabCoupon").hide();
	});
		function tab(tabno){
			if(tabno==1){
				$("#review").show();
				$("#tabImg").hide();
				$("#tabCoupon").hide();
			}else if(tabno==2){
				$("#review").hide();
				$("#tabImg").show();
				$("#tabCoupon").hide();
			}else if(tabno==3){
				$("#review").hide();
				$("#tabImg").hide();
				$("#tabCoupon").show();
			}
		}
    </script>
<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>

						
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
			<div id="content" style="background-color:white">

					<div class="singlenavigation">
							<?php while ( have_posts() ) : the_post(); ?>
							<a href=" <?php echo site_url(); ?> ">หน้าหลัก</a>  >  <a href="<?php echo home_url(); ?>/bistro/">อร่อยนอกบ้าน</a> > <a href="<?php echo home_url(); ?>/allbistro/">ร้านอาหารทั้งหมด</a> > <a href="<?php the_permalink(); ?>"><b>ร้าน <?php the_title(); ?></b></a>
							<?php endwhile;?>
						</div>
						
		<div class="bistroPage">
			<div class="bistroContent">

						
				<div class="bistroTitle">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<span class="spanQuote"><img style='vertical-align:top' src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/quoteBistro.png" border="0" /></span>
					
					<span class="spanBistroTitle">ร้าน <?php the_title(); ?> <?php if(get_field('bistro_branch' )){echo "สาขา".get_field('bistro_branch');} ?></span>
					
						
				</div>
				<div class="bistroDetail">
                	<?php
                	$bistroType = get_post_meta( get_the_ID(), 'bistroType', true );
				//print_r($bistroType);
					?>
                    <?php if($bistroType!=""){ ?>
               			
                    	<?php
						 //echo get_the_id();
						 $bistroType = get_post_meta( get_the_ID(), 'bistroType', true );
						?>
                         <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconBistroType.png" border="0" />
                         <?php echo  convertBistroType($bistroType); ?>
                    <?php } //endif icon bistrotype ?>
                    
                    <?php
                     //echo get_the_id();
					 $values = get_post_meta( get_the_ID(), 'recipe_type', true );
					 if($values!=""){
					?>
                        <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconFoodType.png" border="0" style="padding-left:15px;"/>
                     	<?php echo convertFoodType($values);?>
                   <?php } ?> 
                    
                   	<?php 
					$btime = get_post_meta( get_the_ID(), 'bistro_time', true );
					?>
                    <?php if($btime){?>
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconTime.png" border="0" style="padding-left:15px;"/><?php echo " ".$btime;?>
                    <?php } //endif btime ?>
                    <?php 
					
					$bdist = get_field('bistro_district' );
									$sql_district  =$wpdb->get_results("SELECT * FROM wp_district WHERE DISTRICT_ID='$bdist'");
									foreach($sql_district AS $district){
										$bdist_name = " เขต".$district->DISTRICT_NAME;
									}
					$bstreet = get_post_meta( get_the_ID(), 'bistro_street', true );
					?>
                    <?php if($bdist_name!="" || $bstreet!=""){ ?>
                    <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconLocation.png" border="0" style="padding-left:15px;"/>
                    <?php echo " ".$bstreet." ".$bdist_name;?>
                   	<?php } //endif blocation?>
                </div>
				<div class="bistroLeft">
					<div class="bistroSlide">
					
					<!-- Jssor Slider Begin -->
			<!-- You can move inline styles to css file or css block. -->
			<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 740px;
				height: 400px; background: #191919; overflow: hidden;">

				<!-- Loading Screen -->
				<div u="loading" style="position: absolute; top: 0px; left: 0px;">
					<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
						background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
					</div>
					<div style="position: absolute; display: block; background: url(<?php echo  includes_url();?>images/imgCssBistro/loading.gif) no-repeat center center;
						top: 0px; left: 0px;width: 100%;height:100%;">
					</div>
				</div>

				<!-- Slides Container -->
				<div u="slides" style="cursor: move; position: absolute; left: 100px; top: 0px; width: 640px; height: 400px; overflow: hidden;">
					<?php
					//select image จากตอนสร้างร้าน
					$sqlSelectImg = "SELECT * FROM wp_posts 
									INNER JOIN wp_postmeta ON post_id=ID 
									WHERE meta_key='bistro_img' 
									AND post_id='".get_the_ID()."'";
							echo "abcd".$sqlSelectImg;		
					$attachments = $wpdb->get_results($sqlSelectImg);
					$Img_num_imageBistro = $wpdb->num_rows;
					foreach ($attachments as $attachment)
					{
						$image_attributes = wp_get_attachment_image_src($attachment->meta_value,'bistroslide'); // returns an array
						//echo "iii".$image_attributes[0];
					?> 
                    
					<div>
						<img u="image" src="<?php echo $image_attributes[0]; ?>"  />
						<img u="thumb" src="<?php echo $image_attributes[0]; ?>" />
					</div>
					<?php 	
					}	
					?>
					<?php
						global $wpdb; 
						//select Image จากการเพิ่มรูปอย่างเดียว
						$sqlSelectImg1 = 	"SELECT * FROM wp_posts
											INNER JOIN wp_postmeta ON post_id=post_parent
											WHERE meta_key='Image_bistroId' 
											AND meta_value='".get_the_ID()."'";
											//echo $sqlSelectImg1;
						$attachments1 = $wpdb->get_results($sqlSelectImg1);
						$Img_num_rows1 = $wpdb->num_rows;
						foreach ($attachments1 as $attachment1)
						{
							$image_attributes1 = wp_get_attachment_image_src($attachment1->ID,'bistroslide'); // returns an array
							//echo $image_attributes1[0];
						?> 
							<div>
								<img u="image" src="<?php echo $image_attributes1[0]; ?>"  />
								<img u="thumb" src="<?php echo $image_attributes1[0]; ?>" />
							</div>
						<?php 
							
						}	

						
						// select Image จากการรีวิว	
						$bistroId = get_the_ID();
						$sqlSelectImg2  = "SELECT * FROM wp_postmeta WHERE meta_key='review_bistroid' AND meta_value='".get_the_ID()."'";
						//echo $sqlSelectImg2;
$attachments2 = $wpdb->get_results($sqlSelectImg2);
						$Img_num_rows2 = $wpdb->num_rows;
//echo $Img_num_rows2;
						//วน foreach  ออกมาได้ id ของ แต่ละ review	
						$Img_num_rows3 = 0;
						foreach ($attachments2 as $attachment2)
						{
							//echo $attachment2->post_id;
							$sqlSelectImg3 = "SELECT * FROM wp_posts 
											INNER JOIN wp_postmeta ON post_id=ID 
											WHERE post_parent='".$attachment2->post_id."' AND meta_key='_wp_attached_file'";	
							$attachments3 = $wpdb->get_results($sqlSelectImg3);
							$Img_num_rows3 += $wpdb->num_rows;
							foreach ($attachments3 as $attachment3)
							{
								$image_attributes3 = wp_get_attachment_image_src($attachment3->ID,'bistroslide'); // returns an array
								//echo $image_attributes3[0];
							?> 
								<div>
									<img u="image" src="<?php echo $image_attributes3[0]; ?>"/>
									<img u="thumb" src="<?php echo $image_attributes3[0]; ?>" />
								</div>
							<?php 
								
							}							
						}
						if($Img_num_imageBistro+$Img_num_rows1+$Img_num_rows2==0){
						?>
                        	<div>
								<img u="image" src="<?php echo get_template_directory_uri(); ?>/_inc/images/default.jpg"/>
								<img u="thumb" src="<?php echo get_template_directory_uri(); ?>/_inc/images/default.jpg" />
							</div>
                        <?php
						}
						
					?>
					
				</div>
				<!-- Arrow Navigator Skin Begin -->
				<!-- Arrow Left -->
				<span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 110px;">
				</span>
				<!-- Arrow Right -->
				<span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 8px">
				</span>
				<!-- Arrow Navigator Skin End -->
				
				<!-- Thumbnail Navigator Skin 02 Begin -->
				<div u="thumbnavigator" class="jssort02" style="position: absolute; width: 100px; height: 400px; left:0px; bottom: 0px;">
				
					<!-- Thumbnail Item Skin Begin -->
					<div u="slides" style="cursor: move;">
						<div u="prototype" class="p" style="position: absolute; width: 99px; height: 66px; top: 0; left: 0;">
							<div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
							<div class=c>
							</div>
						</div>
					</div>
					<!-- Thumbnail Item Skin End -->
				</div>
				<!-- Thumbnail Navigator Skin End -->
			   
			</div>
			<!-- Jssor Slider End -->
			
					</div>
					<div class="bistroButtonZone">

<?php if ( is_user_logged_in() ) { ?>
	<a href="/create-review?pid=<?php echo the_ID();?>" ><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/addReviewBtn.png" border="0"></a>
<?php } else { ?>
	<a href="wp-login.php" class="simplemodal-login"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/addReviewBtn.png" border="0"></a>
<?php } ?>
						


						<a href="/bistro-image?pid=<?php echo the_ID();?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/addPhotoBtn.png" border="0"></a>
						<?php if ( is_user_logged_in()==false) { ?>
							<a class="fancybox-login" href="<?php echo wp_login_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/bookmarkBtn.png" border="0"></a>
						<?php }else{?>
						<?php
						$user_ID = get_current_user_id();
						//echo $user_ID;
						$sqlGetFav = "SELECT * FROM wp_favourite WHERE post_id='".$bistroId."' AND fav_by='".$user_ID."'";
						//echo $sqlGetFav;
						$resFavs = $wpdb->get_results($sqlGetFav);
						$favNum = $wpdb->num_rows;
						//echo "abc".$favNum;
						?>
						<a onClick="fav(<?php echo $bistroId;?>)" style="cursor:pointer">
						<?php if($favNum<1){?>
						<img id="favImg" src="<?php echo get_template_directory_uri(); ?>/_inc/images/bookmarkBtn.png" border="0">
						<?php }else{ ?>
						<img id="favImg" src="<?php echo get_template_directory_uri(); ?>/_inc/images/bookmarkBtn2.png" border="0">
						<?php } ?>
						</a>
						<?php } ?>
						
					</div>
					<div class="bistroSocialZone">
						<span style="  margin-top: 53px;float: right;"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></span>
					</div>
					<div class="bistroSubDetail1">
						<div class="colLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconFlag.png" border="0" style='vertical-align:middle'><span class="blueText"> จุดสังเกตร้าน : </span></div><div class="colRight"><span class="defaultText" style="line-height:30px;"><?php the_field("bistro_path");?></span></div>
						<div class="colLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconAdd.png" border="0" style='vertical-align:middle'><span class="blueText"> ที่อยู่ : </span></div><div class="colRight"><span class="defaultText" style="line-height:30px;">
						 <?php if(get_field("bistro_addressno")!=""){$badd = get_field("bistro_addressno");}?>
                         <?php if(get_field("bistro_soi")!=""){$bsoi = " ซอย".get_field("bistro_soi");}?>
                         <?php if(get_field("bistro_street")!=""){$bstreet = " ถนน".get_field("bistro_street");}?>
                         <?php if(get_field('bistro_district' )!=""){
							 		$bdist = get_field('bistro_district' );
									$sql_district  =$wpdb->get_results("SELECT * FROM wp_district WHERE DISTRICT_ID='$bdist'");
									foreach($sql_district AS $district){
										$bdist_name = " เขต".$district->DISTRICT_NAME;
									}
						   		}
						 ?>
                         <?php if(get_field('bistro_subdistrict' )!=""){
							 		$bsdist = get_field('bistro_subdistrict' );
									$sql_subdistrict  =$wpdb->get_results("SELECT * FROM wp_subdistrict WHERE SUBDISTRICT_CODE='$bsdist'");
									foreach($sql_subdistrict AS $subdistrict){
										$bsdist_name = " แขวง".$subdistrict->SUBDISTRICT_NAME;
									}
								}
						 ?>
                         <?php if(get_field('bistro_province' )!=""){
							 $bprv = get_field('bistro_province' );
							 $sql_province  =$wpdb->get_results("SELECT * FROM wp_province WHERE PROVINCE_ID='$bprv'");
									foreach($sql_province AS $province){
										$bprv_name = " จังหวัด".$province->PROVINCE_NAME;
									}
							 }
						 ?>
                         <?php if(get_field('bistro_postcode' )!=""){
							 		$bpc = " ".get_field('bistro_postcode' );
						 		}
						 ?>
                         <?php //print_r($bprv);?>
                         <?php echo $badd.$bsoi.$bstreet.$bdist_name.$bsdist_name.$bprv_name.$bpc;?>
						</span></div>
						<?php
						$bprice = get_field("bistro_price");
						if($bprice=='rate1'){$price='น้อยกว่า 100 บาท';}
						else if($bprice=='rate2'){$price='101-300 บาท';}
						else if($bprice=='rate3'){$price='301-500 บาท';}
						else if($bprice=='rate4'){$price='501-1000 บาท';}
						else if($bprice=='rate5'){$price='มากกว่า 1000 บาท';}
						else{$price='-';}
						?>
						<div class="colLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconTel.png" border="0" style='vertical-align:middle'><span class="blueText"> เบอร์โทรศัพท์ : </span></div><div class="colRight"><span class="defaultText" style="line-height:30px;"><?php the_field("bistro_tel");?></span></div>
						<div class="colLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconWeb.png" border="0" style='vertical-align:middle'><span class="blueText"> เว็บไซต์ : </span></div><div class="colRight"><span class="defaultText" style="line-height:30px;"><?php the_field("bistro_website");?></span></div>
						<div class="colLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconPrice.png" border="0" style='vertical-align:middle'><span class="blueText"> ราคา : </span></div><div class="colRight"><span class="defaultText" style="line-height:30px;"><?php echo $price;?></span></div>
						<div class="colLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconMail.png" border="0" style='vertical-align:middle'><span class="blueText"> อีเมลล์ : </span></div><div class="colRight"><span class="defaultText" style="line-height:30px;"><?php the_field("bistro_email");?></span></div>
						
					</div>
					<div class="bistroSubDetail2">
						<div class="subdetail2">
							<div class="colLeft2"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconCredit.png" border="0" style='vertical-align:middle'><span class="blueText"> รับบัตรเครดิต : </span></div>
							<div class="colRight2"><span class="defaultText">
								<?php 
									if(get_field("bistro_credit")=='have_credit'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconYes.png" border="0"> <?php }
									else if(get_field("bistro_credit")=='haveno_credit'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconNo.png" border="0"> <?php }
									else{echo "-";}
								?>
								</span></div>
						</div>
						<div class="subdetail2">
							<div class="colLeft2"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconPark.png" border="0" style='vertical-align:middle'><span class="blueText"> ที่จอดรถ : </span></div>
							<div class="colRight2"><span class="defaultText">
								<?php 
									if(get_field("bistro_parking")=='have_parking'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconYes.png" border="0"> <?php }
									else if(get_field("bistro_parking")=='haveno_parking'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconNo.png" border="0"> <?php }
									else{echo "-";}
								?>
								</span></div>
						</div>
						<div class="subdetail2">
							<div class="colLeft2"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconWifi.png" border="0" style='vertical-align:middle'><span class="blueText"> อินเตอร์เน็ท : </span></div>
							<div class="colRight2"><span class="defaultText">
								<?php 
									if(get_field("bistro_internet")=='have_internet'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconYes.png" border="0"> <?php }
									else if(get_field("bistro_internet")=='haveno_internet'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconNo.png" border="0"> <?php }
									else{echo "-";}
								?>
								</span></div>
						</div>
						<div class="subdetail2">
							<div class="colLeft2"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconAlcohol.png" border="0" style='vertical-align:middle'><span class="blueText"> เครื่องดื่มแอลกฮอลล์ : </span></div>
							<div class="colRight2"><span class="defaultText">
								<?php 
									if(get_field("bistro_alcohol")=='have_alcohol'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconYes.png" border="0"> <?php }
									else if(get_field("bistro_alcohol")=='haveno_alcohol'){?><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconNo.png" border="0"> <?php }
									else{echo "-";}
								?>
								</span></div>
						</div>
					</div>
					<div style="clear:both"></div>
					<?php if ( is_user_logged_in() ) {
									?>
				<div class="editZone">
					<?php $current_user = wp_get_current_user();
                                $current_username = $current_user->user_login;
                                $current_usermail = $current_user->user_email;
                                $current_fullname = $current_user->user_firstname ." ". $current_user->user_lastname;
                        ?>
						<div class="editBistro">
						<?php
							if ( wpuf_get_option( 'enable_post_edit', 'wpuf_dashboard', 'yes' ) == 'yes' ) {
								$disable_pending_edit = wpuf_get_option( 'disable_pending_edit', 'wpuf_dashboard', 'on' );
								$edit_page = (int) wpuf_get_option( 'edit_page_id', 'wpuf_general' );
								$url = add_query_arg( array('pid' => $post->ID), get_permalink( $edit_page ) );

								if ( $post->post_status == 'pending' && $disable_pending_edit == 'on' ) {
													// don't show the edit link
								} else {
								?>
                                <?php  //echo is_admin();?>
                                	<?php  if(current_user_can( 'update_core' )){ 
										//echo "<script>alert('admin');</script>";
									?>
										<a href="<?php echo wp_nonce_url( $url, 'wpuf_edit' ); ?>"   style="cursor:pointer" title="แก้ไข">แก้ไขร้าน</a>
									<?php }else{ 
										//echo "<script>alert('not admin');</script>";
									?>
										<a  onClick="formEditBistro('<?php echo $current_username;?>','<?php echo $current_usermail;?>')"  style="cursor:pointer"  title="แก้ไข">แก้ไขร้าน</a>
                                	<?php } ?>
								<?php
								}
							} ?>
						</div>
					<?php $url = add_query_arg( array('pid' => $post->ID), get_permalink( $edit_page ) ); ?>
					<div class="editBistro"><a  onClick="formDupBistro('<?php echo $current_username;?>','<?php echo $current_usermail;?>')"  style="cursor:pointer">แจ้งเปิดร้านซ้ำ/ปิดกิจการ</a></div>
				</div>
				<?php } ?>
				</div>
				<div class="bistroRight">
					<div class="bistroRating">
						<?php 
							$sqlRating = "SELECT v3.meta_value AS rating
										FROM wp_postmeta v1
										INNER JOIN wp_posts v2
										ON v1.post_id =v2.ID
										LEFT  JOIN wp_postmeta v3
										ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
										WHERE v1.meta_value='".get_the_ID()."'  
										AND v1.meta_key='review_bistroid'";
										
										//echo $sqlRating;
							$resultRating = $wpdb->get_results($sqlRating);
							$Img_num_rows = $wpdb->num_rows;
							foreach ($resultRating as $keyRating){
								$point += $keyRating->rating;
							} 
							if($Img_num_rows!=0){
								$percentRating = $point*(100/(5*$Img_num_rows));
							}else{
								$percentRating = 0;
							}
							?>
								<div class="stars">
									<div class="rating" style="width:<?php echo $percentRating;?>%"></div>
									<input type="radio" name="rating2" id="star5" value="5">
									<label for="star5"></label>
									<input type="radio" name="rating2" id="star4" value="4">
									<label for="star4"></label>
									<input type="radio" name="rating2" id="star3" value="3">
									<label for="star3"></label>
									<input type="radio" name="rating2" id="star2" value="2">
									<label for="star2"></label>
									<input type="radio" name="rating2" id="star1" value="1">
									<label for="star1"></label>
								</div>	
							
							<style>
                            /* The necessities */
.onclick-menu {
	position: relative;
	display: inline-block;
}
.onclick-menu:before {
	content: "ดูสถิติรวม";
}
.onclick-menu:focus {
	pointer-events: none;
}

.onclick-menu:focus .onclick-menu-content {
	opacity: 1;
	visibility: visible;
}

.onclick-menu-content {
	pointer-events: auto;
	position: absolute;
	z-index: 1;
	opacity: 0;
	visibility: hidden;
	transition: visibility 0.5s;
	-moz-transition: visibility 0.5s;
	-webkit-transition: visibility 0.5s;
	-o-transition: visibility 0.5s;
}

.onclick-menu.no-pointer-events {
	pointer-events: auto !important;
}

.onclick-menu.no-visibility .onclick-menu-content {
	visibility: visible !important;
	display: none;
}

.onclick-menu.no-visibility:focus .onclick-menu-content {
	display: block;
}

.onclick-menu.no-opacity .onclick-menu-content {
	opacity: 1 !important;
}

.onclick-menu {
	padding: 0;
	margin: 0 0 1em 0;
	outline: 0;
}
.onclick-menu:before {
	padding: 5px 10px;
	background-color: transparent;
}
.onclick-menu-content {
	background-color: transparent;
	width: auto;

	margin-top: 19px;
	margin-left: 0;
	/*padding: 10px;*/
}

/* arrow for the expanding part */

.onclick-menu-content li {
	color: #f2f5e9;
	list-style-type: none;
	white-space: nowrap;
}

/* style the buttons */
.onclick-menu-content button {
	background: transparent;
	border: none;
	color: inherit;
	cursor: inherit;
	outline: 0;
	cursor: pointer;
}
.onclick-menu-content button:hover {
	color: #ff8c31;
}
.top{
    position : absolute;
    left     : 18px;
    width    : 0;
    height   : 0;
    z-index  : 1;
    top:-8px;
    border-left   : 12px solid transparent;
    border-right  : 12px solid transparent;
    border-bottom : 12px solid white;
}

.bottom{
    position : absolute;
    width    : 0;
	height:0;
    z-index  : 0;
	left:5px;
    top:-10px;
    border-left   : 25px solid transparent;
    border-right  : 25px solid transparent;
    border-bottom : 25px solid #47cfdd;
}
#stat{
	width:272px;
	height:145px;
	border:1px solid #47cfdd;
	float:left;margin:0 auto;
	position:absolute;
	background-color:white;
	/*margin-top:-110px;
	margin-left:20px;*/
}
                          </style>
							<div tabindex="0" class="onclick-menu" id="div-menu">
                                <ul class="onclick-menu-content" >
                                    <li > 
                                    	<div class="top"></div>
                                		<div class="bottom"></div>
                                    	<div id="stat" >
                                        	
                                          <!--<div class="closeStat"><a  id="close" onClick="showHideStat()" style='cursor:pointer'><img src="<?php //echo get_template_directory_uri(); ?>/_inc/images/closeStat.png" width="30" height="30" border="0"/></a></div>-->
                                            <div class="textStat">สถิติรวมจากนักรีวิว</div>
                                            <div class="statLeft"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/starStat.jpg" width="70" height="74" /></div>
                                            
                                            <div class="statRight">
                                                <?php
                                                $sqlPoint = "SELECT v3.meta_value AS rating
                                                            FROM wp_postmeta v1
                                                            INNER JOIN wp_posts v2
                                                            ON v1.post_id =v2.ID
                                                            LEFT  JOIN wp_postmeta v3
                                                            ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
                                                            WHERE v1.meta_value='".get_the_ID()."'  
                                                            AND v1.meta_key='review_bistroid'";
                                                $resultPoint = $wpdb->get_results($sqlPoint);
                                                $point1 = $point2 = $point3 = $point4 = $point5 = 0;
                                                $numrows = $wpdb->num_rows;
                                                foreach($resultPoint as $point){
                                                    if($point->rating=='1'){$point1++;}
                                                    else if($point->rating=='2'){$point2++;}
                                                    else if($point->rating=='3'){$point3++;}
                                                    else if($point->rating=='4'){$point4++;}
                                                    else if($point->rating=='5'){$point5++;}
                                                }
                                                if($point1!=0){$percent1 = $point1*100/$numrows;}else{$percent1=0;}
                                                if($point2!=0){$percent2 = $point2*100/$numrows;}else{$percent2=0;}
                                                if($point3!=0){$percent3 = $point3*100/$numrows;}else{$percent3=0;}
                                                if($point4!=0){$percent4 = $point4*100/$numrows;}else{$percent4=0;}
                                                if($point5!=0){$percent5 = $point5*100/$numrows;}else{$percent5=0;}
                                                ?>
                                                        <div class="progressbar"><div style="width:<?php echo $percent5?>%"></div></div>	
                                                        <div class="progressbar"><div style="width:<?php echo $percent4;?>%"></div></div>	
                                                        <div class="progressbar"><div style="width:<?php echo $percent3;?>%"></div></div>	
                                                        <div class="progressbar"><div style="width:<?php echo $percent2;?>%"></div></div>	
                                                        <div class="progressbar"><div style="width:<?php echo $percent1;?>%"></div></div>	
                                                    
                                            </div>
                                        </div>
                                    
                                    </li>
                                </ul>
                                
                            </div>
                            
					</div>
					<?php
					$meals  = get_field(check_meal);
					if($meals!=''){
						foreach($meals AS $meal){
							if($meal=='breakfast'){$bf=$meal;}
							if($meal=='lunch'){$lch=$meal;}
							if($meal=='dinner'){$dnn=$meal;}
							if($meal=='supper'){$night=$meal;}
						}
					}
					?>
					<div class="bistroMeal">
						<div class="bf"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconBkf<?php if($bf=='breakfast'){?>Click<?php }?>.png" width="54" height="40" /></div>
						<div class="lch"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconlunch<?php if($lch=='lunch'){?>Click<?php }?>.png" width="50" height="50" /></div>
						<div style='clear:both'></div>
						<div class="separator">เหมาะกับมื้อ</div>
						<div style='clear:both'></div>
						<div class="dnn"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconDinner<?php if($dnn == 'dinner'){?>Click<?php }?>.png" width="61" height="40" /></div>
						<div class="night"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/iconNight<?php if($night == 'supper'){?>Click<?php }?>.png" width="57" height="45" /></div>
					</div>
					<div class="bistroMap">
						<div class="iconMap">แผนที่</div>
						<div><?php echo do_shortcode('[wpuf-meta name="bistro_map" type="map" height="340" width="275" zoom="18"]');?></div>
					</div>
					<?php $bistro_hilight = get_field("bistro_hilight"); ?>
					<?php if($bistro_hilight!=""){?>
					<div class="hilight">
						<div class="hilightTitle"></div>
						<div class="hilightBg" >
						<?php $menu = explode("|",$bistro_hilight);
							foreach($menu as $i =>$key) {
								$i >0;
								echo $key .'</br>';
							}
						?>
						<?php
							/*$sqlHilight = "SELECT DISTINCT(p2.meta_value) FROM wp_postmeta p1 
											INNER JOIN wp_postmeta p2
											ON p1.meta_value=p2.post_id
											WHERE p1.meta_key='review_bistroid' 
											AND p1.meta_value='".get_the_ID()."'
											AND  p2.meta_key='bistro_hilight'";
							$querys = $wpdb->get_results($sqlHilight);
							foreach($querys AS $hilight){
								echo $hilight->meta_value."<br/>";
							}*/
							
						?>
						</div>
					</div>
					<?php } ?>
					<?php
							function distance($lat1, $lon1, $lat2, $lon2) {
								$theta = $lon1 - $lon2;
								$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
								$dist = acos($dist);
								$dist = rad2deg($dist);
								$miles = $dist * 60 * 1.1515;
								return ($miles * 1.609344);
							}
							$latlon = get_field('bistro_map');
							$clatlon = explode(",",$latlon);
							$cLat = $clatlon[0];
							$cLon = $clatlon[1];
						
							$sql_allMap = "SELECT * FROM wp_postmeta INNER JOIN wp_posts ON ID=post_id WHERE meta_key='bistro_map' AND post_id!='".get_the_ID()."' AND post_status='publish'";
							//echo $sql_allMap;
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
							if(count($bistroArr)>0){
							?>
							<div class="bOther">
							<div class="iconOther"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconOtherV.png" width="45" height="47" style="display:inline-block;vertical-align:middle;padding-right:10px;"/>ร้านใกล้เคียง</div>
						
							<?php
								for($i=0;$i<3;$i++){
									$sql_nearby = "SELECT * FROM wp_posts WHERE ID='".$bistroArr[$i]."'";
									//echo $sql_nearby;
									$nearbys = $wpdb->get_results($sql_nearby);
									$bistrologo = get_post_meta( $bistroArr[$i], 'bistro_logo' ,true); 
									if($i<count($bistroArr)){
								?>
									<div class="imgNb"><?php echo wp_get_attachment_image( $bistrologo, array(80,80));?></div>
									<div class="detailNb"><a href="<?php echo get_permalink($bistroArr[$i]); ?>"><?php echo $nearbys[0]->post_title;?></a>
								
									<?php
										$sqlRatingNb = "SELECT v3.meta_value AS rating
														FROM wp_postmeta v1
														INNER JOIN wp_posts v2
														ON v1.post_id =v2.ID
														LEFT  JOIN wp_postmeta v3
														ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
														WHERE v1.meta_value='".$bistroArr[$i]."'  
														AND v1.meta_key='review_bistroid'";
														//echo $sqlRatingNb;
										$resultRatingNb = $wpdb->get_results($sqlRatingNb);
										$Img_num_rowsNb = $wpdb->num_rows;
										$pointNb=0;
										foreach ($resultRatingNb as $keyRatingNb){
											$pointNb += $keyRatingNb->rating;
										} 
										//echo $pointNb;
										if($Img_num_rowsNb!=0){
											$percentRatingNb = $pointNb*(100/(5*$Img_num_rowsNb));
										}else{
											$percentRatingNb = 0;
										}
									?>
									<br/>
									<div class="starsS" style="float:left;">
										<div class="ratingS" style="width:<?php echo $percentRatingNb;?>%"></div>
										<input type="radio" name="rating2" id="star5" value="5">
										<label for="star5"></label>
										<input type="radio" name="rating2" id="star4" value="4">
										<label for="star4"></label>
										<input type="radio" name="rating2" id="star3" value="3">
										<label for="star3"></label>
										<input type="radio" name="rating2" id="star2" value="2">
										<label for="star2"></label>
										<input type="radio" name="rating2" id="star1" value="1">
										<label for="star1"></label>
									</div>	
								</div> <!--end div detailNb-->
								<div style="clear:both;margin-bottom:10px;"></div>
								<?php
									} //end if
								} // end for
							
							?>
						
					</div> <!-- end div bOther -->
					<?php }//end if ?>
				</div>
			</div>
			<?php //special_brel
            //special_brelBranch
           
			
			//foreach()
			?>
			<div class="reviewSection">
				<div class="reviewLeft">
					<?php
						//$sqlSpecial = "SELECT * FROM wp_postmeta WHERE meta_key='_yyarpp' AND meta_value='".get_the_ID()."' LIMIT 1";
						$sqlSpecial = "SELECT * FROM (
    (SELECT meta_id,post_id FROM wp_postmeta WHERE meta_key LIKE '%special_bid%' AND meta_value 	LIKE '%".get_the_ID()."%' GROUP BY post_id)
	UNION ALL
	(SELECT meta_id,post_id FROM wp_postmeta WHERE meta_key LIKE '%special_bbranchId%' AND meta_value LIKE '%".get_the_ID()."%' GROUP BY post_id )
)p1 INNER JOIN wp_posts p2 ON p1.post_id=p2.id";
						$resultSpecial = $wpdb->get_results($sqlSpecial);
						$rowSpecial = $wpdb->num_rows;
						if($rowSpecial>0){
					?>
					<div class="specialReview">
						<div class="specialZone">
							<div class="specialReviewTitle"><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/specialTitle.png" border="0"></div>					
                            <?php foreach($resultSpecial as $special) : ?>
							<div class="specialContent">
                            <?php
									
							?>
									<div class="specialImage" style="margin-top:15px;">
									
										<?php echo get_the_post_thumbnail( $special->post_id, array( 133, 100) );   ?>
								</div>
								<div class="specialDetail" >
									<div class="specialName" style="padding-top:20px;"><a href="<?php echo get_permalink( $special->post_id ); ?>"><?php echo get_the_title( $special->post_id ); ?></a></div>
									<div class="specialExcerp"><?php echo get_post_meta( $special->post_id, 'special_bdesc', 'true' );?> ...<span class="readmore"><a href="<?php echo get_permalink( $special->post_id ); ?>">อ่านต่อ</a></span></div>
								</div>
							</div>
                            <div style="clear:both;"></div>
                            <?php endforeach; ?>
						</div>
					</div>
					<?php 
						}
					?>
						<?php /*WHERE ID_Res='".$bistroId."'*/
							$sqlpro="select * from wp_promotion  WHERE ID_Res='".$bistroId."' ORDER BY start_date DESC";
							$querypro = mysql_query($sqlpro);
							$num_pro = mysql_num_rows($querypro);
							$start_date= strtotime($start_date);
							$start = date("d-m-Y", $start_date);
							$end_date= strtotime($end_date);
							$end = date("d-m-Y", $end_date);
						?>
					<div class="reviewZone">
							<div><a onClick="tab(1)"  class="countReview" >รีวิว (<?php echo $Img_num_rows;?>)</a></div>
							<div ><a onClick="tab(2)" class="countImg">รูปภาพ (<?php echo $Img_num_rows3+$Img_num_rows1+$Img_num_imageBistro;?>)</a></div>
							<div><a onClick="tab(3)"  class="countCoupon">คูปอง (<?php echo $num_pro; ?>)</a></div>
					</div>
					<div class="review" id="review">
                   	<?php 
			
						function get_post_by_meta_value( $meta_key, $meta_value ) {
							$post_where = function ($where) use ( $meta_key, $meta_value ) {
											global $wpdb;
											$where  .= ' AND ID IN (SELECT post_id FROM ' . $wpdb->postmeta
													. ' WHERE meta_key = "' . $meta_key .'" AND meta_value = "' . $meta_value . '")';
											return $where;
											};
							add_filter( 'posts_where', $post_where );
							$args = array(
										'post_type' => 'review',
										'post_status' => 'published',
										'post_per_page' => -1,
										'suppress_filters' => FALSE
										);
							$posts = get_posts( $args );
							remove_filter( 'posts_where' , $posts_where );
												  
							return $posts;
						} 
								
						$reviewListArr = get_post_by_meta_value( 'review_bistroid',get_the_ID());
							
					?>
					
					<ul class="grid effect-2" id="grid">
					<?php
						$review_args = array(
										'meta_key'=>'review_bistroid',
										'meta_value'=> get_the_ID(),
										'post_type'=>'review',
										'post_status'=>'publish'
										);
																	
						$review = new WP_Query( $review_args );
						if ( $review->have_posts() ) :
							while ( $review->have_posts() ) : $review->the_post(); 
								// echo  $review->post_author;
								 list($rank,$rankImg) = lvMember($post->post_author);
								
							?>
							<li  style="width:100%">
								<div class="reviewDetail" id="review_<?php echo the_ID();?>">
									<div class="reviewUser">
										<div class="reviewAvatar">
											<div style='position:absolute'><?php echo get_avatar( get_the_author_meta( 'ID' ), 76 ); ?></div>
											<div class="levelMember"><img src="<?php echo $rankImg;?>" border="0" width="30" height="32"/></div>
										</div>
										<div class="reviewUserDetail">
											<div class="authorName"><?php echo bp_core_get_userlink( get_the_author_meta( 'ID' ))?></div>
											<div class="reviewBistroName">รีวิวร้าน <font color='#21a0aa'><?php echo get_the_title($bistroId)?></font></div>
											<div class="userRate">
												<div class='rating_bar'>
													<?php $userRate = $post->review_rating * 20;?>
													<div  class='rating' style='width:<?php echo $userRate;?>%;'></div>
												</div>
											</div>
											<div style='clear:both'></div>
											<?php
												global $wpdb;
												$author_id = get_the_author_meta( 'ID' );
												$countReview = "SELECT * FROM wp_posts WHERE post_author='".$author_id."' AND post_type='review'";
												$query = $wpdb->get_results($countReview);
												$numReview = $wpdb->num_rows;
												$countImg = "SELECT * FROM(
																 (SELECT * FROM wp_posts
																  INNER JOIN wp_postmeta ON 
																  post_id=post_parent
																  WHERE meta_key='Image_bistroId'
																  AND post_status !='trash'
																  AND post_author='".$author_id."'
																 )
																 union
																 (SELECT * FROM wp_posts
																  INNER JOIN wp_postmeta ON meta_value=ID 
																  WHERE  meta_key = 'bistro_img'
																  AND post_status !='trash'
																  AND post_author='".$author_id."'
																 )
															) bImg
															GROUP BY  bImg.ID";
												$query = $wpdb->get_results($countImg);			
												$numImg = $wpdb->num_rows;
											?>
											<div class="reviewCount"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/reviewIcon.png" border="0" style="display:inline-block"/><?php echo "  ".$numReview." รีวิว";?></div>
											<div class="picCount"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/picIcon.png" border="0" style="display:inline-block"/><?php echo "  ".$numImg." ภาพ"; ?></div>
										</div>
										
										<div class="reviewRate" style='line-height:25px;'>
										
											<?php 
												//echo "เมนูแนะนำ : ".$post->review_recommend."<br/>";
												//echo "Rating : ".$post->review_rating."<br/>";
												echo "บรรยากาศ :";
												if($post->review_environment!=0){$envRating = $post->review_environment*(100/3);}
												else{$envRating = 0;}

											?>
												<div class="smile">
													<div class="smileRating" style="width:<?php echo $envRating;?>%"></div>
													<input type="radio" name="envRating" id="smile3" value="3">
													<label for="smile3"></label>
													<input type="radio" name="envRating" id="smile2" value="2">
													<label for="smile2"></label>
													<input type="radio" name="envRating" id="smile1" value="1">
													<label for="smile1"></label>
												</div>
												
											<?php	
												echo "<br/>การบริการ :";
												if($post->review_service!=0){$serviceRating = $post->review_service*(100/3);}
												else{$serviceRating = 0;}
											?>
												<div class="smile">
													<div class="smileRating" style="width:<?php echo $serviceRating;?>%"></div>
													<input type="radio" name="serviceRating" id="smile3" value="3">
													<label for="smile3"></label>
													<input type="radio" name="serviceRating" id="smile2" value="2">
													<label for="smile2"></label>
													<input type="radio" name="serviceRating" id="smile1" value="1">
													<label for="smile1"></label>
												</div>
												
											<?php		
												echo "<br/>รสชาติ : ";
												if($post->review_taste!=0){$tasteRating = $post->review_taste*(100/3);}
												else{$tasteRating = 0;}
											?>
												<div class="smile">
													<div class="smileRating" style="width:<?php echo $tasteRating;?>%"></div>
													<input type="radio" name="tasteRating" id="smile3" value="3">
													<label for="smile3"></label>
													<input type="radio" name="tasteRating" id="smile2" value="2">
													<label for="smile2"></label>
													<input type="radio" name="tasteRating" id="smile1" value="1">
													<label for="smile1"></label>
												</div>
												
											<?php		
												echo "<br/>ความคุ้มค่า : ";
												if($post->review_worthiness!=0){$worthinessRating = $post->review_worthiness*(100/3);}
												else{$worthinessRating = 0;}
											?>
												<div class="smile">
													<div class="smileRating" style="width:<?php echo $worthinessRating;?>%"></div>
													<input type="radio" name="worthinessRating" id="smile3" value="3">
													<label for="smile3"></label>
													<input type="radio" name="worthinessRating" id="smile2" value="2">
													<label for="smile2"></label>
													<input type="radio" name="worthinessRating" id="smile1" value="1">
													<label for="smile1"></label>
												</div>
												
											<?php		
												//if(function_exists('wp_ulike')) wp_ulike('get');
											?>
										</div>
									</div>
									<div class="reviewTitle">
										<div class="quote1"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/quote1.png" border="0" /></div>
										<div class="title"><?php the_title(); ?></div>
										<div class="quote2"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/quote2.png" border="0" /></div>
									</div>
									<div style="clear:both"></div>
									<div class="reviewContent"><?php echo the_content();?>
									
									<?php
									$sql_reviewImg = "SELECT *, wp_posts.ID AS pid FROM  wp_postmeta INNER JOIN wp_posts ON meta_value=id WHERE meta_key='review_image' AND post_id='".$post->ID."'";
									
									$results = $wpdb->get_results($sql_reviewImg);
									$numResults = $wpdb->num_rows;
									
									if ($numResults>0) {
									?>
										<div id="containerImg">
											<div id="list">
											<?php		
												foreach ($results as $result) {
													$image_attributes = wp_get_attachment_image_src( $result->ID,357 ); // returns an array
											?>
													<div class="item"><img src="<?php echo $image_attributes[0]; ?>" width="357"><figcaption><?php echo apply_filters( 'the_title', $result->post_title );?></figcaption></div>
											<?php
												}
											?>
											</div>
										</div>
									<?php
									} //end if
									?>
									<div style="clear:both"></div>
									</div>
									<div style="clear:both"></div>
									<?php 
									$comments_count = wp_count_comments(get_the_id());
									
									?>
									<div class='commentCount'>
										<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/comment-icon.png" border="0" style="display:inline"/> <?php echo $comments_count->total_comments;?>  ความคิดเห็น 
										<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/calendar-icon.png" border="0" style="display:inline;padding-left:5px;"/> <?php echo get_time_ago($result->id); ?>
									</div>
									<?php $current_user = wp_get_current_user();
										$current_username = $current_user->user_login;
										
										$current_usermail = $current_user->user_email;
										$current_fullname = $current_user->user_firstname ." ". $current_user->user_lastname;
									?>
									<?php
									if ( is_user_logged_in() ) {
									?>
										<div class="reportReview"><a id="report" onClick="formReport('<?php echo "review_".get_the_ID();?>','<?php echo $current_username;?>','<?php echo $current_usermail;?>')"  style="cursor:pointer">แจ้งข้อผิดพลาด</a></div>
									<?php } ?>
									<div id="formReportReview" style="display:none;">
											<?php echo do_shortcode('[contact-form-7 id="1804" title="Report review"]');?>
									</div>
									
									<div class="reviewComment">
										<?php 
										//echo get_the_id();
											
											$comments = get_comments('post_id='.get_the_id());
											foreach($comments as $comment) :
												$commentId = get_comment_ID();
												$commentAuthor = get_comment_author( $commentId );
												$commentAuthorId = get_comment(get_comment_ID())->user_id;
												list($rank,$rankImg) = lvMember($commentAuthorId);
												?>
												<div class='commentPic'><?php echo get_avatar(get_comment_author_email($comment->comment_ID), 50);?></div>
												<div class='commentContent'>
														<div class='commentArr'><img src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/commentArr.jpg'/></div>
														<div class='cm1'><?php echo $comment->comment_content;?></div>
														<div class='cm2'>
														<img style='vertical-align:middle;display:inline' src="<?php echo $rankImg;?>" border="0" width="30" height="32"/><?php echo " ".$commentAuthor."  ";?></div>
														<div class='cm3' style="padding-left:5px"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?></div>
												</div>
												
											<?php
											endforeach;
										?>
										
										<div ><?php comment_form();?>
										
										</div>
										<div style='clear:both'></div>
									</div>
									
								</div>	
							</li>
							<?php endwhile; ?>
						<?php endif; ?>	
						</ul>
						</div><!-- END div review-->
						<div class="tabImg" id="tabImg">
						<div class="image-set">
						<?php
							global $wpdb; 
							//select Image จากการเพิ่มรูปอย่างเดียว
							$sqlSelectImg1 = 	"SELECT * FROM wp_posts
												INNER JOIN wp_postmeta ON post_id=post_parent
												WHERE meta_key='Image_bistroId' 
												AND meta_value='".$bistroId."'";
												//echo $sqlSelectImg1;
							$attachments1 = $wpdb->get_results($sqlSelectImg1);
							$Img_num_rows1 = $wpdb->num_rows;
							foreach ($attachments1 as $attachment1)
							{
								$image_attributes1 = wp_get_attachment_image_src($attachment1->ID,array(80,80)); // returns an array
								$origsize1 = wp_get_attachment_image_src($attachment1->ID,full);
								echo "<a  class='example-image-link'  href='".$origsize1[0]."'  data-lightbox='example-set'  data-title='".apply_filters( 'the_title', $attachment1->post_title )."'><img src='".$image_attributes1[0]."' width='80' height='80' border='0'  class='imgView'/></a>";
							}	
							
							
							// select Image จากการรีวิว	
							//$bistroId = get_the_ID();
							$sqlSelectImg2  = "SELECT * FROM wp_postmeta WHERE meta_key='review_bistroid' AND meta_value='".$bistroId."'";
							//echo $sqlSelectImg2;
							$attachments2 = $wpdb->get_results($sqlSelectImg2);
							$Img_num_rows2 = $wpdb->num_rows;
							//วน foreach  ออกมาได้ id ของ แต่ละ review	
							foreach ($attachments2 as $attachment2)
							{
								//echo $attachment2->post_id;
								$sqlSelectImg3 = "SELECT * FROM wp_posts 
												INNER JOIN wp_postmeta ON post_id=ID 
												WHERE post_parent='".$attachment2->post_id."' AND meta_key='_wp_attached_file'";
									//echo $sqlSelectImg3;
								$attachments3 = $wpdb->get_results($sqlSelectImg3);
								foreach ($attachments3 as $attachment3)
								{
									$image_attributes3 = wp_get_attachment_image_src($attachment3->ID,array(80,80)); // returns an array
									$origsize3 = wp_get_attachment_image_src($attachment3->ID,full);
									echo "<a  class='example-image-link'  href='".$origsize3[0]."' data-lightbox='example-set'  data-title='".apply_filters( 'the_title', $attachment3->post_title )."'><img src='".$image_attributes3[0]."' width='80' height='80' border='0' class='imgView'/></a>";
								}							
							}
							
							
							//select Image จากรูปตอนสร้างร้าน
							$sqlSelectImg4 = "SELECT * FROM wp_postmeta WHERE meta_key='bistro_img'AND post_id='".$bistroId."'";
							$attachments4 = $wpdb->get_results($sqlSelectImg4);
							$Img_num_rows4 = $wpdb->num_rows;
							//วน foreach  ออกมาได้ id ของ แต่ละรูป
							foreach ($attachments4 as $attachment4)
							{
								//echo $attachment4->meta_value;
								$image_attributes4 = wp_get_attachment_image_src($attachment4->meta_value,array(80,80)); // returns an array
								$origsize4 = wp_get_attachment_image_src($attachment4->meta_value,full);
								echo "<a  class='example-image-link'  href='".$origsize4[0]."'  data-lightbox='example-set'  data-title='".apply_filters( 'the_title', $attachment4->post_title )."'><img src='".$image_attributes4[0]."' width='80' height='80' border='0'  class='imgView'/></a>";
							}
						?>
						</div>
					</div> <!---end tab img--->
					
					<div id="tabCoupon" class="tabCoupon" style="float: left;">
					
                    <div class="box-left">

									
					
					
                   	<div id="list_promotion">
                    <?php
						 while($row_type=mysql_fetch_array($querypro)){
								$start_date = substr($row_type['start_date'],0,10);
								$end_date = substr($row_type['end_date'],0,10);
					?>
                              <a class="iframe" href="/promotion-lightbox?id=<?php echo $row_type['ID_PR'];?>">
                                 <div class="box-image item_promotion" style="width: 230px;"> 
                                 	<?php if($row_type['discount']=='Free'){ ?>
                                      <div class="percent"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/free.png"/></div>
                                   <?php  } else {?>
                                 	<div class="discount"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/discount.png"/></div>
                                   
                                    <div class="percent"><div class="text-percent"><?php echo $row_type['percent'];?>%</div></div>
                                    <?php } ?>
                                 
                                	<img src="/wp-content/plugins/promotion/<?php echo $row_type['image']; ?>" style="width: 230px;"/>	
                                	
                                     <div class="bg-promotion-title" style="width: 200px;">
                                         <span class="title-promotion-font"><?php echo substr_utf8( $row_type['title'], 0 , 28); ?></span>
                                     <div class="cleaner_h3"></div>
                                         <span class="detail-promotion-font"><?php echo substr_utf8($row_type['description'],0,30);?></span>
                                     </div>
                                </div>
                            </a>
                          
        
                    <?php } ?>
                         
					</div>
                  </div>
					
					
					
					
					</div><!---end tabCoupon--->
				</div><!-- END div reviewLeft-->
				<div class="reviewRight">
				</div>
			</div>
			
			
			
			
			</div>
		<?php endwhile; else: ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>
		<?php endif; ?>
	</div><!-- #content -->
	<div style="clear:both"></div>
	<?php //get_sidebar(); ?>
	<?php do_action( 'bp_after_blog_home' ); ?>
			
</main>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/masonry.pkgd.min.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/imagesloaded.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/classie.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/AnimOnScroll.js"></script>
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );
		</script>

<?php get_footer(); ?>