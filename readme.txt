=== No Nonsense ===
Contributors: room34
Donate link: https://room34.com/payments
Tags: remove howdy, remove emoji, remove comments, remove xml-rpc, remove WordPress logo
Requires at least: 4.9
Requires PHP: 7.0.0
Tested up to: 5.8.2
Stable tag: 1.4.3.1
License: GPLv2

The fastest, cleanest way to get rid of the parts of WordPress you don't need.

== Description ==

For professional developers working with WordPress, the first steps in any new build frequently involve deleting default content and turning off built-in settings. This plugin encapsulates many of those tasks on a single, clean configuration screen.

== Installation ==

== Frequently Asked Questions ==

= I installed and activated the plugin, now what? =

After installing the plugin, navigate to **Settings &gt; No Nonsense** to choose which built-in WordPress features you want to turn off. Be sure to click **Save Changes** when you're done.

== Screenshots ==

== Changelog ==

= 1.4.3.1 - 2021.12.19 =

* Changed `r34nono_remove_head_tags()` to hook into `init` instead of `wp_head` to ensure that all enclosed hooks are applied in time.

= 1.4.3 - 2021.12.19 =

* Added **Remove admin color scheme picker**.
* Added dynamic sorting of functions alphabetically by title on admin screen, to keep the list organized as the set of options grows.

= 1.4.2 - 2021.12.19 =

* Added HTTP 403 status when XML-RPC requests are killed.
* Added logic to remove HTTP response headers for WP Shortlink and REST API.
* Added logic to also remove resource hints from login screen when set for the front end.
* Added "oEmbed Discovery Links" option in **Remove head tags**.
* Corrected checkbox label "Quick Press" to "Quick Draft" in dashboard widget options.
* Fixed priority on `remove_action()` for REST API.
* Modified admin bar logout button to use admin color scheme.
* Removed `likes` column from functionality affected by **Remove Comments from admin** because it is not part of WP core.
* Refactored `r34nono_remove_head_tags()` to use `switch` instead of `if / elseif / else`.
* Specified PHP 7.0.0 minimum requirement in readme file.

= 1.4.1 - 2021.12.18 =

* Added **Remove Posts from admin**, **Disable site search**, and **Disallow theme and plugin file editing** options.
* Fix: Changed `r34nono_core_upgrade_skip_new_bundled` hook type from `filter` to `action.

= 1.4.0 - 2021.12.18 =

**NOTE** Two options' function names have changed in this version. The update script should automatically transfer their settings over to their replacements. However, you are encouraged to review your settings after running the update.

* Added **Remove head tags**, with options to turn off a number of `<link>` tags that WordPress inserts by default in the `<head>` of every page.
* Changed **Remove WordPress logo on login screen** to **Replace WP logo with site icon on login screen**. This will use the designated site icon and change the URL to the site's home page. If there is no designated site icon, the icon will simply be removed instead.
* Modified **Remove Comments from admin** functionality to also remove comments (and likes) columns from admin index pages for Posts, Pages and Media Library. (Does not change settings for any custom post types.)
* Modified **Disable XML-RPC** functionality to add the option to immediately kill incoming XML-RPC requests. Due to the fact that this is a plugin-based solution, you may find it more effective to block access to `xmlrpc.php` directly in your site's `.htaccess` file.

= 1.3.0 - 2021.12.18 =

* Added **Admin bar logout link** option.
* Refactored CSS.
* Fixed link error in sidebar on admin page.

= 1.2.0 - 2021.12.17 =

* Added option to deactivate, delete and prevent reinstallation of [Hello Dolly](https://wordpress.org/plugins/hello-dolly) plugin.

= 1.1.1 - 2021.12.15 =

* Changed all instances of `esc_html()` to `wp_kses_post()` on admin page.
* Removed unnecessary `NAMESPACE` constant from `R34NoNo` class.
* New branding assets.

= 1.1.0 - 2021.12.14 =

* Initial WordPress Plugin Directory version.
* Added option to deactivate Widgets Block Editor.
* Added option to remove Dashboard widgets, and related functionality to support sub-options on admin page.
* Duplicated Save Changes button at top of form.
* Updated sidebar on admin page.
	* Changed donation button to make it less likely to be mistaken for the Save Changes button.
	* Fixed links.
	* i18n: Added translation strings. (Translation files are not yet present.)
* Updated readme content and tags.
* Added input value filtering on `update_option()`.
* Added `esc_html()` on all variable output on admin page.
* Changed text domain to conform with plugin directory requirements.

= 1.0.0 - 2021.12.13 =

* Original version.

== Upgrade Notice ==
