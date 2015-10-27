<?php /*Template Name: Tips Page */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/specialReview.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>


<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>


<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal" style="margin-bottom: 5px;">
          
                     
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
					 
					 
      
        	</div><!-- End content-by-meal -->

            <div class="content-tips">
				<div class="content-box">
                	
                    <div class="box-left">
                   	<ul class="grid effect-3" id="grid">
                    <?php
						if ( have_posts() ) :
							query_posts(array( 
								'post_type' => 'kitchen-tips'
							) );  
							$count = 0;
							while ( have_posts() ) : the_post();
							$count++;
						?>
                        <li>
                            <a href="#">
								<?php
									$ran = array("#ee4036","#8bc53f","#00adee");
											if($count %9==1){ $randomColor = $ran[0]; }
											else if($count%9==2){$randomColor = $ran[1];}
											else if($count%9==3){$randomColor = $ran[2];}
											else if($count%9==4){$randomColor = $ran[2];}
											else if($count%9==5){$randomColor = $ran[0];}
											else if($count%9==6){$randomColor = $ran[1];}
											else if($count%9==7){$randomColor = $ran[1];}
											else if($count%9==8){$randomColor = $ran[2];}
											else if($count%9==0){$randomColor = $ran[0];}
											
									//$randomColor = $ran[array_rand($ran, 1)];
									?>
                                 <div class="box-image" style="border:1px solid <?php echo $randomColor;?>">
									<div class="specialTitle"  style="background-color:<?php echo $randomColor;?>;" ><?php echo substr_utf8(get_the_title(),0,50);?></div>
									<?php $post_id = get_the_id();?>
									<?php if (has_post_thumbnail( $post_id) ): ?>
									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
									 <a href="<?php the_permalink();?>"><img src="<?php echo $image[0]; ?>" width="368"/></a>
									<?php endif; ?>
									<div class="specialExcerp"><a href="<?php the_permalink();?>"><?php echo the_excerpt();?></a></div>
									<div class="readmore"><a href="<?php the_permalink();?>">อ่านต่อ </a></div>
                                </div>
                            </a>
                          
                        </li>
					<?php
							endwhile;
						else :
							echo wpautop( 'Sorry, no posts were found' );
						endif;
                    ?>   

					</ul>
                  </div>
				<div class="cleaner_h30"></div>
                
                </div>    
            </div><!-- End content-tips-->  
		<?php do_action( 'bp_after_blog_home' ); ?>
		
</main>
	<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/masonry.pkgd.min.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/imagesloaded.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/classie.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/AnimOnScroll.js"></script>
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );
		</script>

<?php get_footer(); ?>