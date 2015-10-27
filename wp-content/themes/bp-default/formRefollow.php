<?php include_once("../../../wp-config.php"); ?>

<?php $lid = $_REQUEST['l']; ?>
<?php $fid = $_REQUEST['f']; ?>
<?php $type = $_REQUEST['t']; ?>
<?php $sort = $_REQUEST['s']; ?>

<?php $wpdb->get_results( 'INSERT INTO wp_bp_follow(leader_id,follower_id) VALUES ("'.$lid.'","'.$fid.'")' ); ?>
