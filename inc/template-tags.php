<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Material_Design_Lite
 */

if (!function_exists('sp_mdl_posts_navigation')) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function sp_mdl_posts_navigation()
    {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="mdl-post-navigation mdl-color-text--grey-50 mdl-cell mdl-cell--12-col" role="navigation">

            <?php
            if (get_previous_posts_link()) :
                previous_posts_link(sprintf(
                    __('%s Newer', 'material-design-lite'),
                    '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">arrow_back</i></button>'
                ));
            endif;
            ?>

            <div class="section-spacer"></div>

            <?php
            if (get_next_posts_link()) :
                next_posts_link(sprintf(
                    __('Older %s', 'material-design-lite'),
                    '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">arrow_forward</i></button>'
                ));
            endif;
            ?>

        </nav><!-- .navigation -->
        <?php
    }
endif;

if (!function_exists('sp_mdl_post_navigation')) :
    /**
     * Display navigation to next/previous post when applicable.
     */
    function sp_mdl_post_navigation()
    {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="mdl-post-navigation mdl-color-text--grey-50 mdl-cell mdl-cell--12-col" role="navigation">
            <?php
            next_post_link('%link', sprintf(
                __('%s Newer', 'material-design-lite'),
                '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">arrow_back</i></button>'
            ));
            previous_post_link('%link', sprintf(
                __('Older %s', 'material-design-lite'),
                '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon"><i class="material-icons">arrow_forward</i></button>'
            ));
            ?>
        </nav><!-- .navigation -->
        <?php
    }
endif;


if (!function_exists('sp_mdl_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function sp_mdl_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x('Posted on %s', 'post date', 'material-design-lite'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

    }
endif;


if (!function_exists('sp_mdl_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function sp_mdl_posted_by()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf($time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            esc_html_x('%s', 'post date', 'material-design-lite'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            esc_html_x('%s', 'post author', 'material-design-lite'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<strong class="byline"> ' . $byline . '</strong> <span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

        // DEFAULT
        //$byline = sprintf(
        ///* translators: %s: post author. */
        //esc_html_x( 'by %s', 'post author', 'material-design-lite' ),
        //	'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        //);
        //echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }
endif;


if (!function_exists('sp_mdl_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function sp_mdl_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' == get_post_type()) {

            if (has_tag()) {
                $tags = get_the_tags();
                $html = '<div class="post_tags">';
                foreach ($tags as $tag) {
                    $tag_link = get_tag_link($tag->term_id);

                    $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='mdl-button mdl-js-button mdl-js-ripple-effect'>";
                    $html .= "{$tag->name}</a>";
                }
                $html .= '</div>';
                echo $html;
            }
        }
    }
endif;


if (!function_exists('sp_mdl_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function sp_mdl_post_thumbnail()
    {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail('post-thumbnail', array(
                    'alt' => the_title_attribute(array(
                        'echo' => false,
                    )),
                ));
                ?>
            </a>

        <?php
        endif; // End is_singular().
    }
endif;


if (!function_exists('sp_mdl_posts_link_attributes')) :
    /**
     * Filter to add class to next/previous navigation links
     */
    function sp_mdl_posts_link_attributes()
    {
        return 'class="mdl-post-navigation__button"';
    }

    add_filter('next_posts_link_attributes', 'sp_mdl_posts_link_attributes');
    add_filter('previous_posts_link_attributes', 'sp_mdl_posts_link_attributes');
endif;


if (!function_exists('sp_mdl_get_postcard_style')) :
    function sp_mdl_post_link_attributes($output)
    {
        $class = 'class="mdl-post-navigation__button"';
        return str_replace('<a href=', '<a ' . $class . ' href=', $output);
    }

    add_filter('next_post_link', 'sp_mdl_post_link_attributes');
    add_filter('previous_post_link', 'sp_mdl_post_link_attributes');
endif;


if (!function_exists('sp_mdl_get_postcard_style')) :
    function sp_mdl_get_postcard_style($post_id)
    {
        if (!$post_id)
            return '';

        $post_type = get_post_type($post_id);

        $styles = 'style="';

        //TODO: add metapost options

        // Gets the stored background color value
        $color_value = get_post_meta($post_id, 'mdl-bg-color', true);

        // Checks and returns the color value
        $styles .= (!empty($color_value) ? 'background-color:' . $color_value . ' !important;' : '');

        // Gets the stored height value
        $height_value = get_post_meta($post_id, 'mdl-height', true);

        // Checks and returns the height value
        $styles .= (!empty($height_value) ? 'height:' . $height_value . ';' : '');

        // Gets the uploaded featured image
        $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
        if ($post_type === 'post' && empty($featured_img) && get_theme_mod('blog_entries_header_bg_image', false)) {
            $featured_img = wp_get_attachment_image_src(get_theme_mod('blog_entries_header_bg_image'), 'full');
        }

        // Checks and returns the featured image
        $styles .= (!empty($featured_img) ? "background-image: url('" . $featured_img[0] . "');" : '');

        $styles .= '"';

        return $styles;
    }
endif;

if (!function_exists('sp_mdl_postcard_style')) :
    function sp_mdl_postcard_style($post_id)
    {
        echo sp_mdl_get_postcard_style($post_id);
    }
endif;



if (!function_exists('sp_mdl_meta_views_button')) :
    // TODO: add option to hide or show this section
    function sp_mdl_meta_views_button()
    {
        ob_start();
        ?>
        <div class="meta__views">
            134 <i class="material-icons" role="presentation">visibility</i>
            <span class="visuallyhidden">visibility</span>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();

        if (get_theme_mod('test', true))
            $content = '';

        echo $content;
    }
    add_action('sp_mdl_meta_views_button', 'sp_mdl_meta_views_button');
endif;


if (!function_exists('sp_mdl_meta_favorites_button')) :
    // TODO: add option to hide or show this section
    function sp_mdl_meta_favorites_button()
    {
        ob_start();
        ?>
        <div class="meta__favorites">
            425 <i class="material-icons" role="presentation">favorite</i>
            <span class="visuallyhidden">favorites</span>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();

        if (get_theme_mod('test', true))
            $content = '';

        echo $content;
    }
    add_action('sp_mdl_meta_favorites_button', 'sp_mdl_meta_favorites_button');
endif;


if (!function_exists('sp_mdl_meta_bookmark_button')) :
    // TODO: add option to hide or show this section
    function sp_mdl_meta_bookmark_button()
    {
        ob_start();
        ?>
        <div class="meta__bookmark mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-js-bookmark-this">
            <i class="material-icons" role="presentation">bookmark</i>
            <span class="visuallyhidden">bookmark</span>
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();

        if (get_theme_mod('test', false))
            $content = '';

        echo $content;
    }
    add_action('sp_mdl_meta_bookmark_button','sp_mdl_meta_bookmark_button');
endif;


if (!function_exists('wp_body_open')) :
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
     */
    function wp_body_open()
    {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
endif;
