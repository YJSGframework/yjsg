<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - YJSG Framework                							||
|| # Copyright (C) since 2007  Youjoomla.com. All Rights Reserved.      ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         || 
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### || 
\*======================================================================*/
// No direct access.
defined('_JEXEC') or die;
$user 				= JFactory::getUser();
$fieldSets 			= $this->form->getFieldsets('params');
$templateVersion 	= $this->item->xml->version;
?>
<div class="yjsgsidebar">
	<div class="templatetitle">
		<h3><?php echo ucfirst($this->item->template) ?>
			<span class="version"><?php echo JText::_('YJSG_TX_VERSION').' '.$templateVersion ?></span>
		</h3>
		<div class="manager">
			<?php echo JText::_('COM_TEMPLATES')?>
			<div class="yjsgprogress progress progress-striped active">
			  <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
			  </div>
			</div>
		</div>
	</div>
	<div class="templateimage" style="background:url(<?php echo JURI::root() ?>templates/<?php echo $this->item->template; ?>/template_thumbnail.png);">
	</div>
	<ul id="sidetabs" class="nav nav-tabs tabs-left">
		<?php 

		$first = true;
		foreach ($fieldSets as $name => $fieldSet) :
			
			$isactive =' class="'.strtolower($name).'"';
			if ( $first ){
				$isactive =' class="'.strtolower($name).' active"';
				$first = false;
			}
			
			$iconClass ='adminicons-custom';
			
			if($name =='YJSG_VERSION_CHECK'){
				$iconClass ='adminicons-systemcheck';
			}elseif($name =='YJSG_STYLE_SETTINGS'){
				$iconClass ='adminicons-style';
			}elseif($name =='YJSG_LOGO_LABEL'){
				continue;
			}elseif($name =='YJSG_TOP_MENU_LABEL'){
				$iconClass ='adminicons-topmenu';
			}elseif($name =='YJSG_DEF_GRID_LABEL'){
				continue;
			}elseif($name =='YJSG_LAYOUT_LABEL'){
				$iconClass ='adminicons-layout';
			}elseif($name =='YJSG_ADD_F_LABEL'){
				$iconClass ='adminicons-additional';
			}elseif($name =='YJSG_ADV_LABEL'){
				$iconClass ='adminicons-advanced';
			}elseif($name =='YJSG_CUSTOM_CODE'){
				$iconClass ='adminicons-codeblocks';
			}
			
			$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_TEMPLATES_'.$name.'_FIELDSET_LABEL'; ?>
			<li<?php echo $isactive?>>
				<a href="#<?php echo strtolower($name);?>" data-toggle="tab">
					<i class="<?php echo $iconClass?>"></i>  <?php echo JText::_($label) ?>
				</a>
			</li>
		<?php endforeach; ?>
		<li class="menu_assigemnets">
			<a href="#assigemnets" data-toggle="tab">
				<i class="adminicons-menuassign"></i>  <?php echo JText::_('YJSG_MENU_ASSIGNMENTS') ?>
			</a>
		</li>
	</ul>
</div>
<?php echo $this->loadTemplate('toolbar'); ?>
<div class="yjsgadminform">
	<form action="<?php echo JRoute::_('index.php?option=com_templates&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="style-form" class="form-validate">
		<div class="tab-content">
			<?php echo $this->loadTemplate('options'); ?>
			<div class="tab-pane fade" id="assigemnets">
				<fieldset class="adminform">
					<ul class="adminformlist">
						<li><?php echo $this->form->getLabel('title'); ?>
							<?php echo $this->form->getInput('title'); ?></li>
						<li><?php echo $this->form->getLabel('template'); ?>
							<?php echo $this->form->getInput('template'); ?>
							<?php echo $this->form->getLabel('client_id'); ?>
							<?php echo $this->form->getInput('client_id'); ?>
							<input type="text" size="35" value="<?php echo $this->item->client_id == 0 ? JText::_('JSITE') : JText::_('JADMINISTRATOR'); ?>	" class="form-field readonly" readonly="readonly" />
						</li>
						<li>
							<?php echo $this->form->getLabel('home'); ?>
							<?php echo $this->form->getInput('home'); ?>
						</li>
						<?php if ($this->item->id) : ?>
						<li>
							<label id="jform_id-lbl" class="adminLabel" title="" data-original-title="<?php echo JText::_('YJSG_TXT_ID') ?>" data-content="<?php echo JText::_('YJSG_TXT_ID_DESC') ?>"><?php echo JText::_('YJSG_TXT_ID') ?></label>
							<span class="readonly"><?php echo $this->item->id; ?></span>
						</li>
						<?php endif; ?>
					</ul>
				</fieldset>
				<?php if ($user->authorise('core.edit','com_menu') && $user->authorise('core.edit.state') && $this->item->client_id==0):?>
					<?php echo $this->loadTemplate('assignment'); ?>
				<?php endif;?>
			</div>
		</div>
		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>