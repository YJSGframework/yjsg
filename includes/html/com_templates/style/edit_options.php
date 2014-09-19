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

$yjsg 				= Yjsg::getInstance();
$app				= JFactory::getApplication();
$firsttab 			= true;
$yjsglayoutarray 	= json_decode(YJSGLAYOUT);
$fieldSets 			= $this->form->getFieldsets('params');
$templateId 		= $app->input->get( 'id' );
$YjsgDbParams		= json_decode( $yjsg->getDbParams( $templateId ), true );
$topmenuLocation	= 0;


if( isset ($YjsgDbParams['top_menu_location'])){
	$topmenuLocation	= $YjsgDbParams['top_menu_location'];
}


foreach ($fieldSets as $name => $fieldSet){ 

		$isactivetab =' fade';
		if ( $firsttab ){
			$isactivetab =' fade in active';
			$firsttab = false;
		}
		
		if($name =='YJSG_LAYOUT_LABEL' || $name =='YJSG_DEF_GRID_LABEL' || $name =='YJSG_LOGO_LABEL'){
			
			include 'edit_option_layout.php';
			
		}else{
			
			include 'edit_options_default.php';
		}

}	