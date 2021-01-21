<?php
/**
 * @Author: Chetra Chann
 * @Date:   2020-12-22 16:21:19
 * @Last Modified by:   Chetra Chann
 * @Last Modified time: 2020-12-22 16:24:50
 * @package CEGOV
 */

namespace CEGOV;
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
final class Init
{
    function __construct() {

    }

    public static function getPluginSetting() {
        return array(
            LoadSettings::class,
            RegisterAsset::class
        );
    }

    public static function registerSetting() {
        foreach( self::getPluginSetting() as $class ) {
            $blocks_set = self::instantiate( $class );
            if( method_exists( $blocks_set, "register" ) ) {
                $blocks_set->register();
            }
        }
    }

    private static function instantiate( $class ) {
        $blocks_set = new $class();
        return $blocks_set;
    }
}