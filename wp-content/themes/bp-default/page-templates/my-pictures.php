
		 <?php  
				
				/*$images =& get_children( 'post_type=attachment&post_mime_type=image');

				$videos =& get_children( 'post_type=attachment&post_mime_type=video/mp4' );
				
				if ( empty($images) ) {
					// no attachments here
				} else {
					foreach ( $images as $attachment_id => $attachment ) {
						echo wp_get_attachment_image(  $attachment_id, 'thumbnail' );
					}
				}
				echo "------------------------------------------";
				//  If you don't need to handle an empty result:
				
				foreach ( (array) $videos as $attachment_id => $attachment ) {
					echo wp_get_attachment_link( $attachment_id );
				}*/
		?> 				
				
								
				
				<?php
				$uid= $_GET['uid'] ;
				
				echo "<div style='line-height: 20px;'>";
				echo "uid=".$uid;
				echo "</div>";
				
				global $wpdb;
				
				$posts = $wpdb->get_results("SELECT * FROM $wpdb->posts where post_author='".$uid."' AND post_type='attachment' AND post_mime_type='image/%' AND post_status='publish'");

				$post_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts where post_author='".$uid."' AND post_type='attachment' AND post_mime_type='image/%' AND post_status='publish'");

				echo "Pictures (".$post_count.")";
				
				foreach($posts as $post) {
				   
					echo "<div style='line-height: 20px;'>";
					echo get_permalink();
					echo "</div>";
			
				   $atts = wp_get_attachment_image_src($post->ID, 'medium');
				   $full = wp_get_attachment_image_src($post->ID, 'full'); 

				   echo "<a href='".$full[0]."' target='_blank'><img src='".$atts[0]."' width='".$atts[1]."' height='".$atts[2]."' alt=''></a>";
					
				}
				?>