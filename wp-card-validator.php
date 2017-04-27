<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: WP Card Validator
Plugin URI:  https://developer.wordpress.org/plugins/wp-card-validator/
Description: WordPress Card Validator
Version:     1.0
Author:      Moises Machillanda - ScyGeek
Author URI:  https://scygeek.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wp-cd-val
Domain Path: /languages
*/
define('DEBUG_PLUGIN_DIR', plugin_dir_path(__FILE__));
//Styles and Scripts
require_once DEBUG_PLUGIN_DIR.'includes/theme.php';
//Plugin Install
require_once DEBUG_PLUGIN_DIR.'functions/install.php';
//Functions
require_once DEBUG_PLUGIN_DIR.'functions/functions.php';
