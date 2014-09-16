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

// no direct access 
defined('_JEXEC') or die();
class plgSystemYJSGInstallerScript{

		public function postflight( $type, $parent )
		   {
			  $db = JFactory::getDbo();
		
			  try
			  {

				 $q = $db->getQuery(true);
		
				 $q->update('#__extensions');
				 $q->set(array('enabled = 1','ordering = -1000'));
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
			  

			  
		   }
}