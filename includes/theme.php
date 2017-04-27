<?php
/**
 * read file content
 */

function wp_cc_theme()
{
  wp_enqueue_style('styles', plugin_dir_url( __FILE__ ) . 'assets/css/styles.css');
  wp_enqueue_script('mask', plugin_dir_url( __FILE__ ) . 'assets/js/mask.min.js');
}
add_action('admin_enqueue_scripts', 'wp_cc_theme');
