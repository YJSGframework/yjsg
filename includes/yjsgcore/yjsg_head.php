<?php 
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
echo $cc_after_headtag;
// load mootools with mootools more , without true , more is not loaded
if($mootools_on == 1){
	JHtml::_('behavior.framework',true);
}

if (intval(JVERSION) > 2) {
	JHtml::_('jquery.framework');
}
// default css
$document->addStyleDeclaration("body{font-size:".$css_font.";}#logo,#logoholder{width:$logo_out;height:$logo_height;}.yjsgsitew{width:".$css_width.$css_widthdefined.";}".$midblockWidth.$leftblockWidth.$rightblockWidth.$insetblockWidth.$insetWidth."");

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

// menu 

$document->addStyleDeclaration("ul.yjsgmenu div.ulholder ul{width:".$sub_width.";}ul.yjsgmenu ul div.ulholder{left:".$yjsg_menu_offset."%;}ul.yjsgmenu ul.level1,ul.yjsgmenu.megadropline ul.level2{margin-top:".$yjsg_menu_top_distance."px;}ul.yjsgmenu ul ul {margin-left:".$yjsg_menu_side_distance."px;}
.yjsgrtl ul.yjsgmenu ul ul {margin-right:".$yjsg_menu_side_distance."px;}");

// main scripts
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

}else{
	
	$document->addStyleSheet(YJSG_ASSETS.'css/font-awesome.min.css');
	if(JFile::exists($output_css) && $bootstrap_here){
		$document->addStyleSheet(YJSGSITE_BASEPATH.'css_compiled/bootstrap-'.$css_file.'.css');
	}
	$document->addStyleSheet(YJSG_ASSETS.'css/template.css');
	$document->addStyleSheet($yjsg->filePath('css/yjsgmenus.css'));
	$document->addStyleSheet(YJSGSITE_BASEPATH.'css/layout.css');	
	$document->addStyleSheet(YJSGSITE_BASEPATH.'css/'.$css_file.'.css');		
}

// rtl bootstrap
if ($text_direction == 1 && $bootstrap_here) {
	
	$document->addStyleSheet(YJSG_ASSETS.$bootstrap_version.'/css/bootstrap-rtl.css');
}

/*responsive layout*/
if($responsive_on == 1) {
	
  if(!$compiled_css_on && $responsive_on   == 1){	
 	 $document->addStyleSheet(YJSG_ASSETS.'css/yjresponsive.css'); 
	 $document->addStyleSheet(YJSGSITE_BASEPATH.'css/custom_responsive.css');
  }
  $scalable = $scalable_on == 0 ?', maximum-scale=1.0, user-scalable=no':'';
  $document->setMetaData( 'viewport', 'width=device-width, initial-scale=1.0'.$scalable.'');
  
  if($yjsg_mobile){
	  
	  $document->setMetaData( 'handheldfriendly', 'true');
	  $document->setMetaData( 'apple-touch-fullscreen', 'yes');
  }
}

/* end responsive*/
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
	 
// site scripts
	$document->addScript(YJSG_ASSETS.'src/yjsg.site.plugins.js');
	$document->addScript($yjsg->filePath('src/yjsg.site.js'));
	
	if( $responsive_on == 1 ) {
		$document->addScript(YJSG_ASSETS.'src/yjsg.responsive.js');
	}

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
			var yjsglegacy='0';
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
	
	require( YJSGCORE_FOLDER."yjsg_slider_scripts.php");
	
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


/* Calculate offset  percent value for YJ Mega Menu */
$offset_value = ((float) $sub_width / 100) * (float)$yjsg_menu_offset;
$final_offset = number_format((float)$sub_width - (float)$offset_value + 10,0, '.', '') ;


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