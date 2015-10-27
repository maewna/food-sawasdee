<?php/* Template Name: All Set Menus */?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/setmenu.css">
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/script.js"></script>
<script>
$(document).ready(function(){
				//$("#cssmenu > ul > li:first-child").addClass("open");
				$("#cssmenu > ul > li:first-child").children("ul").css("display","block");
				$("#cssmenu > ul > li:first-child > a").trigger("click");
				
		});
		

	
function getMenu(t,pid){ 
		$.ajax({
			 type:"POST",
			 url: "<?php bloginfo('stylesheet_directory'); ?>/getMenu.php",
			 data: "pid=" + pid + "&type=" + t,
			 success: function(data){
				 
					 document.getElementById('cnt-cate').innerHTML = data;
					//$('#'+t+'-'+pid).closest("ul").css("display","block");
					 //$('#'+t+'-'+pid).closest("li").siblings("li").removeClass("active");
					 //$('#'+t+'-'+pid).closest("li").addClass("active");
					 
					 //if ($('#'+t+'-'+pid).closest("li").hasClass('open')) {
						 	//$('#'+t+'-'+pid).closest("li").removeClass("open");
						 	//$('#'+t+'-'+pid).closest("li").children("ul").css("display","none");
						// }else{
						//	 $('#'+t+'-'+pid).closest("li").addClass("open");
						//	 $('#'+t+'-'+pid).closest("li").children("ul").css("display","block");
					//}
					
					var element = $('#'+t+'-'+pid).parent('li');
					if ( element.hasClass('open') ) {
						element.removeClass('open');
						element.find('li').removeClass('open');
						element.find('ul').slideUp();
					}
					else {
						element.addClass('open');
						element.children('ul').slideDown();
						element.siblings('li').children('ul').slideUp();
						element.siblings('li').removeClass('open');
						element.siblings('li').find('li').removeClass('open');
						element.siblings('li').find('ul').slideUp();
					}
					
					 
				 }
		});
	}
	
	
	
	
	
	
	function getMenu1(t,pid){ 
		$.ajax({
			 type:"POST",
			 url: "<?php bloginfo('stylesheet_directory'); ?>/getMenu.php",
			 data: "pid=" + pid + "&type=" + t,
			 success: function(data){
				 
					 document.getElementById('cnt-cate').innerHTML = data;
					 var element = $('#'+t+'-'+pid).parent('li');
					if ( element.hasClass('open') ) {
					}else{
						element.addClass('open');
						element.parent('ul').parent('li').addClass('open');
						element.parent('ul').slideDown();
						element.children('ul').css("display","block");
						}
						
						
				 }
		});
	}
</script>
<?php 	$th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
		$format="H:i:s";
		$time=date($format,$th); ?>
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
  <?php do_action( 'bp_before_blog_home' ); ?>
  <?php do_action( 'template_notices' ); ?>
  <div class="content-by-meal-page">
    <?php  if (get_post_type() == 'celebcook' ) { ?>
    <nav id="navigation-sub" role="navigation">
      <ul id="menu-main_nav_sub">
        <li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/quick-easy/" >ทำเองได้ง่ายและเร็ว</a></li>
        <li class="menu-quick-easy_page active"><a href="<?php echo home_url(); ?>/celebcook/">เข้าครัวกับคนดัง</a></li>
        <li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/setmenu/">อาหารเซท</a></li>
        <li class="menu-quick-easy_page "><a href="<?php echo home_url(); ?>/tip/">เคล็ดลับคู่หูทำอาหาร</a></li>
        <li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/create-recipe/"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: -30px;margin-top: 6px;">สร้างรายการอาหาร</a></li>
        <li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/all-recipes/">เมนูทั้งหมด</a></li>
        <!--<li class="menu-quick-easy_page"><a href="<?php echo home_url(); ?>/local-food/"><i class="icon5"> </i>อาหารรักประเทศไทย</a></li>-->
      </ul>
    </nav>
    <?php } ?>
    <?php include_once('wp-content/themes/bp-default/bg-time.php');?>
  </div>
  <!--END content-by-meal-page-->
  
  <section class="content-set">
    <h2 class="title"><i class="set-icon"></i>อาหารเซ็ททั้งหมด</h2>
    <div class="top-set"></div>
    <div class="wr-set">
      <div id="cssmenu" class="col-left">
        <?php $args = array('type'=> 'set-menu','parent'=> 0,'child_of'=>0,'orderby'=> 'id','order'=> 'ASC','hide_empty'=> 0,'taxonomy'=> 'setmenu-category',);
