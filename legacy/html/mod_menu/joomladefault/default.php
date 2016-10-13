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
	$ulid = '';
	if ($params->get('tag_id')!=NULL) {
		$tag = $params->get('tag_id').'';
		$ulid=' id="'.$tag.'"';
	}
?>
<ul<?php echo $ulid?> class="menu<?php echo $class_sfx;?> defaultmenu<?php echo $menuclass.$class_sfx;?>">
<?php
$list_keys 	= array_keys($list);
$last_key 	= end($list_keys);
foreach ($list as $i => &$item) :
       $ais_active		 = '';
	   $lifirst		     = '';
	   $lilast			 = '';
	   $liafirst	     = '';
	   $lialast			 = '';
	   $firstli			 = false;
	   $lastli			 = false;
	   $activea			 = false;
	   
	   if($i == 0){
		  $lifirst		 = ' lifirst ';
		  $liafirst		 = 'afirst';
		  $firstli		 = true;
		}
	  
	  if ($i == $last_key) {
		   $lilast		 = ' lilast';
		   $lialast		 = 'alast';
		   $lastli		 = true;
	  }
	  
	  
	$class = '';
	if ($item->id == $active_id) {
		$class .= ' current-side ';
		$ais_active =' isactivea';
		$activea	= true;
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
		$class .= ' parent';
	}

	echo '<li class="item-'.$item->id.$lifirst.$class.$lilast.'">';

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
		echo '<ul class="defaultmenu-dropdown" id="modid'.$module->id.'-menu'.$item->id.'">';
	}
	// The next item is shallower.
	else if ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>