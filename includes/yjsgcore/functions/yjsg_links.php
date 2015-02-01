<?php 
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
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
			$allLinks[] ='<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" target="_blank" title="'.JText::_('YJSG_LINKS_VALIDCSS_TITLE').'">'.JText::_('YJSG_LINKS_VALIDCSS').'</a>';
			$allLinks[] ='<a href="http://validator.w3.org/check/referer" target="_blank" title="'.JText::_('YJSG_LINKS_VALIDHTML_TITLE').'">'.JText::_('YJSG_LINKS_VALIDHTML').'</a>';
		}
		if($totop_off == 1){
			$allLinks[] ='<a class="yjscroll" href="#stylef'.$default_font_family.'">'.JText::_('YJSG_LINKS_TOP').'</a>';
		}
		if (function_exists('toolbox_urls') && $show_tools == 1):
		global $font_size;
		global $font_direction;
			if ($show_fres == 1):
				$allLinks[] = '<a id="fontSizePlus" class="fs" href="javascript:;" rel="nofollow">'.JText::_('YJSG_LINKS_BIGGERTEXT').'</a>';
				$allLinks[] = '<a id="fontSizeMinus"  class="fs" href="javascript:;" rel="nofollow">'.JText::_('YJSG_LINKS_SMALLERTEXT').'</a>';
				$allLinks[] = '<a id="fontSizeReset"  class="fs" href="javascript:;" rel="nofollow">'.JText::_('YJSG_LINKS_RESET').'</a>';
			endif;
			if ($show_rtlc == 1):
				$allLinks[] = '<a class="tdir" href="'.$font_direction[1].'" rel="nofollow">'.JText::_('YJSG_LINKS_RTL').'</a>';
				$allLinks[] = '<a class="tdir" href="'.$font_direction[2].'" rel="nofollow">'.JText::_('YJSG_LINKS_LTR').'</a>';
			endif;
		endif;
		echo implode(' | ',$allLinks);
		echo '</div>';
	}
	
	echo '<div class="yjsgcp">'.JText::sprintf('YJSG_LINKS_YOUJOOMLA_CREDITS', $yj_templatename, $yj_copyrightear).'</div>';
}
?>