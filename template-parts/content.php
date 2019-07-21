<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SP_MDL
 */

?>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php get_template_part( 'template-parts/header/entries', get_theme_mod('blog_entries_header_style', 'modern') ); ?>

        <div class="entry-content mdl-color-text--grey-600 mdl-card__supporting-text">
            <?php
            if (get_theme_mod('blog_entries_content_excerpt', false)) :
                echo mb_substr(get_the_excerpt(), 0, get_theme_mod('blog_entries_content_excerpt_substr', 500)) . '...';
                echo sp_mdl_modify_read_more_link();
            else :
                the_content(sprintf(
                /* translators: %s: Name of current post. */
                    wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'sp-mdl'), array('span' => array('class' => array()))),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ));
            endif;
            ?>
        </div><!-- .entry-content -->

        <?php
        if (!get_theme_mod('blog_entries_content_excerpt', false)) :
            wp_link_pages(array(
                'before' => '<div class="mdl-page-links mdl-card__actions mdl-card--border"><span class="mdl-button mdl-js-button entry-page-links__title" disabled>' . esc_html__('Pages:', 'sp-mdl') . '</span>',
                'after' => '</div>',
                'link_before'      => '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">',
                'link_after'       => '</button>',
            ));
        endif;
        ?>

        <?php if (get_theme_mod('blog_entries_entry_footer_show', true) && (get_theme_mod('blog_entries_entry_footer_gravatar_show', true) || get_theme_mod('blog_entries_entry_footer_published_show', true))) : ?>

            <footer class="entry-footer meta mdl-card__actions mdl-card--border">

                <?php if(get_theme_mod('blog_entries_entry_footer_gravatar_show', true)) : ?>
                    <div class="avatar-img">
                        <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                    </div>
                <?php endif; ?>

                <?php if ('post' == get_post_type() && get_theme_mod('blog_entries_entry_footer_published_show', true)) : ?>
                    <div class="entry-meta">
                        <?php sp_mdl_posted_on(); ?>
                    </div><!-- .entry-meta -->
                <?php endif; ?>

            </footer><!-- .entry-footer -->

        <?php endif; ?>

    </article><!-- #post-## -->

</div><!-- .mdl-cell -->

