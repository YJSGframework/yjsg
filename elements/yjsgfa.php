<?php
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

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a container with FontAwesome icons
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldYjsgfa extends JFormField
{
	public $type = 'Yjsgfa';
	
	public function getInput()
	{
		

		
		$size = ( $this->element['size'] ? 'size="'.$this->element['size'].'"' : '' );
		$class = ( $this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="text_area"' );
		$document	    					 = JFactory::getDocument();
		
		$document	= JFactory::getDocument();
		$uri 		= JURI::base(true);
		$uri 		= str_replace("/administrator", "", $uri);
		$tipClass	= 'hasTooltip';
		
		
		
		if(intval(JVERSION) < 3){
			$tipClass	= 'hasTip';
			$document->addScript($uri.'/plugins/system/yjsg/assets/src/libraries/jquery.min.js');
			$document->addScript($uri.'/plugins/system/yjsg/assets/src/libraries/jquery-noconflict.js');
		}

		$document->addScript($uri.'/plugins/system/yjsg/elements/src/yjsgfa.js');
		$document->addStyleSheet($uri.'/plugins/system/yjsg/elements/css/yjsgfa.css');
		
		
		/*
         * Required to avoid a cycle of encoding &
         * html_entity_decode was used in place of htmlspecialchars_decode because
         * htmlspecialchars_decode is not compatible with PHP 4
         */
      	$value = htmlspecialchars(html_entity_decode($this->value, ENT_QUOTES), ENT_QUOTES);
		
		$html='';
		defined('YJDS') or define('YJDS', DIRECTORY_SEPARATOR);
		
		
		$jsonpath = JPATH_ROOT . YJDS ."plugins". YJDS ."system". YJDS ."yjsg". YJDS ."elements". YJDS;

		$yjsgfa_string	= JFile::read($jsonpath."yjsgfa.json");
		$yjsgfa 		= json_decode($yjsgfa_string, true);		
		
		$html='<div class="yjsg-icons-container">';
		$html .='<input type="text" name="'.$this->name.'" id="'.$this->id.'" value="'.$this->value.'" '.$class.' '.$size.' />';
		$html .= '<div class="yjsg-icons-holder">';
		foreach ($yjsgfa['icons'] as $yjsgfaicons => $yjsgfaicon) {
		  
		  if(intval(JVERSION) < 3){
		  	$tipTitle	=' title="Icon name::'.$yjsgfaicon['id'].'" ';
		  }else{
			$tipTitle	='  title="<strong>Icon name</strong><br />'.$yjsgfaicon['id'].'" ';
		  }
			$html .= '<span data-faname="fa fa-'.$yjsgfaicon['id'].'" class="'.$tipClass.' fa fa-'.$yjsgfaicon['id'].'"'.$tipTitle.'></span>';
		}
		$html .='</div>';
		$html .='</div>';		
		
		
		
       	return $html;
	}	
}