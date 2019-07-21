<?php
/**
 * The template part for displaying the header modern style
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SP_MDL
 */
?>

<div class="sp-mdl-header sp-mdl-header--modern">

    <div class="mdl-card__media <?php sp_mdl_header_bg_color('mdl-color--'); ?>" <?php sp_mdl_postcard_style(get_the_ID()); ?>>

        <?php sp_mdl_edit_post_link(get_the_ID()); ?>

        <header>
            <?php the_title('<h3><a href="' . get_permalink() . '">', '</a></h3>'); ?>
        </header>

    </div>

</div>
