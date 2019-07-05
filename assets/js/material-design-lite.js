/**
 * Material Design Lite
 * Main script
 */

class MDL {

    constructor({
                    debug = false,
                    isEU = false,
                    cookieNotice = false,
                }) {
        this.debug = debug;
        this.isEU = isEU;
        this.cookieNotice = cookieNotice;
    }


    /**
     * Initial base scripts
     */
    _init() {
        this._debugLog('_init() =>', this);
        this._initTriggers();
    }


    /**
     * Debug console output, and show hidden params
     *
     * @param args
     */
    _debugLog(...args) {
        if (this.debug) {
            console.log('🦄 MDL:', ...args);
        }
    }


    /**
     * Initial triggers
     */
    _initTriggers() {
        this._debugLog('_initTriggers()');

        // Bookmarks
        jQuery('.mdl-js-bookmark-this').on('click', function (e) {
            let bookmarkURL = window.location.href;
            let bookmarkTitle = document.title;

            if ('addToHomescreen' in window && addToHomescreen.isCompatible) {
                // Mobile browsers
                addToHomescreen({autostart: false, startDelay: 0}).show(true);
            } else if (window.sidebar && window.sidebar.addPanel) {
                // Firefox <=22
                window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
            } else if ((window.sidebar && /Firefox/i.test(navigator.userAgent)) || (window.opera && window.print)) {
                // Firefox 23+ and Opera <=14
                jQuery(this).attr({
                    href: bookmarkURL,
                    title: bookmarkTitle,
                    rel: 'sidebar'
                }).off(e);
                return true;
            } else if (window.external && ('AddFavorite' in window.external)) {
                // IE Favorites
                window.external.AddFavorite(bookmarkURL, bookmarkTitle);
            } else {
                // TODO: make translatable this text
                let soMany = 10;
                console.log(`This is ${soMany} times easier!`);
                // Other browsers (mainly WebKit & Blink - Safari, Chrome, Opera 15+)
                setTimeout(function () {
                    alert('Press ' + (/Mac/i.test(navigator.platform) ? 'Cmd' : 'Ctrl') + '+D to bookmark this page.');
                }, 500);
            }

            return false;
        });

        // show hidden fields for comment area
        jQuery('.js-sp-mdl-comment-textearea').not('active').on('keyup input', function () {
            setTimeout(function () {
                jQuery('.js-sp-mdl-comment-fields').slideDown('slow');
            }, 300);
        }).addClass('active');

        /**
         * Autoresize textarea
         * @link https://stephanwagner.me/auto-resizing-textarea
         */
        jQuery.each(jQuery('textarea[data-autoresize]'), function () {
            let offset = this.offsetHeight - this.clientHeight;

            let resizeTextarea = function (el) {
                jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
            };
            jQuery(this).on('keyup input', function () {
                resizeTextarea(this);
            }).removeAttr('data-autoresize');
        });
    }

    /**
     * GET requests from links
     *
     * @param {string} param
     * @param {string} url
     * @returns {*}
     */
    _GET(param, url) {
        url = url ? url : window.location.href;
        this._debugLog('_GET() => ', param, url);
        let vars = {};
        url.replace(location.hash, '').replace(/[?&]+([^=&]+)=?([^&]*)?/gi, function (m, key, value) {
            vars[key] = value !== void 0 ? value : '';
        });
        if (param) {
            if (vars[param]) {
                return vars[param];
            } else {
                return null;
            }
        }
        return vars;
    };


    /**
     * Decoding HTML entities with vanilla JavaScript
     *
     * @link https://gomakethings.com/decoding-html-entities-with-vanilla-javascript/
     * @param html
     * @returns {string}
     * @private
     */
    decodeHTML(html) {
        let txt = document.createElement('textarea');
        txt.innerHTML = html;
        return txt.value;
    };

    /**
     * Material Design Light jQuery Modal Dialog
     * @link https://github.com/oRRs/mdl-jquery-modal-dialog
     */
    popup_showLoading() {
        // remove existing loaders
        jQuery('.loading-container').remove();
        jQuery('<div id="orrsLoader" class="loading-container"><div><div class="mdl-spinner mdl-js-spinner is-active"></div></div></div>').appendTo("body");

        componentHandler.upgradeElements(jQuery('.mdl-spinner').get());
        setTimeout(function () {
            jQuery('#orrsLoader').css({opacity: 1});
        }, 1);
    }

