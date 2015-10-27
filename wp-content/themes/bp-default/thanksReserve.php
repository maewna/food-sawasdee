<?php include_once("../../../wp-config.php"); ?> 
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>
<style>
html{
background:transparent;
}
.thx{
	display:table;
	font-family:supermarket;
	font-size:24px;
	text-align:center;
	background-image:url(<?php echo get_template_directory_uri(); ?>/_inc/images/thankyou.png);
	background-repeat:no-repeat;
	width:613px;
	height:345px;
	
}

.text{
	display:table-cell;
	vertical-align:middle;
}
</style>
<?php
	$bistroName = $_REQUEST['bistroName'];
?>
<body>
<div class="thx">
<span class="text">ระบบการจองโต๊ะจะสมบูรณ์ <br/>เมื่อได้รับการติดต่อจากร้าน<br/>ขอบคุณค่ะ</span>
</div>
</body>
</html>