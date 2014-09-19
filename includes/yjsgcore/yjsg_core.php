<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
jimport('joomla.filesystem.file');
//BEGIN CUSTOM JS VAR
/*

   Begining of $yjsg_js
   Add your script after 
   $yjsg_js='<script type="text/javascript">'; 
   or in custom/yjsg_custom_params.php 
   by using $yjsg_js.='var =my_js_var';
   dont forget the dot after $yjsg_js
   For better performance and cleaner <head></head>
   $yjsg_js is echoed at the end of the page in yjsg_footer.php
 
*/
$yjsg_js='<script type="text/javascript">';

$yjsg 								= Yjsg::getInstance();					// YJSG class instance
$jver								= JVERSION;


// USABLE VARS 
$yj_site 							= YJSGSITE_BASEPATH; 					//  Current template folder as http://www.site_name/templates/template_name/
$yj_base 							= JURI::base();                         //  Site path as  http://www.site_name
$yj_copyrightyear 					= (Date("Y"));                          //  Current Copyright year in footer
$yj_templatename 					= $this->params->get("custom_cp");      //  Get template name for footer otherwise use param value
if(empty($yj_templatename)){
	$yj_templatename 				= ucfirst($this->template); 
}
$document	    					 = JFactory::getDocument();
$dispatcher 						 = JDispatcher::getInstance();
$app 								 = JFactory::getApplication('site');
$paramsArray						 = json_decode($this->params,true);



// STYLE SETTINGS

$get_style_value				 	= explode('|',$this->params->get("yjsg_get_styles","blue|007ebd"));
$yjsg_get_styles				 	= $get_style_value[0];	
$default_link_color				 	= $get_style_value[1];
$site_link_color				 	= '#'.$default_link_color;
	

$itemid 							 = $app->input->get('Itemid');
$define_itemid             			 = $this->params->get ("define_itemid");
$default_font			             = $this->params->get("default_font","14px"); 
$default_font_family			     = $this->params->get("default_font_family","6");
$selectors_override			         = $this->params->get("selectors_override","2");
$css_font_family			         = $this->params->get("css_font_family","12");
$google_font_family			         = $this->params->get("google_font_family");
$fontfacekit_font_family          	 = $this->params->get("fontfacekit_font_family");


// page clone hook
global $clonedPageId;
$clonedPageId 							 = '';

if( is_array( $define_itemid ) && in_array($itemid, $define_itemid) ){
	
	$clonedPageId 						 = '-itemid'.$itemid;
}



$css_width            				 = str_replace( array("px","%"), array("", ""), $this->params->get("css_width".$clonedPageId,"1200px"));
$css_widthdefined 					 ='px';

if (strpos($this->params->get("css_width".$clonedPageId), '%') !== false) { 

 $css_widthdefined 					 ='%';
 
}



// custom code blocks

$cc_css_headtag			 			 = $this->params->get("cc_css_headtag",'');
$cc_js_headtag			 			 = $this->params->get("cc_js_headtag",'');
$cc_js_footer				 		 = $this->params->get("cc_js_footer",'');
$cc_after_headtag			 		 = $this->params->get("cc_after_headtag",'');
$cc_before_cheadtag			 		 = $this->params->get("cc_before_cheadtag",'');

if(!empty($cc_after_head)){
	
	$cc_after_head				  = "  ".$cc_after_head."\n";
	
}
if(!empty($cc_before_chead)){
	
	$cc_before_chead				  = "  ".$cc_before_chead."\n";
	
}

// additional settings

$text_direction       				 = $this->params->get("text_direction","2");
$selectors_override_type			 = $this->params->get("selectors_override_type","1");
$affected_selectors     			 = $this->params->get ("affected_selectors");
$custom_css    		            	 = $this->params->get ("custom_css","2");
$joomla_generator_off 				 = $this->params->get("joomla_generator_off","1");
$validators_off 				 	 = $this->params->get("validators_off","1");
$totop_off 				 			 = $this->params->get("totop_off","1");
if(!empty($default_font)){
	$css_font 						 = $default_font;
}else{
	$css_font 						 ='12px';
}
//TOOLS CONTROL
// SHOW FONT SWITCH = 1 | HIDE FONT SWITCH = 0
$show_tools    					     = $this->params->get("show_tools","1");
$show_fres    					     = $this->params->get("show_fres","1");
$show_rtlc    					     = $this->params->get("show_rtlc","1");
// LAYOUT
$site_layout    			        = $this->params->get("site_layout".$clonedPageId,"2");

