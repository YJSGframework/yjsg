<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
if ($this->countModules('breadcrumb')) { ?>
<!-- pathway -->
<div id="pathway" class="inside-container<?php if($text_direction == 1){ ?> yjsgrtl<?php } ?>">
<div class="yjsgspathway">
  <jdoc:include type="modules" name="breadcrumb" />
  </div>
</div>
<!-- end pathway -->
<?php } ?>