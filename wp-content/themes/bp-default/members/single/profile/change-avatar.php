<script  type='text/javascript'>
$(document).ready(function(){
	$(".button").hover(function() {
		
	});
});
</script>
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
<?php do_action( 'bp_before_profile_avatar_upload_content' ); ?>

<?php if ( !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>

	<form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">

		<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>
			<h2><?php _e( 'เปลี่ยนรูปภาพประจำตัว (ไฟล์ JPG, GIF หรือ PNG)', 'buddypress' ); ?></h2>

			<div id="avatar-upload">
			
				
				<img id="avatar-img-upload" src="<?php echo get_avatar_url(bp_displayed_user_id(),150); ?>" alt=""/>
				
				<div class="wr-upload-btn">
					<div class="fileUpload">
						<span>เลือกไฟล์</span>
						<input type="file" name="file" id="file" />
					</div>
					<a class="del-btn" href="<?php bp_avatar_delete_link(); ?>" title="<?php esc_attr_e( 'ลบ', 'buddypress' ); ?>"><?php _e( 'ลบ', 'buddypress' ); ?></a>
				</div>
				<br class="clear"/>
			</div><!--End avatar-upload-->

			<input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'อัปโหลด', 'buddypress' ); ?>" />
			<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			<input type="button" name="cancel" id="cancel" value="<?php esc_attr_e( 'ยกเลิก', 'buddypress' );?>" onClick="window.location='<?php bp_displayed_user_link(); ?>profile/change-avatar/';" />
				
			

		<?php endif; ?>

		<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

			<h2><?php _e( 'ตัดรูปประจำตัวใหม่', 'buddypress' ); ?></h2>

			<div id="avatar-upload">
				<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Avatar to crop', 'buddypress' ); ?>" />

				<div id="avatar-crop-pane">
					<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Avatar preview', 'buddypress' ); ?>" />
				</div>
				<br class="clear"/>
			</div> 
			
			<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'ตัดรูปภาพ', 'buddypress' ); ?>" />
			<input type="button" name="cancel" id="cancel" value="<?php esc_attr_e( 'ยกเลิก', 'buddypress' );?>" onClick="window.location='<?php bp_displayed_user_link(); ?>profile/change-avatar/';" />
			
			<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />

			<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>

		<?php endif; ?>
		
	</form>

<?php else : ?>

	<p><?php _e( 'Your avatar will be used on your profile and throughout the site. To change your avatar, please create an account with <a href="http://gravatar.com">Gravatar</a> using the same email address as you used to register with this site.', 'buddypress' ); ?></p>

<?php endif; ?>

<?php do_action( 'bp_after_profile_avatar_upload_content' ); ?>












</div><!-- End left -->




