<?php

// Don't load directly
if (!defined('ABSPATH')) { exit; }


// General plugin functions

function r34nono_group_functions() {
	global $r34nono;
	$output = array();
	foreach ((array)$r34nono->function_details as $fn => $item) {
		$output[$item['group']][$fn] = $item;
	}
	foreach (array_keys((array)$output) as $group) {
		uasort($output[$group], 'r34nono_group_functions_sort_callback');
	}
	ksort($output);
	return $output;
}

function r34nono_group_functions_sort_callback($a, $b) {
	return strnatcmp($a['title'], $b['title']);
}


// Hook functions

function r34nono_admin_bar_logout_link() {
	add_action('admin_head', 'r34nono_admin_bar_logout_link_admin_head_callback');
	add_action('admin_bar_menu', 'r34nono_admin_bar_logout_link_admin_bar_menu_callback', 1, 1);
}

function r34nono_admin_bar_logout_link_admin_head_callback() {
	global $_wp_admin_css_colors;
	$user_option_admin_color = get_user_option('admin_color');
	$admin_color_scheme = $_wp_admin_css_colors[$user_option_admin_color];
	// "Modern" only has 3 colors
	if ($user_option_admin_color == 'modern' || empty($admin_color_scheme->colors[3])) {
		$logout_button_color = $admin_color_scheme->colors[1];
		$logout_button_hover_color = $admin_color_scheme->colors[2];
		$logout_button_hover_text_color = '#000000';
	}
	// Most schemes have 4 colors
	else {
		$logout_button_color = $admin_color_scheme->colors[2];
		$logout_button_hover_color = $admin_color_scheme->colors[3];
	}
	?>
	<style>
		#wpadminbar .r34nono-important {
			background: <?php echo esc_attr($logout_button_color); ?>;
		}
		#wpadminbar .r34nono-important:hover {
			background: <?php echo esc_attr($logout_button_hover_color); ?>;
		}
		<?php
		if (!empty($logout_button_hover_text_color)) {
			?>
			#wpadminbar .r34nono-important:hover .ab-item, #wpadminbar .r34nono-important .ab-item:hover {
				color: <?php echo esc_attr($logout_button_hover_text_color); ?> !important;
			}
			<?php
		}
		?>
	</style>
	<?php
}

function r34nono_admin_bar_logout_link_admin_bar_menu_callback($wp_admin_bar) {
	$wp_admin_bar->add_node(array(
		'href' => wp_logout_url(),
		'id' => 'r34nono-logout',
		'meta' => array(
			'class' => 'r34nono-important',
		),
		'parent' => 'top-secondary',
		'title' => __('Log Out'),
	));
}

function r34nono_auto_core_update_send_email_only_on_error($send, $type, $core_update, $result) {
	return (empty($type) || $type != 'success');
}

function r34nono_core_upgrade_skip_new_bundled() {
	if (!defined('CORE_UPGRADE_SKIP_NEW_BUNDLED')) {
		define('CORE_UPGRADE_SKIP_NEW_BUNDLED', true);
	}
}

function r34nono_deactivate_and_delete_hello_dolly() {
	if (is_plugin_active('hello-dolly/hello.php')) {
		deactivate_plugins(array('hello-dolly/hello.php'));
	}
	if (array_key_exists('hello-dolly/hello.php', get_plugins())) {
		delete_plugins(array('hello-dolly/hello.php'));
	}
}

function r34nono_disable_site_search() {
	if (!is_admin()) {
		add_action('parse_query', function($query) {
			if ($query->is_search && $query->is_main_query()) {
				wp_redirect(home_url('/')); exit;
			}
		}, 5);
	}
	add_filter('get_search_form', '__return_false', 999);
	add_action('widgets_init', function() { unregister_widget('WP_Widget_Search'); }, 1);
}

function r34nono_disallow_file_edit() {
	if (!defined('DISALLOW_FILE_EDIT')) {
		define('DISALLOW_FILE_EDIT', true);
	}
}

function r34nono_hide_admin_bar_for_logged_in_non_editors() {
	if (!wp_doing_ajax() && is_user_logged_in() && !current_user_can('edit_posts')) {
		add_filter('show_admin_bar', '__return_false');
	}
}

function r34nono_limit_admin_elements_for_logged_in_non_editors() {
	if (!wp_doing_ajax() && is_admin() && is_user_logged_in() && !current_user_can('edit_posts')) {
		remove_menu_page('index.php');
		add_filter('admin_footer_text', '__return_false');
		add_filter('update_footer', '__return_false', 99);
	}
}

