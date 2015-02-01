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

class JFormFieldYJSGText extends JFormField
{
	public $type = 'YJSGText';
	
	public function getInput()
	{

		
		$size = ( $this->element['size'] ? 'size="'.$this->element['size'].'"' : '' );
		$class = ( $this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="text_area"' );
		$hint = ( $this->element['hint'] ? 'placeholder="'.JText::_($this->element['hint']).'"' : '' );
		
		$searchName1 = array('maincolumn','insetcolumn','leftcolumn','rightcolumn');
		$searchName2 = array('maincolumn_itmid','insetcolumn_itmid','leftcolumn_itmid','rightcolumn_itmid');

		
		if(in_array($this->element['name'],	$searchName1)){	
			
			$class = 'class="input-mini yjsg_mainbody_width"';
			$size  = 'size="4"';
		}
 
 		if(in_array($this->element['name'],	$searchName2)){	
			
			$class = 'class="input-mini yjsg_mainbody_itmid_width"';
			$size  = 'size="4"';
		}       
		/*
         * Required to avoid a cycle of encoding &
         * html_entity_decode was used in place of htmlspecialchars_decode because
         * htmlspecialchars_decode is not compatible with PHP 4
         */
      	$value = htmlspecialchars(html_entity_decode($this->value, ENT_QUOTES), ENT_QUOTES);
		
		
		$output ='';
		$output .='';
		$output .='';
		
       	return '<input type="text" name="'.$this->name.'" id="'.$this->id.'" value="'.$this->value.'" '.$hint.' '.$class.' '.$size.' />';
	}	
}