//MENY TYPE 
// mainmenu by default, can be any Joomla! menu name
$menu_name      			        = $this->params->get("menuName","mainmenu");
$menu_endlevel     			        = $this->params->get("menuendLevel",'0');
$sub_width 							= $this->params->get("sub_width","220px");
$yjsg_menu_offset					= $this->params->get("yjsg_menu_offset","100");

//MENU STYLE SWITCH
//  1 = Dropdown  | 2  = SMooth Dropdown | 3 = Dropline  | 4 SmoothDropline  |  5  = Split  | 6 =  module position
$default_menu_style  			    = $this->params->get("default_menu_style","2"); 
$default_menu_animation			    = $this->params->get("default_menu_animation","fade");
$yjsg_menu_top_distance			    = $this->params->get("yjsg_menu_top_distance","10"); 
$yjsg_menu_side_distance			= $this->params->get("yjsg_menu_side_distance","10"); 
$yjsg_menu_animation_speed			= $this->params->get("yjsg_menu_animation_speed",300); 
$turn_topmenu_off          			= $this->params->get("turn_topmenu_off","0");
//$menu_page_title                    = $this->params->get("menu_page_title");

// Logo and header block settings
$logo_image							= $this->params->get("logo_image");
$logo_width 						= $this->params->get("logo_width","165px");
$logo_height                        = $this->params->get("logo_height","115px");
$turn_logo_off 						= $this->params->get("turn_logo_off","2");
$turn_header_block_off				= $this->params->get("turn_header_block_off","2");

if($yjsg->preplugin()) {
	
	$logo_out 							= @round($logo_width / $css_width*100,2);
	if($turn_logo_off == 1) {
		$headergrid_width 				= 100;
	}else{
		$headergrid_width 				= 100 - $logo_out;
	}
	
}else{
	
	$logo_out = $logo_width;
}


// SEO SECTION //
$seo              				    = $this->params->get ("seo");                     
$tags             				    = $this->params->get ("tags");
$turn_seo_off   		            = $this->params->get ("turn_seo_off");
$ie6notice        			        = $this->params->get("ie6notice"); // 1 = ON | 0 = OFF   


// ADVISE VISITORS THAT BROWSER JAVASCRIPT IS DISABLED
$nonscript           		        = $this->params->get("nonscript"); // 1 = ON | 0 = OFF 


// ADD GOOGLE ANALYTICS

$ga_switch  			    		= $this->params->get ("ga_switch");
$GAcode								= $this->params->get ("GAcode");
$GAuniversal						= $this->params->get ("GAuniversal");
$printGAuniversal					='';

if(!empty($GAuniversal) && $ga_switch == 2){
	$printGAuniversal							= $GAuniversal."\n";
}

//Frontpage news items character limit controll
$fp_controll_switch 		        = $this->params->get ("fp_controll_switch");
$fp_chars_limit             		= $this->params->get ("fp_chars_limit");
$fp_after_text              		= $this->params->get ("fp_after_text ");



// YJSimpleGrid LOGO
$branding_off  						= $this->params->get ("branding_off","2");
$joomlacredit_off  					= $this->params->get ("joomlacredit_off","1");


// widths 
$leftcolumn            				= $this->params->get ("leftcolumn".$clonedPageId,"22.5");
$rightcolumn            			= $this->params->get ("rightcolumn".$clonedPageId,"22.5"); 
$maincolumn             			= $this->params->get ("maincolumn".$clonedPageId,"55"); 
$insetcolumn           				= $this->params->get ("insetcolumn".$clonedPageId,"0");
$widthdefined           			= '%';



// count modules
$left                   			= $this->countModules( 'left' );
$right                  			= $this->countModules( 'right' );
$inset                  			= $this->countModules( 'inset' );

// GET ITEM ID FOR SPECIFIC PARAMS
$component_switch          			= $this->params->get ("component_switch");


// TURN MOOTOOLS ON
$mootools_on          				= $this->params->get ("mootools_on",1);


// TEMPLATE REQUIRED FILES
require( YJSG_LINKS );
require( YJSGCORE_FOLDER."functions/yjsg_chrome.php");
require( YJSGCORE_FOLDER."functions/yjsg_printgrid.php");
require( YJSGCORE_FOLDER."yjsg_stylesw.php");


//COMPONENT OFF SWITCH

