<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal,
    <?php echo $asp_res_ids2; ?>.horizontal,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal {
    <?php wpdreams_gradient_css($style['hboxbg']); ?>;
    <?php echo $style['hboxborder']; ?>
    <?php echo wpdreams_box_shadow_css($style['hboxshadow']); ?>
    margin-top: <?php echo $style['resultsmargintop']; ?>;
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal .results .item,
    <?php echo $asp_res_ids2; ?>.horizontal .results .item,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal .results .item {
    height: <?php echo $style['hresheight']; ?>;
    width: <?php echo $style['hreswidth']; ?>;
    margin: 10px <?php echo $style['hressidemargin']; ?>;
    padding: <?php echo $style['hrespadding']; ?>;
    float: left;
    <?php wpdreams_gradient_css($style['hresultbg']); ?>;
    <?php echo $style['hresultborder']; ?>
    <?php wpdreams_box_shadow_css($style['hresultshadow']); ?>
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal .results .item:hover,
    <?php echo $asp_res_ids2; ?>.horizontal .results .item:hover,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal .results .item:hover {
    <?php wpdreams_gradient_css($style['hresulthbg']); ?>;
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal .results .item .image,
    <?php echo $asp_res_ids2; ?>.horizontal .results .item .image,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal .results .item .image {
    margin: 0 auto;
    <?php wpdreams_gradient_css($style['hresultbg']); ?>;
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal .results .item .image,
    <?php echo $asp_res_ids2; ?>.horizontal .results .item .image,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal .results .item .image {
    width: <?php echo $_vimagew ?>px;
    height: <?php echo $_vimageh; ?>px;
    <?php echo $style['hresultimageborder']; ?>
    float: none;
    margin: 0 auto 6px;
    position: relative;
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal .results .item .image img + div,
    <?php echo $asp_res_ids2; ?>.horizontal .results .item .image img + div,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal .results .item .image img + div {
    <?php echo $style['hresultimageshadow']; ?>
    position: absolute;
    width: <?php echo $_vimagew ?>px;
    height: <?php echo $_vimageh; ?>px;
    top: 0;
    left: 0;
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?>.horizontal .results .item .content h3 a,
    <?php echo $asp_res_ids2; ?>.horizontal .results .item .content h3 a,
<?php endif; ?>
<?php echo $asp_res_ids; ?>.horizontal .results .item .content h3 a {
    text-align: center;
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?> .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
    <?php echo $asp_res_ids2; ?> .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
<?php endif; ?>
<?php echo $asp_res_ids; ?> .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
    background:#fff; /* rgba fallback */
    background:rgba(<?php echo wpdreams_hex2rgb($style['overflowcolor']); ?>,0.9);
    filter:"alpha(opacity=90)"; -ms-filter:"alpha(opacity=90)"; /* old ie */
}

<?php if ($use_compatibility == true): ?>
    <?php echo $asp_res_ids1; ?> .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,
    <?php echo $asp_res_ids2; ?> .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar,
<?php endif; ?>
<?php echo $asp_res_ids; ?> .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar {
    background:rgba(<?php echo wpdreams_hex2rgb($style['overflowcolor']); ?>,0.95);
    filter:"alpha(opacity=95)"; -ms-filter:"alpha(opacity=95)"; /* old ie */
}

<?php echo $asp_res_ids; ?> .mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,
<?php echo $asp_res_ids; ?> .mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar{
    background:rgba(<?php echo wpdreams_hex2rgb($style['overflowcolor']); ?>,1);
    filter:"alpha(opacity=100)"; -ms-filter:"alpha(opacity=100)"; /* old ie */
}

<?php echo $asp_res_ids; ?>.horizontal .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar{
    background:#fff; /* rgba fallback */
    background:<?php echo $style['hoverflowcolor']; ?>;
    opacity: 0.9;
    filter:"alpha(opacity=90)"; -ms-filter:"alpha(opacity=90)"; /* old ie */
}
<?php echo $asp_res_ids; ?>.horizontal .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar{
    background:<?php echo $style['hoverflowcolor']; ?>;
    opacilty: 0.95;
    filter:"alpha(opacity=95)"; -ms-filter:"alpha(opacity=95)"; /* old ie */
}

<?php echo $asp_res_ids; ?>.horizontal .mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar,
<?php echo $asp_res_ids; ?>.horizontal .mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar{
    background: <?php echo $style['hoverflowcolor']; ?>;
    filter:"alpha(opacity=100)"; -ms-filter:"alpha(opacity=100)"; /* old ie */
}

<?php echo $asp_res_ids; ?> .mCSB_scrollTools .mCSB_buttonDown:after { border-color: rgba(136, 183, 213, 0); border-top-color: <?php echo $style['arrowcolor']; ?>; border-width: 6px; left: 50%; margin-left: -6px; }
<?php echo $asp_res_ids; ?> .mCSB_scrollTools .mCSB_buttonUp:after { border-color: rgba(136, 183, 213, 0); border-bottom-color:  <?php echo $style['arrowcolor']; ?>; border-width: 6px; left: 50%; margin-left: -6px; }

<?php echo $asp_res_ids; ?>.horizontal .results .mCSB_scrollTools .mCSB_buttonLeft:after { border-color: rgba(136, 183, 213, 0); border-right-color: <?php echo $style['harrowcolor']; ?>; border-width: 7px; top: 50%; margin-top:  -7px; left: 5px; }
<?php echo $asp_res_ids; ?>.horizontal .results .mCSB_scrollTools .mCSB_buttonRight:after { border-color: rgba(136, 183, 213, 0); border-left-color: <?php echo $style['harrowcolor']; ?>; border-width: 7px; top: 50%; margin-top:  -7px; left: 5px; }
