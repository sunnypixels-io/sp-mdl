<?php
/**
 * Search for main menu.
 *
 * @link https://codex.wordpress.org/Styling_Theme_Forms
 *
 * @package SP_MDL
 */
?>
<?php do_action( 'sp_mdl_before_searchform' ); ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp">
        <i class="material-icons">search</i>
    </label>
    <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" value="<?php echo get_search_query() ?>" name="s" id="fixed-header-drawer-exp" />
    </div>
</form>
<?php do_action( 'sp_mdl_after_searchform' ); ?>
