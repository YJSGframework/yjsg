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
# FOR Youjoomla.com BRANDING REMOVAL VISIT THIS PAGE 
# http://www.youjoomla.com/can-i-remove-visible-branding-from-your-templates-or-extensions.html
defined('_JEXEC') or die;
?>
<?php
function getYJLINKS($default_font_family,$yj_copyrightear,$yj_templatename,$show_tools,$show_fres,$show_rtlc,$validators_off,$totop_off){
	
	$allLinks = array();

	if((function_exists('toolbox_urls') && $show_tools == 1) || $validators_off == 1 || $totop_off == 1){
		echo '<div class="validators">';
		if($validators_off == 1){
			$allLinks[] ='<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" target="_blank" title="CSS Validity">CSS Valid</a>';
			$allLinks[] ='<a href="http://validator.w3.org/check/referer" target="_blank" title="XHTML Validity">XHTML Valid</a>';
		}
		if($totop_off == 1){
			$allLinks[] ='<a class="yjscroll" href="#stylef'.$default_font_family.'">Top</a>';
		}
		if (function_exists('toolbox_urls') && $show_tools == 1):
		global $font_size;
		global $font_direction;
			if ($show_fres == 1):
				$allLinks[] = '<a id="fontSizePlus" class="fs" href="javascript:;" rel="nofollow">+</a>';
				$allLinks[] = '<a id="fontSizeMinus"  class="fs" href="javascript:;" rel="nofollow">-</a>';
				$allLinks[] = '<a id="fontSizeReset"  class="fs" href="javascript:;" rel="nofollow">reset</a>';
			endif;
			if ($show_rtlc == 1):
				$allLinks[] = '<a class="tdir" href="'.$font_direction[1].'" rel="nofollow">RTL</a>';
				$allLinks[] = '<a class="tdir" href="'.$font_direction[2].'" rel="nofollow">LTR</a>';
			endif;
		endif;
		echo implode(' | ',$allLinks);
		echo '</div>';
	}
	echo'<div class="yjsgcp">Copyright &copy; <span>'.$yj_templatename.'</span> '.$yj_copyrightear.' All rights reserved. <a href="http://www.youjoomla.com" title="Joomla Templates Club">Custom Design by Youjoomla.com </a></div>';
}
?>