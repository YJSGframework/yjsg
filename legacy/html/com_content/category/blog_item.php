<?php
/**
 * @version		$Id: blog_item.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params 	= $this->item->params;
$canEdit	= $params->get('access-edit');
$info    	= $params->get('info_block_position', 0);
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
Yjsg::yjsgtooltip();
if(intval(JVERSION)  > 1.7){
	$jvcheck = true;
	$images = json_decode($this->item->images);
}else{
	$jvcheck = false;
}

// micro data
$article_nameMD 			= '';
$article_urlMD 				= '';
$article_genreMD 			= '';
$article_createdMD 			= '';
$article_modifiedMD 		= '';
$article_publishedMD 		= '';
$article_authorMD 			= '';
$article_interactionrMD 	= '';
$article_descriptionMD 		= '';
$article_imageMD 			= '';

if($params->get('yjsg_microdata_cat_enabeled') == 1){
	$article_nameMD 			= ' itemprop="name"';
	$article_urlMD 				= ' itemprop="url"';
	$article_genreMD 			= ' itemprop="genre"';
	$article_createdMD 			= ' itemprop="dateCreated"';
	$article_modifiedMD 		= ' itemprop="dateModified"';
	$article_publishedMD 		= ' itemprop="datePublished"';
	$article_authorMD 			= ' itemprop="author" itemscope itemtype="http://schema.org/Person"';
	$article_interactionrMD 	='<meta itemprop="interactionCount" content="UserPageVisits:'.$this->item->hits.'" />';
	$article_descriptionMD 		= ' itemprop="description"';
	$article_imageMD 			= ' itemprop="image"';
}


$edit_icon	= JHtml::_('icon.edit', $this->item, $params);
$email_icon = JHtml::_('icon.email', $this->item, $params);
$print_icon = JHtml::_('icon.print_popup', $this->item, $params);

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

$bootstrap_version  = $yjsg->tplParam('bootstrap_version');
if(empty($bootstrap_version)){
	
	$bootstrap_version  ='bootstrapoff';
}

$author = $params->get('link_author', 0) ? JHTML::_('link',JRoute::_('index.php?option=com_users&amp;view=profile&amp;member_id='.$this->item->created_by),$this->item->author) : $this->item->author; 
$author	=($this->item->created_by_alias ? $this->item->created_by_alias : $author);

$newsitemTools = (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits') or $params->get('show_print_icon') or $params->get('show_email_icon')));
?>

<div class="news_item_c<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php /* Title*/if ($params->get('show_title')) : ?>
	<h2 class="article_title"<?php echo $article_nameMD ?>>
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>"<?php echo $article_urlMD ?>>
			<?php echo $this->escape($this->item->title); ?>
		</a>
		<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
		<?php endif; ?>
	</h2>
	<?php endif; ?>
	<?php  
	if (!$params->get('show_intro')) :
		echo $this->item->event->afterDisplayTitle;
	endif; 
?>
	<?php echo $this->item->event->beforeDisplayContent; ?>
	<?php if ($newsitemTools) : ?>
	<div class="newsitem_tools">
		<?php if ($info == 0) include YJSG_ARTICLE_INFO; //layouts/yjsg_article_info.php ?>
		<?php if ($info == 2) include YJSG_ARTICLE_INFO_SPLIT_TOP; //layouts/yjsg_article_info_split_top.php ?>
		<?php /* Email and Print*/ if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
		<div class="btn-group pull-right actiongroup">
			<?php if ($bootstrap_version !='bootstrapoff') : ?>
			<a class="btn btn-default btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
				<span class="icon-tasks"></span>
			</a>
			<?php endif; ?>
			<ul class="dropdown-menu buttonheading">
				<?php if ($params->get('show_print_icon')) : ?>
				<li class="print-icon">
					<?php echo $print_icon ?>
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
		<div class="yjsg-clear-all"></div>
	</div>
	<?php endif; ?>
	<div class="clr"></div>
	<div class="newsitem_text"<?php echo $article_descriptionMD ?>>
		<?php  if ($jvcheck && !empty($images->image_intro)) : ?>
		<div class="img-introtext-<?php echo $images->float_intro ?>">
			<img
		<?php if ($images->image_intro_caption):
			echo 'class="caption"'.' title="' .$images->image_intro_caption .'"';
		endif; ?>
	<?php if (empty($images->float_intro)):?>
		style="float:<?php echo  $params->get('float_intro') ?>"
	<?php else: ?>
		style="float:<?php echo  $images->float_intro ?>"
	<?php endif; ?>
		src="<?php echo $images->image_intro; ?>" alt="<?php echo $images->image_intro_alt; ?>"<?php echo $article_imageMD ?> />
		</div>
		<?php endif; ?>
		<?php /*Intro text*/echo $this->item->introtext; ?>
		<?php if ($info == 1) include YJSG_ARTICLE_INFO; //layouts/yjsg_article_info.php ?>
		<?php if ($info == 2) include YJSG_ARTICLE_INFO_SPLIT_BOTTOM; //layouts/yjsg_article_info_split_bottom.php ?>
	</div>
	<?php /* Read more link*/ if ($params->get('show_readmore') && $this->item->readmore) :
if ($params->get('access-view')) :
	$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
else :
	$menu = JFactory::getApplication()->getMenu();
	$active = $menu->getActive();
	$itemId = $active->id;
	$link1 = JRoute::_('index.php?option=com_users&amp;view=login&amp;Itemid='. $itemId);
	$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	$link = new JURI($link1);
	$link->setVar('return', base64_encode($returnURL));
endif;
?>
	<a class="btn btn-small btn-sm readon" href="<?php echo $link; ?>">
		<span>
		<?php 
	if (!$params->get('access-view')) :
		echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
	elseif ($readmore = $this->item->alternative_readmore) :
		echo $readmore;
		echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
	elseif ($params->get('show_readmore_title', 0) == 0) :
		echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
	else :
		echo JText::_('COM_CONTENT_READ_MORE');
		echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
	endif; 
	?>
		</span>
	</a>
	<?php endif; ?>
</div>
<span class="article_separator"></span>
<?php echo $this->item->event->afterDisplayContent; ?>
