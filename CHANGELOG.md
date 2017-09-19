## Version: 2.2.9 (September 20, 2017)
 
### Bug fix
 - Fixes #49 issue with Joomla renaming/moving classes and methods since 3.8.0

## Version: 2.2.8 (July 18, 2017)
 
### Issue fix
 - Better dependencies error handling

### Bug fix
 - Fix for print icon #42
 
## Version: 2.2.7 (May 04, 2017)
 
### Bug fix
 - Fixed Menu Page Class not printing in head tag
 
## Version: 2.2.6 (February 24, 2017)

### Code improvement
 - Yjsgcolor construct fix
 - yjsgmicrodata array fix
 - yjsg_head.php calc fix
 - yjsg_mgwidths calc fix
 - JCE editor double shortcode fix
 - Print icon fix
 - Popovers fix
 - Media element update to 2.23.5 
 - Font awesome update to 4.7.0
 
## Version: 2.2.5 (August 05, 2016)
 
### Code improvement
 - Removed SqueezeBox close
 
## Version: 2.2.4 (July 13, 2016)

### Code improvement
 - Shortcodes not visible in TinyMCE fix
 
## Version: 2.2.3 (March 22, 2016)

### Code improvement
 - Adapt to Joomla 3.5.0 JDocumentHTML class name changed to JDocumentHtml
 - Adapt to Joomla 3.5.0 JDocumentHTML class folder libraries/joomla/document/html changed to libraries/joomla/document
 - Updated froogaloop fixes iframe for vimeo
 - Fixed google api https
 - Font awesome update to 4.5.0
 - Updated icon shortcodes
 - Fixed logo SEO text indent
 
 
## Version: 2.2.2 (May 14, 2015)

### Code improvement
 - Fixed topmenu animation grow bug
 - Fixed legacy templates not loading jquery

## Version: 2.2.1 (April 28, 2015)

### Code improvement
 - Fixed yjsg-form radios alignment
 - Removed float from yjsg-col-1 
 - Added two factor authentication inputs
 - Assign category when submiting new article fixes #13
 - Assign language when submiting new article fixes #19
 - Added brake before new article button
 - Added new language strings
 - Added language strings for shortcodes

## Version: 2.2.0 (January 28, 2015)

### New features
 - Added yjsg-link-lightbox-gallery
 - Added before and after module content
 - Updated Font Awesome to 4.3.0

###Code improvement
 - Removed empty space from article separator
 - Fixed a.modal bootstrap3 conflict 
 - Escape db params when making template copy
 - Yjsgmedia element prevent default button action
 - Removed xml data from dbug
 - Js cleanup for IE
 
## Version: 2.1.3 (November 24, 2014)

### Code improvement

  - Added custom article fields per category
  - Added yjsg-iframe-lightbox 
  - Refined yjsg_clean_shortcodes function
  - Bootstrap 3.3.0 update
  - Bootstrap multiselect update to v0.9.8
  - Bootstrap tour update to v0.10.1
  - Added files move methods for js and css files
  - Grid inherit suffix from modules
  - Hide module output if content is empty
  - Moved module addspan function to module.php 


### Bug fixes

  - Pagination icon line-height fix
  - Stray $css_file variable removed
  - Mobile menu not reachable on android fix 
  - Active-scroll is added on every # link
  - Offline page picking up get_style_value from core
  - Bootstrap3 k2 a.modal fix
  - Yjsgbackground element background image preview fix
  - a.yjsgsliderNav i needs font-style:normal;
  - K2 edit item css fixes
  - Leave unicode characters in tact in yjsg_cleanup_shortcode function 
  - Start patterns array in yjsgbackground.php element 
  - Mobile menu item class not displayed when cache on
  - Magnific popup z-index fix 
  - blockquote.quoted,blockquote.brackets need overflow hidden
  - News items multicolumns margin adjustment
  - Fixed article info position params

## Version: 2.1.2 (October 06, 2014)

### Bug fixes
  - Fixed yjsgCleanPageSfx method to check for params first
  
## Version: 2.1.1 (October 06, 2014)

### Code improvement

  - Improved article blog layout margin and padding for easier separation in v2 templates
  - Improved Page Class space before the class name
  - Improved yjsgparse shortocde to allow js
  - Added Page Class to html tag
  - Added sub class to mobile menu
  - Made sure yjsgpre shortcode dont error out when empty 
  - Reset yjsg-row margin when inside the yjsg_grid

### Bug fixes
  - Fixed reset to default adds 3 top menus if top menu is in header by default
  - Fixed images shortcode override was not closing modal on insert
  - Fixed css_font_family in default xml should be 6
  - Fixed blocknumber css

  
## Version: 2.1.0 (October 02, 2014)

### New features

  - Added [Waypoints](http://imakewebthings.com/jquery-waypoints/) jQuery plugin
  - Added [Yjsgroundprogress](http://yjsimplegrid.com/add-ons/round-progress-bars.html) jQuery plugin
  - Added yjsg-hide CSS class

### Bug fixes

  - Fixed youtube shortlink fix for Mediaelement
  - Fixed K2 shortcodes after read more 
  - Fixed top menu in header margin/padding reset
  - Fixed yjsgmedia element strict standards bug
  - Fixed filter min width in yjsg-form
  - Fixed com_contact featured table style missing class
  - Fixed compact tags form missing class
  - Fixed yjsg tooltips center aligned text
  - Fixed frontend template settings dont display params
  - Fixed empty system message type for 3.x
  - Fixed template backup on 1.0.16 is backing up new template version if old one is installed
  - Fixed VM pagination issue
  - Fixed yjsg_module_style param is not applied to yjsgxhtml container
  - Fixed yjsgfolderlist.php strict standards bug
  - Fixed class JSON strict standards bug 


## Version: 2.0.1 (September 18, 2014)

### Code improvement

  - Added Yjsg Article Option in frontend article edit view
  - Added yjsg-form-append
  - Added option to turn off Mootools dependency in admin for v2 templates ( legacy not included )
  - Added check for JSN admin to disable their toolbar in template style edit view
  - Added JLayouts override in plugin
  - Made sure the voting override is triggered only on com_content
  - Moved com_fabrik require.js head order to avoid js conflicts
  - behaviour.tooltip replaced with Yjsg::yjsgtooltip()
  - Updated less.php class to version 1.7.0.2
  - Updated FontAwesome to version 4.2
  - Matched mod_login view 2.5/3.x
  - Matched com_finder j3x override
  - Switched com_contact tabs to Yjsg based tabs( no Bootstrap dependency )
  - Polaroid shortcode addon [reference](http://www.youjoomla.com/joomla_support/showthread.php?p=58942)
  - Cleanup JS/CSS files

### Bug fixes

  - Fixed article category menu rtl CSS
  - Fixed sidepanel rtl CSS 
  - Fixed article edit view calendar CSS
  - Fixed legacy modules box-sizing
  - Fixed yjmedia element ( preview image was not visible )
  - Fixed tip-wrap missing z-index	
  - Fixed menu item open new window without navigation bug
  - Fixed hasUpdate method in yjsg.class.php
  - Fixed save as copy bug
  - Fixed K2 frontend edit item missing scripts
  - Fixed user profile page width
  - Fixed frontpage article edit view
  - Fixed admin tooltips when com_fabrik is used
  - Fixed top menu text separator space bug
  - Fixed shortcodes frontend edit loading before jquery

  


## Version: 2.0.0 (August 08, 2014)

  - Initial Release
