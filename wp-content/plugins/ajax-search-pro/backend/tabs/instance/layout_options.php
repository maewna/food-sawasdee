<ul id="subtabs"  class='tabs'>
    <li><a tabid="401" class='subtheme current'>Results layout</a></li>
    <li><a tabid="402" class='subtheme'>Results Behaviour</a></li>
    <li><a tabid="403" class='subtheme'>Compact box layout</a></li>
</ul>
<div class='tabscontent'>
    <div tabid="401">
        <fieldset>
            <legend>Results layout</legend>
            <?php include(ASP_PATH."backend/tabs/instance/layout/results_layout.php"); ?>
        </fieldset>
    </div>
    <div tabid="402">
        <fieldset>
            <legend>Results Behaviour</legend>
            <?php include(ASP_PATH."backend/tabs/instance/layout/results_behaviour.php"); ?>
        </fieldset>
    </div>
    <div tabid="403">
        <fieldset>
            <legend>Compact Box layout</legend>
            <?php include(ASP_PATH."backend/tabs/instance/layout/box_layout.php"); ?>
        </fieldset>
    </div>
</div>
<div class="item">
    <input name="submit_<?php echo $search['id']; ?>" type="submit" value="Save all tabs!" />
</div>