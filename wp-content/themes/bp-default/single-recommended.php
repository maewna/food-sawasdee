<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/varietyDetail.css" />


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
<div class="page" style="background-color:white;">	

	<div id="content" >
				<div class="singlenavigation" style="margin-bottom:20px;">
					<?php while (have_posts()) : the_post(); ?>
					<a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> >  <a href="<?php echo home_url(); ?>/bistro/">อร่อยนอกบ้าน</a> > <a href="<?php echo home_url(); ?>/variety/">วาไรตี้ร้านอร่อย</a> > <a href="<?php the_permalink(); ?>"><b><?php the_title(); ?></b></a>
					<?php endwhile;?>
				</div>	
		<div class="padder" style="background-color:white;">
			<?php do_action( 'bp_before_blog_single_post' ); ?>
				
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<div class="variety">
					<div style="margin-left:15px;z-index:3;position:relative"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconVariety.png" width="60" height="62" style="vertical-align:middle;margin-right:10px;"/><span class="vMenu">วาไรตี้ร้านอร่อย</span></div> 
					<?php //echo get_field('varietyType');?>
					<?php if(get_field('varietyType')=='แนะนำร้านอาหารตามประเภท'){?>
						<?php $vImg1 = get_field(vImg1);?>
						<div class="vFImg"><img src="<?php echo $vImg1; ?>" width="1036" /></div>
					<?php }else {?>
						<?php $vImg2 = get_field(vImg2);?>
						<div class="vFImg2" ><img src="<?php echo $vImg2; ?>" width="670" /></div>
						<div class="vMap" id="vMap"></div>
					<?php } ?>
					<div style="clear:both;"></div>
					<div class="vContent">	
						<div class="vTtitle"><?php the_title();?></div>
						<?php echo get_the_content();?>
						<div class="vSocial"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
					</div>
					<div class="vLeft">
                    
					
                    	<?php
						$row=1;
						
                    	 while ( have_rows('bistro_recommend') ) : the_row();
                         		$bistro_value = get_sub_field('bistro_vid');
								$v_bid[] = $bistro_value[0]; //
								//echo $bistro_value[0];
								$sql_bistro = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$bistro_value[0]."'";
								
								//echo $sql_bistro;
								$bistro = $wpdb->get_results($sql_bistro);
								
								?>
                                <div style="margin-top:30px;"></div>
								<div class="vNo">
									<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconNum.png" width="45" height="47"/>
									<div class="no"><?php echo $row;?></div>
								</div>
                                <div class="vTitle"><a href="<?php echo get_permalink($bistro_value[0]);?>"><?php echo get_the_title($bistro_value[0]);?></a></div>
                                <?php
								foreach($bistro as $detail){
									if($detail->meta_key=='bistro_logo'){
										$bistro_logo= $detail->meta_value;
									}
								}
								
								?>
                                <div class="vLogo"><?php echo wp_get_attachment_image($bistro_logo,array(50,9999)); ?></div>
                                <div style="clear:both;"></div>
                           		 <?php
								 $imgs = get_sub_field('bistro_vImg');
								if(count($imgs)==1){
									foreach($imgs AS $img){
									?>
                                    	<div style="width:665px;height:365px;"><?php echo imagesize($img[url],665,365);?></div>
                                    <?php
									}
								}else if(count($imgs)==2){
									$no = 1;
									foreach($imgs AS $img){
										
									?>
                                    	<div style="width:325px;height:365px;float:left;position:relative;<?php if($no==2){echo "padding-left:20px;";}?>"><?php echo imagesize($img[url],325,365);?></div>						
                                    <?php
										$no++;
									}
								}else if(count($imgs)==3){
									$no = 1;
									foreach($imgs AS $img){
										if($no==1){
										?>
											<div style="width:325px;height:365px;float:left;position:relative;"><?php echo imagesize($img[url],325,365);?></div>
                                        <?php
										}else if($no==2){
										?>
											<div style="width:325px;height:175px;float:left;position:relative;padding-left:20px;"><?php echo imagesize($img[url],325,175);?></div>
										<?php
										}else if($no==3){
										?>
											<div style="width:325px;height:175px;float:left;position:relative;padding-left:20px;padding-top:15px;"><?php echo imagesize($img[url],325,175);?></div>
										<?php
										}
									?>
                                    <?php
										$no++;
									}
								}
								?>
                                <div style="clear:both"></div>
								<div class="bistro_vdetail"><?php the_sub_field('bistro_vdetail');?></div>
                                <div style="clear:both"></div>
								<div class="vBy"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconCar.png" width="16" height="17" style="vertical-align:middle"/> การเดินทาง : <font color="#000000"><?php the_sub_field('arrive_by');?></font></div>
                                <div style="clear:both"></div>
                                <div class="vShop"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconShop.png" style="vertical-align:middle"/> ประเภทร้าน : <font color="#000000"><?php the_sub_field('vBistroType');?></font></div>
                                <div style="clear:both"></div>
                                <div class="vReview"><a href="<?php echo get_permalink($bistro_value[0]);?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconViewReview.png" width="70" height="53" border="0"/></a><a href="<?php echo get_permalink($bistro_value[0]);?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconViewMap.png" width="70" height="62" border="0" style="padding-left:30px;" /></a></div>
                                <div class="vLine">--------------------------------------------------------------</div>
                                <?php
								$row++;
                         endwhile;
                     	?>
                        <?php 
							$num = count($v_bid);
							$mymap = new Mappress_Map(array("width" => 366,"height"=>475));
							for($i=0;$i<$num;$i++){
							//echo $i;
							$sql_map = "SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID=post_id WHERE ID='".$v_bid[$i]."'";
							//echo $sql_bistro;
							$vmap = $wpdb->get_results($sql_map);
							foreach($vmap as $detail){
								if($detail->meta_key=='bistro_detail'){$bistro_detail=$detail->meta_value;}
								if($detail->meta_key=='bistro_path'){$bistro_path=$detail->meta_value;}
								if($detail->meta_key=='bistro_type'){$bistro_type=$detail->meta_value;}
								if($detail->meta_key=='bistro_logo'){
									$bistro_logo= $detail->meta_value;
									$src = wp_get_attachment_image($bistro_logo,array(50,9999));
								}
								if($detail->meta_key=='bistro_map'){
									$bistro_map= explode(",",$detail->meta_value);
									$lat=$bistro_map[0];
									$lng=$bistro_map[1];
								}
								if($detail->meta_key=='bistro_addressno'){
									$bistro_addressno=$detail->meta_value;
								}
								if($detail->meta_key=='bistro_soi'){
									$bistro_soi=" ซอย".$detail->meta_value;
								}
								if($detail->meta_key=='bistro_street'){
									$bistro_street=" ถนน".$detail->meta_value." ";
								}
								if($detail->meta_key=='bistro_province'){
									$bistro_province=$detail->meta_value;
								}
								$bistro_address = $bistro_addressno.$bistro_soi.$bistro_street.$bistro_province;
							}
							$no = "no".($i+1);
							$bistro_name=get_the_title($v_bid[$i]);
							$map = new Mappress_Poi(array("iconid" => "$no","title" => '', "body" => "<table width='180' cellpadding='0' cellspacing='0' border='0'><tr><td width='60' align='center' rowspan='2'>$src</td><td><font color='#fa6113'><b>$bistro_name</b></td></tr><tr><td width='130'>$bistro_address</td></tr></table>", "point" => array("lat" => $lat, "lng" => $lng)));
							array_push($mymap->pois, $map);
							}
						
						?>
                        
						<?php 
							
								$vMap = $mymap->display(array("directions"=>"none"));
								
						?>
						<script>
								$( document ).ready(function() {
									document.getElementById("vMap").innerHTML = "<?php echo $vMap;?>";
								});
								</script>
					</div>
					</div>
				<div class="vRight">
					<div class="vOther">
						<div class="iconOther"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconOtherV.png" width="45" height="47" style="display:inline-block;vertical-align:middle;padding-right:10px;"/>วาไรตี้ร้านอร่อยอื่นๆ</div>
						<?php 
						$sqlVOther = "SELECT * FROM wp_posts WHERE post_type='variety' AND post_status='publish' AND ID!='".$vId."' ORDER BY RAND()";
						$vOther = $wpdb->get_results($sqlVOther);
						foreach($vOther as $vName){
						?>
						<div class="vOtitle"><a href="<?php echo get_permalink($vName->ID);?>"><?php echo $vName->post_title;?></a></div>
						<?php }?>
					</div>
					<div class="vMember">
						<div class="iconMember"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconMemGreen.png" width="45" height="47" style="display:inline-block;vertical-align:middle;padding-right:10px;"/>สมาชิก Food Sawasdee</div>
						<div class="memAva">
									<?php $memberArray = array();
										$user_query = new WP_User_Query( array(  'orderby' => 'random', 'number' => 16 , 'role' => 'Subscriber' ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
											<?php $user_info = get_userdata($username->ID); ?>
											<a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 50); ?></a>
										
										<?php array_push($memberArray, $username->ID );	?>		
									<?php } }
									?>
						<!--<img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/1.jpg" width="50" height="50"  style="inline-block;padding-right:5px;padding-bottom:10px"/>
						<img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/1.jpg" width="50" height="50"  style="inline-block;padding-right:5px;padding-bottom:10px"/>
						<img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/1.jpg" width="50" height="50"  style="inline-block;padding-right:5px;padding-bottom:10px"/>
						<img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/1.jpg" width="50" height="50"  style="inline-block;padding-right:5px;padding-bottom:10px"/>
						<img src="<?php //bloginfo('stylesheet_directory'); ?>/_inc/images/1.jpg" width="50" height="50"  style="inline-block;padding-right:5px;padding-bottom:10px"/>
						--></div>
						<?php 
						if ( is_user_logged_in() ) {
						} else {
						?>
						<div align="center"><a href="#" class="registerBtn">สมัครสมาชิกคลิกเลย</a></div>
						<?php } ?>
					</div>
					<div class="vCom"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/com24.jpg" width="285" height="181" /></div>
				</div>
			  </div>
			<?php endwhile; else: ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ); ?></p>
			<?php endif; ?>

		

		<?php do_action( 'bp_after_blog_single_post' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->
	
	</div>
		<?php do_action( 'bp_after_blog_home' ); ?>
		
<?php get_footer(); ?>

