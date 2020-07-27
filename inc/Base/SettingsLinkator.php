<?php

/**
*  @package tutor-grades-exporter
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
 * 
 */
class SettingsLinkator extends BaseController
{
    public function register(){
        add_filter("plugin_action_links_$this->plugin", array($this, "get_settings_links"));
    }   
    
    public function get_settings_links($links){
        $settings_links = '<a href="admin.php?page=tutor_grades_exporter">Settings</a>';
        array_push($links, $settings_links);
        return $links;
    }
}