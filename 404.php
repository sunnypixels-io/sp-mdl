<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package SP_MDL
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main mdl-grid mdl-site-main mdl-site-main--404" role="main">

            <div class="mdl-cell mdl-cell--7-col mdl-cell--12-col-tablet">

                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'sp-mdl' ); ?></h1>
                    </header><!-- .page-header -->

                    <div class="page-content">
                        <p><?php _e( 'It looks like nothing was found at this location.', 'sp-mdl' ); ?></p>

                        <br>
                        <br>

                        <p>
                            <a href="<?php home_url(); ?>" class="mdl-button mdl-js-button mdl-button--raised ">
                                <i class="material-icons">home</i>
                                <?php _e('take me home', 'sp-mdl'); ?>
                            </a>
                        </p>

                    </div><!-- .page-content -->
                </section><!-- .error-404 -->

            </div>

            <div class="mdl-cell mdl-cell--5-col mdl-cell--12-col-tablet">
                <div class="broken-robot-wrap">
                    <?php require_once get_template_directory() . '/assets/imgs/broken-robot.svg'; ?>
                </div>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
