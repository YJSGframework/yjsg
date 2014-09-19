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
class plgSystemYJSGInstallerScript{

		public function postflight( $type, $parent )  {
			  $db = JFactory::getDbo();
		
			  try
			  {

				 $q = $db->getQuery(true);
		
				 $q->update('#__extensions');
				 $q->set(array('enabled = 1','ordering = -5000'));
				 $q->where("element = 'yjsg'");
				 $q->where("type = 'plugin'", 'AND');
				 $q->where("folder = 'system'", 'AND');
		
				 $db->setQuery($q);
		
				 method_exists($db, 'execute') ? $db->execute() : $db->query();
			  }
			  catch (Exception $e)
			  {
				 throw $e;
			  }
			  

			if(!JFolder::exists(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/')) return;
			
            JFolder::delete(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/');
            JFolder::create(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/');
            $indexContent = '';
            JFile::write(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/index.html', $indexContent);			  
		}
}