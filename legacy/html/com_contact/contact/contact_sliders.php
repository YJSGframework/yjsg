<?php
 /**
 * $Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	Contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div id="slide-contact" class="yjsgaccChrome">
	<div class="yjsgaccGroup">
		<div class="yjsgaccTrigger active">
			<a href="#basic-details">
				<strong><?php echo JText::_('COM_CONTACT_DETAILS', true) ?></strong>
			</a>
		</div>
		<div class="yjsgaccContent" id="basic-details">
			<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
			<div class="thumbnail pull-right">
				<?php echo JHTML::_('image',$this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS')); ?>
			</div>
			<?php endif; ?>
			<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
			<p class="contact-position">
				<?php echo $this->contact->con_position; ?>
			</p>
			<?php endif; ?>
			<?php echo $this->loadTemplate('address'); ?>
			<?php if ($this->params->get('allow_vcard')) :	?>
			<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
			<a href="<?php echo JURI::base(); ?>index.php?option=com_contact&amp;view=contact&amp;id=<?php echo $this->contact->id; ?>&amp;format=vcf">
				<?php echo JText::_('COM_CONTACT_VCARD');?>
			</a>
			<?php endif; ?>
		</div>
	</div>
	<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
	<div class="yjsgaccGroup">
		<div class="yjsgaccTrigger">
			<a href="#display-form">
				<strong><?php echo JText::_('COM_CONTACT_EMAIL_FORM', true) ?></strong>
			</a>
		</div>
		<div class="yjsgaccContent" id="display-form">
			<?php  echo $this->loadTemplate('form');  ?>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($this->params->get('show_links')) : ?>
	<div class="yjsgaccGroup">
		<div class="yjsgaccTrigger">
			<a href="#display-links">
				<strong><?php echo JText::_('COM_CONTACT_LINKS', true) ?></strong>
			</a>
		</div>
		<div class="yjsgaccContent" id="display-links">
			<?php echo $this->loadTemplate('links'); ?>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
	<div class="yjsgaccGroup">
		<div class="yjsgaccTrigger">
			<a href="#display-articles">
				<strong><?php echo JText::_('JGLOBAL_ARTICLES', true) ?></strong>
			</a>
		</div>
		<div class="yjsgaccContent" id="display-articles">
			<?php echo $this->loadTemplate('articles'); ?>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
	<div class="yjsgaccGroup">
		<div class="yjsgaccTrigger">
			<a href="#display-profile">
				<strong><?php echo JText::_('COM_CONTACT_PROFILE', true) ?></strong>
			</a>
		</div>
		<div class="yjsgaccContent" id="display-profile">
			<?php echo $this->loadTemplate('profile'); ?>
		</div>
	</div>
	<?php endif; ?>
	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
	<div class="yjsgaccGroup">
		<div class="yjsgaccTrigger">
			<a href="#display-misc">
				<strong><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION', true) ?></strong>
			</a>
		</div>
		<div class="yjsgaccContent" id="display-misc">
			<div class="contact-miscinfo">
				<div class="<?php echo $this->params->get('marker_class'); ?>">
					<?php echo $this->params->get('marker_misc'); ?>
				</div>
				<div class="contact-misc">
					<?php echo $this->contact->misc; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<br /><br />
</div>