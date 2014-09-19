<?php 
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
defined( '_JEXEC' ) or die( 'Restricted index access' ); 

jimport( 'joomla.filesystem.folder' );

	
	$input_less 	= YJSGPATH."assets".YJDS.$bootstrap_version.YJDS."yjsgless".YJDS."template.less";
	$fontawesome 	= YJSGPATH."assets".YJDS."css".YJDS."font-awesome.min.css";
	$mediajs		= YJSGPATH."assets".YJDS."src".YJDS."mediaelement".YJDS."mediaelementplayer.min.css";
	$customcss		= YJSGTEMPLATEPATH."css".YJDS."custom.css";
	$fontfacekit	= YJSGTEMPLATEPATH."css".YJDS."fontfacekits".YJDS.$fontfacekit_font_family.YJDS."stylesheet.css";
	$cssFolder 		= '/assets/css/';
	$menus 			='"../../../../../../plugins/system/yjsg'.$cssFolder.'yjsgmenus.css"';

	if($yjsg->preplugin()){
		
		$cssFolder = '/legacy/css/';
		$menus ='"../../../../../../templates/'.$this->template.'/css/menus.css"';
		
	}
	
	require_once "classes/less.php/Less.php";
	require_once "classes/less.php/YjsgLessCache.php";
	$yjsgLess		= new YjsgLessCache;


	if (JFile::exists(YJSGCOMPILER_LOG.'yjsg_compiler_log_'.$css_file.'.php')){
		include_once (YJSGCOMPILER_LOG.'yjsg_compiler_log_'.$css_file.'.php');
		
		$cache = unserialize($YjsgCompilerLog);
		
	} else {
		
		$cache = $input_less; 
		
	}
	
	$readCache = $yjsgLess->cachedCompile($cache);





