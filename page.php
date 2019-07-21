<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SP_MDL
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main mdl-grid mdl-site-main" role="main">

            <?php do_action('sp_mdl_before_content'); ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('template-parts/content', 'page'); ?>

            <?php endwhile; // End of the loop. ?>

            <?php do_action('sp_mdl_after_content'); ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();
