<?php
/**
 * Copyright (c) 2015 Khang Minh <contact@betterwp.net>
 * @license http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE VERSION 3.0 OR LATER
 */

class BWP_FRAMEWORK_V2
{
	/**
	 * Database related data
	 */
	public $options = array();

	/**
	 * Default data
	 */
	public $options_default = array();

	/**
	 * Global options
	 */
	public $site_options = array();

	/**
	 * Hold db option keys
	 */
	public $option_keys = array();

	/**
	 * Hold extra option keys
	 */
	public $extra_option_keys = array();

	/**
	 * Hold option pages
	 */
	public $option_pages = array();

	/**
	 * The current option page instance
	 *
	 * @var BWP_OPTION_PAGE_V2
	 */
	public $curren_option_page;

	/**
	 * Key to identify plugin
	 */
	public $plugin_key;

	/**
	 * Constant Key to identify plugin
	 */
	public $plugin_ckey;

	/**
	 * Domain Key to identify plugin
	 */
	public $plugin_dkey;

	/**
	 * Title of the plugin
	 */
	public $plugin_title;

	/**
	 * Homepage of the plugin
	 */
	public $plugin_url;

	/**
	 * Urls to various parts of homepage or other places
	 *
	 * Expect to have a format of array('relative' => bool, 'url' => url)
	 */
	public $urls = array();

	/**
	 * Plugin file
	 */
	public $plugin_file;

	/**
	 * Plugin folder
	 */
	public $plugin_folder;

	/**
	 * Plugin WP url
	 */
	public $plugin_wp_url;

	/**
	 * Version of the plugin
	 */
	public $plugin_ver = '';

	/**
	 * Message shown to user (Warning, Notes, etc.)
	 */
	public $notices = array();
	public $notice_shown = false;

	/**
	 * Error shown to user
	 */
	public $errors = array();
	public $error_shown = false;

	/**
	 * Capabilities to manage this plugin
	 */
	public $plugin_cap = 'manage_options';

	/**
	 * Whether or not to create filter for media paths
	 */
	public $need_media_filters;

	/**
	 * Form tabs to build
	 */
	public $form_tabs = array();

	/**
	 * Version constraints
	 */
	public $wp_ver;
	public $php_ver;

	/**
	 * Number of framework revisions
	 */
	public $revision = 143;

	/**
	 * Text domain
	 */
	public $domain = '';

	/**
	 * Other special variables
	 */
	protected $_menu_under_settings = false;
	protected $_simple_menu = false;

	/**
	 * Construct a new plugin with appropriate meta
	 *
	 * @param array $meta
	 * @since rev 142
	 */
	public function __construct(array $meta)
	{
		$required = array(
			'title', 'version', 'domain'
		);

		foreach ($required as $required_meta)
		{
			if (!array_key_exists($required_meta, $meta))
			{
				throw new \InvalidArgumentException(sprintf('Missing required meta (%s) to construct plugin', $required_meta));
			}
		}

		$this->plugin_title = $meta['title'];

		require_once __DIR__ . '/class-bwp-version.php';

		$this->set_version(isset($meta['php_version']) ? $meta['php_version'] : BWP_VERSION::$php_ver, 'php');
		$this->set_version(isset($meta['wp_version']) ? $meta['wp_version'] : BWP_VERSION::$wp_ver, 'wp');
		$this->set_version($meta['version']);

		$this->domain = $meta['domain'];
	}

	/**
	 * Build base properties
	 */
	protected function build_properties($key, $dkey, $options, $plugin_title = '',
		$plugin_file = '', $plugin_url = '', $need_media_filters = true)
	{
		$this->plugin_key   = strtolower($key);
		$this->plugin_ckey  = strtoupper($key);
		$this->plugin_dkey  = $dkey;
		$this->plugin_title = $plugin_title;
		$this->plugin_url   = $plugin_url;

		$this->options_default = $options;
		$this->need_media_filters = (boolean) $need_media_filters;

		$this->plugin_file = $plugin_file;
		$this->plugin_folder = basename(dirname($plugin_file));

		$this->pre_init_actions();
		$this->init_actions();

		// Load locale
		load_plugin_textdomain($dkey, false, $this->plugin_folder . '/languages');
	}

	protected function add_option_key($key, $option, $title)
	{
		$this->option_keys[$key] = $option;
		$this->option_pages[$key] = $title;
	}

	protected function add_extra_option_key($key, $option, $title)
	{
		$this->extra_option_keys[$key] = $option;
		$this->option_pages[$key] = $title;
	}

