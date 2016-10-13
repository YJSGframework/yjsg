<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );?>
<?php if ($midblock_off == false ) { ?>
<!--MAIN LAYOUT HOLDER -->
<div id="holder2" class="holders">
	<!-- messages -->
	<div class="yjsg-system-msg inside-container">
		<jdoc:include type="message" />
	</div>
	<!-- end messages -->
	<?php if(!$midblock_iszero) {?>
	<!-- MID BLOCK -->
	<div id="midblock" class="sidebars sidebar-main">
			<?php yjsg_print_grid_area('yjsgbodytop'); ?>
			<?php if($turn_component_off == 2 || $itemid == 0 ) {?>
			<!-- component -->
			<div class="inside-container">
				<jdoc:include type="component"  />
			</div>
			<!-- end component -->
			<?php } ?>
			<?php yjsg_print_grid_area('yjsgbodybottom'); ?>
		<!-- end mid block insidem class -->
	</div>
	<!-- end mid block div -->
	<?php } ?>
	<?php if ($this->countModules('insettop')) { ?>
	<?php if ($this->countModules('inset') || $this->countModules('left') || $this->countModules('right')) { ?>
	<div id="insetsholder_2t" class="sidebars sidebar-top">
		<div class="inside-container">
			<?php yjsg_load_custom_chrome('insettop',$insettop_cc,$paramsArray) ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
	<?php if ($this->countModules('right')) { ?>
	<!-- right block -->
	<div id="rightblock" class="sidebars">
		<div class="inside-container">
			<jdoc:include type="modules" name="right" style="<?php echo $rightcolumn_cc ?>" />
		</div>
	</div>
	<!-- end right block -->
	<?php } ?>
	<?php if ($this->countModules('left')) { ?>
	<!-- left block -->
	<div id="leftblock" class="sidebars">
		<div class="inside-container">
			<jdoc:include type="modules" name="left" style="<?php echo $leftcolumn_cc ?>" />
		</div>
	</div>
	<!-- end left block -->
	<?php } ?>
	<?php if ($this->countModules('inset')) { ?>
	<!-- inset block -->
	<div id="insetblock" class="sidebars">
		<div class="inside-container">
			<jdoc:include type="modules" name="inset" style="<?php echo $insetcolumn_cc ?>" />
		</div>
	</div>
	<!-- end inset block -->
	<?php } ?>
	<?php if ($this->countModules('insetbottom')) { ?>
	<?php if ($this->countModules('inset') || $this->countModules('left') || $this->countModules('right')) { ?>
	<div id="insetsholder_2b" class="sidebars sidebar-bottom">
		<div class="inside-container">
			<?php yjsg_load_custom_chrome('insetbottom',$insetbottom_cc,$paramsArray) ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
</div>
<!-- end holder div -->
<?php } ?>