
<section class="member-profile">
	<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_fullname(); ?></a>	
	<span id="btn-slide" style="float:right;">ข้อมูลเพิ่มเติม</span>
	<div id="member-profile-box">
	<?php 
		locate_template( array( 'members/single/profile/profile-loop.php' ), true );
	?>
	</div>
</section>

<div class="prof-left-2 align-left">
	<ul class="lst-sub-nav">
		<?php bp_get_options_nav(); ?>
		<br class="clear"/>
	</ul>	
</div>
<div class="prof-right-2 align-left">
			<?php do_action( 'template_notices' ); ?>
        	<section>	
			<?php do_action( 'bp_before_profile_edit_content' );

			if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
				while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

			<form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="profile-form <?php bp_the_profile_group_slug(); ?>">

				<?php do_action( 'bp_before_profile_field_content' ); ?>
					
					<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

						<div<?php bp_field_css_class( 'editfield' ); ?>>

							<?php if ( 'textbox' == bp_get_the_profile_field_type() ) : ?>

								<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
								<div class="wr-input">
									<input type="text" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" value="<?php bp_the_profile_field_edit_value(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>/>
								</div>
							<?php endif; ?>

							<?php if ( 'textarea' == bp_get_the_profile_field_type() ) : ?>

								<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
								<div class="wr-input">
									<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>><?php bp_the_profile_field_edit_value(); ?></textarea>
								</div>
							<?php endif; ?>

							<?php if ( 'selectbox' == bp_get_the_profile_field_type() ) : ?>

								<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
								<div class="wr-input">
									<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>
										<?php bp_the_profile_field_options(); ?>
									</select>
								</div>
							<?php endif; ?>

							<?php if ( 'multiselectbox' == bp_get_the_profile_field_type() ) : ?>

								<label for="<?php bp_the_profile_field_input_name(); ?>"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
								<div class="wr-input">				
									<select name="<?php bp_the_profile_field_input_name(); ?>" id="<?php bp_the_profile_field_input_name(); ?>" multiple="multiple" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>

										<?php bp_the_profile_field_options(); ?>

									</select>
								<?php if ( !bp_get_the_profile_field_is_required() ) : ?>

									<a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name(); ?>' );"><?php _e( 'Clear', 'buddypress' ); ?></a>

								<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if ( 'radio' == bp_get_the_profile_field_type() ) : ?>
		
								<div class="radio">
									<span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></span>
									<div class="wr-input">		
										<?php bp_the_profile_field_options(); ?>
									</div>
								</div>

							<?php endif; ?>

							<?php if ( 'checkbox' == bp_get_the_profile_field_type() ) : ?>

								<div class="checkbox">
									<span class="label"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></span>
									<div class="wr-input">		
										<?php bp_the_profile_field_options(); ?>
									</div>
								</div>

							<?php endif; ?>

							<?php if ( 'datebox' == bp_get_the_profile_field_type() ) : ?>

								<div class="datebox">
									<label for="<?php bp_the_profile_field_input_name(); ?>_day"><?php bp_the_profile_field_name(); ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ); ?><?php endif; ?></label>
									<div class="wr-input">		
										<select name="<?php bp_the_profile_field_input_name(); ?>_day" id="<?php bp_the_profile_field_input_name(); ?>_day" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>

											<?php bp_the_profile_field_options( 'type=day' ); ?>

										</select>

										<select name="<?php bp_the_profile_field_input_name(); ?>_month" id="<?php bp_the_profile_field_input_name(); ?>_month" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>

											<?php bp_the_profile_field_options( 'type=month' ); ?>

										</select>

										<select name="<?php bp_the_profile_field_input_name(); ?>_year" id="<?php bp_the_profile_field_input_name(); ?>_year" <?php if ( bp_get_the_profile_field_is_required() ) : ?>aria-required="true"<?php endif; ?>>

											<?php bp_the_profile_field_options( 'type=year' ); ?>

										</select>
									</div>
								</div>

							<?php endif; ?>
							<div class="wr-visibility">
								<fieldset>
											<?php bp_profile_settings_visibility_select(); ?>		

								</fieldset>
							</div>
							<br class="clear"/>
						</div>

					<?php endwhile; ?>
		<div class="editfield">
				<label for="field_12">เข้าร่วมเมื่อ </label>
				<div class="wr-input">
				<label for="field_12"><?php echo date("j F Y", strtotime(get_userdata(get_current_user_id( ))->user_registered)); ?></label>
					<br class="clear"/>
				</div>
				<br class="clear"/>
		</div>
				<?php do_action( 'bp_after_profile_field_content' ); ?>

				<div class="submit">
					<input type="submit" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php esc_attr_e( 'บันทึกการเปลี่ยนแปลง', 'buddypress' ); ?> " />
				</div>

				<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_group_field_ids(); ?>" />

				<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

			</form>

			<?php endwhile; endif; ?>

			<?php do_action( 'bp_after_profile_edit_content' ); ?>
			</section>
</div><!-- End left -->
