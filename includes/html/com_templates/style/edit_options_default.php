<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// No direct access.
defined('_JEXEC') or die;
?>
<div id="<?php echo strtolower($name);?>" class="layouttab tab-pane<?php echo $isactivetab?>">
	<fieldset class="panelform">
		<ul class="adminformlist">
			<?php foreach ($this->form->getFieldset($name) as $field) : 
	
					$fieldNameClass = str_replace(array('jform[params]', '[', ']'),'',$field->name);
					
					if($fieldNameClass == 'admin_css_time'){
						
						$fieldNameClass = str_replace(array('jform[params]', '[', ']'),'',$field->name).' hidden';
					}
					
					if(strtolower($fieldNameClass) == 'sms_yj_label' || strtolower($fieldNameClass) == 'mstext_label'){
						continue;
					}
					
			?>
					<li class="lih-<?php echo strtolower($fieldNameClass); ?>">
						<?php if (!$field->hidden) : ?>
						<?php echo $field->label; ?>
						<?php endif; ?>
						<?php echo $field->input; ?>
					</li>
			<?php endforeach; ?>
		</ul>
	</fieldset>
</div>