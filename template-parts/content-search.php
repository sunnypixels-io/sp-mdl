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

        <div class="mdl-card__media" <?php sp_mdl_postcard_style(get_the_ID()); ?>>

            <?php sp_mdl_edit_post_link(get_the_ID()); ?>

            <header>
                <?php the_title(sprintf('<h3><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
            </header><!-- .entry-header -->
        </div>

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