if (!is_array($cache) || $readCache["updated"] > $cache["updated"] || !file_exists($output_css)) {
	
	try{

			// set compiler options
			if($compiler_compressed == 1){
				$options 		= array( 'compress'		=>true,
										 'relativeUrls' => false
				 );
			}else{
				
				$options 		= array( 'compress'		=>false,
										 'relativeUrls' => false
				 );
			}
		 
		 
			$parser 		= new Less_Parser( $options );
			
			// check if template is legacy
			if($yjsg->preplugin()){
				
				$parser->ModifyVars( array(
					'legacy'				=>'true'
					) 
				);				
			
			
			}else{
				
				$parser->ModifyVars( array(
					'legacy'				=>'false'
					) 
				);				
				
			}
			
			
			//  use compiler to compress css if bootstrap is not loaded
			if($bootstrap_here){

				$parser->ModifyVars( array(
					'loadbootstrap'				=>'true'
					) 
				);	
				
			}else{
				
				$parser->ModifyVars( array(
					'loadbootstrap'				=>'false'
					) 
				);					
				
			}
			
			// set custom.css/less file var if is turned on
			if($custom_css == 1 && $compile_css == 1){
				$parser->ModifyVars( array(
					'custom_css' 			=> '"../../../../../../templates/'.$this->template.'/css/custom.css"',
					) 
				);				
			}else{
				
				$parser->ModifyVars( array(
					'custom_css' 			=> '"custom.less"',
					) 
				);						
				
			}
			
			
			

			
			
			
			if($compile_css == 1){
				
				
				$parser->ModifyVars( array(
					'loadall'				=>'true',
					'bootstrap'				=>'"../less/bootstrap.less"',
					'yjsgless'				=>'"yjsg.less"',
					'sitelinkcolor' 		=> '#'.$valid_color,
					'normalize' 			=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'normalize.css"',
					'yjsg_layout' 			=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'yjsg_layout.css"',
					'newsitems'		 		=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'newsitems.css"',
					'typo' 					=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'typo.css"',
					'joomladefaults' 		=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'joomladefaults.css"',
					'template_css' 			=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'template.css"',
					'yjsg_responsive' 		=> '"../../../../../../plugins/system/yjsg'.$cssFolder.'yjresponsive.css"',
					'menus_css' 			=> $menus,
					'layout_css' 			=> '"../../../../../../templates/'.$this->template.'/css/layout.css"',
					'custom_responsive' 	=> '"../../../../../../templates/'.$this->template.'/css/custom_responsive.css"',
					'template_style' 		=> '"../../../../../../templates/'.$this->template.'/css/'.$css_file.'.css"',
					
					) 
				);	
	
				
			}else{
				
				$parser->ModifyVars( array(
					'loadall'				=>'false',
					'bootstrap'				=>'"../less/bootstrap.less"',
					'yjsgless'				=>'"yjsg.less"',
					'sitelinkcolor' 		=> '#'.$valid_color,
					) 
				);
		
			}
			
			$parser->parseFile($input_less, false );
			if ($selectors_override == 1 && $selectors_override_type == 3 && $compile_css == 1){
				
				$parser->parseFile($fontfacekit,false);
				
			}
			
			$output_cssContents	 = $parser->getCss();
			$imported_files 	 = $parser->allParsedFiles();
			$newCache			 = $yjsgLess->newCache($imported_files);
	
			
			
			//  replace all calls for assets folder with actual path and remove @imports generated by compiler if we are compiling everything
			if($compile_css == 1){
				$output_cssContents = str_replace('../../../../../plugins/system/yjsg/assets/',YJSG_ASSETS,$output_cssContents);
				$output_cssContents	= preg_replace('/(@import(.*?);)/s', '', $output_cssContents);
			}
			
			// replace @font-face kit font strings if the settings is on
			if ($selectors_override == 1 && $selectors_override_type == 3 && $compile_css == 1){
				$output_cssContents	=  preg_replace("/(url\('(?!\.)(?!\/))/s","url('".YJSGSITE_PATH.'css/fontfacekits/'.$fontfacekit_font_family.'/', $output_cssContents);
			}

			// replace @font-face font strings for fontawesome
			$getfontawesome='';
			if($compile_css == 1){
				$getfontawesome = JFile::read($fontawesome);
				$getfontawesome	= str_replace('../../../../../plugins/system/yjsg/assets/',YJSG_ASSETS,$getfontawesome);
			}
			
			// replace strings for mediajs
			$getmediajs ='';
			if($yjsg_media_on   == 1 && $compile_css == 1){
				$getmediajs = JFile::read($mediajs);
				$getmediajs	=	str_replace('assets/',YJSG_ASSETS.'src/mediaelement/assets/',$getmediajs);
			}

			//add file data
			 $file_data ="/**".PHP_EOL."* compiled template.css file created by ".ucwords($this->template)." Template using ".$bootstrap_version.PHP_EOL."* @package ".ucwords($this->template)." Template".PHP_EOL."* @author Youjoomla.com".PHP_EOL."* @website Youjoomla.com ".PHP_EOL."* @copyright	Copyright (c) since 2007 Youjoomla.com.".PHP_EOL."* @license PHP files are GNU/GPL V2 Copyleft CSS / LESS / JS / IMAGES are Copyrighted material".PHP_EOL."**/".PHP_EOL."";
			
			
			
			// add them all in by their order
			$new_cssContents	 = $file_data;
			$new_cssContents 	.= $getfontawesome;
			$new_cssContents 	.= $getmediajs;
			$new_cssContents 	.= $output_cssContents;
			
			
			// write new css file and compiler log
			JFile::write($output_css,$new_cssContents);
			$writeValue = "<?php defined('JPATH_PLATFORM') or die; \$YjsgCompilerLog = '".serialize($newCache)."'; ?>";
			JFile::write(YJSGCOMPILER_LOG.'yjsg_compiler_log_'.$css_file.'.php', $writeValue);
			
	
		
		
		
		} catch (exception $e) {
			
			if( $need_to_compile == 1  ){
				header("Content-Type: application/json");
				echo 'Compiler error:<br />'.wordwrap($e->getMessage(),50, "<br />", true);
				exit;

			}else{
				@JError::raiseWarning( 100, JText::_('YJSG_LESS_COMPILER_ERROR').'<br />'.$e->getMessage());
			}
		}
	
}