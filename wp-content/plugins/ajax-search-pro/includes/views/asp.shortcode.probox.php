<style>
#name_2::-webkit-input-placeholder
{
  line-height:25px;
}

#name_2:-moz-placeholder
{
 line-height:25px;
}

#name_2::-moz-placeholder
{
  line-height:25px;
}

#name_2:-ms-input-placeholder
{
 line-height:25px;
}

</style>
<?php
/* Prevent direct access */
defined('ABSPATH') or die("You can't access this file directly.");
?>

<div class="probox">
    <?php do_action('asp_layout_before_magnifier', $id); ?>

    <div class='promagnifier'>
        <?php do_action('asp_layout_in_magnifier', $id); ?>
        <div class='innericon'>
            <?php
            if (w_isset_def($style['magnifierimage_custom'], "") == "" &&
                pathinfo($style['magnifierimage'], PATHINFO_EXTENSION) == 'svg'
            ) {
                echo file_get_contents(WP_PLUGIN_DIR . '/' . $style['magnifierimage']);
            }
            ?>
        </div>
    </div>

    <?php do_action('asp_layout_after_magnifier', $id); ?>

    <?php do_action('asp_layout_before_settings', $id); ?>

    <div class='prosettings' <?php echo($settingsHidden ? "style='display:none;'" : ""); ?> data-opened=0>
        <?php do_action('asp_layout_in_settings', $id); ?>
        <div class='innericon'>
            <?php
            if (w_isset_def($style['settingsimage_custom'], "") == "" &&
                pathinfo($style['settingsimage'], PATHINFO_EXTENSION) == 'svg'
            ) {
                echo file_get_contents(WP_PLUGIN_DIR . '/' . $style['settingsimage']);
            }
            ?>
        </div>
    </div>

    <?php do_action('asp_layout_after_settings', $id); ?>

    <?php do_action('asp_layout_before_input', $id); ?>

    <div class='proinput'>
        <form action='#' autocomplete="off">
            <input type='search' class='orig' placeholder='<?php echo w_isset_def($style['defaultsearchtext'], ''); ?>' name='phrase' id="name_2" value='<?php echo isset($_GET['s'])?$_GET['s']:''; ?>' autocomplete="off"/>
            <input type='text' class='autocomplete' name='phrase' value='' autocomplete="off"/>
            <input type='submit' style='width:0; height: 0; visibility: hidden;'>
        </form>
    </div>

    <?php do_action('asp_layout_after_input', $id); ?>

    <?php do_action('asp_layout_before_loading', $id); ?>

    <div class='proloading'>
        <?php
        if (w_isset_def($style['loadingimage_custom'], "") == "" &&
            pathinfo($style['loadingimage'], PATHINFO_EXTENSION) == 'svg'
        ) {
            echo file_get_contents(WP_PLUGIN_DIR . '/' . $style['loadingimage']);
        }
        ?>
        <?php do_action('asp_layout_in_loading', $id); ?>
    </div>

    <?php if ($style['show_close_icon']): ?>
        <div class='proclose'>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                 y="0px"
                 width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512"
                 xml:space="preserve">
            <polygon id="x-mark-icon"
                     points="438.393,374.595 319.757,255.977 438.378,137.348 374.595,73.607 255.995,192.225 137.375,73.622 73.607,137.352 192.246,255.983 73.622,374.625 137.352,438.393 256.002,319.734 374.652,438.378 "/>
            </svg>
        </div>
    <?php endif; ?>

    <?php do_action('asp_layout_after_loading', $id); ?>

</div>