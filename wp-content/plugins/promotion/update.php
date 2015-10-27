<?php 
require_once('../../../wp-config.php');
global $wpdb;
$id = $_GET["id"];
?>
<html>
<head>
<meta http-equiv="refresh" content="0; URL=/wp-admin/admin.php?page=edit-promotion&id=<?php echo $id ;?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Random Password Generator</title>
</head>
<body>
<?php

$_POST["dateStart"]= strtotime($_POST["dateStart"]);
$start = date("Y-m-d H:i:s", $_POST["dateStart"]);

$_POST["dateEnd"]= strtotime($_POST["dateEnd"]);
$end = date("Y-m-d H:i:s", $_POST["dateEnd"]);

if($_FILES["file"]["name"] != "")
	{
		if(copy($_FILES["file"]["tmp_name"],"upload/".$_FILES["file"]["name"]))
		{

			//*** Delete Old File ***//			
			@unlink("upload/".$_POST["hdnOldFile"]);
			
			//*** Update New File ***//

		$strSQL_file = "UPDATE wp_promotion";
		$strSQL_file .=" SET email='".$_POST["email"]."', title='".$_POST["title"]."',  description='".$_POST["description"]."', image='upload/".$_FILES["file"]["name"]."',
					 discount='".$_POST["promotion"]."', percent='".$_POST["discount-per"]."', start_date='".$start."', end_date='".$end."', conditions = '".$_POST["condition"]."'  
					  WHERE ID_PR = ".$_POST["id_bistro"]."";
		$objQuery_file = mysql_query($strSQL_file);
		echo "Upload Complete<br>";

		}
	}	
	
	$strSQL = "UPDATE wp_promotion";
		 $strSQL .=" SET email='".$_POST["email"]."', title='".$_POST["title"]."',  description='".$_POST["description"]."',
					 discount='".$_POST["promotion"]."', percent='".$_POST["discount-per"]."', start_date='".$start."', end_date='".$end."',
					 conditions='".$_POST["condition"]."' WHERE ID_PR = '".$_POST["id_bistro"]."' ";
		$objQuery = mysql_query($strSQL);
	
?>
</body>
</html>