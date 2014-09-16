<?php
defined('_JEXEC') or die('Restricted access');
/**
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * three arguments.
 */
/**
 * Custom module chrome, echos the whole module in a <div> and the header in <h{x}>. The level of
 * the header can be configured through a 'headerLevel' attribute of the <jdoc:include /> tag.
 * Defaults to <h2> if none given
 */
 /* usable module chromes
 
 YJsghtml  = square mods  2 divs 
 YJsground = round mods  adding class addround
 Yjsgplain = square mods , no title no additional divs
 
  */
 // DEFAULT SQUARE


function modChrome_YJsgxhtml($module, &$params, &$attribs){
	
	$title 						= $module->title;
	$module_suffix_class		= htmlspecialchars($params->get('moduleclass_sfx'));
	$module_icon_prefix			= $params->get('module_icon_prefix','');
	$module_icon_suffix			= $params->get('module_icon_suffix','');
	$print_module_icon_prefix 	='';
	$print_module_icon_suffix 	='';
	$bootstrap_size 			= $params->get('bootstrap_size','');
	$bootstrap_size_class		='';
	$module_tag 				= $params->get('module_tag','div');
	$header_tag 				= $params->get('header_tag','h2');
	$header_class				= $params->get('header_class','');
	$module_subtitle			= $params->get('module_subtitle','');
	$print_module_subtitle		= '';
	$header_subtitle_class		= '';
	$moduleid					= ' modid'.$module->id;
	$yjsg_module_style			= $params->get('yjsg_module_style','default');
	$yjsg_suffix_class			='';
	
	// yjsg suffix
	if($yjsg_module_style !='default'){
		
		$yjsg_suffix_class =' '.$yjsg_module_style;
	}
		
	// suffix
	if(!empty($module_suffix_class)){
		
		$module_suffix_class =' '.$module_suffix_class;
	}
	
	// header class
	if(!empty($header_class)){
		
		$header_class =' '.$header_class;
	}

	// bootstrap size
	if($bootstrap_size !=0){
	
		$bootstrap_size_class = ' span'.$bootstrap_size.'';
	}
	
	// icons
	if(!empty($module_icon_prefix)){
		
		$print_module_icon_prefix			= '<span class="'.$module_icon_prefix.'"></span> ';
		
	}
	if(!empty($module_icon_suffix)){
		
		$print_module_icon_suffix			= ' <span class="'.$module_icon_suffix.'"></span>';
		
	}
	
	// sub title
	if(!empty($module_subtitle)){
		
		$print_module_subtitle			= '<span class="module_subtitle">'.$module_subtitle.'</span>';
		$header_subtitle_class			=' has_subtitle';
		
	}
	
	// split title by space
	if(strpos($title, ' ') !== false){	
			
		$title = explode(' ', $title);
		$title = join(' ', array_map('addspan',$title, array_keys($title)));
	
	}


	// output
	$module_output  = '<'.$module_tag.' class="yjsquare'.$module_suffix_class.$yjsg_suffix_class.$bootstrap_size_class.$moduleid.'">';
	
	if ($module->showtitle){
		
		$module_output .= '<div class="h2_holder">';
		$module_output .= '<'.$header_tag.' class="module_title'.$header_class.$header_subtitle_class.'">';
		$module_output .= $print_module_icon_prefix.$title.$print_module_icon_suffix.$print_module_subtitle;
		$module_output .= '</'.$header_tag.'>';
		$module_output .= '</div>';
		
	}
	$module_output .= '<div class="yjsquare_in">';
	$module_output .= $module->content;
	$module_output .= '</div>';
	$module_output .= '</'.$module_tag.'>';
	
	
	
	//render module
	
	echo $module_output;
	
}

