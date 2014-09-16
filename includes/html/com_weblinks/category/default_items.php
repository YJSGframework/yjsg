<?php
/**
 * @version		$Id: default_items.php 13471 2009-11-12 00:38:49Z eddieajau
 * @package		Joomla.Site
 * @subpackage	com_weblinks
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
// Code to support edit links for weblinks
// Create a shortcut for params.
$params = &$this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework',true);
// Get the user object.
$user = JFactory::getUser();
// Check if user is allowed to add/edit based on weblinks permissinos.
$canEdit = $user->authorise('core.edit', 'com_weblinks');
$canCreate = $user->authorise('core.create', 'com_weblinks');
$canEditState = $user->authorise('core.edit.state', 'com_weblinks');

$n = count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>

<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_WEBLINKS_NO_WEBLINKS'); ?></p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="yjsg-form">
	<?php if ($this->params->get('show_pagination_limit') || $this->params->get('filter_field') != 'hide') : ?>
	<div class="yjsg-form-group-inline">
		<?php if (intval(JVERSION) >= 3 && $this->params->get('filter_field') != 'hide') :?>
				<label class="filter-search-lbl" for="filter-search"><?php echo JText::_('COM_WEBLINKS_FILTER_LABEL').'&#160;'; ?></label>
				<div class="yjsg-element-holder">
					<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="yjsg-form-element" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_WEBLINKS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_WEBLINKS_FILTER_SEARCH_DESC'); ?>" />
				</div>
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>&#160;
				<div class="yjsg-element-holder">
					<?php echo $this->pagination->getLimitBox(); ?>
				</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<table class="yjsg-table-bordered">
		<?php if ($this->params->get('show_headings')==1) : ?>

		<thead><tr>

			<th class="sectiontableheader">
					<?php echo JHtml::_('grid.sort',  'COM_WEBLINKS_GRID_TITLE', 'title', $listDirn, $listOrder); ?>
			</th>
			<?php if ($this->params->get('show_link_hits')) : ?>
			<th class="sectiontableheader" width="3%">
					<?php echo JHtml::_('grid.sort',  'JGLOBAL_HITS', 'hits', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>
		</tr>
	</thead>
	<?php endif; ?>
	<tbody>
	<?php foreach ($this->items as $i => $item) : ?>
		<?php if ($this->items[$i]->state == 0) : ?>
			<tr class="system-unpublished sectiontableentry<?php echo $i % 2+1; ?>">
		<?php else: ?>
			<tr class="sectiontableentry<?php echo $i % 2+1; ?>" >
		<?php endif; ?>

			<td class="title">
			<p>
				<?php if ($this->params->get('link_icons') <> -1) : ?>
					<?php echo JHTML::_('image','system/'.$this->params->get('link_icons', 'weblink.png'), JText::_('COM_WEBLINKS_LINK'), NULL, true);?>
				<?php endif; ?>
				<?php
					// Compute the correct link
					$menuclass = 'category'.$this->pageclass_sfx;
					$link = $item->link;
					$width	= $item->params->get('width');
					$height	= $item->params->get('height');
					if ($width == null || $height == null) {
						$width	= 600;
						$height	= 500;
					}

					switch ($item->params->get('target', $this->params->get('target')))
					{
						case 1:
							// open in a new window
							echo '<a href="'. $link .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'.
								$this->escape($item->title) .'</a>';
							break;

						case 2:
							// open in a popup window
							$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$this->escape($width).',height='.$this->escape($height).'';
							echo "<a href=\"$link\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">".
								$this->escape($item->title).'</a>';
							break;
						case 3:
							// open in a modal window
							JHtml::_('behavior.modal', 'a.modal'); ?>
							<a class="modal" href="<?php echo $link;?>"  rel="{handler: 'iframe', size: {x:<?php echo $this->escape($width);?>, y:<?php echo $this->escape($height);?>}}">
								<?php echo $this->escape($item->title). ' </a>' ;
							break;

						default:
							// open in parent window
							echo '<a href="'.  $link . '" class="'. $menuclass .'" rel="nofollow">'.
								$this->escape($item->title) . ' </a>';
							break;
					}
				?>
				<?php // Code to add the edit link for the weblink. ?>

						<?php if ($canEdit) : ?>
							<ul class="actions">
								<li class="edit-icon">
									<?php echo JHtml::_('icon.edit',$item, $params); ?>
								</li>
							</ul>
						<?php endif; ?>
			</p>
			<?php if (intval(JVERSION) >= 3) { ?>
			<?php $tagsData = $item->tags->getItemTags('com_weblinks.weblink', $item->id); ?>
			<?php if ($this->params->get('show_tags', 1)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($tagsData); ?>
			<?php endif; ?>
			<?php } ?>
			<?php if (($this->params->get('show_link_description')) AND ($item->description !='')): ?>
				<p>
				<?php echo nl2br($item->description); ?>
				</p>
			<?php endif; ?>
		</td>
		<?php if ($this->params->get('show_link_hits')) : ?>
		<td class="hits" width="3%">
			<?php echo $item->hits; ?>
		</td>
		<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>

	<?php // Code to add a link to submit a weblink. ?>
	<?php /* if ($canCreate) : // TODO This is not working due to some problem in the router, I think. Ref issue #23685 ?>
		<?php echo JHtml::_('icon.create', $item, $item->params); ?>
 	<?php  endif; */ ?>
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