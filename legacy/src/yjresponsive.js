/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
(function ($) {

    var YjsgRespond = {

        settings: {
            menuholder: "#mmenu_holder",
            topmenuholder: "#topmenu_holder",
            selectmenu: "#mmenu",
            logo: "#logo",
            header: "#header",
            headergid: "#yjsgheadergrid"

        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgRespond.start();

        },

        start: function () {

            var self = this;
            this.winsize = [];

            YjsgRespond.siteResize();
            YjsgRespond.showMenu();
            YjsgRespond.logoResize();
            YjsgRespond.menuFlip();

        },
        showMenu: function () {

            var self = this;

            if ($(self.settings.menuholder).length > 0) {

                var select_holder = $(self.settings.menuholder);
                var size = YjsgRespond.viewPort().width;
				if (!$(self.settings.topmenuholder).find(select_holder).length) {
                	$(self.settings.topmenuholder).prepend(select_holder);
				}
                $(self.settings.selectmenu).on('change', function () {
                    window.location.href = $(this).val();
                });

                if (size < 980) {
                    $('.top_menu,.top_menu_poz').removeClass('showmenu');
                    $(self.settings.menuholder).css('display', 'block');
                } else {
                    $(self.settings.menuholder).css('display', 'none');
                    $('.top_menu,.top_menu_poz').addClass('showmenu');
                }
                if (size > 980) {
                    $(self.settings.menuholder).css('display', 'none');
                    $('.top_menu,.top_menu_poz').removeClass('showmenu');
                }

            }
        },

        roundNumber: function (num, dec) {

            var self = this;
            var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
            return result;

        },
        logoResize: function () {

            var self = this;

            var logo_out = YjsgRespond.roundNumber(logo_w / $(self.settings.header).width() * 100, 2);
            var grid_w = YjsgRespond.roundNumber(100 - logo_out, 2);
            if ($(self.settings.logo).length > 0) {
                $(self.settings.logo).css('width', logo_out + '%');
            }
            if ($(self.settings.headergid).length > 0) {
                $(self.settings.headergid).css('width', grid_w + '%');
            }
        },
        siteResize: function () {

            var self = this;
            var size = YjsgRespond.viewPort().width;

            if (size < 980) {
                $(self.settings.logo).addClass('lfloat');
                $(self.settings.topmenuholder).addClass('dropped');
                $(self.settings.header).addClass('dropped');
            } else {
                $(self.settings.logo).removeClass('lfloat');
                $(self.settings.topmenuholder).removeClass('dropped');
                $(self.settings.header).removeClass('dropped');

            }
        },

        menuFlip: function () {

            var self = this;

            self.winsize["width"] = YjsgRespond.viewPort().width;

			
			
				$("ul.yjsgmenu li.haschild").hover(function() {
					
					$(this).removeClass("flip");
					
					var findMargin 	= 	$('ul.yjsgmenu ul ul').first().css('margin-left');
					var dropWidth 	= 	$(this).find('div.ulholder').first().outerWidth(true) + parseInt(findMargin);// ul side push 10px
					
					ltrOffset = $(this).find('div.ulholder').first().offset().left + dropWidth;
					rtlOffset = self.winsize["width"] - $(this).find('div.ulholder').first().offset().left;
	
					var offset = ltrOffset;
	
					if ($("body").hasClass("yjsgrtl")) {
	
						offset = rtlOffset;
	
					}
					
				
					if (offset >= self.winsize["width"]) {
	
						$(this).addClass("flip");
	
					}

				},function(){
					
					setTimeout(function() {
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
        YjsgRespond.siteResize();
        YjsgRespond.showMenu();
        YjsgRespond.logoResize();
        YjsgRespond.winsize["width"] = YjsgRespond.viewPort().width;
    });

})(jQuery);