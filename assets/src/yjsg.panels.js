/*======================================================================*\
|| #################################################################### ||
|| # Package - YJSG Framework                							||
|| # Copyright (C) since 2007  Youjoomla.com. All Rights Reserved.      ||
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

    var YjsgPanel = {

        settings: {
            paneltrigger: ".yjsg-panel-open",
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgPanel.start();

        },

        start: function () {

            var self = this;
			this.yjsgrtl = yjsgrtl;
            YjsgPanel.openPanel();

        },

        panelResize: function () {

            var self = this;

            $('.panelOpen').each(function () {

                var trig = $(this).find('.yjsg-panel-open');
                var container = $(this).find('.yjsg-panel-content');

                $(this).stop(true).animate({
                    height: container.height() + trig.height()
                });

                $(this).find('> div').stop(true).animate({
                    height: container.height()
                });
            });
        },

        openPanel: function () {

            var self = this;
			
			
			$(document).on('click', function (event) {
				event.stopImmediatePropagation();
				if ($(event.target).parents('.panelOpen').length == 0) {
					$('.panelOpen').find('.yjsg-panel-open').trigger('click');
				}
			
			});
			
			
            $(self.settings.paneltrigger).each(function () {

                var panel = $(this).data('panel');
                var getDirection = $(this).data('direction');
                var openText = $(this).data('otext');
                var closeText = $(this).data('ctext');
                var tranSpeed = $(this).data('duration');
                var panelHeight = $(panel).find('.yjsg-panel-content').height();
                var panelNext = $(panel + ' > div');

                switch (panel) {
                case '#yjsg_toppanel':
                case '#yjsg_botpanel':

                    $(panel).css('height', panelHeight + $(this).height());
                    $(panel).css(getDirection, -panelHeight);
                    $(panelNext).css('height', panelHeight);
                    break;

                case '#yjsg_sidepanel':

                    $(panel).css('height', $(window).height());
                    $(panelNext).css('height', $(window).height());

                    break;
                }

                $(this).click(function (e) {

                    e.stopPropagation();
                    var getPoz = parseInt($(panel).css(getDirection));
                    switch (panel) {

                    case '#yjsg_toppanel':

                        if (getPoz < 0) {

                            $(panel).addClass('panelOpen');
                            $(panel).animate({
                                'top': 0
                            }, tranSpeed);
                            $(this).html(closeText);

                        } else {

                            $(panel).animate({
                                'top': -$(panelNext).height()
                            }, tranSpeed);

                            $(this).html(openText);
                            $(panel).removeClass('panelOpen');
                        }

                        break;

                    case '#yjsg_botpanel':

                        if (getPoz < 0) {
                            $(panel).addClass('panelOpen');
                            $(panel).animate({
                                'bottom': 0
                            }, tranSpeed);
                            $(this).html(closeText);
                        } else {

                            $(panel).animate({
                                'bottom': -$(panelNext).height()
                            }, tranSpeed);
                            $(this).html(openText);
                            $(panel).removeClass('panelOpen');
                        }

                        break;

                    case '#yjsg_sidepanel':
						
						
						
						if (getPoz < 0) {
							 $(panel).addClass('panelOpen');
							$(this).addClass('SidePanOpen');
							if(self.yjsgrtl == 2){
								$(panel).animate({
									'right': 0
								}, tranSpeed);
							}else{
								$(panel).animate({
									'left': 0
								}, tranSpeed);									
								
							}
						} else {
							if(self.yjsgrtl == 2){
								$(panel).animate({
									'right': -$(panel).width() + 30
								}, tranSpeed);
							}else{
								$(panel).animate({
									'left': -$(panel).width() + 30
								}, tranSpeed);									
							}
							$(this).removeClass('SidePanOpen');
							$(panel).removeClass('panelOpen');
						}
						

                        break;
                    }

                });

            });

        }
    }

    $(window).on('load', YjsgPanel.initialize);
    $(window).on('resize', YjsgPanel.panelResize);

})(jQuery);