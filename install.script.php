<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// no direct access 
defined('_JEXEC') or die();
class plgSystemYJSGInstallerScript {
    
    
    
    /**
     * Yjsg instance
     *
     * @return	Yjsg
     * @since 2.0.0
     */
    
    
    public $yjsg;
    
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */    
    
    public function postflight($type, $parent) {
        
        
        
        $db = JFactory::getDbo();
        
        try {
            
            $q = $db->getQuery(true);
            
            $q->update('#__extensions');
            $q->set(array(
                'enabled = 1',
                'ordering = -5000'
            ));
            $q->where("element = 'yjsg'");
            $q->where("type = 'plugin'", 'AND');
            $q->where("folder = 'system'", 'AND');
            
            $db->setQuery($q);
            
            method_exists($db, 'execute') ? $db->execute() : $db->query();
        }
        catch (Exception $e) {
            throw $e;
        }
        
        JLoader::register('Yjsg', JPATH_ROOT . '/plugins/system/yjsg/includes/yjsgcore/classes/yjsg.class.php', true);
        
        $this->yjsg = Yjsg::getInstance();
        
        
        $language 				= JFactory::getLanguage();
        $language->load('plg_system_yjsg', JPATH_ADMINISTRATOR);
		$yjsgTemplateName 		= Yjsg::getDefaultTemplate();
        $yjsgTemplateNameTxt 	= ucfirst(Yjsg::getDefaultTemplate());
        $defaultTemplate 		= JPATH_ROOT . '/templates/' . $yjsgTemplateName;
        $beforeCleanup   		= JPATH_ROOT . '/templates/' . $yjsgTemplateName . '-beforeCleanup';
		$extendFolder			= JPATH_ROOT . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/'; 
		$indexContent 			= '';      
        
        if (!JFolder::exists($beforeCleanup) && $this->yjsg->yjtmpl() && $this->yjsg->tmplVersion($yjsgTemplateName) == '1.0.16') {

			
			if (JFolder::copy($defaultTemplate, $beforeCleanup)) {

			    $backedUpMsg = $yjsgTemplateNameTxt . JText::_('YJSG_INSTALLER_TMPL_BACKUP');
                JFactory::getApplication()->enqueueMessage($backedUpMsg);

			} else {

                $nobackupMsg = JText::_('YJSG_INSTALLER_TMPL_NO_BACKUP1') .$yjsgTemplateNameTxt  . JText::_('YJSG_INSTALLER_TMPL_NO_BACKUP2');
                JError::raiseWarning(100, $nobackupMsg);

			}
			

        }
        
        
        if (JFolder::exists($extendFolder)){
        
        	JFolder::delete($extendFolder);
        	JFolder::create($extendFolder);
        	JFile::write($extendFolder . 'index.html', $indexContent);
		}
    }
}