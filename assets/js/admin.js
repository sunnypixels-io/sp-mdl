/**
 * File admin.js.
 * Theme WP dashboard scripts
 */

(function ($) {

    // for widgets area
    $(document).on('click','.js-mdl--footer-menu--add-fields', function (e) {
        var parent = $(e.target).parent().get(0);
        $(parent).find('.js-mdl--footer-menu--field.hidden').first().removeClass('hidden');
    });

    $(document).on('change', '.widget', function () {
        // timeout to be sure page is refreshed
        setTimeout(mdl_autocomplete_widgets, 1000);
    });

    function mdl_autocomplete_widgets() {
        $(document).find('input.js-mdl--autocomplete-footer-menu-link').autocomplete({
            source: MDL_ADMIN_CONFIG.autocompiteSource,
            minLength: 3,
            select: function (event, ui) {
                var titleInput = $(event.target).parent().find('.js-mdl--autocomplete-footer-menu-title').get(0);
                $(titleInput).attr('value', ui.item.label);
            }
        });
    }

    mdl_autocomplete_widgets();

})(jQuery);


