<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    // Add Ajax URLs
    $ajax_params = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'ajax_nonce' => wp_create_nonce( 'my_nonce' ), 
      );
    wp_localize_script( 'sage/main.js', 'ajax_object', $ajax_params);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

// New Footer Menu
add_action( 'after_setup_theme', function() {
    register_nav_menu( 'footer', __( 'Footer Menu' ) );
  } );

  //Allow audio metadat functions
require_once( ABSPATH . 'wp-admin/includes/media.php' );


// Random episode fetch

function get_random_post() {
    // Query Arguments
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'episodes',
        'orderby' => 'rand',
        'post_per_page' => 1
    );

    // The Query
    $ajaxposts = get_posts( $args );
    $episode = (object)[
        'title' => 'EPISODE ' . get_field('episode_number', $ajaxposts[0]->ID) . ': ' . $ajaxposts[0]->post_title,
        'audio' => get_field('episode_audio', $ajaxposts[0]->ID), 
        'ID' => $ajaxposts[0]->ID,
        'permalink' => get_permalink($ajaxposts[0]->ID),
    ];
    echo json_encode( $episode );
    exit;
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_random_post',  __NAMESPACE__ . '\\get_random_post');
add_action('wp_ajax_nopriv_get_random_post',  __NAMESPACE__ . '\\get_random_post');

/////////////////////////
// GET next episode
/////////////////////////
function get_next_episode() {
    $ID = $_POST['ID'];
    
    global $post;
    $post = get_post( $ID );
    setup_postdata( $post );
    $next_post = get_previous_post();
    // Query Arguments
    $episode = (object)[
        'title' => 'EPISODE ' . get_field('episode_number', $next_post->ID) . ': ' . $next_post->post_title,
        'audio' => get_field('episode_audio', $next_post->ID),
        'ID' => $next_post->ID,
        'permalink' => get_permalink($next_post->ID),
    ];
    echo json_encode( $episode );
    exit;
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_next_post',  __NAMESPACE__ . '\\get_next_episode');
add_action('wp_ajax_nopriv_get_next_post',  __NAMESPACE__ . '\\get_next_episode');
