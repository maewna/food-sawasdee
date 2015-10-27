<div class="prof-left-1 align-left" style="background: #fff; margin-top: 10px;">
        	<section class="member-profile">
				<a href="<?php bp_displayed_user_link(); ?>" class="member-fullname"><?php bp_displayed_user_fullname(); ?></a>	
				<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/profile/point.png"style ="margin-right: 5px;float: left;">
				<span style="float: left;   margin-right: 5px;"><?php echo do_shortcode( '[mycred_my_balance]' );?></span><span> Point</span>
				<span id="btn-slide" style="float:right;">ข้อมูลเพิ่มเติม</span>
				<div id="member-profile-box">
				<?php 
					locate_template( array( 'members/single/profile/profile-loop.php' ), true );
				?>
				</div>
			</section>
  
        	<section class="member-activities">	




<?php //if ( bp_has_notifications( bp_ajax_querystring( 'notifications' ) ) )  : ?>

	<!--<div id="pag-top" class="pagination no-ajax">
		<div class="pag-count" id="notifications-count-top">
			<?php bp_notifications_pagination_count(); ?>
		</div>

		<div class="pagination-links" id="notifications-pag-top">
			<?php bp_notifications_pagination_links(); ?>
		</div>
	</div>-->

	<?php bp_get_template_part( 'members/single/notifications/notifications-loop' ); ?>

	<!--<div id="pag-bottom" class="pagination no-ajax">
		<div class="pag-count" id="notifications-count-bottom">
			<?php bp_notifications_pagination_count(); ?>
		</div>
<br><br>
		<div class="pagination" id="notifications-pag-bottom">
			<div class="pag-count"><?php bp_notifications_pagination_count(); ?></div>
			<div class="pagination-links"><?php bp_notifications_pagination_links(); ?></div>
		</div>-->







</section>
			
		
          

		</div><!-- End left -->
			<div class="prof-right-1 align-left" style="background: #fff;  margin-top: 10px;">
				<?php locate_template( array( 'members/single/follow.php' ), true ); ?>
			</div><!-- End right -->
            	

