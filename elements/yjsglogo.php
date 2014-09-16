<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Platform.
 * Provides a modal media selector including upload mechanism
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldYJSGLogo extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'YJSGLogo';

	/**
	 * The initialised state of the document object.
	 *
	 * @var    boolean
	 * @since  11.1
	 */
	protected static $initialised = false;

	/**
	 * Method to get the field input markup for a media selector.
	 * Use attributes to identify specific created_by and asset_id fields
	 *
	 * @return  string  The field input markup.
	 * @since   11.1
	 */
	protected function getInput()
	{



		$templateSettings 	= YJSGTEMPLATEPATH . "template-settings.xml";
		$loadSettings		= simplexml_load_file($templateSettings);


		$defaultStyle 		= $loadSettings->xpath("//field[@name='yjsg_get_styles']/@default");
		if(!empty($defaultStyle)){
			
			$defaultStyle		= (string)$defaultStyle[0];
			
		}else{
			
			$defaultStyle		= $this->form->getFieldAttribute('yjsg_get_styles','default' ,'default', 'params');
		}

		
		$get_color_value		= explode('|',$defaultStyle);
		$yjsg_get_styles		= $get_color_value[0];	
		$default_logo_image 	= JURI::root()."templates/".$this->form->getValue('template')."/images/".$yjsg_get_styles."/logo.png";
		  
		$assetField				= $this->element['asset_field'] ? (string) $this->element['asset_field'] : 'asset_id';
		$asset					= $this->form->getValue($assetField) ? $this->form->getValue($assetField) : (string) $this->element['asset_id'] ;
		
		if ($asset == '') {
			$asset = JFactory::getApplication()->input->get('option');
		}

		$link = (string) $this->element['link'];

		
		// Initialize variables.
		$html = array();
		$attr = '';

		// Initialize some field attributes.
		$attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';

		$directory = (string)$this->element['directory'];
		if ($this->value && file_exists(JPATH_ROOT . '/' . $this->value)) {
			$folder = explode ('/', $this->value);
			array_shift($folder);
			array_pop($folder);
			$folder = implode('/', $folder);
		}
		elseif (file_exists(JPATH_ROOT . '/' . JComponentHelper::getParams('com_media')->get('image_path', 'images') . '/' . $directory)) {
			$folder = $directory;
		}
		else {
			$folder='';
		}

		// label
		$add_label='<label id="jform_params_logo_image-lbl" for="jform_params_logo_image" class="adminLabel" data-original-title="'.JText::_('YJSG_LOGO_IMAGE_LABEL').'" data-content="'.JText::_('YJSG_LOGO_IMAGE_DESC').'">'.JText::_('YJSG_LOGO_IMAGE_LABEL').'</label>';
		
		// The text field.
		$html[] = '<div id="custom_logo" class="YJSG_sbox">';
		$html[] = $add_label;
		$html[] = '<div id="logo_right_holder">';
		$html[] = '<a id="prev_logo" href="#"><img id="show_logo" src="'.$default_logo_image.'" alt="logo"/></a>';
		$html[] = '	<input type="text" name="'.$this->name.'" class="text_area" id="'.$this->id.'"' .
			' value="'.htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8').'"' .
			''.$attr.' /><br />';
		$html[] = '<div id="logo_buttons">';
		$html[] = '<a id="'.$this->element['name'].'_openm" class="round_b yjsgtips" href="#" data-original-title="'.JText::_('YJSG_LOGO_SELECT_TXT').'" data-content="'.JText::_('YJSG_LOGO_SELECT_DESC').'" data-toggle="modal" data-target="#Modal_'.$this->element['name'].'">';
		$html[] = JText::_('YJSG_LOGO_SELECT_TXT');
		$html[] = '</a>';
		$html[] = '<a class="round_b yjsgtips" id="clear_logo" href="#" data-original-title="'.JText::_('YJSG_RESET').'" data-content="'.JText::_('YJSG_LOGO_RESET_DESC').'" onclick="document.getElementById(\''.$this->id.'\').value=\'\'; return false;">';
		$html[] = JText::_('YJSG_RESET');
		$html[] = '</a>';
		$html[] = '<a class="round_b yjsgtips" data-original-title="'.JText::_('YJSG_LOGO_AUTO_TXT').'" data-content="'.JText::_('YJSG_LOGO_AUTO_DESC').'"  href="#" id="add_dimensions">';
		$html[] = JText::_('YJSG_LOGO_AUTO_TXT');
		$html[] = '</a>';
		$html[] = '</div>';
		$html[] = '<div id="image_dimensions"></div>';
		$html[] = '</div></div>';
		
		
		//modal iframe
		$html[] = '<div class="modal fade modaliframe" id="Modal_'.$this->element['name'].'" tabindex="-1" role="dialog" aria-labelledby="Modal_'.$this->element['name'].'" aria-hidden="true" data-iframesrc="'.$link. 'index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;asset='.$asset.'&amp;author=yjsg&amp;fieldid='.$this->id.'&amp;folder='.$folder.'">';
		$html[] = '<div class="modal-dialog">';
		$html[] = '<div class="modal-content">';
		$html[] = '<div class="modal-header">';
		$html[] = '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		$html[] = '<h5 class="modal-title">'.JText::_('YJSG_SELECT_LOGO_IMAGE').'</h5>';
		$html[] = '</div>';
		$html[] = '<div class="modal-body">';
		$html[] = '</div>';
		$html[] = '<div class="modal-footer">';
		$html[] = '<button type="button" class="btn btn-default" data-dismiss="modal">'.JText::_('YJSG_CLOSE').'</button>';
		$html[] = '</div>';
		$html[] = '</div><!-- /.modal-content -->';
		$html[] = '</div><!-- /.modal-dialog -->';
		$html[] = '</div><!-- /.modal -->';
	
	
		// modal preview
		$html[] = '<div class="modal fade" id="logoModalPreview" tabindex="-1" role="dialog" aria-labelledby="logoModalPreview" aria-hidden="true">';
		$html[] = '<div class="modal-dialog">';
		$html[] = '<div class="modal-content">';
		$html[] = '<div class="modal-header">';
		$html[] = '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		$html[] = '<h5 class="modal-title" id="logoModalPreviewLabel">'.JText::_('YJSG_CURRENT_LOGO_IMAGE').'</h5>';
		$html[] = '</div>';
		$html[] = '<div class="modal-body">';
		$html[] = '</div>';
		$html[] = '</div><!-- /.modal-content -->';
		$html[] = '</div><!-- /.modal-dialog -->';
		$html[] = '</div><!-- /.modal -->';


		return implode("\n", $html);
	}
	
	public function getLabel(){
		return false;
	}
}
