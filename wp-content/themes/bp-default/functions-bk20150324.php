<?php
/**
 * BP-Default theme functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress and BuddyPress to change core functionality.
 *
 * The first function, bp_dtheme_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails and navigation menus, and
 * for BuddyPress, action buttons and javascript localisation.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development, http://codex.wordpress.org/Child_Themes
 * and http://codex.buddypress.org/theme-development/building-a-buddypress-child-theme/), you can override
 * certain functions (those wrapped in a function_exists() call) by defining them first in your
 * child theme's functions.php file. The child theme's functions.php file is included before the
 * parent theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package BuddyPress
 * @subpackage BP-Default
 * @since BuddyPress (1.2)
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// If BuddyPress is not activated, switch back to the default WP theme and bail out
if ( ! function_exists( 'bp_is_active' ) ) {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	return;
}

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 591;

if ( ! function_exists( 'bp_dtheme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress and BuddyPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override bp_dtheme_setup() in a child theme, add your own bp_dtheme_setup to your child theme's
 * functions.php file.
 *
 * @global BuddyPress $bp The one true BuddyPress instance
 * @since BuddyPress (1.5)
 */
function bp_dtheme_setup() {

	// Load the AJAX functions for the theme
	require( get_template_directory() . '/_inc/ajax.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme comes with all the BuddyPress goodies
	add_theme_support( 'buddypress' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add responsive layout support to bp-default without forcing child
	// themes to inherit it if they don't want to
	add_theme_support( 'bp-default-responsive' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'buddypress' ),
	) );

	// This theme allows users to set a custom background
	$custom_background_args = array(
		'wp-head-callback' => 'bp_dtheme_custom_background_style'
	);
	add_theme_support( 'custom-background', $custom_background_args );

	// Add custom header support if allowed
	if ( !defined( 'BP_DTHEME_DISABLE_CUSTOM_HEADER' ) ) {
		define( 'HEADER_TEXTCOLOR', 'FFFFFF' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to bp_dtheme_header_image_width and bp_dtheme_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH',  apply_filters( 'bp_dtheme_header_image_width',  1250 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'bp_dtheme_header_image_height', 133  ) );

		// We'll be using post thumbnails for custom header images on posts and pages. We want them to be 1250 pixels wide by 133 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Add a way for the custom header to be styled in the admin panel that controls custom headers.
		$custom_header_args = array(
			'wp-head-callback' => 'bp_dtheme_header_style',
			'admin-head-callback' => 'bp_dtheme_admin_header_style'
		);
		add_theme_support( 'custom-header', $custom_header_args );
	}

	if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		// Register buttons for the relevant component templates
		// Friends button
		//if ( bp_is_active( 'friends' ) )
		//	add_action( 'bp_member_header_actions',    'bp_add_friend_button',           5 );

		// Activity button
		//if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() )
		//	add_action( 'bp_member_header_actions',    'bp_send_public_message_button',  20 );

		// Messages button
		//if ( bp_is_active( 'messages' ) )
		//	add_action( 'bp_member_header_actions',    'bp_send_private_message_button', 20 );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button',           5 );
			add_action( 'bp_group_header_actions',     'bp_group_new_topic_button',      20 );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}
add_action( 'after_setup_theme', 'bp_dtheme_setup' );
endif;

if ( !function_exists( 'bp_dtheme_enqueue_scripts' ) ) :
/**
 * Enqueue theme javascript safely
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @since BuddyPress (1.5)
 */
function bp_dtheme_enqueue_scripts() {

	// Enqueue the global JS - Ajax will not work without it
	wp_enqueue_script( 'dtheme-ajax-js', get_template_directory_uri() . '/_inc/global.js', array( 'jquery' ), bp_get_version() );

	// Add words that we need to use in JS to the end of the page so they can be translated and still used.
	$params = array(
		'my_favs'           => __( 'My Favorites', 'buddypress' ),
		'accepted'          => __( 'Accepted', 'buddypress' ),
		'rejected'          => __( 'Rejected', 'buddypress' ),
		'show_all_comments' => __( 'Show all comments for this thread', 'buddypress' ),
		'show_x_comments'   => __( 'Show all %d comments', 'buddypress' ),
		'show_all'          => __( 'Show all', 'buddypress' ),
		'comments'          => __( 'comments', 'buddypress' ),
		'close'             => __( 'Close', 'buddypress' ),
		'view'              => __( 'View', 'buddypress' ),
		'mark_as_fav'	    => __( 'Favorite', 'buddypress' ),
		'remove_fav'	    => __( 'Remove Favorite', 'buddypress' ),
		'unsaved_changes'   => __( 'Your profile has unsaved changes. If you leave the page, the changes will be lost.', 'buddypress' ),
	);
	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );

	// Maybe enqueue comment reply JS
	if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_scripts' );
endif;

if ( !function_exists( 'bp_dtheme_enqueue_styles' ) ) :
/**
 * Enqueue theme CSS safely
 *
 * For maximum flexibility, BuddyPress Default's stylesheet is enqueued, using wp_enqueue_style().
 * If you're building a child theme of bp-default, your stylesheet will also be enqueued,
 * automatically, as dependent on bp-default's CSS. For this reason, bp-default child themes are
 * not recommended to include bp-default's stylesheet using @import.
 *
 * If you would prefer to use @import, or would like to change the way in which stylesheets are
 * enqueued, you can override bp_dtheme_enqueue_styles() in your theme's functions.php file.
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 * @see http://codex.buddypress.org/releases/1-5-developer-and-designer-information/
 * @since BuddyPress (1.5)
 */
function bp_dtheme_enqueue_styles() {

	// Register our main stylesheet
	wp_register_style( 'bp-default-main', get_template_directory_uri() . '/_inc/css/default.css', array(), bp_get_version() );

	// If the current theme is a child of bp-default, enqueue its stylesheet
	if ( is_child_theme() && 'bp-default' == get_template() ) {
		wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'bp-default-main' ), bp_get_version() );
	}

	// Enqueue the main stylesheet
	wp_enqueue_style( 'bp-default-main' );

	// Default CSS RTL
	if ( is_rtl() )
		wp_enqueue_style( 'bp-default-main-rtl',  get_template_directory_uri() . '/_inc/css/default-rtl.css', array( 'bp-default-main' ), bp_get_version() );

	// Responsive layout
	if ( current_theme_supports( 'bp-default-responsive' ) ) {
		wp_enqueue_style( 'bp-default-responsive', get_template_directory_uri() . '/_inc/css/responsive.css', array( 'bp-default-main' ), bp_get_version() );

		if ( is_rtl() ) {
			wp_enqueue_style( 'bp-default-responsive-rtl', get_template_directory_uri() . '/_inc/css/responsive-rtl.css', array( 'bp-default-responsive' ), bp_get_version() );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'bp_dtheme_enqueue_styles' );
endif;

if ( !function_exists( 'bp_dtheme_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in bp_dtheme_setup().
 *
 * @since BuddyPress (1.2)
 */
function bp_dtheme_admin_header_style() {
?>
	<style type="text/css">
		#headimg {
			position: relative;
			color: #fff;
			background: url(<?php header_image(); ?>);
			-moz-border-radius-bottomleft: 6px;
			-webkit-border-bottom-left-radius: 6px;
			-moz-border-radius-bottomright: 6px;
			-webkit-border-bottom-right-radius: 6px;
			margin-bottom: 20px;
			height: 133px;
		}

		#headimg h1{
			position: absolute;
			bottom: 15px;
			left: 15px;
			width: 44%;
			margin: 0;
			font-family: Arial, Tahoma, sans-serif;
		}
		#headimg h1 a{
			color:#<?php header_textcolor(); ?>;
			text-decoration: none;
			border-bottom: none;
		}
		#headimg #desc{
			color:#<?php header_textcolor(); ?>;
			font-size:1em;
			margin-top:-0.5em;
		}

		#desc {
			display: none;
		}

		<?php if ( 'blank' == get_header_textcolor() ) { ?>
		#headimg h1, #headimg #desc {
			display: none;
		}
		#headimg h1 a, #headimg #desc {
			color:#<?php echo HEADER_TEXTCOLOR; ?>;
		}
		<?php } ?>
	</style>
<?php
}
endif;

if ( !function_exists( 'bp_dtheme_custom_background_style' ) ) :
/**
 * The style for the custom background image or colour.
 *
 * Referenced via add_custom_background() in bp_dtheme_setup().
 *
 * @see _custom_background_cb()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_custom_background_style() {
	$background = get_background_image();
	$color = get_background_color();
	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $style && !$background ) {
		$style .= ' background-image: none;';

	} elseif ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
?>
	<style type="text/css">
		body { <?php echo trim( $style ); ?> }
	</style>
<?php
}
endif;

if ( !function_exists( 'bp_dtheme_header_style' ) ) :
/**
 * The styles for the post thumbnails / custom page headers.
 *
 * Referenced via add_custom_image_header() in bp_dtheme_setup().
 *
 * @global WP_Query $post The current WP_Query object for the current post or page
 * @since BuddyPress (1.2)
 */
