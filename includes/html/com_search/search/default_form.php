<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post" class="yjsg-form">
	<div class="yjsg-form-group-inline">
		<div class="yjsg-element-holder">
			<input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="yjsg-form-element" />
		</div>
		<div class="yjsg-element-holder">
			<button name="Search" onclick="this.form.submit()" class="button addtips" title="<?php echo JText::_('COM_SEARCH_SEARCH');?>"><span class="icon-search"></span>
			<?php echo JText::_('COM_SEARCH_SEARCH');?></button>
		</div>
		<input type="hidden" name="task" value="search" />
	</div>
	<div class="searchintro<?php echo $this->params->get('pageclass_sfx'); ?>">
		<?php if (!empty($this->searchword)):?>
		<p>
			<?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge badge-info">'. $this->total. '</span>');?>
		</p>
		<?php endif;?>
	</div>
	<fieldset class="yjsg-form-fieldset">
		<legend><?php echo JText::_('COM_SEARCH_FOR');?>
		</legend>
		<div class="yjsg-form-group-inline">
			<?php echo $this->lists['searchphrase']; ?>
		</div>
		<br />
		<div class="yjsg-form-group-inline">
			<label for="ordering" class="ordering">
				<?php echo JText::_('COM_SEARCH_ORDERING');?>
			</label>
			<div class="yjsg-element-holder">
				<?php echo $this->lists['ordering'];?>
			</div>
		</div>
	</fieldset>
	<?php if ($this->params->get('search_areas', 1)) : ?>
	<fieldset class="yjsg-form-fieldset">
		<legend><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></legend>
		<div class="yjsg-form-group-inline">
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
		$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
	?>
		<label for="area-<?php echo $val;?>" class="checkbox-label">
			<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> >
			<?php echo JText::_($txt); ?>
		</label>
		<?php endforeach; ?>
		</div>
	</fieldset>
	<?php endif; ?>
	<?php if ($this->total > 0) : ?>
	<div class="form-limit">
		<div class="yjsg-form-group-inline">
			<label for="limit">
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
			</label>
			<div class="yjsg-element-holder">
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		</div>
	</div>
	<p class="yjsg-pagination-counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php endif; ?>
</form>