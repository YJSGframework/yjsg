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

class JFormFieldYjsgmdatahandler extends JFormField
{
	public $type = 'Yjsgmdatahandler';
	
	public function getInput()
	{
		
		$document	    					 = JFactory::getDocument();
		
		if(intval(JVERSION) < 3){
			$document->addScript(JURI::root( true ).'/plugins/system/yjsg/assets/src/libraries/jquery.min.js');
			$document->addScript(JURI::root( true ).'/plugins/system/yjsg/assets/src/libraries/jquery-noconflict.js');
		}
		$document->addScript(JURI::root( true ).'/plugins/system/yjsg/elements/src/yjsgmicrodata.js');
		$document->addStyleSheet(JURI::root( true ).'/plugins/system/yjsg/elements/css/yjsgmicrodata.css');
	

		
		
       //	return $html;
	}
	
	
	public function getLabel() {
		return false;
	}	
}