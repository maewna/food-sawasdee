<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="X-UA-Compatible" content="IE=8" >
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
        
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if ( current_theme_supports( 'bp-default-responsive' ) ) : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php endif; ?>
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<meta name="Description" content=""/>
		<meta name="Keywords" content="" />
		<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/favicon.ico">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        
         <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/search.css">
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/script-search.js" type="text/javascript"></script>    
        
				<!-- Add fancyBox main JS and CSS files -->
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.min.js"></script>
      
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery-1.8.2.min.js"></script>
		

	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/divbox.css" />
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/divbox.js"></script>   
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/colorbox.css" />
    <script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jquery.colorbox.js"></script>

		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			 $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"}); 
			 $("#clock1").clock({"format":"24","seconds":"false", "calendar":"false"}); 			 
			});    
		  </script>
          
          


		<script type="text/javascript" charset="utf-8">
		$(function() {
				var url = window.location.href;
				$("#menu-main_nav a").each(function() {
					if (url == (this.href)) {
						$(this).closest("li").addClass("active");
					}
				});
			});   
		</script>

<script type="text/javascript">
$(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = '290'; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.btn_close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>

		<?php wp_head(); ?>
		<?php bp_head(); ?>
<style>
#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}
.login-popup{
	  float: left;
	  display:none;
  /* font-size: 1.2em; */
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 99999;
}

img.btn_close {
margin-left: 645px;
  margin-top: 10px;
  position: absolute;
}
#ex3::-webkit-scrollbar{
width:5px;
background-color:#cccccc;
} 
#ex3::-webkit-scrollbar-thumb{
background-color:#F19D36;
border-radius:10px;
}
#ex3::-webkit-scrollbar-thumb:hover{
background-color:#F19D36;
}
#ex3::-webkit-scrollbar-thumb:active{
background-color:#F19D36;
} 
</style>
</head>

	<body <?php body_class(); ?> id="bp-default">
		<?php do_action( 'bp_before_header' ); ?>

<div id="home-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
 
<?php global $current_user;
      get_currentuserinfo();
list($rank,$rankImg) = lvMember($current_user->ID);
	$num_recipe_head = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author='".$current_user->ID."' AND post_type='recipes' AND post_status='publish'");
	$sql = "SELECT * FROM wp_posts WHERE post_type='review' AND post_status='publish' AND post_author='".$current_user->ID."'";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
?>    
<?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
	$count = bp_follow_total_follow_counts();
endif;?>
<?php if ( function_exists( 'bp_follow_total_follow_counts' ) ) :
	$count = bp_follow_total_follow_counts();	
endif;?>	  
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
                    		<div class="header-user">
							<div class="header-wr-avatar">	
								<div id="noti-icon">
									<ul class="menu-notification">
										<li style="padding-top:6px;">
											<?php $numNoti = cg_current_user_notification_count(); 
												echo nice_number($numNoti);

											?>
									 		<?php bp_notifications_menu(); ?>
														
										</li>
							
									</ul>
								</div><!--noti-icon-->
                            	<img src="<?php echo $rankImg;?>" class="header-user-status"/>
                                
                                <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/user-avatar.png" class="header-user-avatar"/>

								<div class="header-avatar">								
									<a href="<?php global $current_user; echo home_url() . '/members/' . $current_user->user_login . '/profile/'; ?>"><?php global $userdata; get_currentuserinfo(); echo get_avatar( $userdata->ID); ?></a>
								</div>
							</div><!--header-wr-avatar-->
	                            <div class="header-user-detail">
                                
                                	<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-user.png" class="header-user-status"/>
		                            <span style="font-family:tahoma; font-weight:bold; font-size:14px; color:#673e1a; margin-left: 5px;">
									<a href="<?php global $current_user; echo home_url() . '/members/' . $current_user->user_login . '/profile/'; ?>" style="color:#673e1a;"><?php echo $current_user->display_name; ?></a>
									</span><br>
									<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/line.png" style="margin-left: -2px;width: 442px;"/>
                                   <div class="header-line"></div>
                                   <div class="cleaner_h5"></div>
                                   <div class="header-box">
                                   <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-review.png" class="header-user-status"/>
                                   <span class="header-title">รีวิว</span> 
                                   <span class="header-font" style="margin-left:51px;"><?php echo nice_number($num); ?></span>
                                    
                                   <div class="cleaner_h5"></div>
                                   <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-food.png" style="margin-left: -3px;" 
                                   class="header-user-status"/>
                                    <span class="header-title">สูตรอาหาร</span>
                                   <span class="header-font" style="margin-left:12px;"><?php echo nice_number($num_recipe_head); ?></span>   
                                   </div>
                                   
                                   <div class="header-box">
                                   <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-review.png" class="header-user-status"/>
                                   <span class="header-title">Follow</span> 
                                   <span class="header-font" style="margin-left:51px;"><?php echo nice_number($count['following']); ?></span>
                                   <div class="cleaner_h5"></div>
                                   <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-food.png" style="margin-left: -3px;" 
                                   class="header-user-status"/>
                                    <span class="header-title">Follower</span>
                                   <span class="header-font" style="margin-left:9px;"><?php echo nice_number($count['followers']); ?></span>   
                                   </div>
                                   
                                    <div class="header-box">
                                   <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/icon-review.png" class="header-user-status"/>
                                   <span class="header-title">Point</span> 
                                   <span class="header-font"><?php echo do_shortcode( '[mycred_my_balance]' );?></span>  
                                   </div>
                                   
                            	</div>
                            </div>
                            
							<li style="margin-top:35px; margin-right:45px; float:left;"><a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/logout.png"/></a></li>
                            
					<?php	} else { ?>
							<li class="register" style="margin-top:30px;"><a class="login-window" href="#login-box">สมัครสมาชิก</a></li>
							 <div id="login-box" class="login-popup" style="margin-top: -290px;">
        <a href="#" class="btn_close"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/close-register.png" alt="Close" class="btn_close" /></a>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/macrot1.png"  style="position: absolute;  margin-left: 55px;  margin-top: 535px;"/>
    	 <iframe id="ex3" src="register" style="width: 730px; height: 700px;"> </iframe>
        
		</div>
							<!--<li class="login" style="margin-top:30px;"><a class="fancybox-login" href="wp-login.php">เข้าสู่ระบบ</a></li>-->
                            <li class="login" style="margin-top:30px;"><a href="wp-login.php" class="simplemodal-login">เข้าสู่ระบบ</a>
					<?php	} ?>
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		


