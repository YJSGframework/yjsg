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

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldYjsgsinglebox extends JFormField
{
	public $type = 'Yjsgsinglebox';
	
	public function getInput()
	{

		
		$yjsg 				= Yjsg::getInstance();
		$app				= JFactory::getApplication();
		$templateId 		= $app->input->get( 'id' );
		$YjsgDbParams		= json_decode( $yjsg->getDbParams( $templateId ), true );

			
	
		
		
		$sidebars 	 = false ;
		$searchName1 = array('leftcolumn','rightcolumn','insetcolumn');

 
 		if(in_array($this->element['name'],	$searchName1)){	
			
			$sidebars 	 = true;
		}       


		
		$customchrome	= $this->element['customchrome'];
		$gridgroup		= $this->element['gridgroup'];
		$clabel			= $this->element['clabel'];
		$cclass			= $this->element['cclass'];
		$chromename		= str_replace(array('jform[params]', '[', ']'),'',$this->name).'_custom_chrome';
		$html 			= '';



		if($this->element['customchrome']){
			
			
			
			if(array_key_exists($chromename, $YjsgDbParams)){
				
				
				$chromeDefault =  $YjsgDbParams[$chromename];
				
			}else{
				
				$chromeDefault = $customchrome;
				
			}
			
			
			$html .='<a href="#" class="openChrome" data-chromedefault="'.$customchrome.'" data-chromemodule="#'.$chromename.'">';
			$html .='<i class="adminicons-chrome"></i>';
			$html .='</a>';					
			$html .='<div class="chromesHolder"  data-toggle="popover" data-placement="bottom" data-original-title="'.JText::_('YJSG_MOD_CHROME').'" data-content="'.JText::_('YJSG_MOD_CHROME_TIP').'">';
			$html .='<a href="#" data-thischrome="YJsgxhtml" class="seldefault">'.JText::_('YJSG_DEFAULT').' <i class="fa fa-check-square-o"></i></a>';
			$html .='<a href="#" data-thischrome="YJsground">'.JText::_('YJSG_MOD_CHROME_ROUND_NAV').' <i class="fa fa-square-o"></i></a>';
			$html .='<a href="#" data-thischrome="YJsgblank">'.JText::_('YJSG_MOD_CHROME_BLANK_NAV').' <i class="fa fa-square-o"></i></a>';
			
			if(!$sidebars){
				
				$html .='<a href="#" data-thischrome="YJsgtabs">'.JText::_('YJSG_MOD_CHROME_TABS').' <i class="fa fa-square-o"></i></a>';
				$html .='<a href="#" data-thischrome="YJsgaccordion">'.JText::_('YJSG_MOD_CHROME_ACCORDION').' <i class="fa fa-square-o"></i></a>';
				$html .='<a href="#" data-thischrome="YJsgslides">'.JText::_('YJSG_MOD_CHROME_SLIDES').' <i class="fa fa-square-o"></i></a>';
			}
			
			$html .='<input type="hidden" class="defChromes" name="jform[params]['.$chromename.']" id="'.$chromename.'"';		
			$html .=' data-default="'.$customchrome.'" value="'.$chromeDefault.'">';
			$html .='</div>';		
			
		}

		if($clabel !='insettop' && $clabel !='insetbottom'){
			
			$html .='<div class="yjsg_module">';
			$html .='<label>'.$clabel.'</label>';
			$html .='<input type="text" name="'.$this->name.'" id="'.$this->id.'"';
			$html .=' value="'.$this->value.'" class="input-mini yjsg_'.$gridgroup.'_width" size="4">';
			$html .='<div class="yjsgcheck">';
			$html .='<label>';
			$html .='<input type="checkbox" name="jform[params][yjsg_'.$gridgroup.'_width_locked][]" class="YJSG_checkbox yjsg_'.$gridgroup.'_width hidden">';
			$html .='<i class="fa fa-unlock"></i>';
			$html .='</label>';
			$html .='</div>';
			$html .='</div>';
		
		}else{
			
			$html .='<div class="yjsg_module orange">';
			$html .='<label>'.$clabel.'</label>';
			$html .='</div>';			
			
		}
		
		return $html;
	}	
}