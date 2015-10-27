<?php
	include_once("../../../wp-config.php");
    header("content-type: text/html; charset=utf-8");
    header ("Expires: Wed, 21 Aug 2013 13:13:13 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    $data = $_GET['data'];
    $val = $_GET['val'];
         if ($data=='province') { 
              echo "<select name='province' onChange=\"dochange('district', this.value)\" style=\"width:275px;\">";
              echo "<option value='0'>- เลือกจังหวัด -</option>\n";
              $result=mysql_query("select * from wp_province order by PROVINCE_NAME ASC");
              while($row = mysql_fetch_array($result)){
                   echo "<option value='$row[PROVINCE_ID]' >$row[PROVINCE_NAME]</option>" ;
              }
			  echo "</select>\n";
         } else if ($data=='district') {
              echo "<select name='district' onChange=\"dochange('subdistrict', this.value)\" style=\"width:275px;\">";
              echo "<option value='0'>- เลือกเขต -</option>\n";                             
              $result=mysql_query("SELECT * FROM wp_district WHERE PROVINCE_ID= '$val' ORDER BY DISTRICT_NAME ASC");
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[DISTRICT_ID]\" >$row[DISTRICT_NAME]</option> " ;
              }
			  echo "</select>\n";
         } else if ($data=='subdistrict'){
              echo "<select name='subdistrict' onChange=\"dochange('postcode', this.value)\" style=\"width:275px;\">";
              echo "<option value='0'>- เลือกแขวง -</option>\n";
              $result=mysql_query("SELECT * FROM wp_subdistrict WHERE DISTRICT_ID= '$val' ORDER BY SUBDISTRICT_NAME ASC");
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[SUBDISTRICT_CODE]\" >$row[SUBDISTRICT_NAME]</option>" ;
              }
			  echo "</select>\n";
         }
		  
		 else if ($data=='postcode') {
				$result = mysql_query("SELECT * FROM wp_zipcode WHERE subdistrict_code='$val'");
				$row = mysql_fetch_array($result);
				echo "<input name=\"postcode\" type=\"text\" value=\"$row[zipcode]\" size=\"33\"/>";
         }
        

        echo mysql_error();
?>