<?php global $wpdb; ?>
<?php $id = $_GET["id"]; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Random Password Generator</title>
<link rel="stylesheet" href="/wp-content/plugins/promotion/css/style.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/wp-content/plugins/promotion/js/script.js"></script>
        
<link rel="stylesheet" media="all" type="text/css" href="/wp-content/plugins/promotion/css/jquery-ui.css" />
<link rel="stylesheet" media="all" type="text/css" href="/wp-content/plugins/promotion/css/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="/wp-content/plugins/promotion/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="/wp-content/plugins/promotion/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/wp-content/plugins/promotion/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="/wp-content/plugins/promotion/js/jquery-ui-sliderAccess.js"></script>

<script type="text/javascript">
$(function(){
	$("#dateStart").datepicker({
		dateFormat: 'dd-mm-yy',
		numberOfMonths: 1,
	});
	$("#dateEnd").datepicker({
		dateFormat: 'dd-mm-yy',
		numberOfMonths: 1,
	});
});
</script>
<script>
function myFunction() {
    alert("I am an alert box!");
}
</script>
<body>
<?php 
	$sql="select * from wp_promotion INNER JOIN wp_posts ON wp_promotion.ID_Res = wp_posts.ID WHERE post_type = 'bistro' AND ID_PR = ".$id."";
	$query = mysql_query($sql);
	$show = mysql_fetch_array($query);
	$start_date = substr($show['start_date'],0,10);
	$end_date = substr($show['end_date'],0,10);
	
	$start_date= strtotime($start_date);
	$start = date("d-m-Y", $start_date);
	$end_date= strtotime($end_date);
	$end = date("d-m-Y", $end_date);
	
?>
<br>
<form action="/wp-content/plugins/promotion/update.php?id=<?php echo $id ;?>" method="post" name="form1" enctype="multipart/form-data">


ร้านค้า<input name="bistro" type="text" value="<?php echo $show['post_title']; ?> "><input name="id_bistro" type="hidden" value="<?php echo $id; ?>"><br/>  <br/>

อีเมลล์ร้านค้า <input name="email" type="text" value="<?php echo $show['email']; ?> "><br/>
ชื่อโปรโมชั่น <input name="title" type="text" value="<?php echo $show['title']; ?>"><br/>

รายละเอียดโปรโมชั่น <input name="description" type="text" value="<?php echo $show['description']; ?>"><br/>
เงื่อนไขโปรโมชั่น <input name="condition" type="text" value="<?php echo $show['conditions']; ?>"><br/><br/>

		<img src="/wp-content/plugins/promotion/<?php echo $show['image']; ?>" width="300"/>	
			<div id="selectImage">
                <input type="file" name="file" id="file"/>
                <input type="hidden" name="hdnOldFile" value="<?php echo $show['image']; ?>">
            </div>                   	
	
		     
<br/><br/>
โปรโมชั่น <input name="promotion" type="radio" value="Free" <?php if( $show['discount'] == "Free") { echo 'checked="checked"'; } ?>>Free  <input name="promotion" type="radio" value="ส่วนลด" <?php if( $show['discount'] == "ส่วนลด") { echo 'checked="checked"'; } ?>>ส่วนลด <input name="discount-per" type="text" value="<?php echo $show['percent']; ?>"> % <br/>


        
วันที่เรวันที่เริ่มโปรโมชั่น  <input type="text" name="dateStart" id="dateStart" value="<?php echo $start; ?>" /> วันหมดอายุ <input type="text" name="dateEnd" id="dateEnd" value="<?php echo $end; ?>" /><br/><br/><hr>


<?php 
	$sql_coupon="select * from wp_promotion_coupon INNER JOIN wp_promotion on wp_promotion_coupon.ID_Promotion = wp_promotion.ID_PR WHERE ID_PR=".$id."";
	$query_coupon = mysql_query($sql_coupon);
	$rowcount=mysql_num_rows($query_coupon);?>
	<h2>จำนวนคูปองทั้งหมด<?php echo $rowcount; ?> ใบ </h2><br/>


<div style="overflow-y:scroll; height:150px; width:850px;">

<table width="800" border="0">
	<?php 
        $row = 0;
         while($show_coupon = mysql_fetch_array($query_coupon)) { 
            echo ($row%5==0)  ? '<tr>' : '';
        ?>
            <td><?php if ($show_coupon['status']== 0){ 
					 	echo $show_coupon['code']. "<br>";
					}else { ?>
			  		 <strike style="color:#ff0000;"><?php echo $show_coupon['code']; ?></strike>
                    <?php  } ?>
                     </td>
        <?php 
            $row++;
            echo ($row%5==0)  ? '</tr>' : '';
        
        } ?>
</table>
</div>
<br/>
<input name="value" type="submit" class="submit"  value="บันทึก" />
</form>

</body>
</html>
