<?php /*Template Name: Promotion Page */ ?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/promotion.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/colorbox.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.colorbox.js"></script>




	<script type="text/javascript">
		$(document).ready(function() {
		$(".iframe").colorbox({iframe:true, width:"738px", height:"478px", overflow: "hidden", iframe:true
			
		});
			
		});

	</script>

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
		
            <div class="content-by-meal" style="margin-bottom: -5px;">
       <?php include_once('wp-content/themes/bp-default/bg-time.php');?> 
        	</div><!-- End content-by-meal -->

            <?php 
	$sql="select * from wp_promotion  ORDER BY start_date DESC";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	
	?>
            <div class="content-promotion">
				<div class="content-box">
                	<div class="title-promotion"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/title-promotion.png"/></div>
                	<h3 class="promotion">พบโปรโมชั่นทั้งหมด <?php echo $num; ?> โปรโมชั่น</h3>
                    <div class="cleaner_h10"></div>
                  
                    <div class="box-left">
                   	<ul class="grid effect-3" id="grid">
                    <?php
						 while($row_type=mysql_fetch_array($query)){
								$start_date = substr($row_type['start_date'],0,10);
								$end_date = substr($row_type['end_date'],0,10);
					?>
                        <li>
                              <a class="iframe" href="/promotion-lightbox?id=<?php echo $row_type['ID_PR'];?>">
                                 <div class="box-image">
                                 	<?php if($row_type['discount']=='Free'){ ?>
                                      <div class="percent"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/free.png"/></div>
                                   <?php  } else {?>
                                 	<div class="discount"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/discount.png"/></div>
                                   
                                    <div class="percent"><div class="text-percent"><?php echo $row_type['percent'];?>%</div></div>
                                    <?php } ?>
                                 
                                	<img src="/wp-content/plugins/promotion/<?php echo $row_type['image']; ?>"/>	
                                	
                                     <div class="bg-promotion-title">
                                         <span class="title-promotion-font"><?php echo substr_utf8( $row_type['title'], 0 , 28); ?></span>
                                     <div class="cleaner_h3"></div>
                                         <span class="detail-promotion-font"><?php echo substr_utf8($row_type['description'],0,30);?></span>
                                     </div>
                                </div>
                            </a>
                          
                        </li>
                    <?php } ?>
                         
					</ul>
                  </div>
                  
                  <div class="box-right">
                  		<a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/shop-bt.png"/></a>
                    <div class="cleaner_h20"></div>
                    <div class="bg-popular">
                    	<a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/santafe.png"/></a>
                        <a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/haagen.png"/></a>
                        <a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/carls.png"/></a>
                    </div>
                    
                   </div>
                   
 				<div class="cleaner_h30"></div>
                
                </div>    
            </div><!-- End content-promotion-->

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

<!--<script>
$(function(){
  $('#grid').mixItUp();
});
</script>-->
<?php get_footer(); ?>