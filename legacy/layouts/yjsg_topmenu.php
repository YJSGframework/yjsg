<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
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