function modChrome_YJsground($module, &$params, &$attribs){
	
	$title 						= $module->title;
	$module_suffix_class		= htmlspecialchars($params->get('moduleclass_sfx'));
	$module_icon_prefix			= $params->get('module_icon_prefix','');
	$module_icon_suffix			= $params->get('module_icon_suffix','');
	$print_module_icon_prefix 	='';
	$print_module_icon_suffix 	='';
	$bootstrap_size 			= $params->get('bootstrap_size','');
	$bootstrap_size_class		='';
	$module_tag 				= $params->get('module_tag','div');
	$header_tag 				= $params->get('header_tag','h2');
	$header_class				= $params->get('header_class','');
	$module_subtitle			= $params->get('module_subtitle','');
	$print_module_subtitle		= '';
	$print_module_toptitle		= '';
	$header_subtitle_class		= '';
	$moduleid					= ' modid'.$module->id;
	$yjsg_module_style			= $params->get('yjsg_module_style','default');
	$yjsg_suffix_class			='';
	
	// yjsg suffix
	if($yjsg_module_style !='default'){
		
		$yjsg_suffix_class =' '.$yjsg_module_style;
	}	
		
	// suffix
	if(!empty($module_suffix_class)){
		
		$module_suffix_class =' '.$module_suffix_class;
	}
	
	// header class
	if(!empty($header_class)){
		
		$header_class =' '.$header_class;
	}

	// bootstrap size
	if($bootstrap_size !=0){
	
		$bootstrap_size_class = ' span'.$bootstrap_size.'';
	}
	
	// icons
	if(!empty($module_icon_prefix)){
		
		$print_module_icon_prefix			= '<span class="'.$module_icon_prefix.'"></span> ';
		
	}
	if(!empty($module_icon_suffix)){
		
		$print_module_icon_suffix			= ' <span class="'.$module_icon_suffix.'"></span>';
		
	}
	
	// sub title
	if(!empty($module_subtitle)){
		
		$print_module_toptitle			=' class="modtoptitle"';
		$print_module_subtitle			= '<span class="module_subtitle">'.$module_subtitle.'</span>';
		$header_subtitle_class			=' has_subtitle';
		
	}
	
	// split title by space
	if(strpos($title, ' ') !== false){	
			
		$title = explode(' ', $title);
		$title = join(' ', array_map('addspan',$title, array_keys($title)));
	
	}


	// output
	$module_output  = '<'.$module_tag.' class="yjsquare addround'.$module_suffix_class.$yjsg_suffix_class.$bootstrap_size_class.$moduleid.'">';
	
	if ($module->showtitle){
		
		$module_output .= '<div class="h2_holder">';
		$module_output .= '<'.$header_tag.' class="module_title'.$header_class.$header_subtitle_class.'">';
		$module_output .= $print_module_icon_prefix.$title.$print_module_icon_suffix.$print_module_subtitle;
		$module_output .= '</'.$header_tag.'>';
		$module_output .= '</div>';
		
	}
	$module_output .= '<div class="yjsquare_in">';
	$module_output .= $module->content;
	$module_output .= '</div>';
	$module_output .= '</'.$module_tag.'>';
	
	
	
	//render module
	
	echo $module_output;
	
}


function modChrome_YJsgplain($module, &$params, &$attribs){
	
	$bootstrap_size 			= $params->get('bootstrap_size','');
	$bootstrap_size_class		='';
	$module_tag 				= $params->get('module_tag','div');
	$moduleid					= ' modid'.$module->id;
	$module_suffix_class		= htmlspecialchars($params->get('moduleclass_sfx'));
	$yjsg_module_style			= $params->get('yjsg_module_style','default');
	$yjsg_suffix_class			='';
	
	
	
	// yjsg suffix
	if($yjsg_module_style !='default'){
		
		$yjsg_suffix_class =' '.$yjsg_module_style;
	}	
	// suffix
	if(!empty($module_suffix_class)){
		
		$module_suffix_class =' '.$module_suffix_class;
	}

	// bootstrap size
	if($bootstrap_size !=0){
	
		$bootstrap_size_class = ' span'.$bootstrap_size.'';
	}

	// output
	$module_output  = '<'.$module_tag.' class="yjplain'.$module_suffix_class.$yjsg_suffix_class.$bootstrap_size_class.$moduleid.'">';
	$module_output .= $module->content;
	$module_output .= '</'.$module_tag.'>';
	
	
	
	//render module
	
	echo $module_output;
	
}