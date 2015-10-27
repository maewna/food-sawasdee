<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/top-page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/recipe.css" />
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
<script type="text/javascript">
			$(document).ready(function(){
			 $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});                                   
			});    
		  </script>
<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>
<script type="text/javascript" charset="utf-8">
		$(function() {
				var url = window.location.href;
				$("#menu-main_nav_sub a").each(function() {
					if (url == (this.href)) {
						$(this).closest("li").addClass("active");
					}
				});
			});   
		</script>

<main id="content">
  <div class="social">
    <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
    <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
    <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
    <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
  </div>
  <?php do_action( 'bp_before_blog_single_post' ); ?>
  <?php do_action( 'template_notices' ); ?>
  <div class="content-by-meal-page">
    
    <?php include_once('wp-content/themes/bp-default/bg-time.php');?>
  </div>
  <!--END content-by-meal-page--> 
  
  <!-- 08/07/2015 pichchapa Facebook desctiption for sharing -->
  <meta name="description" content="test description" />
  <!--formatted-->
  
  <div class="content-recipe">
    <div class="singlenavigation" style="margin-top: -40px;margin-bottom: 20px;margin-left: -40px;">
      <?php while (have_posts()) : the_post(); ?>
      <a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> > <a href="<?php echo home_url(); ?>/recipes/">อร่อยในบ้าน</a> > <a href="<?php echo home_url(); ?>/all-recipes/">เมนูทั้งหมด</a> > <a href="<?php the_permalink(); ?>"><b>
      <?php the_title(); ?>
      </b></a>
      <?php endwhile;?>
    </div>
    <section class="top-recipe" >
      <?php 	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
								$user_info = get_userdata(get_the_author_meta('ID')); 
								$user_level =  implode(', ', $user_info->roles);
								if($user_level != 'administrator'){
					?>
      <figure class="author-img"> <a href="<?php echo bp_core_get_user_domain( get_the_author_meta('ID') ) ?>" title="<?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?>">
        <?php bp_activity_avatar(array('user_id' => get_the_author_meta('ID'), type => 'full', width => '127', height => '127')); ?>
        </a> </figure>
      <!-- End author-img -->
      <?php
					$num_recipe = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author='".$current_user->ID."' AND post_type='cooking' AND post_status='publish'");
					$sql = "SELECT * FROM wp_posts WHERE post_type='review' AND post_status='publish' AND post_author='".$current_user->ID."'";
					$query = mysql_query($sql);
					$num_review = mysql_num_rows($query);
					?>
      <ul class="author-info">
        <li>
          <?php list($rank,$rankImg) = lvMember(get_the_author_meta('ID'));?>
          <img src="<?php echo $rankImg;?>" width="35" alt="<?php echo $rank;?>" /> </li>
        <li><a href="<?php echo bp_core_get_user_domain( get_the_author_meta('ID') ) ?>" title="<?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?>"><?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?></a></li>
        <li>
          <label for="review" class="num-review">รีวิว</label>
          <span><?php echo $num_review;?></span> </li>
        <li>
          <label for="recipe" class="num-recipe">สูตร</label>
          <span><?php echo $num_recipe;?></span> </li>
      </ul>
      <?php 	}else{ ?>
      <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/logo-new.png" alt="Foodsawasdee"/>
      <?php 	}
						endwhile; else: ?>
      <p>
        <?php _e( ' ', 'buddypress' ); ?>
      </p>
      <?php  endif; ?>
      <?php wp_reset_query(); ?>
    </section>
    <div class="col-left">
     <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article class="detail-recipe">
        <header class="topic"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-1.jpg">
          <?php the_title( '<h2>', '</h2>' ); ?>
          <small>เขียนเมื่อ  :
          <?php the_time(); ?>
          </small><br/>
        </header>
        <div class="entry">
          <ul class="recipe-info">
            <li style="height: 10px;">
              <label for="national" class="recipe-national">สัญชาติอาหาร</label>
              <span>
              <?php $national = get_post_meta( get_the_ID(), 'recipe_national', true ); 
									if( $national == 'inter'){ echo 'นานาชาติ';
									}else if($national == 'thai'){ echo 'ไทย';
									}else if($national == 'china'){ echo 'จีน';
									}else if($national == 'japan'){ echo 'ญี่ปุ่น';
									}else if($national == 'korea'){ echo 'เกาหลี';
									}else if($national == 'vietnam'){ echo 'เวียดนาม';
									}else if($national == 'italy'){ echo 'อิตาเลียน';
									}else if($national == 'france'){ echo 'ฝรั่งเศส';
									}else if($national == 'america'){ echo 'อเมริกัน';
									}else if($national == 'india'){ echo 'อินเดีย';
									}  ?>
              </span> </li>
            <li style="height: 10px;">
              <label for="time" class="recipe-time">เวลาในการทำ</label>
              <span>
              <?php $time = get_post_meta( get_the_ID(), 'timetocook', true ); 
									if( $time == '61'){ 
										echo 'มากกว่า 1 ชั่วโมง';
									}else if( $time == '60'){ 
										echo '1 ชั่วโมง';
									}else{
										echo $time." นาที";
									} ?>
              </span> </li>
            <li>
              <label for="type" class="recipe-type">ประเภท</label>
              <span>
              <?php
                   $values = get_post_meta( get_the_ID(), 'recipe_type', true );
                  if($values!=""){
                       echo convertFoodType($values);
                   }
               ?>
              </span></li>
            <br class="clear"/>
          </ul>
          <ul class="recipe-info">
            <li style="height: 10px;">
              <label for="level" class="recipe-level">ระดับความง่าย</label>
              <?php	
																				$recipe_rating = get_post_meta( $post->ID, 'recipe_rating', true );
																				if($recipe_rating!=0){$smileRating = $recipe_rating*(100/5);}
																				else{$smileRating = 0;}
																			?>
              <div class="smile">
                <div class="smileRating" style="width:<?php echo $smileRating;?>%"></div>
                <input type="radio" name="smileRating" id="smile5" value="5">
                <label for="smile5"></label>
                <input type="radio" name="smileRating" id="smile4" value="4">
                <label for="smile4"></label>
                <input type="radio" name="smileRating" id="smile3" value="3">
                <label for="smile3"></label>
                <input type="radio" name="smileRating" id="smile2" value="2">
                <label for="smile2"></label>
                <input type="radio" name="smileRating" id="smile1" value="1">
                <label for="smile1"></label>
              </div>
            </li>
            <li style="height: 10px;">
              <label for="ingredient" class="recipe-ingredient">วัตถุดิบหลัก</label>
              <span><?php echo get_post_meta( get_the_ID(), 'main-ingredient', true ); ?></span></li>
            <li>
              <label for="meal" class="recipe-meal">มื้อ</label>
              <span>
              <?php	$v = get_post_meta( get_the_ID(), 'check_meal', true ); 
										$ts = array('breakfast','lunch','dinner','supper');
										$tsTH = array('เช้า','กลางวัน','เย็น','ดึก');											
											if($v){
												$x = 0;
												foreach($ts as $t){ 
													if (in_array($t, $v)) { echo $tsTH[$x].' ';}
												$x++;
												} 
											} ?>
              </span></li>
            <br class="clear"/>
          </ul>
          <br class="clear"/>
          <?php the_excerpt(); ?>
          <section class="recipe-clip">
            <?php $ch_clips = get_post_meta( $post->ID, 'choose-clip' );
						 	  if( $ch_clips ){
								  foreach($ch_clips as $ch_clip){ 
										if( $ch_clip == 'url' ){ 
											$urls = get_post_meta( $post->ID, 'url-clip' );
											if( $urls ){
												foreach($urls as $url){ 
													parse_str( parse_url( $url, PHP_URL_QUERY ), $get_args);
													?>
            <iframe class="align-left" width="640" height="390" src="https://www.youtube.com/embed/<?php echo $get_args['v']; ?>" frameborder="0" allowfullscreen></iframe>
            <?php 
													}
											}
										}else if( $ch_clip == 'upload' ){
											$uploads = get_post_meta( $post->ID, 'upload-clip' );
											if( $uploads ){
												foreach($uploads as $upload){ 
        										$path = wp_get_attachment_url($upload);
													echo do_shortcode( '[video mp4="'.$path.'"]' );
												}
											}
										}
									}//End clip foreach
							  } ?>
            <br class="clear"/>
          </section>
          <section class="recipe-imgs">
            <?php 	$imgs = get_post_meta( $post->ID, 'recipe-img' );
                                if( $imgs ){
                                    $c = count( $imgs );
									$x = 0;
                                    foreach($imgs as $i){ 
										$x++;
                                        if( $c == 1 || $c == 3 ){ 
											if( $x == 1 ){ $w = 640; $h = 390; } else { $w = 370; $h = 300; }
										}else{ $w = 370; $h = 300; }
                                        $imgid = wp_get_attachment_url( $i );
                                        echo '<a href="'.$imgid.'">';
                                        echo imagesize( $imgid, $w, $h );
                                        echo '</a>';
                                    }
                                }
                            ?>
          </section>
          <section class="half-section align-left">
            <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-2.png">
              <h2>วัตถุดิบ</h2>
            </header>
            <?php $repeat_field = get_post_meta( $post->ID, 'ingredients' );
								if ( $repeat_field ) {
									echo '<ol class="recipe-lst">';
									$cing = 0;
									foreach ($repeat_field as $field) {
										
										$values = explode( '| ', $field );
										if( $values[0] != '' || $values[1] != '' || $values[2] != ''){
											echo '<li><span class="ingre1">'.$values[0].'</span><span class="ingre2">'.$values[1].'</span><span class="ingre3">'.$values[2].'</span></li>';
										}
									}
									echo '</ol>';
								}?>
          </section>
          <section class="half-section align-right">
            <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-3.png">
              <h2>เครื่องปรุง</h2>
            </header>
            <?php $repeat_field = get_post_meta( $post->ID, 'seasoning' );
								if ( $repeat_field ) {
									echo '<ol class="recipe-lst">';
									foreach ($repeat_field as $field) {
											$values = explode( '| ', $field );
											if( $values[0] != '' || $values[1] != '' || $values[2] != ''){
												echo '<li><span class="ingre1">'.$values[0].'</span><span class="ingre2">'.$values[1].'</span><span class="ingre3">'.$values[2].'</span></li>';
											}
									}
									echo '</ol>';
								}?>
          </section>
          <br class="clear"/>
          <section>
            <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-4.png">
              <h2>เทคนิค</h2>
            </header>
            <section class="tips-img">
              <?php $timgs = get_post_meta( $post->ID, 'tipstechniques-img' );
                                if( $timgs ){
                                    foreach($timgs as $timg){ 
                                        $tid = wp_get_attachment_url( $timg );
                                        echo '<a href="'.$tid.'">';
                                        echo imagesize( $tid, 245, 200 );
                                        echo '</a>';
                                    }
                                }
                            ?>
            </section>
            <p><?php echo get_post_meta( $post->ID, 'tipstechniques', true ); ?></p>
          </section>
          <section>
            <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-5.png">
              <h2>ขั้นตอนการทำ</h2>
            </header>
            <?php for($i = 1; $i <= 10; $i++){ 
								$detail = get_post_meta( $post->ID, 'dir'.$i, true );
								if( $detail ){ ?>
            <div class="direction">
              <?php $images = get_post_meta( $post->ID, 'dir'.$i.'-img' );
										if ( $images ) { 
												$width = '285px'; 
											} else { 
												$width = '100%'; 
											} ?>
              <p style="width: <?php echo $width;?>"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/no-<?php echo $i;?>.png" width="39" height="39"/><?php echo $detail; ?> </p>
              <?php foreach ( $images as $attachment_id ) { ?>
              <figure class="direction-img">
                <?php
                                        			$img = wp_get_attachment_url( $attachment_id );
													echo '<a href="'.$img.'">';
													echo imagesize($img,470,300);
													echo '</a>'; ?>
              </figure>
              <?php 	}//End foreach ?>
              <br class="clear"/>
            </div>
            <!--End direction-->
            <?php }//End if detail
							 }//End for direction ?>
          </section>
         
        </div>
        <!-- End entry --> 
      </article>
      <!-- End detail-recipe --> 
      <br class="clear"/>
      <div class="like-recipe">
        <?php if(function_exists('wp_ulike')) wp_ulike('get'); ?>
      </div>
      <!-- End like-recipe -->

      <div class="sponsor-recipe">ข้อมูลโดย <?php echo get_post_meta( get_the_ID(), 'recipe-sponsor', true ); ?>
     
            <?php $imggs = get_post_meta( get_the_ID(), 'sponsor-img');
                                if( $imggs ){
                                    foreach($imggs as $imgg){ 
                                        $imggid = wp_get_attachment_url( $imgg );
                                        echo '<a href="'.$imggid.'">';
                                        echo imagesize( $imggid, 50, 50 );
                                        echo '</a>';
                                    }
                                }
                            ?>
      </div>
       <?php endwhile; else: ?>
          <p>
            <?php _e( 'ยังไม่มีข้อมูล', 'buddypress' ); ?>
          </p>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
      <!-- End sponsor-recipe --> <br class="clear"/>
      <i class="comment-icon"></i>
      <section class="comment-box">
        <?php comments_template(); ?>
      </section>
    </div>
    <!-- End col-left -->
    
    <div class="col-right">
      <section class="other-recipes">
        <h2>เมนูที่เคยทำ</h2>
        <div class="wr-recipe-1">
          <div class="wr-recipe-2">
            <div class="wr-recipe-3">
              <ul class="related-recipes">
                <?php 
									$single_recipe = get_the_ID(); 
									$author_recipe = get_post_field( 'post_author', $single_recipe); 
									
									$related_posts = new WP_Query( array( 'post__not_in' => array($single_recipe) , 'post_type' => 'cooking', 'author__in' => $author_recipe, 'posts_per_page' => 3, 'post_status' => 'publish' ) );
											if ( $related_posts->have_posts() ) :
												while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                <li>
                  <article>
                  <figure> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                    <?php the_post_thumbnail('s-thumb'); ?>
                    </a> </figure>
                  <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                    <?php the_title(); ?>
                    </a></h3>
                  <div class="recipe-author">
                  <span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span> <span class="recipe-date">
                  <?php the_time(); ?>
                  </span> <span class="recipe-name">โดย <a href="<?php echo bp_core_get_user_domain( get_the_author_meta('ID') ) ?>" title="<?php echo bp_core_get_user_displayname( get_the_author_meta('ID') ) ?>"> <?php echo bp_core_get_userlink(get_the_author_meta('ID'));?></a> </span> <br class="clear"/>
                  </article>
                </li>
                <?php endwhile; else: ?>
                <p>
                  <?php _e( 'ยังไม่มีเมนูอาหาร', 'buddypress' ); ?>
                </p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
              </ul>
            </div>
          </div>
        </div>
        <!-- End wr-recipe--> 
      </section>
      <!-- End other-recipes -->
      
      <section class="more-recipes">
        <h2>เมนูใกล้เคียง</h2>
        <div class="wr-recipe-4">
          <div class="wr-recipe-5">
            <div class="wr-recipe-6">
              <ul class="recipes-by-keyword">
                <?php 
									$meta_types = get_post_meta( $single_recipe, 'recipe_type', true);
									if($meta_types){ 
										$key = 'AND (';
										$c = 0;
										foreach( $meta_types as $meta_type ){
											$key .=  "meta_value LIKE '%".$meta_type."%'";
											if( $c < count($meta_types)-1  ){ $key .= " OR " ; }
											$c++;
										}
										$key .= ')';
									}
									
									global $wpdb;
									$related_posts = $wpdb->get_results("SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID = post_id WHERE post_status = 'publish' AND post_type = 'recipes' AND meta_key = 'recipe_type' ".$key." ORDER BY post_date DESC LIMIT 5");
									
											if ( $related_posts) {
												foreach ( $related_posts as $related_post){ ?>
                <li>
                  <article>
                  <figure> <a href="<?php echo get_permalink( $related_post->ID ); ?>" title="<?php echo $related_post->post_title; ?>"><?php echo get_the_post_thumbnail( $related_post->ID, 's-thumb' ); ?> </a> </figure>
                  <h3><a href="<?php echo get_permalink( $related_post->ID ); ?>" title="<?php echo $related_post->post_title; ?>"><?php echo $related_post->post_title; ?></a></h3>
                  <div class="recipe-author">
                  <span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.$related_post->ID.']' ) ?></span> <span class="recipe-date">
                  <?php $related_post->post_date; ?>
                  </span> <span class="recipe-name">โดย <a href="<?php echo bp_core_get_user_domain( $related_post->post_author ) ?>" title="<?php echo bp_core_get_user_displayname( $related_post->post_author ) ?>"> <?php echo bp_core_get_userlink( $related_post->post_author );?></a> </span> <br class="clear"/>
                  </article>
                </li>
                <?php } // End foreach
												}else{ ?>
                <p>
                  <?php _e( 'ยังไม่มีเมนูอาหาร', 'buddypress' ); ?>
                </p>
                <?php } ?>
                <?php wp_reset_query(); ?>
              </ul>
              <!-- End recipes-by-keyword --> 
            </div>
          </div>
        </div>
        <!-- End wr-recipe--> 
      </section>
      <!-- End other-recipes -->
      
      <section class="recommend-members">
        <h2>เพื่อนสมาชิกฟู้ดสวัสดี</h2>
        <ul>
          <?php   $user_query = new WP_User_Query( array(  'orderby' => 'rand', 'role' => 'Subscriber', 'number' => 12 ) );
										if ( ! empty( $user_query->results ) ) {
										foreach ($user_query->results as $username) { ?>
          <li>
            <figure>
              <?php $user_info = get_userdata($username->ID); 
													  /*$user_level =  implode(', ', $user_info->roles);
													  if($user_level == 'celeb'){ ?>
														<a href="<?php echo get_author_posts_url($username->ID);?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 100 ); ?></a>
												<?php }else{*/?>
              <a href="<?php echo home_url(); ?>/members/<?php the_author_meta( 'user_nicename', $username->ID ); ?>" title="<?php echo xprofile_get_field_data( 1, $username->ID);?>"><?php echo get_avatar( $username->ID, 100 ); ?></a>
              <?php /*}*/?>
            </figure>
          </li>
          <?php }}	//end foreach ?>
          <br class="clear"/>
        </ul>
      </section>
      <!-- End recommend-members --> 
      
    </div>
    <!-- End col-right --> 
    <br class="clear"/>
    <?php do_action( 'bp_after_blog_single_post' ); ?>
    <?php //get_sidebar(); ?>
  </div>
  <!--END content-create-bistro--> 
  
</main>
<?php get_footer(); ?>