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
?>

<ul class="yjsg-bsmenu<?php echo $menuclass.$class_sfx; ?>"<?php
	$tag = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		echo ' id="'.$tag.'"';
	}
?>>
<?php
foreach ($list as $i => &$item) :
     $aproperties ='';
	 $bcaret ='';
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		//$class .= ' current';
	}

	if (in_array($item->id, $path)) {
		$class .= ' active ';
	}
	elseif ($item->type == 'alias') {
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active ';
		}
		elseif (in_array($aliasToId, $path)) {
			$class .= ' active alias-parent-active ';
		}
	}

	if ($item->deeper) {
		//$class .= ' dropdown';
		
	}


	if ($item->parent) {
		
		 if($item->level == 1){
			$bcaret ='<b class="caret"></b>';
			$aproperties ='data-toggle="dropdown" class="dropdown-toggle" role="button" data-target="#" ';
		 }
		 
		if($item->parent && $item->level == 2){
			$class .= ' dropdown-submenu';
			
		}else{
			$class .= ' dropdown';
		}
		
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require ('default_'.$item->type.'.php');
			break;

		default:
			require ('default_url.php');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul class="dropdown-menu" id="modid'.$module->id.'-menu'.$item->id.'">';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>
