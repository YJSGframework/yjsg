<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// Check to ensure this file is within the rest of the framework
defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */
 

class JFormFieldYjsgcheck extends JFormField
{
	
	public $type = 'Yjsgcheck';
	 
	public function getInput(){

		if (!defined( 'YJSGRUN' )) {	
			echo '<h1 style="color:red;">'.JText::_('YJSG_PLUGIN_NOT_FOUND').'</h1>';
			return;
		}
		
		$document 			= YjsgDochead::getDocument();
		$document->addJsInhead("var comp_dis ='".JText::_('YJSG_COMPONENT_DISABLED')."';");	
		$yjsg 				= Yjsg::getInstance();
		$YjsgCurrentVersion = $yjsg->version;
		$YjsgHasUpdate 		= $yjsg->hasupdate;
		$YjsgLatestVersion 	= $yjsg->getUpdateVersion();
		$template_folder	= basename(dirname(dirname(__FILE__)));
		
		
		$params_obj = $this->form->getValue('params');
		$params 	= new JRegistry();
		$params->loadObject($params_obj);

		$comp_dis  ='<div id="option-resut">';
		if($params->get('component_switch')){
			$comp_dis .= JText::_('YJSG_COMPONENT_DISABLED');
		}
		$comp_dis .='</div>';



		$yjsgManageLink		='index.php?option=com_plugins&view=plugins&filter_folder=system&filter_search=Yjsg';
		$yjsgText 			=''.JText::_('YJSG_INS_PUB')." <strong>v".$YjsgCurrentVersion."</strong> ".JText::_('YJSG_INS_PUB2').' <a href="'.$yjsgManageLink.'">'.JText::_('YJSC_MAN_EXT').'</a>';
		

		
		if($YjsgHasUpdate == 1){
			
			$updateclass =' updateavailable';
			
		}else{
			$updateclass ='';
		}

		// yjsg
		$syshtml ='<div class="yj_system_check">';
		$syshtml .='<div id="yjsgBox" class="systemBox'.$updateclass.'">';
		$syshtml .='<h2 id="yjmmpTitle" class="systemBoxTitle yjsgtips" data-original-title="'.JText::_('YJSG_CHECK').'" data-content="'.JText::_('YJSG_CHECK_TIP').'">'.JText::_('YJSG_CHECK').'</h2>';
		if($YjsgHasUpdate == 1){
			$syshtml .='<div class="infoText"><span class="showIcon"></span> ';
			$syshtml .=JText::_('UPDATE_AVAILABLE_TEXT').'<strong>'.$YjsgCurrentVersion.'</strong>';
			$syshtml .=JText::_('UPDATE_AVAILABLE_TEXT2').'<strong>'.$YjsgLatestVersion.'</strong>';
			$syshtml .='<a href="index.php?option=com_installer&amp;view=update">'.JText::_('UPDATE_AVAILABLE_TEXT3').'</a>';
			$syshtml .='</div>';
		}else{
			$syshtml .='<div class="infoText"><span class="showIcon"></span>'.$yjsgText.'</div>';
		}
		$syshtml .='</div>';	
		

		$syshtml .='<div  id="settmsgBox" class="systemBox hide">';
		$syshtml .='<h2 id="yjjbpTitle" class="systemBoxTitle yjsgtips" data-original-title="'.JText::_('YJSG_SETT_MSG').'" data-content="'.JText::_('YJSG_SETT_MSG_TIP').'">'.JText::_('YJSG_SETT_MSG').'</h2>';
		
		$syshtml .='<div class="infoText"><span class="showIcon"></span>'.$comp_dis.'</div>';
		$syshtml .='</div>';
		$syshtml .='</div>';// close yj_system_check
			
		// Output
		echo $syshtml;

	}

	public function getLabel() {
		return false;
	}
}