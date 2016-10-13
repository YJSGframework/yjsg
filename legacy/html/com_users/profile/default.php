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
Yjsg::yjsgtooltip();
?>
<div class="userpageswrap user <?php echo $this->pageclass_sfx?>">
	<div class="userpages <?php echo $this->pageclass_sfx?>">
		<?php if ($this->params->get('show_page_heading')) : ?>
		<h1 class="pagetitle">
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
		<?php endif; ?>
		<?php echo $this->loadTemplate('core'); ?>
		<?php echo $this->loadTemplate('params'); ?>
		<?php echo $this->loadTemplate('custom'); ?>
		<?php if (JFactory::getUser()->id == $this->data->id) : ?>
		<a class="btn btn-small btn-sm button" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>">
			<span class="icon-user"></span>
			<?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
		</a>
		<?php endif; ?>
	</div>
</div>
