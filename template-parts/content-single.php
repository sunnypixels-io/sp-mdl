<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SP_MDL
 */

?>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php get_template_part( 'template-parts/header/post', get_theme_mod('blog_single_header_style', 'modern') ); ?>

        <?php if (get_theme_mod('blog_single_content_header_show', true)) : ?>
            <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
                <div class="avatar-img">
                    <?php echo get_avatar(get_the_author_meta('ID'), 44, '', get_the_author_meta('display_name')); ?>
                </div>

                <?php if ('post' == get_post_type()) : ?>
                    <div class="entry-meta">
                        <?php sp_mdl_posted_by(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>

                <div class="section-spacer"></div>

                <?php do_action('sp_mdl_meta_views_button'); ?>
                <?php do_action('sp_mdl_meta_favorites_button'); ?>
                <?php do_action('sp_mdl_meta_bookmark_button'); ?>

                <?php do_action('sp_mdl_share_buttons_top'); ?>
            </div>
        <?php endif; ?>

        <div class="entry-content mdl-color-text--grey-600 mdl-card__supporting-text">
            <div class="entry-content__inner">
                <?php the_content(); ?>
            </div>
        </div><!-- .entry-content -->

        <?php
        wp_link_pages(array(
            'before' => '<div class="mdl-page-links mdl-card__actions mdl-card--border"><span class="mdl-button mdl-js-button entry-page-links__title" disabled>' . esc_html__('Pages:', 'sp-mdl') . '</span>',
            'after' => '</div>',
            'link_before' => '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">',
            'link_after' => '</button>',
        ));
        ?>

        <?php if (has_tag()) : ?>
            <footer class="entry-footer mdl-card__actions mdl-card--border">
                <?php sp_mdl_entry_footer(); ?>
            </footer><!-- .entry-footer -->
        <?php endif; ?>

        <?php do_action('sp_mdl_share_buttons_footer'); ?>

    </article><!-- #post-## -->

    <?php do_action('sp_mdl_before_comments'); ?>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>

    <?php do_action('sp_mdl_after_comments'); ?>

</div><!-- .mdl-cell -->

