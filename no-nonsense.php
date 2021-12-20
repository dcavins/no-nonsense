<?php
/*
Plugin Name: No Nonsense
Plugin URI: https://room34.com
Description: Removes some default WordPress nonsense.
Version: 1.4.3.1
Author: Room 34 Creative Services, LLC
Author URI: http://room34.com
License: GPLv2
Text Domain: no-nonsense
*/

/*  Copyright 2021 Room 34 Creative Services, LLC (email: info@room34.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


add_filter('xmlrpc_enabled', '__return_false');

// Don't load directly
if (!defined('ABSPATH')) { exit; }

// Load includes
require_once(plugin_dir_path(__FILE__) . 'functions.php');

// Load plugin classes
require_once(plugin_dir_path(__FILE__) . 'class-r34nono.php');

// Instantiate
add_action('plugins_loaded', function() {
	global $r34nono;
	$r34nono = new R34NoNo();
});

// Flush rewrite rules on activation
register_activation_hook(__FILE__, function() { flush_rewrite_rules(); });

// Install/upgrade
register_activation_hook(__FILE__, 'r34nono_install');
add_action('plugins_loaded', function() {
	if (get_option('r34nono_version') != @R34NoNo::VERSION) {
		r34nono_install();
	}
});

// Plugin installation
function r34nono_install() {
	global $wpdb;

	// Update version
	add_option('r34nono_version', @R34NoNo::VERSION);
	
	// Update settings
	if (@R34NoNo::VERSION == '1.4.0') {
		update_option('r34nono_xmlrpc_disabled', get_option('r34nono_xmlrpc_enabled'));
		update_option('r34nono_login_replace_wp_logo_link', get_option('r34nono_login_remove_wp_logo'));
	}
}
