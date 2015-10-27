<?php /*Template Name: Promotion Lightbox Page */
require_once('wp-config.php');
 ?>
<?php $id = $_GET["id"]; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/promotion.css">

<body class="bg">
<?php 
	$sql="select * from wp_promotion INNER JOIN wp_promotion_coupon ON wp_promotion.ID_PR = wp_promotion_coupon.ID_Promotion WHERE ID_PR = ".$id." AND status = 0 ORDER BY RAND()";
	$query = mysql_query($sql);
	$show = mysql_fetch_array($query);
	$start_date = substr($show['start_date'],0,10);
	$end_date = substr($show['end_date'],0,10);
	
	$start_date= strtotime($start_date);
	$start = date("d-m-Y", $start_date);
	$end_date= strtotime($end_date);
	$end = date("d-m-Y", $end_date);
?>
	<div class="circle">
    	<div class="title-circle">
        	<li style="font-size:22px; list-style-type: none;">ส่วนลด</li>
            <li style="font-size:18px; list-style-type: none; line-height:10px;"> เมื่อไปกิน</li>
            <li style="font-size:31px; list-style-type: none; line-height:45px;">ที่ร้าน</li>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-discount.png" style="margin-top: -2px;"/>
       	</div>
     </div>
     			<?php if($show['discount']=='Free'){ ?>
                     <div class="percent-lightbox"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/free1.png"/></div>
                <?php  } else {?>
                      <div class="percent-lightbox"><div class="text-percent" style="margin-top: 35px;"><?php echo $show['percent'];?>%</div></div>
                <?php } ?>
                
    		<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/semi.png" style="margin-left: 235px; margin-top: 60px;"/>
            <span style="font-family:supermarket; font-size:23px; color:#ffffff; margin-top: 47px; position: absolute; margin-left: 10px;">
			<?php echo $show['title']; ?></span>
             <span style="font-family:tahoma; font-size:14px; color:#ffffff; margin-top: 80px; position: absolute; margin-left: 10px;">
			<?php echo $show['description']; ?></span>

	<br />
    <a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/code.png" style="margin-left: 205px; margin-top: 45px; float:left;"/>	</a>
    <div class="gencode"><span style="color:#F99B00; font-size:14px; font-family:tahoma; font-weight:bold;"><?php echo $show['code']; ?></span></div>

	<br />	<br />
    <div style="font-family:tahoma; color:#4D4D4D; font-size:14px; margin-top: 92px; margin-left: 50px;">
    ประเภท : อาหารนานาชาติ ,สเต็ก <br />
    ระยะเวลา : <span style="color:#F99B00; line-height:25px;"><?php echo $start; ?> - <?php echo $end; ?> </span><br />
    <span style="line-height:35px;">รับส่วนลดจาก : <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/logo-food.png" style="margin-top: 4px;
margin-left: 8px;
position: absolute;"/></span><br />
    </div>
	<br /><br /><br />
	  <span style="font-family:supermarket; color:#754C24; font-size:22px; margin-left: 50px;">เงื่อนไข : </span><br />
      <span style="margin-left:50px; font-family:tahoma; font-size:14px; color:#4D4D4D;"><?php echo $show['conditions']; ?></span>

<div class="bg_circle">
<img src="/wp-content/plugins/promotion/<?php echo $show['image']; ?>" style="border-radius: 50%; width: 245px; height: 245px; margin-top: 25px;
margin-left: 8px;"/>
</div>
</body>
</html>