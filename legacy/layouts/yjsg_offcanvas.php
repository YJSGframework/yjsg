<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<div class="yjsg-offc-btn site-offc" data-yjsg-canvas="#yjsg-off-canvas" data-width="<?php echo str_replace('px','',$offCanvasWidth) ?>"><i class="fa fa-bars"></i></div>
<div id="yjsg-off-canvas" class="yjsg-off_canvas">
	<div class="yjsg-off_canvas_in">
		<div class="closeCanvas"><i class="fa fa-times"></i></div>
		<jdoc:include type="modules" name="offcanvas" style="Yjsgxhtml" />
	</div>
</div>