
<?php
/**
 * Template Name: test jQuery
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
<?php

echo "test jQuery";
echo "<br/>============================<br/>";

?>




<script type="text/javascript">
/*
$("body").on('change', '#reservList', function() {
    //get the selected value
    var selectedValue = $(this).val();

    //make the ajax call
    $.ajax({
        url: 'ajax-query.php?id='+selectedValue,
        //type: 'POST',
        //data: {option : selectedValue},
        success: function(data) {
			alert('yes');
            $("#title").html(data);
        }
    });
});

*/

/*
    function ajaxfunction(pid)
    {
	alert(pid);
        $.ajax({
            url: 'ajax-query.php?pid=' + pid;
            success: function(data) {
				alert('yes');
                $("#title").html(data);
            }
        });
    }
*/


</script>
<?php

global $wpdb;

$results_pid = $wpdb->get_results ( "
    SELECT * FROM freshmart_dev.wp_posts
	WHERE post_type = 'bistro' AND post_status = 'publish';
" );


?>


<!-- HTML Structure -->
<form name="reservations" method="post">
    <select id="reservList" onChange="ajaxfunction(this.value)" >  
		<option>choose bistro</option>
		<?php
		foreach ( $results_pid as $res_pid)
		{
			echo '<option value="'.$res_pid->ID.'">'.$res_pid->ID.'</option>';
			
		}
		?>
    </select>
</form>
    <br />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">

/*
$("#reservList").change(function() {
  alert( "Handler for .change() called." );
});

*/

function ajaxfunction(pid)
    {
	//alert(pid);
	 $.ajax({
      type:"POST",
      url: "<?php echo get_template_directory_uri(); ?>/page-templates/test-jquery-query.php",
      data: { pid: pid},
      success: function(data){
       $("#title").html(data);
	   }
      });
    }
	
  //alert('9999999999'); // or $(this).val()

</script>
	



<div id="title"></div>