	public function add_icon()
	{
		return '<div class="icon32" id="icon-bwp-plugin" '
			. 'style=\'background-image: url("'
			. constant($this->plugin_ckey . '_IMAGES')
			. '/icon_menu_32.png");\'><br></div>'  . "\n";
	}

	protected function set_version($ver = '', $type = '')
	{
		switch ($type)
		{
			case '': $this->plugin_ver = $ver;
			break;
			case 'php': $this->php_ver = $ver;
			break;
			case 'wp': $this->wp_ver = $ver;
			break;
		}
	}

	protected function get_version($type = '')
	{
		switch ($type)
		{
			case '': return $this->plugin_ver;
			break;
			case 'php': return $this->php_ver;
			break;
			case 'wp': return $this->wp_ver;
			break;
		}
	}

	protected function get_current_wp_version()
	{
		return get_bloginfo('version');
	}

	protected function check_required_versions()
	{
		if (version_compare(PHP_VERSION, $this->php_ver, '<')
			|| version_compare(get_bloginfo('version'), $this->wp_ver, '<')
		) {
			add_action('admin_notices', array($this, 'warn_required_versions'));
			add_action('network_admin_notices', array($this, 'warn_required_versions'));
			return false;
		}
		else
			return true;
	}

	public function warn_required_versions()
	{
		BWP_VERSION::warn_required_versions($this->plugin_title, $this->plugin_dkey, $this->php_ver, $this->wp_ver);
	}

	public function show_donation()
	{
		$info_showable     = apply_filters('bwp_info_showable', true);
		$donation_showable = apply_filters('bwp_donation_showable', true);
		$ad_showable       = apply_filters('bwp_ad_showable', true);

		if (true == $info_showable || (self::is_multisite() && is_super_admin()))
		{
?>
<div id="bwp-info-place">
<div id="bwp-donation" style="margin-bottom: 0px;">
<a href="<?php echo $this->plugin_url; ?>"><?php echo $this->plugin_title; ?></a> <small>v<?php echo $this->plugin_ver; ?></small><br />
<small>
	<a href="<?php echo str_replace('/wordpress-plugins/', '/topic/', $this->plugin_url); ?>"><?php _e('Development Log', $this->plugin_dkey); ?></a> &ndash; <a href="<?php echo $this->plugin_url . 'faq/'; ?>" title="<?php _e('Frequently Asked Questions', $this->plugin_dkey) ?>"><?php _e('FAQ', $this->plugin_dkey); ?></a> &ndash; <a href="http://betterwp.net/contact/" title="<?php _e('Got a problem? Send me a feedback!', $this->plugin_dkey) ?>"><?php _e('Contact', $this->plugin_dkey); ?></a>
</small>
<br />
<?php
		if (true == $donation_showable || (self::is_multisite() && is_super_admin()))
		{
?>
<small><?php _e('You can buy me some special coffees if you appreciate my work, thank you!', $this->plugin_dkey); ?></small>
<form class="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<p>
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="NWBB8JUDW5VSY">
<input type="hidden" name="lc" value="VN">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="cn" value="Would you like to say anything to me?">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="http://betterwp.net">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-BuyNowBF:icon-paypal.gif:NonHosted">
<input type="hidden" name="item_name" value="<?php printf(__('Donate to %s', $this->plugin_dkey), $this->plugin_title); ?>" />
<select name="amount">
	<option value="5.00"><?php _e('One cup $5.00', $this->plugin_dkey); ?></option>
	<option value="10.00"><?php _e('Two cups $10.00', $this->plugin_dkey); ?></option>
	<option value="25.00"><?php _e('Five cups! $25.00', $this->plugin_dkey); ?></option>
	<option value="50.00"><?php _e('One LL-cup!!! $50.00', $this->plugin_dkey); ?></option>
	<option value="100.00"><?php _e('... or any amount!', $this->plugin_dkey); ?></option>
</select>
<span class="paypal-alternate-input" style="display: none;"><!-- --></span>
<input class="paypal-submit" type="image" src="<?php echo $this->plugin_wp_url . 'vendor/kminh/bwp-framework/images/icon-paypal.gif'; ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</p>
</form>
<?php
		}
?>
</div>
<div class="bwp-separator">
	<div style="height: 10px; width: 5px; background-color: #cccccc; margin: 0 auto;"><!-- --></div>
</div>
<div id="bwp-contact">
	<a class="bwp-rss" href="http://feeds.feedburner.com/BetterWPnet"><?php _e('Latest updates from BetterWP.net!', $this->plugin_dkey); ?></a>
	<a class="bwp-twitter" href="http://twitter.com/0dd0ne0ut"><?php _e('Follow me on Twitter!', $this->plugin_dkey); ?></a>
</div>
<?php
		if (true == $ad_showable)
		{
?>
<div class="bwp-separator">
	<div style="height: 10px; width: 5px; background-color: #cccccc; margin: 0 auto;"><!-- --></div>
</div>
<div id="bwp-ads">
	<p><strong><?php _e('This Plugin is Proudly Sponsored By', $this->plugin_dkey); ?></strong></p>
	<div style="width: 250px; margin: 0 auto;">
		<a href="http://bit.ly/bwp-layer-themes" target="_blank">
			<img src="<?php echo $this->plugin_wp_url . 'vendor/kminh/bwp-framework/images/ad_lt_250x250.png'; ?>" />
		</a>
	</div>
</div>
<?php
		}
?>
</div>
<?php
		}
	}

