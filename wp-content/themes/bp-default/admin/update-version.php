<?php
/**
 * This file is part of Boot Store.
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
if ( ! is_admin() ) return;

function bre_update_version_option( $new_key, $old_key, $default_value = false ) {
	update_option( $new_key, get_option( $old_key, $default_value ) );
	//delete_option( $old_key );
}

$version = get_option( 'bre_version', '0' );
if ( $version < 1.4 ) {
	bre_update_version_option( 'bre_hide_home_shortcuts', 'tcp_hide_home_shortcuts' );
	bre_update_version_option( 'bre_url_a', 'tcp_rs_url_a' );
	bre_update_version_option( 'bre_url_b', 'tcp_rs_url_b' );
	bre_update_version_option( 'bre_url_c', 'tcp_rs_url_c' );
	bre_update_version_option( 'bre_label_a', 'tcp_rs_label_a' );
	bre_update_version_option( 'bre_label_b', 'tcp_rs_label_b' );
	bre_update_version_option( 'bre_label_c', 'tcp_rs_label_c' );
	bre_update_version_option( 'bre_description_a', 'tcp_rs_description_a' );
	bre_update_version_option( 'bre_description_b', 'tcp_rs_description_b' );
	bre_update_version_option( 'bre_description_c', 'tcp_rs_description_c' );
	bre_update_version_option( 'bre_image_a', 'tcp_rs_image_a' );
	bre_update_version_option( 'bre_image_b', 'tcp_rs_image_b' );
	bre_update_version_option( 'bre_image_c', 'tcp_rs_image_c' );

	bre_update_version_option( 'bre_primary_menu', 'tcp_primary_menu', '' );
	bre_update_version_option( 'bre_primary_menu_transparent','tcp_primary_menu_transparent', true );
	bre_update_version_option( 'bre_secondary_menu','tcp_secondary_menu', 'navbar-inverse' );
	bre_update_version_option( 'bre_secondary_menu','tcp_secondary_menu' );
	bre_update_version_option( 'bre_label_one', 'tcp_label_one', __( 'Label one', 'bre-bootstrap-ecommerce' ) );
	bre_update_version_option( 'bre_label_two','tcp_label_two', __( 'Label two', 'bre-bootstrap-ecommerce' ) );
	bre_update_version_option( 'bre_label_three','tcp_label_three', __( 'Label three', 'bre-bootstrap-ecommerce' ) );
	bre_update_version_option( 'bre_sidebar_style','tcp_bse_sidebar_style' );
	bre_update_version_option( 'bre_layout','tcp_bse_layout', 'content-sidebar' );
	bre_update_version_option( 'bre_carousel_hide','tcp_carousel_hide' );
	bre_update_version_option( 'bre_carousel_opacity','tcp_carousel_opacity', 0.6 );
	bre_update_version_option( 'bre_site_description_hide', 'tcp_site_description_hide' );
	bre_update_version_option( 'bre_image_logo', 'tcp_rs_image_logo' );

	//Carousel
	global $wpdb;
	$wpdb->query( "update {$wpdb->postmeta} set meta_key = 'bre_add_to_home_carousel' where meta_key='tcp_add_to_home_carousel'" );
	$wpdb->query( "update {$wpdb->postmeta} set meta_key = 'bre_image_for_carousel' where meta_key='tcp_image_for_carousel'" );
	
	update_option( 'bre_version', '1.4' );
}
?>
