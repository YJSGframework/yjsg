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
?>
<div class="yjsgtoolbar">
	<div class="btn-group">
		<button id="toolbar-apply" type="button" class="btn btn-default btn-sm"><?php echo JText::_('YJSG_SAVE') ?></button>
		<button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown">
		<span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu">
			<li>
				<a id="toolbar-save" href="#">
					<?php echo JText::_('YJSG_SAVE_AND_CLOSE') ?>
				</a>
			</li>
			<li>
				<a id="toolbar-save-copy" href="#">
					<?php echo JText::_('YJSG_SAVE_AS_COPY') ?>
				</a>
			</li>
		</ul>
	</div>
	<button id="toolbar-reset" class="btn btn-default btn-sm"><i class="adminicons-reset"></i>
	<?php echo JText::_('YJSG_RESET_TO_DEFAULT') ?></button>
	<button id="toolbar-cache" type="button" class="btn btn-default btn-sm"><i class="adminicons-cachesave"></i>
	<?php echo JText::_('YJSG_CLEAR_CACHE_AND_SAVE') ?></button>
	<a class="btn btn-default btn-sm" href="http://www.yjsimplegrid.com/documentation" target="_blank">
		<i class="adminicons-docs"></i> <?php echo JText::_('YJSG_DOCS') ?>
	</a>
	<a class="viewsite btn btn-default btn-sm" href="<?php echo JURI::root() ?>" target="_blank">
		<i class="adminicons-preview"></i> <?php echo JText::_('YJSG_VIEW_SITE') ?>
	</a>
	<button id="closebtn" class="btn btn-default btn-sm">
	<i class="adminicons-close"></i> <?php echo JText::_('YJSG_CLOSE') ?></button>
	<button  data-toggle="modal" data-target="#Modal_jhelp_image" class="btn btn-default btn-sm">
	<i class="adminicons-help"></i> <?php echo JText::_('YJSG_HELP') ?></button>
</div>
<!-- help modal -->
<div class="modal fade " id="Modal_jhelp_image" tabindex="-1" role="dialog" aria-labelledby="Modal_jhelp_image" aria-hidden="true" data-iframesrc="http://help.joomla.org/proxy/index.php?option=com_help&amp;keyref=Help32:Extensions_Template_Manager_Styles_Edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h5 class="modal-title"><?php echo JText::_('YJSG_TMPL_MNG_HELP') ?></h5>
				</div>
				<div class="modal-body">
				<h3><?php echo JText::_('YJSG_HI_THERE') ?></h3>
					<p><?php echo JText::_('YJSG_MORE_ABOUT_YJSG') ?></p>
					<button id="starttour" data-yjsgtour="" type="button" class="btn btn-primary" data-dismiss="modal"><?php echo JText::_('YJSG_START_TOUR') ?></button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo JText::_('YJSG_CANCEL') ?></button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
<!-- /.modal -->