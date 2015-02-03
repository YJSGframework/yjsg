/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
(function ($) {

    var YjsgShortcodes = {

        settings: {
           // inputelement: ""
        },

        initialize: function (options) {

            this.options = $.extend({}, this.settings, options);

            YjsgShortcodes.start();

        },
        start: function () {

            var self = this;
			
			
		var MediaShortcode = '<a class="btn yjsg-shortcode-link"';
			MediaShortcode += ' href="'+siteroot+'plugins/system/yjsg/includes/yjsgshortcodes/templates/media.php"';
			MediaShortcode += ' rel="{handler: \'iframe\', size: {x: 770, y: 420}}">';
			MediaShortcode += ' <i class="fa fa-play"></i> ';
			MediaShortcode += 'Media';
			MediaShortcode += ' </a>';

		var NotificationsShortcode = '<a class="btn yjsg-shortcode-link"';
			NotificationsShortcode += ' href="'+siteroot+'plugins/system/yjsg/includes/yjsgshortcodes/templates/notifications.php"';
			NotificationsShortcode += ' rel="{handler: \'iframe\', size: {x: 770, y: 630}}">';
			NotificationsShortcode += ' <i class="fa fa-bullhorn"></i> ';
			NotificationsShortcode += 'Notifications';	
			NotificationsShortcode += ' </a>';		
			
			
		var IconsShortcode = '<a class="btn yjsg-shortcode-link"';
			IconsShortcode += ' href="'+siteroot+'plugins/system/yjsg/includes/yjsgshortcodes/templates/icons.php"';
			IconsShortcode += ' rel="{handler: \'iframe\', size: {x: 770, y: 500}}">';
			IconsShortcode += ' <i class="fa fa-star"></i> ';
			IconsShortcode += 'Icons';	
			IconsShortcode += ' </a>';	
	
			
		var AccordionShortcode = '<a class="btn yjsg-shortcode-link"';
			AccordionShortcode += ' href="'+siteroot+'plugins/system/yjsg/includes/yjsgshortcodes/templates/accordions.php"';
			AccordionShortcode += ' rel="{handler: \'iframe\', size: {x: 770, y: 350}}">';
			AccordionShortcode += ' <i class="fa fa-list"></i> ';
			AccordionShortcode += ' Accordions';
			AccordionShortcode += ' </a>';	
			
			
		var TabsShortcode = '<a class="btn yjsg-shortcode-link"';
			TabsShortcode += ' href="'+siteroot+'plugins/system/yjsg/includes/yjsgshortcodes/templates/tabs.php"';
			TabsShortcode += ' rel="{handler: \'iframe\', size: {x: 770, y: 420}}">';
			TabsShortcode += ' <i class="fa fa-folder-o"></i> ';
			TabsShortcode += ' Tabs';
			TabsShortcode += ' </a>';	
			
		var ImagesShortcode = '<a class="btn yjsg-shortcode-link"';
			ImagesShortcode += ' href="'+siteroot+'plugins/system/yjsg/includes/yjsgshortcodes/templates/images.php"';
			ImagesShortcode += ' rel="{handler: \'iframe\', size: {x: 770, y: 600}}">';
			ImagesShortcode += ' <i class="fa fa-camera"></i> ';
			ImagesShortcode += ' Image effects';
			ImagesShortcode += ' </a>';			
			
			$( '#editor-xtd-buttons' ).after('<div class="yjsg-shortcodes"><h3>Yjsg Shortcodes</h3></div>');
			$( ".yjsg-shortcodes" ).append( MediaShortcode, NotificationsShortcode ,IconsShortcode , AccordionShortcode ,TabsShortcode ,ImagesShortcode );
			
			
			
			if (typeof (SqueezeBox) != 'undefined') {
				SqueezeBox.close();
				SqueezeBox.initialize({});
				SqueezeBox.assign($$('a.yjsg-shortcode-link'), {
					parse: 'rel'
				});	
			}


        }


    }

    $(document).on('ready', YjsgShortcodes.initialize);

})(jQuery);