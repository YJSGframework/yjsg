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
require_once(YJSGPATH . "includes/html/mod_menu/yjsgmega/yjsg_helperclass.php");

// item params
$yj_group_holder       	= $item->params->get('yj_group_holder');
$yj_menu_holder_width  	= $item->params->get('yj_menu_holder_width');
$yj_menu_groups_count  	= $item->params->get('yj_menu_groups_count');
$yj_sub_group_width    	= $item->params->get('yj_sub_group_width');
$yj_group_id           	= $item->id;
$yj_group_left_poz     	= $item->params->get('yj_sub_group_width');
$yj_mod_id             	= $item->params->get('yj_mod_id');
$yj_position           	= $item->params->get('yj_position');
$yj_menu_show_title    	= $item->params->get('yj_menu_show_title');
$yj_menu_icon_prefix   	= $item->params->get('yj_menu_icon_prefix', '');
$yj_menu_icon_suffix   	= $item->params->get('yj_menu_icon_suffix', '');
$group_holder_class 	= '';
$group_num_items    	= '';
$group_holder_id    	= '';

// fa icons
$show_menu_icon_prefix 	= '';
$show_menu_icon_suffix 	= '';
if (!empty($yj_menu_icon_prefix)) {
	
	$show_menu_icon_prefix = '<i class="' . $yj_menu_icon_prefix . '"></i> ';
	
}
if (!empty($yj_menu_icon_suffix)) {
	
	$show_menu_icon_suffix = ' <i class="' . $yj_menu_icon_suffix . '"></i>';
	
}

$yj_menu_title = $show_menu_icon_prefix . $item->title . $show_menu_icon_suffix;
$yj_sub_title  = $item->params->get('yj_menu_sub_title');
$yj_item_type  = $item->params->get('yj_item_type');
    
    
    // icon only
    if ($item->params->get('menu_text') == '0' && $item->menu_image == '' && (!empty($yj_menu_icon_prefix) || !empty($show_menu_icon_suffix))) {
        
        $yj_menu_title = $show_menu_icon_prefix . $show_menu_icon_suffix;
        
    }
    
