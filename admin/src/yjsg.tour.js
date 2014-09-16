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
$(document).on('ready', function () {
	var pluginPath = $('#YJSG_plugin_path').val();
    yjsgTour = new Tour({
        onStart: function () {

        },
        onEnd: function () {
            $('#dimtour').fadeOut(500, function () {
                $(this).remove();
            });
        },

        onShow: function (yjsgTour) {

            if ($(this.element).parents().is("#sidetabs")) {
                $(this.element).find('a').trigger('click');
            }
        },

        template: "<div class='popover yjsgtour'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div class='popover-navigation'><div class='btn-group'><button class='btn btn-sm btn-default' data-role='prev'><i class='fa fa-hand-o-left'></i> Prev</button><button class='btn btn-sm btn-default' data-role='next'>Next <i class='fa fa-hand-o-right'></i></button><button class='btn btn-sm btn-default' data-role='pause-resume' data-pause-text='Pause' data-resume-text='Resume'>Pause</button></div><button class='btn btn-sm btn-primary' data-role='end'><i class='fa fa-times'></i> End tour</button></div></div>",
        steps: [{
            element: ".yjsg_version_check",
            title: "YJSG System check",
            content: "This tab will give you all important information you need to know about YJSG plugin and specific template parameters.<br /> If there is anything new that you need to know about the system or specific parameter the menu icon will be changed to info icon&nbsp;&nbsp;<i class='adminicons-info'></i>.",
        }, {
            element: ".yjsg_style_settings",
            title: "Style Settings",
            content: "Style Settings tab is where you can change template styles, default font family , elements tag overrides or turn on/off custom.css file.",
        }, {
            element: ".yjsg_top_menu_label",
            title: "Top menu settings",
            content: "Top menu tab will let you change your default top menu, switch menu on/off, adjust the width of drop-down elements, change default menu style from 5 predefined styles or turn top menu in to module position.",
        }, {
            element: ".yjsg_mg_label",
            title: "Layout",
            content: "Template layout as you see here is completely interactive and replicates the grids positions as in template index.php.<br />All widths values can be adjusted here.<br /> Each grid has own setting panel including logo and mainbody grid. Their settings panels are accessed by clicking on settings icon&nbsp;&nbsp<i class='fa fa-cog'></i>.",
        }, {
            element: "#logoImage",
            title: "Logo",
            content: "Logo settings panel holds everything you need to adjust your logo height and width or to change the default logo image. Again, this is completely interactive and you can immediately see what your layout will look like.",
            placement: "bottom",
            onShown: function (yjsgTour) {

                $('.yjsglogo a').trigger('click');
            }
        }, {
            element: ".yjsg_add_f_label",
            title: "Additional features",
            content: "In this tab you can find some extended template features like;Google Analytics code, YJSG logo settings or custom footer copyright settings. ",
        }, {
            element: ".yjsg_adv_label",
            title: "Advanced Options",
            content: "Component off switch , LESS compiler settings or responsive layout on/off switch are located in this tab. Note that these are advanced settings and before using them please read their popover info.",
        }, {
            element: ".yjsg_custom_code",
            title: "Custom code",
            content: "In this tab you can add custom css/javascript/html inside template head or body tag.",
        }, {
            element: ".menu_assigemnets",
            title: "Menu Assigements",
            content: "In this tab you can assign your template to a specific page, change template style name or switch the langue. Language can be adjusted only if your site is multilingual.",
        }]
    });

    $("#starttour").on('click', function (e) {
        e.preventDefault();

        $('body').append($('<div/>', {
            id: 'dimtour',
            css: ({
                opacity: 0
            })
        }).fadeTo(500, 0.1));

        if (yjsgTour.ended()) {
            yjsgTour.restart();
            return;
        }
        yjsgTour.start();

    });
});