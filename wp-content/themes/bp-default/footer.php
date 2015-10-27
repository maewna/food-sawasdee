		</div> <!-- #container -->

		<?php do_action( 'bp_after_container' ); ?>
		<?php do_action( 'bp_before_footer'   ); ?>

		
	
			
		<div id="footer">
		
			<div id="afooter">
				<div><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/footer-1.png"></div>
				
			</div> 
			<div id="bfooter">
					<div style="float:left;"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/footer-cartoon.png"></div>
					<div style="float:left;" class="bubble">
						<p style="color: #000100; font-size: 14px; font-family: tahoma; line-height: 19px;"><a href="<?php echo site_url(); ?>" style="color:#000100;text-decoration:none;">www.FoodSawasdee.com</a> : เว็บไซต์ที่รวบรวมข้อมูลอาหารให้คุณได้ค้นหาข้อมูลอย่างง่ายดาย ทุกมื้อ ทุกเวลา<br/>
						<a href="<?php echo site_url(); ?>/recipes" style="color:#000100;text-decoration:none;">Food@Home</a> | <a href="<?php echo site_url(); ?>/bistros" style="color:#000100;text-decoration:none;">Food Hunting</a> | <a href="<?php echo site_url(); ?>/hilight-trend-likesara" style="color:#000100;text-decoration:none;">Food Fun Fact</a> | <a href="<?php echo site_url(); ?>/event" style="color:#000100;text-decoration:none;">Food Scenes</a>  | <a href="<?php echo site_url(); ?>/#" style="color:#000100;text-decoration:none;">Contact FSD</a>  | <a href="<?php echo site_url(); ?>/#" style="color:#000100;text-decoration:none;">FAQ</a> | <a href="<?php echo site_url(); ?>/#" style="color:#000100;text-decoration:none;">What's Up</a></p>
					</div>
			</div>
				
			<div id="home-cfooter">
				<span class="cfooter">สงวนลิขสิทธิ์ © 2557 ฟู้ดสวัสดี</span>
			</div>


			<?php do_action( 'bp_footer' ); ?>

		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ); ?>

		<?php wp_footer(); ?>

	</body>

</html>