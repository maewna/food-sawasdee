<?php
/**
 * This file is part of Boot Store theme.
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class BREBootstrapEcommerceSupport {

	function __construct() {
		if ( ! function_exists( 'is_plugin_active' ) ) require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'thecartpress/TheCartPress.class.php' ) ) add_action( 'admin_menu', array( &$this, 'admin_menu' ), 50 );
		//if ( ! is_plugin_active( 'thecartpress/TheCartPress.class.php' ) ) add_action( 'admin_menu', array( &$this, 'admin_menu' ), 50 );
	}

	function admin_menu() {
		add_theme_page( __( 'Boot Store Support', 'bre-bootstrap-ecommerce' ), __( 'eCommerce Support', 'bre-bootstrap-ecommerce' ), 'edit_theme_options', 'bootstrap_ecommerce_support', array( &$this, 'admin_page' ) );
	}

	function admin_page() { ?>
		<?php screen_icon(); ?><h2><?php _e( 'eCommerce Support', 'bre-bootstrap-ecommerce' ); ?></h2>
		<?php bre_ecommerce_upgrade(); ?>
		<h2>TheCartPress eCommerce plugin support</h2>
		To enable eCommerce features you need to install <a title="eCommerce pluygin for WordPress" href="http://wordpress.org/plugins/thecartpress/" target="_blank">ThecartPress eCommerce Plugin</a>, you have 2 options to install:
		<h3>1- From your WordPress backend:</h3>
		<ul>
			<li>Plugins &gt; Add plugin</li>
			<li>Search  "thecartpress"</li>
			<li>Install the plugin</li>
			<li>Activate the plugin</li>
			<li>Re-save permalink settings (Settings &gt; permalinks)</li>
		</ul>
		<h3>2- FTP</h3>
		<ul>
		<ul>
			<li><a title="Download TheCartPress eCommerce plugin" href="http://wordpress.org/plugins/thecartpress/" target="_blank">Download TheCartPress plugin</a> from WordPress repository</li>
			<li>Upload TheCartpress E-commerce plugin to the '/wp-content/plugins/' directory</li>
			<li>Activate the plugin through the 'Plugins' menu in WordPress</li>
			<li>Re-save permalink settings (Settings &gt; permalinks)</li>
		</ul>
		</ul>
		<h4>After activating the plugin, you can start working on your store. Take a look at the widgets section, you will see there a lot of power and flexibility to develop and structure your store and site</h4>
	<?php
	}
}

new BREBootstrapEcommerceSupport();