if(is_array( $component_switch ) && in_array( $itemid, $component_switch )){
	
	$turn_component_off 			= 1;
	
}else{
	
	$turn_component_off 			= 2;
}


//TOPMENU OFF SWITCH
	 
if(is_array( $turn_topmenu_off ) && in_array( $itemid, $turn_topmenu_off )){
	
	$topmenu_off 					= 1;
	
}else{
	
	$topmenu_off 					= 2;
}




// custom chromes for sidebars
$leftcolumn_cc						= $this->params->get ("leftcolumn_custom_chrome".$clonedPageId,'YJsgxhtml');
$rightcolumn_cc						= $this->params->get ("rightcolumn_custom_chrome".$clonedPageId,'YJsgxhtml');
$insetcolumn_cc						= $this->params->get ("insetcolumn_custom_chrome".$clonedPageId,'YJsgxhtml');
$insettop_cc						= $this->params->get ("insettop_custom_chrome".$clonedPageId,'YJsgxhtml');
$insetbottom_cc						= $this->params->get ("insetbottom_custom_chrome".$clonedPageId,'YJsgxhtml');



require( YJSGCORE_FOLDER."yjsg_mgwidths.php");


//TOP MENU 

$template_menus = FALSE;
if($default_menu_style !=6){

    	
	$renderer	 					= $document->loadRenderer( 'module' );
	$options	 					= array( 'style' => "raw" );
	$module	     					= JModuleHelper::getModule( 'mod_menu','$menu_name' );
	$topmenu     					= false; $subnav = false; $sidenav = false;
	
	
//DROPDOWN OR SMOOTHDROPDOWN
	if ($default_menu_style == 1 or $default_menu_style== 2) :
	
			$module->params			= "menutype=$menu_name\nshowAllChildren=1\nendLevel=$menu_endlevel\nclass_sfx=nav\nmenu_images=n";
			$topmenu 				= $renderer->render( $module, $options );
			$menuclass				= 'horiznav';
			$topmenuclass 			='top_menu';
			
// DROPLINE OR SMOOTHDROPLINE

	elseif ($default_menu_style == 3 or $default_menu_style== 4) :
	
			$module->params			= "menutype=$menu_name\nshowAllChildren=1\nendLevel=$menu_endlevel\nclass_sfx=navd\nmenu_images=n";
			$topmenu 				= $renderer->render( $module, $options );
			$menuclass 				= 'horiznav_d';
			$topmenuclass 			='top_menu_d';
			
// SPLIT MENU  NO SUBS
	elseif ($default_menu_style == 5) :
	
			$module->params			= "menutype=$menu_name\nstartLevel=0\nendLevel=1\nclass_sfx=split\nmenu_images=n";
			$topmenu 				= $renderer->render( $module, $options );
			$menuclass 				= 'horiznav';
			$topmenuclass 			='top_menu';
			
	endif;
	$template_menus 				= TRUE;
}
// LAYOUT SWITCH
switch ($site_layout) {
	
    case 1:
    $yjsg_loadlayout 				= YJSG_LEFT_MID_RIGHT;
	$insetholderDiv  				=  "";
	break;
    case 2:
    $yjsg_loadlayout 				= YJSG_MID_LEFT_RIGHT;
	$insetholderDiv  				=  "#insetsholder_2t,#insetsholder_2b";
    break;
    case 3:
    $yjsg_loadlayout 				= YJSG_LEFT_RIGHT_MID;
	$insetholderDiv	 				=  "#insetsholder_3t,#insetsholder_3b";
    break;
	default;
    $yjsg_loadlayout 				= YJSG_MID_LEFT_RIGHT;
	$insetholderDiv  				=  "#insetsholder_2t,#insetsholder_2b";
    break;
}

// ADD BLOCKS WIDTHS
$midblockWidth		='';
$leftblockWidth		='';
$rightblockWidth	='';
$insetblockWidth	='';
$insetWidth			='';

if($midblock){
	$midblockWidth 					='#midblock{width:'.$midblock.';}';
}
if($left){
	$leftblockWidth 				='#leftblock{width:'.$leftblock.';}';
}
if($right){
	$rightblockWidth 				='#rightblock{width:'.$rightblock.';}';
}
if($inset){
	$insetblockWidth 				='#insetblock{width:'.$insetblock.';}';
}
if($insettop){
	$insetWidth 					= $insetholderDiv.'{width:'.$insettop.';}';
}

