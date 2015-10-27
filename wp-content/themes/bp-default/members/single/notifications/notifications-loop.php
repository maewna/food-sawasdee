<?php
$id= $_GET["id"];
if ($_GET["submit"]=="DEL"){
             $sql_del="delete from wp_bp_notifications where id ='".$id."' " ;
              mysql_query($sql_del);
		
}


if (isset($_POST['del_all'])){
	$id=$_POST['checkbox'];
	$N = count($id);
			for($i=0; $i < $N; $i++){
			$del_id=$_POST['checkbox'][$i];
            $sql_del="delete from wp_bp_notifications where id ='".$id[$i]."' " ;
            $result = mysql_query($sql_del);
			}
       }
?>
<?php
// ฟังก์ชั่นสำหรับการแบ่งหน้า NEW MODIFY
function page_navi($before_p,$plus_p,$total,$total_p,$chk_page){      
    global $urlquery_str;   
    $pPrev=$chk_page-1;   
    $pPrev=($pPrev>=0)?$pPrev:0;   
    $pNext=$chk_page+1;   
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;        
    $lt_page=$total_p-4;   
    if($chk_page>0){     
        echo "<a  href='$urlquery_str"."?pages=".intval($pPrev+1)."' class='naviPN page-numbers'>ก่อนหน้า</a>";   
    }   
    if($total_p>=11){   
        if($chk_page>=4){   
            echo "<a $nClass href='$urlquery_str"."?pages=1'>1</a><a class='SpaceC'>. . .</a>";      
        }   
        if($chk_page<4){   
            for($i=0;$i<$total_p;$i++){     
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                if($i<=4){   
                echo "<a $nClass href='$urlquery_str"."?pages=".intval($i+1)."' >".intval($i+1)."</a> ";      
                }   
                if($i==$total_p-1 ){    
                echo "<a class='SpaceC'>. . .</a><a $nClass href='$urlquery_str"."?pages=".intval($i+1)."'>".intval($i+1)."</a> ";      
                }          
            }   
        }   
        if($chk_page>=4 && $chk_page<$lt_page){   
            $st_page=$chk_page-3;   
            for($i=1;$i<=5;$i++){   
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";   
                echo "<a $nClass href='$urlquery_str"."?pages=".intval($st_page+$i+1)."'>".intval($st_page+$i+1)."</a> ";         
            }   
            for($i=0;$i<$total_p;$i++){     
                if($i==$total_p-1 ){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='$urlquery_str"."?pages=".intval($i+1)."'>".intval($i+1)."</a> ";      
                }          
            }                                      
        }      
        if($chk_page>=$lt_page){   
            for($i=0;$i<=4;$i++){   
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";   
                echo "<a $nClass href='$urlquery_str"."?pages=".intval($lt_page+$i)."'>".intval($lt_page+$i)."</a> ";      
            }   
        }           
    }else{   
        for($i=0;$i<$total_p;$i++){     
            $nClass=($chk_page==$i)?"class='selectPage'":"";   
            echo "<a href='$urlquery_str"."?pages=".intval($i+1)."' $nClass  >".intval($i+1)."</a> ";      
        }          
    }      
    if($chk_page<$total_p-1){   
        echo "<a href='$urlquery_str"."?pages=".intval($pNext+1)."'  class='naviPN page-numbers'>ถัดไป</a>";   
    }   
}
?>
<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var i=1;
		for(i=1;i<=document.form1.hdnLine.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.form1.checkbox"+i+".checked=true");
			}
			else
			{
				eval("document.form1.checkbox"+i+".checked=false");
			}
		}
	}

	function onDelete()
	{
		if(confirm('คุณต้องการลบการแจ้งเตือน?')==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
</script>


<?php
$sql ="SELECT * ,wp_bp_notifications.id as ID1, wp_bp_xprofile_data.id as ID2 FROM wp_bp_notifications LEFT JOIN wp_users ON wp_bp_notifications.user_id = wp_users.ID LEFT JOIN wp_bp_xprofile_data ON wp_bp_xprofile_data.user_id = wp_bp_notifications.item_id LEFT JOIN wp_posts ON wp_bp_notifications.secondary_item_id = wp_posts.ID  WHERE wp_bp_xprofile_data.field_id = 1 AND wp_bp_notifications.user_id ='".get_current_user_id()."' ";
	  $query =mysql_query($sql);	
	  $total = mysql_num_rows($query);
	  $current_user = wp_get_current_user();
$e_page= 10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
if(!isset($_GET['pages'])){   
	$_GET['pages']=0;   
}else{   
	$_GET['pages']=$_GET['pages']-1;
if($_GET['pages']<0){
	$_GET['pages']=0;	
}
	$chk_page=$_GET['pages'];     
	$_GET['pages']=$_GET['pages']*$e_page;   
}  
$sql.=" ORDER BY wp_bp_notifications.id DESC  LIMIT ".$_GET['pages'].",$e_page"; 
$query =mysql_query($sql);	

if(@mysql_num_rows($query) >= 1){   
			$plus_p=($chk_page*$e_page)+@mysql_num_rows($query);   
		}else{   
			$plus_p=($chk_page*$e_page);       
		}   
		$total_p=ceil($total/$e_page);   
		$before_p=($chk_page*$e_page)+1;  
?>
<form name="form1" method="post" action="../../../members/<?php  echo $current_user->user_login ; ?>/notifications/" OnSubmit="return onDelete();">
<table class="notifications">
	<thead>
		<tr>
        	<th style="width: 1px; padding:0"><input type="checkbox" name="CheckAll" id="checkbox" class="css-checkbox" onClick="ClickCheckAll(this);"> <label for="checkbox" class="css-label"></label></th>
			<th class="title" style="padding-left:2px; width: 430px;"><span style="font-family: supermarket;font-weight: normal;font-size: 16px; ">เลือกทั้งหมด</span></th>
			<th class="date"></th>
			<th class="actions" style="float: right;">
				<div class="notification-options-nav">
                 <button name="del_all" type="submit" ><div class="bt-del-all"></div></button>
				</div><!-- .notification-options-nav -->
			</th>
		</tr>
	</thead>
	<tbody>
		<?php 
					$i = 1;
					while($results = mysql_fetch_array($query)){ 
					$i <= $total;		
			?>	
	
			<tr>
                
                <td style="width: 1px; padding:0">
                <div class="checkboxes">
                <input name="checkbox[]" id="checkbox<?php echo $i ;?>" type="checkbox"  value="<?php echo $results['ID1']; ?>" class="notification-check css-checkbox"> <label for="checkbox<?=$i;?>" class="css-label"></label>
				</div>
				</td>
                
				<td class="notify-text" style="padding-left:2px"> 
            <?php if ($results['is_new'] ==  '1'){ ?>
            <span style="  font-family: supermarket;font-weight: normal;font-size: 14px;">
            <?php if ($results['component_action'] ==  'new_at_recipes'){
					$postTypeTH = 'สร้างสูตรอาหาร';
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read2">'.$results['value'].
							 '&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif($results['component_action'] ==  'new_at_bistro'){
					$postTypeTH = 'สร้างร้านอาหาร';
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read2">'.$results['value'].
							'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif($results['component_action'] ==  'new_at_review'){
					$postTypeTH = 'สร้างรีวิว';	
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read2">'.$results['value'].
							 '&nbsp;'.$postTypeTH.$results['post_title']."</a>";		
				}elseif ($results['component_action'] ==  'edit_at_recipes'){
					$postTypeTH = 'แก้ไขสูตรอาหาร';
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read2">'.$results['value'].
							'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'edit_at_bistro'){
					$postTypeTH = 'แก้ไขร้านอาหาร';
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read2">'.$results['value'].
							'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'edit_at_review'){
					$postTypeTH = 'แก้ไขรีวิว';	
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read2">'.$results['value'].
							'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'new_follow'){
						echo '<a href="/wp-content/themes/bp-default/members/single/notifications/notifications-loop-action.php?id='.$results['ID1'].'&action=read">'.$results['value']."กำลังติดตามคุณ</a>";
				}
			?>
            </span>
			<?php }else{ ?>
            <?php $sql1 ="SELECT * FROM wp_users LEFT JOIN wp_bp_notifications ON wp_users.ID = wp_bp_notifications.item_id WHERE wp_bp_notifications.item_id ='".$results['item_id']."' ";
		$query1 =mysql_query($sql1);	
		$results1 = mysql_fetch_array($query1);
		?>
            <span style="  font-family: supermarket;font-weight: normal;font-size: 14px;">
            <?php if ($results['component_action'] ==  'new_at_recipes'){
						$postTypeTH = 'สร้างสูตรอาหาร';
							 echo '<a href="'.$results['guid'].'" style="color: #a0a0a0;">'.$results['value'].'&nbsp;'.$postTypeTH.$results['post_title']."</a>";	
				}elseif($results['component_action'] ==  'new_at_bistro'){
						$postTypeTH = 'สร้างร้านอาหาร';
							echo '<a href="'.$results['guid'].'" style="color: #a0a0a0;">'.$results['value'].'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif($results['component_action'] ==  'new_at_review'){
							$postTypeTH = 'สร้างรีวิว';	
							echo '<a href="'.$results['guid'].'" style="color: #a0a0a0;">'.$results['value'].'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'edit_at_recipes'){
							$postTypeTH = 'แก้ไขสูตรอาหาร';
							echo '<a href="'.$results['guid'].'" style="color: #a0a0a0;">'.$results['value'].'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'edit_at_bistro'){
							$postTypeTH = 'แก้ไขร้านอาหาร';
							echo '<a href="'.$results['guid'].'" style="color: #a0a0a0;">'.$results['value'].'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'edit_at_review'){
							$postTypeTH = 'แก้ไขรีวิว';	
							echo '<a href="'.$results['guid'].'" style="color: #a0a0a0;">'.$results['value'].'&nbsp;'.$postTypeTH.$results['post_title']."</a>";
				}elseif ($results['component_action'] ==  'new_follow'){
							echo '<a href="../../../members/'.$results1['user_login'].'/?bpf_read" style="color: #a0a0a0;">'.$results['value']."กำลังติดตามคุณ</a>";
				}
			?>
            </span>
			<?php } ?>
			</td>
				<td class="notify-date" style="font-family: supermarket; color: #a0a0a0;">
				<?php $str =  (explode(" ",$results['date_notified'])); 
					 echo thai_date(strtotime($str[0])) .'&nbsp;|&nbsp;'. substr($str[1],0,5)."&nbsp;น.";
				?>

       </td>
 
				<td class="notify-actions" style="float: right;">
                
                 <a href="../../../members/<?php echo $results['user_login']; ?>/notifications/?id=<?php echo $results['ID1']; ?>&submit=DEL" OnClick="return onDelete();"><div class="bt-read"></div></a></td>
			</tr>

		<?php $i = $i + 1 ; 
		
		 } 
		 ?>

	</tbody>
</table>

<input type="hidden" name="hdnLine" value="<?=$i;?>">
</form>
<br /><br />

                     
    <div class="browse_page">
   <div class="pag-count" style="float:left;"> แจ้งเตือนทั้งหมด <?php echo $total ;?> รายการ  &nbsp; </div>
    <?php if($total>10){ ?> 
   <div class="pagination-links" style="float:right;">
    <?php      
    // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า      
    page_navi($before_p,$plus_p,$total,$total_p,$chk_page);     
    ?>
    </div>
    <?php } ?> 
    </div>   
    