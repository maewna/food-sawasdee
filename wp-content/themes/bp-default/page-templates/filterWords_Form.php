<?php
/**
 * Template Name: TEST filter words
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 ?>

<!-- 
<title>Insert title here</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#check").click(function(){
			$.ajax({
					url: "<?php echo get_template_directory_uri(); ?>/page-templates/filterWords.php",
					data: {inputword : $("#inputword").val()},
					success: function(ret){
						if(ret=="found"){
							alert("Ban");
						}else{
							alert("Un ban");
						}
					},
					type: "POST"
			});
		});
	});
</script>
</head>
<body>
	<form action="">
		<input type="text" name="inputword" id="inputword">
		<input type="button" id="check" value="Check" />
	</form>
</body>

-->

<?php

$text = "ไอ้ปลานิล";

$word_cut = array("ไอ้","อี","มึง","กู","สัด","ตีน","สันดาน","พ่อ","แม่ง","ควย","เหี้ย","ตอแหล","หี","เฮ็ง","ซวย","เย็ด","ง่าว");
$replace = "***";
for ($i=0 ; $i<sizeof($word_cut) ; $i++) {
$charactest= eregi_replace($word_cut[$i],$replace,$text);
}
echo $text;

?>