<?php
/**
 * Plugin Name: Cambodia digital-blocks
 * Plugin URI: https://github.com/chann/digital-blocks
 * Description: digital-blocks — is a Gutenberg plugin created via create-guten-block.
 * Author: Chetra Chann
 * Author URI: https://mptc.gov.kh/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CEGOV
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . "vendor/autoload.php";
if( class_exists( "CEGOV\\Init" ) ) {
	CEGOV\Init::registerServices();
}