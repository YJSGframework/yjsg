<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
// No direct access.
defined('_JEXEC') or die;
$yjsg 				= Yjsg::getInstance();
$getapps			= JFactory::getApplication();
$template 			= $getapps->getTemplate();
$menu_path 			= YJSGPATH . "legacy" . YJDS . "html" . YJDS . "mod_menu" . YJDS;
$menu_type 			= $params->get('yjsg_menu_module_type','default');

require($menu_path."yjsg_menuswitch.php");

if(!empty($class_sfx)){
	$class_sfx = ' '.$class_sfx;
}

switch ($menu_type) {
    case "default":
        $menuclass		= '';
		$type_selected 	='default';
        break;
    case "inline":
        $menuclass		= ' inline';
		$type_selected 	='default';
        break;
    case "accordion":
        $menuclass		= ' yjsgacc';
		$type_selected 	='accordion';
        break;
    case "accordion_notoggle":
        $menuclass		= ' yjsgacc notoggle';
		$type_selected 	='accordion';
        break;
    case "navbar":
        $menuclass		= ' navbar navbar-only';
		$type_selected 	='navbar';
        break;
    case "navbarinverse":
        $menuclass		= ' navbar navbar-inverse';
		$type_selected 	='navbar';
        break;
    case "navpills":
        $menuclass		= ' nav nav-pills';
		$type_selected 	='navpills';
        break;
	default:
	 	$menuclass		= '';
		$type_selected 	='default';
}

/*yjmega*/
if ($params->get('class_sfx') =='nav' || $params->get('class_sfx') =='navd' || $params->get('class_sfx') =='split') {
		
		
		require( $menu_path."yjsgmegalegacy".YJDS."default.php");

/*bootstrap navpills*/		
}elseif($params->get('class_sfx') =='nav nav-pills' || $type_selected =='navpills'){
		
		require( $menu_path."bootstrappill".YJDS."default.php");
		
/*bootstrap navbar*/ 		
}elseif($params->get('class_sfx') =='navbar' || $params->get('class_sfx') == 'navbar navbar-inverse'  || $type_selected =='navbar'){
		
		require( $menu_path."bootstrapnavbar".YJDS."default.php");
		
/*yjsgacc*/ 
}elseif(strstr($params->get('class_sfx'),'yjsgacc') || $type_selected =='accordion'){
		
		require( $menu_path."yjsgacc".YJDS."default.php");
		
/* everything else */			
}else{
		
		require( $menu_path."joomladefault".YJDS."default.php");
}