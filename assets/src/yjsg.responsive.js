/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
;
(function($, window, document, undefined) {

    "use strict";

    var pluginName = "YjsgRespond",
        defaults = {
            menuholder: "#mmenu_holder",
            topmenuholder: "#topmenu_holder",
            selectmenu: "#mmenu"
        };

    function Plugin(element, options) {
        this.element = element;

        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }


    $.extend(Plugin.prototype, {
        init: function() {

            var self = this;
            this.windowWidth = self.getWindowWidth();
            self.showMenu();
            self.menuFlip();

        },

        onResize: function() {
            var self = this;
            self.windowWidth = self.getWindowWidth();
        },
		
        getWindowWidth: function() {
			
			var self = this;
			var width = window.innerWidth
			|| document.documentElement.clientWidth
			|| document.body.clientWidth;
			
			return width;
        },
		
        showMenu: function() {
            var self = this;
            if ($(self.settings.menuholder).length > 0) {
                var select_holder = $(self.settings.menuholder);
                $(self.settings.topmenuholder).prepend(select_holder);
                $(self.settings.selectmenu).on('change', function() {
                    window.location.href = $(this).val();
                });
            }
        },
		
        menuFlip: function() {
            var self = this;
            self.windowWidth = self.getWindowWidth();
            $("ul.yjsgmenu li.haschild").hover(function() {
                $(this).removeClass("flip");
                var findMargin = $('ul.yjsgmenu ul ul').first().css('margin-left');
                var dropWidth = $(this).find('div.ulholder').first().outerWidth(true) + parseInt(findMargin); // ul side push 10px
                var ltrOffset = $(this).find('div.ulholder').first().offset().left + dropWidth;
                var rtlOffset = self.windowWidth - $(this).find('div.ulholder').first().offset().left;
                var offset = ltrOffset;
                if ($("body").hasClass("yjsgrtl")) {
                    offset = rtlOffset;
                }
                if (offset >= self.windowWidth) {
                    $(this).addClass("flip");
                }
            }, function() {
                setTimeout(function() {
                    $(this).removeClass("flip");
                }, 300);
            });
        }
    });

    $.fn[pluginName] = function(options) {
        return this.each(function() {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            } else if (Plugin.prototype[options]) {
                $.data(this, 'plugin_' + pluginName)[options]();
            }
        });
    }

})(jQuery, window, document);


(function($) {
    $(document).on('ready', function() {
        $(document).YjsgRespond();
    });

    $(window).on('resize', function() {
        $(document).YjsgRespond('onResize');
    });

}(jQuery));