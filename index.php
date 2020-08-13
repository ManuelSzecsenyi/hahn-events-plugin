<?php
/*
Plugin Name: Hahn Events
Description: A custom wordpress plugin which displays events
Author: Manuel Szecsenyi
Version: 0.1
Author URI: http://marginleft.at
*/

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path(__FILE__) . '/includes/acf/' );
define( 'MY_ACF_URL', plugin_dir_url(__FILE__) . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true;
}