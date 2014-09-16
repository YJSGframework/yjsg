<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$title = $item->anchor_title ? 'title="'.$item->anchor_title.'" ' : '';
if ($item->menu_image) {
		$item->params->get('menu_text', 1 ) ?
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" /><span class="image-title">'.$item->title.'</span> ' :
		$linktype = '<img src="'.$item->menu_image.'" alt="'.$item->title.'" />';
}
else { 
	
		// fa icons
		$yj_menu_icon_prefix		= $item->params->get('yj_menu_icon_prefix','');
		$yj_menu_icon_suffix		= $item->params->get('yj_menu_icon_suffix','');
		$show_menu_icon_prefix ='';
		$show_menu_icon_suffix ='';
		if(!empty($yj_menu_icon_prefix)){
			
			$show_menu_icon_prefix			= '<i class="'.$yj_menu_icon_prefix.'"></i> ';
			
		}
		if(!empty($yj_menu_icon_suffix)){
			
			$show_menu_icon_suffix			= ' <i class="'.$yj_menu_icon_suffix.'"></i>';
			
		}
		$linktype							= $show_menu_icon_prefix.$item->title.$show_menu_icon_suffix;
	
}

?><span class="separator"><?php echo $title; ?><?php echo $linktype; ?></span>
