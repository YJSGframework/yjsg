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
if(isset($_SERVER['HTTP_USER_AGENT'])){
	$who = strtolower($_SERVER['HTTP_USER_AGENT']);
}else{
	$who ='';
}
$app = JFactory::getApplication();
$yjsg_params 		= $app->getTemplate(true)->params;
// MENU
$mymenu = array(
        1, 2, 3, 4, 5, 6
);
$default_menu = $yjsg_params->get('default_menu_style',"2");
$valid_menu ='';
//*
if ( isset($_GET['change_menu']) && !empty($_GET['change_menu']) ) {
        // check if style is valid
        if( in_array( $_GET['change_menu'], $mymenu ) ){

                $_SESSION['frontend_menu'] = $_GET['change_menu'];
                $_SESSION['frontend_changed_menu'] = true;
                $valid_menu = $_GET['change_menu'];

        }else {
                // else set to default style
                $valid_menu = $default_menu;
        }

} else {
        // second case, checkes for admin changes or front-end changes

        if ( isset($_SESSION['frontend_changed_menu']) && in_array( $_SESSION['frontend_menu'], $mymenu ) ){

                $valid_menu = $_SESSION['frontend_menu'];

        }else if( isset( $_SESSION['admin_change'] ) ){

                $default_menu = $yjsg_params->get("default_menu_style","2");

        }else {
                $valid_menu = $default_menu;
        }
}
$default_menu_style = in_array( $valid_menu, $mymenu ) ? $valid_menu : $default_menu;


// DIRECTION
$mydirection = array(
        1, 2
);
$default_direction = $yjsg_params->get("text_direction");
$valid_direction='';
//*
if ( isset($_GET['change_direction']) && !empty($_GET['change_direction']) ) {
        // check if style is valid
        if( in_array( $_GET['change_direction'], $mydirection ) ){

                $_SESSION['frontend_direction'] = $_GET['change_direction'];
                $_SESSION['frontend_changed_direction'] = true;
                $valid_direction = $_GET['change_direction'];

        }else {
                // else set to default style
                $valid_direction = $default_direction;
        }

} else {
        // second case, check for admin changes or front-end changes

        if ( isset($_SESSION['frontend_changed_direction']) && in_array( $_SESSION['frontend_direction'], $mydirection ) ){

                $valid_direction = $_SESSION['frontend_direction'];

        }else if( isset( $_SESSION['admin_change'] ) ){

                $valid_direction = $yjsg_params->get("text_direction","2");

        }else {
                $valid_direction = $default_direction;
        }
}
//*/
global $text_direction;
$text_direction = in_array( $valid_direction, $mydirection ) ? $valid_direction : $default_direction;
$ie6style = preg_match( "/msie 6.0/",$who);
$subul_class ='';
$allow_level ='';
$yj_mega_menus = $default_menu_style == '1' || $default_menu_style == '2' || $default_menu_style == '3' || $default_menu_style == '4';

if ($default_menu_style == '1' || $default_menu_style == '2'){
	$subul_class = '';
	$allow_level = 0;

}elseif($default_menu_style == '3' || $default_menu_style == '4'){
	$subul_class = ' dropline';
	$allow_level = 2;
}