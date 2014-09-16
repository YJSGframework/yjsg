<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Color Form Field class for the Joomla Platform.
 * This implementation is designed to be compatible with HTML5's <input type="color">
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @link        http://www.w3.org/TR/html-markup/input.color.html
 * @since       11.3
 */
class JFormFieldYjsgcolor extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.3
	 */
	protected $type = 'Yjsgcolor';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.3
	 */
	protected function getInput()
	{

		
		// Initialize some field attributes.
		$size = $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$classes = (string) $this->element['class'];


		if (empty($this->value))
		{
			// A color field can't be empty, we default to black. This is the same as the HTML5 spec.
			$colorvalue = '';
		}else{
			$colorvalue = '#'.$this->value;
		}

			$s='<div id="'.$this->id.'_colors" class="elementcolorlabel">';
			$s.='<div class="holdInput">';
			$s.='<input type="text" id="'.$this->id.'" name="'.$this->name.'" data-switcher="#'.$this->id.'" value="'.$colorvalue.'" class="yjsg-colorelement text_area def_link_color" />';
			$s.='</div>';
			$s.='</div>';
			
		return $s;
	}
}
