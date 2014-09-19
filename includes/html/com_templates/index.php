<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// No direct access.
defined('_JEXEC') or die;
	$yjsgDoc = YjsgDochead::getDocument();
	$yjsgDoc->addPageTitle($this->title);
	$yjsgDoc->addLinks(YJSGSITE_PLG_PATH . 'assets/images/favicon.ico','shortcut icon','image/vnd.microsoft.icon');
?>
<!DOCTYPE html>
<html xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<?php $yjsgDoc->printHead(); ?>
</head>
<body>
	<div id="yjsgsidebarback"></div>
	<div class="yjsgadmin">	
		<jdoc:include type="component" />
	</div>
	<div class="msg-alert alert alert-info">
    </div>
	<script src="<?php echo YJSGSITE_PLG_PATH ?>assets/src/bootstrap-tour.js" type="text/javascript" ></script>
	<script src="<?php echo YJSGSITE_PLG_PATH ?>admin/src/yjsg.tour.js" type="text/javascript" ></script>
</body>
</html>