<?php

/**
*  @package tutor-grades-exporter
*/

/*
 Plugin Name: Tutor LMS grade exporter
 Plugin URI: https://www.linkedin.com/in/sebasti%C3%A1n-garc%C3%ADa-acosta-6079b2168/
 Description: Plugin that allows you to export the grades of your students in the Tutor LMS quizzes that you posted.
 Version: 1.0.0
 Author: Sebastián García Acosta
Author URI: https://www.linkedin.com/in/sebasti%C3%A1n-garc%C3%ADa-acosta-6079b2168/
License: GPLv2 or later 
Text Domain: tutor-grades-exporter
*/

/**
 * Ensure that this file is no accesed by anyone but WordPress 
 */ 
$exit_msg = "Fuck you if you're trying to access this plugin content";

defined("ABSPATH") or die($exit_msg);

if( ! function_exists( "add_action" ) ) {
    echo $exit_msg;
    exit;
}

/**
 * Autoload
 */
if( file_exists( dirname(__FILE__) . '/vendor/autoload.php' ) ){
    require_once dirname(__FILE__) . '/vendor/autoload.php'; 
}

/**
 * Code that runs during activation
 */
function activate() {
    Inc\Base\Activator::activate();
}

/**
 * Code that runs during deactivatoin
 */
function deactivate() {
    Inc\Base\Deactivator::deactivate();
}
 
register_activation_hook( __FILE__, 'activate');
register_deactivation_hook( __FILE__, 'deactivate');

/**
 * Run the plugin
 */
if ( class_exists('Inc\\Init') ) {
    Inc\Init::run(); // Boom
}