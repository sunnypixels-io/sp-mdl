<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Material_Design_Lite
 */

/**
 * Get theme name
 *
 * @since 1.0.0
 */
function sp_mdl_theme_branding($sanitize = false)
{
    $theme_name = "Material Design Lite";

    if ($sanitize)
        return sanitize_title($theme_name);

    return $theme_name;
}


/**
 * Get theme version
 *
 * @since 1.0.0
 */
function sp_mdl_theme_version()
{
    // Dynamically get version number of the theme stylesheet
    $theme = wp_get_theme('material-design-lite');
    $version = $theme->get('Version');

    return $version;
}

/**
 * Get scripts and styles postfix
 *
 * @since 1.0.0
 */
function sp_mdl_scripts_postfix()
{
    $postfix = (SP_MDL_DEBUG) ? '' : '.min';

    if (defined('SP_DEVELOP_MODE')) {
        $postfix = '.dev';
    }

    return $postfix;
}

/**
 * Adds classes to the html tag
 *
 * @since 1.0.0
 */
function sp_mdl_html_classes()
{
    // Setup classes array
    $classes = array();

    // Main class
    $classes[] = 'html';

    // Set keys equal to vals
    $classes = array_combine($classes, $classes);

    // Apply filters for child theming
    $classes = apply_filters('sp_mdl_html_classes', $classes);

    // Turn classes into space seperated string
    $classes = implode(' ', $classes);

    // Return classes
    return $classes;
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sp_mdl_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}

add_filter('body_class', 'sp_mdl_body_classes');


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sp_mdl_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'sp_mdl_pingback_header');


/**
 * Check is plugin active
 * TODO: this function just for feature releases
 */
function sp_mdl_is_plugin_active($plugin_slug)
{
    switch ($plugin_slug) {
        case 'elementor':
            return class_exists('Elementor\Plugin');
            break;
        case 'woocommerce':
            return class_exists('WooCommerce');
        default:
            // TODO: perhaps include multiple solution
            return false;
            break;
    }
}


/**
 * Store current post ID
 */
function sp_mdl_post_id()
{
    // Default value
    $id = '';

    // If singular get_the_ID
    if (is_singular()) {
        $id = get_the_ID();
    } // Get ID of WooCommerce product archive
    elseif (sp_mdl_is_plugin_active('woocommerce') && is_shop()) {
        $shop_id = wc_get_page_id('shop');
        if (isset($shop_id)) {
            $id = $shop_id;
        }
    } // Posts page
    elseif (is_home() && $page_for_posts = get_option('page_for_posts')) {
        $id = $page_for_posts;
    }

    // Apply filters
    $id = apply_filters('sp_mdl_post_id', $id);

    // Sanitize
    $id = $id ? $id : '';

    // Return ID
    return $id;
}


function sp_mdl_color_wheel($set = 'primary')
{
    $colors = array(
        'red' => '#F44336',
        'pink' => '#E91E63',
        'purple' => '#9C27B0',
        'deep_purple' => '#673AB7',
        'indigo' => '#3F51B5',
        'blue' => '#2196F3',
        'light_blue' => '#03A9F4',
        'cyan' => '#00BCD4',
        'teal' => '#009688',
        'green' => '#4CAF50',
        'light_green' => '#8BC34A',
        'lime' => '#CDDC39',
        'yellow' => '#FFEB3B',
        'amber' => '#FFC107',
        'orange' => '#FF9800',
        'deep_orange' => '#FF5722',
        'brown' => '#795548',
        'grey' => '#9E9E9E',
        'blue_grey' => '#607D8B',
    );

    if ($set === 'accent') {
        unset(
            $colors['brown'],
            $colors['grey'],
            $colors['blue_grey']
        );
    }

    return $colors;
}


function sp_mdl_color_key($hex_code)
{
    $key = array_search($hex_code, sp_mdl_color_wheel());
    return $key;
}


function sp_mdl_get_primary_color()
{
    $color = get_theme_mod('theme_primary_color', '#3F51B5'); // indigo;
    return sp_mdl_color_key($color);
}


function sp_mdl_get_accent_color()
{
    $accent_colors = sp_mdl_color_wheel('accent');

    $primary_color = sp_mdl_get_primary_color();
    $color = get_theme_mod('theme_accent_color', '#E91E63'); // pink
    $accent_color = sp_mdl_color_key($color);

    // MDL not support same color for primary and accent, for this reason we use next color from array
    if ($primary_color === $accent_color) {
        $keys = array_keys($accent_colors);
        $key = array_search($accent_color, $keys);
        $accent_color = isset($keys[$key + 1]) ? $keys[$key + 1] : $keys[0];
    }

    return $accent_color;
}


