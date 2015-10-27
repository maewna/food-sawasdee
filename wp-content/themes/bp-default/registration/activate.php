<?php /*Template Name: Activate Page*/?>
<!--<META HTTP-EQUIV="Refresh" CONTENT="0;URL=http://soba.foodsawasdee.com/">-->
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/active.css" />
<center>
<div  class="bg-active">
 <div id="head"><div class="logo"></div></div>
	<div id="content">
		<div class="padder" style="margin-top: 70px; text-align: center;">

		<?php do_action( 'bp_before_activation_page' ); ?>

		<div class="page" id="activate-page">

			<span style="font-size:20px; color:#303030; font-family:supermarket;"><?php if ( bp_account_was_activated() ) :
				_e( 'ยืนยันสมาชิกเรียบร้อย', 'buddypress' );
			else :
				_e( 'Activate your Account', 'buddypress' );
			endif; ?></span>

			<?php //do_action( 'template_notices' ); ?>

			<?php do_action( 'bp_before_activate_content' ); ?>

			<?php if ( bp_account_was_activated() ) : ?>

				<?php if ( isset( $_GET['e'] ) ) : ?>
					<span style="font-size:20px; color:#303030; font-family:supermarket;"><?php _e( 'ยืนยันสมาชิกเรียบร้อย&nbsp;', 'buddypress' ); ?></span>
				<?php else : ?>
					<span style="font-size:20px; color:#303030; font-family:supermarket;"><?php printf( __( 'กลับสู่&nbsp;<a style="text-decoration: none; color: #f2a91d;" href="/">หน้าหลัก</a>', 'buddypress' ), wp_login_url( bp_get_root_domain() ) ); ?></span>
				<?php endif; ?>

			<?php else : ?>

				<p><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></p>

				<form action="" method="get" class="standard-form" id="activation-form">

					<label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
					<input type="text" name="key" id="key" value="" />

					<p class="submit">
						<input type="submit" name="submit" value="<?php esc_attr_e( 'Activate', 'buddypress' ); ?>" />
					</p>

				</form>

			<?php endif; ?>

			<?php do_action( 'bp_after_activate_content' ); ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_activation_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->
</div>
</center>
 <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/macrot1.png"  style="margin-left: 330px; position: absolute; 
 margin-top: -188px;"/>
	<?php //get_sidebar( 'buddypress' ); ?>

<?php //get_footer( 'buddypress' ); ?>
