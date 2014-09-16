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