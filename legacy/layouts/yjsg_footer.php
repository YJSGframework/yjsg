<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
if ($show_tools == 1):
	include YJSG_TOOLS;/* site tools , font resizer , rtl switch */
endif;
?>
<!-- footer -->
<div id="footer" class="yjsgsitew">
  <div id="youjoomla">
    <?php if ($this->countModules('footer')) { ?>
        <div id="footmod">
            <jdoc:include type="modules" name="footer" style="raw" />
        </div>
	<?php } ?>
    	<div id="cp">
		<?php echo getYJLINKS($default_font_family,$yj_copyrightyear,$yj_templatename,$show_tools,$show_fres,$show_rtlc,$validators_off,$totop_off)  ?>
			<?php if ($branding_off == 2) { ?>
                <a class="yjsglogo png" href="http://yjsimplegrid.com/" target="_blank">
					<span><?php echo JText::_( 'YJSG_FOOTER_YJSG_WEBSITE' ); ?></span>
                </a>
			<?php } ?>
       </div>
  </div>
</div>
<!-- end footer -->
	<?php if ($joomlacredit_off ==2): ?>
		<div id="joomlacredit" class="yjsgsitew">
			<?php echo JText::_( 'YJSG_FOOTER_JOOMLA_CREDITS' ); ?>
		</div>
	<?php endif; ?>
<?php echo $yjsg_js;// do not remove.these are site js vars ?>