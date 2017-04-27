<?php
/**
 * read file content
 */

function wpcredicardvalidation_install()
{
  wp_creditcard_validation_setup_menu();
  flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wpcredicardvalidation_install' );
