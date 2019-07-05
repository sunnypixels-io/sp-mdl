<?php
/**
 * Material Design Lite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Material_Design_Lite
 */

if (!defined('SP_MDL_DEBUG'))
    define('SP_MDL_DEBUG', false);

if (!function_exists('sp_mdl_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function sp_mdl_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Material Design Lite, use a find and replace
         * to change 'material-design-lite' to the name of your theme in all the template files.
         */
        load_theme_textdomain('material-design-lite', get_template_directory() . '/languages');

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

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'material-design-lite'),
            'drawer' => esc_html__('Drawer Menu', 'material-design-lite'),
            'footer' => esc_html__('Footer Menu', 'material-design-lite')
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

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('sp_mdl_custom_background_args', array(
            'default-color' => '#F5F5F5',
            'default-image' => '',
        )));

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
add_action('after_setup_theme', 'sp_mdl_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sp_mdl_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('sp_mdl_content_width', 900);
}

add_action('after_setup_theme', 'sp_mdl_content_width', 0);

function sp_mdl_theme_custom_css()
{
    $content_width = get_theme_mod('section_content_width', $GLOBALS['content_width']);
    $content_inner_width = get_theme_mod('section_content_inner_width', 512);
    $accent_color = sp_mdl_color_wheel('accent')[sp_mdl_get_accent_color()];

    $custom_css = '
        .mdl-site-main, .mdl-site-aside {
            max-width: ' . $content_width . 'px;
        }
        
        .single-post .entry-content .entry-content__inner {
            max-width: ' . $content_inner_width . 'px;
		}
		
		.mdl-site-main.mdl-site-main--404 .broken-robot-wrap .broken-robot {
		    fill: ' . $accent_color . ';
		}
    ';

    $custom_css .= apply_filters('sp_mdl_theme_custom_css', '');

    return $custom_css;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sp_mdl_widgets_init()
{
    // TODO: temporary disabled, not sure do we really need a sidebar or maybe made a specific sidebar layout
    //register_sidebar(array(
    //    'name' => esc_html__('Sidebar', 'material-design-lite'),
    //    'id' => 'sidebar-1',
    //    'description' => esc_html__('Add widgets here.', 'material-design-lite'),
    //    'before_widget' => '<section id="%1$s" class="widget mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp %2$s">',
    //    'after_widget' => '</section>',
    //    'before_title' => '<div class="mdl-card__title ' . sp_mdl_get_header_bg_color('mdl-color--') . '"><h2 class="widget-title mdl-card__title-text">',
    //    'after_title' => '</div></h2>',
    //));

    register_sidebar(array(
        'name' => esc_html__('Footer 1', 'material-design-lite'),
        'id' => 'footer-1',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="mdl-mega-footer__drop-down-section footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="mdl-mega-footer__heading footer-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 2', 'material-design-lite'),
        'id' => 'footer-2',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="mdl-mega-footer__drop-down-section footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="mdl-mega-footer__heading footer-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 3', 'material-design-lite'),
        'id' => 'footer-3',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="mdl-mega-footer__drop-down-section footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="mdl-mega-footer__heading footer-title">',
        'after_title' => '</h1>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer 4', 'material-design-lite'),
        'id' => 'footer-4',
        'description' => '',
        'before_widget' => '<div id="%1$s" class="mdl-mega-footer__drop-down-section footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h1 class="mdl-mega-footer__heading footer-title">',
        'after_title' => '</h1>',
    ));
}

add_action('widgets_init', 'sp_mdl_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function sp_mdl_scripts()
{
    $min = sp_mdl_scripts_postfix();

    $primary = sp_mdl_get_primary_color();
    $accent = sp_mdl_get_accent_color();

    // optional for page speed performance
    $cdnjs_cloudflare = get_theme_mod('cdnjs_cloudflare', false);

    if ($cdnjs_cloudflare) {
        wp_enqueue_style('mdl-css', 'https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.' . $primary . '-' . $accent . '.min.css', array(), '1.3.0');
        wp_enqueue_style('mdl-icons', 'https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css', array(), '3.0.1');
        wp_enqueue_script('mdl-js', 'https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.3.0/material.min.js', array(), '1.3.0', true);
    } else {
        wp_enqueue_style('mdl-css', 'https://storage.googleapis.com/code.getmdl.io/1.3.0/material.' . $primary . '-' . $accent . '.min.css', array(), '1.3.0');
        wp_enqueue_style('mdl-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
        wp_enqueue_script('mdl-js', 'https://storage.googleapis.com/code.getmdl.io/1.3.0/material.min.js', array(), '1.3.0', true);
    }

    wp_enqueue_style('google-fonts-roboto', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700');

    //wp_enqueue_style( 'material-design-lite-style', get_stylesheet_uri() ); // I don't like a classic way for CSS
    wp_enqueue_style('sp-mdl-style', get_template_directory_uri() . '/assets/css/material-design-lite' . $min . '.css', array(), sp_mdl_theme_version()); // already minifed ;) but we have MAP file
    wp_add_inline_style('sp-mdl-style', sp_mdl_theme_custom_css());

    wp_enqueue_script('sp-mdl-scripts', get_template_directory_uri() . '/assets/js/material-design-lite' . $min . '.js', array('jquery'), sp_mdl_theme_version(), true);
    wp_localize_script('sp-mdl-scripts','MDL_CONFIG', sp_mdl_localize_script('public'));

    wp_enqueue_script('sp-mdl-navigation', get_template_directory_uri() . '/assets/js/navigation' . $min . '.js', array(), sp_mdl_theme_version(), true);
    wp_enqueue_script('sp-mdl-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $min . '.js', array(), sp_mdl_theme_version(), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'sp_mdl_scripts');


/**
 * Enqueue scripts and styles.
 */
function sp_mdl_admin_scripts()
{
    $min = sp_mdl_scripts_postfix();

    if (is_admin()) {
        // Enqueue jQuery UI and autocomplete
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-autocomplete' );

        wp_enqueue_style('sp-mdl-admin', get_template_directory_uri() . '/assets/css/admin' . $min . '.css', array(), sp_mdl_theme_version());

        wp_enqueue_script('sp-mdl-js-admin', get_template_directory_uri() . '/assets/js/admin' . $min . '.js', array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'), sp_mdl_theme_version(), true);
        wp_localize_script('sp-mdl-js-admin','MDL_ADMIN_CONFIG', sp_mdl_localize_script('admin'));
    }
}

add_action('admin_enqueue_scripts', 'sp_mdl_admin_scripts');

/**
 * Register the required plugins for this theme.
 */
require get_template_directory() . '/inc/plugins/required-plugins.php';

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
 * Theme information page.
 */
require get_template_directory() . '/inc/theme-information.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-kirki.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom walker menu
 */
require get_template_directory() . '/inc/nav-walker.php';

/**
 * Register the required widgets for this theme.
 */
require get_template_directory() . '/inc/widgets/register-widgets.php';

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require get_template_directory() . '/inc/woocommerce.php';
}
