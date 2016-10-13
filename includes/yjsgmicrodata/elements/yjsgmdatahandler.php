<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */

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

	}
	
	
	public function getLabel() {
		return false;
	}	
}