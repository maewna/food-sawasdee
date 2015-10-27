<?php

$badwords = array("fuck", "kuay", "dog", "ควาย", "ควย", "เหี้ย", "ดอ");
$inputword = $_POST["inputword"];
 
if(in_array($inputword, $badwords)){
	echo "found";
}else{
	echo "not found";
}

?>