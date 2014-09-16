<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');
JFormHelper::loadFieldClass('list');

/**
 * Supports an HTML select list of files
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldYjsgbackgrounds extends JFormFieldList
{

	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */ 
	public $type = 'Yjsgbackgrounds';

	/** 
	 * Method to get the list of files for the field options.
	 * Specify the target directory with a directory attribute
	 * Attributes allow an exclude mask and stripping of extensions from file name.
	 * Default attribute may optionally be set to null (no file) or -1 (use a default).
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getInput()  
	{

		
		// Initialize some field attributes.
		$filter = (string) $this->element['filter'];
		$exclude = (string) $this->element['exclude'];
		$stripExt = (string) $this->element['stripext'];
		$hideNone = (string) $this->element['hide_none'];
		$hideDefault = (string) $this->element['hide_default'];

		// Get the path in which to search for file options.
		$xml_path = (string) $this->element['directory'];
		if (!is_dir($xml_path))
		{
			$path = JPATH_ROOT . '/' . $xml_path;
		}

		// Get a list of files in the search path with the given filter.
		$files = JFolder::files($path, $filter);



		// Build the options list from the list of files.
		if (is_array($files))
		{
			
			natsort($files);
			foreach ($files as $file)
			{

				// Check to see if the file is in the exclude mask.
				if ($exclude)
				{
					if (preg_match(chr(1) . $exclude . chr(1), $file))
					{
						continue;
					}
				}

				// If the extension is to be stripped, do it.
				if ($stripExt)
				{
					$file = JFile::stripExt($file);
				}
				
				$css_class = JFile::stripExt($file);
				//get the selected class
				if($this->value == $file){
					$css_class .= " selected";
				}
				
				$thisdefault ='';
				if($file == $this->element['default']){
					
					$thisdefault = ' defaultImg';
				}

				$patterns_layout []='<div class="patterns '.$css_class.$thisdefault.'" data-thisimg="'.$file.'">';
				$patterns_layout []='<img src="'. JURI::root() . $xml_path .'/'.$file.'" class="yjsgtips" data-placement="bottom" data-original-title="This is" data-content="'.JFile::stripExt($file).'" />';
				$patterns_layout []='<div class="preview"></div>';
				$patterns_layout []='</div>';
			}
		}


			$html = '<div class="YJSG_sbox yjsgbackgrounds" id="'.$this->element['name'].'">';
			$html .= '<div class="patternsIn">';
			$html .= implode($patterns_layout);
			$html .='<br />';
			$html .='<a class="reset_'.$this->id.' resetBgs" href="#">'.JText::_('YJSG_RESET').'</a>';
			$html .='</div>';
			$html .='<input  id="'.$this->id.'" class="patterninputHide" type="text" name="'.$this->name.'" value="'.$this->value .'" />';
			$html .='</div>';

		return $html;
	}
	

}

