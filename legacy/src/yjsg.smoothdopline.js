/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
;
(function ($) {

    $.fn.SmoothDropLineJQ = function (options) {

        if (0 == this.length) {
            return false;
        }

        // support multiple elements
        if (this.length > 1) {
            this.each(function () {
                $(this).SmoothDropJQ(options);
            });
            return;
        }

        var defaults = {
            contpoz: false,
            horizLeftOffset: 10, // submenus, left offset
            horizRightOffset: -10, // submenus opening into the opposite direction
            horizTopOffset: 20, // submenus, top offset
            verticalTopOffset: 30, // main menus top offset
            verticalLeftOffset: 10, // main menus, left offset
            maxOutside: 50 // maximum pixels a panel can go outside the window and get pushed back	
        };

        var options = $.extend({}, defaults, options),
            container = selfobj = this,
            injectIn = document.body,
            dir = $(document.body).css('direction'),
            isIe7 = 'rtl' == dir ? false : options.contpoz,
            menuTree = {},
            parentCount = 0,
            parent = null,
            element = null,
            pathOver = null,
            pathOut = null,
            path = null,
            toInject = [],
            topParent = null,
            duration = 250;

        var init = function () {

            var slideDir = 'left';

            if (dir == 'rtl') {

                slideDir = 'right';
            }

            var list = $(selfobj).find('ul.subul_main');

            $.each(list, function (i, el) {

                $(list).attr({
                    'data-width': $(this).outerWidth(),
                    'data-height': $(this).outerHeight()
                });
            })

            $(container).removeClass('horiz_rtl');

            parseLists(list, 0, false);

            $.each(toInject, function (i, data) {
                $(data.inner).append(data.list);
            })

            $.each(menuTree, function (key, elements) {
                var level = key;

                $.each(elements, function (i, info) {
                    if ($(info.trigger).hasClass('active')) {
                        $(info.trigger).addClass('is_active');
                    }
                    if ($(info.topParent).hasClass('active')) {
                        $(info.topParent).addClass('is_active')
                    }

                    $(info.trigger).mouseenter(function (event) {

                        getPath(key, false);
                        pathOver = path.join('|');

                        if (parent == key && i !== element) {

                            var t = menuTree[key];
                            $.each(t, function (k, m) {
                                if (k !== i) {
                                    // set up slide direction
                                    var dir = 'vertical' == t.slide ? 'up' : slideDir;
                                    $(t.animate)
                                        .hide('slide', {
                                            direction: dir,
                                            duration: duration,

                                            complete: function () {

                                            }
                                        });
                                }
                            });
                        }

                        $(info.topParent).css({
                            'position': 'static'
                        }).addClass('active');
                        //*
                        $(info.topList).css({
                            'z-index': 100,
                            'left': 0,
                            'margin': 0,
                            'height': 37
                        })
                        //*/

                        topParent = info.topParent;
                        parent = key;
                        element = i;

                        //if( !$(this).hasClass('active') ){
                        showMenu(info);
                        //}		
                    }); // mouseenter

                    // mouseover UL
                    $(info.list).mouseenter(function (event) {
                        getPath(key, false);
                        pathOver = path.join('|');
                        topParent = info.topParent;
                        parent = key;
                        element = i;
                    }); //mousemove

                    $(info.trigger).mouseleave(function () {
                        getPath(key, false);
                        var liOutPath = pathOut = path.join('|');
                        element = false;

                        var f = function () {
                            // if path is the same, do element index check to see if user navigates in same parent element
                            if (pathOver == liOutPath) {

                                var m = menuTree[parent];
                                $.each(m, function (k, e) {
                                    if (k !== element) {
                                        // set up slide direction
                                        var dir = 'vertical' == m[k].slide ? 'up' : slideDir;
                                        $(m[k].animate)
                                            .hide('slide', {
                                                direction: dir,
                                                duration: duration

                                            });

                                        if (!m[k].trigger.hasClass('is_active'))
                                            m[k].trigger.removeClass('active');
                                    }
                                });

                            } else {

                                var pathIn = pathOver ? pathOver.split('|') : [];
                                var pathOut = liOutPath.split('|');

                                $.each(pathOut, function (i, k) {
                                    if (-1 == $.inArray(k, pathIn)) {
                                        var m = menuTree[k];
                                        $.each(m, function (x, e) {
                                            var dir = 'vertical' == m[x].slide ? 'up' : slideDir;
                                            $(m[x].animate)
                                                .hide('slide', {
                                                    direction: dir,
                                                    duration: duration

                                                });
                                            if (!$(m[x].trigger).hasClass('is_active'))
                                                $(m[x].trigger).removeClass('active');
                                        });

                                    }
                                });
                            }

                            if (topParent !== info.topParent) {
                                $(info.topParent).removeAttr('style');
                                if (!$(info.topParent).hasClass('is_active')) {
                                    $(info.topParent).removeClass('active');
                                }
                                $(info.topList).removeAttr('style');
                            }

                        }
                        setTimeout(f, 100);

                    }); // mouseleave

                    $(info.list).mouseleave(function () {

                        getPath(key, false);
                        var ulOutPath = pathOut = path.join('|');

                        var f = function () {
                            // if path is the same, do element index check to see if user navigates in same parent element
                            if (pathOver == ulOutPath) {
                                var m = menuTree[parent];
                                $.each(m, function (k, e) {
                                    if (k !== element) {
                                        var dir = 'vertical' == m[k].slide ? 'up' : slideDir;
                                        $(m[k].animate)
                                            .hide('slide', {
                                                direction: dir,
                                                duration: duration

                                            });
                                        if (!$(m[k].trigger).hasClass('is_active'))
                                            $(m[k].trigger).removeClass('active');

                                    }
                                });
                            } else {
                                var pathIn = pathOver.split('|');
                                var pathOut = ulOutPath.split('|');

                                $.each(pathOut, function (i, k) {
                                    if (-1 == $.inArray(k, pathIn)) {
                                        var m = menuTree[k];
                                        $.each(m, function (x, e) {
                                            var dir = 'vertical' == m[x].slide ? 'up' : slideDir;
                                            $(m[x].animate)
                                                .hide('slide', {
                                                    direction: dir,
                                                    duration: duration

                                                });
                                            if (!$(m[x].trigger).hasClass('is_active'))
                                                $(m[x].trigger).removeClass('active');
                                        });
                                    }
                                });
                            }

                            if (topParent !== info.topParent) {
                                $(info.topParent).removeAttr('style');
                                if (!$(info.topParent).hasClass('is_active')) {
                                    $(info.topParent).removeClass('active');
                                }
                                $(info.topList).removeAttr('style');
                            }

                        };

                        setTimeout(f, 200);

                    }); // mouseleave

                    // stop body mouseover event when mouse is over li or ul's in menu 
                    $(info.trigger).mouseover(function (e) {
                        e.stopPropagation()
                    });
                    $(info.trigger).mouseover(function (e) {
                        e.stopPropagation()
                    });
                    $(info.list).mouseover(function (e) {
                        e.stopPropagation()
                    });
                    $(info.positioner).mouseover(function (e) {
                        e.stopPropagation()
                    });
                    // stop mouse wheel on lists when ie7 because of position fixed on elements
                    if (isIe7)
                        $(info.list).mousewheel(function (e) {
                            e.preventDefault()
                        });

                });
            });

            // hide all menus on body mouseover
            //*
            $(injectIn).mouseover(function (event) {
                $.each(menuTree, function (key, elements) {
                    $.each(elements, function (ii, c) {
                        var dir = 'vertical' == c.slide ? 'up' : slideDir;
                        $(c.animate)
                            .hide('slide', {
                                direction: dir,
                                duration: duration

                            });

                        if (topParent) {
                            $(topParent).removeAttr('style');
                            if (!$(topParent).hasClass('is_active')) {
                                $(topParent).removeClass('active');
                            }
                            $(topParent).children('ul.dropline').removeAttr('style');
                            resetAllContainers();
                            topParent = null;
                        }

                        if (!$(c.trigger).hasClass('is_active'))
                            $(c.trigger).removeClass('active');
                    });
                });
            });

            return selfobj;
        }

        var resetAllContainers = function () {
            var mainList = $('#horiznav').find('.menunavd');
            var firstRow = $(mainList).children();

            $.each(firstRow, function (i, el) {
                if (!$(el).hasClass('haschild')) return;
                var list = $(el).children('ul.dropline');
                $(list).css({
                    'z-index': '',
                    'left': '',
                    'margin': '',
                    'height': ''
                });

            })
        }

        var showMenu = function (nodeInfo) {

            var direction = $(document.body).css('direction');
            var slideDir = 'left';
            var d = showLtr(nodeInfo);

            if (direction == 'rtl') {

                slideDir = 'right';
                d = showRtl(nodeInfo);
            }

            $(nodeInfo.positioner).css({
                'top': d.top,
                'left': d.left,
                'z-index': 2000
            });
            $(nodeInfo.trigger).addClass('active');

            // set up slide direction
            var dir = 'vertical' == nodeInfo.slide ? 'up' : slideDir;

            $(nodeInfo.animate)
                .hide()
                .css({
                    'top': 0,
                    'left': 0
                })
                .show('slide', {
                    direction: dir,
                    duration: duration
                });
        }

        var showLtr = function (info) {

            var offset = $(info.trigger).offset(),
                width = $(info.trigger).outerWidth();

            //var c = info.trigger.getCoordinates();	
            var top = info.level == 0 ? parseInt(offset.top, 10) + parseInt(options.verticalTopOffset, 10) : parseInt(offset.top, 10);
            var left = info.level == 0 ? parseInt(offset.left, 10) - parseInt(options.verticalLeftOffset, 10) : parseInt(offset.left, 10) + width - parseInt(options.horizLeftOffset, 10);

            // get window size
            var winSize = {
                'x': $(window).width(),
                'y': $(window).height()
            };
            // get list width
            var listWidth = info.size.x + 20;
            var toLeft = false;

            var outside = (left + listWidth) - winSize.x;

            if (outside > options.maxOutside) {

                left = info.level == 0 ? parseInt(offset.left, 10) - (info.size.x - width) - parseInt(options.verticalLeftOffset, 10) :
                    parseInt(offset.left, 10) - (info.size.x - width) - width - parseInt(options.horizRightOffset, 10);

                toLeft = info.level == 0 ? false : true;

            } else if (outside > 0) {

                left -= outside;

            }

            return {
                'top': top,
                'left': left,
                'toLeft': toLeft
            };
        }

        var showRtl = function (info) {

            var offset = $(info.trigger).offset(),
                width = $(info.trigger).outerWidth();

            var top = info.level == 0 ? parseInt(offset.top, 10) + parseInt(options.verticalTopOffset, 10) : parseInt(offset.top, 10) - parseInt(options.horizTopOffset, 10);
            var left = info.level == 0 ? parseInt(offset.left, 10) - (info.size.x - width) - parseInt(options.verticalLeftOffset, 10) :
                parseInt(offset.left, 10) - info.size.x - parseInt(options.horizRightOffset, 10);

            // set default to open to left		
            var toLeft = info.level == 0 ? false : true;
            // check level for positioning
            if (info.level == 0) {
                // level 0, simple check, if left is outside window(negative), set it to 0
                if (left < 0) left = 0;
            } else {
                // subsequent levels
                if (left - info.size.x < 0) {
                    left = parseInt(offset.left, 10) - width - parseInt(options.horizLeftOffset, 10);
                    toLeft = false;
                }
            }

            // if less than 0 switch sides
            if (left < 0) {

                left = info.level == 0 ? parseInt(offset.left, 10) - parseInt(options.verticalLeftOffset, 10) : parseInt(offset.left, 10) + width - parseInt(options.horizLeftOffset, 10);

            }

            return {
                'top': top,
                'left': left,
                'toLeft': toLeft
            };
        }

        /* starting with any key, returns the complete path to the root */
        var getPath = function (key, cpath) {

            if (!cpath) {
                path = [];
                path[0] = key;
            } else {
                path = cpath;
            }

            $.each(menuTree, function (k, items) {
                $.each(items, function (i, data) {
                    if (data.id == key) {
                        var index = path.length;
                        path[index] = k;
                        getPath(k, path);
                        return;
                    }
                });
            });

        }

        var parseLists = function (li, level, parent, prev_parent) {

            var mainParents = $(li).children();
            $.each(mainParents, function (i, el) {
                // only elements with class haschild have submenus
                if (!$(el).hasClass('haschild')) return;

                // set unique id and add level class to li.haschild element
                var id = 'level' + level + '-' + parentCount;
                $(el).attr({
                    'rel': 'level-' + level
                });
                var list = $(el).children('ul.subul_main');

                // get list parent and check if it is group holder
                var p = $(list).parent().parent();
                // if menu is group holder it gets to keep his children
                if ($(p).hasClass('group_holder')) {

                    parseLists(list, level + 1, id, prev_parent);
                    return;
                } else {
                    // menuWrap returns an object containing the div that positions the submenu and the fx instance
                    var listDetails = menuWrap(list, level);
                }

                // construct the menu tree
                var key = prev_parent || parent || 'root';

                if ('undefined' === $.type(menuTree[key])) {
                    menuTree[key] = new Array();
                }

                var data = listDetails;
                data.list = list;
                data.trigger = el;
                data.level = level;
                data.id = id;
                data.topList = $(selfobj).children('ul.dropline')[0];
                data.topParent = selfobj;

                $.merge(menuTree[key], [data]);

                // if menu is group holder, the next level list is part of this menu so pass the id to the script to make it descent from group holder
                var prev_p = $(list).hasClass('group_holder') ? id : null;
                // this variable is used to generate unique ids
                parentCount++;
                // search the next level
                parseLists(list, level + 1, id, prev_p);

            }); // end loop

        }

        var menuWrap = function (list, level) {

            var listSize = {
                'x': $(list).data('width'),
                'y': $(list).actual('outerHeight')
            };

            var tp = $('<div />', {
                'css': {
                    'position': isIe7 ? 'fixed' : 'absolute',
                    'left': 0,
                    'top': -3000,
                    'display': 'block',
                    'z-index': 1000,
                    'font-size': YJSG_topmenu_font,
                    'height': 1,
                    'width': 'auto',
                    'padding': 0,
                    'margin': 0
                },
                'class': 'top_menu YJSG_listContainer'
            });

            var inner = $('<div />', {
                'class': 'YJSG-inner horiznav',
                'css': {
                    'width': listSize.x,
                    'height': level == 0 ? listSize.y + 20 : 'auto',
                    'line-height': 'normal',
                    'padding': '13px 10px', // padding is added because of round corners positioned absolute that go outside the list by 13 pixels top-bottom and 10 pixels left-right
                    'background': 'none',
                    'display': 'block',
                    'position': 'relative',
                    'float': 'left'
                }
            });

            var clear = $('<div />', {
                'css': {
                    'display': 'block',
                    'clear': 'both',
                    'position': 'relative',
                    'width': '100%'
                },
                'html': '<!--clear-->'
            });

            var elems = {
                'inner': inner,
                'list': list
            };
            toInject[toInject.length] = elems;

            $(injectIn).append($(tp).append($(inner).append([list, clear])));

            var slide_mode = level ? 'horizontal' : 'vertical';

            return {
                'positioner': tp,
                //'fx' 			: fx, 
                'animate': inner,
                'size': listSize,
                'slide': slide_mode
            };
        }

        return init();
    }

})(jQuery);

