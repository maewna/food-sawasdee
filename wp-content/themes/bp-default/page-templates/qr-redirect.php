<?php
/**
 * Template Name: QR Redirect Page
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Boot Store consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */
 ?>

<?php
$room = $_REQUEST['room'];
if($room=='casualBistro'){
?>
	<meta http-equiv="refresh" content="0; url=https://www.google.co.th/search?q=casual+bistro&espv=2&biw=1280&bih=642&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAmoVChMIztK8hOOVxgIVQX68Ch0XeAC9" />
<?php
}else if($room=='gastroPub'){
?>
	<meta http-equiv="refresh" content="0; url=https://www.google.co.th/search?q=gastro+pub&espv=2&biw=1280&bih=642&source=lnms&tbm=isch&sa=X&ved=0CAcQ_AUoAmoVChMIlaa61uOVxgIVhTK8Ch0ohQBe" />
<?php 
}else if($room=='gardenCafe'){ ?>
	<meta http-equiv="refresh" content="0; url=https://www.google.co.th/search?q=garden+cafe&espv=2&biw=1280&bih=642&source=lnms&tbm=isch&sa=X&ved=0CAYQ_AUoAWoVChMI4-y7zeOVxgIVx3y8Ch32ZAAd" />
<?php 
}else{?>
	<meta http-equiv="refresh" content="0; url=http://foodsawasdee.cpf.co.th/" />
<?php } ?>