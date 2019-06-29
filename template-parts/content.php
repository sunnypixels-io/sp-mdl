<?php
/**
 * Template part for displaying posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material_Design_Lite
 */

?>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="mdl-card__media <?php sp_mdl_header_bg_color('mdl-color--'); ?>" <?php sp_mdl_postcard_style(get_the_ID()); ?>>

            <?php sp_mdl_edit_post_link(get_the_ID()); ?>

            <header>
                <?php the_title(sprintf('<h3><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
            </header><!-- .entry-header -->
        </div>

        <div class="entry-content mdl-color-text--grey-600 mdl-card__supporting-text">
            <?php
            if (get_theme_mod('section_blog_entries_content_excerpt', false)) :
                echo mb_substr(get_the_excerpt(), 0, get_theme_mod('section_blog_entries_content_excerpt_substr', 500)) . '...';
                echo sp_mdl_modify_read_more_link();
            else :
                the_content(sprintf(
                /* translators: %s: Name of current post. */
                    wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'material-design-lite'), array('span' => array('class' => array()))),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ));
            endif;
            ?>
        </div><!-- .entry-content -->

        <?php
        if (!get_theme_mod('section_blog_entries_content_excerpt', false)) :
            wp_link_pages(array(
                'before' => '<div class="mdl-page-links mdl-card__actions mdl-card--border"><span class="mdl-button mdl-js-button entry-page-links__title" disabled>' . esc_html__('Pages:', 'material-design-lite') . '</span>',
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

