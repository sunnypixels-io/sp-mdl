<?php
/**
 * The template part for displaying the header simple style
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Material_Design_Lite
 */
global $post;
$header_style = get_theme_mod('blog_single_header_colorful_title', false) ? ' sp-mdl-header--colorful ' . sp_mdl_get_header_bg_color('mdl-color--') : '';
?>

<div class="sp-mdl-header sp-mdl-header--simple<?php echo $header_style; ?>">

    <div class="mdl-card__title">
        <header>
            <?php the_title(sprintf('<h2 class="mdl-card__title-text">', '</h2>')); ?>
        </header>

        <?php sp_mdl_edit_post_link($post->ID); ?>
    </div>

</div>
