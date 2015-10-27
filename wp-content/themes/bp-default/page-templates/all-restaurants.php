<?php /* Template Name: All Bistro Page*/?>
<?php get_header(); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/outsideHome.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/component.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/allBistro.css" />
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/modernizr.custom.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/_inc/css/search.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

<script>
$(function() {
	
	var meal = new Array();
	var national = new Array();
	var foodtype = new Array();
	var bistrotype = new Array();
	var service = new Array();
	var price = new Array();
	$(".css-checkbox").click(function() {
		var rel = $(this).attr('rel');
		var name = $(this).attr('name');
		if(name=='meal'){
			if (inArray(rel,meal)) {
				removeA(meal,rel);
			}else{
				meal.push(rel);
			}
		}
		if(name=='national'){
			if (inArray(rel,national)) {
				removeA(national,rel);
			}else{
				national.push(rel);
			}
		}
		if(name=='foodtype'){
			if (inArray(rel,foodtype)) {
				removeA(foodtype,rel);
			}else{
				foodtype.push(rel);
			}
		}
		if(name=='bistrotype'){
			if (inArray(rel,bistrotype)) {
				removeA(bistrotype,rel);
			}else{
				bistrotype.push(rel);
			}
		}
		if(name=='service'){
			if (inArray(rel,service)) {
				removeA(service,rel);
			}else{
				service.push(rel);
			}
		}
		if(name=='price'){
			if (inArray(rel,price)) {
				removeA(price,rel);
			}else{
				price.push(rel);
			}
		}
		
		//alert(myCheckboxes);
	    $.ajax({
			type: "GET",
			dataType : "json",
			data:{ meal: meal,national: national,foodtype: foodtype,bistrotype: bistrotype,service: service,price: price},
			url: '<?php echo get_template_directory_uri(); ?>/filterBistro.php',
			beforeSend: function() {
				$('#grid').html("<div align='center' style='margin-top:100px'><img src='<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ajax-loader2.gif'/></div>");
			  },
			success: function(data){
				document.getElementById("grid").innerHTML = '';
				for (var i = 0; i < data.length; i++) {
					document.getElementById("grid").innerHTML += data[i];
				}
				new AnimOnScroll( document.getElementById( 'grid' ), {
					minDuration : 0.4,
					maxDuration : 0.7,
					viewportFactor : 0.2
				} );
			}
			
		});
	});
});
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}
</script>
<?php $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
$format="H:i:s";
$time=date($format,$th);
?>