function sp_mdl_get_random_color($prefix = '', $postfix = '')
{
    $colors = array_keys(sp_mdl_color_wheel());
    $color = str_replace('_', '-', $colors[array_rand($colors)]);

    return $prefix . $color . $postfix;
}


function sp_mdl_header_bg_color($prefix = '', $postfix = '')
{
    echo sp_mdl_get_header_bg_color($prefix, $postfix);
}

function sp_mdl_get_header_bg_color($prefix = '', $postfix = '')
{
    if (get_theme_mod('blog_entries_header_random_bg_color', '1')) {
        return sp_mdl_get_random_color($prefix, $postfix);
    } elseif (get_theme_mod('blog_entries_header_bg_color', false)) {
        $accent_color = get_theme_mod('theme_accent_color', '#E91E63');
        $colors = sp_mdl_color_wheel();
        $color = get_theme_mod('blog_entries_header_bg_color', $accent_color);
        $color = str_replace('_', '-', array_search($color, $colors));
        return $prefix . $color . $postfix;
    } else {
        return $prefix . 'accent';
    }
}

/**
 * Custom Read More Button
 */
function sp_mdl_modify_read_more_link()
{
    ob_start();
    ?>

    <br><br>
    <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect"
       href="<?php echo get_permalink(); ?>"><?php _e('Read More', 'material-design-lite'); ?></a>

    <?php
    $read_more_link = ob_get_contents();
    ob_end_clean();
    return $read_more_link;
}

add_filter('the_content_more_link', 'sp_mdl_modify_read_more_link');


if (!function_exists('sp_mdl_get_source_for_autocomplete')) :
    function sp_mdl_get_source_for_autocomplete()
    {
        $source = array();

        $args = array(
            'post_type' => apply_filters('sp_mdl_autocomplete_source_post_type', array('post', 'page')),
            'post_status' => 'publish',
            'posts_per_page' => -1 // all posts
        );

        if ($posts = get_posts($args)) :
            foreach ($posts as $k => $post) {
                $source[$k]['id'] = $post->ID;
                $source[$k]['label'] = $post->post_title; // The name of the post
                $source[$k]['value'] = get_permalink($post->ID);
            }
        endif;

        return $source;
    }
endif;


if (!function_exists('sp_mdl_edit_post_link')) :
    function sp_mdl_edit_post_link($post_id = 0)
    {
        if ($post_id === 0)
            $post_id = rand(1000, 9999);

        $edit_button = '<i id="sp-tt-' . $post_id . '" class="material-icons">create</i>' .
            '<span class="mdl-tooltip mdl-tooltip--right" data-mdl-for="sp-tt-' . $post_id . '">' .
            sprintf(__('Edit %s', 'material-design-lite'), get_post_type($post_id)) . '</span>';

        edit_post_link($edit_button, '', '', '', 'post-edit-link mdl-button mdl-js-button mdl-button--icon');
    }
endif;


if (!function_exists('sp_mdl_localize_script')) :
    function sp_mdl_localize_script($case)
    {
        switch ($case) {
            case 'public':
                $array = array(
                    'debug' => SP_MDL_DEBUG,
                    'theme' => wp_get_theme()->name,
                    'i18n' => array(
                        'bookmark-alert' => __('Press %s+D to bookmark this page.', 'material-design-lite')
                    )
                );
                break;

            case 'admin':
                $array = array(
                    'debug' => SP_MDL_DEBUG,
                    'autocompiteSource' => sp_mdl_get_source_for_autocomplete()
                );
                break;

            default:
                $array = array();
                break;
        }

        return apply_filters('sp_localize_array', $array);
    }
endif;

/**
 * Comments and pingbacks
 *
 * @since 1.0.0
 */
