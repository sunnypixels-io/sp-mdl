<?php
/**
 * The template part for displaying the main navigation
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SP_MDL
 */

?>

<div class="mdl-layout__header-row">
    <!-- Title -->
    <span class="mdl-layout-title"><?php bloginfo('name'); ?></span>
    <!-- Add spacer, to align navigation to the right -->
    <div class="mdl-layout-spacer"></div>

    <div class="mdl-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
        <?php get_search_form(); ?>
    </div>


    <?php
    $args = array(
        'theme_location' => 'primary',
        'container' => 'nav',
        'items_wrap' => '%3$s',
        'container_class' => 'mdl-navigation mdl-layout--large-screen-only',
        'walker' => new SP_MDL_Nav_Walker()
    );

    if (has_nav_menu('primary')) {
        wp_nav_menu($args);
    }
    ?>

</div>
