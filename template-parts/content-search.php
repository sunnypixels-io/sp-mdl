<?php
/**
 * The template part for displaying results in search pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material_Design_Lite
 */

?>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php get_template_part( 'template-parts/header/entries', get_theme_mod('blog_entries_header_style', 'modern') ); ?>

        <div class="entry-summary mdl-color-text--grey-600 mdl-card__supporting-text">
            <?php the_excerpt(); ?>
        </div><!-- .entry-summary -->

        <footer class="entry-footer meta mdl-card__actions mdl-card--border">

            <div class="avatar-img">
                <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
            </div>

            <?php if ('post' == get_post_type()) : ?>
                <div class="entry-meta">
                    <?php sp_mdl_posted_on(); ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>

        </footer><!-- .entry-footer -->

    </article><!-- #post-## -->
</div> <!-- .mdl-cell -->