function r34nono_login_replace_wp_logo_link() {
	if (has_site_icon()) {
		?>
		<style type="text/css">.login h1 a { background-image: url('<?php echo get_site_icon_url(192); ?>') !important; }</style>
		<?php
	}
	else {
		?>
		<style type="text/css">.login h1 a { display: none; }</style>
		<?php
	}
	add_filter('login_headerurl', function() { return home_url('/'); });
}

function r34nono_redirect_admin_to_homepage_for_logged_in_non_editors() {
	if (!wp_doing_ajax() && is_admin() && is_user_logged_in() && !current_user_can('edit_posts')) {
		global $pagenow;
		$options = get_option('r34nono_redirect_admin_to_homepage_for_logged_in_non_editors_options');
		$prevent_profile_access = ! empty( $options['prevent_profile_access'] );

		if ( $prevent_profile_access || $pagenow != 'profile.php' ) {
			wp_redirect( home_url( '/' ) );
			exit;
		}
	}
}

function r34nono_remove_admin_color_scheme_picker() {
	remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
}

function r34nono_remove_admin_wp_logo($wp_admin_bar) {
	$wp_admin_bar->remove_node('wp-logo');
}

function r34nono_remove_comments_column($columns) {
	unset($columns['comments']);
	return $columns;
}

function r34nono_remove_comments_from_admin() {
	remove_menu_page('edit-comments.php');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	add_action('admin_bar_menu', function($wp_admin_bar) { $wp_admin_bar->remove_node('comments'); }, 11, 1);
	add_filter('manage_edit-post_columns', 'r34nono_remove_comments_column');
	add_filter('manage_edit-page_columns', 'r34nono_remove_comments_column');
	add_filter('manage_media_columns', 'r34nono_remove_comments_column');
}

function r34nono_remove_dashboard_widgets() {
	if ($options = get_option('r34nono_remove_dashboard_widgets_options')) {
		foreach ((array)$options as $option => $bool) {
			if (!empty($bool)) {
				if ($option == 'welcome_panel') {
					remove_action('welcome_panel', 'wp_welcome_panel');
				}
				else {
					remove_meta_box($option, 'dashboard', 'core');
				}
			}
		}
	}
}

function r34nono_remove_head_tags() {
	if ($options = get_option('r34nono_remove_head_tags_options')) {
		foreach ((array)$options as $option => $bool) {
			if (!empty($bool)) {
				switch ($option) {
					case 'feed_links':
						remove_action('wp_head', 'feed_links', 2);
						remove_action('wp_head', 'feed_links_extra', 3);
						break;
					case 'oembed_linktypes':
						add_filter('oembed_discovery_links', '__return_false');
						break;
					case 'resource_hints':
					case 'wp_resource_hints':
						remove_action('login_head', 'wp_resource_hints', 2);
						remove_action('wp_head', 'wp_resource_hints', 2);
						break;
					case 'rest_output_link_wp_head':
						remove_action('template_redirect', 'rest_output_link_header', 11);
						remove_action('wp_head', 'rest_output_link_wp_head');
						remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
						break;
					case 'wp_shortlink_wp_head':
						remove_action('template_redirect', 'wp_shortlink_header', 11);
						remove_action('wp_head', 'wp_shortlink_wp_head');
						break;
					default:
						remove_action('wp_head', $option);
						break;
				}
			}
		}
	}
}

function r34nono_remove_howdy($wp_admin_bar) {
	$my_account = $wp_admin_bar->get_node('my-account');
	$wp_admin_bar->add_node(array(
		'id' => 'my-account',
		'title' => str_replace('Howdy, ', '', $my_account->title),
	));
}

function r34nono_remove_posts_from_admin() {
	remove_menu_page('edit.php');
}

function r34nono_remove_widgets_block_editor() {
	remove_theme_support('widgets-block-editor');
}

function r34nono_remove_wp_emoji() {
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');	
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');	
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	// Remove WP emoji from TinyMCE
	add_filter('tiny_mce_plugins', 'r34nono_remove_wp_emoji_from_tinymce', 10, 1);
	// Remove WP emoji DNS prefetch
	add_filter('emoji_svg_url', '__return_false');
}

function r34nono_remove_wp_emoji_from_tinymce($plugins) {
	return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
}

// This plugin's name appears contradictory but it is kept this way for backwards compatibility
function r34nono_xmlrpc_disabled() {
	$options = get_option('r34nono_xmlrpc_disabled_options');
	// Turn off XML-RPC (after WP 3.5 this only turns off unauthenticated access)
	add_filter('xmlrpc_enabled', '__return_false');
	// Silently kill any XML-RPC request
	if (!empty($options['kill_requests'])) {
		if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) { status_header(403); exit; }
	}
}
