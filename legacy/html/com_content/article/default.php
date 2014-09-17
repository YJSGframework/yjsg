<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers');
$params 	= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
if(intval(JVERSION)  > 1.7){
	$jvcheck = true;
	$images = json_decode($this->item->images);
}else{
	$jvcheck = false;
}

$edit_icon	= JHtml::_('icon.edit', $this->item, $params);
$email_icon = JHtml::_('icon.email', $this->item, $params);
if (!$this->print){
	$print_icon = JHtml::_('icon.print_popup', $this->item, $params);
}else{
	$print_icon = JHtml::_('icon.print_screen', $this->item, $params);
	
}

$bootstrap_version  = $yjsg->tplParam('bootstrap_version');
if(empty($bootstrap_version)){
	
	$bootstrap_version  ='bootstrapoff';
}

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
//end

$suffix		= $this->params->get( 'pageclass_sfx' );

$author = $params->get('link_author', 0) ? JHTML::_('link',JRoute::_('index.php?option=com_users&amp;view=profile&amp;member_id='.$this->item->created_by),$this->item->author) : $this->item->author; 
$author	=($this->item->created_by_alias ? $this->item->created_by_alias : $author);
$newsitemTools = ($canEdit or ($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits') or $params->get('show_print_icon') or $params->get('show_email_icon')));
?>

<div class="news_item_a<?php echo $params->get('pageclass_sfx')?>"<?php echo $yjsg->mdata($params)->itemscope ?>>
	<?php echo $yjsg->mdata($params)->itemlang ?>
	<?php /*Page title*/ if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="pagetitle<?php echo $this->params->get('pageclass_sfx')?>"> 
		<?php echo $this->escape($this->params->get('page_heading')); ?> 
	</h1>
	<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
	 echo '<div class="jb_pagin">'.$this->item->pagination.'</div>';
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
		<div class="newsitem_info">
			<?php /* Parent category*/if ($params->get('show_parent_category')) : ?>
					<span class="icon-list-alt"></span> <span class="newsitem_parent_category">
						<?php $title = $this->escape($this->item->parent_title);
							$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '"'.$yjsg->mdata($params)->itemgenre.'>' . $title . '</a>'; ?>
					<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
                        <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
                        <?php else : ?>
                        <?php echo JText::sprintf('COM_CONTENT_PARENT', '<span'.$yjsg->mdata($params)->itemgenre.'>'.$title.'</span>'); ?>
                    <?php endif; ?>
					</span>
			<?php endif; ?>	
			<?php /*Category title*/if ($params->get('show_category')) : ?>
			<span class="newsitem_category"><span class="icon-list-alt"></span> 
			<?php 	$title = $this->escape($this->item->category_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'"'.$yjsg->mdata($params)->itemgenre.'>'.$title.'</a>';
					if ($params->get('link_category') AND $this->item->catslug) :
						echo JText::sprintf('COM_CONTENT_CATEGORY', $url);
					else:?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span'.$yjsg->mdata($params)->itemgenre.'>'.$title.'</span>'); ?>
					<?php endif; ?>
			</span>
			<?php endif; ?>        
			<?php /* Create date*/if ($params->get('show_create_date')) : ?>
			<span class="createdate">
				<span class="icon-calendar"></span> 
				<time datetime="<?php echo JHtml::_('date', $this->item->created, 'c'); ?>"<?php echo $yjsg->mdata($params)->createdate ?>>
					<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
				</time>
			</span>
			<?php endif; ?>
			<?php /*Modify date*/ if ($params->get('show_modify_date')) : ?><div class="clr"></div>
            <span class="modifydate"> 
                <span class="icon-edit"></span> 
				<time datetime="<?php echo JHtml::_('date', $this->item->modified, 'c'); ?>"<?php echo $yjsg->mdata($params)->modifydate ?>>
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</time>
		    </span>
            <?php endif; ?>	
			<?php /* Published date*/ if ($params->get('show_publish_date')) : ?>
			<span class="newsitem_published">
				<span class="icon-calendar"></span>
				<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'c'); ?>"<?php echo $yjsg->mdata($params)->published ?>>
					<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
				</time>
			</span>
			<?php endif; ?>	<div class="clr"></div>            		
			<?php /* Author*/if ($params->get('show_author') && !empty($this->item->author)) : ?>
            <div class="clr"></div>
			<span class="createby"<?php echo $yjsg->mdata($params)->author ?>>
				<span class="icon-pencil"></span> 
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY','<span'.$yjsg->mdata($params)->authorname.'>'.$author.'</span>'); ?>
			</span>
			<?php endif; ?>
			<?php /* Hits*/if ($params->get('show_hits')) : ?>
			<span class="newsitem_hits"><span class="icon-eye-open"></span>
				<?php echo $yjsg->mdata($params,$this->item->hits)->interaction ?>
				<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
			</span>
			<?php endif; ?>
			<?php /* Rich snippets */if ($params->get('yjsg_microdata_position') == 0) : ?>
			<div class="yjsg-rich-snippets yjrs-header">
				<?php echo $yjsg->mdata($params)->microdata ?>
			</div>
			<?php endif; ?>
		</div>
		
		<?php /* Email and Print*/ if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
        <div class="btn-group pull-right actiongroup"> 
			<?php if ($bootstrap_version !='bootstrapoff') : ?>
        	<a class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown" href="#"> 
            	<span class="icon-tasks"></span>
            </a>
			 <?php endif; ?>
            <ul class="dropdown-menu buttonheading">
                <?php if ($params->get('show_print_icon')) : ?>
                <li class="print-icon"> <?php echo $print_icon  ?> </li>
                <?php endif; ?>
                <?php if ($params->get('show_email_icon')) : ?>
                <li class="email-icon"> <?php echo $email_icon ?> </li>
                <?php endif; ?>
                <?php if ($canEdit) : ?>
                <li class="edit-icon"> <?php echo $edit_icon ?> </li>
                <?php endif; ?>
            </ul>
        </div>
		<?php endif; ?>
		<div class="yjsg-clear-all"></div>
	</div>
	<?php endif; ?>
	<?php if (intval(JVERSION) >= 3 && $params->get('show_tags', 1) && !empty($this->item->tags)) : ?>
		<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>
	<div class="clr"></div>
	<div class="newsitem_text"<?php echo $yjsg->mdata($params)->itemtext ?>>
		<?php if (isset ($this->item->toc)) : ?>
		<?php echo $this->item->toc; ?>
		<?php endif; ?>
        <?php if($jvcheck):echo $this->loadTemplate('links');endif;?>
      
		<?php if ($params->get('access-view')):?>
        
        <?php  if (!empty($images->image_fulltext) && $jvcheck) : ?>
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
            src="<?php echo $images->image_fulltext; ?>" alt="<?php echo $images->image_fulltext_alt; ?>"  itemprop="image" />
        </div>
        <?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
	 echo '<div class="jb_pagin">'.$this->item->pagination.'</div>';
 endif;
?>
		<?php echo $this->item->text; ?>
		<?php /* Rich snippets */if ($params->get('yjsg_microdata_position') == 1) : ?>
		<div class="yjsg-rich-snippets yjrs-article">
			<?php echo $yjsg->mdata($params)->microdata ?>
		</div>
		<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND !$this->item->paginationrelative):
	  
	 echo '<div class="jb_pagin">'.$this->item->pagination.'</div>';
	 ?>
<?php endif; ?>	
	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true AND  $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<a class="btn btn-small btn-sm readon" href="<?php echo $link; ?>">
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
	 echo '<div class="jb_pagin">'.$this->item->pagination.'</div>';
	 ?>
<?php endif; ?>	
</div>
<!--end news item -->
<?php echo $this->item->event->afterDisplayContent; ?>