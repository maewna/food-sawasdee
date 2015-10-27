<?php
/**
 * Plugin Name: BP Custom Cover Image for User Profile
 * Version:1.0
 * Author: Jiranuch
 * 
 * 
 * 
 * Description: Allows Users to upload custom cover image for their profile pages
 */

//let us use the class to aboid name space collision with ever growing bp plugins

class BPProfileHDChanger{
  
    //php4 constructor
function BPProfileHDChanger(){
        $this->__construct();
    }
 //php5 constructor   
function __construct() {
      
      //load textdomain
      add_action ( 'bp_loaded_hd', array( $this, 'load_textdomain_hd' ), 2 );
	  
        //setup nav
      add_action( 'bp_xprofile_setup_nav', array( $this, 'setup_nav' ) );
        
      //inject custom css class to body
      //add_filter( 'body_class', array( $this, 'get_body_class' ), 30 );
      //add css for background change
      add_action( 'wp_head', array( $this, 'inject_css' ) );
      add_action( 'wp_print_scripts', array( $this, 'inject_js' ) );
      add_action( 'wp_ajax_bppg_delete_hd', array( $this, 'ajax_delete_current_hd' ) );
        
}

//translation
function load_textdomain_hd(){
        
    $locale = apply_filters( 'bp_custom_hd_for_profile_load_textdomain_get_locale', get_locale() );
     
	// if load .mo file
    if ( !empty( $locale ) ) {
		$mofile_default = sprintf( '%slanguages/%s.mo', plugin_dir_path( __FILE__ ), $locale );
              
		$mofile = apply_filters( 'bp_custom_hd_for_profile_load_textdomain_mofile', $mofile_default );
		
        if ( file_exists( $mofile ) ) {
                    // make sure file exists, and load it
			load_textdomain( 'bppg', $mofile );
		}
	} 
 
}
//adda sub nav to My profile for chaging cover image
function setup_nav(){
    global $bp;
    $profile_link = bp_loggedin_user_domain() . $bp->profile->slug . '/';
    bp_core_new_subnav_item( 
            array( 
                'name' => __( 'ภาพพื้นหลัง', 'bppg' ),
                'slug' => 'change-hd',
                'parent_url' => $profile_link,
                'parent_slug' => $bp->profile->slug, 
                'screen_function' =>array( $this, 'screen_change_header_image' ),
                'user_has_access'   => ( bp_is_my_profile() || is_super_admin() ),
                'position' => 30 ) );
}

//screen function

function screen_change_header_image(){
    global $bp;
    //if the form was submitted, update here
     if( !empty( $_POST['bpprofhd_save_submit'] ) ){
                if( !wp_verify_nonce( $_POST['_wpnonce'], 'bp_upload_profile_hd' ) )
                         die(__('Security check failed','bpphd'));
                //handle the upload
                 $allowed_hd_repeat_options = bppg_get_image_hd_repeat_options();
                 $current_option = $_POST['hd_repeat'];
                 
                 if(isset($allowed_hd_repeat_options[$current_option]))
                    bp_update_user_meta(bp_loggedin_user_id(),'profile_hd_repeat', $current_option);
               
                 if( $this->handle_upload())
                    bp_core_add_message(__('Cover image uploaded successfully!','bppg'));  
}

    //hook the content
    
    add_action( 'bp_template_content',array( $this, 'page_content_hd') );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}
   
