<?php 
    /*
    Plugin Name: Promotion & Coupon
    Description: Plugin for displaying promotion and coupon for wordpress
    Author: Guide A.Jiradechprapai
    Version: 1.0.0
    Author URI: http://www.foodsawasdee.com
    */

/*------------------------Create Database-------------------------------*/
function PromotionActivate() {
	global $wpdb;

	 	// Remove for debugging
	 	$wpdb->hide_errors( );
	 	
	 	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$charset_collate = '';
	
		if ( ! empty($wpdb->charset) )
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		if ( ! empty($wpdb->collate) )
			$charset_collate .= " COLLATE $wpdb->collate";
	 	
	 	$sql = "CREATE TABLE ".$wpdb->prefix."promotion (
			ID_PR INT NOT NULL AUTO_INCREMENT,
			ID_Res INT NULL,
			email VARCHAR(100) NOT NULL,
			title VARCHAR(255) NOT NULL,
			description text NOT NULL,
			image VARCHAR(255) NOT NULL,
			discount VARCHAR(20) NOT NULL,
			percent INT(10) NOT NULL,
			start_date DATETIME NULL,
			end_date DATETIME NULL,
			PRIMARY KEY  (ID_PR)
			) $charset_collate;";

	 	dbDelta($sql);

	 	$sql = "CREATE TABLE ".$wpdb->prefix."promotion_coupon (
			ID_Coupon INT NOT NULL AUTO_INCREMENT,
			ID_Promotion BIGINT NOT NULL,
			code VARCHAR(20) NULL,
			status TINYINT(1) NOT NULL DEFAULT '0',
			PRIMARY KEY  (ID_Coupon)
			) $charset_collate;";

	 	dbDelta($sql);
	 	
	 	update_option('fse_db_version', FSE_DB_VERSION);
	 }
register_activation_hook(__FILE__,'PromotionActivate');

/*------------------------End Create Database-------------------------------*/


/*--------------------------Create Menu Admin Page-----------------------------*/
add_action( 'admin_menu', 'register_menu_page_promotion' );

	function register_menu_page_promotion() {
		add_menu_page('Promotion', 'Promotion', 'manage_options', 'promotion','my_custom_menu_page');
		add_submenu_page( 'promotion', 'Review All', 'ดูทั้งหมด', 'manage_options', 'promotion');	//Create Sub menu admin page
		add_submenu_page( 'promotion', 'Add New', 'Add New', 'manage_options', 'add-promotion','my_custom_submenu_page_callback');	//Create Sub menu admin 
		add_submenu_page( 'promotion', 'Edit', 'Edit', 'manage_options', 'edit-promotion','edit_promotion');	//Create Sub menu admin page	page	
			
	}
	
function my_custom_menu_page(){
    echo "<h1>Promotion & Coupon</h1><hr>";	
	include('FormOverview.php');
}


function my_custom_submenu_page_callback() { //Create Sub menu admin page
	
	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
	echo '<h2>เพิ่มโปรโมชั่นและส่วนลด</h2><hr>';
		include('FormInsert.php');
	echo '</div>';

}

function edit_promotion(){
		echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
	echo '<h2>แก้ไชโปรโมชั่นและส่วนลด</h2><hr>';
				include('FormUpdate.php');
	echo '</div>';


}

/*--------------------------End Create Menu Admin Page-----------------------------*/

