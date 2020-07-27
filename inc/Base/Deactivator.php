<?php
/**
 * @package GradeExporterPlugin
 */

namespace Inc\Base;

class Deactivator{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}