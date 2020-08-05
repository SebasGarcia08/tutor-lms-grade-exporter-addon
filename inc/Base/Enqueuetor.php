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
        add_action( 'wp_ajax_get_courses', [$this, 'get_courses']);
        add_action( 'wp_ajax_get_quizzes_by_course', [$this, 'get_quizzes_by_course']);
    }

    public function enqueue() {
        wp_enqueue_style( 'style.css', $this->plugin_url . '/assets/style.css' );
        wp_enqueue_script( 'myscript.js', $this->plugin_url . '/assets/myscript.js', ['jquery'], '1.0.0', false);

        wp_localize_script('myscript.js', 'ipAjaxVar', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    public function get_courses() {
        global $wpdb;

        $user_id = get_current_user_id();

        $get_assigned_courses_ids = $wpdb->get_col("SELECT meta_value from {$wpdb->usermeta} WHERE meta_key = '_tutor_instructor_course_id' AND user_id = {$user_id}");
    
        $custom_author_query = "AND {$wpdb->posts}.post_author = {$user_id}";
        if (is_array($get_assigned_courses_ids) && count($get_assigned_courses_ids)){
            $in_query_pre = implode(',', $get_assigned_courses_ids);
            // $custom_author_query = " ( {$wpdb->posts}.post_author = {$user_id} AND {$wpdb->posts}.ID IN({$in_query_pre}) ) ";
        }
        
        //  First, get the courses names
        $courses_query = "SELECT post_title, ID FROM {$wpdb->posts} WHERE {$wpdb->posts}.ID IN({$in_query_pre})";
        $course_list = $wpdb->get_results($courses_query);      
        
        $result = json_encode($course_list);

        echo $result;
        die();
    }

    function get_quizzes_by_course() {
        global $wpdb;

        $quizzes_list = $wpdb -> get_results(
            "SELECT DISTINCT p.post_title, qa.quiz_id
                FROM {$wpdb->prefix}tutor_quiz_attempts AS qa 
            INNER JOIN {$wpdb->posts} AS p 
                ON qa.quiz_id = p.ID 
            WHERE qa.course_id = {$_POST['course_id']}"
        );

        $result = json_encode($quizzes_list);
        
        echo $result;
        die();
    }
}