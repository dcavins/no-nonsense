<?php

// Don't load directly
if (!defined('ABSPATH')) { exit; }

class R34NoNo {

	const NAME = 'No Nonsense';
	const VERSION = '1.4.3.1';
	
	public $function_details = array();

	public function __construct() {
	
		// Function details
		$this->function_details = array(

			'r34nono_admin_bar_logout_link' => array(
				'title' => __('Admin bar logout link', 'no-nonsense'),
				'description' => __('Adds a color-highlighted logout link directly into the admin bar, next to the username. Helpful to remind users to log out when their session is done.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Bar', 'no-nonsense'),
			),
			
			'r34nono_auto_core_update_send_email_only_on_error' => array(
				'title' => __('Auto core update send email only on error', 'no-nonsense'),
				'description' => __('By default, site admins receive a notification email every time WordPress runs auto-updates. Turn this on to only receive emails if there is an error during the update process.', 'no-nonsense'),
				'hook_type' => 'filter',
				'hook' => 'auto_core_update_send_email',
				'priority' => 10,
				'pn' => 4,
				'group' => __('Security and Updates', 'no-nonsense'),
			),
			
			'r34nono_deactivate_and_delete_hello_dolly' => array(
				'condition' => null,
				'title' => __('Deactivate and delete Hello Dolly plugin', 'no-nonsense'),
				'description' => __('Hello Dolly is installed as a part of WordPress core by default. This setting will deactivate it, if necessary, and delete it from your system. With this setting turned on, it will also prevent the plugin from being reinstalled in the future.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'admin_init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Plugins', 'no-nonsense'),
			),

			'r34nono_disable_site_search' => array(
				'title' => __('Disable site search', 'no-nonsense'),
				'description' => __('If your site does not need search functionality, turn this on to cause all standard WordPress search URLs to redirect to the home page without performing a search. Does not affect admin search functionality. Also deregisters the search widget.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Front End', 'no-nonsense'),
			),
			
			'r34nono_hide_admin_bar_for_logged_in_non_editors' => array(
				'title' => __('Hide admin bar for logged-in non-editors', 'no-nonsense'),
				'description' => sprintf(__('Hides the admin bar on front-end pages for logged-in users with no editing capabilities. Admin bar will still display for these users when they access their profile page. %sNote:%s With this option turned on, you will need to provide another way on the front end of your site for logged-in users to access their profile page and the logout link.', 'no-nonsense'), '<strong>', '</strong>'),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Bar', 'no-nonsense'),
			),

			'r34nono_limit_admin_elements_for_logged_in_non_editors' => array(
				'title' => __('Limit admin elements for logged-in non-editors', 'no-nonsense'),
				'description' => __('Hides parts of the admin sidebar menu and WordPress footer from logged-in users with no editing capabilities.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'admin_menu',
				'priority' => 11,
				'pn' => 0,
				'group' => __('Admin Access', 'no-nonsense'),
			),
			
			'r34nono_login_replace_wp_logo_link' => array(
				'title' => __('Replace WP logo with site icon on login screen', 'no-nonsense'),
				'description' => __('Replaces the WordPress logo and link on the login screen with the designated site icon (if set) and site link. If no icon is present, the WP logo and link are simply removed.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'login_enqueue_scripts',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Login', 'no-nonsense'),
			),

			'r34nono_redirect_admin_to_homepage_for_logged_in_non_editors' => array(
				'title' => __('Redirect admin to home page for logged-in non-editors', 'no-nonsense'),
				'description' => __('Logged-in users with no editing capabilities (e.g. Subscribers) will be redirected to the site home page if they try to access any admin pages, other than their own profile page.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'admin_init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Access', 'no-nonsense'),
			),

			'r34nono_remove_admin_color_scheme_picker' => array(
				'title' => __('Remove admin color scheme picker', 'no-nonsense'),
				'description' => __('Removes the color scheme picker from the user profile page.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'admin_init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Features', 'no-nonsense'),
			),

			'r34nono_remove_admin_wp_logo' => array(
				'title' => __('Remove admin bar WordPress logo', 'no-nonsense'),
				'description' => __('Removes WordPress icon and link from the admin bar.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'admin_bar_menu',
				'priority' => 11,
				'pn' => 1,
				'group' => __('Admin Bar', 'no-nonsense'),
			),

			'r34nono_remove_comments_from_admin' => array(
				'title' => __('Remove Comments from admin', 'no-nonsense'),
				'description' => sprintf(__('Removes links to Comments in the admin bar and admin sidebar menu. Does not actually deactivate comment functionality; this should be done under %sSettings %s Discussion%s.', 'no-nonsense'), '<a href="' . admin_url('options-discussion.php') . '" target="_blank">', '&gt;', '</a>'),
				'hook_type' => 'action',
				'hook' => 'admin_menu',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Features', 'no-nonsense'),
			),
			
			'r34nono_remove_dashboard_widgets' => array(
				'title' => __('Remove Dashboard widgets', 'no-nonsense'),
				'description' => __('Removes the selected widgets from the WordPress admin dashboard.', 'no-nonsense'),
				'options' => array(
					'dashboard_activity' => __('Activity', 'no-nonsense'),
					'dashboard_right_now' => __('At a Glance', 'no-nonsense'),
					'dashboard_incoming_links' => __('Incoming Links', 'no-nonsense'),
					'dashboard_plugins' => __('Plugins', 'no-nonsense'),
					'dashboard_quick_press' => __('Quick Draft', 'no-nonsense'),
					'dashboard_recent_comments' => __('Recent Comments', 'no-nonsense'),
					'dashboard_recent_drafts' => __('Recent Drafts', 'no-nonsense'),
					//'dashboard_secondary' => __('Secondary', 'no-nonsense'), // Deprecated as of WP 3.8
					'dashboard_site_health' => __('Site Health', 'no-nonsense'),
					'welcome_panel' => __('Welcome', 'no-nonsense'),
					'dashboard_primary' => __('WordPress Events and News', 'no-nonsense'),
				),
				'hook_type' => 'action',
				'hook' => 'admin_init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Features', 'no-nonsense'),
			),
			
			'r34nono_remove_head_tags' => array(
				'title' => __('Remove head tags', 'no-nonsense'),
				'description' => sprintf(__('Removes the selected %s tags from the %s on all front-end pages.', 'no-nonsense'), '<code>&lt;link&gt;</code>', '<code>&lt;head&gt;</code>'),
				'options' => array(
					//'adjacent_posts_rel_link_wp_head' => __('Adjacent posts', 'no-nonsense'), // No longer used as of WP 5.6
					'rsd_link' => __('EditURI/RSD', 'no-nonsense'),
					'oembed_linktypes' => __('oEmbed Discovery Links', 'no-nonsense'),
					'resource_hints' => __('Resource Hints', 'no-nonsense'), // @todo Change this key to 'wp_resource_hints' for consistency
					'rest_output_link_wp_head' => __('REST API', 'no-nonsense'),
					'feed_links' => __('RSS Feeds', 'no-nonsense'),
					'wlwmanifest_link' => __('WLW Manifest', 'no-nonsense'),
					'wp_generator' => __('WP Generator', 'no-nonsense'),
					'wp_shortlink_wp_head' => __('WP Shortlink', 'no-nonsense'),
				),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Front End', 'no-nonsense'),
			),
			
			'r34nono_remove_howdy' => array(
				'title' => __('Remove "Howdy"', 'no-nonsense'),
				'description' => __('Removes "Howdy" greeting text next to username in admin bar.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'admin_bar_menu',
				'priority' => 10,
				'pn' => 1,
				'group' => __('Admin Bar', 'no-nonsense'),
			),

			'r34nono_remove_posts_from_admin' => array(
				'title' => __('Remove Posts from admin', 'no-nonsense'),
				'description' => sprintf(__('If you use WordPress as a general-purpose CMS without a blog component, this option will hide the Posts link in the main admin navigation. It does %snot%s deactivate the "Posts" post type itself, nor restrict any front-end content. If you are using an SEO plugin, you will need to adjust its settings to exclude Posts from your sitemap XML.', 'no-nonsense'), '<strong>', '</strong>'),
				'hook_type' => 'action',
				'hook' => 'admin_menu',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Features', 'no-nonsense'),
			),
			
			'r34nono_remove_widgets_block_editor' => array(
				'title' => __('Remove Widgets block editor', 'no-nonsense'),
				'description' => __('Restores the previous default functionality of the Widgets page.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'after_setup_theme',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Features', 'no-nonsense'),
			),

			'r34nono_remove_wp_emoji' => array(
				'title' => __('Remove WP emoji', 'no-nonsense'),
				'description' => __('Removes built-in emoji-related WordPress JavaScript code that normally gets loaded on every page. Also removes emoji tools in the TinyMCE editor.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Front End', 'no-nonsense'),
			),

			'r34nono_xmlrpc_disabled' => array(
				'title' => __('Disable XML-RPC', 'no-nonsense'),
				'description' => sprintf(__('Most WordPress sites do not use XML-RPC, although some plugins (e.g. Jetpack) and mobile applications may require it. Per changes in WordPress 3.5, turning this option on will only disable XML-RPC requests that require authentication. Use the %sAlso kill any incoming XML-RPC request%s option below to cause all incoming XML-RPC requests to exit early. (Note: Because this is a plugin-based solution, XML-RPC requests still must partially load, to the point where this plugin is active, before it can kill the process. For better performance during a DDOS attack, you may wish to block calls to %s directly in your site&rsquo;s %s file.', 'no-nonsense'), '<strong>', '</strong>', '<code>xmlrpc.php</code>', '<code>.htaccess</code>'),
				'hook_type' => 'action',
				'hook' => 'plugins_loaded',
				'options' => array(
					'kill_requests' => __('Also kill any incoming XML-RPC request', 'no-nonsense'),
				),
				'priority' => 11,
				'pn' => 0,
				'group' => __('Security and Updates', 'no-nonsense'),
			),

		);
		
		// Conditional options (we don't show these if they're already set in wp-config.php
		if (!defined('CORE_UPGRADE_SKIP_NEW_BUNDLED')) {
			$this->function_details['r34nono_core_upgrade_skip_new_bundled'] = array(
				'title' => __('Core upgrade skip new bundled', 'no-nonsense'),
				'description' => sprintf(__('Skips installing things like new themes that are bundled by default with WordPress core upgrades. This can also be handled manually by adding the %sCORE_UPGRADE_SKIP_NEW_BUNDLED%s constant in your %swp-config.php%s file.', 'no-nonsense'), '<code>', '</code>', '<code>', '</code>'),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Security and Updates', 'no-nonsense'),
			);
		}
		
		if (!defined('DISALLOW_FILE_EDIT')) {
			$this->function_details['r34nono_disallow_file_edit'] = array(
				'title' => __('Disallow theme and plugin file editing', 'no-nonsense'),
				'description' => __('Removes the ability for site admins to edit theme and plugin files directly within WordPress.', 'no-nonsense'),
				'hook_type' => 'action',
				'hook' => 'init',
				'priority' => 10,
				'pn' => 0,
				'group' => __('Admin Features', 'no-nonsense'),
			);
		}
		
		// Admin page
		add_action('admin_menu', array(&$this, 'admin_page'));

		// Enqueue admin scripts
		add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
		
		// Enqueue front-end scripts
		add_action('wp_enqueue_scripts', array(&$this, 'enqueue_scripts'));
		
		// Add our hooks based on plugin settings
		foreach ((array)$this->function_details as $name => $item) {
			$function = !empty($item['fn']) ? $item['fn'] : $name;
			if (!empty(get_option($name)) && function_exists($function)) {
				if ($item['hook_type'] == 'filter') {
					add_filter($item['hook'], $function, $item['priority'], $item['pn']);
				}
				else {
					add_action($item['hook'], $function, $item['priority'], $item['pn']);
				}
			}
		}
	
	}
	
	public function admin_page() {
		add_options_page(
			__('No Nonsense', 'no-nonsense'),
			__('No Nonsense', 'no-nonsense'),
			'manage_options',
			'no-nonsense',
			array(&$this, 'admin_page_callback'),
			34
		);
	}
	
	public function admin_enqueue_scripts() {
		wp_enqueue_script('r34nono-admin', plugin_dir_url(__FILE__) . 'assets/admin-script.js', array('jquery'));
		wp_enqueue_style('r34nono-admin-style', plugin_dir_url(__FILE__) . 'assets/admin-style.css', false, @R34NoNo::VERSION);
		wp_enqueue_style('r34nono-admin-bar-style', plugin_dir_url(__FILE__) . 'assets/admin-bar.css', false, @R34NoNo::VERSION);
	}

	public function admin_page_callback() {
		// Update settings
		if (isset($_POST['r34nono-nonce']) && wp_verify_nonce($_POST['r34nono-nonce'], 'r34nono-admin')) {

			foreach ((array)$_POST as $key => $value) {
				if (strpos($key, 'r34nono_') === 0) {
					if (strpos($key, '_options') !== false) {
						update_option($key, filter_var_array($value, FILTER_SANITIZE_NUMBER_INT));
					}
					else {
						delete_option($key); // Need to reset to erase options being deselected
						update_option($key, filter_var($value, FILTER_SANITIZE_NUMBER_INT));
					}
				}
			}

			// Display admin notice
			echo '<div class="notice notice-success"><p>' . __('Settings updated. You may need to refresh the page to see changes.', 'no-nonsense') . '</p></div>';
		}
		
		// Load page template
		include_once(plugin_dir_path(__FILE__) . 'templates/admin/r34nono-admin.php');
	}
	
	public function enqueue_scripts() {
		if (is_user_logged_in()) {
			wp_enqueue_style('r34nono-admin-bar-style', plugin_dir_url(__FILE__) . 'assets/admin-bar.css', false, @R34NoNo::VERSION);
		}
	}

}
