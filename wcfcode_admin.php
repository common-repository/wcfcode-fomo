<?php
/**
 * Register and enqueue a wcf-fomo plugin's styles .
 */
function wecodefuture_fomo_enqueue_custom_admin_style() {
wp_enqueue_style( 'wcf_wecodefuture', plugin_dir_url( __FILE__ ) . 'asset/css/wcfcode.css', false, '1.0.0' );
wp_enqueue_style( 'wcf_min', plugin_dir_url( __FILE__ ) . 'asset/css/bootstrap.min.css', false, '5.1.3' );
}
add_action( 'admin_enqueue_scripts', 'wecodefuture_fomo_enqueue_custom_admin_style' );
//add_action('admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style');
function wcf_wecodefuture_fomo_custom_enqueue_script() {
	wp_enqueue_script( 'wcfcode_script', plugin_dir_url( __FILE__ ) . 'asset/js/wcfcode.js', false, '1.0.0');
    wp_enqueue_script( 'bootstrap_script', plugin_dir_url( __FILE__ ) . 'asset/js/bootstrap.min.js', false, '5.1.3');
}
add_action('wp_enqueue_scripts','wcf_wecodefuture_fomo_custom_enqueue_script');
add_action('admin_enqueue_scripts', 'wcf_wecodefuture_fomo_custom_enqueue_script');
?>