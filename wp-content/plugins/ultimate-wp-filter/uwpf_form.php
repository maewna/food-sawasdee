<?php

	function uwpf_add_page() {
		add_options_page('Ultimate WP Filter Configs', 'Ultimate WP Filter', 'manage_options', 'uwpf_panel.php', 'uwpf_BuildPage');
	}

	function uwpf_SetDefaults() {
		$tmp = get_option('uwpf_options');
		if((!is_array($tmp))) {
			delete_option('uwpf_options');
			$arr = array(	"rdo_group_filtering" => "on",
							"custom_keywords" => "",
							"chk_smartfilter" => 1,
							"level" => "65",
							"fxfilter_api" => "",
							"chk_bbpress" => 1,
							"chk_comment_author" => 1,
							"chk_comment_text" => 1,
							"chk_post_title" => 1,
							"chk_post_content" => 1,
							"chk_tag_cloud" => 1
			);
			update_option('uwpf_options', $arr);
		}
	}

	function uwpf_BuildPage() {
	?>

		<div class="wrap">

		<div style="padding:5px 10px;color:#fff;font-weight:bold; border: 0px; background: #676767; padding:8px 20px;font-size:18pt;">
			<center>
				Ultimate WP Filter
			</center>
		</div>

			<form method="post" action="options.php">
				<?php settings_fields('uwpf_plugin_options'); ?>
				<?php $options = get_option('uwpf_options'); ?>

				<table class="form-table">

					<tr valign="top">
						<th scope="row">Filtering<br/>
						<span class="description">
							Activate/deactivate content filtering.
						</span></th>
						<td>
							<label><input name="uwpf_options[rdo_group_filtering]" type="radio" value="on" <?php checked('on', $options['rdo_group_filtering']); ?> /> On</label><br />

							<label><input name="uwpf_options[rdo_group_filtering]" type="radio" value="off" <?php checked('off', $options['rdo_group_filtering']); ?> /> Off</label><br />
						</td>
					</tr>
					<tr>
						<th scope="row">API Key [REQUIRED]<br/>
						<span class="description">FXFilter API Key</span>
						</th>
						<td>
							<textarea name="uwpf_options[filter_api]" rows="1" cols="70" type='textarea'><?php echo $options['filter_api']; ?></textarea><br />
							<span class="description">FX Profanity Filter API Key. Register one at <a href="http://filter.faleddo.com/registration" target="_blank">http://filter.faleddo.com/registration</a>, then paste the given API key here.</span>
						</td>
					</tr>
					<tr>
						<th scope="row">Custom Keywords<br/>
						<span class="description">Include custom keywords to be filtered. Separate them with a comma (,).</span>
						</th>
						<td>
							<textarea name="uwpf_options[custom_keywords]" rows="7" cols="70" type='textarea'><?php echo $options['custom_keywords']; ?></textarea><br />
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Smart Filter<br/>
						<span class="description">Detect cheated badwords even they were not listed yet in database.</span></th>
						<td>
							<label><input name="uwpf_options[chk_smartfilter]" type="checkbox" value="1" <?php if (isset($options['chk_smartfilter'])) { checked('1', $options['chk_smartfilter']); } ?> /> Enable Smart Filter </label><br />
							<span class="description">Smart Filter enabled -> normal performance, better filtering</br></span>
							<span class="description">Smart Filter disabled -> better performance, basic filtering</span>
						</td>
					</tr>
					
					<tr>
						<th scope="row">Smart Filter Level<br/>
						<span class="description">Adjust smart filter sensitivity. (0-100)</span>
						</th>
						<td>
							<textarea name="uwpf_options[level]" rows="1" cols="5" type='textarea'><?php echo $options['level']; ?></textarea><br />
							<span class="description">It's recommended to set sensitivity between 50 and 75. Default is 65.</span>
						</td>
					</tr>
					
					<tr valign="top">
						<th scope="row">Filtering Target</th>
						<td>
							<label><input name="uwpf_options[chk_bbpress]" type="checkbox" value="1" <?php if (isset($options['chk_bbpress'])) { checked('1', $options['chk_bbpress']); } ?> /> bbPress </label><br />

							<label><input name="uwpf_options[chk_comment_author]" type="checkbox" value="1" <?php if (isset($options['chk_comment_author'])) { checked('1', $options['chk_comment_author']); } ?> /> Comment Author </label><br />
							<label><input name="uwpf_options[chk_comment_text]" type="checkbox" value="1" <?php if (isset($options['chk_comment_text'])) { checked('1', $options['chk_comment_text']); } ?> /> Comment Text </label><br />
							
							<label><input name="uwpf_options[chk_post_title]" type="checkbox" value="1" <?php if (isset($options['chk_post_title'])) { checked('1', $options['chk_post_title']); } ?> /> Post Title</label><br />
							<label><input name="uwpf_options[chk_post_content]" type="checkbox" value="1" <?php if (isset($options['chk_post_content'])) { checked('1', $options['chk_post_content']); } ?> /> Post Content</label><br />

							<label><input name="uwpf_options[chk_tag_cloud]" type="checkbox" value="1" <?php if (isset($options['chk_tag_cloud'])) { checked('1', $options['chk_tag_cloud']); } ?> /> Tag Clouds </label><br />	

						</td>
					</tr>					
					
				</table>
				<p class="submit">
					<input type="submit" class="button-secondary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
						
			<hr color="#676767" size="3"></hr>
			
			<center>
				<a class=button-secondary href="http://filter.faleddo.com/donate.php" title="Donate" target="_blank">Donate</a> | 
				<a class=button-secondary href="http://twitter.com/faleddo" title="Follow @Faleddo on Twitter" target="_blank">Follow @Faleddo on Twitter</a> | 
				<a class=button-secondary href="http://blog.faleddo.com" title="Visit web" target="_blank">Visit web</a> | 
				<a class=button-secondary href="http://filter.faleddo.com" title="FXFilter" target="_blank">FX Profanity Filter</a>
			</center>
		</div>
		<?php	
	}
	
	function uwpf_validate($input) {
		$input['custom_keywords'] =  wp_filter_nohtml_kses($input['custom_keywords']);
		return $input;
	}
	
	?>