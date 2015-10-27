<?php
/*
 *Plugin Name: BuddyPress Manage Notifications
 * Plugin URI: https://github.com/colabsadmin/BuddyPress-Manage-Notifications/
 * Version: 1.1
 * Description: Adds filtering and mass actions to notification list
 * Author: ColabsAdmin
 * Author URI: https://github.com/colabsadmin/
 * License: GPL
 * Last Modified: March 17, 2014
 * 
 * */
 
/* Only load code that needs BuddyPress to run once BP is loaded and initialized. */
function bp_manage_notifications_init() {
    require( dirname( __FILE__ ) . '/bp-manage-notifications.php' );
}
add_action( 'bp_include', 'bp_manage_notifications_init' );
 
/* If you have code that does not need BuddyPress to run, then add it here. */
?>
