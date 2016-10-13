<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// No direct access.
defined('_JEXEC') or die;
$yjsg 						= Yjsg::getInstance();
$getapps					= JFactory::getApplication();
$template 					= $getapps->getTemplate();
$menu_path 					= YJSGPATH."includes".YJDS."html".YJDS."mod_menu".YJDS;
$menu_type 					= $params->get('yjsg_menu_module_type','default');
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
if ( $params->get('class_sfx') =='nav' || $params->get('class_sfx') =='navd' || $params->get('class_sfx') =='split' ) {
		
		
		require( $menu_path."yjsgmega".YJDS."default.php" );

/*bootstrap navpills*/ 		
}elseif($type_selected =='navpills'){
		
		require( $menu_path."bootstrappill".YJDS."default.php" );
		
/*bootstrap navbar*/ 		
}elseif($type_selected =='navbar'){
		
		require( $menu_path."bootstrapnavbar".YJDS."default.php" );
		
/*accordion*/ 
}elseif($type_selected =='accordion'){
		
		require( $menu_path."yjsgacc".YJDS."default.php" );

/* everything else */		
}else{
		
		require( $menu_path."joomladefault".YJDS."default.php" );
}