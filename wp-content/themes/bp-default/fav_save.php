<?php
include_once("../../../wp-config.php");
$post_id = $_POST['post_id'];
$user_ID = get_current_user_id();
//echo $user_ID;
$sqlSearchFav = "SELECT * FROM wp_favourite WHERE post_id='$post_id' AND fav_by='$user_ID'";
//echo $sqlSearchFav;
$query = mysql_query($sqlSearchFav);
$res = mysql_fetch_array($query);
//echo $res;
$favRow = mysql_num_rows($query);
$fav_date = date("Y-m-d H:i:s");
if($favRow<1){
	$sqlAddFav = "INSERT INTO wp_favourite(post_id,fav_by,fav_date) VALUES('$post_id','$user_ID','$fav_date')";
	mysql_query($sqlAddFav);
	echo "1";
	//echo $sqlAddFav;
}else{
	$sqlDelFav = "DELETE FROM wp_favourite WHERE ID='".$res['id']."'";
	echo $sqlDelFav;
	mysql_query($sqlDelFav);
	echo "2";
}
?>