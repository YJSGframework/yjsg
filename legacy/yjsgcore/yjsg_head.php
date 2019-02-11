<?php 
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// LEGACY HEAD FILE since 2.0.0

defined( '_JEXEC' ) or die( 'Restricted index access' );
echo $cc_after_headtag;

// load mootools with mootools more , without true , more is not loaded
JHtml::_('behavior.framework',true);


if (intval(JVERSION) > 2) {
	JHtml::_('jquery.framework');
}


$document->addStyleDeclaration("body{font-size:".$css_font.";}#logo{width:$logo_out%;height:$logo_height;}#logo a{height:$logo_height;}.yjsgsitew{max-width:".$css_width.$css_widthdefined.";}.yjsgheadergw{width:".$headergrid_width."%;}".$midblockWidth.$leftblockWidth.$rightblockWidth.$insetblockWidth.$insetWidth."");

// custom logo
if($this->params->get("logo_image")){
  $document->addStyleDeclaration('#logo{background: url('.JURI::base().$this->params->get("logo_image").')  no-repeat 0px 0px; !important;}');
} 

// off canvas
if ($this->countModules('offcanvas')) { 

	$offCanvas_css	=  '@media screen and (max-width: '.$offCanvas_visible.') {.yjsg-offc-btn.site-offc {display:block;}}';
	
	if($this->params->get("offcanvas_visible") == '1'){
		$offCanvas_css ='.yjsg-offc-btn.site-offc {display:block;}';	
	}
	
	$document->addStyleDeclaration($offCanvas_css);
	
}

$document->addScript(YJSG_ASSETS.'src/libraries/jquery.min.js');
$document->addScript(YJSG_ASSETS.'src/libraries/jquery-noconflict.js');
$document->addScript(YJSG_ASSETS.'src/yjsg.jquicustom.min.js');


if($bootstrap_here){
	
	$document->addScript(YJSG_ASSETS.$bootstrap_version.'/js/bootstrap.min.js');
	
}else{
	
	$document->addScript(YJSG_ASSETS.'src/tooltip.popover.min.js');
}


// remove generator tag
if($joomla_generator_off == 1){
	$this->setGenerator('');
}

// check if compiled and if we want to use compiled CSS
if($compile_css == 1 && JFile::exists($output_css)){
	$compiled_css_on = true;
}else{
	$compiled_css_on = false;
}


// check if compressed css
if($compiled_css_on){
	$document->addStyleSheet(YJSGSITE_BASEPATH.'css_compiled/template-'.$css_file.'.css');
		if (  $default_menu_style == 3 ||  $default_menu_style == 4 ){ 
		
			$document->addStyleSheet(YJSGSITE_BASEPATH.'css/dropline.css');
			
		}
}else{
	
	$document->addStyleSheet(YJSG_ASSETS.'css/font-awesome.min.css');
	if(JFile::exists($output_css) && $bootstrap_here){
		$document->addStyleSheet(YJSGSITE_BASEPATH.'css_compiled/bootstrap-'.$css_file.'.css');
	}
	$document->addStyleSheet(YJSG_BASEPATH.'legacy/css/template.css');
	$document->addStyleSheet(YJSGSITE_BASEPATH.'css/menus.css');
	
	if ( $default_menu_style == 3 ||  $default_menu_style == 4 ){ 
	
		$document->addStyleSheet(YJSGSITE_BASEPATH.'css/dropline.css');
		
	}
	
	$document->addStyleSheet(YJSGSITE_BASEPATH.'css/layout.css');	
	$document->addStyleSheet(YJSGSITE_BASEPATH.'css/'.$css_file.'.css');		
}


if ($text_direction == 1) {
	
	
	$document->addStyleSheet($yjsg->filepathLegacy('css/template_rtl.css'));
	
	if($bootstrap_here){
		$document->addStyleSheet(YJSG_ASSETS.$bootstrap_version.'/css/bootstrap-rtl.css');
	}

	if($yjsgBrowser->Name =='msie' && $yjsgBrowser->Version =='8.0'){
		$document->addStyleSheet($yjsg->filepathLegacy('css/menu_rtlie8.css')); 
		
	}
	
	
}

