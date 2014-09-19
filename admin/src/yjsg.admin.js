/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
;
(function ($) {

    var YjsgAdmin = {

        settings: {
            containers: "div.yjsg_grid_widths",
            inputs: "input.input-mini[type=text]",
            checks: "input[type=checkbox]",
            resetb: "a.YJSG_reset-values",
            setttigger: ".opensettings",
            adminform: "#style-form",
            pluginpath: "#YJSG_plugin_path",
            templatename: "#jform_template",
            templateid: "#YJSG_template_id",
            templatepath: "#YJSG_template_path",
            sitepath: "#YJSG_site_path",
            currentstyle: "#jform_params_yjsg_get_styles"
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgAdmin.start();

        },
        start: function () {

            var self = this;

            this.sitepath = $(this.settings.sitepath).val();
            this.templatepath = $(this.settings.templatepath).val();
            this.templatename = $(this.settings.templatename).val();
            this.templateid = $(this.settings.templateid).val();
            this.cookie_name = this.templatename + this.templateid;
            this.pluginpath = $(this.settings.pluginpath).val();
            this.adminForm = $(this.settings.adminform);
            this.formTask = $('input[name=task]');
            this.msgTimeout = null;
            this.animeFlag = true;

            this.selectBoxes();
            this.yjsgMultiSelect();
            this.fixStyles();
            this.sortLayout();
            this.yjsgLogoImage();
            this.yjsgCloneLayoutAction();
            this.resetValues();
            this.animateParent();
            this.getBoxes();
            this.openSettings();
            this.mainbodyLayout();
            this.selectLayout();
            this.adminToolbar();
            this.setColors();
            this.yjsgBackgroundEl();
            this.systemMessages();
            this.headerGrid();
            this.adjustHeader();
            this.customChrome();
            this.docClickEvents();
            this.templateAssigend();
            this.yjsgKeepAlive();



        },


        yjsgCloneLayoutAction: function () {

            var self = this;


            $('#jform_params_define_itemid').on('change', function (e) {

                e.stopImmediatePropagation();

                var getValues = $(this).val();

                if (getValues) {

                    $.each(getValues, function (index, element) {

                        if (index == '15') {
                            alert("15 is the max for new pages");
                            return false;
                        }

                        var isCloned = $(".clonedTab[data-clone='" + element + "']").length;

                        if (isCloned == 0) {

                            self.yjsgcloneLayout(element);
                            var holder = '#mainbodyLayoutHolder-itemid' + element;

                            self.fixStyles();
                            self.resetChromes('' + holder + ' .defChromes');
                            self.resetValues('' + holder + ' a.YJSG_reset-values');
                            self.animateParent('' + holder + ' .yjsg_grid_widths');
                            self.getBoxes('' + holder + ' .yjsg_grid_widths');
                            self.mainbodyLayout('' + holder + ' .mbLayout');
                            self.selectLayout('' + holder + ' .layoutOption');
                            self.customChrome('' + holder + ' .openChrome');



                        }

                        // remove clone per uncheck
                        $("input:checkbox[value=" + element + "]").click(function () {

                            if (!$(this).is(':checked')) {

                                $('#mainbodyTab-itemid' + element).remove();
                                $('#defaultmb-itemid' + element).remove();

                            } else if ($(this).is(':checked')) {

                                $('.mainbodytabs li').removeClass('active');
                                $('.mainbodytabcont .tab-pane').removeClass('active in');
                                $('#mainbodyTab-itemid' + element).addClass('active');
                                $('#defaultmb-itemid' + element).addClass('active in');

                            }

                        });

                    });




                } else {

                    $('.clonedTabTrigger').remove();
                    $('.clonedTab').remove();

                }


            }).change();


        },

        yjsgcloneDefaults: function (el) {


            if (el.is('select')) {
                el.val(2);
            }
			
            if (el.is('input:text')) {

                var p = el.parent().parent();

                // mainbody
                if (p.hasClass('jmainbody') && el.hasClass('input-mini')) {

                    el.val(46);
                }
                // sidebars
                if (p.hasClass('jleft') || p.hasClass('jright') || p.hasClass('jinset') && el.hasClass('input-mini')) {

                    el.val(18);
                }
                // mainbody grid modules
                if (p.hasClass('groupname') && el.hasClass('input-mini') && !el.hasClass('main_serialized')) {

                    el.val(33);
                }

                if (p.hasClass('groupname') && el.hasClass('input-mini') && el.hasClass('main_serialized')) {

                    el.val('33|33|33');
                }

                // page width goes by xml default
                if (p.hasClass('adminformlist')) {

                    el.val(tplDefaults.css_width);
                }
                // chromes 

                if (el.hasClass('defChromes')) {

                    el.val('YJsgxhtml');
                }
            }
            // resets
            if (el.is('a')) {

                var p = el.parent();

                if (p.hasClass('jmainbodygrid')) {

                    el.attr('data-resets', '33|33|33');
                }

                if (p.hasClass('jmainbody')) {

                    el.attr('data-resets', '46|18|18|18');
                }
            }

        },
        yjsgcloneLayout: function (itemId) {

            var self = this;
            var newClone = '-itemid' + itemId;
            var Elements = "input,select,label,a,div";
            var defaults = dbDefaults;
            var tabTitle = $.trim($("#jform_params_define_itemid option[value='" + itemId + "']").text().replace(/-/g, ''));

            // clone tab
            $("#mainbodyTab")
                .clone()
                .attr('id', 'mainbodyTab' + newClone)
                .attr('class', 'clonedTabTrigger')
                .appendTo(".mainbodytabs");

            // change tab a link and id
            $("#mainbodyTab" + newClone).find('a')
                .attr('id', 'defaultmbtr' + newClone)
                .attr('href', '#defaultmb' + newClone)
                .text(tabTitle);


            $("#defaultmb")
                .clone()
                .attr('id', 'defaultmb' + newClone)
                .removeClass('in active')
                .addClass('clonedTab')
                .attr('data-clone', itemId)
                .appendTo(".mainbodytabcont");

            $("#defaultmb" + newClone)
                .find('#mainbodyLayoutHolder')
                .attr('id', 'mainbodyLayoutHolder' + newClone);


            $('#defaultmb' + newClone).find(Elements).each(function (index, element) {

                var el = $(this);

                if (el.is('input:text') || el.is('select') || el.is('label')) {

                    if (el.attr('id') !== undefined) {
                        el.attr('id', el.attr('id') + newClone);
                    }

                    if (el.attr('data-tiptrigger') !== undefined) {
                        el.attr('data-tiptrigger', el.attr('data-tiptrigger') + newClone);
                    }

                    if (el.attr('for') !== undefined) {
                        el.attr('for', el.attr('for') + newClone);
                    }

                    if (el.attr('name') !== undefined) {

                        var jformParams = el.attr('name').match(/jform\[params]\[(.*)\]/gi);
                        if (jformParams) {
                            var clonedName = self.yjsgReplace(el.attr('name'), "]", "" + newClone + "]", 2);
                            el.attr('name', clonedName);
                        }
                    }

                }

                if (el.attr('class') !== undefined && !el.hasClass('yjsg_grid_widths')) {

                    var foundClass = el.attr('class').match(/_width/i);
                    if (foundClass) {
                        var clonedClass = el.attr('class').replace('_width', '_width' + newClone)
                        el.attr('class', clonedClass);
                    }
                }


                if (el.attr('data-elementcss') !== undefined) {
                    el.attr('data-elementcss', el.attr('data-elementcss') + newClone);
                }

                if (el.attr('data-chromemodule') !== undefined) {
                    el.attr('data-chromemodule', el.attr('data-chromemodule') + newClone);
                }
                if (el.attr('data-chromedefault') !== undefined) {
                    el.attr('data-chromedefault', 'YJsgxhtml');
                }
                if (el.is('label') && el.attr('id') !== undefined) {

                    var foundName = el.attr('id').match(/lbl/i);

                    var switchName = el.attr('id').replace('-lbl' + newClone, newClone + '-lbl')
                    el.attr('id', switchName);
                }


                // default values
                self.yjsgcloneDefaults(el);

                if (el.attr('name') !== undefined) {

                    var p = el.parent().parent();
                    var eldef = el.attr('name').replace('jform[params][', '').replace(/\](.*)/, '');

                    if (defaults[eldef]) {
                        defaultvalue = defaults[eldef];

                        if (p.hasClass('groupname') && el.hasClass('input-mini')) {

                            var values = defaultvalue.split('|');
                            $('input.' + eldef + '[type=text]').each(function (i, el) {
                                $(this).val(values[i]);
                            });

                            $('input.' + eldef + '[type=checkbox]').each(function (i, el) {
                                $(this).attr("checked", false);
                                $(this).next().removeClass("fa-lock").addClass('fa-unlock');
                            });
                            $('input.' + eldef + '[type=hidden]').val(defaultvalue);


                        } else {

                            el.val(defaultvalue);
                        }

                    }

                }


            });



        },



        yjsgReplace: function (strInfo, strReplace, strWith, repPoz) {
            var index = strInfo.indexOf(strReplace);
            for (var i = 1; i < repPoz; i++)
                index = strInfo.indexOf(strReplace, index + 1);
            if (index >= 0)
                return strInfo.substr(0, index) + strWith + strInfo.substr(index + strReplace.length, strInfo.length);
            return strInfo;
        },


        yjsgMultiSelect: function () {


            var self = this;

            // multiple
            $('.yjsgmultiselect').wrap('<div class="btn-group yjsgmsgroup"></div>')
                .after('<button class="btn btn-primary yjsgmultideselect">Deselect All</button>')
                .multiselect({
                    enableFiltering: true,
                    maxHeight: 200,
                    includeSelectAllOption: true,
                    enableCaseInsensitiveFiltering: true,
                    numberDisplayed: 0
                });


            $('.yjsgmsgroup').each(function (index, element) {

                var findLabel = $(this).find('select').attr('id');
                $(this).attr('data-tiptrigger', findLabel);

            });

            function multiselect_deselectAll($el) {
                $('option', $el).each(function (element) {
                    $el.multiselect('deselect', $(this).val());
                });
            }

            $('.yjsgmultideselect').on('click', function (e) {
                e.preventDefault();
                var findSelect = $(this).parent().find('select').attr('id');
                multiselect_deselectAll($("#" + findSelect), $(this));
                $("#" + findSelect).change();
                self.setdefaultTab();
            });

            // single 	
            $('.yjsgselect').multiselect({
                maxHeight: 200
            });



            $('.yjsgselect').each(function (index, element) {

                var findLabel = $(this).parent().parent().find('select').attr('id');
                $(this).parent().parent()
                    .find('.btn-group')
                    .addClass('yjsgmsgroup')
                    .attr('data-tiptrigger', findLabel);

            });

        },

        setdefaultTab: function () {

            $('#mainbodyTab').addClass('active');
            $('#defaultmb').addClass('active in');

        },


        templateAssigend: function () {

            // if template is assigned we need the assigend Itemid to recreate files

            var self = this;

            var assigementsMenu = '#menu-assignment';
            var FindAssigements = $(assigementsMenu + ' input:checked').val();

            if (FindAssigements === undefined) {

                $('#jform_params_yjsg_assigements').attr('value', '');

            } else {

                $('#jform_params_yjsg_assigements').attr('value', FindAssigements);

            }

            $(assigementsMenu + " input").on('click', function (el) {

                var NewAssigements = $(assigementsMenu + ' input:checked').val();

                if (NewAssigements === undefined) {

                    $('#jform_params_yjsg_assigements').attr('value', '');

                } else {

                    $('#jform_params_yjsg_assigements').attr('value', NewAssigements);
                }

            });

        },
        docClickEvents: function () {

            var self = this;

            $(document).on('click', function (event) {

                // close chrome list on doc click 
                if ($(event.target).parents('.chromesHolder').length == 0) {

                    if ($('.chromesHolder').is(":visible")) {
                        $('.openChrome').removeClass('iconVisible');
                        $('.chromesHolder').fadeOut();
                        $('.chromesHolder').popover('hide');
                    }
                }
                // close settings panels on doc click
                if ($(event.target).parents('.settingpannel,.yjsgtoolbar,.yjsgsidebar').length == 0) {

                    if ($('.settingpannel').is(":visible")) {
                        $('.settingpannel').slideUp();
                    }
                }

            });

            //  when logo width is set auto adjust header grid and logo
            $("#jform_params_logo_width").change(function () {

                $(document).trigger("updatecomplete");
            });

            $(document).bind("updatecomplete", function () {
                self.headerGrid();
            });



        },
        adjustHeader: function () {

            var self = this;

            var logoOff = $('#jform_params_turn_logo_off');
            var headerOff = $('#jform_params_turn_header_block_off');
            var topmenuOff = $('#jform_params_turn_topmenu_off');
            var topmenuLocation = $('#jform_params_top_menu_location');

            // logo disabled
            logoOff.on('change', function () {
                var selected = $(this).find('input:checked').val();

                if (selected == 1) {

                    $('.yjsglogo').addClass('hideLogo');
                    $('#yjsg_headergrid').addClass('fullWidth');
                    $('#option-resut').append('<div class="logoDis">Logo is disabled</div>');
                    self.infoIcon(1);
                } else {

                    $('.yjsglogo').removeClass('hideLogo');
                    $('#yjsg_headergrid').removeClass('fullWidth');
                    $('.logoDis').remove();
                    self.infoIcon(0);
                }
            }).change();

            // header disabled
            headerOff.on('change', function () {
                var selected = $(this).find('input:checked').val();

                if (selected == 1) {

                    $('#yjsg_headerblock').addClass('headerOff');
                    $('#option-resut').append('<div class="headerDis">Header block is disabled</div>');
                    self.infoIcon(1);
                } else {

                    $('#yjsg_headerblock').removeClass('headerOff');
                    $('.headerDis').remove();
                    self.infoIcon(0);
                }
            }).change();

            // topmenu disabled

            topmenuOff.on('change', function () {
                var selected = $(this).val();

                if (selected != null) {

                    $('.topmenu').addClass('hidden');
                    $('.topmenuDis').remove();
                    $('#option-resut').append('<div class="topmenuDis">Top menu is disabled on selected pages</div>');
                    self.infoIcon(1);

                } else {

                    $('.topmenu').removeClass('hidden');
                    $('.topmenuDis').remove();
                    self.infoIcon(0);

                }
            }).change();

            // topmenu in header
            topmenuLocation.on('change', function () {
                var selected = $(this).val();

                if (selected == 1) {

                    $('#yjsg_headergrid').find('.opensettings,.settingpannel,.yjsg_moduleh,.YJSG_reset-values').addClass('hidden');
                    $('#yjsg_headergrid').prepend('<div class="topmenu orange prependTopmenu">top menu</div>');
                    $('#yjsg_topmenu').addClass('hidden');


                } else if (selected == 0) {

                    $('#yjsg_headergrid').find('.opensettings,.settingpannel,.yjsg_moduleh,.YJSG_reset-values').removeClass('hidden');
                    $('.prependTopmenu').remove();
                    $('#yjsg_topmenu').removeClass('hidden');


                }

            }).change();


        },
        headerGrid: function () {

            var self = this;

            var siteWidth = parseInt($('#jform_params_css_width').val());

            var logoWidth = parseInt($('#jform_params_logo_width').val());

            var computeLogoWidth = self.roundNumber(logoWidth / siteWidth * 100, 2);

            var headerGridWidth = self.roundNumber(100 - computeLogoWidth, 2);

            if (computeLogoWidth > 100) {
                computeLogoWidth = 100;
            }

            $('.yjsglogo').animate({
                width: '' + computeLogoWidth + '%'
            });
            $('#yjsg_headergrid').animate({
                width: '' + headerGridWidth + '%'
            });

        },

        customChrome: function (getchrome) {

            var self = this;

            var chrome = $('.openChrome');

            if (getchrome) {

                chrome = $(getchrome);
            }

            chrome.each(function (index, element) {

                var elm = $(this);
                var parent = elm.parent();
                var chromedefault = elm.data('chromedefault');
                var chromeModule = elm.data('chromemodule');
                var chromeHolder = parent.find('.chromesHolder');
                var chromeLinks = chromeHolder.find('a');
                var currentSelected = chromeHolder.find("[data-thischrome='" + chromeHolder.find('.defChromes').val() + "']");
				

                parent.addClass($(chromeModule).val());

                self.sliderSettings(parent);

                chromeHolder.find('a').removeClass("seldefault");
                chromeHolder.find("i").removeClass('fa-check-square-o').addClass('fa-square-o');
				
				
				var setHidden = chromeModule.replace('#','');
				chromeHolder.find('input[type=hidden]').attr('id',setHidden).attr('name','jform[params]['+setHidden+']');
				
				
				if(dbDefaults[setHidden]){
					
					chromeHolder.find('input[type=hidden]').val(dbDefaults[setHidden]);
					
				}

                currentSelected.addClass("seldefault");
                currentSelected.find("i").removeClass('fa-square-o').addClass('fa-check-square-o');

                elm.on('click', function (e) {

                    e.stopImmediatePropagation();
                    e.preventDefault();


                    $('.chromesHolder').fadeOut(400, function () {
                        $(this).popover('hide');
                    });

                    if (chromeHolder.is(":visible")) {
                        $(this).removeClass('iconVisible');
                        chromeHolder.fadeOut(400, function () {
                            $(this).popover('hide');
                        });
                    } else {
                        chromeHolder.fadeIn(400, function () {
                            $(this).popover('show');
                        });

                        $(this).addClass('iconVisible');

                    }

                });

                chromeLinks.on('click', function (e) {

                    e.stopImmediatePropagation();
                    e.preventDefault();

                    chromeHolder.find('a').removeClass("seldefault");
                    chromeHolder.find("i").removeClass('fa-check-square-o').addClass('fa-square-o');

                    $(this).addClass("seldefault");
                    $(this).find("i").removeClass('fa-square-o').addClass('fa-check-square-o');
                    $(chromeModule).attr('value', $(this).data('thischrome'));
                    parent.removeClass("YJsgxhtml YJsground YJsgblank YJsgtabs YJsgaccordion YJsgslides").addClass($(this).data('thischrome'));

                    self.sliderSettings(parent);

                });

            });

        },


        resetChromes: function (parent) {

            var self = this;
            var defChromes = $('.defChromes');

            if (parent) {

                defChromes = $(parent);
            }

            defChromes.each(function (e) {

                $(this).attr('value', $(this).data('default'));
                var setAsDefault = $(this).parent().find("[data-thischrome='" + $(this).data('default') + "']");

                $(this).parent().find('a').removeClass("seldefault");
                $(this).parent().find("i").removeClass('fa-check-square-o').addClass('fa-square-o');

                setAsDefault.addClass("seldefault");
                setAsDefault.find("i").removeClass('fa-square-o').addClass('fa-check-square-o');
                $(this).parent().parent().removeClass("YJsgxhtml YJsground YJsgblank YJsgtabs YJsgaccordion YJsgslides").addClass($(this).data('default'));
                self.sliderSettings($(this).parent().parent());

            });


        },

        sliderSettings: function (parent) {

            var self = this;

            if (parent.hasClass('YJsgslides') || parent.hasClass('YJsgtabs')) {

                var sliderType = 'YJsgslides';

                if (parent.hasClass('YJsgtabs')) {

                    sliderType = 'YJsgtabs';

                }

                switch (sliderType) {

                case 'YJsgslides':
                    var modalTitle = ' Slider settings';

                    break;

                case 'YJsgtabs':
                    var modalTitle = ' Tabs settings';
                    break;


                }

                if (parent.find('.openslider_settings').length) {

                    parent.find('.openslider_settings').remove();
                    parent.find('.openslider_settings_holder').remove();

                }

                var setId = parent.find('input.defChromes').attr('id').replace('_custom_chrome', '');
                var container = parent.find('.yjsg_module');

                var settingsHolder = $('<div/>', {
                    id: 'modal_settings_' + setId,
                    class: 'modal fade openslider_settings_holder',
                    'aria-hidden': 'true',
                    html: '<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h5 class="modal-title">' + setId + modalTitle + '</h5></div><div class="modal-body"><ul class="adminformlist"></ul></div><div class="modal-footer"><button type="button" class="btn btn-primary resetsliders">Reset</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div>'
                }).prependTo(container);

                $('<a/>', {
                    id: setId + '_slider_settings',
                    class: 'openslider_settings',
                    href: '#modal_settings_' + setId,
                    'data-toggle': 'modal',
                    'data-target': '#modal_settings_' + setId,
                }).prependTo(container);

                /* SLIDER PARAMS START HERE */
                var insertElements = settingsHolder.find('.modal-body ul.adminformlist');

                // autoslide
                var SliderAutoslide = 'slider_autoslide_' + setId;
                var AutoslideContent = 'To turn on autoslide on page load set this to a value greater than 1500.';
                self.elementTemplate('text', SliderAutoslide, 'Auto slide', AutoslideContent, 0, insertElements);

                // effectduration
                var SliderEffectduration = 'slider_effectduration_' + setId;
                var EffectdurationContent = 'This is time needed for transition effect to finish';
                self.elementTemplate('text', SliderEffectduration, 'Effect duration', EffectdurationContent, 600, insertElements);

                // default effect
                var SliderEffect = 'slider_effect_' + setId;
                var EffectContent = 'Select default transition effect type';
                var EffectOptions = 'slide=Slide|slidefade=Slidefade|fade=Fade';
                self.elementTemplate('select', SliderEffect, 'Effect type', EffectContent, 'slide', insertElements, EffectOptions);

                // default tab type
                if (sliderType == 'YJsgtabs') {
                    var TabsType = 'tabs_type_' + setId;
                    var TabsTypeContent = 'Select default tabs type';
                    var TabsTypeOptions = 'tabnav=Tab nav|tabpills=Tab pills';
                    self.elementTemplate('select', TabsType, 'Tabs type', TabsTypeContent, 'tabnav', insertElements, TabsTypeOptions);
                }


                // navigation
                var SliderNavigation = 'slider_navigation_' + setId;
                var NavigationContent = 'If set to yes navigation arrows will be visible.';
                self.elementTemplate('radio', SliderNavigation, 'Show navigation', NavigationContent, 1, insertElements);

                if (sliderType == 'YJsgslides') {
                    // pagination
                    var SliderPagination = 'slider_pagination_' + setId;
                    var PaginationContent = 'If set to yes slider pagination will be visible.';
                    self.elementTemplate('radio', SliderPagination, 'Show pagination', PaginationContent, 1, insertElements);
                }

                /* reactive styles and popovers for new elements */
                self.fixStyles();


            } else {

                parent.find('.openslider_settings').remove();
                parent.find('.openslider_settings_holder').remove();

            }

            self.resetSliders('#modal_settings_' + setId);

        },



        resetSliders: function (container) {

            var self = this;

            $(container + ' .resetsliders').on('click', function (e) {

                $(container + ' [data-defaultvalue]').each(function (e) {


                    var defaultvalue = $(this).data('defaultvalue');
                    var element = $(this).attr('id');


                    if ($(this).is('select') || $(this).is('input')) {
                        $(this).val(defaultvalue);
                    }

                    if ($(this).is('div') || $(this).is('input')) {

                        var filed_name = $('[name="jform[params][' + element + ']"]');
                        var getCurrent = filed_name.filter(':checked').val();
                        if (getCurrent != defaultvalue) {

                            filed_name.filter('[value="' + defaultvalue + '"]').prop('checked', true).parent('.btn').addClass('active');
                            filed_name.filter('[value="' + getCurrent + '"]').prop('checked', false).parent('.btn').removeClass('active');
                        }


                    }
                });



            });



        },

        elementTemplate: function (type, element, title, content, defaultvalue, insert, selectoptions) {

            var self = this;
            var defaults = dbDefaults;
            var dataDefault = defaultvalue;

            if (defaults[element]) {

                defaultvalue = defaults[element];
            }

            if (type == 'radio') {

                firstchecked = '';
                secondchecked = '';

                if (defaultvalue == 0) {

                    firstchecked = 'checked="checked" ';
                    secondchecked = '';
                } else {

                    firstchecked = '';
                    secondchecked = 'checked="checked" ';
                }
                var ElementLines = '<label id="jform_params_' + element + '-lbl" for="jform_params_' + element + '"';
                ElementLines += ' class="adminLabel" data-original-title="' + title + '"';
                ElementLines += ' data-content="' + content + '">' + title + '</label>';
                ElementLines += '<div id="' + element + '" class="yjsgradio" data-defaultvalue="' + dataDefault + '">';
                ElementLines += '<fieldset id="jform_params_' + element + '" class="radio btn-group newradio"  data-toggle="buttons">';
                ElementLines += '<label id="lbl-jform_params_' + element + '0"  class="btn btn-yjsg btn-sm">Yes';
                ElementLines += '<input type="radio" id="jform_params_' + element + '0" name="jform[params][' + element + ']" value="1" ';
                ElementLines += '' + firstchecked + 'class="btn btn-yjsg btn-sm"/>';
                ElementLines += '</label>';
                ElementLines += '<label id="lbl-jform_params_' + element + '1"  class="btn btn-yjsg btn-sm">No';
                ElementLines += '<input type="radio" id="jform_params_' + element + '1" name="jform[params][' + element + ']" value="0" ';
                ElementLines += '' + secondchecked + 'class="btn btn-yjsg btn-sm"/>';
                ElementLines += '</label>';
                ElementLines += '</fieldset>';
                ElementLines += '</div>';

                var elementOutput = $('<li/>', {
                    class: 'newelem lih-' + element,
                    html: ElementLines
                }).appendTo($(insert));

                var filed_name = $('[name="jform[params][' + element + ']"]');
                var getCurrent = filed_name.filter(':checked').val();
                if (getCurrent != defaultvalue) {

                    filed_name.filter('[value="' + defaultvalue + '"]').prop('checked', true).parent('.btn').addClass('active');
                    filed_name.filter('[value="' + getCurrent + '"]').prop('checked', false).parent('.btn').removeClass('active');
                }

            }

            if (type == 'text') {

                var ElementLines = '<label id="jform_params_' + element + '-lbl" for="jform_params_' + element + '" class="adminLabel" ';
                ElementLines += 'data-original-title="' + title + '" ';
                ElementLines += 'data-content="' + content + '">' + title + '</label>';
                ElementLines += '<input type="text" id="jform_params_' + element + '" class="text_area" name="jform[params][' + element + ']" ';
                ElementLines += 'value="' + defaultvalue + '" data-tiptrigger="jform_params_' + element + '"  data-defaultvalue="' + dataDefault + '" />';

                var elementOutput = $('<li/>', {
                    class: 'newelem lih-' + element,
                    html: ElementLines
                }).appendTo($(insert));
            }

            if (type == 'select') {

                var splitAll = selectoptions.split('|');
                var selOptions = [];

                $.each(splitAll, function (i, e) {

                    var splitOption = e.split('=');
                    var option = splitOption[0];
                    var title = splitOption[1];

                    selOptions[i] = '<option value="' + option + '">' + title + '</option>';

                });

                var ElementLines = '<label id="jform_params_' + element + '-lbl" for="jform_params_' + element + '" class="adminLabel" data-original-title="' + title + '" data-content="' + content + '">' + title + '</label>';
                ElementLines += '<div class="YJSG_sbox ' + element + '">';
                ElementLines += '<select name="jform[params][' + element + ']" id="jform_params_' + element + '" data-tiptrigger="jform_params_' + element + '"';
                ElementLines += ' data-defaultvalue="' + dataDefault + '">';
                ElementLines += selOptions.join('\n');
                ElementLines += '</select>';
                ElementLines += '</div>';

                var elementOutput = $('<li/>', {
                    class: 'newelem lih-' + element,
                    html: ElementLines
                }).appendTo($(insert));

                $('#jform_params_' + element).val(defaultvalue);

            }

        },

        infoIcon: function (insert, flag) {

            var self = this;

            var compdmsg = $('#option-resut').html().length;

            if (insert == 1 || yjsgHasUpdate == 1) {
                $('.yjsg_version_check i').removeClass('adminicons-systemcheck').addClass('adminicons-info');

            } else if (insert == 0) {
                $('.yjsg_version_check i').addClass('adminicons-systemcheck').removeClass('adminicons-info');

            }

            if (compdmsg > 0) {
                $('.yjsg_version_check i').stop(true).animate({
                    marginRight: 20
                }, 300).delay(300).animate({
                    marginRight: 5
                }, 300);

            }

            if (compdmsg == 0) {
                $('#settmsgBox').addClass('hide');
            } else {
                $('#settmsgBox').removeClass('hide');
            }

        },
        systemMessages: function () {

            var self = this;
            var componentDis = $('#jform_params_component_switch');

            // component disabled
            componentDis.on('change', function () {
                var selected = $(this).val();
                if (selected != null) {
                    $('#option-resut').html(comp_dis);
                    self.infoIcon(1);
                } else {
                    $('#option-resut').html('');
                    self.infoIcon(0);
                }
            }).change();

        },

        triggerPopover: function (elements) {

            var self = this;

            $(elements).on('mouseenter', function (event) {

                var getId = $(this).attr('data-tiptrigger');

                $('label#' + getId + '-lbl').popover({
                    html: true,
                    trigger: 'manual',
                    placement: 'left',
                    animation: true,
                    template: '<div class="yjTips popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
                    delay: {
                        show: 500,
                        hide: 500
                    }
                }).popover('show');

            }).on('mouseleave', function (event) {

                var getId = $(this).attr('data-tiptrigger');

                $('label#' + getId + '-lbl').popover('hide');

            });
        },

        fixStyles: function () {

            var self = this;

            var Elements = 'select,input.text_area,input.readonly,input.inputbox,textarea,.radio.btn-group,div.btn-group.yjsgmsgroup,span.disableFake';
            $(Elements).each(function (el, key) {

                var getId = $(this).attr('id');
                $(this).attr('data-tiptrigger', getId)

                if ($('#' + getId).attr('disabled')) {

                    $('#' + getId).wrap('<div class="disabledWrap"></div>');
                    $('<span/>', {
                        "class": 'disableFake',
                        "css": {
                            "opacity": 0
                        },
                        "data-tiptrigger": getId
                    }).appendTo($('#' + getId).parent());

                }

            });

            self.triggerPopover(Elements);

            $('.yjsgtips').popover({
                html: true,
                trigger: 'hover',
                placement: 'bottom'
            });

            $('.yjsgchrometips').popover({
                html: true,
                trigger: 'manual'
            });
            // tabs

            $('#sidetabs a[data-toggle="tab"]').on('shown.bs.tab', function () {
                localStorage.setItem('lastTab', $(this).attr('href'));
            });

            //go to the latest tab, if it exists:
            var lastTab = localStorage.getItem('lastTab');
            if (lastTab) {
                $('#sidetabs a[href=' + lastTab + ']').tab('show');
            } else {
                // Set the first tab if cookie do not exist
                $('#sidetabs a[data-toggle="tab"]:first').tab('show');
            }

            // bootstrap radio group
            $('div.btn-group[data-toggle-name]').each(function () {
                var group = $(this);
                var form = group.parents('form').eq(0);
                var name = group.attr('data-toggle-name');
                var hidden = $('input[name="' + name + '"]', form);
                $('label', group).each(function () {
                    var button = $(this).find('input[type="radio"]');
                    $(this).on('click', function () {
                        hidden.val($(this).val());
                    });
                    if (button.val() == hidden.val()) {
                        $(this).addClass('active');
                    }
                });
            });

            //hide inputs and set bootstrap class
            $('.btn-group label.btn input[type=radio]').hide().filter(':checked').parent('.btn').addClass('active');

        },
        yjsgBackgroundEl: function () {

            var self = this;
            $('.yjsgbackgrounds .patterns').each(function (index, el) {

                var parent = $(this).parent().parent();
                var input = parent.find('input');
                var getBackground = $(this).find('img').attr('src');
                var setImage = $(this).data('thisimg');
                var getPreview = $(this).find('.preview');
                var getDefault = $(this).data('defaultimg');
                var resetButton = parent.find('.resetBgs');

                $(this).on('mouseenter', function (event) {

                    $(getPreview).css({
                        "display": "block",
                        "background-image": "url(" + getBackground + ")"
                    });

                }).on('mouseleave', function (event) {

                    $(getPreview).css('display', 'none');

                }).on('click', function (event) {

                    parent.find('.patterns').removeClass("selected");
                    $(this).addClass("selected");
                    $(input).val(setImage);

                });

                resetButton.on('click', function (event) {
                    event.preventDefault();
                    parent.find('.patterns').removeClass("selected");
                    parent.find('.defaultImg').addClass("selected");
                    var defValue = parent.find('.defaultImg').data("thisimg");

                    if (defValue) {
                        $(input).val(defValue);
                    } else {
                        $(input).val('');
                    }

                });

                $('#toolbar-reset').on('click', function (event) {
                    event.preventDefault();
                    parent.find('.patterns').removeClass("selected");
                    parent.find('.defaultImg').addClass("selected");

                });

            });

            self.layoutTypeEl();

        },

        layoutTypeEl: function () {

            var self = this;

            var bgSettings = $('.lih-bodybackgroundsettings');
            var bgType = $('.lih-backgroundtype');
            var bgPattern = $('.lih-defaultpattern');
            var bgImage = $('.lih-defaultbgimage');
            var bgColor = $('.lih-bodybgcolor');
            var allParrents = [bgSettings, bgType, bgPattern, bgImage, bgColor];

            $('#jform_params_layoutType').on('change', function (event) {

                var currentvalue = $(this).val();
                var bgtypeValue = $('#jform_params_backgroundType').val();

                if (currentvalue == 1) { // full width hide all

                    $.each(allParrents, function (el, index) {
                        $(this).addClass('hide');
                    });

                } else {

                    $.each(allParrents, function (el, index) {
                        $(this).removeClass('hide');
                    });

                    if (bgtypeValue == 'pattern') {

                        bgPattern.removeClass('hide');
                        bgImage.addClass('hide');
                        bgColor.addClass('hide');
                    }
                    if (bgtypeValue == 'image') {

                        bgImage.removeClass('hide');
                        bgPattern.addClass('hide');
                        bgColor.addClass('hide');
                    }

                    if (bgtypeValue == 'color') {

                        bgColor.removeClass('hide');
                        bgImage.addClass('hide');
                        bgPattern.addClass('hide');
                    }

                }

            }).change();

            $('#jform_params_backgroundType').on('change', function (event) {

                var currentvalue = $(this).val();
                var layoutValue = $('#jform_params_layoutType').val();
				
				
				if(layoutValue){
				
						if (currentvalue == 'pattern' && layoutValue == 2) {
		
							bgPattern.removeClass('hide');
							bgImage.addClass('hide');
							bgColor.addClass('hide');
		
						} else if (currentvalue == 'image' && layoutValue == 2) {
		
							bgImage.removeClass('hide');
							bgPattern.addClass('hide');
							bgColor.addClass('hide');
		
						} else if (currentvalue == 'color' && layoutValue == 2) {
		
							bgColor.removeClass('hide');
							bgImage.addClass('hide');
							bgPattern.addClass('hide');
		
						}
				}else{
					
					
						if (currentvalue == 'pattern') {
		
							bgPattern.removeClass('hide');
							bgImage.addClass('hide');
							bgColor.addClass('hide');
		
						} else if (currentvalue == 'image') {
		
							bgImage.removeClass('hide');
							bgPattern.addClass('hide');
							bgColor.addClass('hide');
		
						} else if (currentvalue == 'color') {
		
							bgColor.removeClass('hide');
							bgImage.addClass('hide');
							bgPattern.addClass('hide');
		
						}					
					
				}

            }).change();

        },

        getStyle: function () {

            var self = this;
            var getcurrentStyle = $(self.settings.currentstyle).val().split("|");
            return {
                styleName: getcurrentStyle[0],
                styleColor: getcurrentStyle[1]
            };
        },

        yjsgLogoImage: function () {

            var self = this;

            // used by yjsglogo and yjsgmedia element
            $('.modaliframe').on('show.bs.modal', function (e) {
                var iframeOpen = $(this).data('iframesrc');

                $(this).find('.modal-body').html('<iframe src="' + iframeOpen + '" width="100%" height="500" frameborder="0" allowtransparency="true"></iframe>');
            })

            $('#prev_logo').on('click', function (el) {
                el.preventDefault();
                var showImage = $("#prev_logo").find('img').attr('src');
                $('#logoModalPreview').find('.modal-body').html('<img src="' + showImage + '" />');
                $('#logoModalPreview').modal('show');

            });

            function add_image() {

                var current_style = self.getStyle().styleName;

                var slikica_src = $('#jform_params_logo_image').val();
                if (slikica_src) {
                    $('#show_logo').attr('src', self.sitepath + slikica_src);
                    $('#logoImage').attr('src', self.sitepath + slikica_src);
                    $('#prev_logo').attr('href', self.sitepath + slikica_src);
                } else {
                    $('#show_logo').attr('src', self.templatepath + '/images/' + current_style + '/logo.png');
                    $('#logoImage').attr('src', self.templatepath + '/images/' + current_style + '/logo.png');
                    $('#prev_logo').attr('href', self.templatepath + '/images/' + current_style + '/logo.png');
                }

                $(self.settings.currentstyle).on('change', function (el) {
                    var c = self.getStyle().styleName;
                    $('#show_logo').attr('src', self.templatepath + '/images/' + c + '/logo.png');
                    $('#logoImage').attr('src', self.templatepath + '/images/' + c + '/logo.png');
                    $('#prev_logo').attr('href', self.templatepath + '/images/' + c + '/logo.png');
                });

            }

            function setImageInfo(findele) {
                var img = new Image();
                var slikica_src = $('#show_logo').attr('src') + '?' + Math.random();
                img.src = slikica_src;
                img.onload = function () {
                    var img_real_width = this.width;
                    var img_real_height = this.height;
                    if (findele == 'add_dimensions' || findele == 'clear_logo' || findele == 'setText') {
                        $('#image_dimensions').html('This image is <b>' + this.width + 'px wide</b> and <b>' + this.height + 'px high.</b> Click on image for full preview.');
                    }
                    if (findele == 'add_dimensions' || findele == 'clear_logo') {
                        $('#jform_params_logo_height').val(img_real_height + 'px').animate({
                            backgroundColor: '#D5EEFF'
                        }, 300).delay(300).animate({
                            backgroundColor: '#ffffff'
                        }, 300);
                        $('#jform_params_logo_width').val(img_real_width + 'px').animate({
                            backgroundColor: '#D5EEFF'
                        }, 300, function () {

                            self.headerGrid();

                        }).delay(300).animate({
                            backgroundColor: '#ffffff'
                        }, 300);
                    }
                }
            }

            $('#add_dimensions').on('click', function (event) {
                event.preventDefault();
                setImageInfo('add_dimensions');
            });

            $('#jform_params_logo_image').on('change paste', function () {
                add_image();
                setImageInfo('jform_params_logo_image');
            });
            $('#clear_logo').on('click', function (event) {
                event.preventDefault();
                add_image();
                setImageInfo('clear_logo');
            });

            window.yjsgCloseModal = function (getElem) {

                $('#jform_params_logo_image').trigger('change');
                $('.modal').modal('hide');
                setImageInfo('setText');
            };

            window.jInsertFieldValue = function (value, id) {

                var element = $('#' + id);
                element.val(value);
                element.trigger('change');
                $('.modal').modal('hide');

            }

            add_image();
            setImageInfo('setText');

        },

        adminToolbar: function () {

            var self = this;

            $('#toolbar-reset').on('click', function (e) {
                e.preventDefault();
                self.yjsgresetForm();
                $(self.settings.containers).trigger('mouseleave');
                $('.yjsgmultideselect').trigger('click');
                self.headerGrid();
                self.resetChromes();
            });

            $('#toolbar-apply').on('click', function (e) {
                e.preventDefault();
                self.adminUpdate('adminUpdate');

            });

            $('#toolbar-save').on('click', function (e) {
                e.preventDefault();
                self.yjsgTime();
                self.yjsgValidate('style.save');

            });

            $('#toolbar-save-copy').on('click', function (e) {
                e.preventDefault();
			    self.adminUpdate('copyTemplate');

            });

            $('#toolbar-cache').on('click', function (e) {
                e.preventDefault();
                self.adminUpdate('clearCache');

            });

            $('#jform_params_bootstrap_version').on('change', function (e) {
                self.adminUpdate('checkBootstrap');
            });

            $('#toogleselection').on('click', function (e) {
                e.preventDefault();
                self.toggleSelection();

            });

            $('#closebtn').on('click', function (e) {
                e.preventDefault();
                self.yjsgValidate('style.cancel');

            });

        },

        toggleSelection: function () {

            $('.chk-menulink').each(function () {

                this.checked = !this.checked;
            });

        },

        addMessage: function (msg) {

            var self = this;

            clearTimeout(this.msgTimeout);
            alertbox = $('.msg-alert');

            alertbox.html(msg).fadeIn(500);

            self.msgTimeout = setTimeout(function () {
                alertbox.fadeOut(500);
            }, 5000);

        },

        adminUpdate: function (setTask) {

            var self = this;

            this.formTask.val(setTask)

            this.adminForm.submit(function (event) {

                event.preventDefault();

                var values = $(this).serializeArray();

                if (setTask != 'checkBootstrap') {
                    $('.progress-bar').animate({
                        width: "100%"
                    }, 50);
                }

                $.ajax({
                    url: self.pluginpath + 'elements/yjsgupdate.php',
                    type: "post",
                    data: $.extend(values, {
                        task: setTask
                    }),
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {

                        $('.progress-bar').delay(350).animate({
                            width: "0%"
                        }, 10, function () {

                            if (typeof data.message != 'undefined') {
                                var response = data.message;
                            } else if (typeof data.message_er != 'undefined') {
                                response = data.message_er;
								
                            } else {
                                response = data.error;
                            }
                            if (typeof data.bootstrap == 'undefined') {
                                self.addMessage(response);
                            }
							
							 if (typeof data.newtemplateid != 'undefined') {
								 
								 window.location = self.sitepath+'administrator/index.php?option=com_templates&task=style.edit&id='+data.newtemplateid;
							 }
							
							
                            if (typeof data.addclass != 'undefined') {
								
                               $('.msg-alert').removeClass('alert-info').addClass('alert-danger');
							   
                            }else{
								
							   $('.msg-alert').removeClass('alert-danger').addClass('alert-info');
							}
                        });

                        self.adminForm.unbind();
                    },
                    error: function (request, textStatus, errorThrown) {

                        $('.progress-bar').delay(350).animate({
                            width: "0%"
                        }, 10, function () {

                            if (request.status === 0) {
                                self.addMessage('<span class="error">Not connected.\n Verify Network.</span>');
                            } else if (request.status == 404) {
                                self.addMessage('<span class="error">Requested page not found. [404]</span>');
                            } else if (request.status == 500) {
                                self.addMessage('<span class="error">Internal Server Error [500].</span>');
                            } else if (textStatus === 'parsererror') {
                                self.addMessage('<span class="error">Requested JSON parse failed.</span>');
                            } else if (textStatus === 'timeout') {
                                self.addMessage('<span class="error">Time out error.</span>');
                            } else if (textStatus === 'abort') {
                                self.addMessage('<span class="error">Ajax request aborted.</span>');
                            } else {
                                self.addMessage('<span class="error">Uncaught Error.\n' + request.responseText + '</span>');
                            }

                        });
                        self.adminForm.unbind();

                    }
                });
            });
            self.yjsgValidate();
            self.yjsgTime();
        },

        yjsgKeepAlive: function () {

            var self = this;

            $.ajax({
                url: 'index.php',
                complete: function () {
                    setTimeout(self.yjsgKeepAlive, refreshTime);
                }
            });

        },

        yjsgValidate: function (addTask) {

            var self = this;
            var validators = 'input.required,[aria-required="true"]';

            if ($(validators).length) {
                $(validators).each(function () {

                    var value = $(this).val();
                    var id = $(this).attr('id');
                    var label = $('#' + id + '-lbl').text();

                    if ($(this).val() != '' && typeof addTask != 'undefined') {
                        self.formTask.val(addTask);
                    }

                    if ($(this).val() != '') {

                        self.adminForm.submit();

                    } else {

                        self.addMessage(label + ' input must have a value');

                    }

                });

            } else {

                if (typeof addTask != 'undefined') {
                    self.formTask.val(addTask);
                }

                self.adminForm.submit();
            }

        },

        setColors: function () {

            var self = this;

            $('.yjsg-colorpicker').each(function (index, element) {

                var Picker = $(element);
                var pickerParrent = $(element).parent().parent().parent();
                var pickerSwithc = $(element).data('switcher');
                var currentColor = Picker.attr('value').replace('#', '');
                var currentDefault = $(pickerSwithc).data('currentdefault').split("|");
                var currentDefaultStyle = currentDefault[0];
                var currentDefaultColor = currentDefault[1];

                $(pickerSwithc).on('change', function () {

                    var split_value = $(this).val().split("|");
                    var defLinkColor = '#' + split_value[1];

                    Picker.val(defLinkColor).trigger('change');

                    Picker.minicolors('settings', {
                        value: defLinkColor
                    });

                });

                Picker.minicolors({
                    position: $(this).attr('data-position') || 'right',
                    control: $(this).attr('data-control') || 'hue',
                    theme: 'bootstrap',
                    change: function (hex) {

                        var split_value = $(pickerSwithc + ' option:selected').val().split("|");
                        var style_name = split_value[0];
                        var style_color = hex.replace('#', '');

                        $(pickerSwithc + ' option:selected').attr('value', style_name + '|' + style_color);

                    }
                });

                $(pickerSwithc + ' option').each(function (index, element) {

                    var value = $(this).val().split("|");
                    var style = value[0];
                    var color = value[1];

                    if (currentDefaultStyle == style) {

                        $(this).val(currentDefaultStyle + '|' + currentDefaultColor);
                    }

                });

                $(pickerSwithc).val(currentDefaultStyle + '|' + currentDefaultColor);

            });

            // yjsgcolor element
            $('.yjsg-colorelement').each(function (index, element) {
                var Picker = $(element);
                Picker.minicolors({
                    position: $(this).attr('data-position') || 'right',
                    control: $(this).attr('data-control') || 'hue',
                    theme: 'bootstrap'
                });

                $('#toolbar-reset').on('click', function () {
                    Picker.minicolors('settings', {
                        value: $(this).val()
                    });
                });

            });

        },
        yjsgTime: function () {

            var self = this;

            var yjsgFont = parseInt($('#default_font').val());
            var fontCookie = 'yjsg_fs_z' + fontc;
            var lhCookie = 'yjsg_lh_z' + fontc;

            $.post(self.pluginpath + 'includes/yjsgcore/yjsgajax_reset.php', {
                ajaxreset: Math.random()
            });
            $.removeCookie(fontCookie, {
                path: '/'
            });
            $.removeCookie(lhCookie, {
                path: '/'
            });
            $.cookie(fontCookie, yjsgFont, {
                expires: 2,
                path: '/'
            });

        },

        yjsgresetForm: function () {

            var self = this;
            $('div.yjsg_grid_widths').each(function (event) {

                var getData = $(this).find('a.YJSG_reset-values');
                if (getData.length) {
                    var values = getData.attr('data-resets').split('|');
                    var elemsCSS = getData.data('elementcss');
                    $('input.' + elemsCSS + '[type=text]').each(function (i, el) {
                        $(this).val(values[i]);
                    });
                    $('input.' + elemsCSS + '[type=checkbox]').each(function (i, el) {
                        $(this).attr("checked", false);
                        $(this).next().removeClass("fa-lock").addClass('fa-unlock');
                    });
                    $('input.' + elemsCSS + '[type=hidden]').val(getData.attr('data-resets'));
                }

            });

            $.each(tplDefaults, function (key, i) {

                var filed_name = self.adminForm.find('[name="jform[params][' + key + ']"]');
                var filed_type = filed_name.attr('type');
                var filed_curr_value = filed_name.attr('value');
                var default_value = i;

                // text and textarea
                if (filed_type == 'text' || filed_name.is('textarea')) {
                    filed_name.val(default_value);

                }

                // radio 
                if (filed_name.is(':radio')) {

                    var getCurrent = filed_name.filter(':checked').val();

                    if (getCurrent != default_value) {

                        filed_name.filter('[value="' + default_value + '"]').prop('checked', true).parent('.btn').addClass('active');
                        filed_name.filter('[value="' + getCurrent + '"]').prop('checked', false).parent('.btn').removeClass('active');
                    }

                }

                // lists  yjsg_get_styles
                if (filed_name.is('select')) {
                    if (filed_name.data('field') == 'yjsgstyles') {
                        var fieldId = '#' + filed_name.attr('id');
                        $(fieldId + ' option').each(function (index, element) {
                            var get_defaults = $(this).attr('data-defaultcolor');
                            if (get_defaults != $(this).attr('value')) {
                                $(this).val(get_defaults);
                            }
                            filed_name.trigger('change');
                        });
                        filed_name.val(default_value);
                        filed_name.trigger('change');
                    } else {
                        filed_name.val(default_value);
                        filed_name.trigger('change');
                    }

                }
                filed_name.trigger('change');
            });
            $('#jform_params_component_switch').val('').change();
            $('#jform_params_define_itemid').val('').change();
            $('#jform_params_logo_image').val('').change();
            $('#jform_params_turn_topmenu_off').val('').change();

            $('.yjmultiselect').multiselect('refresh');
            $('.yjsgselect').multiselect('refresh');

        },
        selectBoxes: function () {

            var self = this;

            // loop all selects
            $('select').each(function (el, i) {
                // check if select has disabled/enabled options capability
                var children = $(this).find('option.enable_next, option.disable_next'),
                    selectID = $(this).attr('id');
                // if no children, bail out
                if (children.length == 0) return;
                //*			
                // make click events on bootstrap elements
                $(this).on('change', function (e) {
                    // get li class to check if anything should be enabled or disabled
                    var cls = $("option:selected", this).attr('class').split(' ');

                    // loop classes
                    cls.forEach(function (btCls, index) {
                        // if class to enable or disable is found, proceed, else, bail out

                        if (btCls == 'enable_next' || btCls == 'disable_next') {
                            var affected = cls[index + 1].split('|');

                        } else {
                            return;
                        }

                        // store all consequent elements disable or enable to keep them disabled or enabled, depending on what the parent will do
                        // this will use the inverse action meaning if parent disabled, this keeps them enabled
                        var affected2 = new Array();

                        // loop affected elements to see what should be kept enabled or disabled
                        affected.forEach(function (a, i) {

                            var selectedResult = $('#jform_params_' + a).find("option:selected"),
                                ccls = selectedResult.attr('class');

                            if (!ccls) {
                                return;
                            }

                            var classes = ccls.split(' '),
                                searchClass = 'enable_next' == btCls ? 'disable_next' : 'enable_next';
                            if (!selectedResult.hasClass(searchClass)) {
                                return;
                            }
                            // get enable/disable index from array
                            var clsIndex = classes.indexOf(searchClass) + 1;
                            if (0 == clsIndex) {
                                return;
                            }

                            // put elements in second array
                            affected2 = classes[clsIndex].split('|').join(",");

                        })
                        // see what action should be taken
                        switch (btCls) {
                            // enable items
                        case 'enable_next':
                            affected.forEach(function (elId) {
                                var el = $('#jform_params_' + elId);

                                if ($('#' + selectID).attr('disabled')) return;

                                // if element was disabled by some previous select, bail out so you won't interfere with previous disable/enable
                                if (el && affected2.indexOf(elId) == -1) {

                                    $('#jform_params_' + elId).attr('disabled', false);
                                    $("span[data-tiptrigger='jform_params_" + elId + "']").addClass('hidden');

                                }
                            });
                            break;
                            // disable items
                        case 'disable_next':
                            affected.forEach(function (elId) {
                                var el = $('#jform_params_' + elId);
                                // if element was disabled by some previous select, bail out so you won't interfere with previous disable/enable
                                if ($('#' + selectID).attr('disabled')) return;

                                if (el) {

                                    $('#jform_params_' + elId).attr('disabled', true);
                                    $("span[data-tiptrigger='jform_params_" + elId + "']").removeClass('hidden');

                                }
                            });
                            break;
                        }
                    })
                })
            }).change();

        },
        sortLayout: function () {

            var self = this;

            // sort layout
            $.each(yjsglayout_array, function (k, v) {
                $('#' + v).attr('data-position', k).addClass('yjsgorder');
            });

            for (var i = 1; i <= $('.yjsgorder').length; i++) {
                var $box = $('.yjsgorder[data-position="' + i + '"]');
                $box.appendTo($('.yjsg_layoutholder'));
            }

        },

        openSettings: function () {

            var self = this;

            $(self.settings.setttigger).each(function () {
                var openSettings = $(this).data('settings');
                var getDirection = $(this).data('direction');
                var getscrollTo = $(this).data('scrollto');
                $(this).click(function (e) {
                    e.stopPropagation();
                    if (getDirection != 'side') {

                        $(".settingpannel:not(" + openSettings + ")").slideUp();
                        $(openSettings).slideToggle();

                    } else {

                        $(".settingpannel:not(" + openSettings + ")").slideUp();
                        $(openSettings).animate({
                            'width': 'toggle'
                        });

                    }

                    if (getscrollTo != null) {
                        $('html').animate({
                            scrollTop: $($.attr(this, 'href')).offset().top
                        }, 500);
                        return false;
                    }

                });
            });

        },

        getBoxes: function (container) {

            var self = this;

            var containers = $(self.settings.containers);

            if (container) {

                containers = $(container);
            }


            containers.each(function (e, i) {


                var elems = $(this).find(self.settings.inputs);
                var addClass = $(elems[1]).attr('class') + ' main_serialized';


                if (elems.length == 0) return;


                var locks = $(this).find(self.settings.checks);


				var addName = 'jform[params]['+$(this).find('.YJSG_reset-values').data('elementcss')+']';
				
				
                var hiddenInput = $('<input>').attr({
                    'type': 'hidden',
                    'class': addClass,
                    'name': addName,
                    'value': ''
                }).insertAfter(elems.last());




                var initialValue = '';

                elems.each(function (el, i) {

                    $(this).parent().parent().css('width', $(this).val() + '%');

                    if ($(this).val() <= 10 && $(this).val() > 1) {

                        $(this).parent().parent().addClass('smalFonts');

                    } else if ($(this).val() > 10) {

                        $(this).parent().parent().removeClass("smalFonts");
                    }

                    if ($(this).val() <= 1) {
                        $(this).parent().parent().addClass('outside').css('z-index', 100 - el);
                    } else if ($(this).val() > 1) {
                        $(this).parent().parent().removeClass('outside');
                    }

                    initialValue += $(this).val();

                    initialValue += '|';

                });

                locks.each(function (el, i) {
                    initialValue += el.checked ? 1 : 0;
                    if ($(i).is(":checked")) {
                        $(this).next().toggleClass("fa-unlock fa-lock");
                    }
                    if (i !== locks.length - 1) initialValue += '|';
                });

                hiddenInput.val(initialValue);

                elems.on('click', function (event) {
                    this.select();
                });

                elems.on('keyup', function () {
                    self.assembleVariable(elems, locks, hiddenInput, this);
                });

                locks.on('click', function (e) {
                    e.stopImmediatePropagation();
                    $(this).next().toggleClass("fa-unlock fa-lock");
                    self.assembleVariable(elems, locks, hiddenInput, false);
                })

                var hasSerialized = $(this).find('.main_serialized');
                if (hasSerialized.length > 1) {
				  $(this).find('.main_serialized:eq( 1 )').remove();
				  
                }

            });

        },

        selectLayout: function (getlayout) {


            var self = this;

            var layout = $('.layoutOption');

            if (getlayout) {

                layout = $(getlayout);
            }

            layout.on('click', function () {
                $(this).parent().find('.layoutOption').removeClass('active');
                var layout = $(this).data('layout');
                $(this).addClass('active');
                var findSelect = $(this).parent().parent().find('select');
                $(findSelect).val(layout).trigger('change');
            });

            layout.tooltip({
                container: 'body'
            });



        },

        mainbodyLayout: function (layout) {

            var self = this;

            var container = $('.mbLayout');

            if (layout) {

                container = $(layout);
            }

            $('.mbLayout').each(function (index, element) {

                var layout = $(this);
                var findSelect = layout.find('.selectLayout select');
                var jinsets = layout.find('.jinsets');
                var jcomponent = layout.find('.jcomponent');
                var jmainbodygrid = layout.find('.jmainbodygrid');
                var jholdinsets = layout.find('.jholdinsets');
                var jleft = layout.find('.jleft');
                var jright = layout.find('.jright');
                var jinset = layout.find('.jinset');
                var jmainbody = layout.find('.jmainbody');

                $(findSelect).on('change', function () {


                    var str = $(this).val();
                    var calcMargin = $(jleft).find('input.input-mini').val();
                    var calcWidth = $(jmainbody).find('input.input-mini').val();

                    $(jinsets).css('width', 100 - calcWidth + '%'); // insettop insetbottom

                    if (str == 1) { //leftmidright

                        layout.addClass('leftmidright');
                        layout.removeClass('leftrightmid midleftright');
                        layout.find('.layoutOption').removeClass('active');
                        layout.find('.layoutOption[data-layout="' + str + '"]').addClass('active');

                        jleft.insertBefore(jmainbody);
                        $(jmainbodygrid).css({
                            width: '100%'
                        });
                        $(jholdinsets).css({
                            width: calcWidth + '%',
                            marginLeft: calcMargin + '%'
                        });

                    } else if (str == 2) { //midleftright

                        layout.addClass('midleftright');
                        layout.removeClass("leftmidright leftrightmid");
                        layout.find('.layoutOption').removeClass('active');
                        layout.find('.layoutOption[data-layout="' + str + '"]').addClass('active');

                        jleft.insertAfter(jinset);

                        $(jmainbodygrid).css({
                            width: calcWidth + '%'
                        });
                        $(jholdinsets).css({
                            width: '100%',
                            marginLeft: '0'
                        });

                    } else if (str == 3) { //leftrightmid

                        layout.addClass('leftrightmid');
                        layout.removeClass('leftmidright midleftright');
                        layout.find('.layoutOption').removeClass('active');
                        layout.find('.layoutOption[data-layout="' + str + '"]').addClass('active');

                        jleft.insertAfter(jright);
                        $(jmainbodygrid).css({
                            width: calcWidth + '%'
                        });
                        $(jholdinsets).css({
                            width: '100%',
                            marginLeft: '0'
                        });
                    }

                }).change();

            });



        },
        animateParent: function (setholder) {

            var self = this;
            var currentvalues = [];

            var boxholders = $(self.settings.containers);

            if (setholder) {

                boxholders = $(setholder);
            }


            boxholders.on('mouseleave', function (e) {

                e.stopImmediatePropagation();

                var mainHolder = $(this);


                var layout = $(this).parent();
                var findSelect = layout.find('.selectLayout select');
                var jinsets = layout.find('.jinsets');
                var jmainbodygrid = layout.find('.jmainbodygrid');
                var jholdinsets = layout.find('.jholdinsets');
                var jleft = layout.find('.jleft');
                var jmainbody = layout.find('.jmainbody');


                var elems = $(this).find(self.settings.inputs);
                var mainHeight = $(this).outerHeight();


                var jInsetHeight = $(jholdinsets).outerHeight();


                elems.each(function (el, i) {

                    if (currentvalues[el] == $(this).val()) return;


                    var findJmainbody = $(this).parent().parent().hasClass('jmainbody');
                    var checkLayout = findSelect.val();
                    var checkLeft = $(jleft).find(self.settings.inputs).val();
                    var activeWidth = $(jmainbody).find('input').val();
                    var newWidth = parseFloat($(this).val());

                    if (findJmainbody) {

                        $(jmainbodygrid).animate({
                            width: activeWidth + '%'
                        }, 500);
                        $(jinsets).animate({
                            width: 100 - activeWidth + '%'
                        }, 500);

                        if (checkLayout == 1) {

                            $(jholdinsets).animate({
                                width: 100 + '%',
                                marginLeft: checkLeft + '%'
                            }, 500);
                        }


                        mainHolder.css({
                            'overflow': 'hidden',
                            'height': mainHeight
                        });

                        $(jholdinsets).css({
                            'overflow': 'hidden',
                            'height': jInsetHeight
                        });
                    }

                    $(this).parent().parent().animate({
                        width: newWidth + '%'
                    }, 500, function () {

                        if (findJmainbody) {
                            mainHolder.css({
                                'overflow': 'inherit',
                                'height': 'auto'
                            });
                            $(jholdinsets).css({
                                'overflow': 'inherit',
                                'height': 'auto',
                            });
                        }
                    });

                    if ($(this).val() <= 10 && $(this).val() > 1) {

                        $(this).parent().parent().addClass('smalFonts');

                    } else if ($(this).val() > 10) {

                        $(this).parent().parent().removeClass("smalFonts");
                    }

                    if ($(this).val() <= 1) {
                        $(this).parent().parent().addClass('outside').css('z-index', 100 - el);
                    } else if ($(this).val() > 1) {
                        $(this).parent().parent().removeClass('outside');
                    }

                });

                currentvalues = [];

            }).on('mouseenter', function (e) {

                e.stopImmediatePropagation();
                var elems = $(this).find(self.settings.inputs);

                elems.each(function (el, i) {

                    var current = $(this).val();
                    currentvalues.push(current);

                });
            });

        },

        roundNumber: function (inputValue, precision) {

            var self = this;
            precision = Math.pow(10, precision || 0).toFixed(precision < 0 ? -precision : 0);
            return Math.round(inputValue * precision) / precision;

        },

        assembleVariable: function (elems, locks, hiddenInput, elem) {

            var self = this;

            initialValue = '';
            if (elem) {
                var val = self.roundNumber(elem.value, 2); // round(2)
                var v = val ? val : '0';
                elem.value = v;
                self.verifyInput(elems, elem, locks);
            }
            elems.each(function (i, el) {
                initialValue += self.roundNumber(el.value, 2); // round(2)

                initialValue += '|';

            });
            locks.each(function (i, el) {
                initialValue += el.checked ? 1 : 0;
                if (i !== locks.length - 1) initialValue += '|';
            });
            hiddenInput.val(initialValue);

        },

        verifyInput: function (elems, el, locks) {

            var self = this;

            var elementValue = parseInt(el.value);
            if (elementValue > 100) {
                $(el).val(0);
                elementValue = 100;
            }
            var locked = [];
            $(locks).each(function (i, e) {
                if (e.checked) locked.push(i);
            })
            var elIndex = $.inArray(el, elems);
            var s = 0;
            var eVals = [];
            var eKeys = [];
            $(elems).each(function (i, e) {
                if (i == elIndex) return;
                var stopped = false;
                $(locked).each(function (e) {
                    if (i == e) {
                        elementValue += self.roundNumber(elems[e].value, 2);
                        stopped = true;
                    }
                })
                if (stopped) return;
                var v = self.roundNumber(e.value, 2);
                eVals[eVals.length] = v;
                eKeys.push(i);
                s += v;
            });
            if (elementValue > 100) {
                elementValue -= $(el).val();
                $(el).val(0);
            }

            $(eKeys).each(function (key, real) {

                if (elementValue > 100) {

                    var newSize = 100 / $(eKeys).length;

                } else {

                    newSize = (100 - elementValue) / ($(eKeys).length);

                }

                $(elems[real]).val(newSize);

            });
        },

        resetValues: function (hiddenInput, inputreset) {

            var self = this;

            function swapElements(elements, mapping) {
                var tmp = new Array(elements.length);
                for (var i = 0, l = mapping.length; i < l; i++) {
                    tmp[mapping[i][1]] = elements[mapping[i][0]];
                }
                for (var i = 0, l = elements.length; i < l; i++) {
                    elements[i] = tmp[i];
                }
            }


            var resetButton = $(self.settings.resetb);


            if (inputreset) {

                resetButton = $(inputreset);
            }


            resetButton.on('click', function (e) {

                e.preventDefault();

                var findSelect = $(this).parent().parent().parent().find('.selectLayout select');
                var values = $(this).attr('data-resets').split('|');
                var checkLayout = $(findSelect).val();
                var findJmainbody = $(this).parent().hasClass('jmainbody');

                if (findJmainbody && checkLayout == 1) {

                    var mapping = [
                        [0, 1], //  0 = m , 1= i , 2 = l , 3 = r
                        [1, 2],
                        [2, 0],
                        [3, 3]
                    ];
                    swapElements(values, mapping);

                } else if (findJmainbody && checkLayout == 3) {

                    var mapping = [
                        [0, 0], //  0 = m , 1= i , 2 = l , 3 = r
                        [1, 1],
                        [2, 3],
                        [3, 2]
                    ];
                    swapElements(values, mapping);
                }

                var elemsCSS = $(this).data('elementcss');
                $('input.' + elemsCSS + '[type=text]').each(function (i, el) {
                    $(this).val(values[i]);
                });
                $('input.' + elemsCSS + '[type=checkbox]').each(function (i, el) {
                    $(this).attr("checked", false);
                    $(this).next().removeClass("fa-lock").addClass('fa-unlock');
                });
                $('input.' + elemsCSS + '[type=hidden]').val($(this).attr('data-resets'));

                var holder = $(this).parent().attr('id');
                self.resetChromes('#' + holder + ' .defChromes');

            });
        }
    }
    $(document).on('ready', YjsgAdmin.initialize);

})(jQuery);