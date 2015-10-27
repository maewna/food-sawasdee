<?php include_once("../../../wp-config.php"); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form Report</title>
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function() {
			$('input[name="permalink"]').val('<?php echo $_REQUEST['pmlink'];?>');
			 $('input[name="bistroName"]').val('<?php echo $_REQUEST['bistroName'];?>');
			 $('input[name="reporter"]').val('<?php echo $_REQUEST['reporter'];?>');
			 $('input[name="email"]').val('<?php echo $_REQUEST['email'];?>');
			 
			 
	$(".resSubmit").click(function() {
		
		var reporter = document.getElementById('reporter').value;
		if(reporter==''){
			document.getElementById("rq_reporter").innerHTML = "กรุณาลองใหม่อีกครั้ง";
			return false;
		}
		var email = document.getElementById('email').value;
		if(email==''){
			document.getElementById("rq_email").innerHTML = "กรุณาลองใหม่อีกครั้ง";
			return false;
		}
		var reportType = document.getElementById("reportType");
		var selectedValue = reportType.options[reportType.selectedIndex].value;
		if(selectedValue==''){
			document.getElementById("rq_reportType").innerHTML = "* กรุณาเลือกประเภท";
			return false;
		}
		var detail = document.getElementById('detail').value;
		if(detail==''){
			document.getElementById("rq_reportType").innerHTML = "";
			document.getElementById("rq_detail").innerHTML = "* กรุณากรอกคำอธิบาย";
			return false;
		}
		//$("#reportDetail2").fancybox();
		//$("#reportDetail").style.display="none";
		//$("#reportDetail2").style.display="block";
		
		//setTimeout(parent.$.colorbox.close, 1500);
		//$(".detailLeft").style.display="none";
		//$(".detailRight").style.display="none";
		//parent.$.colorbox({innerWidth:'360',innerHeight:'190',href:"<?php //echo get_template_directory_uri(); ?>/reportThanks.php"});
		//parent.$.colorbox.close();
		return true;
	});
			 
			 
	});
	
</script>
<style>
html{
	background-color:white;
	font-family:supermarket;
}
body{
    margin: 0 !important;
}
.rePortContainer{
	width:550px;
	height:350px;
	background-image:url(<?php echo get_template_directory_uri(); ?>/_inc/images/bg_reviewtitle.png);
	background-repeat:repeat;	
	padding-top:16px;
}
#reportDetail,#reportDetail2{
	margin:20px auto;
	width:450px;
	height:250px;
	border:1px solid #dddddd;
	border-radius:5px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	padding:20px 15px;
	background-color:white;
}

.resTitle{
	width:100%;
	height:40px;
	font-family:supermarket;
	font-size:24px;
	color:#3f9b43;
	padding-bottom:15px;
	padding-left:5px;
}
.resSubmit{
	background: url("<?php echo get_template_directory_uri(); ?>/_inc/images/ok.png") no-repeat scroll 0 0 transparent;
	 color: #000;
    color: rgba(0, 0, 0,0);
	cursor: pointer;
	height: 32px;
	padding-bottom: 2px;
	width: 80px;
	border:0px;
}
.reserveBtn{
	float:right;
	padding-right: 40px;
    padding-top: 40px;
}
div.wpcf7 div.wpcf7-response-output,
div.wpcf7 div.wpcf7-validation-errors {
	color: red;
	text-align:center;
	padding-top: 30px;
}
button#cboxClose {
	background: url('<?php echo get_template_directory_uri(); ?>/_inc/images/closeReserve.png') no-repeat -2px 0 !important;
	
}
select, option { width: 255px; }
</style>
<body>

<div class="rePortContainer">
	<div id="reportDetail">
   	  <div class="resTitle">แจ้งเปิดร้านซ้ำ/ปิดกิจการ </div>
      <div >
		<?php echo do_shortcode('[contact-form-7 id="1973" title="Report Duplicate Bistro"]');?>
	  </div>
    </div>
</div>
</body>
</html>