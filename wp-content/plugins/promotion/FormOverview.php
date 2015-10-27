<?php global $wpdb; ?>
	<?php 
	$sql="select * from wp_promotion INNER JOIN wp_posts ON wp_promotion.ID_Res = wp_posts.ID WHERE post_type = 'bistro' ORDER BY ID_PR DESC";
	$query = mysql_query($sql);
	
	?>
    <p><input type="button" class="button-primary" name="back" value="<?php _e('Add New Promotion'); ?>" 
        onclick="document.location.href='admin.php?page=add-promotion';" /></p>
            
	<form id="form1" method="get" action="" name="form1">
	
	<table class="widefat post fixed" cellspacing="0">
		<thead>
			<tr>
				<th id="cb" class="manage-column column-cb check-column" style="" scope="col">
					<input type="checkbox" />
				</th>
				<th id="subject" class="manage-column" scope="col">
					<?php _e('ชื่อโปรโมชั่น');?></a>
				</th>
				<th id="author" class="manage-column" scope="col">
					<?php _e('ร้านค้า');?></a>
				</th>
				<th id="location" class="manage-column" scope="col">
					<?php _e('โปรโมชั่น');?></a>
				</th>
				<th id="datefrom" class="manage-column" scope="col">
					<?php _e('วันที่เริ่มโปรโมชั่น');?></a>
				</th>
                <th id="datefrom" class="manage-column" scope="col">
					<?php _e('วันหมดอายุ');?></a>
				</th> 
                <th id="datefrom" class="manage-column" scope="col">
					<?php _e('สถานะ');?></a>
				</th>   
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th id="cb" class="manage-column column-cb check-column" style="" scope="col">
					<input type="checkbox" />
				</th>
				<th id="subject" class="manage-column" scope="col">
					<?php _e('ชื่อโปรโมชั่น');?></a>
				</th>
				<th id="author" class="manage-column" scope="col">
					<?php _e('ร้านค้า');?></a>
				</th>
				<th id="location" class="manage-column" scope="col">
					<?php _e('โปรโมชั่น');?></a>
				</th>
				<th id="datefrom" class="manage-column" scope="col">
					<?php _e('วันที่เริ่มโปรโมชั่น');?></a>
				</th>
                <th id="datefrom" class="manage-column" scope="col">
					<?php _e('วันหมดอายุ');?></a>
				</th> 
                <th id="datefrom" class="manage-column" scope="col">
					<?php _e('สถานะ');?></a>
				</th>   
			</tr>
		</tfoot>
		<tbody>
			<?php
				 while($row_type=mysql_fetch_array($query)){
						$start_date = substr($row_type['start_date'],0,10);
						$end_date = substr($row_type['end_date'],0,10);
				?>
				<tr id="event-<?php echo $row_type['ID_PR']; ?>" valign="top">
					<th class="check-column" scope="row">
						<input type="checkbox" value="<?php echo $row_type['title'];?>" name="events[]"/>
					</th>
         
					<td>
						<a href="admin.php?page=edit-promotion&id=<?php echo $row_type['ID_PR'];?>" ><?php echo $row_type['title']; ?></a>
                        <div class="row-actions">
						<span class="edit">
							
							<a title="<?php _e('แก้ไขโปรโมชั่น'); ?>" 
								href="admin.php?page=edit-promotion&id=<?php echo $row_type['ID_PR'];?>"><?php _e('Edit');?></a> |
						
						</span>
						<span>
							<a class="submitdelete" onclick="if ( confirm('<?php printf(__("คุณต้องการลบโปรโมชั่นของร้าน \\'%s\\'\\n \\'Cancel\\' to stop, \\'OK\\' to delete."), $row_type['title']); ?>') ) { return true;}return false;"
								href="/wp-content/plugins/promotion/delete.php?id=<?php echo $row_type['ID_PR'];?>" 
								title="<?php _e('ลบโปรโมชั่น'); ?>"><?php _e('Delete');?></a> 
							
						</span>
						
						</div>
					</td>
                    <td><?php echo $row_type['post_title']; ?> </td>
					<td>
							<?php echo $row_type['discount']; ?> 
						<?php if($row_type['percent']!=''){
							  echo $row_type['percent']."%"; }
						?>
					</td>
					<td><?php echo $start_date; ?></td>
   					<td><?php echo $end_date; ?></td>
                    <td>
						<?php if($row_type['end_date'] >= date('Y-m-d H:i:s')){
                                echo "โปรโมชั่นนี้ยังไม่หมดอายุ";
                            }else{
                                echo "<span style='color:#ff0000;'>โปรโมชั่นนี้หมดอายุแล้ว<span>";
                            }
                        ?>
                     </td>
				</tr>
				<?php
				} 
			
			?>
		</tbody>
	</table>
	
	</form>