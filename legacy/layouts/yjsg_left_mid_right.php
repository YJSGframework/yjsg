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
<?php if ($midblock_off == false ) { ?>
<!--MAIN LAYOUT HOLDER -->
<div id="holder" class="holders">
	<!-- messages -->
	<div class="yjsg-system-msg">
		<jdoc:include type="message" />
	</div>
	<!-- end messages -->
	<?php if ($this->countModules('left')) { ?>
	<!-- left block -->
	<div id="leftblock" class="sidebars">
		<div class="inside">
			<jdoc:include type="modules" name="left" style="<?php echo $leftcolumn_cc ?>" />
		</div>
	</div>
	<!-- end left block -->
	<?php } ?>
	<?php if(!$midblock_iszero) {?>
	<!-- MID BLOCK -->
	<div id="midblock" class="sidebars sidebar-main">
		<div class="insidem">
			<?php yjsg_print_grid_area('yjsgbodytop'); ?>
			<?php if($turn_component_off == 2 || $itemid == 0 ) {?>
			<!-- component -->
			<jdoc:include type="component"  />
			<!-- end component -->
			<?php } ?>
			<?php yjsg_print_grid_area('yjsgbodybottom'); ?>
		</div>
		<!-- end mid block insidem class -->
	</div>
	<!-- end mid block div -->
	<?php } ?>
	<?php if ($this->countModules('inset')) { ?>
	<!-- inset block -->
	<div id="insetblock" class="sidebars">
		<div class="inside">
			<jdoc:include type="modules" name="inset" style="<?php echo $insetcolumn_cc ?>" />
		</div>
	</div>
	<!-- end inset block -->
	<?php } ?>
	<?php if ($this->countModules('right')) { ?>
	<!-- right block -->
	<div id="rightblock" class="sidebars">
		<div class="inside">
			<jdoc:include type="modules" name="right" style="<?php echo $rightcolumn_cc ?>" />
		</div>
	</div>
	<!-- end right block -->
	<?php } ?>
</div>
<!-- end holder div -->
<?php } ?>