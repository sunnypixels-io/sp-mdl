<?php
/**
 * The template part for displaying the drawer navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material_Design_Lite
 */

?>

<div class="mdl-layout__drawer">
    <span class="mdl-layout-title"><?php bloginfo('name'); ?></span>
    <?php
    $args = array(
        'theme_location' => 'drawer',
        'container' => 'nav',
        'items_wrap' => '%3$s',
        'container_class' => 'mdl-navigation',
        'walker' => new SP_MDL_Nav_Walker()
    );

    if (has_nav_menu('drawer')) {
        wp_nav_menu($args);
    }
    ?>
</div>
