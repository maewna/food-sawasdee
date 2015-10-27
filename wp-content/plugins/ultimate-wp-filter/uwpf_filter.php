<?php

	function uwpf_clean() {

		if( is_admin() ) return;

		$tmp = get_option('uwpf_options');

		if (isset($tmp['rdo_group_filtering'])) {
			if($tmp['rdo_group_filtering']=='off'){ return; }}

		if (isset($tmp['chk_comment_author'])) {
			if($tmp['chk_comment_author']=='1'){ add_filter('get_comment_author', 'uwpf_CleanWords'); }}		

		if (isset($tmp['chk_comment_text'])) {
			if($tmp['chk_comment_text']=='1'){ add_filter('comment_text', 'uwpf_CleanWords'); }}

		if (isset($tmp['chk_post_content'])) {
			if($tmp['chk_post_content']=='1'){ add_filter('the_content', 'uwpf_CleanWords'); }}		
		
		if (isset($tmp['chk_post_title'])) {
			if($tmp['chk_post_title']=='1'){ add_filter('the_title', 'uwpf_CleanWords'); }}

		if (isset($tmp['chk_tag_cloud'])) {
			if($tmp['chk_tag_cloud']=='1'){ add_filter('wp_tag_cloud', 'uwpf_CleanWords'); }}

		if (isset($tmp['chk_bbpress'])) {
			if($tmp['chk_bbpress']=='1'){
				if (class_exists('bbPress')) {
					add_filter('bbp_get_topic_content', 'uwpf_CleanWords');
					add_filter('bbp_get_reply_content', 'uwpf_CleanWords');
				}
			}
		}
	}

	function uwpf_CleanWords($teks) {

		$tmp = get_option('uwpf_options');
		$custom = $tmp['custom_keywords'];
		$level = $tmp['level'];
		$api_key = $tmp['filter_api'];

			
		if($tmp['chk_smartfilter']=='1'){
			$smartfilter = "on";
		}else{
			$smartfilter = "off";
		}
		
		$service_url = 'http://filter.faleddo.com/api/';
		//$service_url = 'http://127.0.0.1:8000/api/';
		$curl = curl_init($service_url);
		$curl_post_data = array(
				'text' => $teks,
				'i' => $smartfilter,
				'level' => $level,
				'custom' => $custom,
				'api_key' => $api_key
		);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		$response = json_decode($curl_response);
		if($response->error == "403" OR $curl_response === false){
			return $teks;
		}else{
			return $response->text;
		}
	}

?>