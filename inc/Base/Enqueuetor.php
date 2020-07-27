<?php

/**
*  @package tutor-grades-exporter
*/

namespace Inc\Base;

use \Inc\Base\BaseController;

/**
 * 
 */
class Enqueuetor extends BaseController
{
    public function register(){
        add_action( "admin_enqueue_scripts", array($this, 'enqueue') );
    }

    public function enqueue() {
        wp_enqueue_style( 'style.css', $this->plugin_url . 'assets/style.css' );
        wp_enqueue_script( 'myscript.js', $this->plugin_url . 'assets/myscript.js' );   
    }
}