	public function show_version()
	{
		if (empty($this->plugin_ver)) return '';

		return '<a class="nav-tab version" title="'
			. sprintf(esc_attr(__('You are using version %s!', $this->plugin_dkey)), $this->plugin_ver)
			. '">' . $this->plugin_ver . '</a>';
	}

	protected function pre_init_actions()
	{
		$this->pre_init_build_constants();
		$this->pre_init_build_options();
		$this->pre_init_properties();
		$this->load_libraries();
		$this->pre_init_hooks();
		$this->pre_init_update_plugin();

		// Support installation and uninstallation
		register_activation_hook($this->plugin_file, array($this, 'install'));
		register_deactivation_hook($this->plugin_file, array($this, 'uninstall'));
	}

	protected function init_actions()
	{
		// @since rev 140, sometimes we need to hook to the 'init' action with
		// a specific priority
		$init_priority = apply_filters($this->plugin_key . '_init_priority', 10);

		add_action('init', array($this, 'build_wp_properties'), $init_priority);
		add_action('init', array($this, 'init'), $init_priority);

		// register backend hooks
		add_action('admin_init', array($this, 'init_admin'), 1);
		add_action('admin_menu', array($this, 'init_admin_menu'), 1);
	}

	public function init()
	{
		do_action($this->plugin_key . '_pre_init');

		$this->init_update_plugin();
		$this->build_constants();
		$this->build_options();
		$this->init_properties();
		$this->init_hooks();
		$this->enqueue_media();

		do_action($this->plugin_key . '_loaded');

		// icon 32px
		if ($this->is_admin_page())
		{
			add_filter('bwp-admin-form-icon', array($this, 'add_icon'));
			add_filter('bwp-admin-plugin-version', array($this, 'show_version'));
			add_action('bwp_option_action_before_form', array($this, 'show_donation'), 12);
		}
	}

	protected function add_cap($cap)
	{
		$this->plugin_cap = $cap;
	}

	public function build_wp_properties()
	{
		// set the plugin WP url here so it can be filtered
		if (defined('BWP_USE_SYMLINKS'))
			// make use of symlinks on development environment
			$this->plugin_wp_url = trailingslashit(plugins_url($this->plugin_folder));
		else
			// this should allow other package to include BWP plugins while
			// retaining correct URLs pointing to assets
			$this->plugin_wp_url = trailingslashit(plugin_dir_url($this->plugin_file));
	}

	protected function pre_init_build_constants()
	{
		// url to plugin bwp website
		define($this->plugin_ckey . '_PLUGIN_URL', $this->plugin_url);
		// the capability needed to configure this plugin
		define($this->plugin_ckey . '_CAPABILITY', $this->plugin_cap);

		// define registered option keys, to be used when building option pages
		// and build options
		foreach ($this->option_keys as $key => $option)
		{
			define(strtoupper($key), $option);
		}
		foreach ($this->extra_option_keys as $key => $option)
		{
			define(strtoupper($key), $option);
		}
	}

	protected function build_constants()
	{
		// these constants are only available once plugin_wp_url is available
		if (true == $this->need_media_filters)
		{
			define($this->plugin_ckey . '_IMAGES',
				apply_filters($this->plugin_key . '_image_path',
				$this->plugin_wp_url . 'images'));
			define($this->plugin_ckey . '_CSS',
				apply_filters($this->plugin_key . '_css_path',
				$this->plugin_wp_url . 'css'));
			define($this->plugin_ckey . '_JS',
				apply_filters($this->plugin_key . '_js_path',
				$this->plugin_wp_url . 'js'));
		}
		else
		{
			define($this->plugin_ckey . '_IMAGES', $this->plugin_wp_url . 'images');
			define($this->plugin_ckey . '_CSS', $this->plugin_wp_url . 'css');
			define($this->plugin_ckey . '_JS', $this->plugin_wp_url . 'js');
		}
	}

