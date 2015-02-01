<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );?>
<?php if ($ie6notice == 1 && ($yjsgBrowser->Name =='msie' && ($yjsgBrowser->Version == '6.0' || $yjsgBrowser->Version == '7.0'))){?>
<div id="ie6Warning">
	<h1><?php echo JText::_( 'YJSG_IE_NOTICE_MSG' ); ?></h1>
	<div class="browsers">
		<a href="http://www.getfirefox.net/" target="_blank" id="fox">
			<?php echo JText::_( 'YJSG_UPGRADE_GET' ); ?> Firefox
		</a>
		<a href="http://www.google.com/chrome/index.html?hl=en&amp;brand=CHMA&amp;utm_campaign=en&amp;utm_source=en-ha-row-bk&amp;utm_medium=ha" target="_blank" id="chrome">
			<?php echo JText::_( 'YJSG_UPGRADE_GET' ); ?> Chrome
		</a>
		<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx" target="_blank" id="ie8">
			<?php echo JText::_( 'YJSG_UPGRADE_GET' ); ?> IE8
		</a>
		<a href="http://www.apple.com/safari/download/" target="_blank" id="safari">
			<?php echo JText::_( 'YJSG_UPGRADE_GET' ); ?> Safari
		</a>
		<a href="http://www.opera.com/download/" target="_blank" id="opera">
			<?php echo JText::_( 'YJSG_UPGRADE_GET' ); ?> Opera
		</a>
	</div>
	<h4><?php echo JText::_( 'YJSG_UPGRADE_BROWSER_MSG' ); ?></h4>
	<a href="#" id="closeIe6Alert">
		<?php echo JText::_( 'YJSG_UPGRADE_CLOSE' ); ?>
	</a>
</div>
<?php } ?>
<?php if($nonscript == 1 ){?>
<!-- noscript notice -->
<noscript>
<p class="nonscript" style="text-align:center" >
	<?php echo JText::_( 'YJSG_NONCSCRIPT_MSG' ); ?>
</p>
</noscript>
<!-- end noscript notice -->
<?php } ?>