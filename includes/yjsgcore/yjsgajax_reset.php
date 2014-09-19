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
define( '_JEXEC', 1 );
$get_file_info  = pathinfo(__FILE__);
$jpath = preg_replace('/(\btemplates\b|\bmodules\b|\bcomponents\b|\bplugins\b)(.*)/','',$get_file_info['dirname']);
define('JPATH_BASE',rtrim($jpath,DIRECTORY_SEPARATOR));
require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'defines.php' );
require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php' );

if(isset($_POST['ajaxreset']))	{

	$mainframe 			= JFactory::getApplication('site');
	$mainframe->initialise();
	$session 			= JFactory::getSession();
	unset( $_SESSION['frontend_changed_css'] );
	unset( $_SESSION['frontend_changed_font'] );
	unset( $_SESSION['frontend_changed_menu'] );
	unset( $_SESSION['frontend_changed_layout'] );
	unset( $_SESSION['frontend_changed_direction'] );	
	$_SESSION['admin_change'] = true;
	
	
}else{
	echo 'Restricted access';
}