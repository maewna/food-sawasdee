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

class BREBootstrapEcommerceSetup {

	function __construct() {
		add_action( 'admin_menu', array( &$this, 'admin_menu' ), 50 );
	}

	function admin_menu() {
		$page = add_theme_page( __( 'Boot Store options', 'bre-bootstrap-ecommerce' ), __( 'Boot Store', 'bre-bootstrap-ecommerce' ), 'edit_theme_options', 'bootstrap_ecommerce_settings', array( &$this, 'admin_page' ) );
		add_action( "load-$page", array( &$this, 'admin_action' ) );
	}

	function admin_page() {
		$bre_primary_menu				= get_option( 'bre_primary_menu', '' );
		$bre_primary_menu_transparent	= get_option( 'bre_primary_menu_transparent', true );
		$bre_secondary_menu				= get_option( 'bre_secondary_menu', 'navbar-inverse' );
		$bre_secondary_menu_transparent	= get_option( 'bre_secondary_menu_transparent', false );
		$bre_label_one					= get_option( 'bre_label_one', __( 'Label one', 'bre-bootstrap-ecommerce' ) );
		$bre_label_two					= get_option( 'bre_label_two', __( 'Label two', 'bre-bootstrap-ecommerce' ) );
		$bre_label_three				= get_option( 'bre_label_three', __( 'Label three', 'bre-bootstrap-ecommerce' ) );
		$bre_sidebar_style				= get_option( 'bre_sidebar_style', false );
		$bre_layout						= get_option( 'bre_layout', 'content-sidebar' );
		$bre_carousel_hide				= get_option( 'bre_carousel_hide', false );
		$bre_carousel_excerpt_length	= get_option( 'bre_carousel_excerpt_length', 50 );
		$bre_carousel_hide_more_details = get_option( 'bre_carousel_hide_more_details', false );
		$bre_carousel_opacity			= get_option( 'bre_carousel_opacity', 0.6 );
		$bre_site_description_hide		= get_option( 'bre_site_description_hide', false );
	?>
<div class="wrap">
	<?php screen_icon(); ?><h2><?php _e( 'Theme options', 'bre-bootstrap-ecommerce' ); ?></h2>

	<?php bre_ecommerce_upgrade(); ?>
	
	<?php if ( ! empty( $this->updated ) ) : ?>
		<div id="message" class="updated">
		<p><?php _e( 'Settings updated', 'bre-bootstrap-ecommerce' ); ?></p>
		</div>
	<?php endif; ?>

	<div class="clear"></div>

	<form method="post" enctype="multipart/form-data">
	<?php submit_button( null, 'primary', 'save-bootstrap_ecommerce_logo-settings' ); ?>

	<h3><?php _e( 'Logo', 'bre-bootstrap-ecommerce' ); ?></h3>
	<p class="description"><?php _e( 'Image logo replaces the site title text. Be careful with the size of your logo.', 'bre-bootstrap-ecommerce' ); ?><p>
	<div class="postbox">
		<div class="inside">
			<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="bre_image_logo"><?php _e( 'Select Image', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<?php $url = get_option( 'bre_image_logo', false );
					if ( $url !== false ) : $url = $url['url']; ?>
					<img src="<?php echo $url; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					<br/>
					<input type="submit" name="remove_bootstrap_logo" value="<?php _e( 'Remove logo', 'bre-bootstrap-ecommerce' ); ?>" class="btn"/>
					<?php endif; ?>
					<br/>
					<label for="bre_image_logo"><?php _e( 'Choose an image from your computer:', 'bre-bootstrap-ecommerce' ); ?></label>
					<br/>
					<input type="file" name="bre_image_logo" id="bre_image_logo"/>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_site_description_hide"><?php _e( 'Hide Site Description', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="bre_site_description_hide" id="bre_site_description_hide" value="yes" <?php checked( $bre_site_description_hide ); ?>/>
				</td>
			</tr>
			</tbody>
			</table>
		</div><!-- .inside -->
	</div><!-- .postbox -->

	<h3><?php _e( 'Layout', 'bre-bootstrap-ecommerce' ); ?></h3>
	<p class="description"><?php _e( 'If you do not assign widgets to sidebars you will see one column layout', 'bre-bootstrap-ecommerce' ); ?><p>
	<div class="postbox">
		<div class="inside">
			<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="bre_layout"><?php _e( 'Layout', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<div style="display: inline-block; margin-right: 2em;">
						<input type="radio" name="bre_layout" id="bre_layout_content_sidebar" value="content-sidebar" <?php checked( $bre_layout, 'content-sidebar' ); ?> />
						<?php _e( 'Sidebar on right', 'bre-bootstrap-ecommerce' ); ?>
						<br/>
						<img src="<?php echo get_template_directory_uri(); ?>/images/content-sidebar.png" style="vertical-align: top;margin-left: 1em;"/>
					</div>
					<div style="display: inline-block">
						<input type="radio" name="bre_layout" id="bre_layout_sidebar_content" value="sidebar-content" <?php checked( $bre_layout, 'sidebar-content' ); ?> />
						<?php _e( 'Sidebar on left', 'bre-bootstrap-ecommerce' ); ?>
						<br/>
						<img src="<?php echo get_template_directory_uri(); ?>/images/sidebar-content.png" style="vertical-align: top;margin-left: 1em;"/>
					</div>
				</td>
			</tr>
			</tbody>
			</table>
		</div><!-- .inside -->
	</div><!-- .postbox -->

	<h3><?php _e( 'Menus', 'bre-bootstrap-ecommerce' ); ?></h3>
	<p class="description"><?php _e( 'To use these options you need to have WordPress menus defined. And don\'t forget to assign the menus to theme locations. (Appearance > menu)', 'bre-bootstrap-ecommerce' ); ?><p>
	<div class="postbox">
		<div class="inside">
			<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="bre_primary_menu"><?php _e( 'Primary top menu', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<select name="bre_primary_menu" id="bre_primary_menu">
						<option value="navbar-inverse" <?php selected( 'navbar-inverse', $bre_primary_menu ); ?>><?php _e( 'Dark', 'bre-bootstrap-ecommerce' ); ?></option>
						<option value="" <?php selected( '', $bre_primary_menu ); ?>><?php _e( 'Light', 'bre-bootstrap-ecommerce' ); ?></option>
					</select>
					<label><?php _e( 'Transparent', 'bre-bootstrap-ecommerce' ); ?>: <input type="checkbox" name="bre_primary_menu_transparent" <?php checked( $bre_primary_menu_transparent ); ?> /></label>
				</td>
			</tr>
			<tr>
				<th>
					<label for="bre_secondary_menu"><?php _e( 'Secondary top menu', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<select name="bre_secondary_menu" id="bre_secondary_menu">
						<option value="navbar-inverse" <?php selected( 'navbar-inverse', $bre_secondary_menu ); ?>><?php _e( 'Dark', 'bre-bootstrap-ecommerce' ); ?></option>
						<option value="" <?php selected( '', $bre_secondary_menu ); ?>><?php _e( 'Light', 'bre-bootstrap-ecommerce' ); ?></option>
					</select>
					<label><?php _e( 'Transparent', 'bre-bootstrap-ecommerce' ); ?>: <input type="checkbox" name="bre_secondary_menu_transparent" <?php checked( $bre_secondary_menu_transparent ); ?> /></label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_sidebar_style"><?php _e( 'Sidebar menus', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="bre_sidebar_style" id="bre_sidebar_style" value="yes" <?php checked( $bre_sidebar_style ); ?> />
					<span class="description"><?php _e( 'Apply special styles to sidebar Navigation Trees, WordPress Menus, etc.', 'bre-bootstrap-ecommerce' ); ?></span>
				</td>
			</tr>
			</tbody>
			</table>
		</div><!-- .inside -->
	</div><!-- .postbox -->

	<h3><?php _e( 'Titles for Product Detail Tabs', 'bre-bootstrap-ecommerce' ); ?></h3>
	<p class="description"><?php printf( __( 'This tabs are for additional content in single product detail page. You can add content to each tab managing the different <a href="%swidgets.php">widgetizable areas</a>', 'bre-bootstrap-ecommerce' ), get_admin_url() ); ?><p>
	<div class="postbox">
		<div class="inside">
			<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="bre_label_one"><?php _e( 'Label One', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="text" name="bre_label_one" id="bre_label_one" value="<?php echo $bre_label_one; ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_label_two"><?php _e( 'Label Two', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="text" name="bre_label_two" id="bre_label_two" value="<?php echo $bre_label_two; ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_label_three"><?php _e( 'Label Three', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="text" name="bre_label_three" id="bre_label_three" value="<?php echo $bre_label_three; ?>" />
				</td>
			</tr>
			</table>
		</div><!-- .inside -->
	</div><!-- .postbox -->
	
	<h3><?php _e( 'Carousel Setup', 'bre-bootstrap-ecommerce' ); ?></h3>
	<p class="description"><?php _e( 'Carousel can be displayed or not in front page. When you use full-width-carousel.php template the carousel always will be visible if it has items', 'bre-bootstrap-ecommerce' ); ?><p>
	<div class="postbox">
		<div class="inside">
			<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="bre_carousel_hide"><?php _e( 'Hide Carousel in front page', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="bre_carousel_hide" id="bre_carousel_hide" value="yes" <?php checked( $bre_carousel_hide ); ?> />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_carousel_opacity"><?php _e( 'Opacity', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="number" min="0" max="1" step="0.1" name="bre_carousel_opacity" id="bre_carousel_opacity" value="<?php echo $bre_carousel_opacity; ?>">
					<span class="description"><?php _e( 'Number between 0 and 1, where 0 is transparent and 1 is total opacity.', 'bre-bootstrap-ecommerce' ); ?></span>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_carousel_excerpt_length"><?php _e( 'Excerpt length', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="number" min="0" step="1" name="bre_carousel_excerpt_length" id="bre_carousel_excerpt_length" value="<?php echo $bre_carousel_excerpt_length; ?>">
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="bre_carousel_hide_more_details"><?php _e( 'Hide More details button', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="bre_carousel_hide_more_details" id="bre_carousel_hide_more_details" value="yes" <?php checked( $bre_carousel_hide_more_details ); ?> />
				</td>
			</tr>
			</table>
		</div><!-- .inside -->
	</div><!-- .postbox -->

	<div class="postbox">
		<div class="inside">
			<table class="form-table">
			<tbody>
			<?php $hide_home_shortcuts = get_option( 'bre_hide_home_shortcuts', false ); ?>
			<tr valign="top">
				<th scope="row">
					<label for="hide_home_shortcuts"><?php _e( 'Hide 3 Shortcuts', 'bre-bootstrap-ecommerce' ); ?></label>
				</th>
				<td>
					<input type="checkbox" name="hide_home_shortcuts" value="yes" <?php checked( $hide_home_shortcuts ); ?> />
					<span class="description">
			<?php _e( 'The 3 box shortcuts appears in front page. Also you can display them wherever you want using [3boxes] shortcode', 'bre-bootstrap-ecommerce' ); ?><br />
			<?php _e( 'Recommended image width: 350px', 'bre-bootstrap-ecommerce' ); ?></span>
				</td>
			</tr>
			</tbody>
			</table>
		</div><!-- .inside -->
	</div><!-- .postbox -->
		<h2><?php _e( 'Shortcuts, 3 Cols', 'bre-bootstrap-ecommerce' ); ?></h2>
		<h3><?php _e( 'Left Box', 'bre-bootstrap-ecommerce' ); ?></h3>
		<div class="postbox">
			<div class="inside">
				<table class="form-table">
				<tbody>
				<?php $url = get_option( 'bre_image_a', false );
				if ( $url !== false ) $url = $url['url'];
				if ( strlen( $url ) ) : ?>
				<tr valign="top">
					<th scope="row">
						<label for="bre_url_a"><?php _e( 'Current image', 'bre-bootstrap-ecommerce' ); ?></label>
					</th>
					<td>
						<img src="<?php echo $url; ?>" alt="<?php echo $url; ?>" width="325px" />
						<br/><input type="submit" name="save-pagina_home-remove_image_a" value="<?php _e( 'Remove file', 'bre-bootstrap-ecommerce' ); ?>" />
					</td>
				</tr>
				<?php endif; ?>
				<tr valign="top">
					<th scope="row">
						<label>link:</label>
					</th>
					<td>
						<input type="text" name="bre_url_a" id="bre_url_a" value="<?php echo get_option( 'bre_url_a', '' ); ?>" size="40" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label>New image:</label>
					</th>
					<td>
						<input type="file" name="bre_image_a" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Title', 'bre-bootstrap-ecommerce' ); ?>:</label>
					</th>
					<td>
						<input type="text" name="bre_label_a" value="<?php echo stripslashes( get_option( 'bre_label_a', '' ) ); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Description', 'bre-bootstrap-ecommerce' ); ?>:</label>
					<td>
						<textarea name="bre_description_a" cols="80" rows="5"><?php echo stripslashes( get_option( 'bre_description_a', '' ) ); ?></textarea>
					</td>
				</tr>
				</tbody>
				</table>
			</div><!-- .inside -->
		</div><!-- .postbox -->

		<h3><?php _e( 'Center Box', 'bre-bootstrap-ecommerce' ); ?></h3>

		<div class="postbox">
			<div class="inside">
				<table class="form-table">
				<tbody>
				<?php $url = get_option( 'bre_image_b', false );
				if ( $url !== false ) $url = $url['url'];
				if ( strlen( $url ) ) : ?>
				<tr valign="top">
					<th scope="row">
						<label for="bre_url_b"><?php _e( 'Current image', 'bre-bootstrap-ecommerce' ); ?></label>
					</th>
					<td>
						<img src="<?php echo $url; ?>" alt="<?php echo $url; ?>" width="325px" />
						<br/><input type="submit" name="save-pagina_home-remove_image_b" value="<?php _e( 'Remove file', 'bre-bootstrap-ecommerce' ); ?>" />
					</td>
				</tr>
				<?php endif; ?>
				<tr valign="top">
					<th scope="row">
						<label>link:</label>
					</th>
					<td>
						<input type="text" name="bre_url_b" id="bre_url_b" value="<?php echo get_option( 'bre_url_b', '' ); ?>" size="40" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label>New image:</label>
					</th>
					<td>
						<input type="file" name="bre_image_b" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Title', 'bre-bootstrap-ecommerce' ); ?>:</label>
					</th>
					<td>
						<input type="text" name="bre_label_b" value="<?php echo stripslashes( get_option( 'bre_label_b', '' ) ); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Description', 'bre-bootstrap-ecommerce' ); ?>:</label>
					<td>
						<textarea name="bre_description_b" cols="80" rows="5"><?php echo stripslashes( get_option( 'bre_description_b', '' ) ); ?></textarea>
					</td>
				</tr>
				</tbody>
				</table>
			</div><!-- .inside -->
		</div><!-- .postbox -->

		<h3><?php _e( 'Right Box', 'bre-bootstrap-ecommerce' ); ?></h3>

		<div class="postbox">
			<div class="inside">
				<table class="form-table">
				<tbody>
				<?php $url = get_option( 'bre_image_c', false );
				if ( $url !== false ) $url = $url['url'];
				if ( strlen( $url ) ) : ?>
				<tr valign="top">
					<th scope="row">
						<label for="bre_url_c"><?php _e( 'Current image', 'bre-bootstrap-ecommerce' ); ?></label>
					</th>
					<td>
						<img src="<?php echo $url; ?>" alt="<?php echo $url; ?>" width="325px" />
						<br/><input type="submit" name="save-pagina_home-remove_image_c" value="<?php _e( 'Remove file', 'bre-bootstrap-ecommerce' ); ?>" />
					</td>
				</tr>
				<?php endif; ?>
				<tr valign="top">
					<th scope="row">
						<label>link:</label>
					</th>
					<td>
						<input type="text" name="bre_url_c" id="bre_url_c" value="<?php echo get_option( 'bre_url_c', '' ); ?>" size="40" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label>New image:</label>
					</th>
					<td>
						<input type="file" name="bre_image_c" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Title', 'bre-bootstrap-ecommerce' ); ?>:</label>
					</th>
					<td>
						<input type="text" name="bre_label_c" value="<?php echo stripslashes( get_option( 'bre_label_c', '' ) ); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php _e( 'Description', 'bre-bootstrap-ecommerce' ); ?>:</label>
					<td>
						<textarea name="bre_description_c" cols="80" rows="5"><?php echo stripslashes( get_option( 'bre_description_c', '' ) ); ?></textarea>
					</td>
				</tr>
				</tbody>
				</table>
			</div><!-- .inside -->
		</div><!-- .postbox -->
		<?php wp_nonce_field( 'bootstrap_ecommerce_settings' ); ?>
		<?php submit_button( null, 'primary', 'save-bootstrap_ecommerce_logo-settings' ); ?>
	</form>
</div><!-- .wrap --><?php
	}

	function admin_action() {
		if ( empty( $_POST ) ) return;
		check_admin_referer( 'bootstrap_ecommerce_settings' );	
		if ( isset( $_REQUEST['save-bootstrap_ecommerce_logo-settings'] ) ) {
			$this->update_file( 'bre_image_logo' );
		} elseif ( isset( $_REQUEST['remove_bootstrap_logo'] ) ) {
			$this->remove_file( 'bre_image_logo' );
		}
		update_option( 'bre_primary_menu', $_REQUEST['bre_primary_menu'] );
		update_option( 'bre_primary_menu_transparent', isset( $_REQUEST['bre_primary_menu_transparent'] ) );
		update_option( 'bre_secondary_menu', $_REQUEST['bre_secondary_menu'] );
		update_option( 'bre_secondary_menu_transparent', isset( $_REQUEST['bre_secondary_menu_transparent'] ) );
		update_option( 'bre_label_one', $_REQUEST['bre_label_one'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', 'Product Tabs, label one', $_REQUEST['bre_label_one'] );
		update_option( 'bre_label_two', $_REQUEST['bre_label_two'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', 'Product Tabs, label two', $_REQUEST['bre_label_two'] );
		update_option( 'bre_label_three', $_REQUEST['bre_label_three'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', 'Product Tabs, label three', $_REQUEST['bre_label_three'] );
		update_option( 'bre_sidebar_style', isset( $_REQUEST['bre_sidebar_style'] ) );
		update_option( 'bre_layout', $_REQUEST['bre_layout'] );
		
		update_option( 'bre_carousel_hide', isset( $_REQUEST['bre_carousel_hide'] ) );
		update_option( 'bre_carousel_opacity', (float)$_REQUEST['bre_carousel_opacity'] );
		update_option( 'bre_carousel_excerpt_length', (float)$_REQUEST['bre_carousel_excerpt_length'] );
		update_option( 'bre_carousel_hide_more_details', isset( $_REQUEST['bre_carousel_hide_more_details'] ) );

		update_option( 'bre_site_description_hide', isset( $_REQUEST['bre_site_description_hide'] ) );

		//3 ShortCuts
		update_option( 'bre_hide_home_shortcuts', isset( $_POST['hide_home_shortcuts'] ) );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, URL a', $_REQUEST['bre_url_a'] );
		update_option( 'bre_url_a', $_POST['bre_url_a'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, URL b', $_REQUEST['bre_url_b'] );
		update_option( 'bre_url_b', $_POST['bre_url_b'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, URL c', $_REQUEST['bre_url_c'] );
		update_option( 'bre_url_c', $_POST['bre_url_c'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, label a', $_REQUEST['bre_label_a'] );
		update_option( 'bre_label_a', $_POST['bre_label_a'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, label b', $_REQUEST['bre_label_b'] );
		update_option( 'bre_label_b', $_POST['bre_label_b'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, label c', $_REQUEST['bre_label_c'] );
		update_option( 'bre_label_c', $_POST['bre_label_c'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, description a', $_REQUEST['bre_description_a'] );
		update_option( 'bre_description_a', $_POST['bre_description_a'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, description b', $_REQUEST['bre_description_b'] );
		update_option( 'bre_description_b', $_POST['bre_description_b'] );
		if ( function_exists( 'tcp_register_string' ) ) tcp_register_string( 'Boot Store', '3 ShortCust, description c', $_REQUEST['bre_description_c'] );
		update_option( 'bre_description_c', $_POST['bre_description_c'] );
		$this->update_file( 'bre_image_a' );
		$this->update_file( 'bre_image_b' );
		$this->update_file( 'bre_image_c' );
		if ( isset( $_REQUEST['save-pagina_home-remove_image_a'] ) ) {
			$this->remove_file( 'bre_image_a' );
		}  elseif ( isset( $_REQUEST['save-pagina_home-remove_image_b'] ) ) {
			$this->remove_file( 'bre_image_b' );
		}  elseif ( isset( $_REQUEST['save-pagina_home-remove_image_c'] ) ) {
			$this->remove_file( 'bre_image_c' );
		}
		$this->updated = true;
	}

	function update_file( $id ) {
		if ( isset( $_FILES[$id] ) && $_FILES[$id]['name'] !== '' ) {
			$this->remove_file( $id );
			$file = $_FILES[$id];
			if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload( $file, $upload_overrides );
			update_option( $id, $movefile );
		}
	}

	private function remove_file( $id ) {
		$path_to_delete = get_option( $id, false );
		if ( $path_to_delete !== false ) unlink( $path_to_delete['file'] );
		delete_option( $id );
	}
}

new BREBootstrapEcommerceSetup();

add_shortcode( '3boxes', 'bre_get_the_three_boxes' );

function bre_get_the_three_boxes() {
	return bre_the_three_boxes( false );
}

function bre_the_three_boxes( $echo = true ) { 
	ob_start(); ?>
	<div class="home-boxes row-fluid">
		<div class="span4 box box-left">
			<div class="thumbnail box-banner">
				<?php $url = get_option( 'bre_url_a', '' );
				$image_url = get_option( 'bre_image_a', false );
				$label = get_option( 'bre_label_a', '' );
				$label = bre_string( 'Boot Store', '3 ShortCust, label a', get_option( 'bre_label_a', '' ) );
				$description = bre_string( 'Boot Store', '3 ShortCust, description a', get_option( 'bre_description_a', '' ) );
				if ( $image_url == false && strlen( $url ) + strlen( $label ) + strlen( $description ) == 0 ) {
					$label = ' Shortcut 1';
					$description = 'Customize these shorcuts from Appearance &gt; 3 shortcuts. You can customize title, image, text and link target. Note, you could hide them unchecking "Display 3 shortcuts"';
					$image_url = get_template_directory_uri() . '/images/shortcut1.jpg';
				} elseif ( $image_url !== false ) {
					$image_url = $image_url['url'];
				}
				if ( strlen( $image_url ) ) : ?>
					<a href="<?php echo $url ?>">
					<img src="<?php echo $image_url; ?>" alt="<?php echo $image_url; ?>" />
					</a>
				<?php endif; ?>
				<h3 class="entry-title"><?php if ( strlen( $url ) ) : ?><a href="<?php echo $url; ?>"><?php endif; ?>
					<span><?php echo stripcslashes( $label ); ?></span>
				<?php if ( strlen( $url ) ) : ?></a><?php endif; ?></h3>
			</div>
			<div class="caption">
				<p><?php echo stripcslashes( $description ); ?></p>
			</div>
			
		</div>
		<div class="span4 box box-center">
			<div class="thumbnail box-banner">
				<?php $url	= get_option( 'bre_url_b', '' );
				$image_url	= get_option( 'bre_image_b', false );
				$label		= bre_string( 'Boot Store', '3 ShortCust, label a', get_option( 'bre_label_b', '' ) );
				$description = bre_string( 'Boot Store', '3 ShortCust, description a', get_option( 'bre_description_b', '' ) );
				if ( $image_url == false && strlen( $url ) + strlen( $label ) + strlen( $description ) == 0 ) {
					$label = ' Shortcut 2';
					$description = 'Customize these shorcuts from Appearance &gt; 3 shortcuts. You can customize title, image, text and link target. Note, you could hide them unchecking "Display 3 shortcuts"';
					$image_url = get_template_directory_uri() . '/images/shortcut2.jpg';
				} elseif ( $image_url !== false ) {
					$image_url = $image_url['url'];
				}
				if ( strlen( $image_url ) ) : ?>
					<a href="<?php echo $url; ?>">
					<img src="<?php echo $image_url; ?>" alt="<?php echo $image_url; ?>" />
					</a>
				<?php endif; ?>
				<h3 class="entry-title"><?php if ( strlen( $url ) ) : ?><a href="<?php echo $url; ?>"><?php endif; ?>
					<span><?php echo stripcslashes( $label ); ?></span>
				<?php if ( strlen( $url ) ) : ?></a><?php endif; ?></h3>
			</div>
			<div class="caption">
				<p><?php echo stripcslashes( $description ); ?></p>
			</div>
			
		</div>
		<div class="span4 box box-right">
			<div class="thumbnail box-banner">
				<?php $url	= get_option( 'bre_url_c', '' );
				$image_url	= get_option( 'bre_image_c', false );
				$label		= bre_string( 'Boot Store', '3 ShortCust, label a', get_option( 'bre_label_c', '' ) );
				$description = bre_string( 'Boot Store', '3 ShortCust, description a', get_option( 'bre_description_c', '' ) );
				if ( $image_url == false && strlen( $url ) + strlen( $label ) + strlen( $description ) == 0 ) {
					$label	= ' Shortcut 3';
					$description = 'Customize these shorcuts from Appearance &gt; 3 shortcuts. You can customize title, image, text and link target. Note, you could hide them unchecking "Display 3 shortcuts"';
					$image_url = get_template_directory_uri() . '/images/shortcut3.jpg';
				} elseif ( $image_url !== false ) {
					$image_url = $image_url['url'];
				}
				if ( strlen( $image_url ) ) : ?>
					<a href="<?php echo $url; ?>">
					<img src="<?php echo $image_url; ?>" alt="<?php echo $image_url; ?>" />
					</a>
				<?php endif; ?>
				<h3 class="entry-title"><?php if ( strlen( $url ) ) : ?><a href="<?php echo $url; ?>"><?php endif; ?>
					<span><?php echo stripcslashes( $label ); ?></span>
				<?php if ( strlen( $url ) ) : ?></a><?php endif; ?></h3>
			</div>
			<div class="caption">
				<p><?php echo stripcslashes( $description ); ?></p>
			</div>
			
		</div>
	</div><!-- .home-boxes .row-fluid-->
	<?php $out = ob_get_clean();
	if ( $echo ) echo $out;
	else return $out;
}
