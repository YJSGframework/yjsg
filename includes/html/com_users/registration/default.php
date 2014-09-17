<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
Yjsg::yjsgtooltip();
JHtml::_('behavior.formvalidation');
$this->form->reset( true ); // to reset the form xml loaded by the view
$this->form->loadFile( dirname(__FILE__) . DIRECTORY_SEPARATOR . "registration.xml");

?>
<div class="yjsg-userpages register">
	<?php if(JFactory::getApplication()->input->get( 'Itemid' ) !==''): ?>
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="pagetitle">
		<?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php else: ?>
	<h1 class="pagetitle">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</h1>
	<?php endif; ?>
	<?php else:?>
	<h1 class="pagetitle<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php echo JText::_('Register') ?>
	</h1>
	<?php endif ; ?>
	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="yjsg-form form-validate">
		<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
		<?php $fields = $this->form->getFieldset($fieldset->name);?>
		<?php if (count($fields)):?>
		<fieldset class="yjsg-form-fieldset">
			<?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
			<?php if ($field->hidden):// If the field is hidden, just display the input.?>
			<?php echo $field->input;?>
			<?php else:?>
			<div class="yjsg-form-group">
				<?php echo $field->label; ?>
				<?php if (!$field->required && $field->type!='Spacer'): ?>
				<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
				<?php endif; ?>
				<div class="yjsg-element-holder">
					<?php echo $field->input;?>
				</div>
			</div>
			<?php endif;?>
			<?php endforeach;?>
		</fieldset>
		<?php endif;?>
		<?php endforeach;?>
		<div class="yjsg-form-group-inline">
			<div class="yjsg-element-holder">
				<button type="submit" class="button validate"><?php echo JText::_('JREGISTER');?></button>
			</div>
			<div class="yjsg-element-holder">
				<?php echo JText::_('COM_USERS_OR');?>
			</div>
			<div class="yjsg-element-holder">
				<a href="<?php echo JURI::base()?>" title="<?php echo JText::_('JCANCEL');?>">
					<?php echo JText::_('JCANCEL');?>
				</a>
			</div>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="registration.register" />
			<?php echo JHtml::_('form.token');?>
		</div>
	</form>
</div>
