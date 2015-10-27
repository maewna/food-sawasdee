<?php 
require_once('../../../wp-config.php');
global $wpdb;
?>
<?php
if(isset($_FILES["file"]["type"]))  
{
    $validextensions = array("jpeg", "jpg", "png" , "gif");
    $temporary = explode(".", $_FILES["file"]["name"]); 
    $file_extension = end($temporary);

    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpeg")
            ) && ($_FILES["file"]["size"] < 10000000)//Approx. 10000kb files can be uploaded.
            && in_array($file_extension, $validextensions)) 
	{

        if ($_FILES["file"]["error"] > 0)
		{
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } 
		else 
		{ 
				if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span><br>";
				} 
				else 
				{					
					$sourcePath = $_FILES['file']['tmp_name'];   // Storing source path of the file in a variable
					$targetPath = "upload/".$_FILES['file']['name'];  // Target path where file is to be stored
					move_uploaded_file($sourcePath,$targetPath) ; //  Moving Uploaded file						
					
					/*echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
					echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
					echo "<img src= ".$targetPath.">";
					echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
					echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";*/
						
				}				       
        }        
    }   
	else 
	{
        echo "<span id='invalid'>***Invalid file Size or Type***<span><br>";
    }
}
?>
<?php
$_POST['action'] == 'show';
$_POST["dateStart"]= strtotime($_POST["dateStart"]);
$start = date("Y-m-d H:i:s", $_POST["dateStart"]);

$_POST["dateEnd"]= strtotime($_POST["dateEnd"]);
$end = date("Y-m-d H:i:s", $_POST["dateEnd"]);

		$strSQL = "INSERT INTO wp_promotion";
		$strSQL .="(ID_PR,ID_Res,email,title,description,image,discount,percent,start_date,end_date,conditions)";
		$strSQL .="VALUES ";
		$strSQL .="('','".$_POST["bisto"]."','".$_POST["email"]."' ";
		$strSQL .=",'".$_POST["title"]."','".$_POST["description"]."','".$targetPath."','".$_POST["promotion"]."','".$_POST["discount-per"]."','".$start."',
				  '".$end."','".$_POST["condition"]."') ";
		$objQuery = mysql_query($strSQL);
		$id_from_tb_1 = mysql_insert_id();

		/*echo $_POST['bisto']."<br/>";
		echo $_POST['email']."<br/>";
		echo $_POST['promotion']."<br/>";
		echo "<img src=/wp-content/plugins/promotion/".$targetPath."><br/>";
		echo $start."<br/>";
		echo $end."<br/>";
		echo "<hr><br/>";*/
		
		$passes = array();
 	$chars = "abcdefghkmnopqrstuvwxyz023456789";
	srand((double)microtime()*1000000);
	$amount = $_POST['code'];
	$chartext = $_POST['txt'];
	$count = $_POST['count'];
	for($j=0; $j<$amount; $j++)
	{

		 $i = 0; $pass = '' ;
		 while ($i <= $length)
		 { $num = rand() % 33; $tmp = substr($chars, $num, 1);
		 $pass = $pass . $tmp; $i++;
		 }
		 $passes[] = $pass;
        }

	foreach($passes as $password)
	{
		$coupon = $chartext.strtoupper(substr(md5($password),0,$count));
		$sql = "INSERT INTO wp_promotion_coupon";
		$sql .="(ID_Coupon,ID_Promotion,code,status)";
		$sql .="VALUES ";
		$sql .="('','". $id_from_tb_1 ."','".$coupon."','0') ";
		$query = mysql_query($sql);

	
		echo $coupon."<br />";
		
	} 
	echo "<br>";
	echo "ข้อมูลได้ทำการบันทึกเรียบร้อยแล้ว";
?>






