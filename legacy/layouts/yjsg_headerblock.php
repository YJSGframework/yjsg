<?php 
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
?>
<?php if ($turn_header_block_off == 2 ){ ?>
 <!--header-->
<div id="header">
  <?php if ($turn_logo_off == 2 ){ ?>
    <div id="logo">
     <?php if ($turn_seo_off == 1 ){ ?>
      <h1><a href="<?php echo $yj_base ?>" title="<?php echo $tags?>"><?php echo $seo ?></a> </h1>
     <?php }else{ ?>
      <a href="<?php echo $yj_base ?>"></a>
      <?php } ?>
    </div>
    <!-- end logo -->
   <?php } ?>
<?php 
if($topMenuLocation == 1){
	require_once YJSG_TOPMENU;
}else{
	yjsg_print_grid_area('yjsgheadergrid');
}
?>
</div>
  <!-- end header -->
<?php } ?>