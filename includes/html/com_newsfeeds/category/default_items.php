<?php
/**
 * @version		$Id: default_items.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_newsfeeds
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.framework',true);

$n = count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?>	 </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="yjsg-form">
	<fieldset class="yjsg-form-fieldset">
	<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="yjsg-form-group-inline">
			<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
			<div class="yjsg-element-holder">
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		</div>
	<?php endif; ?>
	</fieldset>
	<table class="yjsg-table-bordered">
		<?php if ($this->params->get('show_headings')==1) : ?>
		<thead><tr>
				
				<th class="sectiontableheader" id="tableOrdering">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_FEED_NAME', 'a.name', $listDirn, $listOrder); ?>
				</th>
				

				<?php if ($this->params->get('show_articles')) : ?>
				<th class="sectiontableheader" id="tableOrdering2">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_NUM_ARTICLES', 'a.numarticles', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

				<?php if ($this->params->get('show_link')) : ?>
				<th class="sectiontableheader" id="tableOrdering3">
					<?php echo JHtml::_('grid.sort', 'COM_NEWSFEEDS_FEED_LINK', 'a.link', $listDirn, $listOrder); ?>
				</th>
				<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
		<?php if ($this->items[$i]->published == 0) : ?>
			<tr class="system-unpublished sectiontableentry<?php echo $i % 2+1; ?>">
		<?php else: ?>
			<tr class="sectiontableentry<?php echo $i % 2+1; ?>" >
		<?php endif; ?>

					<td class="item-title">
						<a href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($item->slug, $item->catid)); ?>">
							<?php echo $item->name; ?></a>
					</td>

					<?php  if ($this->params->get('show_articles')) : ?>
						<td class="item-num-art">
							<?php echo $item->numarticles; ?>
						</td>
					<?php  endif; ?>

					<?php  if ($this->params->get('show_link')) : ?>
						<td class="item-link">
							<a href="<?php echo $item->link; ?>"><?php echo $item->link; ?></a>
						</td>
					<?php  endif; ?>

				</tr>
				
			<?php endforeach; ?>
			
		</tbody>
	</table>

	<?php if ($this->params->get('show_pagination')) : ?>
	<div class="yjsg-pagination">
	<?php if ($this->params->def('show_pagination_results', 1)) : ?>
		<p class="yjsg-pagination-counter">
			<?php echo $this->pagination->getPagesCounter(); ?>
		</p>
	<?php endif; ?>
	<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>

	<div>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<input type="hidden" name="task" value="" />
	</div>
</form>
<?php endif; ?>