<?php
/**
*  @package tutor-grades-exporter
*/

namespace Inc;

final class Init 
{

    /**
     * Store all the classes inside an array 
     * @return array filled with the classes that serve as a service.
     */
    private static function get_services(){
        return [
            Pages\Admin::class,
            Base\Enqueuetor::class,
            Base\SettingsLinkator::class
        ];
    }

    /**
     * Loop through the classes, instantiate them, and call the register method if exists
     * @return [type] [description]
     */
    private static function register_services(){
        foreach(self::get_services() as $class){
            
            $service = self::instantiate( $class );

            if ( method_exists($service, 'register') ){
                $service->register();
            }
        }
    }

    /**
     * Instaitate the class
     * @param class, $class, class form the service array
     * @return class instance.
     */
    private static function instantiate($class){
        $service = new $class();
        return $service;
    }

    /**
     * Luch the plugin
     */
    public static function run() {
        self::register_services();
    }
}