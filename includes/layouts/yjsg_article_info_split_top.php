<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );

$app 	  = JFactory::getApplication();
$thisitem = $this->item;
if($app->input->get( 'view' ) == 'archive'){
	
	$thisitem = $item;
	
	$article_genreMD 			= ' itemprop="genre"';
	$article_createdMD 			= ' itemprop="dateCreated"';
	$article_publishedMD 		= ' itemprop="datePublished"';
}


$useDefListSplitT = (
				$params->get('show_publish_date') || 
				$params->get('show_create_date')|| 
				$params->get('show_category') || 
				$params->get('show_parent_category') 
			 );
			 
if($app->input->get( 'view' ) == 'article'){


	$article_genreMD 			= $yjsg->mdata($params)->itemgenre;
	$article_createdMD 			= $yjsg->mdata($params)->createdate;
	$article_publishedMD 		= $yjsg->mdata($params)->published;
	
}


if (!$useDefListSplitT) return;
?>
<div class="newsitem_info">
	<?php /* Parent category*/if ($params->get('show_parent_category')) : ?>
	<span class="fa fa-list-alt"></span>
	<span class="newsitem_parent_category details">
	<?php $title = $this->escape($thisitem->parent_title);
	$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($thisitem->parent_slug)) . '"'.$article_genreMD.'>' . $title . '</a>'; ?>
	<?php if ($params->get('link_parent_category') and $thisitem->parent_slug) : ?>
	<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
	<?php else : ?>
	<?php echo JText::sprintf('COM_CONTENT_PARENT', '<span'.$article_genreMD.'>'.$title.'</span>'); ?>
	<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php /*Category title*/if ($params->get('show_category')) : ?>
	<span class="newsitem_category details"><span class="fa fa-list-alt"></span>
	<?php 	$title = $this->escape($thisitem->category_title);
		$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($thisitem->catslug)).'"'.$article_genreMD.'>'.$title.'</a>';
		if ($params->get('link_category') AND $thisitem->catslug) :
			echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
		<?php else : ?>
			<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span'.$article_genreMD.'>'.$title.'</span>'); ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php /* Create date*/if ($params->get('show_create_date')) : ?>
	<span class="createdate details">
	<span class="fa fa-calendar"></span>
	<time datetime="<?php echo JHtml::_('date', $thisitem->created, 'c'); ?>"<?php echo $article_createdMD ?>>
		<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$thisitem->created, JText::_('DATE_FORMAT_LC3'))); ?>
	</time>
	</span>
	<?php endif; ?>
	<?php /* Published date*/ if ($params->get('show_publish_date')) : ?>
	<span class="published details"><span class="fa fa-calendar"></span>
	<time datetime="<?php echo JHtml::_('date', $thisitem->publish_up, 'c'); ?>"<?php echo $article_publishedMD ?>>
		<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHTML::_('date',$thisitem->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
	</time>
	</span>
	<?php endif; ?>
</div>