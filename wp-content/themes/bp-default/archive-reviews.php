<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/specialReview.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/_inc/css/specialDetail.css" />
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
			
            <div class="content-special">
				<!-- <div class="navig">หน้าหลัก > อร่อยนอกบ้าน > สเปเชียลรีวิว > <?php echo the_title(); ?></div> -->
				<div class="title-special" style="z-index:1;position:relative;padding-top:0px;"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconSpecial.png"  style='vertical-align:middle;padding-right:20px;'/>สเปเชียลรีวิว</div>
                	
				<?php
						query_posts(array( 	'post_type' => 'reviews',
											'showposts' => 1,
											'posts_per_page' => 1,
											'orderby'=>'rand',
											/*'post__in'  => get_option( 'sticky_posts' ),
											'ignore_sticky_posts' => 1*/
										) 
								);  
						while ( have_posts() ) : the_post();
							$imageBg = get_field('special_bheader');
							
					?>				
				<div class="header" style="margin-top:-20px">
					<div class="imageHolder">
						<?php if (has_post_thumbnail( $post_id) ): ?>
								<?php //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
								<div style="width:1200px;height:360px;overflow:hidden"><a href="<?php the_permalink();?>"><?php echo imagesize($imageBg,1200,360); ?></a></div>
						<?php endif; ?>
						<div class="title"><br><?php the_title(); ?></div> 
						<div class="logo" style="right:40px;">
						<?php 
							$image = get_field('special_blogo');
							
							if( !empty($image) ): 
						?>
							<img src="<?php echo $image; ?>" height="90" border="0"/>
							<?php endif; ?>
						</div>
						<?php
									$showFormat = get_field('special_bshow');
									//echo $showFormat;
									if($showFormat=='วีดีโอ'){
									?>
										<?php  
											$url = get_field('special_burl');
											parse_str( parse_url( $url, PHP_URL_QUERY ), $get_args);
										?>	
										
										<div class="vdoSpecial" style="left:650px">
											<iframe class="align-left" width="450" height="280" src="https://www.youtube.com/embed/<?php echo $get_args['v']; ?>" frameborder="0" allowfullscreen></iframe>							
								
										</div>
									<?php
									}else{
								?>
                                <?php
									$imgs = get_field('special_bImg');
									//echo $imgs;
									$no = 1;
									foreach($imgs AS $img){
										if($no==1){
										?>
                                        <div class="bistroImg1" style="left:590px;width:250px;height:280px;overflow:hidden">
                                        	<?php echo imagesize($img[url],250,280);?>
                                        </div>
                                        <?php
										}else{
										?>
                                        	<div class="bistroImg2" style="left:890px;width:250px;height:280px;overflow:hidden"><?php echo imagesize($img[url],250,280);?></div>
                                        <?php
										}
										?>					
									<?php
										$no++;
									}
									?>
										
						<?php } ?>
					</div> 
					<div class="excerpt" style='font-size:22px;background-color:<?php echo the_field('special_bbcolor');?>;'>
						<br/><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/quote1.png" border="0"><p></p><?php echo the_field('special_bdesc');?><p><p><img src="<?php echo get_template_directory_uri(); ?>/_inc/images/quote2.png" border="0"><br/>
					</div>
					<div class="social2" style="float:left;top:1050px;"><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></div>
				</div>	
				<?php endwhile;?>
				<div class="content-box" style="margin-top:40px;">
                	
                    <div class="cleaner_h10"></div>
                  
                    <div class="box-left">
                   	<ul class="grid effect-3" id="grid">
                    <?php
						if ( have_posts() ) :
							query_posts(array( 
								'post_type' => 'reviews'
							) );  
							$count=0;
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
									<div class="specialTitle"  style="background-color:<?php echo $randomColor;?>;" ><?php the_title(); ?></div>
									<?php $post_id = get_the_id();?>
									<?php if (has_post_thumbnail( $post_id) ): ?>
									 <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' ); ?>
									 <a href="<?php the_permalink();?>"><img src="<?php echo $image[0]; ?>" width="368"/></a>
									<?php endif; ?>
									<div class="specialExcerp"><a href="<?php the_permalink();?>"><?php echo the_field('special_bdesc');?></a></div>
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
            </div><!-- End content-special-->  
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