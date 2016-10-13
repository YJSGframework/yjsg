<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.calendar');
JHtml::_('behavior.formvalidation');
Yjsg::yjsgtooltip();
if(version_compare(JVERSION, '3.0', 'ge')){
	JHtml::_('behavior.modal', 'a.modal_jform_contenthistory');
}


$this->form->loadFile(dirname(__FILE__) . DIRECTORY_SEPARATOR . "article.xml");

// Create shortcut to parameters.
$params = $this->state->get('params');
//$images = json_decode($this->item->images);
//$urls = json_decode($this->item->urls);

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);
if (!$editoroptions)
{
	$params->show_urls_images_frontend = '0';
}

// Yjsg article extra fields
$yjsg_article_options   = Yjsg::tplParam('yjsg_article_options');
$user 					= JFactory::getUser();
$userGroups				= $user->groups;
$showYjsgArticleOptions	= false;


if(is_array($yjsg_article_options) && array_intersect($yjsg_article_options,$userGroups)){
	$showYjsgArticleOptions	= true;
}

if($showYjsgArticleOptions){
	$yjsgarticlefields 				= array();
	$yjsgarticle_category_fields 	= array();
	$attrib   			= $this->form->getFieldsets('attribs');
	
	foreach ($attrib as $yjsgextras) {
		if(isset($yjsgextras->yjsgextra) && ($yjsgextras->yjsgextra == 'yjsgarticle')){
			$yjsgarticlefields[] = $yjsgextras;
		}
		
		if(isset($yjsgextras->yjsgcategory)){
			$yjsgarticle_category_fields[] = $yjsgextras;
		}
	}
	
	if(count($yjsgarticlefields)){
		
		$yjsgadata 			= new stdClass;
		$yjsgadata->attribs = json_decode($this->item->attribs);
		$this->form->bind($yjsgadata);
	}
}
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
		{
			<?php echo $this->form->getField('articletext')->save(); ?>
			Joomla.submitform(task);
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_content&a_id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="yjsg-form form-validate yjsg-edit-form">
	<br />
	<div class="yjsg-form-group-inline">
		<button type="button" class="yjsg-button-blue" onclick="Joomla.submitbutton('article.save')">
		<i class="fa fa-check"></i>
		<?php echo JText::_('JSAVE') ?>
		</button>
		<button type="button" class="yjsg-button" onclick="Joomla.submitbutton('article.cancel')">
		<i class="fa fa-close"></i>
		<?php echo JText::_('JCANCEL') ?>
		</button>
	</div>
	<div class="yjsg-clear-all"></div>
	<br />
	<div id="editortabs" class="yjsgSimpleTabs yjsgtabs yjsgtabsnav">
		<ul class="yjsgsliderPaginationTabs yjsgShortcodeTabs">
			<li class="active">
				<a class="tabbutton" href="#editcontent">
					<?php echo JText::_('YJSG_EDIT_FORM_CONTENT') ?>
				</a>
			</li>
			<?php if ($params->get('show_urls_images_frontend') ) : ?>
			<li>
				<a class="tabbutton" href="#editimages">
					<?php echo JText::_('COM_CONTENT_IMAGES_AND_URLS') ?>
				</a>
			</li>
			<?php endif; ?>
			<li>
				<a class="tabbutton" href="#editpublishing">
					<?php echo JText::_('COM_CONTENT_PUBLISHING') ?>
				</a>
			</li>
			<li>
				<a class="tabbutton" href="#editlanguage">
					<?php echo JText::_('JFIELD_LANGUAGE_LABEL') ?>
				</a>
			</li>
			<li>
				<a class="tabbutton" href="#editmetadata">
					<?php echo JText::_('COM_CONTENT_METADATA') ?>
				</a>
			</li>
			<?php if($showYjsgArticleOptions && count($yjsgarticlefields)) : ?>
			<li>
				<a class="tabbutton" href="#yjsgarticleoptions">
					<?php echo JText::_('YJSG_ARTICLE_OPTIONS') ?>
				</a>
			</li>
			<?php endif; ?>
			<?php if($showYjsgArticleOptions && count($yjsgarticle_category_fields)) : ?>
			<li>
				<a class="tabbutton" href="#yjsgarticlecategoryoptions">
					<?php echo $yjsgarticle_category_fields[0]->label ?>
				</a>
			</li>
			<?php endif; ?>
		</ul>
		<div id="editcontent" class="yjsgTabContent activeContent">
			<div class="yjsg-form-group">
				<?php echo $this->form->getLabel('title'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('title'); ?>
				</div>
			</div>
			<?php if (is_null($this->item->id)):?>
			<div class="yjsg-form-group">
				<?php echo $this->form->getLabel('alias'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('alias'); ?>
				</div>
			</div>
			<?php endif; ?>
			<br />
			<?php echo $this->form->getInput('articletext'); ?>
		</div>
		<?php if ($params->get('show_urls_images_frontend') ) : ?>
		<div id="editimages" class="yjsgTabContent">
			<div class="yjsg-row">
				<div class="yjsg-col-1-2">
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('image_intro', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('image_intro', 'images'); ?>
						</div>
					</div>
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('float_intro', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('float_intro', 'images'); ?>
						</div>
					</div>
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('image_intro_alt', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('image_intro_alt', 'images'); ?>
						</div>
					</div>
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('image_intro_caption', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('image_intro_caption', 'images'); ?>
						</div>
					</div>
				</div>
				<div class="yjsg-col-1-2">
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('image_fulltext', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('image_fulltext', 'images'); ?>
						</div>
					</div>
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('float_fulltext', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('float_fulltext', 'images'); ?>
						</div>
					</div>
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('image_fulltext_alt', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('image_fulltext_alt', 'images'); ?>
						</div>
					</div>
					<div class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('image_fulltext_caption', 'images'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('image_fulltext_caption', 'images'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="yjsg-hr-empty"></div>
			<div class="yjsg-row">
				<div class="yjsg-col-1-3">
					<div  class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('urla', 'urls'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('urla', 'urls'); ?>
						</div>
					</div>
					<div  class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('urlatext', 'urls'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('urlatext', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->getInput('targeta', 'urls'); ?>
				</div>
				<div class="yjsg-col-1-3">
					<div  class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('urlb', 'urls'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('urlb', 'urls'); ?>
						</div>
					</div>
					<div  class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('urlbtext', 'urls'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('urlbtext', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->getInput('targetb', 'urls'); ?>
				</div>
				<div class="yjsg-col-1-3">
					<div  class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('urlc', 'urls'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('urlc', 'urls'); ?>
						</div>
					</div>
					<div  class="yjsg-form-group-inline">
						<?php echo $this->form->getLabel('urlctext', 'urls'); ?>
						<div class="yjsg-element-holder">
							<?php echo $this->form->getInput('urlctext', 'urls'); ?>
						</div>
					</div>
					<?php echo $this->form->getInput('targetc', 'urls'); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div id="editpublishing" class="yjsgTabContent">
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('catid'); ?>
				<div class="yjsg-element-holder">
					<?php   echo $this->form->getInput('catid'); ?>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('created_by_alias'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('created_by_alias'); ?>
				</div>
			</div>
			<?php if ($this->item->params->get('access-change')): ?>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('state'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('state'); ?>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('featured'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('featured'); ?>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('publish_up'); ?>
				<div class="yjsg-element-holder">
					<div class="yjsg-form-group-addon">
					<?php
					$publish_upRep = array(
						'id="jform_publish_up"'=>'id="jform_publish_up" class="yjsg-form-element"',
						'btn'=>'yjsg-eb',
						'input-append'=>'yjsg-form-group-addon'
					);
					$publish_up = strtr($this->form->getInput('publish_up'), $publish_upRep);

						$addbutton_u1='<span class="yjsg-form-append">';
						$addbutton_u2='</span>';
						
						if(version_compare(JVERSION, '3.0', '<')){
							$publish_up = preg_replace('/(<img(.*?)>)/s', $addbutton_u1 . "$0\n\t" . $addbutton_u2, $publish_up);
						}else{
							$publish_up = preg_replace('/(<button(.*?)button>)/s', $addbutton_u1 . "$0\n\t" . $addbutton_u2, $publish_up);
						}
						
					echo $publish_up;			
					?>
					</div>
				</div>
			</div>
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('publish_down'); ?>
				<div class="yjsg-element-holder">
					<div class="yjsg-form-group-addon">
						<?php
						$publish_downRep = array(
							'id="jform_publish_up"'=>'id="jform_publish_up" class="yjsg-form-element"',
							'btn'=>'yjsg-eb',
							'input-append'=>'yjsg-form-group-addon'
						);
						$publish_down = strtr($this->form->getInput('publish_down'), $publish_downRep);
						
							$addbutton_d1='<span class="yjsg-form-append">';
							$addbutton_d2='</span>';
						if(version_compare(JVERSION, '3.0', '<')){
							$publish_down = preg_replace('/(<img(.*?)>)/s', $addbutton_d1 . "$0\n\t" . $addbutton_d2, $publish_down);
						}else{
							$publish_down = preg_replace('/(<button(.*?)button>)/s', $addbutton_d1 . "$0\n\t" . $addbutton_d2, $publish_down);
						}
						echo $publish_down;			
						?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<div id="editlanguage" class="yjsgTabContent">
			<div class="yjsg-form-group-inline">
				<?php echo $this->form->getLabel('language'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('language'); ?>
				</div>
			</div>
			<div class="yjsg-hr-empty"></div>
			<div class="yjsg-hr-empty"></div>
		</div>
		<div id="editmetadata" class="yjsgTabContent">
			<div class="yjsg-form-group">
				<?php echo $this->form->getLabel('metadesc'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('metadesc'); ?>
				</div>
			</div>
			<div class="yjsg-form-group">
				<?php echo $this->form->getLabel('metakey'); ?>
				<div class="yjsg-element-holder">
					<?php echo $this->form->getInput('metakey'); ?>
				</div>
			</div>
		</div>
		<?php if($showYjsgArticleOptions && count($yjsgarticlefields)) : ?>
		<div id="yjsgarticleoptions" class="yjsgTabContent">
			<?php foreach ($yjsgarticlefields as $yjsgfieldset) : ?>
				<?php foreach ($this->form->getFieldset($yjsgfieldset->name) as $yjsgafield): ?>
					<div class="yjsg-form-group-inline">
						<?php echo $yjsgafield->label; ?>
						<div class="yjsg-element-holder">
							<?php echo $yjsgafield->input; ?>
						</div>
					</div>
				<?php endforeach ?>
			<?php endforeach ?>
		</div>
		<?php endif; ?>	
		<?php if($showYjsgArticleOptions && count($yjsgarticle_category_fields)) : ?>
		<div id="yjsgarticlecategoryoptions" class="yjsgTabContent">
			<?php foreach ($yjsgarticle_category_fields as $yjsgfieldset) : ?>
				<?php foreach ($this->form->getFieldset($yjsgfieldset->name) as $yjsgafield): ?>
					<div class="yjsg-form-group-inline">
						<?php echo $yjsgafield->label; ?>
						<div class="yjsg-element-holder">
							<?php echo $yjsgafield->input; ?>
						</div>
					</div>
				<?php endforeach ?>
			<?php endforeach ?>
		</div>
		<?php endif; ?>			
	</div>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
	<?php if($this->params->get('enable_category', 0) == 1) :?>
	<input type="hidden" name="jform[catid]" value="<?php echo $this->params->get('catid', 1);?>"/>
	<?php endif;?>
	<?php echo JHtml::_( 'form.token' ); ?>
</form>
