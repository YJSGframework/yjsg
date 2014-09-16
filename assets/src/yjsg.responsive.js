/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # Authors - Dragan Todorovic and Constantin Boiangiu                 ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
(function ($) {
    var YjsgRespond = {
        settings: {
            menuholder: "#mmenu_holder",
            topmenuholder: "#topmenu_holder",
            selectmenu: "#mmenu"
        },
        initialize: function (options) {
            this.options = $.extend({}, this.settings, options);
            YjsgRespond.start();
        },
        start: function () {
            var self = this;
            this.winsize = [];
            YjsgRespond.showMenu();
            YjsgRespond.menuFlip();
        },
        showMenu: function () {
            var self = this;
            if ($(self.settings.menuholder).length > 0) {
                var select_holder = $(self.settings.menuholder);
                var size = YjsgRespond.viewPort().width;
                $(self.settings.topmenuholder).prepend(select_holder);
                $(self.settings.selectmenu).on('change', function () {
                    window.location.href = $(this).val();
                });
            }
        },
        menuFlip: function () {
            var self = this;
            self.winsize["width"] = YjsgRespond.viewPort().width;
            $("ul.yjsgmenu li.haschild").hover(function () {
                $(this).removeClass("flip");
                var findMargin = $('ul.yjsgmenu ul ul').first().css('margin-left');
                var dropWidth = $(this).find('div.ulholder').first().outerWidth(true) + parseInt(findMargin); // ul side push 10px
                ltrOffset = $(this).find('div.ulholder').first().offset().left + dropWidth;
                rtlOffset = self.winsize["width"] - $(this).find('div.ulholder').first().offset().left;
                var offset = ltrOffset;
                if ($("body").hasClass("yjsgrtl")) {
                    offset = rtlOffset;
                }
                if (offset >= self.winsize["width"]) {
                    $(this).addClass("flip");
                }
            }, function () {
                setTimeout(function () {
                    $(this).removeClass("flip");
                }, 300);
            });
        },
        viewPort: function () {
            var e = window,
                a = 'inner';
            if (!('innerWidth' in window)) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return {
                width: e[a + 'Width'],
                height: e[a + 'Height']
            };
        }
    }
    $(document).on('ready', YjsgRespond.initialize);
    $(window).on('resize', function () {
        YjsgRespond.showMenu();
        YjsgRespond.winsize["width"] = YjsgRespond.viewPort().width;
    });
})(jQuery);