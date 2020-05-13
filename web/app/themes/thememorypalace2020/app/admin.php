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

$labels = array(
    'name'                       => _x( 'Tags', 'Taxonomy General Name', 'hierarchical_tags' ),
    'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'hierarchical_tags' ),
    'menu_name'                  => __( 'Taxonomy', 'hierarchical_tags' ),
    'all_items'                  => __( 'All Tags', 'hierarchical_tags' ),
    'parent_item'                => __( 'Parent Tag', 'hierarchical_tags' ),
    'parent_item_colon'          => __( 'Parent Tag:', 'hierarchical_tags' ),
    'new_item_name'              => __( 'New Tag Name', 'hierarchical_tags' ),
    'add_new_item'               => __( 'Add New Tag', 'hierarchical_tags' ),
    'edit_item'                  => __( 'Edit Tag', 'hierarchical_tags' ),
    'update_item'                => __( 'Update Tag', 'hierarchical_tags' ),
    'view_item'                  => __( 'View Tag', 'hierarchical_tags' ),
    'separate_items_with_commas' => __( 'Separate tags with commas', 'hierarchical_tags' ),
    'add_or_remove_items'        => __( 'Add or remove tags', 'hierarchical_tags' ),
    'choose_from_most_used'      => __( 'Choose from the most used', 'hierarchical_tags' ),
    'popular_items'              => __( 'Popular Tags', 'hierarchical_tags' ),
    'search_items'               => __( 'Search Tags', 'hierarchical_tags' ),
    'not_found'                  => __( 'Not Found', 'hierarchical_tags' ),
  );

  register_taxonomy( 'post_tag', 'post', array(
    'hierarchical'              => true, // Was false, now set to true
    'query_var'                 => 'tag',
    'labels'                    => $labels,
    'rewrite'                   => $rewrite,
    'public'                    => true,
    'show_ui'                   => true,
    'show_admin_column'         => true,
    '_builtin'                  => true,
  ) );
});