    popup_hideLoading() {
        jQuery('#orrsLoader').css({opacity: 0});
        setTimeout(function () {
            jQuery('#orrsLoader').remove();
        }, 400);
    }

    popup_showDialog(options) {
        options = jQuery.extend({
            id: 'mdl-popup-dialog',
            title: null,
            text: null,
            neutral: false,
            negative: false,
            positive: false,
            cancelable: true,
            contentStyle: null,
            onLoaded: false,
            onHidden: false,
            hideOther: true
        }, options);

        if (options.hideOther) {
            // remove existing dialogs
            jQuery('.dialog-container').remove();
            jQuery(document).unbind("keyup.dialog");
        }

        jQuery('<div id="' + options.id + '" class="dialog-container"><div class="mdl-card mdl-shadow--16dp" id="' + options.id + '_content"></div></div>').appendTo("body");
        var dialog = jQuery('#' + options.id);
        var content = dialog.find('.mdl-card');
        if (options.contentStyle != null) content.css(options.contentStyle);
        if (options.title != null) {
            jQuery('<h5>' + options.title + '</h5>').appendTo(content);
        }
        if (options.text != null) {
            jQuery('<p>' + options.text + '</p>').appendTo(content);
        }
        if (options.neutral || options.negative || options.positive) {
            var buttonBar = jQuery('<div class="mdl-card__actions dialog-button-bar"></div>');
            if (options.neutral) {
                options.neutral = jQuery.extend({
                    id: 'neutral',
                    title: 'Neutral',
                    onClick: null
                }, options.neutral);
                var neuButton = jQuery('<button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="' + options.neutral.id + '">' + options.neutral.title + '</button>');
                neuButton.click(function (e) {
                    e.preventDefault();
                    if (options.neutral.onClick == null || !options.neutral.onClick(e))
                        window.MDL.popup_hideDialog(dialog, options.onHidden)
                });
                neuButton.appendTo(buttonBar);
            }
            if (options.negative) {
                options.negative = jQuery.extend({
                    id: 'negative',
                    title: 'Cancel',
                    onClick: null
                }, options.negative);
                var negButton = jQuery('<button class="mdl-button mdl-js-button mdl-js-ripple-effect" id="' + options.negative.id + '">' + options.negative.title + '</button>');
                negButton.click(function (e) {
                    e.preventDefault();
                    if (options.negative.onClick == null || !options.negative.onClick(e))
                        window.MDL.popup_hideDialog(dialog, options.onHidden)
                });
                negButton.appendTo(buttonBar);
            }
            if (options.positive) {
                options.positive = jQuery.extend({
                    id: 'positive',
                    title: 'OK',
                    onClick: null
                }, options.positive);
                var posButton = jQuery('<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="' + options.positive.id + '">' + options.positive.title + '</button>');
                posButton.click(function (e) {
                    e.preventDefault();
                    if (options.positive.onClick == null || !options.positive.onClick(e))
                        window.MDL.popup_hideDialog(dialog, options.onHidden)
                });
                posButton.appendTo(buttonBar);
            }
            buttonBar.appendTo(content);
        }
        componentHandler.upgradeDom();
        if (options.cancelable) {
            dialog.click(function () {
                window.MDL.popup_hideDialog(dialog, options.onHidden);
            });
            jQuery(document).bind("keyup.dialog", function (e) {
                if (e.which == 27)
                    window.MDL.popup_hideDialog(dialog, options.onHidden);
            });
            content.click(function (e) {
                e.stopPropagation();
            });
        }
        setTimeout(function () {
            dialog.css({opacity: 1});
            if (options.onLoaded)
                options.onLoaded();
        }, 1);
    }

    popup_hideDialog(dialog, callback) {
        jQuery(document).unbind("keyup.dialog");
        dialog.css({opacity: 0});
        setTimeout(function () {
            dialog.remove();
            if (callback)
                callback();
        }, 400);
    }

}

window.MDL = new MDL(window.MDL_CONFIG);

window.MDL._init();

