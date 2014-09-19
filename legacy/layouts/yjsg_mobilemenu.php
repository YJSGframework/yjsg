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
// No direct access.
defined( '_JEXEC' ) or die( 'Restricted index access' );


$loadmenu          = $app->getMenu(); 
if($this->countModules('topmenupoz') && $default_menu_style == 6){
	$menu_name_is = $topmenupoz_name;
}else{
	$menu_name_is = $menu_name;
}
$renderer	 		= $document->loadRenderer( 'module' );
$options	 		= array( 'style' => "raw" );
$module	    	 	= JModuleHelper::getModule( 'mod_menu','$menu_name_is' );
$mobile_load     	= false; $subnav = false; $sidenav = false;			
$module->params		= "menutype=$menu_name_is\nshowAllChildren=1";
$mobile_load 		= $renderer->render( $module, $options );
$mobile_menu 	 	= $loadmenu->getItems('menutype',$menu_name_is, false);	

if( isset($loadmenu->getActive()->title)){
	$SetActiveTitle = $loadmenu->getActive()->title;
}else{
	$SetActiveTitle = $mobile_menu[0]->title;
}

?>
<div id="mmenu_holder">
  <span class="yjmm_select" id="yjmm_selectid"><?php echo $SetActiveTitle ?></span>
  <select id="mmenu" class="yjstyled">
      <?php foreach($mobile_menu as $key => $menuitem) : 
        if(count($menuitem->tree) == 1 || $menuitem->home == 1) {
            $addline ='&nbsp;';
        }else{
			$menu_tab = "";		
			for($i = 1; $i <= count($menuitem->tree); $i++){
				$menu_tab .= "-";
			}
            $addline ='&nbsp;'.$menu_tab;
        }
		
		if(isset($loadmenu->getActive()->id)){
			$SetActiveId = $loadmenu->getActive()->id;
		}else{
			$SetActiveId = $mobile_menu[0]->id;
		}
		
		
		if($menuitem->id == $SetActiveId){
			$selected = ' selected="selected"';
		}else{
			$selected ='';
		}
		
		$menuitem->flink = $menuitem->link;
		switch ($menuitem->type)
		{
			case 'separator' :
				continue;

			case 'url' :
				if ((strpos($menuitem->link, 'index.php?') === 0) && (strpos($menuitem->link, 'Itemid=') === false))
				{
					$menuitem->flink = $menuitem->link.'&Itemid='.$menuitem->id;
				}
				break;

			case 'alias' :
				$menuitem->flink = 'index.php?Itemid='.$menuitem->params->get('aliasoptions');
				break;

			default :
				$router = $app->getRouter();
				if ($router->getMode() == JROUTER_MODE_SEF)
				{
					$menuitem->flink = 'index.php?Itemid='.$menuitem->id;
				}
				else
				{
					$menuitem->flink .= '&Itemid='.$menuitem->id;
				}
				break;
		}

		if (strcasecmp(substr($menuitem->flink, 0, 4), 'http') && (strpos($menuitem->flink, 'index.php?') !== false))
		{
			$menuitem->flink = JRoute::_($menuitem->flink, true, $menuitem->params->get('secure'));
		}
		else
		{
			$menuitem->flink = JRoute::_($menuitem->flink);
		}
      ?>
      <option value="<?php echo JRoute::_($menuitem->flink)?>"<?php echo $selected ?>><?php echo $addline.$menuitem->title?></option>
      <?php endforeach ?>
  </select>
</div>