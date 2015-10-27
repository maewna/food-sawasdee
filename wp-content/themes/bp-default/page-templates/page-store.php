<?php
/**
 * Template Name: Store template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Boot Store consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 * Boot Store theme is based on Twentytwelve theme. The official WordPress theme.
 *
 * @package WordPress
 * @subpackage Boot Store
 * @since Boot Store 1.0
 */

get_header();



?>

	

			<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/tcp.css" />
			 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
			  <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>

			  <script type="text/javascript">
				$(document).ready(function(){
				 $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});                                   
				});    
			  </script>

	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-home_page"><a href="<?php echo home_url(); ?>/recipes/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/hilight-trend-likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-home_page active"><a href="<?php echo home_url(); ?>/shop/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-home_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-home_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-home_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>
<div class="container">

	<main id= "tcp-content">	
	
	   <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
		 <div class="content-by-tcp">
		 <section class="my-location">
             <span class="txt-meal"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/morning-icon.png"/>Good Morning</span>
             <span class="txt-time"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/time-icon.png"/><span id="clock4"></span></span>
             <span class="txt-location"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/location-icon.png"/>Sukhumvit Road Phra Khanong Nuea Watthana Krung Thep</span>
        </section><!-- End my-location -->
		<section class="tcp_search">
		
		
		</section>
		<div class="line_br">
		
		</div>
		<section class="tcp_banner">
		<div class="bannercol-1">
		
		
<?php
			$store = new WP_Query( array('post_type' => 'store', 'showposts' => '1', 'post_status'=>'publish') );
			if ( $store->have_posts() ) :
			while (  $store->have_posts() ) :  $store->the_post();  ?>
			
			
			<section id="blockcol1">
			<div class="row1" >
			<img src="<?php the_field('piclogo'); ?>" />
			</div>
			<div class="row2" >
			<img src="<?php the_field('text_satafe'); ?>" />
			</div>
			<div class="row3" >
			<p><?php the_field('dis_satafe'); ?></p>
			</div>
			</section>
			
			
			
		</div>
		<div class="bannercol-2">
			<div class="bannercol-2-1">
			</div>
			
			<div class="bannercol-2-2">
			<section id="blockcol3">
				<div class="row1">
				<img src="<?php the_field('promotion'); ?>" />
				
				
				</div>
			</section>
				
			</div>
		
		</div>
	
			<?php endwhile; ?>
			<?php endif; ?>	
		
		</section>
		</div>
	
		<div class="content-tcp">
			
			<div class="content-box">
			
			
			<div class="box-left">
				
				<section class="box-cata">
				<p>Menu Cataloge</p>
				</section>
				
				<section class="contain_group_allproduct">
				
				
				<ul class="grid effect-3" id="grid">
		
				<?php get_template_part( 'content', 'page' ); ?> 
				
				</ul>
				</section>
				
				
			</div> <!-- box-left -->
			
	
		
		
		
		<div class="box-right">		
		
		<!--      Time  Delivery        -->
		 <div class="ro11">
			<?php
				$store = new WP_Query( array('post_type' => 'store', 'showposts' => '1', 'post_status'=>'publish') );
				if ( $store->have_posts() ) :
				while (  $store->have_posts() ) :  $store->the_post();  ?>
			
				
				<p><?php the_field('time_table1'); ?></p>
				
			
			
			<?php endwhile; ?>
			<?php endif; ?>	
				
			
		 </div>
		 
		 <!--        Tab Description    -->
		 <div class="bgtab">
		 <p><img src="<?php bloginfo('stylesheet_directory'); ?>/css/images/list1.gif"> ข้อมูลการสั่งซื้อ</p>
		 </div>
		 <!--       Description          -->
		 <div class="ro2">
			
			<?php
				$store = new WP_Query( array('post_type' => 'store', 'showposts' => '1', 'post_status'=>'publish') );
				if ( $store->have_posts() ) :
				while (  $store->have_posts() ) :  $store->the_post();  ?>
			
			<ul>
			
			
			<li>
			<span class="ro2_1"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tcp/icon1.jpg"/>  <span>  สั่งอาหารขั้นต่ำ : <?php the_field('minimum'); ?></span>   </span>
			</li>
			<li>
			<span class="ro2_1"> <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tcp/icon2.jpg"/>  <span >   จัดส่งที่ : <?php the_field('delivery_time'); ?></span>  </span>
			</li>
			<li>
			<span class="ro2_1"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tcp/icon3.jpg"/> <span>  ค่าบริการจัดส่ง :  <?php the_field('delivery_cost'); ?>  บาท</span>   </span>
			</li>
			</ul>
			
			
			<?php endwhile; ?>
			<?php endif; ?>	
		 </div>
		 
		 <!--        Tab Description    -->
		 <div class="bgtab">
		 <p><img src="<?php bloginfo('stylesheet_directory'); ?>/css/images/list1.gif"> เมนูของคุณ</p>
		 </div>
		 <!--     Tab for Shopping Cart       -->
		 <div class="ro3">
		 
		<p><?php get_sidebar(); ?></p>
		</div>

		</div> <!-- box-right -->
		
		<script  type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/masonry.pkgd.min.js"></script>
		<script  type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/imagesloaded.js"></script>
		<script  type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/classie.js"></script>
		<script  type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/AnimOnScroll.js"></script>
		
		  <script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );

		</script>	
		</div> <!-- content-box -->
	</div> <!-- content-tcp -->
		
		
	
</main>

</div>



<?php get_footer(); ?>


