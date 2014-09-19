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
defined( '_JEXEC' ) or die( 'Restricted index access' );?>
<?php if ($midblock_off == false ) { ?>
<!--MAIN LAYOUT HOLDER -->
<div id="holder3" class="holders">
	<!-- messages -->
	<div class="yjsg-system-msg">
		<jdoc:include type="message" />
	</div>
	<!-- end messages -->
	<!-- MID BLOCK -->
	<?php if(!$midblock_iszero) {?>
	<div id="midblock" class="sidebars sidebar-main">
		<div class="insidem">
			<?php yjsg_print_grid_area('yjsgbodytop'); ?>
			<?php if($turn_component_off == 2 || $itemid == 0 ) {?>
			<!-- component -->
			<jdoc:include type="component"  />
			<!-- end component -->
			<?php } ?>
			<?php yjsg_print_grid_area('yjsgbodybottom'); ?>
			<div class="clearm"></div>
		</div>
		<!-- end mid block insidem class -->
	</div>
	<!-- end mid block div -->
	<?php } ?>
	<?php if ($this->countModules('insettop')) { ?>
	<?php if ($this->countModules('inset') || $this->countModules('left') || $this->countModules('right')) { ?>
	<div id="insetsholder_3t" class="sidebars sidebar-top">
		<div class="inside">
			<?php yjsg_load_custom_chrome('insettop',$insettop_cc,$paramsArray) ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
	<?php if ($this->countModules('left')) { ?>
	<!-- left block -->
	<div id="leftblock" class="sidebars">
		<div class="inside">
			<jdoc:include type="modules" name="left" style="<?php echo $leftcolumn_cc ?>" />
		</div>
	</div>
	<!-- end left block -->
	<?php } ?>
	<!-- END MID BLOCK -->
	<?php if ($this->countModules('right')) { ?>
	<!-- right block -->
	<div id="rightblock" class="sidebars">
		<div class="inside">
			<jdoc:include type="modules" name="right" style="<?php echo $rightcolumn_cc ?>" />
		</div>
	</div>
	<!-- end right block -->
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
	<?php if ($this->countModules('insetbottom')) { ?>
	<?php if ($this->countModules('inset') || $this->countModules('left') || $this->countModules('right')) { ?>
	<div id="insetsholder_3b" class="sidebars sidebar-bottom">
		<div class="inside">
			<?php yjsg_load_custom_chrome('insetbottom',$insetbottom_cc,$paramsArray) ?>
		</div>
	</div>
	<?php } ?>
	<?php } ?>
</div>
<!-- end holder div -->
<?php } ?>