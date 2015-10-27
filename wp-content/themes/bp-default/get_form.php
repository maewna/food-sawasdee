<?php
    include "config.php";
    conndb();

    $province_id = $_POST['province'];
    $amphur_id = $_POST['amphur'];
    $district_id = $_POST['district'];

    $sql_1 = "SELECT * FROM province WHERE PROVINCE_ID = '$province_id' ";
    $result_1 = mysql_query($sql_1);
    $row_1 = mysql_fetch_array($result_1);
    $province_name = $row_1['PROVINCE_NAME'];

    $sql_2 = "SELECT * FROM amphur WHERE AMPHUR_ID = '$amphur_id' ";
    $result_2 = mysql_query($sql_2);
    $row_2 = mysql_fetch_array($result_2);
    $amphur_name = $row_2['AMPHUR_NAME'];

    $sql_3 = "SELECT * FROM district WHERE DISTRICT_ID = '$district_id' ";
    $result_3 = mysql_query($sql_3);
    $row_3 = mysql_fetch_array($result_3);
    $district_name = $row_3['DISTRICT_NAME'];
?>
<!DOCTYPE html>
<html>
    <body>
       
        <p>จังหวัด : <?php echo $province_name." (".$province_id.")"; ?></p>
        <p>อำเภอ : <?php echo $amphur_name." (".$amphur_id.")"; ?></p>
        <p>ตำบล : <?php echo $district_name." (".$district_id.")"; ?></p>
    </body>
</html>