/*responsive layout*/
if($responsive_on == 1) {
	
  $document->addScript($yjsg->filepathLegacy('src/yjresponsive.js'));
  if(!$compiled_css_on && $responsive_on   == 1){	
 	 $document->addStyleSheet($yjsg->filepathLegacy('css/yjresponsive.css')); 
	 $document->addStyleSheet(YJSGSITE_BASEPATH.'css/custom_responsive.css');
  }
  $scalable = $scalable_on == 0 ?', maximum-scale=1.0, user-scalable=no':'';
  $document->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0'.$scalable.'');
  
  if($yjsg_mobile){
	  
	  $document->setMetaData( 'handheldfriendly', 'true');
	  $document->setMetaData( 'apple-touch-fullscreen', 'yes');
  }
}
/* TOP MENU SCRIPTS*/
if($topmenu_off == 2 || $itemid == 0 ) {
	
	
		// js
		
		if ( $default_menu_style == 2 && JFactory::getApplication()->input->get('tmpl') !='component') {
		  
		  $document->addScript(YJSG_BASEPATH.'legacy/src/yjsg.smoothdrop.js');
	
		}elseif( $default_menu_style == 4 && JFactory::getApplication()->input->get('tmpl') !='component'){
		  
		  $document->addScript(YJSG_BASEPATH.'legacy/src/yjsg.smoothdopline.js');
			
		}


		if ($default_menu_style == 1 ||  $default_menu_style == 2){
			
			$document->addStyleDeclaration(".horiznav li li,.horiznav ul ul a, .horiznav li ul,.YJSG_listContainer{width:".$sub_width.";}");
			
		}elseif ( $default_menu_style == 3 ||  $default_menu_style == 4 ){
			
			$document->addStyleDeclaration("
			.horiznav ul ul.subul_main{width:".$css_width.$css_widthdefined.";}
			.horiznav ul ul.subul_main li a, .horiznav ul ul.subul_main li a:hover{width:auto;}
			.horiznav ul ul.subul_main ul,.horiznav ul ul.subul_main ul a,.horiznav ul ul.subul_main ul a:hover  {width:".$sub_width.";}	
			");
		}
  
   
   if ($text_direction == 1) {
	   $yjsg_js.="document.documentElement.style.overflowX = 'hidden';";
	   $document->addStyleDeclaration("
		  a.sublevel {
		  background: url(".YJSGSITE_BASEPATH."images/".$css_file."/bodyli_rtl.gif) no-repeat 98% 9px;
		  }
		  body li{
		  background: url(".YJSGSITE_BASEPATH."images/".$css_file."/bodyli_rtl.gif) no-repeat right 6px;
		  }
	   ");
   }
	 
	 
}
// if any other menu but split or menumodpoz
$menus_to_use = array(1,2,3,4);
if(in_array($default_menu_style,$menus_to_use)){
	

	if ($text_direction == 1) {
		
	$document->addStyleDeclaration(".horiznav li ul ul,.subul_main.group_holder ul.subul_main ul.subul_main, .subul_main.group_holder ul.subul_main ul.subul_main ul.subul_main, .subul_main.group_holder ul.subul_main ul.subul_main ul.subul_main ul.subul_main,.horiznav li li li:hover ul.subul_main.dropline{margin-right:".$yjsg_menu_offset."%!important;
margin-top: -32px!important;}.top_menu ul.subul_main.dropline.group_holder li.holdsgroup > ul.subul_main{margin:0!important;padding-top:10px!important;padding-bottom:10px!important;}.horiznav ul.subul_main.dropline.group_holder > li.holdsgroup {clear:none!important;}");
	
	}else{
		
$document->addStyleDeclaration(".horiznav li ul ul,.subul_main.group_holder ul.subul_main ul.subul_main, .subul_main.group_holder ul.subul_main ul.subul_main ul.subul_main, .subul_main.group_holder ul.subul_main ul.subul_main ul.subul_main ul.subul_main,.horiznav li li li:hover ul.dropline{margin-top: -32px!important;margin-left:".$yjsg_menu_offset."%!important;}.top_menu ul.subul_main.dropline.group_holder li.holdsgroup > ul.subul_main{margin:0!important;padding-top:10px!important;padding-bottom:10px!important;}");

	}
}
/* end  top menu */
if($selectors_override == 1){
	
	if($selectors_override_type == 1 || $selectors_override_type == 2){// css font or google font
		
		 if($selectors_override_type == 2){
		 	$document->addStyleSheet($font_sheet);
		 }
		 if(!empty($affected_selectors)){
		 	$document->addStyleDeclaration("".$affected_selectors."{font-family:".$nice_font."}");
		 }
	}
	
	if (!$compiled_css_on && $selectors_override_type == 3){ // @font-face fontsquirrel font
	
		$document->addStyleSheet(YJSGSITE_BASEPATH.'css/fontfacekits/'.$fontfacekit_font_family.'/stylesheet.css');
		
	}
	

}

/* HTML5,@media, CSS3 for IE8 */
if ($yjsgBrowser->Name =='msie' && $yjsgBrowser->Version == '8.0'){
	
	$document->addScript('http://html5shim.googlecode.com/svn/trunk/html5.js');
	
	if($responsive_on == 1 ) {
	  $document->addScript(YJSGSITE_PLG_PATH.'legacy/src/respond.js');
	}
	if(!empty($pie_add_more)){
		$custom_pie = $pie_add_more;
	}else{
		$custom_pie ='';
	}
	$document->addStyleDeclaration('
	
	.itemComments,.itemCommentsForm .inputbox,#submitCommentButton,.itemComments ul.itemCommentsList li,.tagView .itemReadMore a,.userView .itemReadMore a,.genericView .itemReadMore a,.inputbox,.button, .validate,.readon,.jb_pagin a,pre,code'.$custom_pie.'{
	   behavior: url('.YJSGSITE_PLG_PATH.'legacy/css/pie/PIE.htc);
	   position:relative!important;
	  }	  
	  div.catItemImageBlock,.tagView .itemImageBlock,
	  .userView .itemImageBlock,.genericView .itemImageBlock {
	   position:relative!important;
	  }
	  .prettyprint{
		  padding:8px 0!important;
		  behavior:none!important;
	  }
	  body ol.linenums{
		  margin:0!important;
	  }
	  .vjs-default-skin.vjs-user-inactive.vjs-playing .vjs-control-bar :before {
		content: "";
	  }	
	');
	$document->addScript(YJSGSITE_PLG_PATH.'legacy/src/selectivizr-min.js');
 }

	 
// site scripts
	$document->addScript(YJSG_ASSETS.'src/yjsg.site.plugins.js');
	$document->addScript($yjsg->filePath('src/yjsg.site.js'));

	$menuanimation ='';
	$menuanimationspeed ='';
	if($default_menu_style == 2 ||  $default_menu_style == 4){
		
		$menuanimation 		="var menuanimation='".$default_menu_animation."';";
		$menuanimationspeed ="var menuanimationspeed=".$yjsg_menu_animation_speed.";";
	}
	
	// site js vars needed for yjsg.responsive.js and yjsg.site.js
	$yjsg_js.="
				var logo_w = '$logo_per_width';
				var site_w = '$css_width';
				var site_f = '$css_font';
				var sp='$sp';
				var tp ='$this->template';
				var compileme =$compileme;
				var fontc ='$fontc';
				var bootstrapv='$bootstrap_version';
				var yver='$jver[0]';
				var yjsglegacy='1';
				var yjsgrtl='$text_direction';
				$menuanimation$menuanimationspeed
	";

if($turn_logo_off == 2 && $css_widthdefined == '%'){
	$yjsg_js.="var site_w_is_per = 1;";
}	 


/*GOOGLE ANALYTICS*/
if($ga_switch == 1 && !empty($GAcode)){
$yjsg_js .="
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '".$GAcode."']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  ";
}
	// slider scripts
	require( YJSGCORE_FOLDER."yjsg_slider_scripts.php" );
	
	// mediaelement.js
	if(!$compiled_css_on && $yjsg_media_on == 1) {
		$document->addStyleSheet(YJSG_ASSETS.'src/mediaelement/mediaelementplayer.min.css');
	}
	if($yjsg_media_on == 1) {
		$document->addScript(YJSG_ASSETS.'src/mediaelement/mediaelement-and-player.min.js');
		$document->addScript(YJSG_ASSETS.'src/mediaelement/froogaloop2.min.js');
	}

	// magnific
	$document->addScript(YJSG_ASSETS.'src/magnific/yjsg.magnific.popup.min.js');
	
	$yjsg_js.="
		var lgtr = new Object();
		lgtr.magnificpopup_close='".JText::_('YJSG_MAGNIFICPOPUP_CLOSE')."';
		lgtr.magnificpopup_loading='".JText::_('YJSG_MAGNIFICPOPUP_LOADING')."';
		lgtr.magnificpopup_prev='".JText::_('YJSG_MAGNIFICPOPUP_PREVIOUS')."';
		lgtr.magnificpopup_next='".JText::_('YJSG_MAGNIFICPOPUP_NEXT')."';
		lgtr.magnificpopup_counter='".JText::_('YJSG_MAGNIFICPOPUP_PAGINATION')."';
		lgtr.magnificpopup_errorimage='".JText::_('YJSG_MAGNIFICPOPUP_IMAGE_NOT_LOADED')."';
		lgtr.magnificpopup_errorajax='".JText::_('YJSG_MAGNIFICPOPUP_CONTENT_NOT_LOADED')."';	
	
	";


	// add apple touch icon for Apple mobile OS - iOS
	if($detect->isiOS() || $detect->isAndroidOS()){	
		$document->addCustomTag('<link rel="apple-touch-icon" sizes="57x57" href="'.$yj_site.'images/system/appleicons/apple-icon-57x57.png" />');	
		$document->addCustomTag('<link rel="apple-touch-icon" sizes="72x72" href="'.$yj_site.'images/system/appleicons/apple-icon-72x72.png" />');
		$document->addCustomTag('<link rel="apple-touch-icon" sizes="114x114" href="'.$yj_site.'images/system/appleicons/apple-icon-114x114.png" />');
		$document->addCustomTag('<link rel="apple-touch-icon" sizes="144x144" href="'.$yj_site.'images/system/appleicons/apple-icon-144x144.png" />');
	}

	require( YJSGTEMPLATEPATH."custom/yjsg_template_custom.php");
	if(JFile::exists($custom_params_file)){
		require( $custom_params_file );
	}

	// last css file to load 
	if(!$compiled_css_on && $custom_css   == 1){	
		$document->addStyleSheet(YJSGSITE_BASEPATH.'css/custom.css'); 
	} 
	// site links and accent color
	if(isset($cc_css)){
		$document->addStyleDeclaration("".$cc_css."");
	}

	if(isset($YjsgCustomCss) && is_array($YjsgCustomCss) && !empty($YjsgCustomCss)){
		foreach($YjsgCustomCss as $YjsgCustomFile){
			$document->addStyleSheet($YjsgCustomFile);
		}
	}
	if(isset($YjsgCustomJS) && is_array($YjsgCustomJS) && !empty($YjsgCustomJS)){
		foreach($YjsgCustomJS as $YjsgCustomJSFile){
			$document->addScript($YjsgCustomJSFile);
		}
	}



/* TOP MENU PRINT */
if(empty($DDverticalTopOffset)){
	$DDverticalTopOffset = 30;
}
if(empty($DLverticalTopOffset)){
	$DLverticalTopOffset = 30;
}

/* Calculate offset  percent value for YJ Mega Menu */
$offset_value = ( (int)$sub_width / 100) * $yjsg_menu_offset;
$final_offset = number_format( (int)$sub_width - $offset_value + 10,0, '.', '') ;

if(  $topmenu_off == 2 || $itemid == 0  ) {

	if ( $default_menu_style == 2 && JFactory::getApplication()->input->get('tmpl') !='component') {
	  $yjsg_js.="
		var YJSG_topmenu_font = '".$css_font."';
		(function($){
			$(window).load(function(){
				$('.horiznav').SmoothDropJQ({
					contpoz:0,
					horizLeftOffset: ".$final_offset.", // submenus, left offset
					horizRightOffset: -".$final_offset.", // submenus opening into the opposite direction
					horizTopOffset: 20, // submenus, top offset
					verticalTopOffset:".$DDverticalTopOffset.", // main menus top offset
					verticalLeftOffset: 10, // main menus, left offset
					maxOutside: 50
				});
			})	
		})(jQuery);
	  ";	
	}elseif( $default_menu_style == 4 && JFactory::getApplication()->input->get('tmpl') !='component'){
	  $yjsg_js.="
		var YJSG_topmenu_font = '".$css_font."';
			var SmoothDroplineParams = {
				container			:'horiznav',	
				contpoz				:0,
				horizLeftOffset		: ".$final_offset.", // submenus, left offset
				horizRightOffset	: -".$final_offset.", // submenus opening into the opposite direction
				horizTopOffset		: 20, // submenus, top offset
				verticalTopOffset	: ".$DLverticalTopOffset.", // main menus top offset
				verticalLeftOffset	: 10, // main menus, left offset
				maxOutside			: 50
			};
	  ";		
		
	}
 
}
	// custom css and js inside head tag
	if(!empty($cc_css_headtag)){
		$document->addStyleDeclaration("".$cc_css_headtag."");
	}
	if(!empty($cc_js_headtag)){
		$document->addScriptDeclaration("".$cc_js_headtag."");
	}
/*
   Closing of $yjsg_js
*/
$yjsg_js .=$cc_js_footer;
$yjsg_js .= '</script>';
$yjsg_js = wspace( $yjsg_js )."\n".$printGAuniversal;
?>
<jdoc:include type="head" /><?php echo $cc_before_cheadtag ?>