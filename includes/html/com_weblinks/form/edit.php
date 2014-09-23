<?php
/**
 * @version		$Id: edit.php 21321 2011-05-11 01:05:59Z dextercowley $
 * @package		Joomla.Site
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
Yjsg::yjsgtooltip();
JHtml::_('behavior.formvalidation');

$this->form->loadFile( dirname(__FILE__) . YJDS . "weblink.xml");
// Create shortcut to parameters.
$params = $this->state->get('params');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task) {
		if (task == 'weblink.cancel' || document.formvalidator.isValid(document.id('adminForm'))) {
			<?php echo $this->form->getField('description')->save(); ?>
			Joomla.submitform(task);
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>

<div class="edit<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->def('show_page_heading', 1)) : ?>
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
	<form action="<?php echo JRoute::_('index.php?option=com_weblinks&view=form&w_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="yjsg-form form-validate yjsg-edit-form">
		<fieldset class="form-fieldset">
			<legend><?php echo JText::_('COM_WEBLINKS_LINK'); ?></legend>
			<div class="yjsg-form-group-inline">
				<button type="button" class="yjsg-button-blue" onclick="Joomla.submitbutton('weblink.save')">
				<i class="fa fa-check"></i>
				<?php echo JText::_('JSAVE') ?>
				</button>
				<button type="button" class="yjsg-button" onclick="Joomla.submitbutton('weblink.cancel')">
				<i class="fa fa-close"></i>
				<?php echo JText::_('JCANCEL') ?>
				</button>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('title'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('title'); ?>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('alias'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('alias'); ?>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('catid'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('catid'); ?>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('url'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('url'); ?>
				</div>
			</div>
			<?php if ($this->user->authorise('core.edit.state', 'com_weblinks.weblink')): ?>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('state'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('state'); ?>
				</div>
			</div>
			<?php endif; ?>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('language'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('language'); ?>
				</div>
			</div>
			<div>
				<?php echo $this->form->getLabel('description'); ?>
				<?php echo $this->form->getInput('description'); ?>
			</div>
		</fieldset>
		<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_( 'form.token' ); ?>
	</form>
</div>