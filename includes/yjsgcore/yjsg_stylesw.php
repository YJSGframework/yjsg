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
defined( '_JEXEC' ) or die( 'Restricted index access' );

// get style values

$templateSettings 	= YJSGTEMPLATEPATH . "template-settings.xml";
$loadXml			= simplexml_load_file($templateSettings);	
$getStyles			= $loadXml->xpath("//field[@name='yjsg_get_styles']/@yjsgstyles");
$getStyles			= (string)$getStyles[0];
$getDefaultStyle	= $loadXml->xpath("//field[@name='yjsg_get_styles']/@default");
$getDefaultStyle	= (string)$getDefaultStyle[0];
$mystyles			= explode('|',$getStyles);

// get all available styles
foreach ($mystyles as $key=>$value) {
   list($yjsg_style, $yjsg_link) 	= explode("==", $value);
   $mystyles_out['yjsg_styles'][] 	= $yjsg_style;
   $mystyles_out['yjsg_links'][] 	= $yjsg_link;

}


// xml file default values
$get_def_style_value		= explode('|',$getDefaultStyle);
$default_style  			= $get_def_style_value[0];
$def_link_color  			= $get_def_style_value[1];


// template settings default value check if admin changed

$get_def_t_style_value		= $get_style_value;
$default_t_style  			= $yjsg_get_styles;
$def_t_link_color  			= $default_link_color;

if($def_link_color !=$def_t_link_color){
	$def_link_color = $def_t_link_color;
}
//*
if ( isset($_GET['change_css']) && !empty($_GET['change_css']) ) {
	
	
        // check if style is valid
        if( in_array( $_GET['change_css'], $mystyles_out['yjsg_styles'] ) ){

                $_SESSION['frontend_css'] = $_GET['change_css'];
                $_SESSION['frontend_changed_css'] = true;
                $valid_styles = $_GET['change_css'];
				
				$get_key  = array_keys($mystyles_out['yjsg_styles'], $_GET['change_css']);
				$valid_color = $mystyles_out['yjsg_links'][$get_key[0]];

        }else {
                // else set to default style
                $valid_styles	= $default_t_style;
				$valid_color 	= $def_t_link_color;
        }

} else {
        // second case, checkes for admin changes or front-end changes

        if ( isset($_SESSION['frontend_changed_css']) && in_array( $_SESSION['frontend_css'], $mystyles_out['yjsg_styles'] ) ){

                $valid_styles 	= $_SESSION['frontend_css'];
				$get_key  		= array_keys($mystyles_out['yjsg_styles'], $_SESSION['frontend_css']);
				$valid_color 	= $mystyles_out['yjsg_links'][$get_key[0]];

        }else if( isset( $_SESSION['admin_change'] ) ){
                $valid_styles 	= $default_t_style;
				$valid_color 	= $def_t_link_color;
        }else {
                $valid_styles 	= $default_t_style;
				$valid_color 	= $def_t_link_color;
        }
}
$css_file = in_array( $valid_styles, $mystyles_out['yjsg_styles'] ) ? $valid_styles : $default_style;
$this->params->set('css_file',$css_file);
$style_color = '#'.$valid_color;

// MENU
$mymenu = array(

        1, 2, 3, 4, 5, 6
);
$default_menu = $this->params->get('default_menu_style',"2");

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
        // second case, check for admin changes or front-end changes

        if ( isset($_SESSION['frontend_changed_menu']) && in_array( $_SESSION['frontend_menu'], $mymenu ) ){

                $valid_menu = $_SESSION['frontend_menu'];

        }else if( isset( $_SESSION['admin_change'] ) ){

                $valid_menu = $this->params->get("default_menu_style","2");

        }else {
                $valid_menu = $default_menu;
        }
}
//*/
$default_menu_style = in_array( $valid_menu, $mymenu ) ? $valid_menu : $default_menu;

// LAYOUT
$mylayouts = array(
        1, 2, 3
);





$default_layout = $this->params->get("site_layout".$clonedPageId,"2");

//*
if ( isset($_GET['change_layout']) && !empty($_GET['change_layout']) ) {
        // check if style is valid
        if( in_array( $_GET['change_layout'], $mylayouts ) ){

                $_SESSION['frontend_layout'] = $_GET['change_layout'];
                $_SESSION['frontend_changed_layout'] = true;
                $valid_layout = $_GET['change_layout'];

        }else {
                // else set to default style
                $valid_layout = $default_layout;
        }

} else {
        // second case, checkes for admin changes or front-end changes

        if ( isset($_SESSION['frontend_changed_layout']) && in_array( $_SESSION['frontend_layout'], $mylayouts ) ){

                $valid_layout = $_SESSION['frontend_layout'];

        }else if( isset( $_SESSION['admin_change'] ) ){

                $valid_layout = $this->params->get("site_layout".$clonedPageId,"2");

        }else {
                $valid_layout = $default_layout;
        }
}
//*/
$site_layout = in_array( $valid_layout, $mylayouts ) ? $valid_layout : $default_layout;

// DIRECTION
$mydirection = array(
        1, 2
);
$default_direction = $this->params->get('text_direction',"2");
global $text_direction;
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

                $valid_direction = $this->params->get("text_direction","2");

        }else {
                $valid_direction = $default_direction;
        }
}
//*/
$text_direction = in_array( $valid_direction, $mydirection ) ? $valid_direction : $default_direction;
?>