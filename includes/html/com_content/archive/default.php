<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.YJDS.'helpers');

$monthField = str_replace('inputbox','yjsg-form-element',$this->form->monthField);
$yearField 	= str_replace('inputbox','yjsg-form-element',$this->form->yearField);
$limitField = str_replace('inputbox','yjsg-form-element',$this->form->limitField);

?>
<div class="archived_view<?php echo $this->pageclass_sfx;?>">
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1 class="pagetitle">
	<?php echo $this->escape($this->params->get('page_heading')); ?>
</h1>
<?php endif; ?>
<form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post" class="yjsg-form">
	<fieldset class="yjsg-form-fieldset">
	<div class="yjsg-form-group-inline">
		<?php if ($this->params->get('filter_field') != 'hide') : ?>
		<label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL').'&#160;'; ?></label>
		<div class="yjsg-element-holder">
			<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" class="yjsg-form-element" onchange="document.jForm.submit();" />
		</div>
		<?php endif; ?>
		<div class="yjsg-element-holder">
		<?php echo $monthField ?>
		</div>
		<div class="yjsg-element-holder">
		<?php echo $yearField; ?>
		</div>
		<div class="yjsg-element-holder">
		<?php echo $limitField; ?>
		</div>
		<div class="yjsg-element-holder">
		<button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
		</div>
	</div>
	<input type="hidden" name="view" value="archive" />
	<input type="hidden" name="option" value="com_content" />
	<input type="hidden" name="limitstart" value="0" />
	</fieldset>

	<?php echo $this->loadTemplate('items'); ?>
</form>
</div>