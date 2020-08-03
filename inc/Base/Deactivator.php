<?php
/**
 * @package GradeExporterPlugin
 */

namespace Inc\Base;

class Deactivator{
    public static function deactivate(){
        flush_rewrite_rules();
        $role = get_role( 'tutor_instructor' );
        $role-> remove_cap( 'manage_options' ); // capability
    }
}