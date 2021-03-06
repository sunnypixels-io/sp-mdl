<?php
/**
 * The template part for displaying the header classic style
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SP_MDL
 */

$header_style = has_post_thumbnail() ? 'classic' : 'simple';
if (get_theme_mod('blog_entries_header_colorful_title', false))
    $header_style .= ' sp-mdl-header--colorful ' . sp_mdl_get_header_bg_color('mdl-color--');
?>

<div class="sp-mdl-header sp-mdl-header--<?php echo $header_style; ?>">

    <div class="mdl-card__title">
        <header>
            <?php the_title('<h2 class="mdl-card__title-text"><a href="' . get_permalink() . '">', '</a></h2>'); ?>
        </header>

        <?php sp_mdl_edit_post_link(get_the_ID()); ?>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="mdl-card__media <?php sp_mdl_header_bg_color('mdl-color--'); ?>" <?php sp_mdl_postcard_style(get_the_ID()); ?>>
            <?php sp_mdl_edit_post_link(get_the_ID()); ?>
        </div>
    <?php endif; ?>

</div>
