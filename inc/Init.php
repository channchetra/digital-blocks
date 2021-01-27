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
    public static function getServices() {
        return array(
            LoadSettings::class,
            RegisterAsset::class,
            Blocks\Services::class,
            Blocks\SCLists::class,
            Blocks\SCDetail::class
        );
    }

    public static function registerServices() {
        foreach( self::getServices() as $class ) {
            $service = self::instantiate( $class );
            if( method_exists( $service, "register" ) ) {
                $service->register();
            }
        }
    }

    private static function instantiate( $class ) {
        $service = new $class();
        return $service;
    }
}