function bp_dtheme_header_style() {
	global $post;

	$header_image = '';

	if ( is_singular() && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' );

		// $src, $width, $height
		if ( !empty( $image ) && $image[1] >= HEADER_IMAGE_WIDTH )
			$header_image = $image[0];
		else
			$header_image = get_header_image();

	} else {
		$header_image = get_header_image();
	}
?>

	<style type="text/css">
		<?php if ( !empty( $header_image ) ) : ?>
			#header { background-image: url(<?php echo $header_image ?>); }
		<?php endif; ?>

		<?php if ( 'blank' == get_header_textcolor() ) { ?>
		#header h1, #header #desc { display: none; }
		<?php } else { ?>
		#header h1 a, #desc { color:#<?php header_textcolor(); ?>; }
		<?php } ?>
	</style>

<?php
}
endif;

if ( !function_exists( 'bp_dtheme_widgets_init' ) ) :
/**
 * Register widgetised areas, including one sidebar and four widget-ready columns in the footer.
 *
 * To override bp_dtheme_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since BuddyPress (1.5)
 */
function bp_dtheme_widgets_init() {

	// Area 1, located in the sidebar. Empty by default.
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => __( 'The sidebar widget area', 'buddypress' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>'
	) );

	// Area 2, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'buddypress' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'buddypress' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'buddypress' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'buddypress' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'buddypress' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'bp_dtheme_widgets_init' );
endif;

if ( !function_exists( 'bp_dtheme_blog_comments' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own bp_dtheme_blog_comments(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @param mixed $comment Comment record from database
 * @param array $args Arguments from wp_list_comments() call
 * @param int $depth Comment nesting level
 * @see wp_list_comments()
 * @since BuddyPress (1.2)
 */
function bp_dtheme_blog_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type )
		return false;

	if ( 1 == $depth )
		$avatar_size = 50;
	else
		$avatar_size = 25;
	?>

	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-avatar-box">
			<div class="avb">
				<a href="<?php echo get_comment_author_url(); ?>" rel="nofollow">
					<?php if ( $comment->user_id ) : ?>
						<?php echo bp_core_fetch_avatar( array( 'item_id' => $comment->user_id, 'width' => $avatar_size, 'height' => $avatar_size, 'email' => $comment->comment_author_email ) ); ?>
					<?php else : ?>
						<?php echo get_avatar( $comment, $avatar_size ); ?>
					<?php endif; ?>
				</a>
			</div>
		</div>
		<div class="comment-content">
			<div class="comment-entry">
				<?php if ( $comment->comment_approved == '0' ) : ?>
				 	<em class="moderate"><?php _e( 'Your comment is awaiting moderation.', 'buddypress' ); ?></em>
				<?php endif; ?>

				<?php comment_text(); ?>
			</div>
			<div class="comment-options">
					<?php if ( comments_open() ) : ?>
						<?php comment_reply_link( array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ); ?>
					<?php endif; ?>

					<?php if ( current_user_can( 'edit_comment', $comment->comment_ID ) ) : ?>
						<?php printf( '<a class="button comment-edit-link bp-secondary-action" href="%1$s" title="%2$s">%3$s</a> ', get_edit_comment_link( $comment->comment_ID ), esc_attr__( 'Edit comment', 'buddypress' ), __( 'Edit', 'buddypress' ) ); ?>
					<?php endif; ?>

			</div>
			<div class="comment-meta">
				<p>
					<?php
						/* translators: 1: comment author url, 2: comment author name, 3: comment permalink, 4: comment date/timestamp*/
						printf( __( '<a href="%1$s" rel="nofollow">%2$s</a> said on <a href="%3$s"><span class="time-since">%4$s</span></a>', 'buddypress' ), get_comment_author_url(), get_comment_author(), get_comment_link(), get_comment_date() );
					?>
				</p>
			</div>
		</div>
		<br class="clear"/>

<?php
}
endif;

if ( !function_exists( 'bp_dtheme_page_on_front' ) ) :
/**
 * Return the ID of a page set as the home page.
 *
 * @return int|bool ID of page set as the home page
 * @since BuddyPress (1.2)
 */
function bp_dtheme_page_on_front() {
	if ( 'page' != get_option( 'show_on_front' ) )
		return false;

	return apply_filters( 'bp_dtheme_page_on_front', get_option( 'page_on_front' ) );
}
endif;

if ( !function_exists( 'bp_dtheme_activity_secondary_avatars' ) ) :
/**
 * Add secondary avatar image to this activity stream's record, if supported.
 *
 * @param string $action The text of this activity
 * @param BP_Activity_Activity $activity Activity object
 * @package BuddyPress Theme
 * @return string
 * @since BuddyPress (1.2.6)
 */
function bp_dtheme_activity_secondary_avatars( $action, $activity ) {
	switch ( $activity->component ) {
		case 'groups' :
		case 'friends' :
			// Only insert avatar if one exists
			if ( $secondary_avatar = bp_get_activity_secondary_avatar() ) {
				$reverse_content = strrev( $action );
				$position        = strpos( $reverse_content, 'a<' );
				$action          = substr_replace( $action, $secondary_avatar, -$position - 2, 0 );
			}
			break;
	}

	return $action;
}
add_filter( 'bp_get_activity_action_pre_meta', 'bp_dtheme_activity_secondary_avatars', 10, 2 );
endif;

if ( !function_exists( 'bp_dtheme_show_notice' ) ) :
/**
 * Show a notice when the theme is activated - workaround by Ozh (http://old.nabble.com/Activation-hook-exist-for-themes--td25211004.html)
 *
 * @since BuddyPress (1.2)
 */
function bp_dtheme_show_notice() {
	global $pagenow;

	// Bail if bp-default theme was not just activated
	if ( empty( $_GET['activated'] ) || ( 'themes.php' != $pagenow ) || !is_admin() )
		return;

	?>

	<div id="message" class="updated fade">
		<p><?php printf( __( 'Theme activated! This theme contains <a href="%s">custom header image</a> support and <a href="%s">sidebar widgets</a>.', 'buddypress' ), admin_url( 'themes.php?page=custom-header' ), admin_url( 'widgets.php' ) ); ?></p>
	</div>

	<style type="text/css">#message2, #message0 { display: none; }</style>

	<?php
}
add_action( 'admin_notices', 'bp_dtheme_show_notice' );
endif;

if ( !function_exists( 'bp_dtheme_main_nav' ) ) :
/**
 * wp_nav_menu() callback from the main navigation in header.php
 *
 * Used when the custom menus haven't been configured.
 *
 * @param array Menu arguments from wp_nav_menu()
 * @see wp_nav_menu()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_main_nav( $args ) {
	$pages_args = array(
		'depth'      => 0,
		'echo'       => false,
		'exclude'    => '',
		'title_li'   => ''
	);
	$menu = wp_page_menu( $pages_args );
	$menu = str_replace( array( '<div class="menu"><ul>', '</ul></div>' ), array( '<ul id="nav">', '</ul><!-- #nav -->' ), $menu );
	echo $menu;

	do_action( 'bp_nav_items' );
}
endif;

if ( !function_exists( 'bp_dtheme_page_menu_args' ) ) :
/**
 * Get our wp_nav_menu() fallback, bp_dtheme_main_nav(), to show a home link.
 *
 * @param array $args Default values for wp_page_menu()
 * @see wp_page_menu()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'bp_dtheme_page_menu_args' );
endif;

if ( !function_exists( 'bp_dtheme_comment_form' ) ) :
/**
 * Applies BuddyPress customisations to the post comment form.
 *
 * @param array $default_labels The default options for strings, fields etc in the form
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_comment_form( $default_labels ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$fields    =  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'buddypress' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'buddypress' ) . ( $req ? '<span class="required"> *</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'buddypress' ) . '</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
	);

	$new_labels = array(
		'comment_field'  => '<p class="form-textarea"><textarea name="comment" id="comment" cols="60" rows="10" aria-required="true"></textarea></p>',
		'fields'         => apply_filters( 'comment_form_default_fields', $fields ),
		'logged_in_as'   => '',
		'must_log_in'    => '<p class="alert">' . sprintf( __( 'You must be <a href="%1$s">logged in</a> to post a comment.', 'buddypress' ), wp_login_url( get_permalink() ) )	. '</p>',
		'title_reply'    => __( '', 'buddypress' )
	);

	return apply_filters( 'bp_dtheme_comment_form', array_merge( $default_labels, $new_labels ) );
}
add_filter( 'comment_form_defaults', 'bp_dtheme_comment_form', 10 );
endif;

if ( !function_exists( 'bp_dtheme_before_comment_form' ) ) :
/**
 * Adds the user's avatar before the comment form box.
 *
 * The 'comment_form_top' action is used to insert our HTML within <div id="reply">
 * so that the nested comments comment-reply javascript moves the entirety of the comment reply area.
 *
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_before_comment_form() {
?>
	<div class="comment-avatar-box">
		<div class="avb">
			<?php if ( bp_loggedin_user_id() ) : ?>
				<a href="<?php echo bp_loggedin_user_domain(); ?>">
					<?php echo get_avatar( bp_loggedin_user_id(), 50 ); ?>
				</a>
			<?php else : ?>
				<?php echo get_avatar( 0, 50 ); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="comment-content standard-form">
<?php
}
add_action( 'comment_form_top', 'bp_dtheme_before_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_after_comment_form' ) ) :
/**
 * Closes tags opened in bp_dtheme_before_comment_form().
 *
 * @see bp_dtheme_before_comment_form()
 * @see comment_form()
 * @since BuddyPress (1.5)
 */
function bp_dtheme_after_comment_form() {
?>

	</div><!-- .comment-content standard-form -->

<?php
}
add_action( 'comment_form', 'bp_dtheme_after_comment_form' );
endif;

if ( !function_exists( 'bp_dtheme_sidebar_login_redirect_to' ) ) :
/**
 * Adds a hidden "redirect_to" input field to the sidebar login form.
 *
 * @since BuddyPress (1.5)
 */
function bp_dtheme_sidebar_login_redirect_to() {
	$redirect_to = !empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	$redirect_to = apply_filters( 'bp_no_access_redirect', $redirect_to ); ?>

	<input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_to ); ?>" />

<?php
}
add_action( 'bp_sidebar_login_form', 'bp_dtheme_sidebar_login_redirect_to' );
endif;

