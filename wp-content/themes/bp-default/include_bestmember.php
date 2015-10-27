<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/include_bestmember.css" />
	<div class="iconBest"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/iconBestReview.png" width="60" height="62" /></div>
	<div class="bestTitle">สุดยอด Food Sawasdee</div>
	<div class="bestSubTitle">ใน 30 วันที่ผ่านมา</div>
	<div class="rankMember">
		<div class="shopper"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/shopper.png" width="114" height="211" /></div>
		<div class="graph">
			<?php 
				$sql_topmember = "SELECT post_author,
								COUNT(CASE WHEN post_type like 'review' then 1 ELSE NULL END) as review,
								COUNT(CASE WHEN post_type like 'recipes' then 1 ELSE NULL END) as recipes,
								COUNT(*) as allpost
								FROM wp_posts
								WHERE post_status='publish'
								AND post_date > NOW() - INTERVAL 30 DAY
								AND post_type IN ('review','recipes')
								GROUP BY post_author 
								ORDER BY allpost DESC
								LIMIT 5";
				$query = $wpdb->get_results($sql_topmember);
				//$member_rows = $wpdb->num_rows;
				$lv = 5;
				for($i=0;$i<5;$i++){
					$author_id = $query[$i]->post_author;
					list($rank,$rankImg) = lvMember($author_id);
				?>
					<div class="bar">	
						<?php if($query[$i]->recipes!=0){echo $query[$i]->recipes;}else{echo "0";}?> สูตร <br/><?php if($query[$i]->review!=0){echo $query[$i]->review;}else{echo "0";}?> รีวิว
						<?php echo get_avatar( $author_id,40); ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/level-<?php echo $lv;?>.jpg" style="margin-top:5px;"/>
						<img src="<?php echo $rankImg;?>" width="30" height="32" style="    left: 6px;bottom: 2px;position:absolute;">
					</div>
				<?php 
					$lv--;
				}
				?>
		</div> <!-- end graph-->
		<div style="clear:both"></div>
		<?php
		if ( is_user_logged_in() ) {
		} else {
		?>	
			<div class="btn_regis" style="float:left;"><a  class="iframe" id="registerBtn" href="http://soba.foodsawasdee.com/register/">สมัครสมาชิกคลิกเลย</a></div>
			<div style="float:left;"><a class="fancybox-login" id="loginBtn" href="<?php echo wp_login_url(); ?>">เข้าสู่ระบบ</a></div>
		<?php	
		}
		?>
		
	</div>
	<div style="clear:both"></div>