	protected function pre_init_build_options()
	{
		$this->build_options();
	}

	protected function build_options()
	{
		// Get all options and merge them
		$options = $this->options_default;
		foreach ($this->option_keys as $option)
		{
			$db_option = get_option($option);
			$db_option = $db_option && is_array($db_option)
				? $db_option
				: array();

			// check for obsolete keys and remove them from db
			if ($obsolete_keys = array_diff_key($db_option, $this->options_default))
			{
				foreach ($obsolete_keys as $obsolete_key) {
					unset($db_option[$obsolete_key]);
				}

				update_option($option, $db_option);
			}

			$options = array_merge($options, $db_option);
			unset($db_option);

			// also check for global options if in Multi-site
			if (self::is_multisite())
			{
				$db_option = get_site_option($option);
				if ($db_option && is_array($db_option))
				{
					$temp = array();
					foreach ($db_option as $k => $o)
					{
						if (in_array($k, $this->site_options))
							$temp[$k] = $o;
					}
					$options = array_merge($options, $temp);
				}
			}
		}
		$this->options = $options;
	}

	/**
	 * Get current options by their keys
	 *
	 * @param array $option_keys
	 */
	public function get_options_by_keys(array $option_keys)
	{
		$options = array();

		foreach ($option_keys as $key) {
			if (array_key_exists($key, $this->options)) {
				$options[$key] = $this->options[$key];
			}
		}

		return $options;
	}

	protected function pre_init_properties()
	{
		/* intentionally left blank */
	}

	protected function init_properties()
	{
		/* intentionally left blank */
	}

	protected function load_libraries()
	{
		/* intentionally left blank */
	}

	protected function update_plugin($when = '')
	{
		if (!is_admin())
			return;

		$current_version = $this->plugin_ver;
		$db_version = get_option($this->plugin_key . '_version');

		$action_hook = 'pre_init' == $when
			? $this->plugin_key . '_upgrade'
			: $this->plugin_key . '_init_upgrade';

		if (!$db_version || version_compare($db_version, $current_version, '<'))
		{
			do_action($action_hook, $db_version, $current_version);
			// only mark as upgraded when this is init update
			if ('init' == $when)
				update_option($this->plugin_key . '_version', $current_version);
		}
	}

	protected function pre_init_update_plugin()
	{
		$this->update_plugin('pre_init');
	}

	protected function init_update_plugin()
	{
		$this->update_plugin('init');
	}

	protected function pre_init_hooks()
	{
		/* intentionally left blank */
	}

	protected function init_hooks()
	{
		/* intentionally left blank */
	}

	protected function enqueue_media()
	{
		/* intentionally left blank */
	}

	public function install()
	{
		/* intentionally left blank */
	}

	public function uninstall()
	{
		/* intentionally left blank */
	}

	protected function is_admin_page($page = '')
	{
		if (is_admin() && !empty($_GET['page'])
			&& (in_array($_GET['page'], $this->option_keys)
				|| in_array($_GET['page'], $this->extra_option_keys))
			&& (empty($page)
				|| (!empty($page) && $page == $_GET['page']))
		) {
			return true;
		}
	}

	protected function get_current_admin_page()
	{
		if ($this->is_admin_page()) {
			return wp_unslash($_GET['page']);
		}

		return '';
	}

	public function get_admin_page_url($page = '')
	{
		$page = $page ?: $this->get_current_admin_page();
		$option_script = !$this->_menu_under_settings && !$this->_simple_menu
			? 'admin.php'
			: 'options-general.php';

		return add_query_arg(array('page' => $page), admin_url($option_script));
	}

	public function plugin_action_links($links, $file)
	{
		$option_keys = array_values($this->option_keys);

		if (false !== strpos(plugin_basename($this->plugin_file), $file))
		{
			$links[] = '<a href="' . $this->get_admin_page_url($option_keys[0]) . '">'
				. __('Settings') . '</a>';
		}

		return $links;
	}

	public function init_admin()
	{
		if ($this->is_admin_page())
		{
			$this->curren_option_page = new BWP_OPTION_PAGE_V2(
				$this->get_current_admin_page(), $this
			);

			$this->build_option_page();

			// submit the form on the current option page when needed
			if (isset($_POST['submit_' . $this->curren_option_page->get_form_name()]))
			{
				$submitted = $this->curren_option_page->submit_html_form();

				// form submitted successfully
				if ($submitted)
				{
					// redirect to current page to invalidate POST data with
					// proper messages
					wp_safe_redirect(add_query_arg('flash', 'options-saved', $this->get_admin_page_url()));
					exit;
				}
			}

			// show flash messages if needed
			if (!empty($_GET['flash']) && $_GET['flash'] == 'options-saved')
				$this->add_notice(__('All options have been saved.', $this->domain));
		}
	}