if ( !function_exists( 'bp_dtheme_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @global WP_Query $wp_query
 * @param string $nav_id DOM ID for this navigation
 * @since BuddyPress (1.5)
 */
function bp_dtheme_content_nav( $nav_id ) {
	global $wp_query;

	if ( !empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 1 ) : ?>

		<div id="<?php echo $nav_id; ?>" class="navigation">
			<div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'buddypress' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'buddypress' ) ); ?></div>
		</div><!-- #<?php echo $nav_id; ?> -->

	<?php endif;
}
endif;

/**
 * Adds the no-js class to the body tag.
 *
 * This function ensures that the <body> element will have the 'no-js' class by default. If you're
 * using JavaScript for some visual functionality in your theme, and you want to provide noscript
 * support, apply those styles to body.no-js.
 *
 * The no-js class is removed by the JavaScript created in bp_dtheme_remove_nojs_body_class().
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_remove_nojs_body_class()
 */
function bp_dtheme_add_nojs_body_class( $classes ) {
	$classes[] = 'no-js';
	return array_unique( $classes );
}
add_filter( 'bp_get_the_body_class', 'bp_dtheme_add_nojs_body_class' );

/**
 * Dynamically removes the no-js class from the <body> element.
 *
 * By default, the no-js class is added to the body (see bp_dtheme_add_no_js_body_class()). The
 * JavaScript in this function is loaded into the <body> element immediately after the <body> tag
 * (note that it's hooked to bp_before_header), and uses JavaScript to switch the 'no-js' body class
 * to 'js'. If your theme has styles that should only apply for JavaScript-enabled users, apply them
 * to body.js.
 *
 * This technique is borrowed from WordPress, wp-admin/admin-header.php.
 *
 * @package BuddyPress
 * @since BuddyPress (1.5).1
 * @see bp_dtheme_add_nojs_body_class()
 */
function bp_dtheme_remove_nojs_body_class() {
?><script type="text/javascript">//<![CDATA[
(function(){var c=document.body.className;c=c.replace(/no-js/,'js');document.body.className=c;})();
//]]></script>
<?php
}
add_action( 'bp_before_header', 'bp_dtheme_remove_nojs_body_class' );

function hide_dislike() {
    echo '<style type="text/css">
            .lb-dislike { display: none !important; }
          </style>';
}
add_action('admin_head', 'hide_dislike');





/********************************* RECIPE BY Jiranuch ********************************/
add_action( 'init', 'create_post_type' );

