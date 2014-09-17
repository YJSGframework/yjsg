<?php
/**
 * @version		$Id: edit.php 20206 2011-01-09 17:11:35Z chdemko $
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
//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load( 'plg_user_profile', JPATH_ADMINISTRATOR );
$this->form->loadFile( dirname(__FILE__) . DIRECTORY_SEPARATOR . "profile.xml");
?>

<div class="yjsg-userpages useredit <?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="pagetitle"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>
	<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" class="yjsg-form form-validate" enctype="multipart/form-data">
		<?php foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
		<?php $fields = $this->form->getFieldset($group);?>
		<?php if (count($fields)):?>
		<fieldset class="yjsg-form-fieldset">
			<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
			<legend><?php echo JText::_($fieldset->label); ?></legend>
			<?php endif;?>
			<?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
			<?php if ($field->hidden):// If the field is hidden, just display the input.?>
			<div class="yjsg-form-group">
				<div class="yjsg-element-holder">
					<?php echo $field->input;?>
				</div>
			</div>
			<?php else:?>
			<div class="yjsg-form-group">
				<?php echo $field->label; ?>
				<?php if (!$field->required && $field->type != 'Spacer'): ?>
				<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
				<?php endif; ?>
				<div class="yjsg-element-holder">
					<?php echo $field->input; ?>
				</div>
			</div>
			<?php endif;?>
			<?php endforeach;?>
		</fieldset>
		<?php endif;?>
		<?php endforeach;?>
		<div class="yjsg-form-group-inline">
			<div class="yjsg-element-holder">
				<button type="submit" class="button validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
			</div>
			<div class="yjsg-element-holder">
				<a class="button" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
					<?php echo JText::_('JCANCEL'); ?>
				</a>
			</div>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
