<?php
/**
 * @version		$Id: default.php 18650 2010-08-26 13:28:49Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DIRECTORY_SEPARATOR.'helpers');
// If the page class is defined, add to class as suffix.
// It will be a separate class if the user starts it with a space
$pageClass = $this->params->get('pageclass_sfx');

?>
<div class="yjsg-newsitems<?php echo $pageClass;?>"<?php echo $yjsg->mdata($this->params)->category ?>>
	<div class="yjsg-blog_c<?php echo $pageClass;?>">
		<?php /*Page title*/if ( $this->params->get('show_page_heading')!=0) : ?>
		<h1 class="pagetitle"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		<?php endif; ?>

		<?php /* Category title*/ if ($this->params->get('show_category_title', 1) OR $this->params->get('page_subheading')) : ?>
			<h2 class="pagetitle">
				<?php echo $this->escape($this->params->get('page_subheading')); ?>
				<?php if ($this->params->get('show_category_title')) : ?>
					<span><?php echo $this->category->title;?></span>
				<?php endif; ?>
			</h2>
		<?php endif; ?>
		<?php if (intval(JVERSION) >= 3 && $this->params->get('show_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
			<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
			<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
		<?php endif; ?>		
		<?php /* Category Desc*/if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
			<div class="yjsg-categorydesc">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
				<img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
			<?php endif; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo JHtml::_('content.prepare', $this->category->description); ?>
			<?php endif; ?>
			<div class="clr"></div>
			</div>
		<?php endif; ?>
		
		<?php /*Leading items*/	$leadingcount=0 ;if (!empty($this->lead_items) || count($this->lead_items) !==0) : ?>
		<div class="yjsg-leadingarticles">
			<?php foreach ($this->lead_items as &$item) : ?>
			<div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"<?php echo $yjsg->mdata($this->params)->category ?>>
				<?php
					$this->item = &$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			<?php $leadingcount++; endforeach; ?>
		</div>
		<?php endif; ?>

		<?php /*Intro items*/
			if (!empty($this->intro_items)) :
				if ($this->columns > 1) {
					$teaser_class=' multicolumns';
				} else {
					$teaser_class='';
				}?>
		<div class="teaserarticles<?php echo $teaser_class?>">
			<?php 
			$introcount=(count($this->intro_items));
			$counter=0;
			foreach ($this->intro_items as $key => &$item) : 
			
				if(version_compare(JVERSION, '3.2', '<')){
					$key		= ($key-$leadingcount)+1;
					$rowcount	= ( ((int)$key-1) %	(int) $this->columns) +1;
				}else{
					$rowcount = ((int) $key % (int) $this->columns) + 1;
				}
				
				$row = $counter / $this->columns ;
				if ($introcount == 1) {
					$mycount ='100';
				}else{
					$mycount = intval(100/$this->params->get('num_columns'));
				}
				if ($counter % $this->columns == 0){
					$item_order = 'first ';
				}elseif ($counter % $this->columns == $this->columns -1){
					$item_order='last ';
				}else{
					$item_order='';
				}
			?>
			<div class="<?php echo $item_order ?>float-left width<?php echo $mycount?>"<?php echo $yjsg->mdata($this->params)->category ?>>
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
			</div>
			<?php $counter++; ?>
			
			<?php if (($rowcount == $this->columns) or ($counter ==$introcount)): ?>
			<span class="row-separator"></span>
			<?php endif; ?>
			
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<?php /*More links*/if (!empty($this->link_items)) : ?>
		<div class="yjsg-morearticles jbsm"> 
			<?php echo $this->loadTemplate('links'); ?> 
		</div>
		<?php endif; ?>
		
		<?php /* Sub cats*/ if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
		<div class="yjsg-morearticles jbsm">
		<h3><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>
		<?php echo $this->loadTemplate('children'); ?>
		</div>
		<?php endif; ?>
		
		<?php /*Pagination*/
		if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
		<div class="yjsg-pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="results"><?php echo $this->pagination->getPagesCounter(); ?></p>
			<?php  endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?> 
		</div>
		<?php endif; ?>
	</div>
</div>