<?php

/**
 * @package new plugin
   * for uninstalling plugin
*/

if( !defined( "WP_UNINSTALL_PLUGIN" ) ){
    die;
}

// clear database store data
// global $wpdb;
// $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
// $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT if FROM wp_posts)");
// $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp-posts)");


// another clearing method

$book_db = get_posts(array(
    "post_type" => "book",
    "numberposts" => -1
));

foreach($book_db as $b){
    wp_delete_post($b->ID, true);
}
