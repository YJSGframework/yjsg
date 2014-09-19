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

class JFormFieldYJSGTime extends JFormField
{
	/** 
	* Element type
	*
	* @access	protected
	* @var		string
	*/
	public $type = 'YJSGTime';
	
	public function getInput()
	{

		
		jimport('joomla.filesystem.file');
		jimport( 'joomla.filesystem.folder' );
		
		$document = JFactory::getDocument();

		$db = JFactory::getDBO();
		$query = "SELECT template FROM #__template_styles WHERE id =".JFactory::getApplication()->input->get('id')."";
		$db->setQuery($query);
		$this_template = $db->loadResult();


		return '<input type="hidden" name="'.$this->name.'" id="'.$this->element['name'].'" value="'.time().'" />
				<input type="hidden" name="YJSG_template_path" id="YJSG_template_path" value="'.JURI::root()."templates/".$this_template.'" />
				<input type="hidden" name="YJSG_plugin_path" id="YJSG_plugin_path" value="'.YJSGSITE_PLG_PATH.'" />
				<input type="hidden" name="YJSG_site_path" id="YJSG_site_path" value="'.JURI::root().'" />
				<input type="hidden" name="YJSG_template_id" id="YJSG_template_id" value="'.JFactory::getApplication()->input->get('id').'" />';
						
	}
	
	public function getLabel() {
		return false;
	}
}