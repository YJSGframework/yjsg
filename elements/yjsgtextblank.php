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
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldYJSGTextBlank extends JFormField
{
	public $type = 'YJSGTextBlank';
	
	public function getInput(){

		
		// Output		
		return '
			<div class="yjsg_param_title_blank">
				'.JText::_($this->value).'
			</div>';
	}

	public function getLabel() {
		return false;
	}
}