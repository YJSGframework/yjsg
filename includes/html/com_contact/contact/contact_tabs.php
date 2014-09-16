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
<!-- Tab navs -->
<ul class="nav nav-tabs yjsgbootstrap3">
  <li class="active"><a href="#basic-details" data-toggle="tab"><?php echo JText::_('COM_CONTACT_DETAILS', true) ?></a></li>
  <?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
  <li><a href="#display-form" data-toggle="tab"><?php echo JText::_('COM_CONTACT_EMAIL_FORM', true) ?></a></li>
  <?php endif; ?>
  <?php if ($this->params->get('show_links')) : ?>
  <li><a href="#display-links" data-toggle="tab"><?php echo JText::_('COM_CONTACT_LINKS', true) ?></a></li>
  <?php endif; ?>
  <?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
  <li><a href="#display-articles" data-toggle="tab"><?php echo JText::_('JGLOBAL_ARTICLES', true) ?></a></li>
  <?php endif; ?>
  <?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
  <li><a href="#display-profile" data-toggle="tab"><?php echo JText::_('COM_CONTACT_PROFILE', true) ?></a></li>
   <?php endif; ?>
   <?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
   <li><a href="#display-misc" data-toggle="tab"><?php echo JText::_('COM_CONTACT_PROFILE', true) ?></a></li>
   <?php endif; ?>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="basic-details">
	<?php  echo '<h3>'. JText::_('COM_CONTACT_DETAILS').'</h3>';  ?>
	<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
		<div class="thumbnail pull-right">
			<?php echo JHTML::_('image',$this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS')); ?>
		</div>
	<?php endif; ?>
	<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
		<p class="contact-position"><?php echo $this->contact->con_position; ?></p>
	<?php endif; ?>
	
	<?php echo $this->loadTemplate('address'); ?>
	
	<?php if ($this->params->get('allow_vcard')) :	?>
		<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
			<a href="<?php echo JURI::base(); ?>index.php?option=com_contact&amp;view=contact&amp;id=<?php echo $this->contact->id; ?>&amp;format=vcf">
				<?php echo JText::_('COM_CONTACT_VCARD');?></a>
	<?php endif; ?>
	</div>
	
	<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<div class="tab-pane" id="display-form">
		<?php  echo '<h3>'. JText::_('COM_CONTACT_EMAIL_FORM').'</h3>';  ?>
		<?php  echo $this->loadTemplate('form');  ?>
		</div>
	<?php endif; ?>
	

	<?php if ($this->params->get('show_links')) : ?>
		 <div class="tab-pane" id="display-links">
		<?php echo '<h3>'.JText::_('COM_CONTACT_LINKS').'</h3>'; ?>
		<?php echo $this->loadTemplate('links'); ?>
		</div>
	<?php endif; ?>


	<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<div class="tab-pane" id="display-articles">
		<?php echo '<h3>'. JText::_('JGLOBAL_ARTICLES').'</h3>'; ?>
		<?php echo $this->loadTemplate('articles'); ?>
		</div>
	<?php endif; ?>
	
	<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		 <div class="tab-pane" id="display-profile">
		<?php echo '<h3>'. JText::_('COM_CONTACT_PROFILE').'</h3>'; ?>
		<?php echo $this->loadTemplate('profile'); ?>
		</div>
	<?php endif; ?>
	
	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
		<div class="tab-pane" id="display-misc">
			<?php echo '<h3>'. JText::_('COM_CONTACT_OTHER_INFORMATION').'</h3>'; ?>
			<div class="contact-miscinfo">
				<div class="<?php echo $this->params->get('marker_class'); ?>">
					<?php echo $this->params->get('marker_misc'); ?>
				</div>
				<div class="contact-misc">
					<?php echo $this->contact->misc; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<br /><br />
</div>