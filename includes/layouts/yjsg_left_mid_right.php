<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
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
?>
<?php if ($midblock_off == false ) { ?>
<!--MAIN LAYOUT HOLDER -->
<div id="holder" class="holders">
	<!-- messages -->
	<div class="yjsg-system-msg inside-container">
		<jdoc:include type="message" />
	</div>
	<!-- end messages -->
	<?php if ($this->countModules('left')) { ?>
	<!-- left block -->
	<div id="leftblock" class="sidebars">
		<div class="inside-container">
			<jdoc:include type="modules" name="left" style="<?php echo $leftcolumn_cc ?>" />
		</div>
	</div>
	<!-- end left block -->
	<?php } ?>
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
		<!-- end mid block inside-container -->
	</div>
	<!-- end mid block div -->
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
	<?php if ($this->countModules('right')) { ?>
	<!-- right block -->
	<div id="rightblock" class="sidebars">
		<div class="inside-container">
			<jdoc:include type="modules" name="right" style="<?php echo $rightcolumn_cc ?>" />
		</div>
	</div>
	<!-- end right block -->
	<?php } ?>
</div>
<!-- end holder div -->
<?php } ?>