//Browser info
include( YJSGCORE_FOLDER."classes/yjsg.browser.class.php");
$yjsgBrowser 						= new YjsgBrowser;
$detect 							= $yjsgBrowser;// backwards compatibility
$yjsg_mobile 						= $detect->isMobile();

/* 
	add browser class name for body tag
*/
$browserClassName ='';
if(isset($_SERVER['HTTP_USER_AGENT'])){	
	if($yjsgBrowser->Name =='msie'){
		$browserClassName = ' yjsgbr-'.$yjsgBrowser->Name.str_replace('.','',$yjsgBrowser->Version);
	}else{
		$browserClassName = ' yjsgbr-'.$yjsgBrowser->Name;
	}
}


// FONTS 
/* if we add body in selectors , let it take over , style will be stylefont*/
if(strstr($affected_selectors,'body')){
	$default_font_family ='ont';
}

if ($selectors_override_type == 1 ){ // CSS
	require( YJSGCORE_FOLDER."yjsg_cssfonts.php");
	$nice_font   =  $css_font_family;
	$font_sheet ='';
}elseif ($selectors_override_type == 2){ // GOOGLE

	
	$fontName 		= preg_replace('/:(.*)/','',$google_font_family);
	$nice_font   	= ''.str_replace('+',' ',$fontName).',sans-serif;';
	
	if(strstr($google_font_family,'|')){
		
		$splitFont 			= explode('|',$google_font_family);
		$fontName 			= preg_replace('/:(.*)/','',$splitFont[0]);
		$fontWeight 		= '';
		
		if(isset($splitFont[2])){
			$fontWeight = 'font-weight:'.$splitFont[2].';';
		}
		
		$nice_font   		= ''.str_replace('+',' ',$fontName).','.$splitFont[1].';'.$fontWeight.'';
		$google_font_family = $splitFont[0];
	}	
	$font_sheet  = 'http://fonts.googleapis.com/css?family='.$google_font_family.'';
	
	// stylesheet with multiple fonts
	if(strstr($font_sheet,'==')){
		$font_sheet  =  str_replace('==','%7C',$font_sheet);
	}
	
}

// remove all midblock divs if no items ,no columns, no links, no modules on specific itemid
if (!$this->countModules('bodytop1') &&
	 !$this->countModules('bodytop2') &&
	 !$this->countModules('bodytop3') &&
	 !$this->countModules('bodybottom1') &&
	 !$this->countModules('bodybottom2') &&
	 !$this->countModules('bodybottom3') &&
	 !$this->countModules('left') &&
	 !$this->countModules('right') &&
	 !$this->countModules('inset') &&
	 !$this->countModules('insettop') &&
	 !$this->countModules('insetbottom')&& 
	 $turn_component_off == 1 ) {	 
	$midblock_off = true;
	
}else{
	
	$midblock_off = false;
}

// check midblock div width, if 0 disable component/bodytop/bodybottom
$midblock_iszero  	= false;
$checkmidblock 		= str_replace('%','',$midblock ) ;
if($checkmidblock == '0' ){
	$midblock_iszero  = true;
}

// responsive params
$responsive_on 		= $this->params->get("responsive_on",1);
$scalable_on 		= $this->params->get("scalable_on",0);
// offcanvas
$offCanvas_visible	= $this->params->get("offcanvas_visible","979px");
$offCanvasWidth		= $this->params->get("offcanvas_width","250px");



/* top menu top offsets | if empty top offset is 30 otherwise top offset is what you set here */
$DDverticalTopOffset ='';// SmoothDropdown
$DLverticalTopOffset ='';// SmoothDropline

/* top menu location */
$topMenuLocation 	 =	$this->params->get("top_menu_location","0"); // 1 = inside the header block next to logo

// check for topmenupoz navbar bootstrap menu
$navbar_loaded 		= FALSE;
$navbar_class  		= '';
$topmenupoz_name  	= $menu_name;

 if ($yjsg->preplugin()) {
	 
	 $fixnavpillClass =' navpills';
	 
 }else{
	 
	 $fixnavpillClass ='_navpills';
 }


if($this->countModules('topmenupoz') && $default_menu_style ==6) :
  $top_menu_mod_poz =  JModuleHelper::getModules( 'topmenupoz' );
  foreach($top_menu_mod_poz as $key => $all_menus){
	  $mod_params = json_decode($top_menu_mod_poz[$key]->params);
	  
	  $topmenupoz_name = $mod_params->menutype;
	  
	  if($mod_params->class_sfx == 'navbar' || $mod_params->class_sfx == 'navbar navbar-inverse'){
		  $navbar_loaded = TRUE;
		  $navbar_class  = '_navbar';
		  break;
	  }elseif($mod_params->class_sfx == 'nav nav-pills'){
		  $navbar_loaded = TRUE;
		  $navbar_class  = $fixnavpillClass;
		  break;
	  }
  }
