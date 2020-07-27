<?php

/**
*  @package tutor-grades-exporter
*/

namespace Inc\Pages;

use \Inc\Base\BaseController;

/**
 * 
 */
class Admin extends BaseController
{

    public function register(){
        add_action("admin_menu", array($this, 'add_admin_pages'));
    }

    public function add_admin_pages(){
        add_menu_page( 'Grades exporter', 'Grades exporter', 'manage_options', 'tutor_grades_exporter', 
        array($this, 'admin_index'), 'dashicons-image-rotate-left', 3);
    }

    public function admin_index(){
        require_once $this-> plugin_path . 'templates/admin.php';
    }

}