$item_link 				= '<span class="yjm_has_none"><span class="yjm_title">' . $yj_menu_title . '</span></span>';
$yj_module_link_title 	= '<span class="yjm_title">' . $yj_menu_title . '</span>';
$yj_module_details    	= '';
$yj_module_sub_title 	= '';
$yj_module_class 		= '';
$yj_module_image 		= '';	    
    
    // get parents
    $db = JFactory::getDBO();
    if ($item->parent_id > 0) {
        $parent_sql = 'SELECT params FROM #__menu WHERE id = ' . $item->parent_id . ' AND params !=""';
        $db->setQuery($parent_sql);
        $parent_details = $db->loadResult();
        $parent_params = new JRegistry();
        $parent_params->loadString($parent_details);
    } else {
        $parent_params = new JRegistry();
    }
    // parent params
    if ($item->parent_id > 0) {
        $yj_pgroup_holder         = $parent_params->get('yj_group_holder');
        $yj_psub_width            = $parent_params->get('yj_sub_group_width');
        $yj_pgroups_count         = $parent_params->get('yj_menu_groups_count');
        $yj_sub_group_width_array = explode("\n", $yj_psub_width);
    }
    // group style and  specific widths
    if ($yj_mega_menus && $yj_group_holder == '1' && $yj_menu_holder_width !== '' && $yj_menu_groups_count !== '0') {
        $group_holder_class = ' group_holder';
        $group_num_items    = ' count' . $yj_menu_groups_count . '';
        $group_holder_id    = ' group_' . $yj_group_id . '';
        
        if ($yj_mega_menus && $yj_menu_groups_count == '3' && $yj_sub_group_width == '') {
            $yj_menu_holder_width = $yj_menu_holder_width - 1;
        }
		
		$document->addStyleDeclaration('ul.yjsgmenu div.ulholder ul.group_'.$yj_group_id.'{width:'.$yj_menu_holder_width.'px}');
    }

   
	// title only
	if (empty($yj_sub_title) && empty($item->menu_image)) {
		$item_link = '<span class="yjm_has_none"><span class="yjm_title">' . $yj_menu_title . '</span></span>';
		// Description and title	
	} elseif (!empty($yj_sub_title) && empty($item->menu_image)) {
		$item_link = '<span class="yjm_has_desc"><span class="yjm_title">' . $yj_menu_title . '</span><span class="yjm_desc">' . $yj_sub_title . '</span></span>';
		// Image and title	
	} elseif (empty($yj_sub_title) && !empty($item->menu_image)) {
		$item_link = '<span class="yjm_has_image" style="background-image:url(' . JURI::base() . $item->menu_image . ');"><span class="yjm_title">' . $yj_menu_title . '</span></span>';
	} elseif (!empty($yj_sub_title) && !empty($item->menu_image)) {
		// Image title and description	
		$item_link = '<span class="yjm_has_all" style="background-image:url(' . JURI::base() . $item->menu_image . ');"><span class="yjm_title">' . $yj_menu_title . '</span><span class="yjm_desc">' . $yj_sub_title . '</span></span>';
	}
 
    //Image only no text
    if ($item->params->get('menu_text') == '0' && $item->menu_image != null) {
        $item_link = '<span class="no_text"><span class="yjm_title"><img src="' . $item->menu_image . '" alt="' . $item->title . '" class="imsolo_mega" /></span></span>';
    }
   
   //title image and sub for module type links
    if ($yj_sub_title !== '' && $yj_menu_show_title == 1) {
        $yj_module_sub_title = '<span class="yjm_desc">' . $yj_sub_title . '</span>';
    } 
	
	// 
    if (!empty($item->menu_image) && $yj_menu_show_title == 1) {
        $yj_module_class = '_img';
        $yj_module_image = ' style="background-image:url(' . JURI::base() . $item->menu_image . ');"';
    } 
	
    if ($yj_menu_show_title == 1) {
        $yj_module_link_title = '<span class="yjm_title">' . $yj_menu_title . '</span>';
        $yj_module_details    = '<span class="yjm_module_details' . $yj_module_class . '"' . $yj_module_image . '>' . $yj_module_link_title . $yj_module_sub_title . '</span>';
    }
	
    // module output
    if ($yj_item_type == 1 && $item->level > $allow_level && !empty($yj_mod_id)) {

        //check if we have multiple modules selected
        if (!is_array($yj_mod_id)) {
            $yj_mod_id = array(
                $yj_mod_id
            );
        }
        $item_link_array = array();
        foreach ($yj_mod_id as $yj_mod_id_value) {
            
            $query = 'SELECT module, title ' . ' FROM #__modules AS m' . ' WHERE 1 ' //m.published = 1
                . ' AND m.client_id = 0' . ' AND m.id = ' . (int) $yj_mod_id_value;
            $db->setQuery($query);
            $module_details = $db->loadObjectList();
            
            if ($module_details[0]->module == 'mod_custom') {
                $yj_module = YJModuleHelper::getModule('custom', $module_details[0]->title);
            } else {
                $yj_module = YJModuleHelper::getModule(strtolower(substr($module_details[0]->module, 4, strlen($module_details[0]->module))), $module_details[0]->title);
            }
            $yj_attribs['yj_style'] = 'YJsgxhtml';
            $yj_load_mod            = YJModuleHelper::renderModule($yj_module, $yj_attribs);
            $yj_load_mod_class      = ' has_module';
            $item_link_array[]      = '' . $yj_module_details . '<div class="yjm_module">' . $yj_load_mod . '</div>';
            if ($yj_mega_menus && isset($yj_pgroup_holder) && $yj_pgroup_holder == 1 && isset($yj_psub_width) && !empty($yj_psub_width)) {
                $subswidth          = trim($yj_sub_group_width_array[$child_rows[$item->parent_id][$item->id]]);
				$yj_load_mod_class	=' has_module holdsgroup';
                $addGroupTitleClass = ' holdsgroupTitle ';
                $addGroupClass      = ' ulgroup';
				
				$document->addStyleDeclaration('ul.yjsgmenu li.item'.$item->id.'.holdsgroup{width:'.$subswidth.'px}');
            }
        }
        
        $item_link = implode($item_link_array);
        
    } elseif ($yj_item_type == 2 && $item->level > $allow_level && !empty($yj_position)) {
        if (!is_array($yj_position)) {
            $yj_position = array(
                $yj_position
            );
        }
        $item_link_array = array();
        foreach ($yj_position as $yj_position_value) {
            $yj_modules             = YJModuleHelper::getModules($yj_position_value);
            $yj_attribs['yj_style'] = 'YJsgxhtml';
            foreach ($yj_modules as $yj_module) {
                $yj_load_mod       = YJModuleHelper::renderModule($yj_module, $yj_attribs);
                $yj_load_mod_class = ' has_modpoz';
                $item_link_array[] = '' . $yj_module_details . '<div class="yjm_module">' . $yj_load_mod . '</div>';
                if ($yj_mega_menus && isset($yj_pgroup_holder) && $yj_pgroup_holder == 1 && isset($yj_psub_width) && !empty($yj_psub_width)) {
                    $subswidth          = trim($yj_sub_group_width_array[$child_rows[$item->parent_id][$item->id]]);
					$yj_load_mod_class  = ' has_modpoz holdsgroup';
                    $addGroupTitleClass = ' holdsgroupTitle ';
                    $addGroupClass      = ' ulgroup';
					
					$document->addStyleDeclaration('ul.yjsgmenu li.item'.$item->id.'.holdsgroup{width:'.$subswidth.'px}');
                }
            }
        }
        $item_link = implode($item_link_array);
        
    } elseif ($yj_mega_menus && isset($yj_pgroup_holder) && $yj_pgroup_holder == 1 && isset($yj_psub_width) && !empty($yj_psub_width)) {
        $subswidth          = trim($yj_sub_group_width_array[$child_rows[$item->parent_id][$item->id]]);
		$yj_load_mod_class  = ' holdsgroup';
        $addGroupTitleClass = ' holdsgroupTitle ';
        $addGroupClass      = ' ulgroup';
		
		$document->addStyleDeclaration('ul.yjsgmenu li.item'.$item->id.'.holdsgroup{width:'.$subswidth.'px}');
		
		
    } else {
        $yj_load_mod_class  = '';
        $addGroupTitleClass = '';
        $addGroupClass      = ' nogroup';
    }