    //Upload page content
function page_content_hd(){ 
	    ?>
	
	
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

    <form name="bpprofbpg_change" id="bpprofbpg_change" method="post" class="standard-form" enctype="multipart/form-data">
	<h2><?php _e( 'เปลี่ยนภาพพื้นหลัง', 'buddypress' ); ?></h2>
        <?php  $image_url=  bppg_get_image_hd();?>
		
        <div id="hd-delete-wrapper"> 
           
			<div class="current-hd">
				<?php if(!empty($image_url)){?>
                    <img id="bg-img-upload" src="<?php echo $image_url;?>" alt="current cover" width="620" />
				<?php } else{ ?> 
					<img id="bg-img-upload" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/profile/bg-default.jpg" alt="" width="620" />
				<?php } ?> 
			</div>
			
			<div class="wr-upload-btn">
					<div class="fileUpload">
						<span>เลือกไฟล์</span>
						<input type="file" name="file" id="bprpgbp_upload" />
						<!--<label for="bprpgbp_upload"></label>-->
					</div>
					 <a class="del-btn" href='#' id='bppg-del-image'><?php _e('ลบ','bppg');?></a>
			</div>
			<br class="clear"/>
           
		</div><!--End hd-delete-wrapper-->
       
       
    
	<?php wp_nonce_field("bp_upload_profile_hd");?>
        <input type="hidden" name="action" id="action" value="bp_upload_profile_hd" />
		<input type="submit" id="bpprofhd_save_submit" name="bpprofhd_save_submit" class="button" value="<?php _e('บันทึกการเปลี่ยนแปลง','bppg') ?>" />
		<input type="button" name="cancel" id="cancel" value="<?php esc_attr_e( 'ยกเลิก', 'buddypress' );?>" onClick="window.location='<?php bp_displayed_user_link(); ?>profile/change-hd/';" />
	</form>
	
	
	</section>
</div><!-- End left -->
    <?php
}

//handles upload, a modified version of bp_core_avatar_handle_upload(from bp-core/bp-core-avatars.php)
function handle_upload( ) {
	global $bp;

	//include core files
	require_once( ABSPATH . '/wp-admin/includes/file.php' );
        $max_upload_size=$this->get_max_upload_size();
        $max_upload_size=$max_upload_size*1024;//convert kb to bytes
	$file=$_FILES;
        
        //I am not changing the domain of erro messages as these are same as bp, so you should have a translation for this
        $uploadErrors = array(
		0 => __('There is no error, the file uploaded with success', 'buddypress'),
		1 => __('Your image was bigger than the maximum allowed file size of: ', 'buddypress') . size_format($max_upload_size),
		2 => __('Your image was bigger than the maximum allowed file size of: ', 'buddypress') . size_format($max_upload_size),
		3 => __('The uploaded file was only partially uploaded', 'buddypress'),
		4 => __('No file was uploaded', 'buddypress'),
		6 => __('Missing a temporary folder', 'buddypress')
	);

	if ( isset($file['error']) && $file['error']) {
		bp_core_add_message( sprintf( __( 'Your upload failed, please try again. Error was: %s', 'buddypress' ), $uploadErrors[$file['file']['error']] ), 'error' );
		return false;
	}

	if ( ! ($file['file']['size']<$max_upload_size) ) {
		bp_core_add_message( sprintf( __( 'The file you uploaded is too big. Please upload a file under %s', 'buddypress'), size_format($max_upload_size) ), 'error' );
		return false;
	}
        
	if ( ( !empty( $file['file']['type'] ) && !preg_match('/(jpe?g|gif|png)$/i', $file['file']['type'] ) ) || !preg_match( '/(jpe?g|gif|png)$/i', $file['file']['name'] ) )
	 {
		bp_core_add_message( __( 'Please upload only JPG, GIF or PNG photos.', 'buddypress' ), 'error' );
		return false;
	}


	$uploaded_file = wp_handle_upload( $file['file'], array( 'action'=> 'bp_upload_profile_hd' ) );

	//if file was not uploaded correctly
        if ( !empty($uploaded_file['error'] ) ) {
		bp_core_add_message( sprintf( __( 'Upload Failed! Error was: %s', 'buddypress' ), $uploaded_file['error'] ), 'error' );
		return false;
	}

        //assume that the file uploaded succesfully
        //delete any previous uploaded image
        self::delete_hd_for_user();
        //save in usermeta
        bp_update_user_meta(bp_loggedin_user_id(),'profile_hd',$uploaded_file['url']);
        bp_update_user_meta(bp_loggedin_user_id(),'profile_hd_file_path',$uploaded_file['file']);
        
        
       
        
        do_action( 'bppg_head_uploaded', $uploaded_file['url'] );//allow to do some other actions when a new background is uploaded
	return true;
}

//get the allowed upload size
//there is no setting on single wp, on multisite, there is a setting, we will adhere to both
function get_max_upload_size(){
    $max_file_sizein_kb = get_site_option( 'fileupload_maxk' );//it wil be empty for standard wordpress
    
    
    if( empty( $max_file_sizein_kb ) ){//check for the server limit since we are on single wp
    
        $max_upload_size = (int)(ini_get('upload_max_filesize'));
        $max_post_size = (int)(ini_get('post_max_size'));
        $memory_limit = (int)(ini_get('memory_limit'));
        $max_file_sizein_mb = min( $max_upload_size, $max_post_size, $memory_limit );
        $max_file_sizein_kb =$max_file_sizein_mb*1024;//convert mb to kb
}
return apply_filters( 'bppg_max_upload_size', $max_file_sizein_kb );



}
//inject css
function inject_css(){
    $image_url = bppg_get_image_hd();
    if(empty($image_url) || apply_filters( 'bppg_iwilldo_it_myself', false ) )
        return;
    $repeat_type = bp_get_user_meta(bp_loggedin_user_id(), 'profile_hd_repeat', true);
    if(! $repeat_type )
        $repeat_type = 'repeat-x';
    ?>
<script>
 $(function() {
	document.getElementById("bg-img").innerHTML = "<img src='<?php echo $image_url;?>' style='width: 100%; position: absolute; z-index: -100; -webkit-mask-image: -webkit-gradient(linear, left 70%, left bottom, from(rgba(0,0,0,1)), to(rgba(0,0,0,0)))'/>";
 }); 
</script>
<?php

}

//inject custom class for profile pages

function get_body_class($classes){
    if( !bp_is_user () )
        return $classes;
    else
        //$classes[] = 'is-user-profile';
		$classes[] = 'cover-head';

    return $classes;


}
//inject js if I am viewing my own profile
function inject_js(){
    if( bp_is_my_profile() && bp_is_profile_component() && bp_is_current_action( 'change-hd' ) )
        wp_enqueue_script ( 'bphd-js', plugin_dir_url(__FILE__). 'bpphd.js', array('jquery') );
}

//ajax delete the existing image

function ajax_delete_current_hd(){
    
    //validate nonce
    if( !wp_verify_nonce($_POST['_wpnonce'],"bp_upload_profile_hd") )
            die('what!');
    self::delete_hd_for_user();
     $message='<p>'.__('Cover image deleted successfully!','bppg').'</p>';//feedback but we don't do anything with it yet, should we do something
     echo $message;
     exit(0);
              
}
//reuse it
function delete_hd_for_user(){
  //delete the associated image and send a message
    $old_file_path = get_user_meta( bp_loggedin_user_id(), 'profile_hd_file_path', true );
    if( $old_file_path )
          @unlink ( $old_file_path );//remove old files with each new upload
     bp_delete_user_meta( bp_loggedin_user_id(), 'profile_hd_file_path' );
     bp_delete_user_meta( bp_loggedin_user_id(), 'profile_hd' );  
     bp_delete_user_meta( bp_loggedin_user_id(),'profile_hd_repeat');
}
}

