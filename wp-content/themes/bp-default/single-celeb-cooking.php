<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/top-page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/celeb.css" />
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
  
  <section class="top-recipe" > 
    <!-- start loop here to get author name and link-->
    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="singlenavigation-darkbg"> <a href=" <?php echo site_url(); ?> ">หน้าหลัก</a> > <a href="<?php echo home_url(); ?>/recipes/">อร่อยในบ้าน</a> > <a href="<?php echo home_url(); ?>/celebcook/">เข้าครัวกับคนดัง</a> > <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?></a> > <a href="<?php the_permalink(); ?>"><b>
      <?php the_title(); ?>
      </b></a> </div>
    <h2 class="title"><i class="celeb-icon5"></i>เข้าครัวกับคนดัง</h2>
    <figure class="author-img align-left"> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?>">
      <?php bp_activity_avatar(array('user_id' => get_the_author_meta('ID'), type => 'full', width => '280')); ?>
      </a>
      <?php endwhile; else: ?>
      <p>
        <?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?>
      </p>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
    </figure>
    <!-- End author-img -->
    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php  
								$url = get_field('clip');
								parse_str( parse_url( $url, PHP_URL_QUERY ), $get_args);
							?>
    <iframe class="align-left celeb-clip" width="645" height="390" src="https://www.youtube.com/embed/<?php echo $get_args['v']; ?>" frameborder="0" allowfullscreen></iframe>
    <?php endwhile; else: ?>
    <p>
      <?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?>
    </p>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
  </section>
  <div class="content-recipe">
    <div class="col-left">
      <section class="author-detail">
        <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <h3> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?>"> <?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?> </a> </h3>
        <div class="author-bio"> <?php echo get_the_author_meta('description');?> </div>
        <?php endwhile; else: ?>
        <p>
          <?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?>
        </p>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </section>
      <!-- End author-detail -->
      <section class="social-box"> <span style="  margin-top: 110px;float: left; margin-left: 40px;">
        <?php if(function_exists('wp_ulike')) wp_ulike('get'); ?>
        </span> </section>
      <!-- End social-box -->
      <section class="celeb-recipe">
        <h2>เข้าครัวกับ<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?></h2>
        <ul class="related-recipes">
          <?php 
									$single_recipe = get_the_ID(); 
									$author_recipe = get_post_field( 'post_author' ,$single_recipe );
	
									$related_posts = new WP_Query( array( 'post__not_in' => array($single_recipe) , 'post_type' => 'celeb-cooking', 'author__in' => $author_recipe, 'posts_per_page' => 3, 'post_status' => 'publish' ) );
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
            <span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span> <br class="clear"/>
            </article>
          </li>
          <?php endwhile; else: ?>
          <p>
            <?php _e( 'ไม่มีเมนูอาหาร', 'buddypress' ); ?>
          </p>
          <?php endif; ?>
          <?php wp_reset_query(); ?>
        </ul>
        <br class="clear"/>
      </section>
      <!-- End celeb-recipe -->
      
      <?php 
				global $wpdb;
				$users = $wpdb->get_results("SELECT * FROM wp_cimy_uef_data WHERE USER_ID='".get_the_author_ID()."' AND FIELD_ID='1'");
				foreach($users as $user) {
					echo "<img src='".$user->VALUE."' width='310'/>";
				}
				?>
      <?php wp_reset_query(); ?>
    </div>
    <!-- End col-left -->
    
    <div class="col-right">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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
							$types = array('alacarte','snacks','noodle','vegetarian','dishes','seafood','dessert','babyfood','shabu/suki','grill/barbecue','drinking');
							$typesTH = array('จานเดียว','อาหารว่าง','ประเภทเส้น','มังสวิรัติ/เจ','กับข้าว','ซีฟู้ด','ขนม/ของหวาน','สำหรับเด็ก','ชาบู/สุกี้','ปิ้งย่าง/บาร์บีคิว','เครื่องดื่ม');												
								if($values){
									$c = 0;
									foreach($types as $type){ 
										if (in_array($type, $values)) { echo $typesTH[$c].' ';}
										$c++;
									} 
								}
							?>
            </span></li>
        </ul>
        <ul class="recipe-info">
          <li style="height: 10px;">
            <label for="level" class="recipe-level">ระดับความง่าย</label>
            <?php 	$recipe_rating = get_post_meta( get_the_ID(), 'recipe_rating', true );
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
									if (in_array($t, $v)) { echo $tsTH[$x].' '; }
											$x++;
									} 
								} ?>
            </span></li>
        </ul>
        <br class="clear"/>
        <?php $images = get_field('celeb_img');
			if( $images ){ ?>
        <ul class="recipe-img">
          <?php foreach( $images as $image ){ 
                      $url = $image['url'];
                      ?>
          <li> <a href="<?php echo $image['url']; ?>"><?php echo imagesize( $url, 370, 300 );?></a></li>
          <?php } ?>
          <br class="clear"/>
        </ul>
        <?php } ?>
        <p>
          <?php the_content(); ?>
        </p>
      </div>
      <!-- End entry --> 
      
    </div>
    <!-- End col-right -->
    
    <div class="right-in">
      <section class="more-recipes">
        <h2> กระทะร้อนกับเซเลบ</h2>
        <div class="wr-recipe-4">
          <div class="wr-recipe-5">
            <div class="wr-recipe-6">
              <ul class="recipes-by-keyword">
                <?php 
										$posts = $wpdb->get_results('SELECT ID FROM '.$wpdb->posts.' WHERE post_status="publish" AND post_type="celeb-cooking" GROUP BY post_author');
										
											foreach ($posts as $post) {
												$post_id[] = $post->ID;
											}	
										
										$celebpost1 = new WP_Query( array( 'post_type' => 'celeb-cooking', 'posts_per_page' => 5, 'post__in' => $post_id, 'orderby' => 'date', 'order' => 'DESC') ); ?>
                <?php if ( $celebpost1->have_posts() ) :
												while ( $celebpost1->have_posts() ) : $celebpost1->the_post(); ?>
                <li>
                  <article>
                  <figure> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?>"> <?php echo get_avatar(  get_the_author_meta('ID'),70); ?> </a> </figure>
                  <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                     <?php echo substr_utf8(get_the_title( $celebpost1->ID ),0,20);?>
                    </a></h3>
                  <div class="recipe-author">
                      <span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.get_the_ID().']' ) ?></span> 
                      <span class="recipe-view">
                      <?php the_time(); ?>
                      </span> 
                      <span class="recipe-view">โดย <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>" title="<?php echo xprofile_get_field_data( 1, get_the_author_meta('ID')); ?>"> <?php $subname = xprofile_get_field_data( 1, get_the_author_meta('ID'));
					  echo substr_utf8( $subname, 0, 12 );?> </a>
                      </span> <br class="clear"/>
                  </div>
                  </article>
                </li>
                <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
                <br class="clear"/>
              </ul>
              <!-- End recipes-by-keyword --> 
            </div>
          </div>
        </div>
        <!-- End wr-recipe--> 
      </section>
      <!-- End other-recipes -->
      <section class="other-recipes">
        <h2>เมนูน่าอร่อย</h2>
        <div class="wr-recipe-1">
          <div class="wr-recipe-2">
            <div class="wr-recipe-3">
              <ul class="related-recipes">
                <?php  $meta_types = get_post_meta( get_the_ID(), 'recipe_type', true );
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
									$celebposts = $wpdb->get_results("SELECT * FROM wp_posts INNER JOIN wp_postmeta ON ID = post_id WHERE post_status = 'publish' AND post_type = 'celeb-cooking' AND meta_key = 'recipe_type' ".$key." ORDER BY post_date DESC LIMIT 5"); ?>
                <?php if ( $celebposts ) {
						foreach ( $celebposts as $celebpost ){ ?>
                <li>
                  <article>
                  <figure> <a href="<?php echo get_permalink( $celebpost->ID ); ?>" title="<?php echo $celebpost->post_title; ?>"><?php echo get_avatar( $celebpost->post_author,70); ?></a> </figure>
                  <h3><a href="<?php echo get_permalink( $celebpost->ID ); ?>" title="<?php echo $celebpost->post_title; ?>">
				  <?php echo substr_utf8($celebpost->post_title,0,20);?></a></h3>
                  <div class="recipe-author">
                      <span class="recipe-view"><?php echo do_shortcode( '[hit_count post='.$celebpost->ID.']' ) ?></span> 
                      <span class="recipe-view">
                      <?php the_time(); ?>
                      </span> 
                      <span class="recipe-view">โดย <a href="<?php echo get_author_posts_url($celebpost->post_author);?>" title="<?php echo xprofile_get_field_data( 1, $celebpost->post_author); ?>"> 
					  <?php $strname = xprofile_get_field_data( 1, $celebpost->post_author);
					  echo substr_utf8( $strname, 0, 12 );?></a>
                      </span> <br class="clear"/>
                  </div>
                  </article>
                </li>
                <?php }//endwhile celebposts ?>
                <?php }//endif celebposts ?>
                <?php wp_reset_query(); ?>
                <br class="clear"/>
              </ul>
            </div>
          </div>
        </div>
        <!-- End wr-recipe--> 
      </section>
      <!-- End other-recipes --> 
      <br class="clear"/>
    </div>
    <!--END content-create-bistro--> 
  </div>
  <div class="left-in">
    <section class="half-section align-left">
      <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-2.png">
        <h2>วัตถุดิบ</h2>
      </header>
      <?php	if( have_rows('ingredients') ){
											echo '<ol class="celeb-lst">';
											while ( have_rows('ingredients') ) : the_row();
												echo '<li><span class="ingre1">'.get_sub_field('name').'</span><span class="ingre2">'.get_sub_field('number').'</span><span class="ingre3">'.get_sub_field('unit').'</span></li>'; 
											endwhile;
											
											echo '</ol>';
										} ?>
    </section>
    <section class="half-section align-right">
      <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-3.png">
        <h2>เครื่องปรุง</h2>
      </header>
      <?php	if( have_rows('seasoning') ){
											echo '<ol class="celeb-lst">';
											while ( have_rows('seasoning') ) : the_row();
												echo '<li><span class="ingre1">'.get_sub_field('name').'</span><span class="ingre2">'.get_sub_field('number').'</span><span class="ingre3">'.get_sub_field('unit').'</span></li>'; 
											endwhile;
											
											echo '</ol>';
										} ?>
    </section>
    <br class="clear"/>
    <section>
      <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-4.png">
        <h2>เทคนิค</h2>
      </header>
      <?php $timages = get_field('technique_img');
			if( $timages ){ ?>
      <ul class="recipe-img">
        <?php foreach( $timages as $timage ){ 
                      $turl = $timage['url'];
                      ?>
        <li> <a href="<?php echo $timage['url']; ?>"><?php echo imagesize( $turl, 245, 200 );?></a></li>
        <?php } ?>
        <br class="clear"/>
      </ul>
      <br class="clear"/>
      <?php } ?>
      <p> <?php echo get_post_meta( $post->ID, 'technique', true ); ?> </p>
    </section>
  </div>
  <!--in-left-->
  
  <section class="recipe-direction">
    <header class="topic-2"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/recipes/topic-recipe-5.png">
      <h2>ขั้นตอนการทำ</h2>
    </header>
    <?php	if( have_rows('direction') ){
                                                echo '<ul>';
                                                while ( have_rows('direction') ) : the_row();
                                                    echo '<li>'; 
														$img = get_sub_field('direction-img');
														echo '<div class="direction">';    
															the_sub_field('direction-detail');
														echo '</div>';
														echo '<figure style="float:right;">';
															echo imagesize($img,470,300);
														echo '</figure>';   
														echo '<br class="clear"/>';    
                                                    echo '</li>';
                                                endwhile;
                                                echo '</ul>';
                                            } ?>
  </section>
  
  <!--in-right--> 
  <br class="clear"/>
  <?php endwhile; else: ?>
  <p>
    <?php _e( 'ยังไม่มีเนื้อหา', 'buddypress' ); ?>
  </p>
  <?php endif; ?>
  <?php wp_reset_query(); ?>
  <i class="comment-icon"></i>
  <section class="comment-box">
    <?php comments_template(); ?>
  </section>
  <?php do_action( 'bp_after_blog_single_post' ); ?>
</main>
<?php get_footer(); ?>
