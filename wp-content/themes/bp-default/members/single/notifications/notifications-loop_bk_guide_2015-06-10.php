<table class="notifications">
	<thead>
		<tr>
        	<th class="noti-icon"></th>
        	<th style="padding: 8px 0px;"><input id="select-all" type="checkbox"></th>
			<th class="title"><span style="  font-family: supermarket;font-weight: normal;font-size: 16px;">เลือกทั้งหมด</span></th>
			<th class="date"></th>
			<th class="actions">
				<div class="notification-options-nav">
					<?php bp_notification_options('top'); ?> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/profile/delete-all-non.png">
				</div><!-- .notification-options-nav -->
			</th>
		</tr>
	</thead>
	<tbody>

		<?php while ( bp_the_notifications() ) : bp_the_notification(); ?>
				
			<tr>
            	<td></td>
                <td style="padding: 8px 0px;"><input id="<?php bp_the_notification_id(); ?>" type="checkbox" name="notifications[]" value="<?php bp_the_notification_id(); ?>" class="notification-check"></td>
				<td class="notify-text"> 
			<?php bp_notifications_unread_permalink( );?>
			<?php bp_the_notification_mark_read_link(); ?>
			<?php  bp_the_notification_description(); ?>
			</td>
				<td class="notify-date" style="font-family: supermarket;"><?php bp_the_notification_time_since();   ?></td>
				<td class="notify-actions"><?php bp_the_notification_action_links(); ?></td>
			</tr>

		<?php endwhile; ?>

	</tbody>
</table>
