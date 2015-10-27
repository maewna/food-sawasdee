<?php global $wpdb; ?>
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

<body>
 <p><input type="button" class="button-primary" name="back" value="<?php _e('Add New Promotion'); ?>" 
        onclick="document.location.href='admin.php?page=add-promotion';" /></p><br>
<?php 
	$sql="select * from wp_posts WHERE post_type = 'bistro' AND post_status = 'publish' ORDER BY post_date DESC";
	$query = mysql_query($sql);
	
?>

<form action="" method="post" name="form1" id="promotion">
ร้านค้า <select name="bisto">
	<?php while($row_type=mysql_fetch_array($query)){ ?>
	<option value="<?php echo $row_type['ID']; ?> "><?php echo $row_type['post_title']; ?> </option> 
    <?php } ?>
</select> <br/>
อีเมลล์ร้านค้า <input name="email" type="text"><br/>
ชื่อโปรโมชั่น <input name="title" type="text"><br/>
รายละเอียดโปรโมชั่น <input name="description" type="text"><br/>
เงื่อนไขโปรโมชั่น <input name="condition" type="text"><br/><br/>
<div id="image_preview"><img id="previewing" src="/wp-content/plugins/promotion/noimage.png" /></div>	
			<div id="selectImage">
                <input type="file" name="file" id="file" required />
            </div>                   	
	
		     
<br/><br/>
โปรโมชั่น <input name="promotion" type="radio" value="Free">Free  <input name="promotion" type="radio" value="ส่วนลด">ส่วนลด <input name="discount-per" type="text"> % <br/>


        
วันที่เริ่มโปรโมชั่น  <input type="text" name="dateStart" id="dateStart" value="" /> วันหมดอายุ <input type="text" name="dateEnd" id="dateEnd" value="" /><br/>
<hr>
จำนวนคูปอง <input name="code" type="text" value="" id="code" /><br />
อักษรเริ่มต้น <input name="txt" type="text" value="" id="txt"  /><br />
ความยาวรหัส <input name="count" type="text" value="" id="count"  /> อักษร<br />

        
<input name="value" type="submit" class="submit"  value="บันทึกข้อมูล" />
</form>

<div id="message"></div>




</body>
</html>
