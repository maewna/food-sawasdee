<?php /* Carousel */
class BREBoostrapCarouselMetabox {
	static function init() {
		add_action( 'admin_init', array( __CLASS__, 'admin_init' ) );
	}

	static function admin_init() {
		add_action( 'post_edit_form_tag', array( __CLASS__, 'post_edit_form_tag' ) );
		add_action( 'add_meta_boxes'	, array( __CLASS__, 'add_meta_boxes' ) );
		add_action( 'save_post'			, array( __CLASS__, 'save_post' ) );
		add_action( 'delete_post'		, array( __CLASS__, 'delete_post' ) );
	}

	static function post_edit_form_tag() {
		echo ' enctype="multipart/form-data"';
	}

	static function add_meta_boxes() {
		$post_types = get_post_types( array( 'public' => true ) );
		foreach( $post_types as $post_type ) {
			add_meta_box( 'bre_carousel', __( 'Carousel', 'boot-ecommerce' ), array( __CLASS__, 'bre_carousel_meta_box' ), $post_type, 'normal', 'high' );
		}
	}

	static function bre_carousel_meta_box( $post ) { 
		$bre_add_to_home_carousel	= bre_is_added_to_home_carousel( $post->ID );
		$bre_image_for_carousel		= bre_get_image_for_carousel( $post->ID );
		$bre_carousel_title			= bre_get_carousel_title( $post->ID );
		$bre_carousel_link			= bre_get_carousel_link( $post->ID );
		$bre_carousel_external_link = bre_get_carousel_external_link( $post->ID );
		$bre_carousel_slogan		= bre_get_carousel_slogan( $post->ID );
		?>
		<?php wp_nonce_field( 'bre_carousel_noncename', 'bre_carousel_noncename' ); ?>
		<table class="form-table">
		<tbody>
		<tr>
		<th scope="row">
			<label for="bre_add_to_home_carousel"><?php _e( 'Add to carousel', 'boot-ecommerce' ); ?></label>
		</th>
		<td>
			<input type="checkbox" name="bre_add_to_home_carousel" id="bre_add_to_home_carousel" value="yes" <?php checked( $bre_add_to_home_carousel ); ?> />
			<span class="description"><?php _e( 'Recommended size 1170px * 320px.', 'boot-ecommerce' ); ?></span>
			<p class="description"><?php _e( 'Background img has cover value, preserving the image’s original proportions the carousel area is completely covered by the image', 'boot-ecommerce' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="bre_add_to_home_carousel"><?php _e( 'Background image', 'boot-ecommerce' ); ?>:</label>
		</th>
		<td>
			<?php if ( isset( $bre_image_for_carousel['url'] ) ) : ?>
			<a href="<?php echo $bre_image_for_carousel['url']; ?>" target="_blank">
				<img width="266" height="207" alt="" class="attachment-post-thumbnail" src="<?php echo $bre_image_for_carousel['url']; ?>">
			</a>
			<label><?php _e( 'Delete Image', 'boot-ecommerce' ); ?> <input type="checkbox" name="bre_image_for_carousel-remove" value="yes" /></label><br/>
			<?php endif; ?>
			<input name="bre_image_for_carousel" id="bre_image_for_carousel" type="file" />
			<p class="description"><?php _e( 'If you upload a new file, existing one will be deleted.', 'boot-ecommerce' ); ?></p>
			<p class="description"><?php _e( 'Remember to Save or Update to upload or delete the image.', 'boot-ecommerce' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="bre_carousel_title"><?php _e( 'Carousel title', 'bre-bootstrap-ecommerce' ); ?></label>
		</th>
		<td>
			<input type="text" name="bre_carousel_title" value="<?php echo stripslashes( $bre_carousel_title ); ?>" class="large-text"/>
			<p class="description"><?php _e( 'If blank current title will be used', 'bre-bootstrap-ecommerce' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="bre_carousel_link"><?php _e( 'Carousel link', 'bre-bootstrap-ecommerce' ); ?></label>
		</th>
		<td>
			<input type="text" name="bre_carousel_link" value="<?php echo $bre_carousel_link; ?>" class="large-text"/>
			<p class="description"><?php _e( 'If blank current post link will be used', 'bre-bootstrap-ecommerce' ); ?></p>
			<br/>
			<label for="bre_carousel_external_link"><?php _e( 'Carousel external link', 'bre-bootstrap-ecommerce' ); ?></label>
			<input type="checkbox" name="bre_carousel_external_link" id="bre_carousel_external_link" value="yes" <?php checked( $bre_carousel_external_link ); ?> />
			<p class="description"><?php _e( 'If checked, link will be Opened in a new window or tab', 'bre-bootstrap-ecommerce' ); ?></p>
		</td>
		</tr>
		<tr>
		<th scope="row">
			<label for="bre_carousel_slogan"><?php _e( 'Carousel slogan', 'bre-bootstrap-ecommerce' ); ?></label>
		</th>
		<td>
			<textarea name="bre_carousel_slogan" class="large-text" rows="8"><?php echo stripslashes( $bre_carousel_slogan ); ?></textarea>
			<p class="description"><?php _e( 'If blank current excerpt will be used', 'bre-bootstrap-ecommerce' ); ?></p>
		</td>
		</tr>
		</tbody>
		</table>
	<?php }

	static function save_post( $post_id ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
		if ( ! wp_verify_nonce( isset( $_POST['bre_carousel_noncename'] ) ? $_POST['bre_carousel_noncename'] : '', 'bre_carousel_noncename' ) ) return $post_id;
		unset( $_POST['bre_carousel_noncename'] );
		update_post_meta( $post_id, 'bre_add_to_home_carousel', isset( $_POST['bre_add_to_home_carousel'] ) );
		if ( isset( $_FILES['bre_image_for_carousel'] ) && strlen( $_FILES['bre_image_for_carousel']['tmp_name'] ) > 0 ) {
			$upload = get_post_meta( $post_id, 'bre_image_for_carousel', true );
			if ( isset( $upload['file'] ) ) unlink( $upload['file'] );
			$upload = wp_handle_upload( $_FILES['bre_image_for_carousel'], array( 'test_form' => false ) );
			if ( isset( $upload['error'] ) && '0' != $upload['error'] ) {
				wp_die( __( 'There was an error uploading the file.', 'boot-ecommerce' ) );
			} else {
				update_post_meta( $post_id, 'bre_image_for_carousel', $upload );
			}
		} elseif ( isset( $_REQUEST['bre_image_for_carousel-remove'] ) ) {
			$upload = get_post_meta( $post_id, 'bre_image_for_carousel', true );
			if ( isset( $upload['file'] ) ) unlink( $upload['file'] );
			delete_post_meta( $post_id, 'bre_image_for_carousel' );
		}
		update_post_meta( $post_id, 'bre_carousel_title', trim( $_POST['bre_carousel_title'] ) );
		update_post_meta( $post_id, 'bre_carousel_link', trim( $_POST['bre_carousel_link'] ) );
		update_post_meta( $post_id, 'bre_carousel_external_link', isset( $_POST['bre_carousel_external_link'] ) );
		update_post_meta( $post_id, 'bre_carousel_slogan', trim( $_POST['bre_carousel_slogan'] ) );
	}

	static function delete_post( $post_id ) {
		if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
		delete_post_meta( $post_id, 'bre_add_to_home_carousel' );
		delete_post_meta( $post_id, 'bre_image_for_carousel' );
		delete_post_meta( $post_id, 'bre_carousel_title' );
		delete_post_meta( $post_id, 'bre_carousel_link' );
		delete_post_meta( $post_id, 'bre_carousel_external_link' );
		delete_post_meta( $post_id, 'bre_carousel_slogan' );
	}
}

BREBoostrapCarouselMetabox::init();

function bre_is_added_to_home_carousel( $post_id ) {
	$bre_add_to_home_carousel = get_post_meta( $post_id, 'bre_add_to_home_carousel', true );
	if ( $bre_add_to_home_carousel == '' ) $bre_add_to_home_carousel = false;
	return $bre_add_to_home_carousel;
}

function bre_get_image_for_carousel( $post_id ) {
	$bre_image_for_carousel = get_post_meta( $post_id, 'bre_image_for_carousel', true );
	if ( $bre_image_for_carousel == '' ) $bre_image_for_carousel = false;
	return $bre_image_for_carousel;
}

function bre_get_carousel_title( $post_id ) {
	return get_post_meta( $post_id, 'bre_carousel_title', true );
}

function bre_get_carousel_link( $post_id ) {
	return get_post_meta( $post_id, 'bre_carousel_link', true );
}

function bre_get_carousel_external_link( $post_id ) {
	return (bool)get_post_meta( $post_id, 'bre_carousel_external_link', true );	
}

function bre_get_carousel_slogan( $post_id ) {
	return get_post_meta( $post_id, 'bre_carousel_slogan', true );
}