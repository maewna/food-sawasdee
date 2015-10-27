<?php include_once("../../../wp-config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_REQUEST['t'];?></title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/default.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/profile.css" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function(){
		$("#search_results").slideUp();
		$("#button_find").click(function(event){
		event.preventDefault();
		search_ajax_way();
	});
	$("#search_query").keyup(function(event){
		event.preventDefault();
		search_ajax_way();
	});
	
	

});

function search_ajax_way(){
	$("#search_results").show();
	var search_this = $("#search_query").val();
$.ajax({
           type: "POST",
           url: '<?php echo get_template_directory_uri(); ?>/searchuser.php',
           data: "searchit=" + search_this + "&u=<?php echo $_REQUEST['u'];?>",
           success:function(data) {
			  $("#display_results").html(data);
           }

      });
	  
	  
}
</script>
</head>
<body class="b-lightbox">

<div class="h-follow">
 	<h2 class="icon-search">ค้นหาเพื่อน</h2>
  <br class="clear"/>
</div>
<!-- End h-follow-->


<div id="search-user">
  <form id="searchform" method="post">
    <input type="text" name="search_query" id="search_query" placeholder="ค้นหาเพื่อนใน Foodsawasdee" size="76"/>
    <input type="submit" value="Search" id="button_find" />
  </form>
</div>
  <div id="display_results">
  </div><!--display_results-->

</body>
