<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Material_Design_Lite
 */

?>
<!doctype html>
<html class="<?php echo esc_attr(sp_mdl_html_classes()); ?>" <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php do_action('sp_mdl_after_opening_body'); ?>

    <div id="page" class="hfeed site mdl-layout mdl-js-layout mdl-layout--fixed-header">

        <header id="masthead" class="site-header mdl-layout__header" role="banner">

            <?php do_action('sp_mdl_after_opening_header'); ?>

            <?php get_template_part('template-parts/nav', 'main'); ?>

            <?php do_action('sp_mdl_before_closing_header'); ?>

        </header>

    <?php get_template_part('template-parts/nav', 'drawer'); ?>

        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'material-design-lite' ); ?></a>

        <main class="mdl-layout__content">
            <div id="content" class="site-content">

    <?php do_action('sp_mdl_after_opening_content'); ?>

