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
defined( '_JEXEC' ) or die( 'Restricted index access' );
if ($this->countModules('breadcrumb')) { ?>
<!-- pathway -->
<div id="pathway"<?php if($text_direction == 1){ ?>class="yjsgrtl"<?php } ?>>
<div class="yjsgspathway">
  <jdoc:include type="modules" name="breadcrumb" />
  </div>
</div>
<!-- end pathway -->
<?php } ?>