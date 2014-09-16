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
$class = $item->anchor_css ? 'class="'.$item->anchor_css.'" ' : '';
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
$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

switch ($item->browserNav) :
	default:
	case 0:
?><a <?php echo $aproperties; ?>href="<?php echo $flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $bcaret; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $aproperties; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $bcaret; ?></a><?php
		break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $aproperties; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?><?php echo $bcaret; ?></a><?php
		break;
endswitch;
