<!--<html>
 <head>
  <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
 </head>
 <body>
  <script language="Javascript"> 
	lat = geoplugin_latitude()-0.024609;
	lon = parseFloat(0.032176) + parseFloat(geoplugin_longitude());
    document.write("Latitude : "+lat+", Logitude : "+lon); 
  </script>
 </body>
</html>-->
<?php
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARTDED_FOR'] != '') {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip_address = $_SERVER['REMOTE_ADDR'];
}
echo $ip_address;
?>