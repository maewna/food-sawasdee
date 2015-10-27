<?php /*Template Name: Search page*/
	
	//get_header(); 
?>
<div id="searchresults">
<?php

	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
	$db = new mysqli('27.254.108.76', 'foodsawasdee', 'password@1', 'foodsawasdee');
	$db -> query("SET names utf8");
	
	//get_header(); 
?>
<?php
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			

			if(strlen($queryString) >0) {
				$query = $db->query("SELECT DISTINCT post_title, post_id,ID,guid FROM wp_posts INNER JOIN wp_postmeta 
					 ON wp_posts.ID = wp_postmeta.post_id 
					 WHERE (post_type ='bistro' OR post_type ='recipes' OR post_type ='article') 
					 AND (post_title LIKE '%" .$queryString. "%' OR meta_value LIKE '%".$queryString."%' AND post_status ='publish'  )
					 ORDER BY post_title LIMIT 10");
				$num = $query->num_rows;
							
				
				
				if($query) {
					
				if ($num == 0) {
                       	echo "<center style='padding: 18px 0 5px 0;
    font-size: 16px;'>ไม่พบข้อมูลที่ต้องการ</center><br>"; 
             
                    
				} else { 

			//echo $num;
			
			
			
			while ($result = $query ->fetch_object()){
				 $name = $result->post_title;
	         			if(strlen($name) > 100) { 
	         				$name = substr($name, 0, 100) . "...";
	         			}	         			
	
				 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $result->post_id ) ); 
                             //  echo '<img src="'.$image[0].'" width="205px" /> ';
							   
				
		
				
	         			echo '<div style="float:left; margin-left: 1px;
								margin-right: 1px;
								margin-bottom: 2px;"><a href="'.$result->guid.'" ><span class="searchheading" style="background-color: #ccc;
								width: 205px;
								height: 205px;
								"><img src="'.$image[0].'" width="205px" /></span>
								<span style="margin-left: 10px;
    width: 190px; position: absolute; margin-top: -45px; line-height:18px; color:#fff;">'.$name.'</span>
								</a></div>';
			
	} 
		
			
 ?> 
             
                
                <?php
						
	         			
	         		}
				//}
	         		
					echo '<center><div class="seperator" style="height: 30px;
    padding-top: 11px;
    text-align: center;
    display: block;"><a href="../foodsawasdee/?s='.$queryString.'">ค้นหาเพิ่มเติม</a></div></center>';
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				
			} 
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
</div>