if (!function_exists('sp_mdl_comment')) :
    function sp_mdl_comment($comment, $args, $depth)
    {
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                // TODO: check it and perhaps refactor
                ?>

                <li <?php comment_class('comment mdl-color-text--grey-700'); ?> id="comment-<?php comment_ID(); ?>">

                <article id="comment-<?php comment_ID(); ?>" class="comment-container">
                    <p><?php esc_html_e('Pingback:', 'material-design-lite'); ?>
                        <span><span itemprop="name"><?php comment_author_link(); ?></span></span> <?php edit_comment_link(esc_html__('(Edit)', 'material-design-lite'), '<span class="edit-link">', '</span>'); ?>
                    </p>
                </article>

                <?php
                break;
            default :
                // Proceed with normal comments.
                global $post;
                ?>

            <li id="comment-<?php comment_ID(); ?>" class="comment-container comment mdl-color-text--grey-700">


                <article <?php comment_class('comment-body'); ?>>

                    <header class="comment__header">

                        <?php echo get_avatar($comment, 48, '', '', array('class' => 'comment__avatar')); ?>

                        <div class="comment__author">
                            <strong><?php printf(esc_html__('%s ', 'material-design-lite'), sprintf('%s', get_comment_author_link())); ?></strong>
                            <span class="comment-meta commentmetadata">
                                <span class="comment-date"><?php comment_date(); // 'j M Y'
                                    ?></span>
                            </span>
                        </div>

                        <?php edit_comment_link('<i class="material-icons">create</i>', '', ''); ?>

                    </header>

                    <div class="comment__text">
                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'material-design-lite'); ?></p>
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>

                    <nav class="comment__actions">


                        <?php
                        comment_reply_link(array_merge($args, array(
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                            'reply_text' => '<i class="material-icons">reply</i>' . __('Reply', 'material-design-lite'),
                            //'reply_to_textz' => '',
                            //'login_text'    => '',
                        )));
                        ?>
                    </nav>

                </article><!-- #comment-## -->

                <?php
                break;
        endswitch; // end comment_type check
    }
endif;


/**
 * Filter for comment reply link
 *
 * @param string $link The HTML markup for the comment reply link.
 * @param array $args An array of arguments overriding the defaults.
 * @param object $comment The object of the comment being replied.
 * @param WP_Post $post The WP_Post object.
 * @return mixed
 *
 * @since 1.0.0
 */
if (!function_exists('sp_mdl_filter_comment_reply_link')) :
    function sp_mdl_filter_comment_reply_link($link)
    {
        $link = str_replace("class='comment-reply-link",
            "class='comment-reply-link mdl-button mdl-js-button mdl-js-ripple-effect", $link);
        return $link;
    }

    add_filter('comment_reply_link', 'sp_mdl_filter_comment_reply_link', 10);
endif;


/**
 * Filter for comment edit link
 *
 * @param string $link The HTML markup for the comment reply link.
 * @param array $args An array of arguments overriding the defaults.
 * @param object $comment The object of the comment being replied.
 * @param WP_Post $post The WP_Post object.
 * @return mixed
 *
 * @since 1.0.0
 */
if (!function_exists('sp_mdl_filter_edit_comment_link')) :
    function sp_mdl_filter_edit_comment_link($link)
    {
        $link = str_replace('class="comment-edit-link',
            'class="comment-edit-link mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon', $link);
        return $link;
    }

    add_filter('edit_comment_link', 'sp_mdl_filter_edit_comment_link', 10);
endif;


/**
 * Filter for comment edit link
 *
 * @param string $link The HTML markup for the comment reply link.
 * @param array $args An array of arguments overriding the defaults.
 * @param object $comment The object of the comment being replied.
 * @param WP_Post $post The WP_Post object.
 * @return mixed
 *
 * @since 1.0.0
 */
if (!function_exists('sp_mdl_filter_cancel_comment_reply_link')) :
    function sp_mdl_filter_cancel_comment_reply_link($link)
    {
        $link = str_replace('id="cancel-comment-reply-link" ',
            'id="cancel-comment-reply-link" class="mdl-button mdl-js-button mdl-js-ripple-effect"', $link);
        return $link;
    }

    add_filter('cancel_comment_reply_link', 'sp_mdl_filter_cancel_comment_reply_link', 10);
endif;


/**
 * Filter for comment edit link
 *
 * @param string $link The HTML markup for the comment reply link.
 * @param array $args An array of arguments overriding the defaults.
 * @param object $comment The object of the comment being replied.
 * @param WP_Post $post The WP_Post object.
 * @return mixed
 *
 * @since 1.0.0
 */
if (!function_exists('sp_mdl_filter_comment_form_logged_in')) :
    function sp_mdl_filter_comment_form_logged_in($args_logged_in)
    {
        $args_logged_in = str_replace('<p class="logged-in-as">',
            '<div class="logged-in-as mdl-cell mdl-cell--12-col ">', $args_logged_in);
        $args_logged_in = str_replace('</p>',
            '</div>', $args_logged_in);

        return $args_logged_in;
    }

    add_filter('comment_form_logged_in', 'sp_mdl_filter_comment_form_logged_in', 10);
endif;


if (get_theme_mod('blog_entries_content_excerpt', false)) :
    function sp_mdl_excerpt_length($length)
    {
        return get_theme_mod('blog_entries_content_excerpt_substr', 55);
    }

    add_filter('excerpt_length', 'sp_mdl_excerpt_length', 999);
endif;