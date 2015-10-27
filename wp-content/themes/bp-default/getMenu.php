<?php 
include_once("../../../wp-config.php");
$i = $_POST["pid"];
$t = $_POST["type"];
if ( $t == 'c1' ){ ?>
<?php $term = get_term_by('id', $i, 'setmenu-category'); 
			 	$imgurl = z_taxonomy_image_url($i); ?>

<header class="h-setmenu">
  <figure><?php echo imagesize( $imgurl,180,140 ); ?></figure>
  <h2><?php echo $term->name; ?></h2>
  <div class="description"> <?php echo $term->description; ?></div>
  <br class="clear"/>
</header>






<?php 			query_posts(array( 'post_type' => 'setmenu','parent'=> 0,'child_of'=> 0,'showposts' => -1,'tax_query' => array(
				array('include_children'=>false,
					'taxonomy' => 'setmenu-category',
					'terms' => $i,
					'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			if(have_posts()){
					while ( have_posts() ) : the_post(); ?>
<?php $pid = get_the_ID(); ?>
<a href="#" class="link-setmenu" onClick="getMenu1('p','<?php echo $pid;?>');return false;" >
<div class="box-setmenu">
  <div class="z-setmenu"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/zoom.png"></div>
  <div class="thumb-tagname"><span>
    <?php the_title(); ?>
    </span></div>
  <?php $p2s = get_field('idmaincourse'); $p2surl = wp_get_attachment_url( get_post_thumbnail_id( $p2s[0] ) ); ?>
  <figure class="thumb-setmenu"><?php echo imagesize($p2surl,120,120); ?></figure>
  <?php $p1s = get_field('iddessert'); $p1surl = wp_get_attachment_url( get_post_thumbnail_id( $p1s[0] ) ); ?>
  <figure class="thumb-setmenu"><?php echo imagesize($p1surl,120,120); ?></figure>
  <?php $p3s = get_field('iddrink'); $p3surl = wp_get_attachment_url( get_post_thumbnail_id( $p3s[0] ) ); ?>
  <figure class="thumb-setmenu"><?php echo imagesize($p3surl,120,120); ?></figure>
</div>
<!--End box-setmenu--> 
</a>
<?php endwhile;
			} ?>








<?php $gMsubargs = array('type'=> 'post_type','child_of'=> $i,'orderby'=> 'id','order'=> 'ASC','hide_empty'=> 0,'taxonomy'=> 'setmenu-category');
			$gMsubcategories = get_categories( $gMsubargs );
			if($gMsubcategories) {
					
					foreach ( $gMsubcategories as $gMsubcategory ) { ?>
<a class="link-setmenu" href="#" onClick="getMenu1('c2','<?php echo $gMsubcategory->term_id;?>');return false;">
<div class="box-setmenu">
  <div class="tagname"><span><?php echo $gMsubcategory->name; ?></span></div>
  <div class="z-setmenu"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/zoom.png"></div>
  <?php $imgseturl = z_taxonomy_image_url($gMsubcategory->term_id); ?>
  <?php echo imagesize($imgseturl,240,240); ?> </div>
</a>
<?php		}//End foreach
		}//End if
?>








<?php
					
					
	}else if( $t == 'c2'){  ?>
<?php $term = get_term_by('id', $i, 'setmenu-category'); 
	  $imgurl = z_taxonomy_image_url($i); ?>
<header class="h-setmenu">
  <figure><?php echo imagesize( $imgurl,180,140 ); ?></figure>
  <h2><?php echo $term->name?></h2>
  <div class="description"> <?php echo $term->description; ?></div>
  <br class="clear"/>
</header>
<?php query_posts(array( 'post_type' => 'setmenu','parent'=> 0,'child_of'=>0,'showposts' => -1,'tax_query' => array(
				array('include_children'=>false,
					'taxonomy' => 'setmenu-category',
					'terms' => $i,
					'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			if(have_posts()){
					while ( have_posts() ) : the_post(); ?>
<?php $pid = get_the_ID(); ?>
<a href="#" class="link-setmenu" onClick="getMenu1('p','<?php echo $pid;?>');return false;" >
<div class="box-setmenu">
  <div class="z-setmenu"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/zoom.png"></div>
  <div class="thumb-tagname"><span>
    <?php the_title(); ?>
    </span></div>
  <?php $p2s = get_field('idmaincourse'); $p2surl = wp_get_attachment_url( get_post_thumbnail_id( $p2s[0] ) ); ?>
  <figure class="thumb-setmenu"><?php echo imagesize($p2surl,120,120); ?></figure>
  <?php $p1s = get_field('iddessert'); $p1surl = wp_get_attachment_url( get_post_thumbnail_id( $p1s[0] ) ); ?>
  <figure class="thumb-setmenu"><?php echo imagesize($p1surl,120,120); ?></figure>
  <?php $p3s = get_field('iddrink'); $p3surl = wp_get_attachment_url( get_post_thumbnail_id( $p3s[0] ) ); ?>
  <figure class="thumb-setmenu"><?php echo imagesize($p3surl,120,120); ?></figure>
</div>
<!--End box-setmenu--> 
</a>
<?php endwhile;
			}
			
	
	}else if( $t == 'p'){
						global $wpdb;
						$posts = $wpdb->get_results("SELECT * FROM wp_posts WHERE ID = '" . $i . "'"); ?>
<?php if ( $posts ) {
						foreach ( $posts as $post ){ ?>
                <header class="hsingle-setmenu">
                  <h2><?php echo $post->post_title; ?></h2>
                  <div class="description"> <?php echo get_post_field('post_content', $i); ?> </div>
                  <br class="clear"/>
                </header>

<section class="show-set">
  <div class="boxset-dessert">
    <div class="set-dessert">
      <?php $p2s = get_field('iddessert'); $p2surl = wp_get_attachment_url( get_post_thumbnail_id( $p2s[0] ) ); ?>
      <?php echo imagesize($p2surl,268,272); ?>
      <h3 class="txt-wthbg"><?php echo substr_utf8( get_the_title ( $p2s[0] ),0,50 );?></h3>
    </div>
    <!--End set-dessert-->
    <p class="h-dessert">อาหารหวาน</p>
    <h3 class="txt-dessert"><?php echo substr_utf8( get_the_title ( $p2s[0] ),0,50 );?></h3>
    <p class="ntxt-dessert">คุณค่าทางโภชนาการต่อหนึ่งหน่วยบริโภค<br>
      พลังงานทั้งหมด <?php echo get_field('calories_dessert');?> กิโลแคลอรี่</p>
  </div>
  <div class="boxset-maincourse">
    <div class="set-maincourse">
      <div class="icon-add-l"></div>
      <div class="icon-add-r"></div>
      <?php $p1s = get_field('idmaincourse'); $p1surl = wp_get_attachment_url( get_post_thumbnail_id( $p1s[0] ) ); ?>
      <?php echo imagesize($p1surl,328,328); ?>
      <h3 class="txt-wthbg"><?php echo substr_utf8( get_the_title ( $p1s[0] ),0,50 );?></h3>
    </div>
    <!--End set-main-course-->
    <p>อาหารคาว</p>
    <div style="border-left: 2px dotted #ababab; border-right: 1px dotted #ababab;">
      <h3 class="txt-maincourse"><?php echo substr_utf8( get_the_title ( $p1s[0] ),0,50 );?></h3>
      <p class="ntxt-maincourse">คุณค่าทางโภชนาการต่อหนึ่งหน่วยบริโภค<br>
        พลังงานทั้งหมด <?php echo get_field('calories_dessert');?> กิโลแคลอรี่</p>
    </div>
  </div>
  <div class="boxset-drink">
    <div class="set-drink">
      <?php $p3s = get_field('iddrink'); $p3surl = wp_get_attachment_url( get_post_thumbnail_id( $p3s[0] ) ); ?>
      <?php echo imagesize($p3surl,268,272); ?>
      <h3 class="txt-wthbg"><?php echo substr_utf8( get_the_title ( $p3s[0] ),0,50 );?></h3>
    </div>
    <!--End set-drink-->
    <p class="h-drink">เครื่องดื่ม</p>
    <h3 class="txt-drink"><?php echo substr_utf8( get_the_title ( $p3s[0] ),0,50 );?></h3>
    <p class="ntxt-drink">คุณค่าทางโภชนาการต่อหนึ่งหน่วยบริโภค<br>
      พลังงานทั้งหมด <?php echo get_field('calories_drink');?> กิโลแคลอรี่</p>
    </p>
  </div>
  <br class="clear"/>
  <div class="total-cal">
    <h4>ข้อมูลโภชนาการทั้งหมด</h4>
    <p>คุณค่าทางโภชนาการต่อหนึ่งหน่วยบริโภค<br>
      พลังงานทั้งหมด <?php echo get_field('total_calories');?> กิโลแคลอรี่</p>
  </div>
  <br class="clear"/>
</section>
<?php			}//End each
			}//End if  ?>
  <?php wp_reset_query(); ?>
<?php	
	}
	wp_reset_query();
 echo ' <br class="clear"/> ';
 ?>
