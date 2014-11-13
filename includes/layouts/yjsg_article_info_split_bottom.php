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
	
	$article_modifiedMD 		= ' itemprop="dateModified"';
	$article_authorMD 			= ' itemprop="author" itemscope itemtype="http://schema.org/Person"';
	$article_nameMD 			= ' itemprop="name"';
	$article_interactionrMD 	='<meta itemprop="interactionCount" content="UserPageVisits:'.$thisitem->hits.'" />';
}
$useDefListSplitB = (
				$params->get('show_modify_date') || 
				$params->get('show_author') ||
				$params->get('show_hits')
			 );
			 
			 
			 
if($app->input->get( 'view' ) == 'article'){


	$article_modifiedMD 		= $yjsg->mdata($params)->modifydate;
	$article_authorMD 			= $yjsg->mdata($params)->author;
	$article_nameMD 			= $yjsg->mdata($params)->authorname;
	$article_interactionrMD 	= $yjsg->mdata($params,$thisitem->hits)->interaction;
	
}



if (!$useDefListSplitB) return;
?>
<div class="newsitem_info newsitem_info_split_bottom">
	<?php /*Modify date*/ if ($params->get('show_modify_date')) : ?>
	<span class="modifydate details">
	<span class="fa fa-edit"></span>
	<time datetime="<?php echo JHtml::_('date', $thisitem->modified, 'c'); ?>"<?php echo $article_modifiedMD ?>>
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$thisitem->modified, JText::_('DATE_FORMAT_LC2'))); ?>
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