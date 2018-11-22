<?php
function insert($title,$content) {
    $user_id = '0';
    $wp_error = false ;
    
    $defaults = array(
        'post_author' => $user_id,
        'post_content' => $content,
        'post_content_filtered' => '',
        'post_title' => $title,
        'post_excerpt' => '',
        'post_status' => 'publish',
        'post_type' => 'post',
        'comment_status' => '',
        'ping_status' => '',
        'post_password' => '',
        'to_ping' =>  '',
        'pinged' => '',
        'post_parent' => 0,
        'menu_order' => 0,
        'guid' => '',
        'import_id' => 0,
        'context' => '',
    );
    wp_insert_post($defaults ,$wp_error);
}