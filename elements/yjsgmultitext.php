<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # Authors - Dragan Todorovic and Constantin Boiangiu                 ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();
/** 
 * Renders a text element 
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */
class JFormFieldYJSGMultitext extends JFormField
{	

	public $type = 'YJSGMultitext';

	public function getInput()
	{

		// process element properties		
		$items 		= $this->element['items'];
		$default 	= explode('|', $this->element['default']);
		$values 	= is_array( $this->value ) ? $this->value : explode('|', $this->value);
				
		$size 		 = $this->element['size'];
		$css_class 	 = $this->element['class'];
		$labels 	 = explode('|', $this->element['labels']);
		
		if($this->element['customchrome']){
			$cChrome 	 = is_array( $this->element['customchrome'] ) ? $this->element['customchrome'] : explode('|', $this->element['customchrome']);
		}
		
		
		$unique_id 	 = $this->element['name'];
		$turnof		 = $this->element['turnof'];
		$turnoflabel = $this->element['turnoflabel'];
		
		
		if ($turnof == 1){
			$disableme 		= 'disabled="disabled';
			$disabletext	= '<div class="disabled_text">'.$turnoflabel.'</div>';
		}else{
			$disableme		= '';
			$disabletext	= '';
		}
		
		$chk_name 			= str_replace($this->element['name'], $this->element['name'].'_locked', $this->name).'[]';
		
		// create input text elements
        $div 				= array(); 
		$new_div			= array();
		
		$yjsg 				= Yjsg::getInstance();
		$app				= JFactory::getApplication();
		$templateId 		= $app->input->get( 'id' );
		$YjsgDbParams		= json_decode( $yjsg->getDbParams( $templateId ), true );


		 
		for ( $i=0; $i < $items; $i++ ){	
		
			$div[$i]   = array();
			$div[$i][] = '<label for="'.$labels[$i].'">'.$labels[$i].'</label>';		
			$div[$i][] = '<input type="text" id="'.$labels[$i].'" class="input-mini '.$unique_id.'" name="'.$this->name.'[]" value="'.( isset($values[$i]) ? $values[$i] : $default[$i] ).'" size="'.$size.'" '.$disableme.'/>';		
			
			if( array_key_exists( ($i+$items), $values ) )
				$checked = $values[$i+$items] == 1 ? 'checked="checked"' : '';			
			else 
				$checked = '';
				
				
				
			$chormeName = strtolower($labels[$i]).'_custom_chrome';
			
			if($this->element['customchrome']){
				if(array_key_exists($chormeName, $YjsgDbParams)){
					
					
					$chromeDefault =  $YjsgDbParams[$chormeName];
					
				}else{
					
					$chromeDefault = $cChrome[$i];
					
				}
			}

			if($this->element['customchrome']){

				$chromeInput[] ='<input type="hidden" class="defChromes" name="jform[params]['.$chormeName.']" id="'.strtolower($labels[$i]).'_custom_chrome" data-default="'.$cChrome[$i].'" value="'.$chromeDefault.'" />';
				$chromeModule[]  = 	$chormeName;
				$chromeDataDef[] =  $cChrome[$i];
			}


			$div[$i][] = '<div class="yjsgcheck check '.$unique_id.'">';
			$div[$i][] ='<label>';
			$div[$i][] ='<input type="checkbox" name="'.$chk_name.'" class="YJSG_checkbox '.$unique_id.' hidden" '.$checked.' />';
			$div[$i][] ='<i class="fa fa-unlock"></i>';
			$div[$i][] ='</label>';
			$div[$i][] ='</div>';
		}

		foreach($div as $div_row => $div_value){

			$new_div[] = '<div class="yjsg_moduleh groupname">';
			if($this->element['customchrome']){
				
				$new_div[] ='<a href="#" class="openChrome" data-chromedefault="'.$chromeDataDef[$div_row].'" data-chromemodule="#'.$chromeModule[$div_row].'">';
				$new_div[] ='<i class="adminicons-chrome"></i>';
				$new_div[] ='</a>';					
				$new_div[] ='<div class="chromesHolder"  data-toggle="popover" data-placement="bottom" data-original-title="'.JText::_('YJSG_MOD_CHROME').'" data-content="'.JText::_('YJSG_MOD_CHROME_TIP').'">';
				$new_div[] ='<a href="#" data-thischrome="YJsgxhtml" class="seldefault">'.JText::_('YJSG_DEFAULT').' <i class="fa fa-check-square-o"></i></a>';
				$new_div[] ='<a href="#" data-thischrome="YJsground">'.JText::_('YJSG_MOD_CHROME_ROUND_NAV').' <i class="fa fa-square-o"></i></a>';
				$new_div[] ='<a href="#" data-thischrome="YJsgblank">'.JText::_('YJSG_MOD_CHROME_BLANK_NAV').' <i class="fa fa-square-o"></i></a>';
				$new_div[] ='<a href="#" data-thischrome="YJsgtabs">'.JText::_('YJSG_MOD_CHROME_TABS').' <i class="fa fa-square-o"></i></a>';
				$new_div[] ='<a href="#" data-thischrome="YJsgaccordion">'.JText::_('YJSG_MOD_CHROME_ACCORDION').' <i class="fa fa-square-o"></i></a>';
				$new_div[] ='<a href="#" data-thischrome="YJsgslides">'.JText::_('YJSG_MOD_CHROME_SLIDES').' <i class="fa fa-square-o"></i></a>';
				$new_div[] = $chromeInput[$div_row];
				$new_div[] ='</div>';
			}
			$new_div[] ='<div class="yjsg_module">';
			$new_div[] =implode("\n", $div_value);
			$new_div[] ='</div>';
			$new_div[] ='</div>';

		}

		
		$yjsglayoutarray = json_decode(YJSGLAYOUT);
		
		$setdivid = $unique_id;
		$divClass = ' class="yjsg_grid yjsg_grid_widths yjsgorder"';
		$dataPosition = '';
		
		if(strstr($this->element['name'],'newgrid')){
			$newGridCase = $this->element['name'];
			$newGridName = str_replace(array('yjsg_','_width'),array('',''),$this->element['name']);
		}else{
			$newGridName ='fakeGrid';
			$newGridCase ='fakeGrid';
		}
		
		$findZero = explode('|',$this->element['default']);
		$hasZero = false;
		if(in_array('0',$findZero)){
			
			$hasZero = true;
		}
		
		switch ($unique_id) {
			case 'yjsg_1_width':
				$dataPosition = ' data-position="'.array_search('yjsg1', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case 'yjsg_header_width':
				$dataPosition = '';
				$setdivid='yjsg_headergrid';
				$divClass=' class="yjsg_grid_widths"';
				break;
			case 'yjsg_bodytop_width':
				$dataPosition = '';
				$setdivid='yjsg_bodytop';
				$divClass = ' class="yjsg_grid_widths jmainbodygrid"';
				break;
			case 'yjsg_yjsgbodytbottom_width':
				$dataPosition = '';
				$setdivid='yjsg_bodybottom';
				$divClass = ' class="yjsg_grid_widths jmainbodygrid"';
				break;
			case 'yjsg_2_width':
				$dataPosition = ' data-position="'.array_search('yjsg2', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case 'yjsg_3_width':
				$dataPosition = ' data-position="'.array_search('yjsg3', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case 'yjsg_4_width':
				$dataPosition = ' data-position="'.array_search('yjsg4', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case 'yjsg_5_width':
				$dataPosition = ' data-position="'.array_search('yjsg5', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case 'yjsg_6_width':
				$dataPosition = ' data-position="'.array_search('yjsg6', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case 'yjsg_7_width':
				$dataPosition = ' data-position="'.array_search('yjsg7', $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('yjsg',''),$setdivid);
				break;
			case $newGridCase:
				$dataPosition = ' data-position="'.array_search($newGridName, $yjsglayoutarray).'"';
				$setdivid = str_replace(array('yjsg_','_width'),array('',''),$setdivid);
				break;

		}

		$output ='<div id="'.$setdivid.'"'.$dataPosition.$divClass.'>';
//		$output.='<a href="javascript:;" class="opensettings" data-settings=".'.$setdivid.'_settings"><i class="fa fa-cog"></i></a>';
//		$output.='<div class="'.$setdivid.'_settings settingpannel">';
//		$output .='<ul class="adminformlist gridSetting">';
//		$output .='</ul>';
//		$output.='</div>';
		$output.= implode("\n", $new_div);
		$output .='';
		$output .='';
		$output .='';
		$output .='<a class="YJSG_reset-values btn btn-xs btn-primary" data-elementcss="'.$unique_id.'" href="javascript:;" data-resets="'.$this->element['default'].'">'.Jtext::_('YJSG_RESET').'</a>';
		$output .='</div>';
		
		return $output; 		
	}	
	
}