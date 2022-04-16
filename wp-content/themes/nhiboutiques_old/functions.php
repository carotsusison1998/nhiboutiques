<?php
/**
 * functions.php
 * Auth: Lytran
 * Defines the functions for the template
 */
require get_template_directory() . '/inc/constants.php';
require get_template_directory() . '/inc/libs.php';
require get_template_directory() . '/inc/custom-metabox.php';
require get_template_directory() . '/inc/harai-common.php';
// require get_template_directory() . '/inc/frontend/register.php';
require get_template_directory() . '/inc/frontend/harai-users.php';
// require get_template_directory() . '/inc/admin/register/register.php';
/**
 * ----------------------------------------------------------------------------------------
 * JS Base url
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('fl_header_extra')) {
    function fl_header_extra()
    {
        echo '<script>
            var baseUrl = "' . site_url() . '";
            var ajaxUrl = "' . site_url() . '/wp-admin/admin-ajax.php?action=";
        </script>';
    }
    add_action('wp_head', 'fl_header_extra');
}

/**
 * ----------------------------------------------------------------------------------------
 * Set up theme default and register various supported features.
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('fl_setup')) {
    function fl_setup() {
        /**
         * Add support for automatic feed links.
         */
        add_theme_support('automatic-feed-links');
        /**
         * Add support for post thumbnails.
         */
        add_theme_support('post-thumbnails');
        /*
        * Add post format function
        */
        add_theme_support('post-formats',
            array(
                'image',
                'video',
                'gallery',
                'quote',
                'link'
            )
        );
        //Sign up menu
        register_nav_menus ( array (
            'main-menu' => __ ( 'Main Menu', TEXTDOMAIN )
        ));
        register_nav_menus ( array (
            'top-menu' => __ ( 'Top Menu', TEXTDOMAIN )
        ));
    }
    add_action ( 'after_setup_theme', 'fl_setup' );
}

/**
 * ----------------------------------------------------------------------------------------
 * Add the active class to the menu
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('special_nav_class')) {
    function special_nav_class($classes, $item)
    {
        global $post;
        if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes)) {
            $classes[] = 'active ';
        }
        return $classes;
    }
    add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);
}

/**
 * ----------------------------------------------------------------------------------------
 * Create a sidebar for the theme
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('fl_widget_init')) {
    function fl_widget_init()
    {
        if (function_exists('register_sidebar')) {
            //sidebar copy right
            register_sidebar( array(
                'name' => 'Footer',
                'id'            => 'sidebar-footer',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<!-- ',
                'after_title'   => ' -->',
            ));
            //sidebar social
            register_sidebar( array(
                'name' => 'Social',
                'id'            => 'sidebar-social',
                'before_widget' => '',
                'after_widget'  => '',
                'before_title'  => '<!-- ',
                'after_title'   => ' -->',
            ));
        }
    }
    add_action('widgets_init', 'fl_widget_init');
}

/*
* The function executes after WordPress has finished loading the page
*/
if (!function_exists('fl_init')) {
    function fl_init() {
        //Removes unused functions for custom post types
        $support_diff = array(
            'excerpt',
            'comments',
            'trackbacks',
            'revisions',
            'custom-fields'
        );
        //Banners home page
        $banner_post_type_args = array(
            'post_type' => 'banner_cpt',
            'post_type_slug' => '',
            'support_diff' => array_merge($support_diff, array('editor')),
            'post_type_name' => 'バナー',
            'post_type_singular_name' => 'バナー',
            'menu_icon' => 'dashicons-pressthis',
            'is_public' => false
        );
        // create_custom_post_type($banner_post_type_args);
        // //What’s New
        // $what_new_post_type_args = array(
        //     'post_type' => 'what_news_cpt',
        //     'post_type_slug' => 'what-new',
        //     'post_type_name' => 'What’s New',
        //     'post_type_singular_name' => 'What’s New',
        //     'menu_icon' => 'dashicons-format-aside'
        // );
        // create_custom_post_type($what_new_post_type_args);
        // //New
        // $news_post_type_args = array(
        //     'post_type' => 'news_cpt',
        //     'post_type_slug' => 'new-column',
        //     'post_type_name' => '新着コラム',
        //     'post_type_singular_name' => '新着コラム',
        //     'menu_icon' => 'dashicons-format-aside'
        // );
        // create_custom_post_type($news_post_type_args);
        // //organization
        // $organization_post_type_args = array(
        //     'post_type' => 'organization_cpt',
        //     'post_type_slug' => 'organization',
        //     'post_type_name' => '組織について',
        //     'post_type_singular_name' => '組織について',
        //     'menu_icon' => 'dashicons-format-aside'
        // );
        // create_custom_post_type($organization_post_type_args);
        // //Instructor introduction
        // $instructor_introduction_post_type_args = array(
        //     'post_type' => 'instructor_cpt',
        //     'post_type_slug' => 'instructor-introduction',
        //     'post_type_name' => 'インストラクター紹介',
        //     'post_type_singular_name' => 'インストラクター紹介',
        //     'menu_icon' => 'dashicons-format-aside'
        // );
        // create_custom_post_type($instructor_introduction_post_type_args);
        //Hidden menu bar frontend page after logging into admin page
        if (!is_admin()) {
            show_admin_bar(false);
        }
        //Call session
        if(!session_id()) {
            session_start();
        }
        ob_start();
    }
    add_action('init', 'fl_init', 0);
}