<script type="text/javascript">
				$('.lightbox').divbox({caption: false});
				$('.popup').divbox({type: 'element',caption: false});
				$('.ajax').divbox({type: 'ajax',caption: false});
				var opt = {};
				opt.api = {
					start: function(obj){alert('Start...');},
					beginLoad: function(obj){alert('Begin to load ...');},
					afterLoad: function(obj){alert('Load success...');},
					closed: function(obj){alert('Closed...');}
				}
				$('.api').divbox(opt);
				
				var opt = {};
				opt.languages = {
					btn_close: 'Dong',
					btn_next: 'Sau',
					btn_prev: 'Truoc',
					click_full_image: 'Xem hinh lon',
					error_not_youtube: 'Day khong phai la link youtube',
					error_cannot_load: "Khong the load trang nay\nMa loi: "
				}
				$('.lang').divbox(opt);
				 </script>
                 
                
		<div id="container">

 <div id='newmenu'>
	<ul>
        	<li class='has-sub'><a href="<?php echo home_url(); ?>/cooking/"><i class="icon1"> </i>Food@Home</a>
            		 <ul>
                	<li class='has-sub'><a href="<?php echo home_url(); ?>/easy-recipes/" >Quick & Easy</a></li>
					<li class='has-sub'><a href="<?php echo home_url(); ?>/celeb-cooking/">Food Idol</a></li>
					<li class='has-sub'><a href="<?php echo home_url(); ?>/set-menu/">Healthy Set</a></li>
					<li class='has-sub'><a href="<?php echo home_url(); ?>/kitchen-tips/">Kitchen Tricks & Tips</a></li>



					<li class='has-sub'>
<?php if ( is_user_logged_in() ) { ?>
	<a href="<?php echo home_url(); ?>/add-recipe/">Add Recipe <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: 10px; margin-top:-6px;"></a>
<?php } else { ?>
	<a href="wp-login.php" class="simplemodal-login">Add Recipe <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: 10px; margin-top:-6px;"></a>
<?php } ?>
</li>


					<li class='has-sub'><a href="<?php echo home_url(); ?>/all-recipes/">All Recipes</a></li>
                </ul>
            </li>
            <li class='has-sub'><a href="<?php echo home_url(); ?>/restaurants/"><i class="icon2"> </i>Food Hunting</a>
            		<ul>
                    
                   <li class='has-sub'><a href="<?php echo home_url(); ?>/reviews/">Selected Restaurants</a></li>
				   <li class='has-sub'><a href="<?php echo home_url(); ?>/recommended/">Variety Taste</a></li>
				
<li class='has-sub'>
<?php if ( is_user_logged_in() ) { ?>
	<a href="<?php echo home_url(); ?>/add-restaurant/">Add Restaurant <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: 10px; margin-top:-6px;"></a>
<?php } else { ?>
	<a href="wp-login.php" class="simplemodal-login">Add Restaurant <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/new-icon.png" style="position: absolute;margin-left: 10px; margin-top:-6px;"></a>
<?php } ?>

</li>

				<li class='has-sub'><a href="<?php echo home_url(); ?>/all-restaurants/">All Restaurants</a></li>
                    </ul>
            </li>
           <li class='has-sub'><a href="<?php echo home_url(); ?>/articles/"><i class="icon3"> </i>Food Fun Fact</a>
            <ul>
                    
                   <li class='has-sub'><a href="<?php echo home_url(); ?>/happening/">Happening!</a></li>
				   <li class='has-sub'><a href="<?php echo home_url(); ?>/food-library/">Food Library</a></li>
				<li class='has-sub'><a href="<?php echo home_url(); ?>/fact/">Food Fact</a></li>
				<li class='has-sub'><a href="<?php echo home_url(); ?>/fun/">Food Fun</a></li>
                    </ul>
            
            </li>
            <li><a href="<?php echo home_url(); ?>/campaigns/"><i class="icon4"> </i>Food Scenes</a></li>
            <li><a href="<?php echo home_url(); ?>/best-deals/"><i class="icon5"> </i>Best Deals</a></li>
			<li><a href="<?php echo home_url(); ?>/shops/" style="width:161px;"><i class="icon6"> </i>Food Land</a></li>
           
        </ul>
       
    </div>
        