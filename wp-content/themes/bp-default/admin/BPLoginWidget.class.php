<?php
/**
 * This file is part of TheCartPress.
 * 
 * TheCartPress is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * TheCartPress is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with TheCartPress.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'TCP_WIDGETS_FOLDER' ) ) return;

require_once( TCP_WIDGETS_FOLDER . 'TCPParentWidget.class.php' );

class BREBPLogin extends TCPParentWidget {

	function BREBPLogin() {
		parent::__construct( 'bre_bp_login', __( 'Allow to create a buddyPress login', 'bre' ), 'TCP BP Login' );
	}

	function widget( $args, $instance ) {
		if ( ! parent::widget( $args, $instance ) ) return;
		extract( $args );
		echo $before_widget;
		$title = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : false );
		if ( $title ) echo $before_title, $title, $after_title;
?>

<?php if ( is_user_logged_in() ) : ?>

	<?php do_action( 'bp_before_sidebar_me' ); ?>

	<div id="sidebar-me" class="widget clearfix">
		<h3 class="widget-title">Welcome <?php echo bp_core_get_userlink( bp_loggedin_user_id() ); ?></h3>
		<a href="<?php echo bp_loggedin_user_domain(); ?>">
			<?php bp_loggedin_user_avatar( 'type=thumb&width=40&height=40' ); ?>
		</a>

		<a class="button logout" href="<?php echo wp_logout_url( wp_guess_url() ); ?>"><?php _e( 'Log Out', 'buddypress' ); ?></a>

		<?php do_action( 'bp_sidebar_me' ); ?>
	</div>

	<?php do_action( 'bp_after_sidebar_me' ); ?>

	<?php if ( bp_is_active( 'messages' ) ) : ?>
		<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
	<?php endif; ?>

<?php else : ?>

	<?php do_action( 'bp_before_sidebar_login_form' ); ?>

	<?php if ( bp_get_signup_allowed() ) : ?>
	
		<p id="login-text">

			<?php printf( __( '<a href="%s" title="Create account" class="btn btn-primary btn-large">Create account to join community</a>', 'buddypress' ), bp_get_signup_page() ); ?>

		</p>

	<?php endif; ?>

	<form name="login-form" id="sidebar-login-form" class="standard-form widget" action="<?php echo site_url( 'wp-login.php', 'login_post' ); ?>" method="post">
		<h3 class="widget-title"><?php _e( 'Login', 'bre-bootstrap-ecommerce' ); ?></h3>
		<label><?php _e( 'Username', 'buddypress' ); ?><br />
		<input type="text" name="log" id="sidebar-user-login" class="input" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

		<label><?php _e( 'Password', 'buddypress' ); ?><br />
		<input type="password" name="pwd" id="sidebar-user-pass" class="input" value="" tabindex="98" /></label>

		<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ); ?></label></p>

		<?php do_action( 'bp_sidebar_login_form' ); ?>
		<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" />
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI'];?>" />
		<input type="hidden" name="testcookie" value="1" />
	</form>

	<?php do_action( 'bp_after_sidebar_login_form' ); ?>

<?php endif; ?>

<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = parent::update( $new_instance, $old_instance );
		return $instance;
	}

	function form( $instance ) {
		if ( ! isset( $instance['title'] ) ) $instance['title'] = __( 'Login', 'bre-bootstrap-ecommerce' );
		parent::form( $instance );
	}
}

register_widget( 'BREBPLogin' );
?>