endif;

// load mobile menu list only if needed
$load_mobile_list = FALSE;
if( ($responsive_on == 1 && ($topmenu_off == 2 || $itemid == 0 )) && ($template_menus || ($this->countModules('topmenupoz') && !$navbar_loaded ))){
			$load_mobile_list = TRUE;
}

// compiler vars
$bootstrap_version 		= $this->params->get("bootstrap_version",'bootstrapoff');
$bootstrap_here = true;
if($bootstrap_version == 'bootstrapoff'){
	$bootstrap_here = false;	
}
//$less_compiler_on 		= 1;
$compile_css 			= $this->params->get("compile_css","0");
$compiler_compressed	= $this->params->get("compiler_compressed","1");
$ajax_front_recompile	= $this->params->get("ajax_front_recompile","1");

/* Paths vars */

$compiler_log 			= YJSGCOMPILER_LOG.'yjsg_compiler_log_'.$css_file.'.php';
$css_dir  				= YJSGTEMPLATEPATH."css_compiled".YJDS;
$yjsg_compiler			= YJSGCORE_FOLDER."yjsg_compile.php";
$layout_file 			= YJSGTEMPLATEPATH."css".YJDS."layout.css";

if($compile_css == 1){
	 $output_css			= $css_dir."template-".$css_file.".css";
}else{
	 $output_css			= $css_dir."bootstrap-".$css_file.".css";
}

// ie8 pie custom var
$pie_add_more='';

// mediaelement
$yjsg_media_on			= $this->params->get("yjsg_media_on","0");


// site vars 
$sp 					= JURI::base();
$fontc					= $this->template.'_'.filesize($layout_file).filemtime($layout_file);

if($turn_logo_off == 1) {
	$logo_per_width = 0;
}else{
	$logo_per_width = str_replace('px','',$logo_width);
}

// rtl custom body class 
$rtlClass ='';
if($text_direction == 1 ){
	$rtlClass =' yjsgrtl';
}


// custom color styling 
require( YJSGCORE_FOLDER."classes/yjsg.color.class.php");
$yjsg_color = new Yjsgcolor($style_color);


// create yjsg_custom_params.php file
$custom_params_file		= YJSGTEMPLATEPATH.YJDS."custom".YJDS."yjsg_custom_params.php";
$custom_params_content 	="<?php ".PHP_EOL."/**".PHP_EOL."* yjsg_custom_params.php file created by ".$yj_templatename." Template".PHP_EOL."* @package ".$yj_templatename." Template".PHP_EOL."* @author Youjoomla.com".PHP_EOL."* @website Youjoomla.com ".PHP_EOL."* @copyright	Copyright (c) since 2007 Youjoomla.com.".PHP_EOL."* @license PHP files are released under GNU/GPL V2 Copyleft License.CSS / LESS / JS / IMAGES are Copyrighted material".PHP_EOL."**/".PHP_EOL."defined( '_JEXEC' ) or die( 'Restricted index access' );".PHP_EOL."/*".PHP_EOL.PHP_EOL."  this file 'sees' all template params and is loaded after them".PHP_EOL."  you can add own code and overwrite core with this file".PHP_EOL."  For more details please see:".PHP_EOL."  http://www.yjsimplegrid.com/documentation/advanced/using-custom-params-file.html".PHP_EOL.PHP_EOL."*/".PHP_EOL."?>";
	
	
	if(!JFile::exists($custom_params_file)){
		JFile::write($custom_params_file,$custom_params_content);
	}


// compile process
$compileme 		=0;// ajax recompile key




