<?php include_once("../../../wp-config.php"); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
$currentUser = wp_get_current_user();
$currentUsername = $currentUser->user_login;

?>
<script type="text/javascript">
	$(document).ready(function() {
			 $('input[name="bistroEmail"]').val('<?php echo $_REQUEST['bistroEmail'];?>');
			 $('input[name="bistroName"]').val('<?php echo $_REQUEST['bistroTitle'];?>');
			 $('input[name="loginName"]').val('<?php echo $currentUsername;?>');
			 $('input[name="bistroLink"]').val(document.URL);
	});
	
	$( "#resSubmit" ).click(function() {
		var loginName = '<?php echo $currentUsername;?>';
		var bistroName= '<?php echo $_REQUEST['bistroTitle'];?>';
		var bistroEmail= '<?php echo $_REQUEST['bistroEmail'];?>';
		var reserveName = $('input[name="reserveName"]').val();
		var reserveTel= $('input[name="reserveTel"]').val();
		var reserveDate= $('input[name="reserveDate"]').val();
		var reserveHour= $('input[name="reserveHour"]').val();
		var reserveMin= $('input[name="reserveMin"]').val();
		var reserveAmount= $('input[name="reserveAmount"]').val();
		var reserveNo= $('input[name="reserveNo"]').val();
		
		if (loginName=="") {
			alert('กรุณาเข้าสู่ระบบ');
			return false;
			
		}
		if (bistroName=="") {
			alert('กรุณาเลือกร้านอีกครั้ง');
			return false;
		}
		if (bistroEmail=="") {
			alert('ร้านนี้ไม่รับจองโต๊ะ');
			return false;
		}
		if (reserveName=="") {
			$("#reserveName").focus();
			//$("#reserveName").css('border', '1px solid #ff0014');
			
			return false;
		}
		if (reserveTel=="") {
			$("#reserveTel").focus();
			return false;
		}
		if (reserveDate=="") {
			$("#reserveDate").focus();
			return false;
		}
		if (reserveHour=="") {
			$("#reserveHour").focus();
			return false;
		}
		if (reserveMin=="") {
			$("#reserveMin").focus();
			return false;
		}
		if (reserveAmount=="") {
			$("#reserveAmount").focus();
			return false;
		}
		if (reserveNo=="") {
			$("#reserveNo").focus();
			return false;
		}
		
	});
</script>
<style>
.reserveContainer{
	width:775px;
	height:475px;
	background-image:url(<?php echo get_template_directory_uri(); ?>/_inc/images/bg_reviewtitle.png);
	background-repeat:repeat;	
	padding-top:40px;
}
.reserveDetail{
	margin:auto;
	width:700px;
	height:370px;
	border:1px solid #dddddd;
	border-radius:5px;
	padding:20px;
	background-color:white;
}

.resTitle{
	width:100%;
	height:50px;
	font-family:supermarket;
	font-size:28px;
	color:#3f9b43;
}
.resLeft{
	width:54%;
	height:100px;
	float:left;
}
.resRight{
	width:40%;
	height:100px;
	float:left;
	padding-left:30px;
}
.resSubmit{
	background: url("<?php echo get_template_directory_uri(); ?>/_inc/images/reserveBtn2.png") no-repeat scroll 0 0 transparent;
	 color: #000;
    color: rgba(0, 0, 0,0);
	cursor: pointer;
	height: 50px;
	padding-bottom: 2px;
	width: 124px;
	border:0px;
}
.reserveBtn{
	float:right;
}
.fancybox-macort{
	display:none;
}
.fancybox-inner{
	width:775px !important;
	height:475px !important;
}
.fancybox-skin{
	width:775px !important;
}
</style>
<body>
<?php
$bistroId = $_REQUEST['bistroId'];
$bistroTitle = $_REQUEST['bistroTitle'];
$bistroEmail = $_REQUEST['bistroEmail'];
$bistroTableImg = $_REQUEST['bistroTableImg'];
$bistroType = $_REQUEST['bistroType'];
?>

<!-- ppk added -->


<div class="reserveContainer">
	<div class="reserveDetail">
   	  <div class="resTitle">แจ้งจองโต๊ะ ร้าน <?php echo $bistroTitle;?>
	  <!--<div class="resTitle">แจ้งจองโต๊ะ ร้าน-->
      
		<?php if($bistroType=='ร้านหลายสาขา'){?>
        <?php
        
        global $wpdb;
        
        $results_pid = $wpdb->get_results ( "
            SELECT * FROM freshmart_dev.wp_posts
            WHERE post_type = 'bistro' AND post_status = 'publish';
        " );
        
        
        ?>
		<!-- <form name="reservations" method="post">
        
			<select id="reservList" onChange="ajaxfunction(this.value)" >  
				<option>choose bistro</option>
				<?php
				/*foreach ( $results_pid as $res_pid)
				{
					echo '<option value="'.$res_pid->ID.'">'.$res_pid->ID.'</option>';
					
				}*/
				?>
			</select>
		</form> -->
        <?php } // end if ร้านหลายสาขา?>
</div>

<!-- ajax -->

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">

$("#reservList").change(function() {
  alert( "Handler for .change() called." );
});


function ajaxfunction(pid)
    {
	//alert(pid);
	 $.ajax({
      type:"POST",
      url: "<?php //echo get_template_directory_uri(); ?>/page-templates/test-jquery-query.php",
      data: { pid: pid},
      success: function(data){
       $("#title").html(data);
	   }
      });
    }
	
  //alert('9999999999'); // or $(this).val()

</script>-->

<!-- ppk end-->
    	<div class="resLeft"><div id="title"></div><img src="<?php echo $bistroTableImg;?>" width="374" height="307" /></div>
      	<div class="resRight">
			<?php echo do_shortcode('[contact-form-7 id="1133" title="Reservation Form"]');?>
	  	</div>
    </div>
    </div>
</body>
</html>