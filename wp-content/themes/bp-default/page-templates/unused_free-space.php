
<?php
/**
 * Template Name: free space
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 ?>
<?php

echo "test";

?>

<?php 
	
	$pid = 368;
	echo $pid."<br/>";
?> 



<?php
// VIDEO PLAYER

// ppk : get meta_value 
global $wpdb;
$pid = get_the_ID(); 

$results_vup = $wpdb->get_results ( "
    SELECT *
    FROM  $wpdb->postmeta
        WHERE post_id = ".$pid."
		AND meta_key LIKE 'celebcook_upload_video'
" );

foreach ( $results_vup as $res_vup)
{
		// get video id
		$vup = $res->meta_value;
   echo "Upload video ID : ".$res_vup->meta_value."<br/>";
}



$results_vurl = $wpdb->get_results ( "
    SELECT *
    FROM  $wpdb->postmeta
        WHERE post_id = ".$pid."
		AND meta_key LIKE 'celebcook_video_url'
" );

foreach ( $results_vurl as $res_vurl)
{
		// get video id
		$vurl = $res_vurl->meta_value;
   echo "URL video ID : ".$res_vurl->meta_value."<br/>";
}
 
 ?>


<!-- video player -->
	<div>
		<?php
		
		if($vurl == '' or $vurl == null){
			echo do_shortcode('[videojs mp4="'.wp_get_attachment_url($vup).'" autoplay="false"]');
		}else{
			echo do_shortcode('[youtube_sc url='.$vurl.']');
		}
		?>
	</div>

	
	
	<?php echo do_shortcode( '[searchandfilter taxonomies="category,post_tag"]' ); ?>
	
	
	
	<hr/>
	
	
	<form method="get" id="searchform1" action="<?php bloginfo('url'); ?>/free-space-ppk/">
  <div>
    <input type="text" value="<?php the_search_query(); ?>" name="s1" id="s1" />
    <input type="submit" id="searchsubmit" value="Search" />
  </div>
</form>



<?php

 $querystr = "
    SELECT $wpdb->posts.* 
    FROM $wpdb->posts, $wpdb->postmeta
    WHERE $wpdb->posts.post_title LIKE '%".$_GET['s1']."%'
    AND $wpdb->posts.post_status = 'publish'
	AND $wpdb->posts.post_status NOT LIKE ''
    ORDER BY $wpdb->posts.post_date DESC
 ";

 $pageposts = $wpdb->get_results($querystr, OBJECT);

?>


<?php global $post; ?>
  <?php foreach ($pageposts as $post): ?>
    <?php setup_postdata($post); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
      <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
      <?php the_title(); ?></a></h2>
      
  
      
    </div>
  <?php endforeach; ?>
	
