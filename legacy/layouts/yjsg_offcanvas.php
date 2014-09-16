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
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class="yjsg-offc-btn site-offc" data-yjsg-canvas="#yjsg-off-canvas" data-width="<?php echo str_replace('px','',$offCanvasWidth) ?>"><i class="fa fa-bars"></i></div>
<div id="yjsg-off-canvas" class="yjsg-off_canvas">
	<div class="yjsg-off_canvas_in">
		<div class="closeCanvas"><i class="fa fa-times"></i></div>
		<jdoc:include type="modules" name="offcanvas" style="Yjsgxhtml" />
	</div>
</div>