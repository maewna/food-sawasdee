<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");

/**
 * This is the default template for one isotopic result
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

<div class='item asp_isotopic_item'>
 
<?php  $sql = 'SELECT * FROM wp_posts WHERE ID =  "'.$r->id.'" ';
		  			$query = mysql_query($sql);
					while ($result = mysql_fetch_array($query) ){
						//echo $result['post_type'];
		if ($result['post_type'] == 'trend' ){
			echo '<img src="/wp-content/themes/bp-default/images/icon-search-sara.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'likesara' ){
			echo '<img src="/wp-content/themes/bp-default/images/icon-search-sara.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'tip' ){
			echo '<img src="/wp-content/themes/bp-default/images/icon-search-rp.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'review' ){
			echo '<img src="/wp-content/themes/bp-default/images/bistrosearch.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'recipes' ){
			echo '<img src="/wp-content/themes/bp-default/images/icon-search-rp.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'celebcook' ){
			echo '<img src="/wp-content/themes/bp-default/images/icon-search-rp.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'bistro' ){
			echo '<img src="/wp-content/themes/bp-default/images/bistrosearch.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'variety' ){
			echo '<img src="/wp-content/themes/bp-default/images/bistrosearch.png" style="z-index: 999; position: absolute;">';
		}elseif ($result['post_type'] == 'special_review' ){
			echo '<img src="/wp-content/themes/bp-default/images/bistrosearch.png" style="z-index: 999; position: absolute;">';
		}
		
}
					
					
	?>
    <?php do_action('asp_res_isotopic_begin_item'); ?>
    
    
    

    <?php if (!empty($r->image)): ?>
    <img class='asp_item_img' src='<?php echo $r->image; ?>'>
    <?php endif; ?>

    <?php do_action('asp_res_isotopic_after_image'); ?>


    <div class='content'>
    	

        <h3>



        <a href='<?php echo $r->link; ?>'<?php echo ($s_options['results_click_blank'])?" target='_blank'":""; ?>>
                <?php echo $r->title; ?>
                
                 
                <?php if ($s_options['resultareaclickable'] == 1): ?>
                    <span class='overlap'></span>
                <?php endif; ?>
            </a></h3>

        <div class='etc'>

            <?php if ($s_options['showauthor'] == 1): ?>
                <span class='author'><?php echo $r->author; ?></span>
            <?php endif; ?>

            <?php if ($s_options['showdate'] == 1): ?>
                <span class='date'><?php echo $r->date; ?></span>
            <?php endif; ?>

        </div>

        <?php if ($s_options['showdescription'] == 1): ?>
            <p class='desc'><?php echo $r->content; ?>
            
         
            </p>
        <?php endif; ?>

    </div>

    <?php do_action('asp_res_isotopic_after_content'); ?>

    <div class='clear'></div>

    <?php do_action('asp_res_isotopic_end_item'); ?>
    

</div>




   