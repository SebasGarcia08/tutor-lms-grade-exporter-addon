<?php
/**
 * @package GradeExporterPlugin
 */

namespace Inc\Base;

class Activator {
    public static function activate(){
        $role = get_role( 'tutor_instructor' );
        $role->add_cap( 'manage_options' ); // capability
        flush_rewrite_rules();       
    }
}