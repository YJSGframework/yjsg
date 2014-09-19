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
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');


class JFormFieldYJSGList extends JFormFieldList
{
	
	
	protected $_name = 'YJSGList';
	
	public function getInput() 
	{

		
		$class 	= ( $this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="inputbox"' );
		$val 	= $this->value;// default option
		
		$options = array ();
		
		$template_folder = basename(dirname(dirname(__FILE__)));

		foreach ($this->element->children() as $option)
		{
			
			if(strstr($option['value'], '|')){
				$add_data =' data-defaultcolor="'.$option['value'].'"';
			}else{
				$add_data ='';
			}
			
			$value = $option['value'];
			$class = $option['disable'] ? ' class="disable_next '.$option['disable'].' ' : ' class="';
			$class .= $option['enable'] ? 'enable_next '.$option['enable'].'"' : '"';
			$selected = $val == $value ? ' selected="selected"':'';
	
			
			$text	= $option['text'];
			$options[] = '<option'.$add_data.' value="'.$value.'"'.$class.$selected.'>'.JText::_(trim((string) $option)).'</option>';
		}
		
		$selectData ='';
		if($this->element['yjsgstyles']){
			$selectData =' data-field="yjsgstyles" data-currentdefault="'.$this->value.'"';
		}
		$select_class = $this->element['class'] ? ' class="' . (string) $this->element['class'] . '"' : '';
		$s = '<div class="YJSG_sbox '.$this->element['name'].'">';
		$s.= '<select name="'.$this->name.'" '.$select_class.' id="'.$this->id.'"'.$selectData.'>';
		$s.= implode("\n", $options);
		$s.= '</select>';
		
		if($this->element['yjsgstyles']){
			
			$split_selected_value 			= explode('|',$val);
			$color_value					= '#'.$split_selected_value[1];
			
			$s.='<div id="'.$this->element['name'].'_colors" class="linkcolorlabel">';
			$s.='<label id="jform_params_'.$this->element['name'].'_col-lbl" class="adminLabel" data-original-title="'.JText::_('LINK_COLOR').'" data-content="'.JText::_('LINK_COLOR_TIP').'">'.JText::_('LINK_COLOR').'</label>';
			$s.='<div class="holdInput">';
			$s.='<input id="jform_params_'.$this->element['name'].'_col" type="text" name="'.$this->element['name'].'_col" data-switcher="#'.$this->id.'" value="'.$color_value.'" class="yjsg-colorpicker text_area def_link_color" size="15"/>';
			$s.='</div>';
			$s.='</div>';
		}
		
		$s.='</div>';
		
		return $s;	
	}
}