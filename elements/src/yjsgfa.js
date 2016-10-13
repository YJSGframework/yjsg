/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
(function ($) {

    var YjsgFa = {

        settings: {
            inputelement: ".yjsg-fa"
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgFa.start();

        },
        start: function () {

            var self = this;

            $('.yjsg-icons-holder span').click(function () {

                var faclass = $(this).data('faname');
                $(this).parent().parent().find(self.settings.inputelement).val(faclass);

            });

            this.moduleFloat();
			this.iconSearch();

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
		
		
        moduleFloat: function () {

            var self = this;

            $('#jform_params_module_float').on('change', function () {

                var selected = $(this).val();

                if (selected == 'none') {

                    self.getParent('#jform_params_module_floatwidth').css({
                        display: 'none'
                    });

                } else {


                    self.getParent('#jform_params_module_floatwidth').css({
                        display: 'block'
                    });
                }


            }).change();


        },
		
		
		
		iconSearch : function (){


				var self = this;

				$(".yjsg-fa").keyup(function(){
			 
					var filter = $(this).val();
			 		
					$(this).parent().find('span').each(function(){
			 
			 			if ($(this).data('faname').search(new RegExp(filter, "i")) > 0) {
							
							$(this).insertBefore($(this).parent().find('span').eq(0));
							
						}

					});

				});

			
		}

    }

    $(document).on('ready', YjsgFa.initialize);

})(jQuery);