;
(function ($) {

    $(window).load(function () {

        var dropholder = $('#topmenu_holder'),
            activedropded = $(dropholder).find("li.active").hasClass("haschild"),
            getholders = $('.menunavd li').eq(0).height(),
            getdrops = $('ul.dropline.dlevel1').outerHeight(),
            fullheight = getholders + getdrops;

        if (activedropded) {
            $(dropholder).css({
                'height': fullheight
            });
        }

        var mainList = $('#horiznav').find('.menunavd'),
            firstRow = $(mainList).children();

        $(dropholder).css({
            'overflow': 'hidden'
        });

        var s = $(dropholder).outerHeight();

        $(document.body).mouseover(function () {
            $(dropholder).animate({
                'height': s
            }, {
                queue: false,
                duration: 350
            });
        });

        $.each(firstRow, function (i, el) {
            if (!$(el).hasClass('haschild')) return;

            var list = $(el).children('ul.dropline')[0];

            $(el).mouseenter(function (event) {
                $.each(firstRow, function (m, e) {
                    if (!$(e).hasClass('haschild')) return;
                    if (i == m) return;

                    var l = $(e).children('ul.dropline');
                    $(e).removeAttr('style');
                    if (!$(e).hasClass('is_active')) {
                        $(e).removeClass('active');
                    }

                    $(l).css({
                        'z-index': '',
                        'left': '',
                        'margin': '',
                        'height': '',
                        'border': ''
                    });

                    $(dropholder).animate({
                        'height': fullheight
                    }, {
                        queue: false,
                        duration: 350
                    });
                })
            }); // mouseenter

            $(el).mouseover(function (event) {
                event.stopPropagation();
            })
            $('.group_holder').each(function (index, element) {
                $(this).height($(this).outerHeight());
                //$(this).width( $(this).outerWidth());
            });
            $(el).SmoothDropLineJQ(SmoothDroplineParams);

        });

    });

})(jQuery);