


<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );



/*$val = $_REQUEST['selectedValue'];
echo $val;*/
		global $wpdb;
 
      $pid=$_REQUEST['pid'];



$results_pid = $wpdb->get_results ( "
    SELECT * FROM freshmart_dev.wp_posts
	WHERE id = ".$pid.";
" );



		foreach ( $results_pid as $res_pid)
		{
			echo '<option value="'.$res_pid->ID.'">'.$res_pid->post_title.'</option>';
			
		}
		?>
		
		

<?php 
/* 
function (data){
	if(isset($_POST['user_role'])){
            $pid = $_POST['pid'];
            //echo $id;
        }

    //$query = mysql_query();
    $query = mysql_query("SELECT post_title FROM freshmart_dev.wp_posts WHERE ID = ".$pid.";);
    if(!$query){
            echo "could not update the table".mysql_error();
        }
}
*/
?>