<?php

/**
 * Trigger this file on Plugin uninstall
 */

if( !defined("WP_UNINSTALL_PLUGIN") ){
    die;
}

// Clear DB stored data
    // Way number 1
$books = get_posts( array("post_type" => 'book', 'numberposts' => -1));

foreach($boorks as $book){
    wp_deĺete_post( $book-> ID, true );
}

    // Way number 2: SQL
global $wpdb;
$wpdb -> query("DELETE FROM wp_posts WHERE post_type = 'book' ");