// use compiler only if bootstrap is selected or if we want to compile all css files
if($bootstrap_here || $compile_css == 1 ){ 
	
	/*
		fake link invoked by ajax script to make ajax work instead 
		user wating for live recompile process
	*/
	$need_to_compile 		= $app->input->getInt('recompile');		
	
	// get the compiler only if we need to recompile 
	if( $need_to_compile == 1  ){
		require_once ($yjsg_compiler);
	}
	
	
	
	// if no log or no compressed file we need to recompile
	if(!JFile::exists($compiler_log) || !JFile::exists($output_css)){
	
			  // ajax recompile
			  if($ajax_front_recompile == 1){
				  
				  if (is_writable(dirname($css_dir))) {
					$compileme =1;
				  }else{
					$compileme =3;
				  }
					
			  }else{
			   //normal recompile   
				  require_once ($yjsg_compiler);
			  }
	}
	
	//check if file is changed and if yes recompile
	if(JFile::exists($compiler_log)){
		require_once ($compiler_log);
		$files 			= unserialize($YjsgCompilerLog);
		
		foreach($files['files'] as $filename => $filetime){
			
			if ((!file_exists($filename)) or filemtime($filename) > $filetime) {
			 
				 // ajax recompile
				  if($ajax_front_recompile == 1){
					  
	
					  if (is_writable(dirname($css_dir))) {
						JFile::delete($compiler_log);
						$compileme =1;
					  }else{
						$compileme =3;
					  }
						
				  }else{
				  //normal recompile  
					  require_once ($yjsg_compiler);
				  }
				  break;
				
			}
		}
	}

}

// find any head file
function YjsgFindHeadFile($type ="",$filename=""){
	
			$filefound		= false;
			$document 		= JFactory::getDocument();
			$files  		= $document->getHeadData();
			if($type == 'js'){
				$findFile	= $files['scripts'];
			}else{
				$findFile	= $files['styleSheets'];
			}
			
			foreach($findFile as $k => $v){
				$printAll[]=$k;
			}
			$allFiles = @implode('',$printAll);
			
			if(is_array($filename)){

				 foreach ($filename as $needle) {
					   if (strpos($allFiles, $needle) !== false) {
							  $filefound = true;
							  break;
					   }
				 }
				
			}else{
				
				if (strstr($allFiles, $filename)){
					$filefound = true;
				}
			}
		
			return $filefound ;
			
}

// get image color
if (!function_exists('YjsgImgTorgb')) {
	function YjsgImgTorgb($img,$x,$y){
		
		if (extension_loaded('gd') && function_exists('gd_info')) {
	
			if( ini_get('allow_url_fopen') &&  !function_exists('curl_init')) {		
			
				if (strstr($img,'.jpg') or strstr($img,'.jpeg')){
					$im = @imagecreatefromjpeg($img);
				}else if (strstr($img,'.gif')){
					$im = @imagecreatefromgif($img);
				}else if (strstr($img,'.png')){
					$im = @imagecreatefrompng($img);
				}
				
			}elseif(function_exists('curl_init')){
				
				$options = array( 
					 CURLOPT_RETURNTRANSFER => true, // return web page
					 CURLOPT_HEADER => false, // don't return headers 
					 CURLOPT_FOLLOWLOCATION => false, // follow redirects 
					 CURLOPT_AUTOREFERER => true, // set referer on redirect 
					 CURLOPT_CONNECTTIMEOUT => 5, // timeout on connect 
					 CURLOPT_TIMEOUT => 5, // timeout on response 
					 CURLOPT_MAXREDIRS => 0, // stop after 0 redirects ); 
					 );
					
					$url 			= $img; 
					$ch 			= curl_init( $url ); 
					curl_setopt_array( $ch, $options ); 
					$imagedata 		= curl_exec( $ch ); 
					$err 			= curl_errno( $ch ); // helpful for troubleshooting 
					$errmsg 		= curl_error( $ch ); // helpful for troubleshooting 
					curl_close( $ch );
			
					$im 	= @imagecreatefromstring($imagedata);
			}
			
			$rgb 	= @imagecolorat($im,$x,$y);
			$r 		= ($rgb >> 16) & 0xFF;
			$g 		= ($rgb >> 8) & 0xFF;
			$b 		= $rgb & 0xFF;
			@imagedestroy($im);
	
			$out = "";
			  foreach (array($r, $g, $b) as $c) {
				
				$hex = base_convert($c, 10, 16);
				
				$out .= ($c < 16) ? ("0".$hex) : $hex;
				
			  }
			 
			return '#'.$out;
		}else{
			return '#000000';
		}
	
	}
}

/* remove white space */
function wspace($string){
	
	$string = preg_replace( array('/[^(http:)]\/\/.*$/m','/\/\*.*\*\//U', '/\s+/'), array('','',' '), $string);
	return $string;
}


// convert space in to span
function addspan($s,$c){
	
	$output = '<span class="title_split titlesplit'.$c.'">'.$s.'</span>';
    return $output;
	
}