<?php
/**
 * Register and load the widget
 */

require get_template_directory() . '/inc/widgets/footer-menu.php';

function sp_mdl_load_widget()
{
    register_widget('MaterialDesignLite_Widget_FooterMenu');
}

add_action('widgets_init', 'sp_mdl_load_widget');
