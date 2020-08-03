<?php
/**
*  @package tutor-grades-exporter
*/

namespace Inc\Base;

class BaseController
{
    public $plugin_path;
    public $plugin_url;
    public $plugin;

    public function __construct(){
        // 2 refers to the number of levels that are apart from the actual plugin
        $this -> plugin_path = plugin_dir_path( dirname(__FILE__, 2) );
        $this -> plugin_url = plugin_dir_url( dirname(__FILE__, 2) );
        $this -> plugin = plugin_basename( dirname(__FILE__, 3) ) . '/tutor-grades-exporter.php';
    }
}