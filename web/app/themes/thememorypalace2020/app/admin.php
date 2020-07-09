<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

//Making tags hierarchical
//https://css-tricks.com/how-and-why-to-convert-wordpress-tags-from-flat-to-hierarchical/

add_action('init', function () {
    global $wp_rewrite;

$rewrite =  array(
  'hierarchical'              => false, // Maintains tag permalink structure
  'slug'                      => get_option('tag_base') ? get_option('tag_base') : 'tag',
  'with_front'                => ! get_option('tag_base') || $wp_rewrite->using_index_permalinks(),
  'ep_mask'                   => EP_TAGS,
);

  register_taxonomy( 'post_tag', 'post', array(
    'hierarchical'              => true, // Was false, now set to true
    'query_var'                 => 'tag',
    'public'                    => false,
    'show_ui'                   => false,
    '_builtin'                  => true,
    'rewrite'                   => $rewrite,
  ) );
});


// New Taxonomies
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', __NAMESPACE__ . '\\create_history_taxonomy', 0 );
add_action( 'init', __NAMESPACE__ . '\\create_topics_taxonomy', 0 );
add_action( 'init', __NAMESPACE__ . '\\create_places_taxonomy', 0 );
 
//create a custom taxonomy name it topics for your posts
 
function create_topics_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Topics', 'taxonomy general name' ),
    'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Topics' ),
    'all_items' => __( 'All Topics' ),
    'parent_item' => __( 'Parent Topic' ),
    'parent_item_colon' => __( 'Parent Topic:' ),
    'edit_item' => __( 'Edit Topic' ), 
    'update_item' => __( 'Update Topic' ),
    'add_new_item' => __( 'Add New Topic' ),
    'new_item_name' => __( 'New Topic Name' ),
    'menu_name' => __( 'Topics' ),
  );    
 
  register_taxonomy('topics',array('post'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'topic' ),
  ));
 
}

function create_history_taxonomy() {
 
  $labels = array(
    'name' => _x( 'History', 'taxonomy general name' ),
    'singular_name' => _x( 'Time Period', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Time Periods' ),
    'menu_name' => __( 'History' ),
  );    
 
  register_taxonomy('history',array('post'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'history' ),
  ));
 
}

function create_places_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Places', 'taxonomy general name' ),
    'singular_name' => _x( 'Place', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Places' ),
    'all_items' => __( 'All Places' ),
    'menu_name' => __( 'Places' ),
  );    
 
  register_taxonomy('places',array('post'), array(
    'hierarchical' => false,
    'show_tagcloud' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'place' ),
  ));
 
}