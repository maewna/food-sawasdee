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

jQuery( 'div.nav ul' ).first().addClass( 'nav navbar' );
jQuery( 'div.menu-main-menu-container ul' ).first().addClass( 'nav navbar' );

function bre_create_menu( selector ) {
	/*if ( jQuery( window ).width() < 768 ) return;*/
	jQuery( selector ).each( function() {
		var ul = jQuery( this );
		ul.addClass( 'dropdown-menu' ).attr( 'role', 'menu' ).removeClass( 'children' );
		var li = ul.parent().addClass( 'dropdown-submenu' );
		var a_href = ul.parent().find( 'a' ).first();
		a_href.addClass( 'dropdown-toggle' ).addClass( 'disabled' ).attr( 'data-toggle', 'dropdown' );
		a_href.append( jQuery( '<span class="caret"></span>' ) );
	} );
	
	jQuery( '#page-top ul.nav' ).children( 'li' ).addClass( 'dropdown' ).removeClass( 'dropdown-submenu' );
}

bre_create_menu( '#page-top ul.children' );
bre_create_menu( '#page-top ul.sub-menu' );

jQuery( 'div.tcp_tier_price' ).addClass('well well-small');
jQuery( '.tcp_buy_button_area div.tcp_delivery_date' ).addClass('well well-small');
jQuery( '#deliverydates_layer_info div.tcp_delivery_date' ).addClass('alert alert-info');
jQuery( '#tcp_shopping_cart_table div.tcp_delivery_date' ).addClass('alert alert-info');
