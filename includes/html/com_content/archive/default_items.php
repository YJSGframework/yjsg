<?php
/**
 * @version		$Id: default_items.php 20209 2011-01-09 17:23:07Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.YJDS.'helpers');
$params = $this->params;

?>
<div id="archive-items" itemscope itemtype="http://schema.org/Article">
	<?php foreach ($this->items as $i => $item) : 
			$info = $item->params->get('info_block_position', 0); 
			$author = $params->get('link_author', 0) ? JHTML::_('link',JRoute::_('index.php?option=com_users&amp;view=profile&amp;member_id='.$item->created_by),$item->author) : $item->author; 
			$author	=($item->created_by_alias ? $item->created_by_alias : $author);
			?>
	<div class="yjsgarticle">
		<h2 class="pagetitle" itemprop="name">
			<?php if ($params->get('link_titles')): ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug,$item->catslug)); ?>" itemprop="url">
				<?php echo $this->escape($item->title); ?>
			</a>
			<?php else: ?>
			<?php echo $this->escape($item->title); ?>
			<?php endif; ?>
		</h2>
		<div class="newsitem_tools">
		<?php if ($info == 0) include YJSG_ARTICLE_INFO; //layouts/yjsg_article_info.php ?>
		<?php if ($info == 2) include YJSG_ARTICLE_INFO_SPLIT_TOP; //layouts/yjsg_article_info_split_top.php ?>
		</div>
		<?php if ($params->get('show_intro')) :?>
		<div class="clr"></div>
		<div class="newsitem_text" itemprop="articleBody">
			<?php echo JHTML::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?>
		</div>
		<?php endif; ?>
		<?php if ($info == 1) include YJSG_ARTICLE_INFO; //layouts/yjsg_article_info.php ?>
		<?php if ($info == 2) include YJSG_ARTICLE_INFO_SPLIT_BOTTOM; //layouts/yjsg_article_info_split_bottom.php ?>
	</div>
	<?php endforeach; ?>
</div>
<div class="yjsg-pagination">
	<p class="yjsg-pagination-counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>