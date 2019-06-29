<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Material_Design_Lite
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main mdl-grid mdl-site-main" role="main">

            <?php do_action( 'sp_mdl_before_content' ); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'single' ); ?>

                <?php do_action( 'sp_mdl_before_pagination' ); ?>

                <?php sp_mdl_post_navigation(); ?>

                <?php do_action( 'sp_mdl_after_pagination' ); ?>

            <?php endwhile; // End of the loop. ?>

            <?php do_action( 'sp_mdl_after_content' ); ?>

        </main><!-- #main -->
    </div><!-- #primary -->


<?php
get_sidebar();
get_footer();
