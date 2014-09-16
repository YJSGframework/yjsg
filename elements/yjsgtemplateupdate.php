<?php
/**
 * @package     Joomla.Platform
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Renders a Yjsgtemplateupdate element
 *
 * @package     Yjsg Framework
 * @subpackage  Parameter
 * @since       1.0.16
 */
 
class JFormFieldYjsgtemplateupdate extends JFormField
{
	
	protected $_name = 'Yjsgtemplateupdate';
	
	public function getInput()
	{

		if (!class_exists('Yjsg')) {
			return;
		}
		
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		
		
		$yjsg		= Yjsg::getInstance();// make sure is YJ template
		
		if($yjsg->yjtmpl()){
			
			$e_folder 	= basename(dirname(dirname(__FILE__)));
			$document 	= JFactory::getDocument();
			$document->addStyleSheet(JURI::root() . 'plugins/system/'.$e_folder.'/elements/css/yjsgplg.css');
			if (intval(JVERSION) < 3) {
				$document->addScript(JURI::root() . 'plugins/system/'.$e_folder.'/assets/src/libraries/jquery.min.js');
				$document->addScript(JURI::root() . 'plugins/system/'.$e_folder.'/assets/src/libraries/jquery-noconflict.js');
			}
			$document->addScript(JURI::root() . 'plugins/system/'.$e_folder.'/elements/src/yjsgplg.js');	
			$document->addScriptDeclaration("
			
			
					var yjsgPlgpath = '".JURI::root()."';
					var updatingTemplate ='".JText::_('YJSG_UPDATING_TXT')."';
					var restoringTemplate ='".JText::_('YJSG_RESTORING_TXT')."';
			");

		
		}
		
		$html ='<div class="update_template">';
		$html .='<div class="update_msg"><i class="fa fa-refresh fa-spin"></i> '.JText::_('YJSG_COMP_CHECK').'</div>';
		$html .='<a id="update" class="updatebuttons" href="#">'.JText::_('YJSG_UPDATE').'</a>';
		$html .='<a id="restore" class="updatebuttons" href="#">'.JText::_('YJSG_RESTORE').'</a>';
		$html .='<a id="cleanup" class="updatebuttons" href="#">'.JText::_('YJSG_CLEANUP').'</a>';
		$html .='</div>';



		if($yjsg->yjtmpl()){
			return $html; 
		}else{
			return;
		}


	}

	public function getLabel() 
	{
		return false;
	}
}