<main id="content">
		<div class="social">
         	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/tw-icon.png"></li>
          	<li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/fb-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/yt-icon.png"></li>
            <li><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/ig-icon.png"></li>
         </div>
		<?php do_action( 'bp_before_blog_home' ); ?>
		<?php do_action( 'template_notices' ); ?>
		
            <div class="content-by-meal" style="margin-bottom: 5px;">
          
           	
        
					<?php include_once('wp-content/themes/bp-default/bg-time.php');?>
      
        	</div><!-- End content-by-meal -->

            		  
 <?php  $sql_total =   "SELECT DISTINCT post_title,guid, post_id FROM wp_posts 
						LEFT JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id 
						WHERE post_type ='restaurants' AND  post_status='publish'";
		$query_total = $wpdb->get_results($sql_total);
		$num_total = $wpdb->num_rows;
		if ($num_total == 0) {
	?>
	 <div class="box_search_not_fond">
     		<div class="img_not_fond">
            <a href="../create-recipe/"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/add-recipe-search.png" class="add-recipes"/>  </a>
            <a href="../create-bistro/"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/add-bistro-search.png" class="add-bistro"/></a>
            </div>
 
     </div>
                     
		 <?php }else{ ?>
		 <div style='margin-top:20px;background-color:white;width:280px;height:400px;position:absolute'>
		<side style="margin-top:20px;">
        <div class="side_title_bg side_title">Filter</div>
        <ul class="menu">
 <li class="item0" onClick="$([name='meal']).attr('checked', false);"><a href="#">ร้านอาหารทั้งหมด</a></li>
        <div class="cleaner_h3"></div>
		<li class="item1"><a href="#">ช่วงเวลา<span></span></a>
			<ul style="margin-bottom:10px;">
            	 <div class="tags">
                 <li class="checkbox_search"><input type="checkbox" name="meal" id="checkbox1" class="css-checkbox" rel="breakfast" />
                 <label for="checkbox1" class="css-label">มื้อเช้า</label></li>
                 <li class="checkbox_search"><input type="checkbox" name="meal" id="checkbox2" class="css-checkbox" rel="lunch" />
                 <label for="checkbox2" class="css-label">มื้อกลางวัน</label></li>
                 <li class="checkbox_search"><input type="checkbox" name="meal" id="checkbox3" class="css-checkbox" rel="dinner" />
                 <label for="checkbox3" class="css-label">มื้อเย็น</label></li>
                 <li class="checkbox_search"><input type="checkbox" name="meal" id="checkbox4" class="css-checkbox" rel="night" />
                 <label for="checkbox4" class="css-label">มื้อดึก</label></li>
               
                <!-- <li class="checkbox_search"><input type="checkbox" name="meal" id="checkbox5" class="css-checkbox" rel="all" />
                 <label for="checkbox5" class="css-label">24 ชม.</label></li> -->
                </div>
			</ul>
		</li>
        <div class="cleaner_h3"></div>
		<li class="item2"><a href="#">สัญชาติอาหาร<span></span></a>
			<ul style="margin-bottom:10px;">
            <div class="tags">
            	<li class="checkbox_search"><input type="checkbox" name="national" id="checkbox6" class="css-checkbox" rel="inter" />
                <label for="checkbox6" class="css-label">นานาชาติ</label></li>
            	<li class="checkbox_search"><input type="checkbox" name="national" id="checkbox7" class="css-checkbox" rel="thai" />
                <label for="checkbox7" class="css-label">ไทย</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox8" class="css-checkbox" rel="china" />
                <label for="checkbox8" class="css-label">จีน</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox9" class="css-checkbox" rel="japan" />
                <label for="checkbox9" class="css-label">ญี่ปุ่น</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox10" class="css-checkbox" rel="korea" />
                <label for="checkbox10" class="css-label">เกาหลี</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox11" class="css-checkbox" rel="vietnam" />
                <label for="checkbox11" class="css-label">เวียดนาม</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox12" class="css-checkbox" rel="italy" />
                <label for="checkbox12" class="css-label">อิตาเลียน</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox13" class="css-checkbox" rel="franch" />
                <label for="checkbox13" class="css-label">ฝรั่งเศส</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox14" class="css-checkbox" rel="america" />
                <label for="checkbox14" class="css-label">อเมริกัน</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox15" class="css-checkbox" rel="india"/>
                <label for="checkbox15" class="css-label">อินเดีย</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox16" class="css-checkbox" rel="arab" />
                <label for="checkbox16" class="css-label">อาหรับ</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox17" class="css-checkbox" rel="mexican" />
                <label for="checkbox17" class="css-label">เม็กซิกัน</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox18" class="css-checkbox" rel="muslim" />
                <label for="checkbox18" class="css-label">มุสลิม</label></li>
                <li class="checkbox_search"><input type="checkbox" name="national" id="checkbox19" class="css-checkbox" rel="other" />
                <label for="checkbox19" class="css-label">อื่นๆ</label></li>
              </div>  
			</ul>
		</li>
        <div class="cleaner_h3"></div>
		<li class="item3"><a href="#">ประเภทอาหาร<span></span></a>
			<ul style="margin-bottom:10px;">
             <div class="tags">
             	<li class="checkbox_search"><input type="checkbox" name="foodtype" id="alacarte" class="css-checkbox" rel="alacarte" />
                <label for="alacarte" class="css-label">อาหารจานเดียว</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="maincourse" class="css-checkbox" rel="maincourse" />
                <label for="maincourse" class="css-label">อาหารจานหลัก</label></li>

		 <li class="checkbox_search"><input type="checkbox" name="foodtype" id="northfood" class="css-checkbox" rel="northfood" />
                <label for="northfood" class="css-label">อาหารเหนือ</label></li>

		<li class="checkbox_search"><input type="checkbox" name="foodtype" id="southfood" class="css-checkbox" rel="southfood" />
                <label for="southfood" class="css-label">อาหารปักษ์ใต้</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="northeastfood" class="css-checkbox" rel="northeastfood" />
                <label for="northeastfood" class="css-label">อาหารอีสาน</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="toorder" class="css-checkbox" rel="toorder" />
                <label for="toorder" class="css-label">อาหารตามสั่ง</label></li>

		<li class="checkbox_search"><input type="checkbox" name="foodtype" id="seafood" class="css-checkbox" rel="seafood" />
                <label for="seafood" class="css-label">อาหารซีฟู๊ด</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="snacks" class="css-checkbox" rel="snacks" />
                <label for="snacks" class="css-label">อาหารว่าง</label></li>

		<li class="checkbox_search"><input type="checkbox" name="foodtype" id="halalfood" class="css-checkbox" rel="halalfood" />
                <label for="halalfood" class="css-label">อาหารฟาสต์ฟู้ด</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="fusion" class="css-checkbox" rel="fusion" />
                <label for="fusion" class="css-label">อาหารฟิวชั่น</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="dishes" class="css-checkbox" rel="dishes" />
                <label for="dishes" class="css-label">กับข้าว</label></li>
	
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="vegetarian" class="css-checkbox" rel="vegetarian" />
                <label for="vegetarian" class="css-label">อาหารมังสวิรัติ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="dessert" class="css-checkbox" rel="dessert" />
                <label for="dessert" class="css-label">ขนม/ของหวาน</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="jfood" class="css-checkbox" rel="jfood" />
                <label for="jfood" class="css-label">อาหารเจ</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="babyfood" class="css-checkbox" rel="babyfood" />
                <label for="babyfood" class="css-label">อาหารสำหรับเด็ก</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="shabusuki" class="css-checkbox" rel="shabusuki" />
                <label for="shabusuki" class="css-label">สุกี้ ชาบู</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="halalfood" class="css-checkbox" rel="halalfood" />
                <label for="halalfood" class="css-label">อาหารฮาลาล</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="grillbarbecue" class="css-checkbox" rel="grillbarbecue" />
                <label for="grillbarbecue" class="css-label">ปิ้งย่าง/บาร์บีคิว</label></li>

            
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="drinking" class="css-checkbox" rel="drinking" />
                <label for="drinking" class="css-label">เครื่องดื่ม</label></li>
            
                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="bakery" class="css-checkbox" rel="bakery" />
                <label for="bakery" class="css-label">เบเกอรี่</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="noodle" class="css-checkbox" rel="noodle" />
                <label for="noodle" class="css-label">ก๋วยเตี๋ยว</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="icecream" class="css-checkbox" rel="icecream" />
                <label for="icecream" class="css-label">ไอศกรีม</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="ramen" class="css-checkbox" rel="ramen" />
                <label for="ramen" class="css-label">ราเมน</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="healthfood" class="css-checkbox" rel="healthfood" />
                <label for="healthfood" class="css-label">อาหารเพื่อสุขภาพ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="pizza" class="css-checkbox" rel="pizza" />
                <label for="pizza" class="css-label">พิซซ่า</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="steak" class="css-checkbox" rel="steak" />
                <label for="steak" class="css-label">สเต็ก</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="hotpot" class="css-checkbox" rel="hotpot" />
                <label for="hotpot" class="css-label">หม้อไฟ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="boilrice" class="css-checkbox" rel="boilrice" />
                <label for="boilrice" class="css-label">ข้าวต้ม</label></li>

                <li class="checkbox_search"><input type="checkbox" name="foodtype" id="other" class="css-checkbox" rel="other" />
                <label for="other" class="css-label">อื่นๆ</label></li>
                
                
                </div>
			</ul>
		</li>
        <div class="cleaner_h3"></div>
		<li class="item4"><a href="#">ประเภทร้าน<span></span></a>
			<ul style="margin-bottom:10px;">
             <div class="tags">
             	<li class="checkbox_search"><input type="checkbox" name="bistrotype" id="hotelBistro" class="css-checkbox" rel="hotelBistro" />
                <label for="hotelBistro" class="css-label">ร้านในโรงแรม</label></li>

		<li class="checkbox_search"><input type="checkbox" name="bistrotype" id="ramen" class="css-checkbox" rel="ramen" />
                <label for="ramen" class="css-label">ร้านราเมง</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="buffet" class="css-checkbox" rel="buffet" />
                <label for="buffet" class="css-label">ร้านบุฟเฟต์</label></li>

		<li class="checkbox_search"><input type="checkbox" name="bistrotype" id="coffee" class="css-checkbox" rel="coffee" />
                <label for="coffee" class="css-label">ร้านกาแฟ</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="barbecue" class="css-checkbox" rel="barbecue" />
                <label for="barbecue" class="css-label">ร้านปิ้งย่าง</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="livemusic" class="css-checkbox" rel="livemusic" />
                <label for="livemusic" class="css-label">ร้านดนตรีสด</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="sukiyaki" class="css-checkbox" rel="sukiyaki" />
                <label for="sukiyaki" class="css-label">ร้านสุกี้/ชาบู</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="karaoke" class="css-checkbox" rel="karaoke" />
                <label for="karaoke" class="css-label">ร้านคาราโอเกะ</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="fastfood" class="css-checkbox" rel="fastfood" />
                <label for="fastfood" class="css-label">ร้านฟาสท์ฟู้ดส์</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="agreable" class="css-checkbox" rel="agreable" />
                <label for="agreable" class="css-label">ร้านบรรยากาศดี</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="stall" class="css-checkbox" rel="stall" />
                <label for="stall" class="css-label">ร้านริมทาง/แผงลอย</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="meeting" class="css-checkbox" rel="meeting" />
                <label for="meeting" class="css-label">ร้านเหมาะแก่การสังสรรค์</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="semipub" class="css-checkbox" rel="semipub" />
                <label for="semipub" class="css-label">ร้านอาหารกึ่งผับ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="pubbar" class="css-checkbox" rel="pubbar" />
                <label for="pubbar" class="css-label">ร้านผับ/บาร์</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="beer" class="css-checkbox" rel="beer" />
                <label for="beer" class="css-label">ร้านเบียร์</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="wine" class="css-checkbox" rel="wine" />
                <label for="wine" class="css-label">ร้านไวน์</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="branch" class="css-checkbox" rel="branch" />
                <label for="branch" class="css-label">ร้านสาขา</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="cheftable" class="css-checkbox" rel="cheftable" />
                <label for="cheftable" class="css-label">ร้านเชฟ เทเบิ้ล</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="chineseBistro" class="css-checkbox" rel="chineseBistro" />
                <label for="chineseBistro" class="css-label">ร้านห้องอาหาร/เหลา</label></li>
           
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="bakery" class="css-checkbox" rel="bakery" />
                <label for="bakery" class="css-label">ร้านเบเกอรี่</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="cafe" class="css-checkbox" rel="cafe" />
                <label for="cafe" class="css-label">ร้านคาเฟ่</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="delivery" class="css-checkbox" rel="delivery" />
                <label for="delivery" class="css-label">ร้าน delivery</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="sushiBistro" class="css-checkbox" rel="sushiBistro" />
                <label for="sushiBistro" class="css-label">ร้านซูชิ</label></li>

                
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="onlineBistro" class="css-checkbox" rel="onlineBistro" />
                <label for="onlineBistro" class="css-label">ไม่มีหน้าร้าน จัดส่งเท่านั้น</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="mallBistro" class="css-checkbox" rel="mallBistro" />
                <label for="mallBistro" class="css-label">ร้านในห้างสรรพสินค้า</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="healthfood" class="css-checkbox" rel="healthfood" />
                <label for="healthfood" class="css-label">ร้านอาหารเพื่อสุขภาพ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="rooftop" class="css-checkbox" rel="rooftop" />
                <label for="rooftop" class="css-label">ร้าน Rooftop</label></li>
                

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="familyBistro" class="css-checkbox" rel="familyBistro" />
                <label for="familyBistro" class="css-label">ร้านเหมาะสำหรับครอบครัว</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="foodtruck" class="css-checkbox" rel="foodtruck" />
                <label for="foodtruck" class="css-label">ร้าน Food Truck</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="dessert" class="css-checkbox" rel="dessert" />
                <label for=“dessert" class="css-label”>ร้านของหวาน</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="beverage" class="css-checkbox" rel="beverage" />
                <label for=“beverage" class="css-label”>ร้านเครื่องดื่ม</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="riverside" class="css-checkbox" rel="riverside" />
                <label for=“riverside" class="css-label”>ร้านริมน้ำ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="tapanyaki" class="css-checkbox" rel="tapanyaki" />
                <label for=“tapanyaki" class="css-label”>ร้านเทปันยากิ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="izakaya" class="css-checkbox" rel="izakaya" />
                <label for="izakaya" class="css-label">ร้านอิซากายะ</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="icecream" class="css-checkbox" rel="icecream" />
                <label for="icecream" class="css-label">ร้านไอศกรีม</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="foodcourt" class="css-checkbox" rel="foodcourt" />
                <label for="foodcourt" class="css-label">ร้านในฟู้ดคอร์ท</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="noodle" class="css-checkbox" rel="noodle" />
                <label for="noodle" class="css-label">ร้านก๋วยเตี๋ยว</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="standalone" class="css-checkbox" rel="standalone" />
                <label for="standalone" class="css-label">ร้าน stand alone</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="garden" class="css-checkbox" rel="garden" />
                <label for="garden" class="css-label">ร้านสวนอาหาร</label></li>
                
                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="buildingBistro" class="css-checkbox" rel="buildingBistro" />
                <label for="buildingBistro" class="css-label">ร้านในอาคารพาณิชย์</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="drivethru" class="css-checkbox" rel="drivethru" />
                <label for="drivethru" class="css-label">ร้าน Drive Thru</label></li>

                <li class="checkbox_search"><input type="checkbox" name="bistrotype" id="market" class="css-checkbox" rel="market" />
                <label for="market" class="css-label">ร้านในตลาดนัด</label></li>
                
				
               
                </div>
			</ul>
		</li>
        <div class="cleaner_h3"></div>
		<li class="item2"><a href="#">บริการพิเศษ<span></span></a>
			<ul style="margin-bottom:10px;">
            <div class="tags">
            	<li class="checkbox_search"><input type="checkbox" name="service" id="checkbox55" class="css-checkbox" rel="have_internet" />
                <label for="checkbox55" class="css-label">อินเตอร์เนต</label></li>
                <li class="checkbox_search"><input type="checkbox" name="service" id="checkbox56" class="css-checkbox" rel="have_parking" />
                <label for="checkbox56" class="css-label">ที่จอดรถ</label></li>
                <li class="checkbox_search"><input type="checkbox" name="service" id="checkbox57" class="css-checkbox" rel="have_credit" />
                <label for="checkbox57" class="css-label">รับบัตรเครดิต</label></li>
                <li class="checkbox_search"><input type="checkbox" name="service" id="checkbox58" class="css-checkbox" rel="have_alcohol" />
                <label for="checkbox58" class="css-label">เครื่องดื่มแอลกฮอลล์</label></li>
            </div>
			</ul>
		</li>
        <div class="cleaner_h3"></div>
        <li class="item4"><a href="#">ราคาอาหาร<span></span></a>
			<ul style="margin-bottom:10px;">
             <div class="tags">
             	<li class="checkbox_search"><input type="checkbox" name="price" id="checkbox59" class="css-checkbox" rel="rate1" />
                <label for="checkbox59" class="css-label">< น้อยกว่า100 บาท</label></li>
                <li class="checkbox_search"><input type="checkbox" name="price" id="checkbox60" class="css-checkbox" rel="rate2" />
                <label for="checkbox60" class="css-label">101 > 300 บาท</label></li>
                <li class="checkbox_search"><input type="checkbox" name="price" id="checkbox61" class="css-checkbox" rel="rate3" />
                <label for="checkbox61" class="css-label">301 > 500 บาท</label></li>
                <li class="checkbox_search"><input type="checkbox" name="price" id="checkbox62" class="css-checkbox" rel="rate4" />
                <label for="checkbox62" class="css-label">501 > 1000 บาท</label></li>
                <li class="checkbox_search"><input type="checkbox" name="price" id="checkbox63" class="css-checkbox" rel="rate5" />
                <label for="checkbox63" class="css-label">มากกว่า 1000 บาท</label></li>
                </div>
			</ul>
		</li>
        
	</ul>
	</side>
   </div>
        <box_search style="margin-top:20px;">
			<div class="content-box" style="margin-top:40px;">
                    <div class="cleaner_h10"></div>
                   	<ul class="grid effect-3" id="grid">
					
                    <?php
						if ( have_posts() ) :
							query_posts(array( 
								'post_type' => 'restaurants'
							) );  
							while ( have_posts() ) : the_post();
					?>
                        <li class="box_red_one" style="margin-right:3px;float:left">
                       	<a href="<?php echo get_permalink(); ?>" style="cursor:pointer;z-index:3">
                        <div class="box_title" style="cursor:pointer;z-index:3">
                            <span class="box_red_one_text"><?php echo substr_utf8( get_the_title(), 0 , 28); ?><?php if(get_field('bistro_branch' )){echo "สาขา".get_field('bistro_branch');} ?></span>
                            <?php $sqlRating = "SELECT v3.meta_value AS rating
															FROM wp_postmeta v1
															INNER JOIN wp_posts v2
															ON v1.post_id =v2.ID
															LEFT  JOIN wp_postmeta v3
															ON v1.post_id=v3.post_id AND v3.meta_key='review_rating'
															WHERE v1.meta_value='".get_the_id()."'  
															AND v1.meta_key='review_bistroid' AND v2.post_status='publish'";
															//echo $sqlRating;
												$resultRating = $wpdb->get_results($sqlRating);
												$Img_num_rows = $wpdb->num_rows;
												$point=0;
												foreach ($resultRating as $keyRating){
													$point += $keyRating->rating;
												} 
												if($Img_num_rows!=0){
													$percentRating = $point*(100/(5*$Img_num_rows));
												}else{
													$percentRating = 0;
												}
												?>
												
													<div class="stars" >
														<div class="rate" style="width:<?php echo $percentRating;?>%"></div>
														<input type="radio" name="rating2" id="star5" value="5">
														<input type="radio" name="rating2" id="star4" value="4">
														<input type="radio" name="rating2" id="star3" value="3">
														<input type="radio" name="rating2" id="star2" value="2">
														<input type="radio" name="rating2" id="star1" value="1">
													</div>    
								</div>
                                </a>
                              <div style="width:291px; height:180px; overflow:hidden;margin-left:-8px">
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), array(300,180) ); ?>
                                <?php if($image!=""){echo imagesize($image[0],290,185);}
									  else{?><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/290x180.jpg"><?php }		
								?>
                                
                              </div>
							  <div class="icon_red_search_content" style="width:90%">
                                    <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/gps_icon_search.png" style="float:left;">

                                   <div class="detail-data" style='font-size:13px;width: 90%;margin-left: 5px;text-indent:0px;line-height: 20px;height: 20px !important;overflow:hidden'>
                                    <?php  the_field('bistro_soi'); ?> 
									<?php  the_field('bistro_street');?>
                                    
                                    </div>               
                                    <div class="cleaner_h5"></div>
                                    <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/typefood_icon_search.png" style="float:left;">
                                   <div class="detail-data" style='font-size:13px;width: 90%;margin-left: 5px;text-indent:0px;    line-height: 20px;'>
								   <?php // the_field('bistroFoodType');?> 
                                   <?php
									 //echo get_the_id();
									 $values = get_post_meta( get_the_ID(), 'recipe_type', true );
									 if($values!=""){
									?>
										<?php echo convertFoodType($values);?>
								   <?php }?> 
                                   
                                   
                                   
                                   </div>
                                   
                                </div>
                                
								<div class="cleaner"></div>
                                <div class="bg_readmore_search">
                                    <span class="text_readmore">
                                    <a href="<?php echo get_permalink(); ?>">อ่านต่อ
                                   <img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/readmore_search_icon.png" class="bt_readmore" /></a>
                                  </span>
                            	</div>
                                
                     </li>
					<?php
							endwhile;
						else :
							echo wpautop( 'Sorry, no posts were found' );
						endif;
                    ?>   
							
					</ul>
				<div class="cleaner_h30"></div>
                
                </div>
			<div class="cleaner_h30"></div>
			<a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/_inc/images/bg_footer_search.png" /></a>
                
		</box_search>
      <?php } ?>
	</div><!-- .padder -->
</div><!-- #content -->
<div class="cleaner_h30"></div>
<?php get_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/jqClock.min.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/masonry.pkgd.min.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/imagesloaded.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/classie.js"></script>
		<script src="<?php bloginfo('stylesheet_directory'); ?>/_inc/js/AnimOnScroll.js"></script>
		<script>
			new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			} );
		</script>
<script>
$(document).ready(function () {
    
    
    $('div.tags').find('input:checkbox').live('click', function () {  
        var chk = [];
        if($('.tags input[type="checkbox"]:checked').size()!=0){
            $('.tags input[type="checkbox"]:checked').each(function(index){
                chk[index] = $(this).attr('rel');
            });
            $('.results li').hide();
            for(e=0;e<chk.length;e++){ 
                $('.results li.'+chk[e]).show();
            }
            
        }else{
            $('.results li').show();
        }
    });
});
</script>

<script type="text/javascript">
	$(function() {
	    var menu_ul = $('.menu > li > ul'),
	           menu_a  = $('.menu > li > a');
	    menu_ul.hide();
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>