/*public function for your use*/
/**
 *
 * @global type $bp
 * @param type $user_id
 * @return string  url of the image associated with current user or false
 */

function bppg_get_image_hd( $user_id = false ){
    global $bp;
    if(!$user_id)
            $user_id = bp_displayed_user_id();
    
     if( empty( $user_id ) )
         return false;
     $image_url = bp_get_user_meta( $user_id, 'profile_hd', true );
     return apply_filters( 'bppg_get_image', $image_url, $user_id );
}
function bppg_get_image_hd_repeat( $user_id = false ){
    global $bp;
    if( !$user_id )
            $user_id = bp_displayed_user_id();
    
     if( empty( $user_id ) )
         return false;
     
    		
	 $current_repeat_option = bp_get_user_meta( $user_id, 'profile_hd_repeat', true);
     if( ! $current_repeat_option )
         $current_repeat_option = 'repeat';
     
     return $current_repeat_option;
}

function bppg_get_image_hd_repeat_options(){
    return  array('repeat' =>__('Repeat','bppg'), 'repeat-x'=>__('Repeat Horizontally','bppg'),'repeat-y'=>__('Repeat Vertically','bppg'), 'no-repeat'=>__('Do Not Repeat','bppg'));
	






















	
}
$_profhd = new BPProfileHDChanger();

