<?php include_once("../../../wp-config.php"); ?>

<?php $lid = $_REQUEST['l']; ?>
<?php $fid = $_REQUEST['f']; ?>
<?php $type = $_REQUEST['t']; ?>
<?php $sort = $_REQUEST['s']; ?>

<?php $wpdb->get_results( 'DELETE FROM wp_bp_follow WHERE follower_id='.$fid.' AND leader_id='.$lid ); ?>


