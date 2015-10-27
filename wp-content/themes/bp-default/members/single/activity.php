<?php

/**
 * BuddyPress - Users Activity
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

<?php do_action( 'bp_before_member_activity_content' ); ?>
<?php
if ( bp_is_current_action( 'review' ) ) :
	 locate_template( array( 'members/single/activity/review.php' ), true );

elseif ( bp_is_current_action( 'picture' ) ) :
	 locate_template( array( 'members/single/activity/picture.php' ), true );

elseif ( bp_is_current_action( 'clip' ) ) :
	 locate_template( array( 'members/single/activity/clip.php' ), true );

elseif ( bp_is_current_action( 'recipe' ) ) :
	 locate_template( array( 'members/single/activity/recipe.php' ), true );
 
 elseif ( bp_is_current_action( 'bookmark' ) ) :
	 locate_template( array( 'members/single/activity/bookmark.php' ), true );
	 
else :
	locate_template( array( 'members/single/activity/all.php' ), true );

endif;
?>
<?php do_action( 'bp_after_member_activity_content' ); ?>