	public function init_admin_menu()
	{
		$this->_menu_under_settings = apply_filters('bwp_menus_under_settings', false);

		add_filter('plugin_action_links', array($this, 'plugin_action_links'), 10, 2);

		if ($this->is_admin_page())
		{
			// build tabs
			$this->build_tabs();

			// enqueue style sheets and scripts for the option page
			wp_enqueue_style(
				'bwp-option-page',
				$this->plugin_wp_url . 'vendor/kminh/bwp-framework/css/bwp-option-page.css',
				self::is_multisite() || class_exists('JCP_UseGoogleLibraries') ? array('wp-admin') : array(),
				'1.1.0'
			);

			wp_enqueue_script(
				'bwp-paypal-js',
				$this->plugin_wp_url . 'vendor/kminh/bwp-framework/js/paypal.js',
				array('jquery')
			);
		}

		$this->build_menus();
	}

	/**
	 * Build the Menus
	 */
	protected function build_menus()
	{
		/* intentionally left blank */
	}

	protected function build_tabs()
	{
		$option_script = !$this->_menu_under_settings
			? 'admin.php'
			: 'options-general.php';

		foreach ($this->option_pages as $key => $page)
		{
			$pagelink = !empty($this->option_keys[$key])
				? $this->option_keys[$key]
				: $this->extra_option_keys[$key];

			$this->form_tabs[$page] = admin_url($option_script)
				. '?page=' . $pagelink;
		}
	}

	/**
	 * Build the option pages
	 */
	protected function build_option_page()
	{
		/* intentionally left blank */
	}

	public function show_option_page()
	{
		/* filled by plugin */
	}

	public function add_notice($notice)
	{
		if (!in_array($notice, $this->notices))
		{
			$this->notices[] = $notice;
			add_action('bwp_option_action_before_form', array($this, 'show_notices'));
		}
	}

	public function show_notices()
	{
		if (false == $this->notice_shown)
		{
			foreach ($this->notices as $notice)
			{
				echo '<div class="updated fade"><p>' . $notice . '</p></div>';
			}
			$this->notice_shown = true;
		}
	}

	public function add_error($error)
	{
		if (!in_array($error, $this->errors))
		{
			$this->errors[] = $error;
			add_action('bwp_option_action_before_form', array($this, 'show_errors'));
		}
	}

	public function show_errors()
	{
		if (false == $this->error_shown)
		{
			foreach ($this->errors as $error)
			{
				echo '<div class="error"><p>' . $error . '</p></div>';
			}
			$this->error_shown = true;
		}
	}

	public function add_url($key, $url, $relative = true)
	{
		$this->urls[$key] = array(
			'relative' => $relative,
			'url' => $url
		);
	}

	public function get_url($key)
	{
		if (isset($this->urls[$key]))
		{
			$url = $this->urls[$key];
			if ($url['relative'])
				return trailingslashit($this->plugin_url) . $url['url'];

			return $url['url'];
		}

		return '';
	}

	public static function is_multisite()
	{
		if (function_exists('is_multisite') && is_multisite())
			return true;

		if (defined('MULTISITE'))
			return MULTISITE;

		if (defined('SUBDOMAIN_INSTALL') || defined('VHOST') || defined('SUNRISE'))
			return true;

		return false;
	}

	public static function is_subdomain_install()
	{
		if (defined('SUBDOMAIN_INSTALL') && SUBDOMAIN_INSTALL)
			return true;

		return false;
	}

	public static function is_normal_admin()
	{
		if (self::is_multisite() && !is_super_admin())
			return true;
		return false;
	}

	public static function is_on_main_blog()
	{
		global $blog_id;

		return self::is_multisite() && intval($blog_id) === 1;
	}

	protected static function is_apache()
	{
		if (isset($_SERVER['SERVER_SOFTWARE'])
			&& false !== stripos($_SERVER['SERVER_SOFTWARE'], 'apache')
		) {
			return true;
		}
		return false;
	}

	protected static function is_nginx()
	{
		if (isset($_SERVER['SERVER_SOFTWARE'])
			&& false !== stripos($_SERVER['SERVER_SOFTWARE'], 'nginx')
		) {
			return true;
		}

		return false;
	}
}
