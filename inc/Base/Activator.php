<?php
/**
 * @package GradeExporterPlugin
 */

namespace Inc\Base;

class Activator {
    public static function activate(){
        flush_rewrite_rules();       
    }
}