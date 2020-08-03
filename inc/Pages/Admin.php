<?php

/**
*  @package tutor-grades-exporter
*/

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;

/**
 * 
 */
class Admin extends BaseController { 

    public $settings;
    public $callbacks;
    public $pages = array();
    public $subpages = array();

    public function register(){
        $this -> settings = new SettingsApi();
        $this -> callbacks = new AdminCallbacks();
        
        $this -> setPages();
        $this -> setSubPages();

        $this -> setSettings();
        $this -> setSections();
        $this -> setFields();
        
        $this -> settings-> addPages( $this->pages )->
        withSubPage('Dashboard') ->
        addSubPages( $this->subpages ) ->
        register();
    }

    public function setPages(){
        $this-> pages = [
            [
                'page_title' => 'Grades exporter', 
                'menu_title' => 'Grades exporter', 
                'capability' => 'manage_options', 
                'menu_slug' => 'tutor_grades_exporter', 
                'callback' => [$this->callbacks, 'adminDashboard'], 
                'icon_url' => 'dashicons-image-rotate-left', 
                'position' => 3    
            ]
        ];
    }

    public function setSubPages(){
        $this->subpages = [
            [
                'parent_slug' => 'tutor_grades_exporter',
                'page_title' => 'Custom post types', 
                'menu_title' => 'CPT', 
                'capability' => 'manage_options', 
                'menu_slug' => 'grade_cpt', 
                'callback' => [$this->callbacks, 'CPT'] 
            ]
        ];
    }

    public function setSettings(){
        $args = [
                    [
                        'option_group' => 'tutor_grade_exporter_options_group',
                        'option_name' => 'text_example',
                        'callback' => [$this-> callbacks, 'tutorGradeExporterOptionsGroup']
                    ]
            ];

        $this -> settings -> setSettings( $args );
    }

    public function setSections(){
        $args = [
                    [
                        'id' => 'tutor_grade_exporter_admin_index',
                        'title' => 'Settings',
                        'callback' => [$this-> callbacks, 'adminSection'],
                        'page' => 'tutor_grades_exporter'
                    ]      
            ];

        $this -> settings -> setSections( $args );
    }

    public function setFields(){
        $args = [
            [
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => [$this-> callbacks, 'textExample'],
                'page' => 'tutor_grades_exporter',
                'section' => 'tutor_grade_exporter_admin_index',
                'args' => [
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                ]
            ]
        ];

        $this -> settings -> setSections( $args );
    }

}