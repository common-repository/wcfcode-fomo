<?php
/*
Plugin Name: WCF FOMO 
Description: Our WordPress push notification plugin boosts your customer retention and gets you quality leads that further scale your sales by 79%. The engaging popups also improve the site's CTRs and reduce bounce rates. As a result, the website's DA gets improved.
Version: 1.0.1
Author: WeCode Future
Text Domain: wecodefuture-fomo
License: GPLv3
*/

define( 'WCF_FOMO_VERSION', '1.0.1' );
define( 'WCF_FOMO__MINIMUM_WP_VERSION', '5.0' );
define( 'WCF_FOMO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WCF_FOMO_BASE_URL', plugin_dir_url( __FILE__ ) );
register_activation_hook(__FILE__,'wcf_fomo_activate');
register_deactivation_hook(__FILE__, 'wcf_fomo_deactivate');
require_once(WCF_FOMO__PLUGIN_DIR . 'wcfcode_admin.php' );
require_once(WCF_FOMO__PLUGIN_DIR . 'function.php' );
function wcf_fomo_activate(){
	add_option('wcf_userid', '');
	add_option('wcf_api_key', '');
}
function wcf_fomo_deactivate(){
global $wpdb;
global $table_prefix;
$table_fomo = $wpdb->prefix . 'test';
 $sql= "DROP TABLE $table_fomo";
 $wpdb->query($sql);
}

add_action('admin_menu', 'add_wcfmenu');
function add_wcfmenu(){
  $icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2aWV3Qm94PSIwIDAgODkuMSA4OC43MiI+IAogIDxkZWZzPgogICAgPHN0eWxlPgogICAgICBzdmd7CiAgICAgIAlwYWRkaW5nOiAxMCU7CiAgICAgIH0KICAgICAgLmEgewogICAgICAgIGZpbGw6IHVybCgjYSk7CiAgICAgIH0KCiAgICAgIC5iIHsKICAgICAgICBmaWxsOiB1cmwoI2IpOwogICAgICB9CiAgICA8L3N0eWxlPgogICAgPGxpbmVhckdyYWRpZW50IGlkPSJhIiB4MT0iNDAuMiIgeTE9IjQ4LjAyIiB4Mj0iNDAuMiIgeTI9Ijg2LjQ2IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CiAgICAgIDxzdG9wIG9mZnNldD0iMCIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIvPgogICAgICA8c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiNmZmZmZmYiLz4KICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgICA8bGluZWFyR3JhZGllbnQgaWQ9ImIiIHgxPSI0MC4yIiB5MT0iMzQuMjUiIHgyPSI0MC4yIiB5Mj0iLTEuMDQiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj4KICAgICAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjZmZmZmZmIi8+CiAgICAgIDxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIvPgogICAgPC9saW5lYXJHcmFkaWVudD4KICA8L2RlZnM+CiAgPHRpdGxlPnN0YXJ0LWJvb2tpbmctaWNvbjwvdGl0bGU+CiAgPGc+CiAgICA8cGF0aCBjbGFzcz0iYSIgZD0iTTU4LjYxLDc5LjkzaDBsLTQyLjg1LS4wOGExNS4xNCwxNS4xNCwwLDAsMSwwLTMwLjI4SDU4LjY3YTkuMSw5LjEsMCwxLDEsMCwxOC4xOWgtNDZWNjEuNzFoNDZhMywzLDAsMCwwLDMtMy4wNywzLDMsMCwwLDAtMy0zSDE1Ljc1YTkuMDksOS4wOSwwLDAsMCwwLDE4LjE4bDQyLjg1LjA4aDBhMTUuMTQsMTUuMTQsMCwwLDAsLjA2LTMwLjI4bC0xOC41NC0uMDcsMC02LjA1LDE4LjU0LjA3QTIxLjI0LDIxLjI0LDAsMCwxLDc5LjgxLDU4Ljc0YTIxLjIsMjEuMiwwLDAsMS0yMS4yLDIxLjE5WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTAuNiAtMS4wNykiLz4KICAgIDxwYXRoIGNsYXNzPSJiIiBkPSJNNDAuMjYsNDMuNTNsLTE4LjU0LS4wN2EyMS4yLDIxLjIsMCwwLDEsLjA3LTQyLjM5aC4wNWw0Mi44NS4wOWExNS4xNCwxNS4xNCwwLDAsMSwwLDMwLjI4SDIxLjc0YTkuMTMsOS4xMywwLDAsMS05LjEtOSw5LjEsOS4xLDAsMCwxLDkuMS05LjE2aDQ2VjE5LjNoLTQ2YTMsMywwLDAsMC0yLjE2LjksMywzLDAsMCwwLDIuMTYsNS4xOUg2NC42NmE5LjA5LDkuMDksMCwwLDAsMC0xOC4xOEwyMS44Miw3LjEyaDBhMTUuMTUsMTUuMTUsMCwwLDAtLjA1LDMwLjI5bDE4LjU0LjA3WiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTAuNiAtMS4wNykiLz4KICA8L2c+Cjwvc3ZnPgo=';

add_menu_page('WCF FOMO', 'WCF FOMO','manage_options', dirname(__FILE__) ,'wecodefuture_fomo_start_booking_admin_index', $icon, 10);
add_submenu_page(dirname(__FILE__), 'Campaigns', 'Campaigns', 'manage_options','/campaigns', 'wecodefuture_fomo_render_campaign_page');
}

 function wecodefuture_fomo_render_campaign_page(){
include('wcf_render_campaign_page.php');
 }
function wecodefuture_fomo_render_account_page(){
  include('wcf_render_account_page.php');
}
function wecodefuture_fomo_start_booking_admin_index(){
    include('start_booking_admin_index.php');
}
?>