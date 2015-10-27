<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<?php if ( current_theme_supports( 'bp-default-responsive' ) ) : ?><meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php endif; ?>
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
			 $("#clock4").clock({"format":"24","seconds":"false", "calendar":"false"});                                   
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
		<?php wp_head(); ?>
		<?php bp_head(); ?>
</head>
	<body <?php body_class(); ?> id="bp-default">
		<?php do_action( 'bp_before_header' ); ?>


<?php  if (is_page( '15' ) || 'recipes' == get_post_type() ) { ?>
<div id="menu-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>
					
					
					
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-home_page"><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-home_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-home_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-home_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-home_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-home_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>


<?php } else if (is_page( '17' ) || 'bistro' == get_post_type() ) { ?>
<div id="restaurant-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>	
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-restaurant_page"><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-restaurant_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-restaurant_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-restaurant_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-restaurant_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-restaurant_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-restaurant_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-restaurant_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-restaurant_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>


<?php } else if (is_page( '19' )  ) { ?>
<div id="likesala-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>	
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-likesala_page"><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-likesala_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-likesala_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-likesala_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-likesala_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-likesala_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-likesala_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-likesala_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-likesala_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>


<?php } else if (is_page( '21' ) ) { ?>
<div id="event-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-event_page"><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-event_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-event_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-event_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-event_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-event_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-event_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-event_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-event_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>


<?php } else if (is_page( '23' ) ) { ?>
<div id="promotion-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>	
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-promotion_page"><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-promotion_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-promotion_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-promotion_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-promotion_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-promotion_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-promotion_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-promotion_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-promotion_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>


<?php } else if (is_page( '6' ) ) { ?>
<div id="shop-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>	
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li class="menu-shop_page"><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li class="menu-shop_page"><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li class="menu-shop_page"><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li class="menu-shop_page"><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li class="menu-shop_page"><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li class="menu-shop_page"><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li class="menu-shop_page"><a href="#" class="documents">Documents</a></li>
						<li class="menu-shop_page"><a href="#" class="messages">Messages</a></li>
						<li class="menu-shop_page"><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>

<?php } else { ?>
<div id="home-page">
	<header  id="header">
		
			<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr_x( 'Home', 'Home page banner link title', 'buddypress' ); ?>">
				<div id="logo" role="banner">
					<h1><?php bp_site_name(); ?></h1>
				</div>
			</a>
			<div class="header-widget-area">
				<ul id="menu-top-nav">
					<?php if ( is_user_logged_in() ) { ?>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} else { ?>
							<li class="register"><a href="http://foodsawasdee.cpf.co.th/registration/" title="สมัครสมาชิก">สมัครสมาชิก</a></li>
							<li class="login"><?php if ( function_exists('flexible_frontend_login') ) flexible_frontend_login( 'bottom', 'left' ); ?></a></li>
					<?php	} ?>
				</ul>
			</div>		
			<?php do_action( 'bp_header' ); ?>
    </header>
</div>
			<?php do_action( 'bp_after_header' ); ?>
			<?php do_action( 'bp_before_container' ); ?>
		
	<nav id="navigation" role="navigation">
    	<ul id="menu-main_nav">
        	<li><a href="<?php echo home_url(); ?>/menu/"><i class="icon1"> </i>อร่อยในบ้าน</a></li>
            <li><a href="<?php echo home_url(); ?>/bistro/"><i class="icon2"> </i>อร่อยนอกบ้าน</a></li>
            <li><a href="<?php echo home_url(); ?>/likesara/"><i class="icon3"> </i>Like สาระ</a></li>
            <li><a href="<?php echo home_url(); ?>/event/"><i class="icon4"> </i>กิจกรรม</a></li>
            <li><a href="<?php echo home_url(); ?>/promotion/"><i class="icon5"> </i>โปรโมชั่น</a></li>
			<li><a href="<?php echo home_url(); ?>/catalogue/"><i class="icon6"> </i>ช้อปเลย</a>
					 <ul>
						<li><a href="#" class="documents">Documents</a></li>
						<li><a href="#" class="messages">Messages</a></li>
						<li><a href="#" class="signout">Sign Out</a></li>
					</ul>
			
			</li>
        </ul>
    </nav>
<?php } ?>

		<div id="container">