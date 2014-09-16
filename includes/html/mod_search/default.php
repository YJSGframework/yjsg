<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_search
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
			
			$labelparam = $params->get('label');
			$labelout ='';
			if(!empty($moduleclass_sfx)){
				$moduleclass_sfx =' '.$moduleclass_sfx;
			}
			if(!empty($labelparam)){
				$labelout = '<label for="mod-search-searchword">'.$label.'</label>';
			}
			
			$button_out ='';

			$output = $labelout.'<div class="yjsg-element-holder"><input name="searchword" id="mod-search-searchword" maxlength="'.$maxlength.'"  class="yjsg-form-element '.$moduleclass_sfx.'" type="text" size="'.$width.'" value="'.$text.'"  onblur="if (this.value==\'\') this.value=\''.$text.'\';" onfocus="if (this.value==\''.$text.'\') this.value=\'\';" /></div>';

			if ($button) :
				if ($imagebutton) :
					$button_out = '<div class="yjsg-element-holder"><input type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$img.'" onclick="this.form.searchword.focus();"/></div>';
				else :
					$button_out = '<div class="yjsg-element-holder"><input type="submit" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="this.form.searchword.focus();"/></div>';
				endif;
			endif;

			switch ($button_pos) :
				case 'top' :
					$output = $button_out.'<br />'.$output;
					break;

				case 'bottom' :
					$output = $output.'<br />'.$button_out;
					break;

				case 'right' :
					$output = $output.$button_out;
					break;

				case 'left' :
				default :
					$output = $button_out.$output;
					break;
			endswitch;

?>
<form action="<?php echo JRoute::_('index.php');?>" method="post" class="yjsg-form">
	<div class="yjsg-form-group-inline<?php echo $moduleclass_sfx ?>">
		<?php echo $output; ?>
	<input type="hidden" name="task" value="search" />
	<input type="hidden" name="option" value="com_search" />
	<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
	</div>
</form>