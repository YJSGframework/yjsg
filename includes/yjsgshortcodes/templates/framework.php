<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
define( '_JEXEC', 1 ); 
$get_file_info  = pathinfo(__FILE__);
$jpath = preg_replace('/(\btemplates\b|\bmodules\b|\bcomponents\b|\bplugins\b)(.*)/','',$get_file_info['dirname']);

define('JPATH_BASE',rtrim($jpath,DIRECTORY_SEPARATOR));

require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'defines.php' );
require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php' );

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.plugin.helper');
jimport('joomla.session.session');

$mainframe 				= JFactory::getApplication('site');
$mainframe->initialise();
if (intval(JVERSION) >= 3) {
	JPluginHelper::importPlugin('system','yjsg');
}
$session 				= JFactory::getSession();
$user 					= JFactory::getUser();
$language				= JFactory::getLanguage();
$base_link				= preg_replace('/(\btemplates\b|\bmodules\b|\bcomponents\b|\bplugins\b)(.*)/','',JURI::root());
$language->setLanguage(JComponentHelper::getParams('com_languages')->get('site'));
