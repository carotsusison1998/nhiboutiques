<?php
/**
 * nhiboutiques functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nhiboutiques
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nhiboutiques_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on nhiboutiques, use a find and replace
		* to change 'nhiboutiques' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nhiboutiques', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nhiboutiques' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nhiboutiques_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nhiboutiques_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nhiboutiques_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nhiboutiques_content_width', 640 );
}
add_action( 'after_setup_theme', 'nhiboutiques_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nhiboutiques_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nhiboutiques' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nhiboutiques' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nhiboutiques_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nhiboutiques_scripts() {
	wp_enqueue_style( 'nhiboutiques-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'nhiboutiques-style', 'rtl', 'replace' );

	wp_enqueue_script( 'nhiboutiques-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nhiboutiques_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
require get_template_directory() . '/inc/constants.php';
require get_template_directory() . '/inc/libs.php';
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
 * Add menu
 * ----------------------------------------------------------------------------------------
 */
function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Main menu' ),
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );
/** 
 * ----------------------------------------------------------------------------------------
 * Add js and css
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('fl_scripts')) {
    function fl_scripts() {
        //load css
        wp_enqueue_style('main-css', DEF_STYLE. 'main.css', array(), date('YmdHis'));
        wp_enqueue_style('style-css', DEF_STYLE. 'style.css', array(), date('YmdHis'));
        wp_enqueue_style('jssor-css.slider', DEF_LIBS. 'jssor.slider/jssor.slider.css', array(), date('YmdHis'));
        //load javascript
        wp_enqueue_script('lib-js', DEF_JS. 'libs.js', array());
        wp_enqueue_script('script-js', DEF_JS. 'script.js', array());
        wp_enqueue_script('slider-js', DEF_LIBS. 'jssor.slider/jssor.slider-28.0.0.min.js', array());
    }
    add_action ( 'wp_enqueue_scripts', 'fl_scripts' );
}
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
            'post_type' => 'slider_cpt',
            'post_type_slug' => '',
            'support_diff' => array_merge($support_diff, array('editor')),
            'post_type_name' => 'slider',
            'post_type_singular_name' => 'slider',
            'menu_icon' => 'dashicons-slides',
            'is_public' => false
        );
        create_custom_post_type($banner_post_type_args);
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

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'Thêm giỏ hàng', 'woocommerce' );
}
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );