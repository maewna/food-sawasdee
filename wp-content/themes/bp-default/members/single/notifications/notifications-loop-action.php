<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
require_once('../../../../../../wp-config.php');
$id= $_GET["id"];
if($_GET["action"] == "read")
{
		 $strSQL = "UPDATE wp_bp_notifications SET ";
		 $strSQL .="is_new = '0' ";
		 $strSQL .="WHERE id = '".$id."' ";
		 $objQuery = mysql_query($strSQL);
		 
		$sql1 ="SELECT * FROM wp_users LEFT JOIN wp_bp_notifications ON wp_users.ID = wp_bp_notifications.item_id WHERE wp_bp_notifications.id ='".$id."' ";
		$query1 =mysql_query($sql1);	
		$results1 = mysql_fetch_array($query1);
		if($objQuery || $results1){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='/members/".$results1['user_nicename']."/?bpf_read';
				   </SCRIPT>");
		}
}

if($_GET["action"] == "read2")
{
		 $strSQL = "UPDATE wp_bp_notifications SET ";
		 $strSQL .="is_new = '0' ";
		 $strSQL .="WHERE id = '".$id."' ";
		 $objQuery = mysql_query($strSQL);
		 
		$sql1 ="SELECT * FROM wp_posts LEFT JOIN wp_bp_notifications ON wp_posts.ID = wp_bp_notifications.secondary_item_id WHERE wp_bp_notifications.id ='".$id."' ";
		$query1 =mysql_query($sql1);	
		$results1 = mysql_fetch_array($query1);
		if($objQuery || $results1){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='".$results1['guid']."';
				   </SCRIPT>");
		}
}


?>