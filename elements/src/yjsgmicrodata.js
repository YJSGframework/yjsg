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

    var YjsgMicrodata = {

        settings: {
            inputelement: ".yjsg-fa"
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgMicrodata.start();

        },
        start: function () {

            var self = this;

            this.showMicroData();
            this.showMicroDataOptions();


        },

        getParent: function (el) {


            var elm = $(el);

            if (elm.parent().is("li")) {

                var elparent = elm.parent();

            } else {

                elparent = elm.closest('.control-group');
            }

            return elparent;
        },

        showMicroDataOptions: function () {

            var self = this;

            $('.yjsg-md-enabled').on('change', function () {

                var selected = $(this).val();

                if (selected == 1) {

                    self.getParent('.yjsg-md-types,.yjsg-md-position,.yjsg-md-ratingtype').css({
                        display: 'block'
                    });

                    $('.yjsg-md-types').trigger('change');
                } else {


                    self.getParent('.yjsg-md-types,.yjsg-md-position,.yjsg-md-ratingtype').css({
                        display: 'none'
                    });

                    $('.yjsg-md-types').trigger('change');
                }


            }).change();


        },

        showMicroData: function () {

            var self = this;



            $('.yjsg-md-types').on('change', function () {

                var selected = $(this).val();
                var enabled = $('.yjsg-md-enabled').val();

                if (selected == 'Event' && enabled == 1) {

                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                    self.getParent('.yjsg-md-event').css({
                        display: 'block'
                    });

                } else if (selected == 'Recipe' && enabled == 1) {

                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                    self.getParent('.yjsg-md-recipe').css({
                        display: 'block'
                    });

                } else if (selected == 'VideoObject' && enabled == 1) {

                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                    self.getParent('.yjsg-md-video').css({
                        display: 'block'
                    });

                } else if (selected == 'Movie' && enabled == 1) {

                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                    self.getParent('.yjsg-md-movie').css({
                        display: 'block'
                    });

                } else if (selected == 'Product' && enabled == 1) {

                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                    self.getParent('.yjsg-md-product').css({
                        display: 'block'
                    });

                } else if (selected == 'Book' && enabled == 1) {

                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                    self.getParent('.yjsg-md-book').css({
                        display: 'block'
                    });

                } else {


                    self.getParent('.yjsg-md').css({
                        display: 'none'
                    });
                }




            }).change();


        }

    }

    $(document).on('ready', YjsgMicrodata.initialize);

})(jQuery);