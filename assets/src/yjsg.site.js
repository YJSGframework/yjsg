/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
(function ($) {

    var YjsgSite = {

        settings: {
            bsversion: "",
            yversion: "",
            menuanimation: '',
            compileme: '',
            menuanimationspeed: 300
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgSite.start();

        },
        start: function () {

            var self = this;

            this.bsversion = bootstrapv;
            this.yversion = yver;
            this.yjsglegacy = yjsglegacy;
            this.yjsgrtl = yjsgrtl;
            this.compileme = compileme;

            if (typeof menuanimation != 'undefined') {

                this.menuanimation = menuanimation;

            } else {

                this.menuanimation = '';
            }

            if (typeof menuanimationspeed != 'undefined') {

                this.menuanimationspeed = menuanimationspeed;

            } else {

                this.menuanimationspeed = self.settings.menuanimationspeed;
            }

            YjsgSite.offCanvas();
            YjsgSite.fontResize();
            if (this.yjsglegacy == 1) {
                YjsgSite.setHeadersize();
            }
            YjsgSite.yjsgScroll();
            YjsgSite.yjsgAccordion();
            YjsgSite.yjsgSimpleTabs();
            YjsgSite.customChrome();
            YjsgSite.ajaxRecompile();
            YjsgSite.siteTypo();
            YjsgSite.conflictsFix();
            YjsgSite.bootstrapJs();
            YjsgSite.ieNotices();
            prettyPrint();

            if (this.yjsglegacy == 0) {
                YjsgSite.animateMenus();
            }

            window.yjsgCloseModal = function (getElem) {
                SqueezeBox.close();
            };
            YjsgSite.yjsgRating();
            YjsgSite.yjsgMedia();
            YjsgSite.yjsgLightbox();
            YjsgSite.yjsgSticky();

        },

        yjsgSticky: function () {

            var self = this;

            $('.yjsg-sticky').each(function (index, element) {

                var el = $(this),
                    effect = el.data('effect'),
                    hide = el.data('hide'),
                    pushed = el.data('pushed'),
                    offset = el.data('offset'),
                    active = false;

                if (hide == 'yes') {
                    el.addClass('fixed');
                }
                if (pushed > 0) {

                    el.css('margin-top', pushed);
                }

                window.addEventListener("scroll", function (evt) {

                    if ($(window).scrollTop() >= offset) {

                        el.addClass('fixed');

                        if (effect == 'slide') {
                            el.slideDown(400);
                        }
                        if (effect == 'fade') {
                            el.fadeIn(400);
                        }

                        active = true;

                    } else if (active) {

                        if (effect == 'slide') {
                            el.stop(true).slideUp(300, function (e) {

                                el.removeClass('fixed');
                                if (hide == 'no') {
                                    el.removeAttr('style');
                                }
                            });
                        }
                        if (effect == 'fade') {

                            el.stop(true).fadeOut(300, function (e) {

                                el.removeClass('fixed');

                                if (hide == 'no') {
                                    el.removeAttr('style');
                                }

                            });
                        }

                        active = false;

                    }

                });

            });
			
			
			var lastScrollId,
				stickyMenu = $("[data-sticky-menu]"),
				topMenuHeight = stickyMenu.outerHeight() * 2,
				stickyItems = stickyMenu.find("a.yjscroll"),
				scrollItems = stickyItems.map(function(){
				  var yjscroll = $($(this).attr("href"));
				  if (yjscroll.length) { return yjscroll; }
				});			
			$(window).scroll(function(){
			   var fromTop = $(this).scrollTop() + topMenuHeight * 2 ;
			 
			   var cur = scrollItems.map(function(){
				 if ($(this).offset().top < fromTop)
				   return this;
			   });
			   cur = cur[cur.length-1];
			   var id = cur && cur.length ? cur[0].id : "";
			   
			   if (lastScrollId !== id && id !="") {
				   lastScrollId = id;
				   stickyItems.removeClass("active-scroll");
				   $("[href=#"+id+"]").addClass("active-scroll");
			   }                   
			});
			

        },

        yjsgLightbox: function () {

            var self = this;
			
			if (typeof ($.fn.magnificPopup) == 'undefined') return;

            $('.yjsg-lightbox-gallery').each(function () {
                $(this).find('a').magnificPopup({
                    type: 'image',
                    mainClass: 'mfp-with-zoom',
                    zoom: {
                        enabled: true,
                        duration: 300,
                        easing: 'ease-in-out',
                        opener: function (openerElement) {
                            return openerElement.is('img') ? openerElement : openerElement.find('img');
                        }
                    },
                    gallery: {
                        enabled: true
                    }
                });
            });

            $("*[class*='yjsg-lightbox-items']").magnificPopup({
                type: 'image',
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function (openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                },
                gallery: {
                    enabled: true
                }
            });

            $('.yjsg-lightbox').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                closeBtnInside: false,
                fixedContentPos: true,
                mainClass: 'mfp-no-margins mfp-with-zoom',
                image: {
                    verticalFit: true
                },
                zoom: {
                    enabled: true,
                    duration: 300
                }
            });

            $('.yjsg-link-lightbox').magnificPopup({
                type: 'image',
                mainClass: 'mfp-fade'
            });
			
			
		   $('.yjsg-iframe-lightbox').magnificPopup({
			  type: 'iframe',
			  mainClass: 'mfp-fade'
			});
			

        },

        yjsgMedia: function () {

            var self = this;
            if (typeof mejs != 'undefined') {
                $('.yjsg-media').mediaelementplayer();
            }

        },

        yjsgRating: function () {

            var self = this;

            $('.view-article .yjsg-rate').on('click', function (event) {
                event.preventDefault();
                var datarating = $(this).data('rating');
                $('.yjsg-user-rating').val(datarating);
                $('.yjsg-rating-form').submit();

            });

        },

        offCanvas: function () {

            var self = this;
            var openPoz;
            var openMargin;
            var closePoz;
            var closeMargin;
            var startCss;

            $('.yjsg-offc-btn').on('click', function (e) {

                e.preventDefault();

                var trigger = $(this),
                    width = trigger.data('width'),
                    overlay = trigger.data('yjsg-canvas'),
                    canvas = $(overlay).find('.yjsg-off_canvas_in'),
                    poz = trigger.data('position');

                startCss = {
                    width: width,
                    left: -width,
                    right: 'auto'
                };

                openPoz = {
                    left: 0
                };
                openMargin = {
                    marginLeft: width
                };
                closePoz = {
                    left: -width
                };
                closeMargin = {
                    marginLeft: 0
                };

                if (poz == 'right') {
                    startCss = {
                        width: width,
                        right: -width,
                        left: 'auto'
                    };
                    openPoz = {
                        right: 0
                    };
                    openMargin = {
                        marginLeft: -width
                    };
                    closePoz = {
                        right: -width
                    };
                    closeMargin = {
                        marginLeft: 0
                    };

                }

                if (self.yjsgrtl == 1) {

                    startCss = {
                        width: width,
                        right: -width,
                        left: 'auto'
                    };
                    openPoz = {
                        right: 0
                    };
                    openMargin = {
                        marginRight: width
                    };
                    closePoz = {
                        right: -width
                    };
                    closeMargin = {
                        marginRight: 0
                    };

                }

                if (self.yjsgrtl == 1 && poz == 'right') {

                    startCss = {
                        width: width,
                        left: -width,
                        right: 'auto'
                    };
                    openPoz = {
                        left: 0
                    };
                    openMargin = {
                        marginRight: -width
                    };
                    closePoz = {
                        left: -width
                    };
                    closeMargin = {
                        marginRight: 0
                    };

                }

                $(canvas).css(startCss).addClass('canvas_active').animate(openPoz, 400);

                $(overlay).addClass('canvas_active').animate({
                    backgroundColor: "rgba(0, 0, 0, 0.3)",
                }, 400);

                $('html').addClass('canvas_on').stop().animate(openMargin, 400);
                e.stopImmediatePropagation();

            });

            $('body').on("click touchstart", ".closeCanvas,.yjsg-off_canvas", function (e) {

                var target = $(e.target);

                if (target.parents('.yjsg-off_canvas_in').length != 0 && !target.parents().hasClass('closeCanvas') || target.hasClass('yjsg-off_canvas_in')) return;

                $('.yjsg-off_canvas').animate({
                    backgroundColor: "rgba(0, 0, 0, 0)",
                }, 400);

                $('.yjsg-off_canvas_in').stop().animate(closePoz, 400, function () {
                    $(this).removeClass('canvas_active');
                    $('.yjsg-off_canvas').removeClass('canvas_active');
                });
                $('html.canvas_on').stop().animate(closeMargin, 400, function () {
                    $(this).removeClass('canvas_on');
                });

                e.stopImmediatePropagation();
            });

        },

        ieNotices: function () {

            var self = this;

            if ($.cookie('ieNotice')) return;
            $('#ie6Warning').css({
                'display': 'block',
                'opacity': 0
            }).animate({
                'top': 0,
                'opacity': 1
            }, 800);

            $('#closeIe6Alert').on('click', function (event) {
                event.preventDefault();
                $('#ie6Warning').animate({
                    'display': 'none',
                    'top': -200,
                    'opacity': 0
                }, 800);
                $.cookie('ieNotice', true);

            });

        },

        bootstrapJs: function () {

            var self = this;

            if (self.bsversion == 'bootstrapoff') {
                return false;
            }
            if (self.bsversion == 'bootstrap2') {
                $('.hasTip').each(function () {
                    var gettitle = $(this).attr("title");
                    if (gettitle) {
                        $(this).removeClass('hasTip');
                        $(this).addClass('addtips');
                        $(this).attr('rel', 'tooltip');
                        $(this).attr('data-placement', 'left');
                        var parts = gettitle.split('::', 2);
                        $(this).attr("title", parts[0] + '<br />' + parts[1]);
                    }
                });
                $('.addtips').tooltip({
                    container: 'body'
                });
            }

            if (self.bsversion == 'bootstrap3') {
                $('.hasTip').each(function () {
                    var gettitle = $(this).attr("title");
                    if (gettitle) {
                        $(this).removeClass('hasTip');
                        $(this).addClass('addtips');
                        $(this).attr('data-placement', 'left');
                        var parts = gettitle.split('::', 2);
                        $(this).attr("data-original-title", parts[1]);
                        $(this).attr('title', '');
                    }
                });
                $('.addtips').tooltip({
                    container: 'body'
                });
            }

        },

        animateMenus: function () {

            var self = this;

            var animation = this.menuanimation;
            var animationspeed = this.menuanimationspeed;

            if ($('.activepath ').length == 1) {

                $(".megadropline li.haschild.level0").hover(function () {

                    $(".megadropline ul.level1").hide().stop(true, true).toggle('fade', animationspeed, function () {

                        $(this).show();

                    });

                }, function () {

                    $(".megadropline ul.level1").first().stop(true).toggle('fade', animationspeed, function () {

                        $(this).removeAttr('style');

                    });
                });
            }

            $("ul.yjsgmenu li.haschild").hover(function () {

                if ($(this).hasClass("holdsgroup")) {

                    return false;
                }

                if ($(this).hasClass("level0") && $('.megadropline').length > 0) {

                    return false;
                }

                if (animation == 'fade') {

                    $(this).find('div.nogroup').first().hide().stop(true, true).toggle('fade', animationspeed, function () {

                        $(this).show();

                    });

                }
                if (animation == 'grow') {

                    $(this).find('div.nogroup > ul').first().hide().show('slide', {
                        direction: "up"
                    }, animationspeed, function () {

                        $(this).css('display', 'block');
                        $(this).parent().css('display', 'block');

                    });

                }

                if (animation == 'revfade') {

                    var getTop = $(this).find('a').first().outerHeight(true);

                    if ($(this).hasClass("level0") || ($('.megadropline').length > 0 && $(this).hasClass("level1"))) {

                        $(this).find('div.nogroup').first().css({
                            top: getTop * 2,
                            opacity: 0,
                            display: 'block',

                        }).stop(true, true).animate({
                            'top': getTop,
                            'opacity': 1
                        }, animationspeed, function () {

                            $(this).css('display', 'block');

                        });

                    } else {

                        $(this).find('div.nogroup').first().css({
                            top: getTop,
                            opacity: 0,
                            display: 'block',

                        }).stop(true, true).animate({
                            'top': 0,
                            'opacity': 1
                        }, animationspeed, function () {

                            $(this).css('display', 'block');

                        });

                    }

                }

            }, function () {


                if ($(this).hasClass("level0") && $('.megadropline').length > 0) {

                    return false;
                }

                if (animation == 'fade') {

                    $(this).find('div.nogroup').first().stop(true).toggle('fade', animationspeed, function () {

                        $(this).removeAttr('style');

                    });

                }

                if (animation == 'grow') {

                    $(this).find('div.nogroup > ul').first().stop(true, true).hide('slide', {
                        direction: "up"
                    }, animationspeed, function () {

                        $(this).removeAttr('style');
                        $(this).parent().removeAttr('style');

                    });

                }

                if (animation == 'revfade') {

                    var getTop = $(this).find('a').first().outerHeight(true);

                    if ($(this).hasClass("level0") || ($('.megadropline').length > 0 && $(this).hasClass("level1"))) {

                        $(this).find('div.nogroup').first().stop().animate({
                            'top': getTop + 20,
                            'opacity': 0
                        }, animationspeed, function () {

                            $(this).removeAttr('style');

                        });

                    } else {

                        $(this).find('div.nogroup').first().stop().animate({
                            'top': getTop,
                            'opacity': 0
                        }, animationspeed, function () {

                            $(this).removeAttr('style');

                        });

                    }

                }

            });

        },

        fontResize: function () {

            var self = this;

            // font resize 
            var fontCookie = 'yjsg_fs_z' + fontc;
            var fontMinSize = parseInt(site_f), // min allowed font size
                fontMaxSize = 24, // max allowed font size
                fontStep = 2, // step to increase font-size
                currentFontSize = (parseInt($.cookie(fontCookie)) || parseInt(fontMinSize)), // gets current size, don't mess with this,
                elements = ['body'], // list here all elements that will be affected. Classes must be selectors like .class
                cookieDuration = 2; // cookie duration in days

            $.each(elements, function (key, el) {
                var element = $(el);
                if (element) {
                    element.css({
                        'font-size': currentFontSize + 'px'
                    });
                }
            });
            $('#fontSizePlus').on('click', function (e) {
                e.preventDefault();
                currentFontSize += fontStep;
                if (currentFontSize > fontMaxSize) {
                    currentFontSize = fontMaxSize;
                }
                $.each(elements, function (key, elId) {
                    var element = $(elId);
                    if (element) {
                        element.animate({
                            'font-size': currentFontSize + 'px'
                        });
                    }
                });
                $.cookie(fontCookie, currentFontSize, {
                    expires: cookieDuration,
                    path: '/'
                });

            });
            $('#fontSizeMinus').on('click', function (e) {
                e.preventDefault();
                currentFontSize -= fontStep;
                if (currentFontSize < fontMinSize) {
                    currentFontSize = fontMinSize;
                }

                $.each(elements, function (key, elId) {
                    var element = $(elId);
                    if (element) {
                        element.animate({
                            'font-size': currentFontSize + 'px'
                        });
                    }
                });
                $.cookie(fontCookie, currentFontSize, {
                    expires: cookieDuration,
                    path: '/'
                });

            });
            $('#fontSizeReset').on('click', function (e) {
                e.preventDefault();
                $.each(elements, function (key, elId) {
                    var element = $(elId);
                    if (element) {
                        element.animate({
                            'font-size': fontMinSize + 'px'
                        });
                    }
                });
                currentFontSize = fontMinSize;
                $.cookie(fontCookie, fontMinSize, {
                    expires: cookieDuration,
                    path: '/'
                });
            });
        },

        conflictsFix: function () {

            var self = this;

            if (self.bsversion == 'bootstrap2') {
                // bootstrap2 carousel slide fix
                if (typeof jQuery != 'undefined' && typeof MooTools != 'undefined') {
                    Element.implement({
                        slide: function (how, mode) {
                            return this;
                        }
                    });
                }

                // dropdown bubling fix
                $('a.dropdown-toggle, .dropdown-menu a').on('touchstart', function (e) {
                    e.stopPropagation();
                });
            }


            // mootools bootstrap 3 show/hide/carousel/dropdown fix
            if ((self.bsversion == 'bootstrap3' || self.bsversion == 'bootstrapoff') && window.MooTools && window.MooTools.More && Element && Element.implement) {
                $('.collapse, .hasTooltip,.modal,.hasTip,.popover,.addtips,.yjpopover,.noHtmlTip').each(function () {
                    this.show = null;
                    this.hide = null
                });
                $('.dropdown-menu').parent().each(function () {
                    this.show = null;
                    this.hide = null
                });
                $('.carousel').each(function () {
                    this.slide = null;
                });
            }

            // fix tooltip/popover html output

            if (self.bsversion == 'bootstrap3') {

                $.fn.tooltip.Constructor.DEFAULTS.html = true;
                $.fn.popover.Constructor.DEFAULTS.html = true;
                $.fn.tooltip.Constructor.DEFAULTS.container = 'body';
                $.fn.popover.Constructor.DEFAULTS.container = 'body';
            }

        },

        yjsgSimpleTabs: function () {

            var self = this;

            $('.yjsgSimpleTabs ').each(function (index, element) {

                var holder = $(this);
                holder.find(".yjsgTabContent").hide();
                var navi = holder.find('.yjsgShortcodeTabs');
                var cont = holder.find('.yjsgShortcodeTabs');
                var navih = navi.height();
                holder.find(".activeContent").fadeIn();

                navi.find('li a').click(function (e) {
                    e.preventDefault();
                    if ($(this).attr("class") == "active") {
                        return
                    } else {
                        holder.find(".yjsgTabContent").hide();
                        navi.find("li").attr("class", "");
                        $(this).parent().attr("class", "active");
                        $($(this).attr('href')).fadeIn();
                        var activeh = $($(this).attr('href')).height();

                        if (navih < activeh && (holder.hasClass('tabsleft') || holder.hasClass('tabsright'))) {

                            navi.height(activeh);

                        } else if (holder.hasClass('tabsleft') || holder.hasClass('tabsright')) {

                            navi.height(navih);
                        }
                    }
                });

                navi.find('li.active a').trigger('click');

            });

        },

        yjsgAccordion: function () {

            var self = this;

            $('.yjsgacc .parent').each(function (el) {

                $(this).find('a').first().attr('href', 'javascript:;').addClass('yjsgtoggler');

            });
            $('ul.yjsgacc > li:has(ul)').addClass("inactive_yjsgacc");
            $('ul.yjsgacc > li:has(ul) ul').css('display', 'none');

            $('.yjsgtoggler').click(function () {

                var checkElement = $(this).next();

                $('.yjsgacc li').removeClass('active_yjsgacc');
                $(this).closest('li').addClass('active_yjsgacc').removeClass("inactive_yjsgacc");

                if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                    $(this).closest('li').removeClass('active_yjsgacc').addClass('inactive_yjsgacc');
                    checkElement.slideUp('normal');
                }

                if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {

                    if (!$("ul.yjsgacc").hasClass("notoggle")) {
                        $('ul.yjsgacc ul:visible').slideUp('normal');
                    }
                    checkElement.slideDown('normal');
                }

                if (checkElement.is('ul')) {
                    return false;
                } else {
                    return true;
                }
            });

        },
        customChrome: function () {
            var self = this;

            //tabs module chrome	
            $('.yjsgbootstrap2 a[data-toggle="tab"],.yjsgbootstrap2 a[data-toggle="pill"]').on('shown', function (e) {

                var target = $(e.target).attr('href');
                var prevtarget = $(e.relatedTarget).attr('href');
                $(target).css('display', 'none').fadeIn(800); // activated tab
                $(prevtarget).fadeOut(800); // previous tab

            });
            $('.yjsgbootstrap3 a[data-toggle="tab"],.yjsgbootstrap3 a[data-toggle="pill"]').on('shown.bs.tab', function (e) {

                var target = $(e.target).attr('href');
                var prevtarget = $(e.relatedTarget).attr('href');
                $(target).css('display', 'none').fadeIn(800); // activated tab
                $(prevtarget).fadeOut(800); // previous tab

            });

            //accordions module chrome	
            $('.yjsgaccChrome').each(function (index, element) {

                var holder = $(this);
                var opener = $(this).find('.yjsgaccTrigger a');
                var active = $(this).find('.yjsgaccTrigger.active a');
                var content = $(this).find('.yjsgaccContent');

                opener.on('click', function (event) {

                    event.preventDefault();
                    holder.find('.active').removeClass('active');
                    content.slideUp('normal');

                    if ($(this).parent().next().is(':hidden') == true) {

                        $(this).parent().addClass('active');
                        $(this).parent().next().slideDown('normal');
                    }

                });

                opener.on('mouseover', function () {
                    $(this).parent().addClass('hovered');
                }).on('mouseout', function () {
                    $(this).parent().removeClass('hovered');
                });

                active.trigger('click');

            });

            $('.yjsgtabs_chromeaction,.yjsgaccContent').fitVids();

        },
        siteTypo: function () {

            var self = this;

            // placeholder
            if ($.browser.msie) {
                $('.inputbox').placeholder();
            }

            // close alerts
            $('.yjtb_close').on('click', function (e) {

                $(this).parent().animate({
                    top: -1000
                }, 500, function () {
                    $(this).hide();
                });

            });

            // image fade
            fadeParent = $('.yjt_fade');
            fadeParent.each(function (el) {

                var opacity = $(this).data('yjt_fadeto');
                var speed = $(this).data('yjt_fadespeed');

                $(this).on('mouseenter', function (event) {

                    $(this).find('img').animate({
                        'opacity': opacity,
                    }, speed);

                }).on('mouseleave', function (event) {

                    $(this).find('img').animate({
                        'opacity': 1,
                    }, speed);

                });

            });

        },
		
		yjscrollData: function (){
			
			
			
			
			
		},
		
        yjsgScroll: function () {

            var self = this;
			var before;
			var after;

            $(".yjscroll").on('click', function (event) {
				
				if($(this.hash).length == 0) return;
				
                event.preventDefault();

				var el  	=	$(this),
					before 	= el.data('before'),
					after  	= el.data('after'),
					element =$(this.hash) ;
					
				if(!before){
					before = 0;
				}
				if(!after){
					after = 0;
				}
				var goTo  = $(this.hash).offset().top - before + after;
                $('html, body').stop(true, true).animate({
                    scrollTop: goTo
                }, 800);

				
            });

        },

        roundNumber: function (num, dec) {

            var self = this;
            var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
            return result;

        },

        setHeadersize: function () {

            var self = this;
            var logo_out = YjsgSite.roundNumber(logo_w / $('#header').width() * 100, 2);
            var grid_w = YjsgSite.roundNumber(100 - logo_out, 2);
            if (typeof site_w_is_per != 'undefined') {

                $('#logo').css('width', logo_out + '%');
                $('#yjsgheadergrid').css('width', grid_w + '%');

            }

        },

        ajaxRecompile: function () {

            var self = this;
            if (self.compileme == 0 || self.compileme == 3 || self.compileme == 'undefined') return;

            var currentLink = location.href;
            var foundhash = currentLink.match(/#/g);
            var hashpart = '';

            // in case of hash we need to change the currentLink
            if (foundhash) {

                var splitLink = currentLink.split('#');
                currentLink = splitLink[0];

            }

            var sitepath = currentLink.indexOf("?") == -1 ? currentLink + '?recompile=1' : currentLink + '&recompile=1';

            $.ajax({
                type: "get",
                url: sitepath,
                cache: false,
                success: function (data, status, xhr) {
                    location.reload(true);
                },
                error: function (data) {

                    var msg = data.responseText;
                    if (data.status === 503) { //Site is offline css is recompiled
                        location.reload(true);
                        return;
                    }

                    var sysmsg = '<div class="yjtbox yjtb_red lineup">';
                    sysmsg += '<span class="yjtb_close"></span>';
                    sysmsg += '<span class="yjtboxicon fa fa-warning"></span>';
                    sysmsg += '<h4 class="yjtboxtitle">Compiler error:</h4>';
                    sysmsg += msg;
                    sysmsg += '</div>';

                    $('.yjsg-system-msg').html(sysmsg);

                    $('<div/>', {
                        id: 'compilerMsg',
                        html: msg
                    }).appendTo('body');

                }
            });

        },

    }

    //empty tooltip in case bs is off
    if (typeof ($.fn.tooltip) == 'undefined') {
        $.fn.tooltip = function () {};
    }

    $(document).on('ready', YjsgSite.initialize);
    if (this.yjsglegacy == 1) {
        $(window).on('resize', YjsgSite.setHeadersize);
    }

})(jQuery);