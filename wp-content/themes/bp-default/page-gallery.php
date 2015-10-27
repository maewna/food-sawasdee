<?php

/**
 * Template Name: Gallery Page
 */

get_header(); ?>

	<?php the_post(); ?>
	<!-- Usually in the <head> section -->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/inc/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_url'); ?>/inc/nivo-slider/jquery.nivo.slider.pack.js" type="text/javascript"></script>
	<script type="text/javascript">
	(function($){
		$(window).load(function() {
		    $('#slider').nivoSlider();
		});
	})(jQuery);
	</script>

	<!-- Slider -->
	<?php if(get_field('images')): ?>
	<div id="slider">
		<?php while(the_repeater_field('images')): ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
			<?php $thumb = wp_get_attachment_image_src(get_sub_field('image'), 'thumbnail'); ?>
	    	<img src="<?php echo $image[0]; ?>" alt="<?php  the_sub_field('title');?>" rel="<?php echo $thumb[0]; ?>" />
	    <?php endwhile; ?>
	</div>
	<?php endif; ?>

<?php get_footer(); ?>