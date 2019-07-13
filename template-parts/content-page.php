<?php
/**
 * The template used for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material_Design_Lite
 */

?>

<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--2dp">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php get_template_part( 'template-parts/header/page', get_theme_mod('blog_pages_header_style', 'modern') ); ?>

        <div class="entry-content mdl-color-text--grey-600 mdl-card__supporting-text">
            <?php the_content(); ?>
        </div><!-- .entry-content -->

        <?php
        wp_link_pages(array(
            'before' => '<div class="mdl-page-links mdl-card__actions mdl-card--border"><span class="mdl-button mdl-js-button entry-page-links__title" disabled>' . esc_html__('Pages:', 'material-design-lite') . '</span>',
            'after' => '</div>',
            'link_before'      => '<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">',
            'link_after'       => '</button>',
        ));
        ?>

    </article><!-- #post-## -->

    <?php do_action( 'sp_mdl_before_comments' ); ?>

    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
    ?>

    <?php do_action( 'sp_mdl_after_comments' ); ?>

</div> <!-- .mdl-cell -->


