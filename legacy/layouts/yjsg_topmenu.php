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
$setMenuWidth = '';
if($topMenuLocation == 0){
	$setMenuWidth = ' yjsgsitew';
}
?>
<?php if($topmenu_off == 2 || $itemid == 0 ) {?>
<!--top menu-->
<?php if($topMenuLocation == 0 ){ ?>
  <?php if($default_menu_style == 6) { ?>
   <div id="topmenu_holder" class="topmodpoz<?php echo $navbar_class ?>">
      <div class="top_menu_poz<?php echo $navbar_class.$setMenuWidth ?>">
          <jdoc:include type="modules" name="topmenupoz" style="raw" />
      </div>
   </div>
  <?php } else { ?>
  <div id="topmenu_holder" class="yjsgmega">
      <div class="top_menu<?php echo $setMenuWidth?>">
          <div id="horiznav" class="horiznav<?php if ($text_direction == 1) { ?> horiz_rtl<?php } ?>"><?php echo $topmenu; ?></div>
      </div>
  </div>
  <?php } ?>
<?php }elseif($topMenuLocation == 1){ ?>
<div id="yjsgheadergrid" class="yjsgheadergw">
  <?php if($default_menu_style == 6) { ?>
   <div id="topmenu_holder" class="topmodpoz<?php echo $navbar_class ?>">
      <div class="top_menu_poz<?php echo $navbar_class.$setMenuWidth ?>">
          <jdoc:include type="modules" name="topmenupoz" style="raw" />
      </div>
   </div>
  <?php } else { ?>
  <div id="topmenu_holder" class="yjsgmega">
      <div class="top_menu<?php echo $setMenuWidth ?>">
          <div id="horiznav" class="horiznav<?php if ($text_direction == 1) { ?> horiz_rtl<?php } ?>"><?php echo $topmenu; ?></div>
      </div>
  </div>
   <?php } ?>
</div>
<?php } ?>
<!-- end top menu -->
<?php } ?>