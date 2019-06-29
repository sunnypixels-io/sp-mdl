<?php
/**
 * Theme information page
 *
 * @package Material_Design_Lite
 */

if (!function_exists('sp_mdl_theme_information_add_page')) :
    /**
     * Add our theme options page to the admin menu.
     *
     * This function is attached to the admin_menu action hook.
     */
    function sp_mdl_theme_information_add_page()
    {
        $theme_page = add_theme_page(
            __('Theme Information', 'material-design-lite'),   // Name of page
            __('Theme Information', 'material-design-lite'),   // Label in menu
            'edit_theme_options',          // Capability required
            'sp_mdl_theme_information',               // Menu slug, used to uniquely identify the page
            'sp_mdl_theme_information_render_page' // Function that renders the options page
        );
    }

    add_action('admin_menu', 'sp_mdl_theme_information_add_page');
endif;


if (!function_exists('sp_mdl_theme_information_render_page')) :
    /**
     * Renders the Theme Options administration screen.
     */
    function sp_mdl_theme_information_render_page()
    {
        add_action('admin_enqueue_scripts', 'ds_admin_theme_style');
        function ds_admin_theme_style() {
            if (!current_user_can( 'manage_options' )) {
                echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
            }
        }

        ?>
        <div class="wrap mdl-theme-info">
            <h1 class="wp-heading-inline"><?php _e('Material Design Lite - Theme Information', 'material-design-lite'); ?></h1>
            <hr>

            <?php
            // TODO: add tabs: wiki, welcome, plugins, about
            $sp_tgm_theme_plugins = TGM_Plugin_Activation::$instance->plugins;
            foreach ($sp_tgm_theme_plugins as $plugin) {
                echo $plugin['name'];
                echo '<br>';
                echo $plugin['tags'];
                echo '<br>';
                echo '<br>';
            }
            ?>

        </div>
        <?php
    }
endif;


/**
 * Render this page after theme activated
 * @link https://deluxeblogtips.com/redirect-after-activation/
 */
global $pagenow;
if ( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {
    wp_redirect( admin_url( 'themes.php?page=sp_mdl_theme_information' ) );
    exit;
}
