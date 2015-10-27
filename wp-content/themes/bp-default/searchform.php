<?php get_header(); ?>


<?php do_action( 'bp_before_blog_search_form' ); ?>

<form role="search" method="get" id="searchform" action="<?php echo home_url(); ?>" autocomplete="off">
<div>
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s inputString" placeholder="ค้นหาเมนูโปรด" onkeyup="lookup(this.value);"/>
	
   </div>
<input type="submit" id="searchsubmit" class="iconsearch" value=""  style="position: absolute;
    float: right;
    z-index: 1;
    margin-top: -51px;
    right: 121px;
    height: 52px;
    border: none;
    width: 52px;"/>
 <div id="suggestions"></div>
	<?php do_action( 'bp_blog_search_form' ); ?>
   
</form>

<?php do_action( 'bp_after_blog_search_form' ); ?>
