<?php 
require_once('../../../wp-config.php');
global $wpdb;
$id = $_GET["id"];
?>
<html>
<head>
<meta http-equiv="refresh" content="0; URL=/wp-admin/admin.php?page=promotion"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Random Password Generator</title>
</head>
<body>

<?php
	$sql = "DELETE FROM wp_promotion WHERE ID_PR = ".$id."";
	mysql_query( $sql );
	
	$sql_coupon = "DELETE FROM wp_promotion_coupon WHERE ID_Promotion = ".$id."";
	mysql_query( $sql_coupon );
	
?>
</body>
</html>