function create_post_type() {
    register_post_type( 'recipes',
        array(
            'labels' => array(
                'name' => 'เมนูอาหาร',
                'singular_name' => 'Recipe',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Recipe',
                'edit' => 'Edit',
                'edit_item' => 'Edit Recipe',
                'new_item' => 'New Recipe',
                'view' => 'View',
                'view_item' => 'View Recipe',
                'search_items' => 'Search Recipes',
                'not_found' => 'No Recipes found',
                'not_found_in_trash' => 'No Recipes found in Trash',
                'parent' => 'Parent Recipe'
            ),
 
            'public' => true,
            'menu_position' => 19,
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true
	
        )
    );	
	register_post_type( 'Tip',
        array(
            'labels' => array(
                'name' => 'เคล็ดลับคู่หู',
                'singular_name' => 'Tip',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Tip',
                'edit' => 'Edit',
                'edit_item' => 'Edit Tip',
                'new_item' => 'New Tip',
                'view' => 'View',
                'view_item' => 'View Tip',
                'search_items' => 'Search Tip',
                'not_found' => 'No Tip found',
                'not_found_in_trash' => 'No Tip found in Trash',
                'parent' => 'Parent Tip',
				'rewrite' => false
            ),
 
            'public' => true,
            'menu_position' => 20,
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	register_post_type( 'SetMenu',
        array(
            'labels' => array(
                'name' => 'อาหารเซต',
                'singular_name' => 'SetMenu',
                'add_new' => 'Add SetMenu',
                'add_new_item' => 'Add New SetMenu',
                'edit' => 'Edit',
                'edit_item' => 'Edit SetMenu',
                'new_item' => 'New SetMenu',
                'view' => 'View',
                'view_item' => 'View SetMenu',
                'search_items' => 'Search SetMenu',
                'not_found' => 'No SetMenu found',
                'not_found_in_trash' => 'No SetMenu found in Trash',
                'parent' => 'Parent SetMenu'
            ),
 
            'public' => true,
            'menu_position' => 21,
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	register_post_type( 'celebcook',
        array(
            'labels' => array(
                'name' => 'เข้าครัวกับคนดัง',
                'singular_name' => 'celebcook',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 22,
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
			
			
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	register_post_type( 'bistro',
        array(
            'labels' => array(
                'name' => 'ร้านอาหาร',
                'singular_name' => 'bistro',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 23,
            'supports' => array( 'title', 'thumbnail','editor','comments'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	register_post_type( 'bistroImage',
        array(
            'labels' => array(
                'name' => 'bistro Image',
                'singular_name' => 'bistroImage',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => false,
            'menu_position' => 23,
            'supports' => array( 'title', 'thumbnail','editor','comments'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	
	
	register_post_type( 'article',
        array(
            'labels' => array(
                'name' => 'บทความ',
                'singular_name' => 'article',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 25,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	
	register_post_type( 'variety',
        array(
            'labels' => array(
                'name' => 'วาไรตี้้ร้านอร่อย',
                'singular_name' => 'variety',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 1,
            'supports' => array( 'title', 'editor','thumbnail'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	
	register_post_type( 'trend',
        array(
            'labels' => array(
                'name' => 'Trend Zone',
                'singular_name' => 'trend',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 26,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	register_post_type( 'review',
        array(
            'labels' => array(
                'name' => 'Review',
                'singular_name' => 'review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 27,
            'supports' => array( 'title', 'editor', 'comments','thumbnail'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	register_post_type( 'special_review',
        array(
            'labels' => array(
                'name' => 'Special Review',
                'singular_name' => 'special_review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 28,
            'supports' => array( 'title', 'comments','thumbnail'),
            'has_archive' => true

			
        )
    );
	register_post_type( 'likesara',
        array(
            'labels' => array(
                'name' => 'Like Sara',
                'singular_name' => 'likesara',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit',
                'new_item' => 'New',
                'view' => 'View',
                'view_item' => 'View',
                'search_items' => 'Search',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in Trash',
                'parent' => 'Parent'
            ),
 
            'public' => true,
            'menu_position' => 29,
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            //'menu_icon' => get_template_directory_uri() . '/images/news-icon.png',
            'has_archive' => true

			
        )
    );
	
	//create by palm
	register_post_type( 'store',
        array(
            'labels' => array(
                'name' => 'Store',
                'singular_name' => 'store',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New',
                'edit' => 'Edit',
                'edit_item' => 'Edit Shop',
                'new_item' => 'New Shop',
                'view' => 'View',
                'view_item' => 'View Shop',
                'search_items' => 'Search Shop',
                'not_found' => 'No shop found',
                'not_found_in_trash' => 'No Shop found in Trash',
                'parent' => 'Parent Shop'
            ),
 
            'public' => true,
            'menu_position' => 19,
            'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields'),
            'taxonomies' => array('post_tag'),
            /*'menu_icon' => get_template_directory_uri() . '/images/news-icon.png', */
            'has_archive' => true

			
        )
    );
	
	flush_rewrite_rules();
}


//CREATED BY EaRNG




//checkbox_lovethailand
function check_lovethailand( $form_id, $post_id, $form_settings ) {    
	?>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<style>
	.lovethailand-txt {display:none;}
	</style>
	<script type="text/javascript">
                        jQuery(function($) {
							if ($('.wpuf_lovethailand_258').is(':checked')) {
								  $('.lovethailand-txt').css('display','block');
							} else {
								   $('.lovethailand-txt').css('display','none');	
							};
							
                            $('.wpuf_lovethailand_258').click(function(){
                                if($(this).prop("checked") == true){
                                    $('.lovethailand-txt').css('display','block');
                                }
                                else if($(this).prop("checked") == false){
                                    $('.lovethailand-txt').css('display','none');
                                }
                            });
                        });
    </script>
    <?php
	
}
add_action( 'check_lovethailand', 'check_lovethailand', 10, 3 );


//create column 'เมนูรักประเทศไทย'
add_filter('manage_posts_columns', 'manage_recipes_columns');
function manage_recipes_columns( $columns ) {
		$post_type = get_post_type();
		if($post_type == 'recipes'){
			$columns["lovethailand"] = "เมนูรักประเทศไทย";
			$columns["admin_approve"] = "Approve";
		}
    return $columns;
}

//query database
add_action('manage_posts_custom_column', 'my_recipes_column', 10, 2);
function my_recipes_column( $colname, $cptid ) {
	
	switch ($colname) {
		case 'lovethailand': ?>  
			 <?php echo get_post_meta( $cptid, 'lovethailand', true ); ?>   
			 <?php break;
		case 'admin_approve': ?>  
			 <?php echo '<div id="admin_approve-' . $cptid . '">' . get_post_meta( $cptid, 'admin_approve', true ) . '</div>'; ?>   
			 <?php break;
    }
	
}
 /* Recipes quick edit - admin_approve */

add_action( 'bulk_edit_custom_box', 'admin_approve_add_to_bulk_quick_edit_custom_box', 10, 2 );
add_action( 'quick_edit_custom_box', 'admin_approve_add_to_bulk_quick_edit_custom_box', 10, 2 );
function admin_approve_add_to_bulk_quick_edit_custom_box( $column_name, $post_type ) {
   switch ( $post_type ) {
      case 'recipes':

         switch( $column_name ) {
			 case 'admin_approve':
				   ?><fieldset class="inline-edit-col-right">
					  <div class="inline-edit-group">
						 <label>
                         	<input type="checkbox" name="admin_approve"/>
							<span class="title">รับเข้าเป็นเมนูรักประเทศไทย</span>
						 </label>
					  </div>
				   </fieldset><?php
				   break;
         }
         break;

   }
}


add_action( 'admin_print_scripts-edit.php', 'admin_approve_enqueue_edit_scripts' );
function admin_approve_enqueue_edit_scripts() {
   wp_enqueue_script( 'admin_approve-admin-edit', get_bloginfo( 'stylesheet_directory' ) . '/js/quick_edit.js', array( 'jquery', 'inline-edit-post' ), '', true );
}

add_action( 'save_post','admin_approve_save_post', 10, 2 );
function admin_approve_save_post( $post_id, $post ) {

   // don't save for autosave
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return $post_id;

   // dont save for revisions
   if ( isset( $post->post_type ) && $post->post_type == 'revision' )
      return $post_id;

   switch( $post->post_type ) {

      case 'recipes':

         // release date
	 // Because this action is run in several places, checking for the array key keeps WordPress from editing
         // data that wasn't in the form, i.e. if you had this post meta on your "Quick Edit" but didn't have it
         // on the "Edit Post" screen.
		
		if ( isset( $_POST['admin_approve'] ) ) {
			update_post_meta($post_id, 'admin_approve', 'yes');
		} else {
			update_post_meta($post_id, 'admin_approve', 'no');
		}		
	 break;

   }

}  






add_action( 'wp_ajax_recipes_save_bulk_edit', 'admin_approve_save_bulk_edit' );
function admin_approve_save_bulk_edit() {
   // get our variables
   $post_ids = ( isset( $_POST[ 'post_ids' ] ) && !empty( $_POST[ 'post_ids' ] ) ) ? $_POST[ 'post_ids' ] : array();
   $admin_approve = ( isset( $_POST[ 'admin_approve' ] ) && !empty( $_POST[ 'admin_approve' ] ) ) ? $_POST[ 'admin_approve' ] : 'no';
   // if everything is in order
   if ( !empty( $post_ids ) && is_array( $post_ids ) && !empty( $admin_approve ) ) {
      foreach( $post_ids as $post_id ) {
         update_post_meta( $post_id, 'admin_approve', $admin_approve );
      }
   }
}





add_filter('query_vars', 'lovethailand_register_query_vars' );
function lovethailand_register_query_vars( $qvars ){
    //Add these query variables
    $qvars[] = 'lovethailand';
    return $qvars;
}

//option filter   
add_action( 'restrict_manage_posts', 'lovethailand_restrict_posts_by_metavalue' );
function lovethailand_restrict_posts_by_metavalue() {
    global $typenow;
  		
    if ($typenow == 'recipes') {
        
        $output = "<select style='width:150px' name='lovethailand' class='postform'>\n";
        $output .= '<option '.selected($selected,0,false).' value="">'.__('Show All','').'</option>';
        $output .= "<option value='lovethailand'>ผู้สมัครเข้าร่วมเป็นเมนูรักประเทศไทย</option>";    
        $output .= "</select>\n";       
    echo $output;
    }
}

//query database for filtering
add_action( 'pre_get_posts', 'lovethailand_pre_get_posts' );
function lovethailand_pre_get_posts( $query ) {

    //Only alter query if custom variable is set.
    $lovethailand_str = $query->get('lovethailand');
    if( !empty($lovethailand_str) ){

        $meta_query[] = array(
            'key' => 'lovethailand',
            'value' => 'สมัครเข้าร่วมเมนูรักประเทศไทย',
            'compare' => 'LIKE',
        );
        $query->set('meta_query',$meta_query);

    }
}


 /*
function your_theme_wp_editor(){
    ob_start();
    wp_editor( '', 'comment', array(
        'media_buttons' => true,
        'textarea_rows' => '2',
        'tinymce' => array(
            'plugins' => 'inlinepopups, wordpress, wplink, wpdialogs, wpeditimage',
            'theme_advanced_buttons1' => 'bold, italic, underline, forecolor, backcolor, bullist, numlist, link, unlink, justifyleft, justifycenter, justifyright, justifyfull, image',
            'theme_advanced_buttons2' => ''
            )
       'quicktags' => array('buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close')
        )
    );
 
    return ob_get_clean();
}
 
 function your_theme_comment_form_defaults($args) {
    $args['comment_field'] = your_theme_wp_editor();
 
    return $args;
}
add_filter('comment_form_defaults', 'your_theme_comment_form_defaults');

function bp_include_users_contributor() {
	$included_users = implode(',',get_users('role=contributor&fields=ID'));
	return $included_users;
}*/
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = $excerpt.'... <a href="'.$permalink.'"  class="read-more">อ่านต่อ</a>';
  return $excerpt;
}





// Time ago
function themeblvd_time_ago() {
 
	global $post;
 
	$date = get_post_time('G', true, $post);
 
	/**
	 * Where you see 'themeblvd' below, you'd
	 * want to replace those with whatever term
	 * you're using in your theme to provide
	 * support for localization.
	 */ 
 
	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'ปี', 'themeblvd' ), __( 'ปี', 'themeblvd' ) ),
		array( 60 * 60 * 24 * 30 , __( 'เดือน', 'themeblvd' ), __( 'เดือน', 'themeblvd' ) ),
		array( 60 * 60 * 24 * 7, __( 'อาทิตย์', 'themeblvd' ), __( 'อาทิตย์', 'themeblvd' ) ),
		array( 60 * 60 * 24 , __( 'วัน', 'themeblvd' ), __( 'วัน', 'themeblvd' ) ),
		array( 60 * 60 , __( 'ชั่วโมง', 'themeblvd' ), __( 'ชั่วโมง', 'themeblvd' ) ),
		array( 60 , __( 'นาที', 'themeblvd' ), __( 'นาที', 'themeblvd' ) ),
		array( 1, __( 'วินาที', 'themeblvd' ), __( 'วินาที', 'themeblvd' ) )
	);
 
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
 
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
 
	// Difference in seconds
	$since = $newer_date - $date;
 
	// Something went wrong with date calculation and we ended up with a negative date.
	if ( 0 > $since )
		return __( 'sometime', 'themeblvd' );
 
	/**
	 * We only want to output one chunks of time here, eg:
	 * x years
	 * xx months
	 * so there's only one bit of calculation below:
	 */
 
	//Step one: the first chunk
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
 
		// Finding the biggest chunk (if the chunk fits, break)
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
 
	// Set output var
	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
 
 
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'seconds', 'themeblvd' );
	}
 
	$output .= __('ที่แล้ว', 'themeblvd');
 
	return $output;
}
 
// Filter our themeblvd_time_ago() function into WP's the_time() function
add_filter('the_time', 'themeblvd_time_ago');





// Time ago
function get_time_ago($post_id) {
	$date = get_post_time('G', true, $post_id);
 
	/**
	 * Where you see 'themeblvd' below, you'd
	 * want to replace those with whatever term
	 * you're using in your theme to provide
	 * support for localization.
	 */ 
 
	// Array of time period chunks
	$chunks = array(
		array( 60 * 60 * 24 * 365 , __( 'ปี', 'themeblvd' ), __( 'ปี', 'themeblvd' ) ),
		array( 60 * 60 * 24 * 30 , __( 'เดือน', 'themeblvd' ), __( 'เดือน', 'themeblvd' ) ),
		array( 60 * 60 * 24 * 7, __( 'อาทิตย์', 'themeblvd' ), __( 'อาทิตย์', 'themeblvd' ) ),
		array( 60 * 60 * 24 , __( 'วัน', 'themeblvd' ), __( 'วัน', 'themeblvd' ) ),
		array( 60 * 60 , __( 'ชั่วโมง', 'themeblvd' ), __( 'ชั่วโมง', 'themeblvd' ) ),
		array( 60 , __( 'นาที', 'themeblvd' ), __( 'นาที', 'themeblvd' ) ),
		array( 1, __( 'วินาที', 'themeblvd' ), __( 'วินาที', 'themeblvd' ) )
	);
 
	if ( !is_numeric( $date ) ) {
		$time_chunks = explode( ':', str_replace( ' ', ':', $date ) );
		$date_chunks = explode( '-', str_replace( ' ', '-', $date ) );
		$date = gmmktime( (int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0] );
	}
 
	$current_time = current_time( 'mysql', $gmt = 0 );
	$newer_date = strtotime( $current_time );
 
	// Difference in seconds
	$since = $newer_date - $date;
 
	// Something went wrong with date calculation and we ended up with a negative date.
	if ( 0 > $since )
		return __( 'sometime', 'themeblvd' );
 
	/**
	 * We only want to output one chunks of time here, eg:
	 * x years
	 * xx months
	 * so there's only one bit of calculation below:
	 */
 
	//Step one: the first chunk
	for ( $i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];
 
		// Finding the biggest chunk (if the chunk fits, break)
		if ( ( $count = floor($since / $seconds) ) != 0 )
			break;
	}
 
	// Set output var
	$output = ( 1 == $count ) ? '1 '. $chunks[$i][1] : $count . ' ' . $chunks[$i][2];
 
 
	if ( !(int)trim($output) ){
		$output = '0 ' . __( 'seconds', 'themeblvd' );
	}
 
	$output .= __('ที่แล้ว', 'themeblvd');
 
	return $output;
}
 
// Filter our themeblvd_get_time_ago() function into WP's the_time() function
//add_filter('get_the_times', 'themeblvd_get_time_ago');
























//Add Thumbnail image size
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 's-thumb', 80, 80, true );
	add_image_size( 'variety', 370, 240, true );
	add_image_size( 'celeb', 580, 380, true );
    add_image_size( 'recipe', 226, 330, true );
	add_image_size( 'trend', 445, 350, true );
	add_image_size( 'article', 340, 235, true );
	add_image_size( 'recipe2', 475, 345, true );
	add_image_size( 'special', 218, 240, true );
	add_image_size( 'special_feature', 1036, 309, true );
	add_image_size( 'set-menu-1', 360, 325, true );
	add_image_size( 'set-menu-2', 305, 270, true );
	add_image_size( 'tip', 335, 210, true );
}



//checkbox_meal BACK UP
/* function render_checkbox_meal( $form_id, $post_id, $form_settings ) {
        $checkfield1 = get_post_meta($post_id, 'check_meal1', true);
		$checkfield2 = get_post_meta($post_id, 'check_meal2', true);
		$checkfield3 = get_post_meta($post_id, 'check_meal3', true);
		$checkfield4 = get_post_meta($post_id, 'check_meal4', true);				
    ?>
	<div class="wpuf-label">
        <label> เหมาะเป็นอาหารมื้อ </label>
    </div>
	<div class="wpuf-fields">
		<input type="checkbox" name="check_field1" id="checkbox1" class="css-checkbox" value="breakfast" <?php checked( $checkfield1, 'breakfast' ); ?>/>
				<label for="checkbox1" class="css-label radGroup1">เช้า</label>
		<input type="checkbox" name="check_field2" id="checkbox2" class="css-checkbox" value="lunch" <?php checked( $checkfield2, 'lunch' ); ?>/>
				<label for="checkbox2" class="css-label radGroup1">กลางวัน</label>
		<input type="checkbox" name="check_field3" id="checkbox3" class="css-checkbox" value="dinner" <?php checked( $checkfield3, 'dinner' ); ?>/>
				<label for="checkbox3" class="css-label radGroup1">เย็น</label>
		<input type="checkbox" name="check_field4" id="checkbox4" class="css-checkbox" value="supper" <?php checked( $checkfield4, 'supper' ); ?>/>
				<label for="checkbox4" class="css-label radGroup1">ดึก</label>
	</div>		
    <?php }
add_action( 'checkbox_meal', 'render_checkbox_meal', 10, 3 );
function update_checkbox_meal( $post_id ) {   
	$checkdata1 = sanitize_text_field( $_POST['check_field1'] );
	$checkdata2 = sanitize_text_field( $_POST['check_field2'] );
	$checkdata3 = sanitize_text_field( $_POST['check_field3'] );
	$checkdata4 = sanitize_text_field( $_POST['check_field4'] );
	update_post_meta( $post_id, 'check_meal1', $checkdata1 ); 
	update_post_meta( $post_id, 'check_meal2', $checkdata2 );  
	update_post_meta( $post_id, 'check_meal3', $checkdata3 );  
	update_post_meta( $post_id, 'check_meal4', $checkdata4 );  	
}
add_action( 'wpuf_add_post_after_insert', 'update_checkbox_meal' );
add_action( 'wpuf_edit_post_after_update', 'update_checkbox_meal' );
*/


function render_checkbox_meal( $form_id, $post_id, $form_settings ) {
	$value = array();
	$items = array('breakfast','lunch','dinner','supper');
	$itemsTH = array('เช้า','กลางวัน','เย็น','ดึก');
		if ( $post_id ) {
            $value = get_post_meta($post_id, 'check_meal', true);
        }
    ?>
	<div class="wpuf-label">
        <label> เหมาะเป็นอาหารมื้อ </label>
    </div>
	<div class="wpuf-fields">
		<div class="mealRating">
		
			<?php
			$count = 0;
			 foreach ($items as $item) {
						if (in_array($item, $value)) {
							$checked = "checked";
						}else{
							$checked = "unchecked";
						}
					
				   echo '<input type="checkbox" name="checkbox_meal1[]" id="checkbox-'.$count.'" class="css-checkbox" value="'.$item.'"'  . $checked . '/>
						<label for="checkbox-'.$count.'"" class="css-label radGroup1">'.$itemsTH[$count].'</label>';
					$count++;
			   }
			?>
			
		</div>
	</div>	
    <?php
	
}
add_action( 'checkbox_meal', 'render_checkbox_meal', 10, 3 );

function update_checkbox_meal( $post_id ) {   
	if ( isset( $_POST['checkbox_meal1'] ) ) {
        update_post_meta( $post_id, 'check_meal', $_POST['checkbox_meal1'] );
    }
}

add_action( 'wpuf_add_post_after_insert', 'update_checkbox_meal' );
add_action( 'wpuf_edit_post_after_update', 'update_checkbox_meal' );

/********************************************************  ระดับความง่าย  *************************************************************/

function render_smileRating( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'recipe_rating', true );
    }
    ?>
    <div class="wpuf-label">
        <label>ระดับความง่าย</label>
    </div>
    <div class="wpuf-fields">
		<div class="smileRating">
			<div>
				<div>
					<div>
						<div>
							<input  type="radio" name="easy_rate" value="1" <?php checked( $value, '1' ); ?>/>
							<label for="rating1"><span>1</span></label>
						</div>
						<input type="radio" name="easy_rate" value="2" <?php checked( $value, '2' ); ?>/>
						<label for="rating2"><span>2</span></label>
					</div>
					<input type="radio" name="easy_rate" value="3" <?php checked( $value, '3' ); ?>/>
					<label for="rating3"><span>3</span></label>
				</div>
				<input type="radio" name="easy_rate" value="4" <?php checked( $value, '4' ); ?>/>
				<label for="rating4"><span>4</span></label>
			</div>
			<input type="radio" name="easy_rate" value="5" <?php checked( $value, '5' ); ?>>
			<label for="rating5"><span>5</span></label>
		</div>
    </div>
    <?php
}
add_action( 'smileRating', 'render_smileRating', 10, 3 );

function update_smileRating( $post_id ) {
    if ( isset( $_POST['easy_rate'] ) ) {
        update_post_meta( $post_id, 'recipe_rating', $_POST['easy_rate'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_smileRating' );
add_action( 'wpuf_edit_post_after_update', 'update_smileRating' );



function nice_number($num) {
		//echo 'nice number= '.nice_number('5,691');
		$num = (0+str_replace(",","",$num));
		
        if(!is_numeric($num)) return false;
        
        if($num>1000000000000) return round(($num/1000000000000),0).' t';
        else if($num>1000000000) return round(($num/1000000000),0).' b';
        else if($num>1000000) return round(($num/1000000),0).' m';
        else if($num>=1000) return round(($num/1000),1).' k';

		return number_format( $num );	
   }
/*********************************  End ระดับความง่าย  *************************************************************/

/*
function setup_custom_nav() {
  global $bp;
  $bp->bp_options_nav['profile']['change-avatar']['name'] = 'อัพเดทรูปประจำตัว';
  bp_core_new_subnav_item( array(
    'name' => __( 'ตั้งค่าบัญชีผู้ใช้', 'buddypress' ),
    'slug' => 'general',
    'parent_url' => $bp->loggedin_user->domain . 'profile/',
    'parent_slug' => 'profile',
    'screen_function' => 'ca_screen_function',
    'position' => 30,
  ) );
}

add_action( 'bp_setup_nav', 'setup_custom_nav');

function ca_screen_function() {
  add_action( 'bp_template_content', 'change_profile_picture_screen_content' );
  bp_core_load_template( apply_filters( 'xprofile_template_general', 'members/single/profile' ) );
  xprofile_screen_change_avatar();

}

function change_profile_picture_screen_content() {
  bp_get_template_part( 'members/single/profile/general' );
}
*/


  

function add_settings_subnav_tab() {
        global $bp;
        // rename general settings tab
        //$bp->bp_options_nav['settings']['general']['name'] = 'ตั้งค่าบัญชีผู้ใช้';
        // remove settings menu tab
        unset($bp->bp_nav['settings']);
        // add 'general' sub-menu tab
		
        bp_core_new_subnav_item( array(
                'name' => 'ตั้งค่าบัญชีผู้ใช้',
                'slug' => 'general',
                'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['profile']['slug'] . '/',
                'parent_slug' => $bp->bp_nav['profile']['slug'],
				'user_has_access' => bp_core_can_edit_settings(),
				'screen_function' => 'bp_settings_screen_general',
                'position' => 30
                )
        );
		bp_core_new_subnav_item( array(
                'name' => 'รีวิวของฉัน',
                'slug' => 'review',
                'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['activity']['slug'] . '/',
                'parent_slug' => $bp->bp_nav['activity']['slug'],
				'screen_function' => 'bp_activity_screen_my_activity',
                'position' => 40
                )
        );
		bp_core_new_subnav_item( array(
                'name' => 'รูปภาพของฉัน',
                'slug' => 'picture',
                'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['activity']['slug'] . '/',
                'parent_slug' => $bp->bp_nav['activity']['slug'],
				'screen_function' => 'bp_activity_screen_my_activity',
                'position' => 50
                )
        );
		bp_core_new_subnav_item( array(
                'name' => 'คลิปของฉัน',
                'slug' => 'clip',
                'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['activity']['slug'] . '/',
                'parent_slug' => $bp->bp_nav['activity']['slug'],
				'screen_function' => 'bp_activity_screen_my_activity',
                'position' => 60
                )
        );
		bp_core_new_subnav_item( array(
                'name' => 'เมนูอาหารของฉัน',
                'slug' => 'recipe',
                'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['activity']['slug'] . '/',
                'parent_slug' => $bp->bp_nav['activity']['slug'],
				'screen_function' => 'bp_activity_screen_my_activity',
                'position' => 70
                )
        );
}
 /*
function change_profile_picture(){
        add_action( 'bp_template_content', 'change_profile_picture_screen_content' );
        xprofile_screen_change_avatar();     
}
 
add_filter('xprofile_template_change_avatar', 'filter_changeavatar_template');
function filter_changeavatar_template($template){
    return 'members/single/plugins';
}
function change_profile_picture_screen_content() {
        bp_get_template_part( 'members/single/settings/general' );
}*/
 
add_action( 'bp_setup_nav', 'add_settings_subnav_tab', 100 );







//-------------------------------End EaRNG----------------------------------


// ppk add dynamic field celeb clip
/**
* Add the input field to the form
*
* @param int $form_id
* @param null|int $post_id
* @param array $form_settings
*/


function celeb_clip_fn( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'celeb_youtube_url', true );
    }
    ?>
 
 <style>
.celeb_upload_clip {display:none;}
.celeb_youtube_url {display:none;}
</style>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<!-- <input type="button" id="insertClipChoose" onclick="insertclipVal()" value="OK"> -->
<!-- <p id="test" onclick="insertclipVal()">.....</p> -->

<script type="text/javascript">
 $(".insertclip").change(insertclipVal);

function insertclipVal() {	
	if($(".insertclip option:selected").text() == 'Youtube URL'){
		$('.celeb_upload_clip').hide();
		$('.celeb_youtube_url').show();
	}else{
		$('.celeb_youtube_url').hide();
		$('.celeb_upload_clip').show();
	}
 }
	// alert($(".insertclip option:selected").val());

	
	
	
</script>	
    <?php	
} // close function celeb_clip_fn
add_action( 'celeb_clip', 'celeb_clip_fn', 10, 3 );
//end ppk 

/********************************************************  คะแนนร้าน *************************************************************/

function render_starRating( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'review_rating', true );
    }
    ?>
    <div class="wpuf-label">
        <label>คะแนนร้าน</label>
    </div>
    <div class="wpuf-fields">
		<div class="starRating">
			<div>
				<div>
					<div>
						<div>
							<input  type="radio" name="point_rate" value="1" <?php checked( $value, '1' ); ?>>
							<label for="rating1"><span>1</span></label>
						</div>
						<input type="radio" name="point_rate" value="2" <?php checked( $value, '2' ); ?>>
						<label for="rating2"><span>2</span></label>
					</div>
					<input type="radio" name="point_rate" value="3" <?php checked( $value, '3' ); ?>>
					<label for="rating3"><span>3</span></label>
				</div>
				<input type="radio" name="point_rate" value="4" <?php checked( $value, '4' ); ?>>
				<label for="rating4"><span>4</span></label>
			</div>
			<input type="radio" name="point_rate" value="5" <?php checked( $value, '5' ); ?>>
			<label for="rating5"><span>5</span></label>
		</div>
    </div>
    <?php
}
add_action( 'starRating', 'render_starRating', 10, 3 );

function update_starRating( $post_id ) {
    if ( isset( $_POST['point_rate'] ) ) {
        update_post_meta( $post_id, 'review_rating', $_POST['point_rate'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_starRating' );
add_action( 'wpuf_edit_post_after_update', 'update_starRating' );
/*********************************  End คะแนนร้าน  *************************************************************/


/******************************************************** บรรยากาศ *************************************************************/
function render_enviRating( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'review_environment', true );
    }
    ?>
	
    <div class="wpuf-label">
        <label>บรรยากาศ</label>
    </div>
    <div class="wpuf-fields">
		<div class="smileRating">
			<div>
				<div>
					<input  type="radio" name="envi_rating" value="1" <?php checked( $value, '1' ); ?>>
					<label for="rating1"><span>1</span></label>
				</div>
				<input  type="radio" name="envi_rating" value="2" <?php checked( $value, '2' ); ?>>
				<label for="rating2"><span>2</span></label>
			</div>
			<input  type="radio" name="envi_rating" value="3" <?php checked( $value, '3' ); ?>>
			<label for="rating3"><span>3</span></label>
		</div>
    </div>
    <?php
}
add_action( 'enviRating', 'render_enviRating', 10, 3 );

function update_enviRating( $post_id ) {
    if ( isset( $_POST['envi_rating'] ) ) {
        update_post_meta( $post_id, 'review_environment', $_POST['envi_rating'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_enviRating' );
add_action( 'wpuf_edit_post_after_update', 'update_enviRating' );
/******************************** End บรรยากาศ *************************************************************/

/******************************************************** บริการ *************************************************************/
function render_serviceRating( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'review_service', true );
    }
    ?>
    <div class="wpuf-label">
        <label>การบริการ</label>
    </div>
    <div class="wpuf-fields">
		<div class="smileRating">
			<div>
				<div>
					<input  type="radio" name="service_rating" value="1" <?php checked( $value, '1' ); ?>>
					<label for="rating1"><span>1</span></label>
				</div>
				<input type="radio" name="service_rating" value="2" <?php checked( $value, '2' ); ?>>
				<label for="rating2"><span>2</span></label>
			</div>
			<input  type="radio" name="service_rating" value="3" <?php checked( $value, '3' ); ?>>
			<label for="rating3"><span>3</span></label>
		</div>
    </div>
    <?php
}
add_action( 'serviceRating', 'render_serviceRating', 10, 3 );

function update_serviceRating( $post_id ) {
    if ( isset( $_POST['service_rating'] ) ) {
        update_post_meta( $post_id, 'review_service', $_POST['service_rating'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_serviceRating' );
add_action( 'wpuf_edit_post_after_update', 'update_serviceRating' );
/************************************** End บริการ *************************************************************/

/******************************************************** รสชาติ *****************************************************************/
function render_tasteRating( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'review_taste', true );
    }
    ?>
    <div class="wpuf-label">
        <label>รสชาติ</label>
    </div>
    <div class="wpuf-fields">
		<div class="smileRating">
			<div>
				<div>
					<input  type="radio" name="taste_rating" value="1" <?php checked( $value, '1' ); ?>>
					<label for="rating1"><span>1</span></label>
				</div>
				<input type="radio" name="taste_rating" value="2" <?php checked( $value, '2' ); ?>>
				<label for="rating2"><span>2</span></label>
			</div>
			<input  type="radio" name="taste_rating" value="3" <?php checked( $value, '3' ); ?>>
			<label for="rating3"><span>3</span></label>
		</div>
    </div>
    <?php
}
add_action( 'tasteRating', 'render_tasteRating', 10, 3 );

function update_tasteRating( $post_id ) {
    if ( isset( $_POST['taste_rating'] ) ) {
        update_post_meta( $post_id, 'review_taste', $_POST['taste_rating'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_tasteRating' );
add_action( 'wpuf_edit_post_after_update', 'update_tasteRating' );
/************************************** End รสชาติ *************************************************************/


/******************************************************** ความคุ้มค่า *************************************************************/
function render_worthinessRating( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'review_worthiness', true );
    }
    ?>
    <div class="wpuf-label">
        <label>ความคุ้มค่า</label>
    </div>
    <div class="wpuf-fields">
		<div class="smileRating">
			<div>
				<div>
					<input  type="radio" name="worthiness_rating" value="1" <?php checked( $value, '1' ); ?>>
					<label for="rating1"><span>1</span></label>
				</div>
				<input type="radio" name="worthiness_rating" value="2" <?php checked( $value, '2' ); ?>>
				<label for="rating2"><span>2</span></label>
			</div>
			<input  type="radio" name="worthiness_rating" value="3" <?php checked( $value, '3' ); ?>>
			<label for="rating3"><span>3</span></label>
		</div>
    </div>
    <?php
}
add_action( 'worthinessRating', 'render_worthinessRating', 10, 3 );

function update_worthinessRating( $post_id ) {
    if ( isset( $_POST['worthiness_rating'] ) ) {
        update_post_meta( $post_id, 'review_worthiness', $_POST['worthiness_rating'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_worthinessRating' );
add_action( 'wpuf_edit_post_after_update', 'update_worthinessRating' );
/*********************************** End ความคุ้มค่า *************************************************************/



/******************************************************** ราคาต่อคน *************************************************************/
function render_priceRate( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'bistro_price', true );
    }
    ?>
    <div class="wpuf-label">
        <label>ราคาต่อคนประมาณ</label>
    </div>
    <div class="wpuf-fields">
		<div class="priceRate">
			<div>
				<div>
					<div>
						<div>
							<input  type="radio" name="price_rate" value="rate1" <?php checked( $value, '1' ); ?>>
							<label for="rating1"><span>1</span></label>
						</div>
						<input type="radio" name="price_rate" value="rate2" <?php checked( $value, '2' ); ?>>
						<label for="rating2"><span>2</span></label>
					</div>
					<input type="radio" name="price_rate" value="rate3" <?php checked( $value, '3' ); ?>>
					<label for="rating3"><span>3</span></label>
				</div>
				<input type="radio" name="price_rate" value="rate4" <?php checked( $value, '4' ); ?>>
				<label for="rating4"><span>4</span></label>
			</div>
			<input type="radio" name="price_rate" value="rate5" <?php checked( $value, '5' ); ?>>
			<label for="rating5"><span>5</span></label>
		</div>
    </div>
    <?php
}
add_action( 'bistro_price', 'render_priceRate', 10, 3 );

function update_priceRate( $post_id ) {
    if ( isset( $_POST['price_rate'] ) ) {
        update_post_meta( $post_id, 'bistro_price', $_POST['price_rate'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_priceRate' );
add_action( 'wpuf_edit_post_after_update', 'update_priceRate' );

/************************************* End ราคาต่อคน *************************************************************/


/******************************************************** Credit card *******************************************************/
function render_credit( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'bistro_credit', true );
    }
    ?>
    <div class="wpuf-label">
        <label>บัตรเครดิต</label>
    </div>
    <div class="wpuf-fields">
		<input type="radio" name="bistro_credit" value="have_credit"/>
		<label >มี</label>
		<input type="radio" name="bistro_credit" value="haveno_credit"/>
		<label >ไม่มี</label>
    </div>
    <?php
}
add_action( 'bistro_credit', 'render_credit', 10, 3 );

function update_credit( $post_id ) {
    if ( isset( $_POST['bistro_credit'] ) ) {
        update_post_meta( $post_id, 'bistro_credit', $_POST['bistro_credit'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_credit' );
add_action( 'wpuf_edit_post_after_update', 'update_credit' );

/************************************* End Credit card *************************************************************/

/******************************************************** Parking *******************************************************/
function render_parking( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'bistro_parking', true );
    }
    ?>
    <div class="wpuf-label">
        <label>ที่จอดรถ</label>
    </div>
    <div class="wpuf-fields">
		<input type="radio" name="bistro_parking" value="have_parking"/>
		<label >มี</label>
		<input type="radio" name="bistro_parking" value="haveno_parking"/>
		<label >ไม่มี</label>
    </div>
    <?php
}
add_action( 'bistro_parking', 'render_parking', 10, 3 );

function update_parking( $post_id ) {
    if ( isset( $_POST['bistro_parking'] ) ) {
        update_post_meta( $post_id, 'bistro_parking', $_POST['bistro_parking'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_parking' );
add_action( 'wpuf_edit_post_after_update', 'update_parking' );

/************************************* End parking *************************************************************/

/******************************************************** Internet *******************************************************/
function render_internet( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'bistro_internet', true );
    }
    ?>
    <div class="wpuf-label">
        <label>อินเตอร์เนท</label>
    </div>
    <div class="wpuf-fields">
		<input type="radio" name="bistro_internet" value="have_internet"/>
		<label >มี</label>
		<input type="radio" name="bistro_internet" value="haveno_internet"/>
		<label >ไม่มี</label>
    </div>
    <?php
}
add_action( 'bistro_internet', 'render_internet', 10, 3 );

function update_internet( $post_id ) {
    if ( isset( $_POST['bistro_internet'] ) ) {
        update_post_meta( $post_id, 'bistro_internet', $_POST['bistro_internet'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_internet' );
add_action( 'wpuf_edit_post_after_update', 'update_internet' );

/************************************* End Internet *************************************************************/

/******************************************************** alcohol *******************************************************/
function render_alcohol( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'bistro_alcohol', true );
    }
    ?>
    <div class="wpuf-label">
        <label>เครื่องดื่มแอลกฮอลล์</label>
    </div>
    <div class="wpuf-fields">
		<input type="radio" name="bistro_alcohol" value="have_alcohol"/>
		<label >มี</label>
		<input type="radio" name="bistro_alcohol" value="haveno_alcohol"/>
		<label >ไม่มี</label>
    </div>
    <?php
}
add_action( 'bistro_alcohol', 'render_alcohol', 10, 3 );

function update_alcohol( $post_id ) {
    if ( isset( $_POST['bistro_alcohol'] ) ) {
        update_post_meta( $post_id, 'bistro_alcohol', $_POST['bistro_alcohol'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_alcohol' );
add_action( 'wpuf_edit_post_after_update', 'update_alcohol' );

/************************************* End alcohol *************************************************************/

/******************************************************** National *******************************************************/
function render_national( $form_id, $post_id, $form_settings ) {
    $value = '';
  
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'bistro_national', true );
    }
    ?>
    <div class="wpuf-label">
        <label>สัญชาติอาหาร</label>
    </div>
    <div class="wpuf-fields">
		<input type="checkbox" name="bistro_national[]" value="inter"/><label >นานาชาติ</label>
		<input type="checkbox" name="bistro_national[]" value="thai"/><label >ไทย</label>
		<input type="checkbox" name="bistro_national[]" value="china"/><label >จีน</label>
		<input type="checkbox" name="bistro_national[]" value="japan"/><label >ญี่ปุ่น</label>
		<input type="checkbox" name="bistro_national[]" value="korea"/><label >เกาหลี</label>
		<input type="checkbox" name="bistro_national[]" value="vietnam"/><label >เวียดนาม</label>
		<input type="checkbox" name="bistro_national[]" value="italy"/><label >อิตาเลียน</label>
		<input type="checkbox" name="bistro_national[]" value="france"/><label >ฝรั่งเศส</label>
		<input type="checkbox" name="bistro_national[]" value="america"/><label >อเมริกัน</label>
		<input type="checkbox" name="bistro_national[]" value="india"/><label >อินเดีย</label>
    </div>
    <?php
}
add_action( 'bistro_national', 'render_national', 10, 3 );

function update_national( $post_id ) {
    if ( isset( $_POST['bistro_national'] ) ) {
        update_post_meta( $post_id, 'bistro_national', $_POST['bistro_national'] );
    }
}
add_action( 'wpuf_add_post_after_insert', 'update_national' );
add_action( 'wpuf_edit_post_after_update', 'update_national' );

/************************************* End national *************************************************************/


/************************************* Direction recipe EaRNG *************************************/
 

add_action( 'button_recipe', 'create_button_recipe', 10, 3 ); 

 function create_button_recipe( $form_id, $post_id, $form_settings  ) {
    if ( $post_id ) {
        $value = get_post_meta( $post_id, 'create_button_recipe', true );
    }?>
	<button id="btn-show-drt">show directions</button>
	<script type="text/javascript">
            jQuery(function($) {
               $( "#btn-show-drt" ).click(function() {
					 $( ".direction3,.direction4,.img3,.img4,.wpuf_section_break_1297_258,.wpuf_section_break_1298_258,wpuf_section_break_1299_258" ).slideToggle( "slow",function(){
						if ($(this).is(':hidden')) {
							var state = "closed";
						} else if ($(this).is(':visible')) {
							var state = "open";
						}
					 });
				});
            });
    </script>	
	<?php
}
add_action( 'wpuf_add_post_after_insert', 'create_button_recipe' );
add_action( 'wpuf_edit_post_after_update', 'create_button_recipe' );

 /************************************* End Direction recipe EaRNG *************************************/


 /*---------------------Start Function substring Guide---------------------*/
function utf8_to_tis620($string) {
   $str = $string;
   $res = "";
   for ($i = 0; $i < strlen($str); $i++) {
     if (ord($str[$i]) == 224) {
       $unicode = ord($str[$i+2]) & 0x3F;
       $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
       $unicode |= (ord($str[$i]) & 0x0F) << 12;
       $res .= chr($unicode-0x0E00+0xA0);
       $i += 2;
     } else {
       $res .= $str[$i];
     }
   }
   return $res;
 }
 
 function substr_utf8( $str, $start_p , $len_p) {
 
  $str_post = "";
  if(strlen(utf8_to_tis620($str)) > $len_p)
  {
   $str_post = "...";
  }
  return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$start_p.'}'. 
   '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len_p.'}).*#s', 
   '$1' , $str ) . $str_post;
 };

 /*--------------------------End Function substring Guide---------------------------*/
 
 
/*-------------------------------Start Function comment_post_redirect Ann------------------------*/
add_filter('comment_post_redirect', 'redirect_after_comment');
function redirect_after_comment($location)
{
return $_SERVER["HTTP_REFERER"];
}
/*-------------------------------Start Function comment_post_redirect Ann------------------------*/

 /*--------------------------Start Function Logout redirect Guide---------------------------*/
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_login','auto_redirect_after_login');
function auto_redirect_after_login(){
  wp_redirect( home_url( '/wp-login-alert.php' ) );
  exit();
}
 /*--------------------------End Function Logout redirect Guide---------------------------*/
 
  
 /*--------------------------Start Style Login CSS Guide---------------------------*/
 function my_loginlogo() {
  echo '<style type="text/css">
    body{
		
		background: url(' . get_template_directory_uri() . '/_inc/images/bg-login.png)  repeat;
	}
	#login{
		width:615px;
		padding: 4% 0 0;
	}
    .login h1 a {
      background-image: url(' . get_template_directory_uri() . '/_inc/images/logo-new.png) !important;
	  -webkit-background-size: 180px;
	  background-size: 180px;
	  height: 90px;
	  width: 195px;
    }
	.login label{
	color: #59595c;
	font-size: 18px;
	font-family: supermarket;
	}
	.login form .input, .login input[type=text]{
	font-size: 15px;
	}
	.login form{
	 background-image: url(' . get_template_directory_uri() . '/_inc/images/bg-login1.png) !important;
	text-align: center;
	width:615px;
	height:215px;
	padding: 35px 0px 0px;
	background: none;
	box-shadow: none;
	margin-top: 0px;
	}
	.login form .forgetmenot {
	margin-left: 233px;
	}
	.login #login_error{
	 border-left: none;
	 background: none;
	-webkit-box-shadow:  none;
	box-shadow: none;
	text-align:center;
	margin-top: -15px;
	color: #ff0000;
	}
	input[type=checkbox]:checked:before{
	content: "\f147";
	margin: -3px 0 0 -4px;
	color: #f0a81d;
	font: 400 21px/1 Dashicons;
	}
  </style>';
}
add_action('login_head', 'my_loginlogo');

 
add_filter('login_errors','login_error_message');

function login_error_message($error){
    //check if that's the error you are looking for
    $pos = strpos($error, 'incorrect');
    if (is_int($pos)) {
        //its the right error so you can overwrite it
        $error = "รหัสผ่านไม่ถูกต้องกรุณาใส่รหัสผ่านอีกครั้งค่ะ";
    }
    return $error;
}

 /*--------------------------End Style Login CSS Guide---------------------------*/

  /*--------------------------Start Hide Menu Bar Admin Guide---------------------------*/
add_action('set_current_user', 'csstricks_hide_admin_bar');
function csstricks_hide_admin_bar() {
  if (!current_user_can('edit_posts')) {
    show_admin_bar(false);
  }
}
  /*--------------------------End Hide Menu Bar Admin Guide---------------------------*/

  /*--------------------------Start Hide Menu Admin Celeb Guide---------------------------*/
  function custom_menu_celeb() {
	global $user_level;
	if ($user_level != '10' ) {
	   echo '<style type="text/css">
		   #menu-posts, #menu-media, #menu-pages, #menu-dashboard, #menu-comments, #toplevel_page_adrotate, #menu-posts-tcp_product,
		   #toplevel_page_wpcf7, #toplevel_page_thecartpress-admin-ShortCodeGenerator, #toplevel_page_wpuf-admin-opt, #toplevel_page_bp-activity,
		   #menu-tools, #toplevel_page_edit-post_type-acf, #toplevel_page_myCRED, #menu-posts-recipes, #menu-posts-tip, #menu-posts-setmenu, 
		   #menu-posts-bistro, #menu-posts-article, #menu-posts-trend, #menu-posts-review, #menu-posts-special_review, #menu-posts-likesara,
		   #menu-settings, #toplevel_page_ajaxy-page, #toplevel_page_buddypress-component-stats, #toplevel_page_CF7DBPluginSubmissions, 
		   #toplevel_page_promotion, #toplevel_page_wp-ulike-inc-wp-options , #menu-posts-store{
		   display:none;
		   }
		 </style>';
   }
}

add_action('admin_head', 'custom_menu_celeb');

 /*--------------------------End Hide Menu Admin Celeb Guide---------------------------*/
 
 
 
 
 function imagesize($filename,$width,$height){ // $width,$height ขนาดที่ต้องการแสดง  
	$data = getimagesize($filename);
	$rwidth = $data[0]; //ความสูงจริงๆของรูป
	$rheight = $data[1]; //ความกว้างจรริงของรูป
		if($width>$height){
			if($rwidth<$rheight){
				$imgsrc =  "<img src='$filename' height='$height'/>"; //ฟิกความสูง
			}else{
				$imgsrc = "<img src='$filename' width='$width'/>"; //ฟิกความกว้าง
			}
		}else{
			if($rwidth<$rheight){
				$imgsrc =  "<img src='$filename' width='$width'/>";
			}else{
				$imgsrc = "<img src='$filename' height='$height'/>";
			}
		}
	return $imgsrc;
}



add_filter( 'comment_form_defaults', function( $fields ) {
    $fields['must_log_in'] = sprintf( 
      /* __( '<p class="must-log-in">
                <a class="fancybox-login" href="%s">กรุณาเข้าสู่ระบบก่อนแสดงความคิดเห็น</a></p>' */
		 __( '' 
        ),
        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )   
    );
    return $fields;
});


function lvMember($user_id){
	global $wpdb;
	$sqlReview = "SELECT * FROM wp_posts WHERE post_type='review' AND post_status='publish' AND post_author='".$user_id."'";
	$wpdb->get_results($sqlReview);
	$numReview = $wpdb->num_rows;
	$sqlRecipe = "SELECT * FROM wp_posts WHERE post_type='recipes' AND post_status='publish' AND post_author='".$user_id."'";
	$wpdb->get_results($sqlRecipe);
	$numRecipe = $wpdb->num_rows;
	$allReview = $numReview+$numRecipe;
	if($allReview<5){
		$ranking = "Newbie";
		$rankImg = get_template_directory_uri()."/_inc/images/icons/icon-newbie.png";
	}else if($allReview>=5 && $allReview<20){
		$ranking = "Regular";
		$rankImg = get_template_directory_uri()."/_inc/images/icons/icon-regular.png";
	}else if($allReview>=20 && $allReview<30){
		$ranking = "Superb";
		$rankImg = get_template_directory_uri()."/_inc/images/icons/icon-superb.png";
	}else if($allReview>=30 && $allReview<60){
		$ranking = "Popular";
		$rankImg = get_template_directory_uri()."/_inc/images/icons/icon-popular.png";
	}else{
		$ranking = "Superchef";
		$rankImg = get_template_directory_uri()."/_inc/images/icons/icon-superchef.png";
	}
	return array($ranking,$rankImg);
	
}

