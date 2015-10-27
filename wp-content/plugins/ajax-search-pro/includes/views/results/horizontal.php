<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

/**
 * This is the default template for one horizontal result
 *
 * You should rather make a copy of this in this folder and use that,
 * instead of modifying this one.
 * It's also a good idea to use the actions to insert content instead of modifications.
 *
 * You can use any WordPress function here.
 * Variables to mention:
 *      Object() $r - holding the result details
 *      Array[]  $s_options - holding the search options
 *
 * DO NOT OUTPUT ANYTHING BEFORE OR AFTER THE <div class='item'>..</div> element
 *
 * You can leave empty lines for better visibility, they are cleared before output.
 *
 * MORE INFO: https://wp-dreams.com/knowledge-base/result-templating/
 *
 * @since: 4.0
 */
?>
<div class='item'>






           
            <figure>
				  <?php $user_info = get_userdata($r->id); ?>
                  <a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $r->id ); ?>" title="<?php echo xprofile_get_field_data( 1, $r->id);?>"><?php echo get_avatar( $r->id, 40 ); ?></a> 
            </figure>
            <h2><?php $disname = xprofile_get_field_data( 1, $r->id); echo substr_utf8($disname,0,15); ?></h2>
			<a href="#" class="following-btn">Following</a>
					
              
                 
          


</div>