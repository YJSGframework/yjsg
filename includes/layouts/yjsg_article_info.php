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
	$article_modifiedMD 		= ' itemprop="dateModified"';
	$article_publishedMD 		= ' itemprop="datePublished"';
	$article_authorMD 			= ' itemprop="author" itemscope itemtype="http://schema.org/Person"';
	$article_nameMD 			= ' itemprop="name"';
	$article_interactionrMD 	='<meta itemprop="interactionCount" content="UserPageVisits:'.$thisitem->hits.'" />';
}

$infoclass ='';
$useDefList = (
				$params->get('show_modify_date') || 
				$params->get('show_publish_date') || 
				$params->get('show_create_date')|| 
				$params->get('show_hits') || 
				$params->get('show_category') || 
				$params->get('show_parent_category') || 
				$params->get('show_author')
			 );
			 
if($info == 1){
	
	$infoclass = ' newsitem_info_bottom';
}


if($app->input->get( 'view' ) == 'article'){


	$article_genreMD 			= $yjsg->mdata($params)->itemgenre;
	$article_createdMD 			= $yjsg->mdata($params)->createdate;
	$article_modifiedMD 		= $yjsg->mdata($params)->modifydate;
	$article_publishedMD 		= $yjsg->mdata($params)->published;
	$article_authorMD 			= $yjsg->mdata($params)->author;
	$article_nameMD 			= $yjsg->mdata($params)->authorname;
	$article_interactionrMD 	= $yjsg->mdata($params,$thisitem->hits)->interaction;
	
}




if (!$useDefList) return;
?>
<div class="newsitem_info<?php echo $infoclass ?>">
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
	<?php /*Modify date*/ if ($params->get('show_modify_date')) : ?>
	<span class="modifydate details">
	<span class="fa fa-edit"></span>
	<time datetime="<?php echo JHtml::_('date', $thisitem->modified, 'c'); ?>"<?php echo $article_modifiedMD ?>>
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$thisitem->modified, JText::_('DATE_FORMAT_LC2'))); ?>
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
	<?php /* Author*/if ($params->get('show_author') && !empty($thisitem->author)) : ?>
	<span class="createdby details"<?php echo $article_authorMD ?>>
	<span class="fa fa-pencil"></span>
	<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '<span'.$article_nameMD.'>'.$author.'</span>'); ?>
	</span>
	<?php endif; ?>
	<?php /* Hits*/if ($params->get('show_hits')) : ?>
	<span class="newsitem_hits details"><span class="fa fa-eye"></span>
	<?php echo $article_interactionrMD ?>
	<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $thisitem->hits); ?>
	</span>
	<?php endif; ?>
</div>