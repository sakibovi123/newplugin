<?php
/**
 * @package newplugin
 */

namespace Inc;

final class Init {


    /**
     * store all the classes
     * @return array full of list
     */

    public static function register_all()
    {
        return [
            Pages\Admin::class
        ];
    }

    /**
     * Loop thruough all the classes, instantiate them if they exists
     */

    public static function register_services() 
    {
        foreach(self::register_all() as $class) {
            $service = self::instanciate($class);
            if( method_exists( $service, "register_all" ) ) {
                $service->register_all();
            }
        }
    }
    /**
     * Inititalizing the class
     * @param class $class class from the service array
     * @return class instance new instance of the class
     */

    public static function instanciate( $class )
    {
        $service = new $class;
        return $serice;
    }
}