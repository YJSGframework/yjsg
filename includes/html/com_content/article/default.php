<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers');
$params 	= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
$images 	= json_decode($this->item->images);
$info    	= $params->get('info_block_position', 0);
$edit_icon	= JHtml::_('icon.edit', $this->item, $params);
$email_icon = JHtml::_('icon.email', $this->item, $params);
$print_icon = JHtml::_('icon.print_screen', $this->item, $params);
$suffix		= $this->params->get( 'pageclass_sfx' );

// remove images from print email and edit, use font icons
if ($canEdit){
		$edit_icon = preg_replace('/(<span(.*?)>|<\/span>)/s','', $edit_icon);
		$edit_icon = preg_replace('/(>(.*?)<\/a>)/s', '><i class="fa fa-pencil"></i> <em>'.JText::_('JGLOBAL_EDIT').'</em></a>', $edit_icon);
}
if ($params->get('show_email_icon')){
	$email_icon = preg_replace('/(>(.*?)<\/a>)/s', '><i class="fa fa-envelope"></i> <em>'.JText::_('JGLOBAL_EMAIL').'</em></a>', $email_icon);
}
if ($params->get('show_print_icon')){
	 
	 $print_icon = preg_replace('/(>(.*?)<\/a>)/s', '><i class="fa fa-print"></i> <em>'.JText::_('JGLOBAL_PRINT').'</em></a>', $print_icon);

}
$bootstrap_version  = $yjsg->tplParam('bootstrap_version');
if(empty($bootstrap_version)){
	
	$bootstrap_version  ='bootstrapoff';
}

//end
$author = $params->get('link_author', 0) ? JHTML::_('link',JRoute::_('index.php?option=com_users&amp;view=profile&amp;member_id='.$this->item->created_by),$this->item->author) : $this->item->author; 
$author	=($this->item->created_by_alias ? $this->item->created_by_alias : $author);
$newsitemTools = ($canEdit or ($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits') or $params->get('show_print_icon') or $params->get('show_email_icon')));
?>

<div class="yjsgarticle<?php echo $params->get('pageclass_sfx')?>"<?php echo $yjsg->mdata($params)->itemscope ?>>
	<?php echo $yjsg->mdata($params)->itemlang ?>
	<?php /*Page title*/ if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="pagetitle<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
	<?php endif; ?>
	<?php
if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
 echo '<div class="yjsg-pager-links">'.$this->item->pagination.'</div>';
}
?>
	<?php  /* Title*/ if ($params->get('show_title')) : ?>
	<h1 class="article_title"<?php echo $yjsg->mdata($params)->itemtitle  ?>>
		<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
		<a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $suffix; ?>"<?php echo $yjsg->mdata($params)->itemurl  ?>>
			<?php echo $this->escape($this->item->title); ?>
		</a>
		<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h1>
	<?php endif; ?>
	<?php  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>
	<?php if ($newsitemTools) : ?>
	<div class="newsitem_tools">
		<?php if ($info == 0) include YJSG_ARTICLE_INFO; //layouts/yjsg_article_info.php ?>
		<?php if ($info == 2) include YJSG_ARTICLE_INFO_SPLIT_TOP; //layouts/yjsg_article_info_split_top.php ?>
		<?php /* Rich snippets */if ($params->get('yjsg_microdata_position') == 0 && !empty($yjsg->mdata($params)->microdata)) : ?>
		<div class="yjsg-rich-snippets yjrs-header">
			<?php echo $yjsg->mdata($params)->microdata ?>
		</div>
		<?php endif; ?>
		<?php /* Email and Print*/ if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
		<div class="btn-group pull-right actiongroup">
			<?php if ($bootstrap_version !='bootstrapoff') : ?>
			<a class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
				<span class="fa fa-list-ul"></span>
			</a>
			<?php endif; ?>
			<ul class="dropdown-menu articletools">
				<?php if ($params->get('show_print_icon')) : ?>
				<li class="print-icon">
					<?php echo $print_icon  ?>
				</li>
				<?php endif; ?>
				<?php if ($params->get('show_email_icon')) : ?>
				<li class="email-icon">
					<?php echo $email_icon ?>
				</li>
				<?php endif; ?>
				<?php if ($canEdit) : ?>
				<li class="edit-icon">
					<?php echo $edit_icon ?>
				</li>
				<?php endif; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<?php if (intval(JVERSION) >= 3 && $params->get('show_tags', 1) && !empty($this->item->tags)) : ?>
	<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
	<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>
	<div class="newsitem_text"<?php echo $yjsg->mdata($params)->itemtext ?>>
		<?php if (isset ($this->item->toc)) : ?>
		<?php echo $this->item->toc; ?>
		<?php endif; ?>
		<?php echo $this->loadTemplate('links');?>
		<?php if ($params->get('access-view')):?>
		<?php  if (!empty($images->image_fulltext)) : ?>
		<div class="img-fulltext-<?php echo  $images->float_fulltext ?>">
			<img
		<?php if ($images->image_fulltext_caption):
			echo 'class="caption"'.' title="' .$images->image_fulltext_caption .'"';
		endif; ?>
		<?php if (empty($images->float_fulltext)):?>
			style="float:<?php echo  $params->get('float_fulltext') ?>"
		<?php else: ?>
			style="float:<?php echo  $images->float_fulltext ?>"
		<?php endif; ?>
		src="<?php echo $images->image_fulltext; ?>" alt="<?php echo $images->image_fulltext_alt; ?>" itemprop="image" />
		</div>
		<?php endif; ?>
		<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
 echo '<div class="yjsg-pager-links">'.$this->item->pagination.'</div>';
endif;
?>
		<?php echo $this->item->text; ?>
		<?php if ($info == 1) include YJSG_ARTICLE_INFO; //layouts/yjsg_article_info.php ?>
		<?php if ($info == 2) include YJSG_ARTICLE_INFO_SPLIT_BOTTOM; //layouts/yjsg_article_info_split_bottom.php ?>
		<?php /* Rich snippets */if ($params->get('yjsg_microdata_position') == 1 && !empty($yjsg->mdata($params)->microdata)) : ?>
		<div class="yjsg-rich-snippets yjrs-article">
			<?php echo $yjsg->mdata($params)->microdata ?>
		</div>
		<?php endif; ?>
		<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND !$this->item->paginationrelative):
  
 echo '<div class="yjsg-pager-links">'.$this->item->pagination.'</div>';
 ?>
		<?php endif; ?>
		<?php //optional teaser intro text for guests ?>
		<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
		<?php echo $this->item->introtext; ?>
		<?php //Optional link to let them register to see the whole article. ?>
		<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
	$link1 = JRoute::_('index.php?option=com_users&view=login');
	$link = new JURI($link1);?>
		<a class="readon" href="<?php echo $link; ?>">
			<span>
			<?php $attribs_article = json_decode($this->item->attribs);  ?>
			<?php 
	if ($attribs_article->alternative_readmore == null) :
		echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
	elseif ($readmore = $this->item->alternative_readmore) :
		echo $readmore;
		if ($params->get('show_readmore_title', 0) != 0) :
			echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif;
	elseif ($params->get('show_readmore_title', 0) == 0) :
		echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
	else :
		echo JText::_('COM_CONTENT_READ_MORE');
		echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
	endif; ?>
			</span>
		</a>
		<?php endif; ?>
		<?php endif; ?>
	</div>
	<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
 echo '<div class="yjsg-pager-links">'.$this->item->pagination.'</div>';
 ?>
	<?php endif; ?>
</div>
<!--end news item -->
<?php echo $this->item->event->afterDisplayContent; ?>