<?php

/**
 * one page converter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dro_one_page_converter
 */
if (!function_exists('dro_one_page_converter_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function dro_one_page_converter_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on one page converter, use a find and replace
         * to change 'dro-one-page-converter' to the name of your theme in all the template files.
         */
        load_theme_textdomain('dro-one-page-converter', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /*
         * This theme uses wp_nav_menu() in tow location.
         * The First is the main menu for all website pages.
         * The second menu (Front page) will be visible 
         */
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'dro-one-page-converter')
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }

endif;
add_action('after_setup_theme', 'dro_one_page_converter_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dro_one_page_converter_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('dro_one_page_converter_content_width', 640);
}

add_action('after_setup_theme', 'dro_one_page_converter_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dro_one_page_converter_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar Right', 'dro-one-page-converter'),
        'id' => 'sidebar-right',
        'description' => esc_html__('Add widgets here.', 'dro-one-page-converter'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'dro_one_page_converter_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function dro_one_page_converter_scripts() {
    /**
     * CSS
     */
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css');
    wp_enqueue_style('ionicons', get_template_directory_uri() . '/assets/ionicons/css/ionicons.css');
    wp_enqueue_style('dro-one-page-converter-mobile-menu', get_template_directory_uri() . '/layouts/dro-sliding-menu.css');
    wp_enqueue_style('dro-one-page-converter-style', get_stylesheet_uri());
    if(is_active_sidebar('sidebar-right')){
        wp_enqueue_style('dro-one-page-converter-layoout-style', get_template_directory_uri() . '/layouts/content-sidebar.css');
    }
    if (is_page_template()) {
        wp_enqueue_style('dro-one-page-converter-one-page-css', get_template_directory_uri() . '/layouts/dro-one-page-converter.css');
    }
    /**
     * Fonts
     */
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.css');

    /**
     * JS
     */
    wp_enqueue_script('dro-one-page-converter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20180511', true);
    wp_enqueue_script('dro-one-page-converter-dro-sliding-menu', get_template_directory_uri() . '/js/dro-sliding-menu.js', array('jquery'), '20181211', true);
    wp_enqueue_script('dro-one-page-converter-js', get_template_directory_uri() . '/js/dro-one-page-converter.js', array('dro-one-page-converter-dro-sliding-menu'), '20181211', true);
    wp_enqueue_script('dro-one-page-converter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20181211', true);
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    if (!is_front_page()) {
        wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '20181014', true);
        wp_enqueue_script('dro-one-page-converter-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('dro-one-page-converter-superfish'), '20181014', true);
    }
    if (is_page_template('one-page/tpl-onepage.php')) {
        wp_enqueue_script('dro-one-page-converter-front-js', get_template_directory_uri() . '/js/dro-one-page-converter-front.js', array('jquery', 'dro-one-page-converter-dro-sliding-menu'), '20181211', true);
    }
    

}

add_action('wp_enqueue_scripts', 'dro_one_page_converter_scripts');

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
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load the Front Page Class
 */
function dro_one_page_converter_class_frontpage() {
    if (is_page_template('one-page/tpl-onepage.php')) {
        require get_template_directory() . '/inc/class-dro-one-page-converter-frontpage.php';
    }
}

add_action('template_redirect', 'dro_one_page_converter_class_frontpage');

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function dro_one_page_converter_front_page_template($template) {
    return is_home() ? '' : $template;
}

add_filter('frontpage_template', 'dro_one_page_converter_front_page_template');

/**
 * display a notice : how to use the theme
 */
add_action('admin_notices', 'dro_one_page_converter_notice');

function dro_one_page_converter_notice() {

    global $pagenow;
    $github_readme = esc_url('https://github.com/younes-dro/dro-one-page-converter');

    if (is_admin() && $pagenow == 'themes.php') {
        echo '<div class="notice notice-info is-dismissible"><p>';
        printf(
                esc_html__('Please visit this link %1s to understand how the conversion to OnePage works.', 'dro-one-page-converter')
                , sprintf(
                        '<a href="%s">%s</a>', $github_readme, esc_html__('README', 'dro-one-page-converter')
                )
        ); // WPCS: XSS OK.
        
        echo '</p></div>';
    }
}

