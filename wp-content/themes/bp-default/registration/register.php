<?php /*Template Name: Register Page*/?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/register.css" />
<!--<script type="text/javascript"  src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/readmore.js?v=1.0.0"></script>
</head>
<body>
<!--<style>
#field_1,label[for=field_1], .editfield-field_1
{
	display:none;
}
</style>-->
<div  class="bg">
 <div id="head"><div class="logo"></div></div>
	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_register_page' ); ?>

		<div class="page" id="register-page">

			<form action="" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">

			<?php if ( 'registration-disabled' == bp_get_current_signup_step() ) : ?>
           
				<?php do_action( 'template_notices' ); ?>
				<?php do_action( 'bp_before_registration_disabled' ); ?>

					<p><?php _e( 'User registration is currently not allowed.', 'buddypress' ); ?></p>

				<?php do_action( 'bp_after_registration_disabled' ); ?>
			<?php endif; // registration-disabled signup setp ?>

			<?php if ( 'request-details' == bp_get_current_signup_step() ) : ?>
				<?php do_action( 'bp_before_account_details_fields' ); ?>
		 <article>
				<div class="register-section">
                <?php do_action( 'bp_signup_username_errors' ); ?>
					<label for="signup_username"><?php _e( 'ชื่อสมาชิก', 'buddypress' ); ?> <span style="color:#d81c5c; font-family:tahoma; font-size:12px;">*</span></label>
					
					<input type="text" name="signup_username" id="signup_username" value="<?php bp_signup_username_value(); ?>" required/><br />
                    
					<?php do_action( 'bp_signup_email_errors' ); ?>
					<label for="signup_email"><?php _e( 'อีเมลล์', 'buddypress' ); ?> <span style="color:#d81c5c; font-family:tahoma; font-size:12px;">*</span></label>
					
					<input type="text" name="signup_email" id="signup_email" value="<?php bp_signup_email_value(); ?>" required/><br />

					<?php do_action( 'bp_signup_password_errors' ); ?>
					<label for="signup_password"><?php _e( 'รหัสผ่าน', 'buddypress' ); ?> <span style="color:#d81c5c; font-family:tahoma; font-size:12px;">*</span></label>
					
					<input type="password" name="signup_password" id="signup_password" value="" required/><br />

					<?php do_action( 'bp_signup_password_confirm_errors' ); ?>
					<label for="signup_password_confirm"><?php _e( 'ยืนยันรหัสผ่าน', 'buddypress' ); ?> <span style="color:#d81c5c; font-family:tahoma; font-size:12px;">*</span></label>
					
					<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" required/><br />

					<?php do_action( 'bp_account_details_fields' ); ?>

				</div><!-- #basic-details-section -->

				<?php do_action( 'bp_after_account_details_fields' ); ?>

				<?php if ( bp_is_active( 'xprofile' ) ) : ?>

					<?php do_action( 'bp_before_signup_profile_fields' ); ?>

					<div class="register-section">
						<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
						<?php if ( bp_is_active( 'xprofile' ) ) : if ( bp_has_profile( array( 'profile_group_id' => 1, 'fetch_field_data' => false ) ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

						<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

							<div class="editfield-<?php bp_the_profile_field_input_name(); ?>">

								<?php if ( 'textbox' == bp_get_the_profile_field_type() ) : ?>
<?php do_action( bp_get_the_profile_field_errors_action() ); ?>
									<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php endif; ?></label>
									
									<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" />

								<?php endif; ?>

								<?php if ( 'textarea' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
									<?php do_action( bp_get_the_profile_field_errors_action() ); ?>
									<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_edit_value(); ?></textarea>

								<?php endif; ?>

								<?php if ( 'selectbox' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
									<?php do_action( bp_get_the_profile_field_errors_action() ); ?>
									<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>">
										<?php bp_the_profile_field_options(); ?>
									</select>

								<?php endif; ?>

								<?php if ( 'multiselectbox' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
									<?php do_action( bp_get_the_profile_field_errors_action() ); ?>
									<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" multiple="multiple">
										<?php bp_the_profile_field_options(); ?>
									</select>

								<?php endif; ?>

								<?php if ( 'radio' == bp_get_the_profile_field_type() ) : ?>

									<div class="radio">
										<span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></span>

										<?php do_action( bp_get_the_profile_field_errors_action() ); ?>
										<?php bp_the_profile_field_options(); ?>

										<?php if ( !bp_get_the_profile_field_is_required() ) : ?>
											<a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name(); ?>' );"><?php _e( 'Clear', 'buddypress' ); ?></a>
										<?php endif; ?>
									</div>

								<?php endif; ?>

								<?php if ( 'checkbox' == bp_get_the_profile_field_type() ) : ?>

									<!--<div class="checkbox">
										<span class="label"><?php //bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></span>

										<?php do_action( bp_get_the_profile_field_errors_action() ); ?>
										<?php bp_the_profile_field_options(); ?>
									</div>-->

								<?php endif; ?>

								<?php if ( 'datebox' == bp_get_the_profile_field_type() ) : ?>

									<div class="datebox">
										<label for="<?php bp_the_profile_field_input_name(); ?>_day"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
										<?php do_action( bp_get_the_profile_field_errors_action() ); ?>

										<select name="<?php bp_the_profile_field_input_name(); ?>_day" id="<?php bp_the_profile_field_input_name(); ?>_day">
											<?php bp_the_profile_field_options( 'type=day' ); ?>
										</select>

										<select name="<?php bp_the_profile_field_input_name(); ?>_month" id="<?php bp_the_profile_field_input_name(); ?>_month">
											<?php bp_the_profile_field_options( 'type=month' ); ?>
										</select>

										<select name="<?php bp_the_profile_field_input_name(); ?>_year" id="<?php bp_the_profile_field_input_name(); ?>_year">
											<?php bp_the_profile_field_options( 'type=year' ); ?>
										</select>
									</div>

								<?php endif; ?>

								<?php //do_action( 'bp_custom_profile_edit_fields_pre_visibility' ); ?>


								<?php do_action( 'bp_custom_profile_edit_fields' ); ?>

							

							</div>

						<?php endwhile; ?>

						<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

						<?php endwhile; endif; endif; ?>

						<?php do_action( 'bp_signup_profile_fields' ); ?>

					</div><!-- #profile-details-section -->
                    
               </article>
         
               <hr style="border: 1px solid #e9ebeb; width: 400px; margin-top: 20px; float: left;margin-left: 45px; margin-bottom: 10px;">
               <div class="checkbox">
				<label style="text-align: left;
margin-left: 55px; padding-top:15px;"><input type="checkbox" name="field_20[]" id="field_21_0" value="ในการสมัครสมาชิก คุณยอมรับใน Terms and Conditions">  ฉันอยากรับข่าวสารของฟู้ดสวัสดีทาง email</label>
                <!--<label style="text-align: left;
margin-left: 55px;"><input type="checkbox" name="field_20[]" id="field_21_0" value="ในการสมัครสมาชิก คุณยอมรับใน Terms and Conditions">ในการสมัครสมาชิก คุณยอมรับใน Terms and Conditions</label>-->
				</div>
                  <hr style="border: 1px solid #e9ebeb; width: 400px; margin-top: 10px; float: left;margin-left: 45px;">
             <div class="cleaner_h20"></div>
					<?php do_action( 'bp_after_signup_profile_fields' ); ?>

				
				<?php endif; ?>

				<?php if ( bp_get_blog_signup_allowed() ) : ?>

					<?php do_action( 'bp_before_blog_details_fields' ); ?>

					<?php /***** Blog Creation Details ******/ ?>

					<div class="register-section" id="blog-details-section">

						<h4><?php _e( 'Blog Details', 'buddypress' ); ?></h4>

						<p><input type="checkbox" name="signup_with_blog" id="signup_with_blog" value="1"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes, I\'d like to create a new site', 'buddypress' ); ?></p>

						<div id="blog-details"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?>class="show"<?php endif; ?>>

							<label for="signup_blog_url"><?php _e( 'Blog URL', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
							<?php do_action( 'bp_signup_blog_url_errors' ); ?>

							<?php if ( is_subdomain_install() ) : ?>
								http:// <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value(); ?>" /> .<?php bp_blogs_subdomain_base(); ?>
							<?php else : ?>
								<?php echo home_url( '/' ); ?> <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value(); ?>" />
							<?php endif; ?>

							<label for="signup_blog_title"><?php _e( 'Site Title', 'buddypress' ); ?> <?php _e( '(required)', 'buddypress' ); ?></label>
							<?php do_action( 'bp_signup_blog_title_errors' ); ?>
							<input type="text" name="signup_blog_title" id="signup_blog_title" value="<?php bp_signup_blog_title_value(); ?>" />

							<span class="label"><?php _e( 'I would like my site to appear in search engines, and in public listings around this network.', 'buddypress' ); ?>:</span>
							<?php do_action( 'bp_signup_blog_privacy_errors' ); ?>

							<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_public" value="public"<?php if ( 'public' == bp_get_signup_blog_privacy_value() || !bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes', 'buddypress' ); ?></label>
							<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_private" value="private"<?php if ( 'private' == bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'No', 'buddypress' ); ?></label>

							<?php do_action( 'bp_blog_details_fields' ); ?>

						</div>
				
					</div><!-- #blog-details-section -->
			
					<?php do_action( 'bp_after_blog_details_fields' ); ?>

				<?php endif; ?>

				<?php do_action( 'bp_before_registration_submit_buttons' ); ?>

				<div id="menu-top-nav" class="submit">
					<li class="register">
                	<input type="submit" name="signup_submit" id="signup_submit" class="register" value="<?php esc_attr_e( 'สมัครสมาชิก', 'buddypress' ); ?>" />
                    
                    </li>
                  <!--  <li class="login"><a href="#">เข้าสูู่ระบบ</a></li>-->
				</div>
				<div class="cleaner_h20"></div>
				<?php do_action( 'bp_after_registration_submit_buttons' ); ?>

				<?php wp_nonce_field( 'bp_new_signup' ); ?>

			<?php endif; // request-details signup step ?>
            
            
    

			<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>

				<h2 style="  margin-left: -62px; margin-top: 160px; text-align: center;"><?php _e( 'สมัครสมาชิกเรียบร้อย', 'buddypress' ); ?></h2>

				<?php do_action( 'template_notices' ); ?>
				<?php do_action( 'bp_before_registration_confirmed' ); ?>

				<?php if ( bp_registration_needs_activation() ) : ?>
					<p style="  margin-left: -58px; text-align: center; margin-bottom: 210px;"><?php _e( 'กรุณาตรวจสอบอีเมล์เพื่อทำการยืนยันการสมัครสมาชิก', 'buddypress' ); ?></p>
				<?php else : ?>
					<p style="  margin-left: -58px; text-align: center; margin-bottom: 30px;"><?php _e( 'You have successfully created your account! Please log in using the username and password you have just created.', 'buddypress' ); ?></p>
				<?php endif; ?>

				<?php do_action( 'bp_after_registration_confirmed' ); ?>

			<?php endif; // completed-confirmation signup step ?>
  
			<?php do_action( 'bp_custom_signup_steps' ); ?>

			</form>
   
		</div>

		<?php do_action( 'bp_after_register_page' ); ?>



		</div><!-- .padder -->
	</div><!-- #content -->
          <div class="cleaner_h30"></div>
          </div>
</body>
</html>

	<script type="text/javascript">
		jQuery(document).ready( function() {
			if ( jQuery('div#blog-details').length && !jQuery('div#blog-details').hasClass('show') )
				jQuery('div#blog-details').toggle();

			jQuery( 'input#signup_with_blog' ).click( function() {
				jQuery('div#blog-details').fadeOut().toggle();
			});
		});
	</script>



  <script>
    $('article').readmore({speed: 500});
  </script>