<?php
/**
 * @Author: Chetra Chann
 * @Date:   2020-12-22 16:43:43
 * @Last Modified by:   Chetra Chann
 * @Last Modified time: 2021-01-20 16:28:49
 * @package CEGOV
 */

namespace CEGOV\Base;
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class BaseController
{
    public $plugin_name;
    public $plugin_path;
    public $plugin_url;
    public $plugin;
    public function __construct() {
        $this->plugin_name = 'digital-blocks';
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
        $this->plugin = plugin_basename( dirname( __FILE__, 3 ) );
    }
    public function getDistantTerms( $api = '' ) {
        $response = wp_remote_get( $api );
        if(is_wp_error($response)) {
            return array();
        }
        return json_decode(wp_remote_retrieve_body($response));
    }
    public function baseUrlWithoutHttp(){
        return preg_replace('#^https?://#', '', get_home_url());
    }
}