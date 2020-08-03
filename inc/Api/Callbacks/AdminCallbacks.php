<?php

/**
*  @package tutor-grades-exporter
*/

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController {
    
    public function adminDashboard(){
        return require_once("{$this->plugin_path}/templates/admin.php");
    }

    public function CPT(){
        return require_once("{$this->plugin_path}/templates/cpt.php");
    }

    public function tutorGradeExporterOptionsGroup($input) {
        return $input;
    }

    public function adminSection(){
        echo 'Check this fucking shit out';
    }

    public function textExample(){
        $value = esc_attr( get_option('text_example') );

        echo "<input type='text' class='regular-text' name='text_example' value='{$value}' placeholder='Write someting here'/>";
    }
}