/**
 * ----------------------------------------------------------------------------------------
 * Get page information by page template
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('get_page_by_page_template')) {
    function get_page_by_page_template($page_template = null) {
        if (!$page_template) return;
        $args = array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $page_template
        );
        $page = get_pages($args);
        if (empty($page[0])) {
            return;
        }
        $page = $page[0];
        $url = get_page_link($page->ID);
        $page -> url = $url;
        return $page;
    }
}

/**
 * ----------------------------------------------------------------------------------------
 * Add js and css to admin
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('harai_admin_enqueue_scripts')) {
    function harai_admin_enqueue_scripts() {
        if (is_admin()) {
            wp_enqueue_style('harai-admin-css-style', DEF_STYLE. 'admin-style.css', array(), date('YmdHis'));
        }
    }
    add_action('admin_enqueue_scripts', 'harai_admin_enqueue_scripts');
}

/** 
 * ----------------------------------------------------------------------------------------
 * Add js and css
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('fl_scripts')) {
    function fl_scripts() {
        //load css
        wp_enqueue_style('harai-css-jssor.slider', DEF_VENDOR. 'jssor.slider/jssor.slider.css', array(), date('YmdHis'));
        wp_enqueue_style('harai-css-style', DEF_STYLE. 'style.css', array(), date('YmdHis'));
        //load javascript
        wp_enqueue_script('harai-js-jquery-3.3.1', DEF_VENDOR. 'jquery/jquery-3.3.1.min.js', array());
        wp_enqueue_script('harai-js-base64.min', DEF_SCRIPTS. 'base64.min.js', array());
        wp_enqueue_script('harai-js-jquery.validate.min', DEF_SCRIPTS. 'jquery.validate.min.js', array());
        wp_enqueue_script('harai-js-libs', DEF_SCRIPTS. 'libs.js', array());
        wp_enqueue_script('harai-js-fl-http', DEF_SCRIPTS. 'fl-http.js', array());
        wp_enqueue_script('idol-js.swiper', DEF_VENDOR. 'jssor.slider/jssor.slider-28.0.0.min.js', array());
        wp_enqueue_script('harai-js-common', DEF_SCRIPTS. 'common.js', array());
    }
    add_action ( 'wp_enqueue_scripts', 'fl_scripts' );
}

/** 
 * ----------------------------------------------------------------------------------------
 * Display per page for custom post type
 * ----------------------------------------------------------------------------------------
 */
add_filter('edit_posts_per_page', 'harai_custom_posts_per_page', 20, 2);
function harai_custom_posts_per_page( $posts_per_page, $post_type )
{
    $showposts = get_option('posts_per_page');
    if ( 'news_cpt' == $post_type ) {
        return $showposts;
    }
    return $posts_per_page;
}
function override_mce_options($initArray) {
  //$opts = '*[id|name|class|style]';
//   $opts = '*[*]';
//   $initArray['valid_elements'] .= ',' . $opts;
//   $initArray['extended_valid_elements'] .= ',' . $opts;
  return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');