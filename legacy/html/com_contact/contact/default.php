<?php
 /**
 * $Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	Contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$cparams = JComponentHelper::getParams ('com_media');
?>
<div class="contact<?php echo $this->pageclass_sfx?> component">
	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="pagetitle">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
		<?php if ($this->contact->name && $this->params->get('show_name')) : ?>
		<div class="page-header">
			<h2 class="pagetitle">
				<span class="contact-name"><?php echo $this->contact->name; ?></span>
			</h2>
		</div>
		<?php endif;  ?>
		<?php if ($this->params->get('show_contact_category') == 'show_no_link') : ?>
			<h3>
				<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
			</h3>
		<?php endif; ?>
		<?php if ($this->params->get('show_contact_category') == 'show_with_link') : ?>
			<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
			<h3>
				<span class="contact-category"><a href="<?php echo $contactLink; ?>">
					<?php echo $this->escape($this->contact->category_title); ?></a>
				</span>
			</h3>
		<?php endif; ?>
		<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
			<form action="#" method="get" name="selectForm" class="form-form" id="selectForm">
				<?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
				<?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox form-field" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
			</form>
		<?php endif; ?>
		<?php if ($this->params->get('show_tags', 1) && !empty($this->item->tags)) : ?>
			<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<br /><br />
		<?php endif; ?>		
		<?php 
		
			if ($this->params->get('presentation_style')=='plain'){
				
				include 'contact_plain.php';
				
			}elseif ($this->params->get('presentation_style')=='tabs'){
				
				include 'contact_tabs.php';
				
			}else{
				
				include 'contact_sliders.php';
				
			}
		
		?>
</div>