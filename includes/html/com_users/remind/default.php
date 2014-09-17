<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
Yjsg::yjsgtooltip();
JHtml::_('behavior.formvalidation');
$this->form->reset( true ); // to reset the form xml loaded by the view
$this->form->loadFile( dirname(__FILE__) . DIRECTORY_SEPARATOR . "remind.xml"); // to load in our own version of remind.xml
?>

<div class="yjsg-userpages remind">
	<?php if(JFactory::getApplication()->input->get( 'Itemid' ) !==''): ?>
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="pagetitle">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php else: ?>
	<h1 class="pagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>
	<?php else:?>
	<h1 class="pagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo JText::_('FORGOT_YOUR_USERNAME') ?>
	</h1>
	<?php endif ; ?>
	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=remind.remind'); ?>" method="post" class="yjsg-form form-validate">
		<?php foreach ($this->form->getFieldsets() as $fieldset): ?>
		<p>
			<?php echo JText::_($fieldset->label); ?>
		</p>
		<fieldset class="yjsg-form-fieldset">
			<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field): ?>
			<?php if (!$field->hidden): ?>
			<div class="yjsg-form-group">
				<?php echo $field->label; ?>
				<div class="yjsg-element-holder">
					<?php echo $field->input; ?>
				</div>
			</div>
			<?php endif; ?>
			<?php endforeach; ?>
		</fieldset>
		<?php endforeach; ?>
		<div class="yjsg-form-group">
			<div class="yjsg-element-holder">
				<button type="submit" class="button validate"><?php echo JText::_('JSUBMIT'); ?></button>
			</div>
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
