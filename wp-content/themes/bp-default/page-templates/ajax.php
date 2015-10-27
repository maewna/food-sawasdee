<?php /*Template Name: Ajax notifaction Page */ ?>
<?php
//require_once('../../../../../../wp-config.php');
$offset = is_numeric($_POST['offset']);
$postnumbers = is_numeric($_POST['number']);

?>

<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>
		<?php $postnumbers >= $offset ; 
			echo '<tr>
            	<td></td>
                <td style="padding: 8px 0px;"><input id="'.bp_the_notification_id().'" type="checkbox" name="notifications[]" value="'.bp_the_notification_id().'" class="notification-check"></td>
				<td class="notify-text">

	"'.bp_the_notification_description().'"

</td>
				<td class="notify-date" style="font-family: supermarket;">"'.bp_the_notification_time_since().'"</td>
				<td class="notify-actions">"'.bp_the_notification_action_links().'"</td>
			</tr>';
		  $postnumbers + 1 ;?>
	<?php endwhile; ?>


