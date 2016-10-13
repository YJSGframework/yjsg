/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
(function ($) {

    var YjsgMenuType = {

        settings: {
            groupholder: "#jform_params_yj_group_holder",
            menutype: "#jform_params_yj_item_type"
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgMenuType.start();

        },
        start: function () {

            var self = this;
            YjsgMenuType.groupHolder();
            YjsgMenuType.menuType();
        },


		getParent: function (el){
			
			
			var elm = $(el);

                if (elm.parent().is("li")) {

                    var elparent = elm.parent();

                } else {

                    	elparent = elm.parent().parent();
                }
				
			return elparent;
		},
		
		
		
        groupHolder: function () {


            var self = this;
            var Elements = '#jform_params_yj_menu_holder_width,#jform_params_yj_menu_groups_count,#jform_params_yj_sub_group_width';

            $(self.settings.groupholder).on('change', function () {
                var selected = $(this).find('input:checked').val();

                if (selected == 0) {


                    $(Elements).each(function (index, element) {

                       self.getParent(element).css({
                            display: 'none'
                        });

                    });


                } else {


                    $(Elements).each(function (index, element) {

                       self.getParent(element).css({
                            display: 'block'
                        });

                    });

                }


            }).change();


        },


		
		
        menuType: function () {


            var self = this;
            var Elements = '#jform_params_yj_menu_show_title,#jform_params_yj_mod_id,#jform_params_yj_position';

            $(self.settings.menutype).on('change', function () {
                var selected = $(this).find('input:checked').val();

                if (selected == 0) {


                    $(Elements).each(function (index, element) {

                        self.getParent(element).css({
                            display: 'none'
                        });

                    });


                } else if (selected == 1) {



                   self.getParent('#jform_params_yj_mod_id').css({
                        display: 'block'
                    });
                   self.getParent('#jform_params_yj_menu_show_title').css({
                        display: 'block'
                    });
                   self.getParent('#jform_params_yj_position').css({
                        display: 'none'
                    });

                } else if (selected == 2) {


                    self.getParent('#jform_params_yj_menu_show_title').css({
                        display: 'block'
                    });
                    self.getParent('#jform_params_yj_mod_id').css({
                        display: 'none'
                    });
                    self.getParent('#jform_params_yj_position').css({
                        display: 'block'
                    });

                }


            }).change();


        }


    }

    $(document).on('ready', YjsgMenuType.initialize);

})(jQuery);