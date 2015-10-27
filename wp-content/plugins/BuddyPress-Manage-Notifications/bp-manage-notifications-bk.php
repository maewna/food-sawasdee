<?php

/**
 * Add filter to notification table
*/ 

function bp_notifications_filter_form() {
	// Setup local variables
	$components   = bp_notifications_get_registered_components();
	$selected = '';
	

	// Check for a custom sort_order
	if ( !empty( $_REQUEST['s'] ) ) {
		if ( in_array( $_REQUEST['s'], $components ) ) {
			$selected = $_REQUEST['s'];
		}
	} ?>

	<form action="" method="get" id="notifications-filter">
		<label for="notifications-filter-list"><?php esc_html_e( 'Filter By:', 'buddypress' ); ?></label>

		<select id="notifications-filter-list" name="s" onchange="this.form.submit();">
			<option value="" <?php selected( $selected, '' ); ?>><?php _e( 'All', 'buddypress' ); ?></option>
			<?php
			foreach ($components as $component) {
			?>
				<option value="<?php echo $component; ?>" <?php selected( $selected, $component ); ?>><?php _e( $component, 'buddypress' ); ?></option>
			<?php
			}
			?>
			
		</select>

		<noscript>
			<input id="submit" type="submit" name="form-submit" class="submit" value="<?php _e( 'Go', 'buddypress' ); ?>" />
		</noscript>
	</form>

<?php
}


/**
 * Add dropdown for bluk actions
*/ 

function bp_notification_options($location) {
	global $bp;
	if ( function_exists('wp_nonce_field'))
	  wp_nonce_field('notification_nonce', 'notification_nonce');
?>

	<select name="notification-action" id="notification-select-<?php echo $location ?>">
		<option value="">Bulk Actions</option>
		<?php if ($bp->current_action == 'unread') { ?>
		<option value="read"><?php _e('Mark Read', 'buddypress') ?></option>
		<?php } elseif ($bp->current_action == 'read') { ?>
		<option value="unread"><?php _e('Mark Unread', 'buddypress') ?></option>
		<?php } ?>
		<option value="delete"><?php _e('Delete', 'buddypress') ?></option>
	</select> &nbsp;
	<input type="submit" name="" id="doaction" class="button action" value="Apply">
<?php 
}

/**
 * Add jquery to handle actions and filtering
*/ 
wp_enqueue_script("bp-manage-notifcations",plugins_url( 'bp-manage-notifications/bp-manage-notifications.js'),array("jquery"));


/**
 * do bulk actions
*/ 
add_action( 'wp_ajax_notification_actions', 'bp_notification_actions' );

function bp_notification_actions() {
	if (!wp_verify_nonce($_POST['nonce'], 'notification_nonce'))
		exit();
	
	if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) )
		return;

	if ( ! isset($_POST['notification_ids']) ||  ! isset($_POST['do_action'])) {
		echo "-1<div id='message' class='error'><p>" . __( 'There was a problem.  Try your request again.', 'buddypress' ) . '</p></div>';

	} else {
		global $bp, $wpdb;	
		if ($_POST['do_action'] == 'delete') {
			$wpdb->query( $wpdb->prepare("DELETE FROM {$bp->core->table_name_notifications} WHERE id IN ('". implode("','",$_POST['notification_ids']) . "')")  );
			echo "<p>" . __( 'Notification(s) deleted.', 'buddypress' ) . "</p>";
		} elseif ($_POST['do_action'] == 'read') {
			$wpdb->query( $wpdb->prepare("UPDATE {$bp->core->table_name_notifications} SET is_new = 0 WHERE id IN ('". implode("','",$_POST['notification_ids']) . "')")  );
			echo "<p>" . __( 'Notification(s) marked as read.', 'buddypress' ) . "</p>";
		} elseif ($_POST['do_action'] == 'unread') {
			$wpdb->query( $wpdb->prepare("UPDATE {$bp->core->table_name_notifications} SET is_new = 1 WHERE id IN ('". implode("','",$_POST['notification_ids']) . "')")  );
			echo "<p>" . __( 'Notification(s) marked as unread.', 'buddypress' ) . "</p>";	
		} else {
			echo "<p>" . __( 'We are not doing anything.', 'buddypress' ) . "</p>";
		}
	}

	exit;
}