$categories = get_categories( $args );

echo '<div class="hmenu">รายการอาหารเซ็ท</div>';
echo '<ul>';

foreach ( $categories as $category ) {
			echo '<li class="active has-sub">' ?>
        <a href="#" id="c1-<?php echo $category->term_id; ?>" onClick="getMenu('c1','<?php echo $category->term_id;?>');return false;"><span><?php echo $category->name; ?></span></a>
        <?php 
				query_posts(array( 'post_type' => 'set-menu','parent'=> 0,'child_of'=>0,'showposts' => -1,'tax_query' => array(
				array('include_children'=>false,
					'taxonomy' => 'setmenu-category',
					'terms' => $category->term_id,
					'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			if(have_posts()){
				echo '<ul>';
					while ( have_posts() ) : the_post();
						  echo '<li>'; ?>
        <?php $pid = get_the_ID(); ?>
        <a href="#" id="p-<?php echo $pid; ?>" onClick="getMenu('p','<?php echo $pid;?>');return false;"><span>
        <?php the_title(); ?>
        </span></a> <?php echo '</li>';
					endwhile;
			echo '</ul>';
			}// End if
			wp_reset_query();
			
			$subargs = array('type'=> 'set-menu','child_of'=> $category->term_id,'orderby'=> 'id','order'=> 'ASC','hide_empty'=> 0,'taxonomy'=> 'setmenu-category',);
			$subcategories = get_categories( $subargs );
			if($subcategories) {
					echo '<ul>';
					foreach ( $subcategories as $subcategory ) {
					echo '<li class="has-sub">'; ?> <a id="c2-<?php echo $subcategory->term_id; ?>" href="#" onClick="getMenu('c2','<?php echo $subcategory->term_id;?>');return false;"><span><?php echo $subcategory->name; ?></span><span class="holder"></span></a>
        <?php 
                        query_posts( array( 'post_type' => 'set-menu','showposts' => -1,'tax_query' => array(
                            array(
                                'taxonomy' => 'setmenu-category',
                                'terms' => $subcategory->term_id,
                                'field' => 'term_id',
                                )
                        ),
                        'orderby' => 'title',
                        'order' => 'ASC' )
                        ); 
                            if( have_posts() ){
                                echo '<ul>';
                                        while ( have_posts() ) : the_post();
									    echo '<li>'; ?>
								<?php $pid = get_the_ID(); ?>
                                <a href="#" id="p-<?php echo $pid; ?>" onClick="getMenu('p','<?php echo $pid;?>'); return false;" class=""><span>- 
                                <?php the_title(); ?>
                                </span></a>
                                <?php echo '</li>';
										 endwhile;
                                echo '</ul>';
                           
                            }//end if
						wp_reset_query();
					echo '</li>';
		}//end foreach
		echo '</ul>';	
	}//end if
}
echo '<li>';
echo '</ul>';
?>
      </div>
      <!--End cssmenu-->
      
      <?php


foreach (get_terms($your_taxonomy, array('hide_empty'=>0, 'parent'=>0)) as $each) {
    echo my_Categ_tree($each->taxonomy,$each->term_id);
}

?>
      <div class="col-right">
        <div id="cnt-cate">
        
        </div>
      </div>
      <br class="clear"/>
    </div>
    <!--END wr-set--> 
  </section>
  <!--END content-set--> 
  
</main>
<?php get_footer(); ?>
