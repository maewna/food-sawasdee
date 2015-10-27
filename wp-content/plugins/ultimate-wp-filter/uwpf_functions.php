<?php

	function uwpf_delete_plugin() {
		delete_option('uwpf_options');
	}
	
	function uwpf_init(){
		register_setting( 'uwpf_plugin_options', 'uwpf_options', 'uwpf_validate' );
	}
	
	function requires_wordpress_version() {
		global $wp_version;
		$plugin = plugin_basename( __FILE__ );
		$plugin_data = get_plugin_data( __FILE__, false );

		if ( version_compare($wp_version, "2.9", "<" ) ) {
			if( is_plugin_active($plugin) ) {
				deactivate_plugins( $plugin );
				wp_die( "'".$plugin_data['Name']."' requires WordPress 2.9 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>." );
			}
		}
	}	
?>