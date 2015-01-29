<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
/*check if grids are present*/
$yjsg1_loaded 				= false;
$yjsg_header_loaded 		= false;
$yjsg2_loaded 				= false;
$yjsg3_loaded 				= false;
$yjsg_bodytop_loaded 		= false;
$yjsg_bodybottom_loaded 	= false;
$yjsg4_loaded 				= false;
$yjsg5_loaded 				= false;
$yjsg6_loaded 				= false;
$yjsg7_loaded 				= false;
$yjsgTopPanel_loaded		= false;
$yjsgBotPanel_loaded 		= false;

//yjsg1
for( $i=1; $i<=5; $i++ ){
	$mods_yjsg1 	= $this->countModules('top'.$i);
	if( $mods_yjsg1){
		$yjsg1_loaded = true;
		break;
	}
}
//header grid
for( $i=1; $i<=5; $i++ ){
	$mods_yjsg_header 	= $this->countModules('header'.$i);
	if( $mods_yjsg_header){
		$yjsg_header_loaded = true;
		break;
	}
}
//yjsg2
for( $i=1; $i<=5; $i++ ){
	$mods_yjsg2 	= $this->countModules('adv'.$i);
	if( $mods_yjsg2){
		$yjsg2_loaded = true;
		break;
	}
}
//yjsg3
for( $i=1; $i<=5; $i++ ){
	$mods_yjsg3 	= $this->countModules('user'.$i);
	if( $mods_yjsg3){
		$yjsg3_loaded = true;
		break;
	}
}
//bodybottom
for( $i=1; $i<=5; $i++ ){
	$mods_yjsg_bodybottom 	= $this->countModules('bodybottom'.$i);
	if( $mods_yjsg_bodybottom){
		$yjsg_bodybottom_loaded = true;
		break;
	}
}
//bodytop
for( $i=1; $i<=5; $i++ ){
	$mods_yjsg_bodytop 	= $this->countModules('bodytop'.$i);
	if( $mods_yjsg_bodytop){
		$yjsg_bodytop_loaded = true;
		break;
	}
}
//yjsg4
for( $i=6; $i<=10; $i++ ){
	$mods_yjsg4 	= $this->countModules('user'.$i);
	if( $mods_yjsg4){
		$yjsg4_loaded = true;
		break;
	}
}
//yjsg5
for( $i=11; $i<=15; $i++ ){
	$mods_yjsg5 	= $this->countModules('user'.$i);
	if( $mods_yjsg5){
		$yjsg5_loaded = true;
		break;
	}
}
//yjsg6
for( $i=16; $i<=20; $i++ ){
	$mods_yjsg6 	= $this->countModules('user'.$i);
	if( $mods_yjsg6){
		$yjsg6_loaded = true;
		break;
	}
}
//yjsg7
for( $i=21; $i<=25; $i++ ){
	$mods_yjsg7 	= $this->countModules('user'.$i);
	if( $mods_yjsg7){
		$yjsg7_loaded = true;
		break;
	}
}
//top panel
for( $i=1; $i<=5; $i++ ){
	$mods_yjsgtoppanel 	= $this->countModules('tpan'.$i);
	if( $mods_yjsgtoppanel){
		$yjsgTopPanel_loaded = true;
		break;
	}
}
//bottom panel
for( $i=1; $i<=5; $i++ ){
	$mods_yjsgbotpanel 	= $this->countModules('bpan'.$i);
	if( $mods_yjsgbotpanel){
		$yjsgBotPanel_loaded = true;
		break;
	}
}
/* load grids */


function yjsg_print_grid_area($yjsg_grid_name,$add_width =false,$before ='',$after='', $echo = true ){
    
	global  $clonedPageId;
	
    $document 			= JFactory::getDocument();
	$app   				=  JFactory::getApplication();
	$bootstrapVersion	= $document->params->get('bootstrap_version');
	$header_grid_width = false;
	  switch ($yjsg_grid_name) {
		  case 'yjsg1':
			  $prefixes = 'top';
			  $maxmods	= 5;
			  $start_key= 1;
			  $get_w_param ='yjsg_1_width';
			  $get_m_style ='YJsg1_module_style';
			  break;
		  case 'yjsgheadergrid':
			  $prefixes = 'header';
			  $maxmods	= 3;
			  $start_key= 1;
			  $get_w_param ='yjsg_header_width';
			  $get_m_style ='YJsgh_module_style';
			  break;
		  case 'yjsg2':
			  $prefixes = 'adv';
			  $maxmods	= 5;
			  $start_key= 1;
			  $get_w_param ='yjsg_2_width';	
			  $get_m_style ='YJsg2_module_style';		  
			  break;
		  case 'yjsg3':
			  $prefixes = 'user';
			  $maxmods	= 5;
			  $start_key= 1;
			  $get_w_param ='yjsg_3_width';
			  $get_m_style ='YJsg3_module_style';			  
			  break;
		  case 'yjsgbodytop':
			  $prefixes = 'bodytop';
			  $maxmods	= 3;
			  $start_key= 1;
			  $get_w_param ='yjsg_bodytop_width'.$clonedPageId;
			  $get_m_style ='YJsgmt_module_style';		  
			  break;
		  case 'yjsgbodybottom':
			  $prefixes = 'bodybottom';
			  $maxmods	= 3;
			  $start_key= 1;
			  $get_w_param ='yjsg_yjsgbodytbottom_width'.$clonedPageId;
			  $get_m_style ='YJsgmb_module_style';			  
			  break;
		  case 'yjsg4':
			  $prefixes = 'user';
			  $maxmods	= 5;
			  $start_key= 6;
			  $get_w_param ='yjsg_4_width';
			  $get_m_style ='YJsg4_module_style';		  
			  break;
		  case 'yjsg5':
			  $prefixes = 'user';
			  $maxmods	= 5;
			  $start_key= 11;
			  $get_w_param ='yjsg_5_width';	
			  $get_m_style ='YJsg5_module_style';		  
			  break;
		  case 'yjsg6':
			  $prefixes = 'user';
			  $maxmods	= 5;
			  $start_key= 16;
			  $get_w_param ='yjsg_6_width';
			  $get_m_style ='YJsg6_module_style';			  
			  break;
		  case 'yjsg7':
			  $prefixes = 'user';
			  $maxmods	= 5;
			  $start_key= 21;
			  $get_w_param ='yjsg_7_width';
			  $get_m_style ='YJsg7_module_style';		  
			  break;
			  
		  case 'toppanel':
			  $prefixes = 'tpan';
			  $maxmods	= 5;
			  $start_key= 1;
			  $get_w_param ='yjsg_toppanel_width';
			  $get_m_style ='toppanel_module_style';		  
			  break;
			  
		  case 'botpanel':
			  $prefixes = 'bpan';
			  $maxmods	= 5;
			  $start_key= 1;
			  $get_w_param ='yjsg_botpanel_width';
			  $get_m_style ='botpanel_module_style';		  
			  break;
			  		
		  case (strstr($yjsg_grid_name,'yjsgName')):
			  $gridKeys 		= explode('|',$yjsg_grid_name);
			  $gridName 		= explode('=',$gridKeys[0]);
			  $gridModName 		= explode('=',$gridKeys[1]);
			  $prefixes 		= $gridModName[1];
			  $maxmods			= 5;
			  $start_key		= 1;
			  $get_w_param 		='yjsg_'.$gridName[1].'_width';
			  $get_m_style 		=$gridName[1].'_module_style';	
			  break;
			  default;

	  }
	
	$YJ_modules = array();
	$YJ_max_modules = $maxmods;
	$YJ_module_prefix = $prefixes;
	$YJ_starting_key = $start_key;
	
	$gridWidths = $document->params->get( $get_w_param );
	
	if (is_array($gridWidths)) {
   		
		$grid_widths = $gridWidths;
		
	}else if(empty($gridWidths)){
		
		$grid_widths = explode('|','20|20|20|20|20');
		
	}else{
		
		$grid_widths = explode('|', $gridWidths);
	}
	
	
	$module_style = $document->params->get( $get_m_style );
	
	$k = 0;
	for( $i = $YJ_starting_key; $i < $YJ_max_modules + $YJ_starting_key; $i++ ){	
		
		$mod_name = $YJ_module_prefix.$i;
		if ( $document->countModules( $mod_name ) && array_key_exists($k, $grid_widths) ){
			
			$width = $grid_widths[$k];
			if( is_numeric( $width ) && $width > 0 )
				$YJ_modules[$i] = $width;	
			
		}	
		$k++;	
	}
	$total_size = array_sum( $YJ_modules );
	if( $total_size < 100 && $YJ_modules ){
		
		$remaining_size = 100 - $total_size;
		foreach ( $YJ_modules as $k=>$module ){
			
			$percent = $module / $total_size;
			$YJ_modules[$k] = number_format( $module + $remaining_size * $percent, 2);
			
		}	
	}
	
	$check_size = array_sum( $YJ_modules );
	if( $check_size > 100 && $YJ_modules ){
		$ratio = ($check_size-100)/100;
		if( $ratio > 1 ){
			foreach ( $YJ_modules as $k=>$m ){
				$YJ_modules[$k] = $m/$ratio;			
			}	
			$check_size = array_sum( $YJ_modules );		
		}
		
		$plus_size = ($check_size - 100) / count( $YJ_modules );
		foreach ( $YJ_modules as $k=>$m ){
			$final_size = $m - $plus_size;
			if( $final_size < 1 ){
				unset( $YJ_modules[$k] );
				continue;
			}	
			$YJ_modules[$k] = $final_size;
		}
	}
    
// print grids
	if(!empty($YJ_modules)){
		if($add_width && $yjsg_grid_name !='yjsgheadergrid'){
			$add_width = ' yjsgsitew';
		}else if($yjsg_grid_name == 'yjsgheadergrid'){
			$add_width = ' yjsgheadergw';
		}else{
			$add_width ='';
		}

		if(strstr($yjsg_grid_name,'yjsgName')){
					 $gridKeys 		= explode('|',$yjsg_grid_name);
					 $gridName 		= explode('=',$gridKeys[0]);
					 $gridDivName	= $gridName[1];
		}else{
					$gridDivName	= $yjsg_grid_name;
		}
		
		$grid_suffix		= array();
		
		$html = '<div id="'.$gridDivName.'" class="yjsg_grid'.$add_width.'">';
		
		  
		  

		  $cm = 1;
		  
		  foreach ($YJ_modules as $k=>$mod_width){ 
		  		
				  $firstLast = '';
				  $allLast	 = '';
				  $clearRow  = '';
				  if((count($YJ_modules) == 5 && $cm == 5) || (count($YJ_modules) == 3 && $cm == 3)){
					  $firstLast = ' last_mod';
					 
				  }elseif(count($YJ_modules) == 1){
						 
						  $firstLast = ' only_mod';
						  
				  }elseif(count($YJ_modules) > 1 && $cm == 1){
						 
						  $firstLast = ' first_mod';
						  
				  }
				  
				  if(count($YJ_modules) == 4 && $cm  == 3){
						 
						  $clearRow = ' yjsgclearrow';
						  
				  }
				  
				  if(count($YJ_modules) > 1 && $cm  == count($YJ_modules)){
						 
						  $allLast = ' lastModule';
				  }

				  				  
		          $cm++;
			//echo 	$clonedPageId;
			
			$modCustomChrome 		= $document->params->get($YJ_module_prefix.$k.'_custom_chrome');
			
			// if page is cloned, new itemid is assigned to chromes params
			if($document->params->get($YJ_module_prefix.$k.'_custom_chrome'.$clonedPageId)){
				
				$modCustomChrome 	= $document->params->get($YJ_module_prefix.$k.'_custom_chrome'.$clonedPageId);
				
			}
			
			$mod_name 			= $YJ_module_prefix.$k; 
			
			
			
			$getmodule	 		= JModuleHelper::getModules($mod_name);
        	$moduleParams 		= new JRegistry();
        	$moduleParams->loadString($getmodule[0]->params);
        	$module_float		= $moduleParams->get('module_float');
			$module_floatwidth	= $moduleParams->get('module_floatwidth');
			$module_suffix		= $moduleParams->get('moduleclass_sfx');
			$yjsg_module_style	= $moduleParams->get('yjsg_module_style','default');
			$tabs_suffix		= '';
			$accordion_suffix	= '';
			$slider_suffix		= '';
			
			
			// yjsg suffix
			if($yjsg_module_style !='default' && empty($module_suffix)){
				
				$module_suffix = $yjsg_module_style;
			}
			
			if(!empty($module_suffix)){

				$tabs_suffix		= ' tabssfx-yjsgsfx-'.trim($module_suffix);
				$accordion_suffix	= ' accordionsfx-yjsgsfx-'.trim($module_suffix);
				$slider_suffix		= ' slidersfx-yjsgsfx-'.trim($module_suffix);
				$grid_suffix	    []= ' gridsfx-'.trim($module_suffix);				
				$module_suffix 		= ' yjsgsfx-'.trim($module_suffix);

			}

			if(($module_float == 'right' || $module_float == 'left') && !empty($module_floatwidth)){
				
				global $text_direction;
				if($text_direction == 1){
					
					if($module_float == 'right'){
						
						$swith_float = 'left';
					}
					
					if($module_float == 'left'){
						
						$swith_float = 'right';
					}
					
					$module_float = $swith_float;
				}
				
				$document->addStyleDeclaration('#'.$mod_name.'.yjsgxhtml{float:'.$module_float.';width:'.$module_floatwidth.';}');
				
			}else{
				
				$document->addStyleDeclaration('#'.$mod_name.'.yjsgxhtml{width:'.$mod_width.'%;}');
				
			}

			
		
			if( !$mod_width ) continue;
			
			
			$customGroups = array('YJsgtabs','YJsgaccordion','YJsgslides');
			
			if($modCustomChrome && in_array($modCustomChrome,$customGroups) && !$app->input->getBool('modulepositions')){
				
				$customChromeId  	= strtolower($modCustomChrome).$mod_name;
				$customChromeClass  = strtolower($modCustomChrome).'_chrome_'.$mod_name.' yjsg'.$bootstrapVersion.' ';
				$customChromeAction = strtolower($modCustomChrome).'_chromeaction';
				
				$modPoz 			= array($mod_name);
				$YJsgxhtml 			= false;
				$YJsground 			= false;
				$YJsgplain 			= false;
				$YJsgtabs 			= false;
				$YJsgaccordion 		= false;
				$YJsgslides 		= false;

				
				foreach($modPoz as $mkey => $modChrome){
			
					$customChrome 		= JModuleHelper::getModules($modChrome); 
					$buildMenu			= array();
					$buildTabs			= array();
					$buildAccordion		= array();
					$buildSlider		= array();
					$buildNavs			= array();

					
					
					foreach($customChrome as $ckey =>  $moduleChrome){
						
						
						$printAttr['style'] = 'Yjsgxhtml'; 

						
						
						$printModule = JModuleHelper::renderModule($moduleChrome,$printAttr);
						if($ckey == 0){
						
							$firstOne =' active';
						}else{
							$firstOne='';
						}
						
						
						switch ($modCustomChrome) {
							case "YJsgtabs":
								$YJsgtabs	= true;
								$buildTabs [] ='<div class="yjsgsliderSlide">';
								$buildTabs [].=$printModule;
								$buildTabs [].='</div>';
								$buildMenu []='<li class="getslide '.$firstOne.'"  data-getslide="'.$ckey.'">';
								$buildMenu [].='<a class="tabbutton">';
								$buildMenu [].=$moduleChrome->title;
								$buildMenu [].='</a>';
								$buildMenu [].='</li>';								
								break;
							case "YJsgaccordion":
								$YJsgaccordion	= true;
								$buildAccordion [].='<div class="yjsgaccGroup">';
								$buildAccordion [].='<div class="yjsgaccTrigger'.$firstOne.'">';
								$buildAccordion [].='<a href="#">'.$moduleChrome->title.'</a>';
								$buildAccordion [].='</div>';
								$buildAccordion [].='<div class="yjsgaccContent">';
								$buildAccordion [].=$printModule;
								$buildAccordion [].='</div>';
								$buildAccordion [].='</div>';
								break;
							case "YJsgslides":
								$YJsgslides	= true;
								$buildSlider [] ='<div class="yjsgsliderSlide">';
								$buildSlider [].=$printModule;
								$buildSlider [].='</div>';
								break;

						}
						
						
						
					}
					
				}
				
				
				// tabs or pills
				if($YJsgtabs){
					$html .='<div id="'.$mod_name.'" class="'.$customChromeClass.'yjsgxhtml'.$firstLast.$clearRow.$allLast.$tabs_suffix.'">';	
					require( YJSG_MODULE_TABS );
					$html .='</div>';
				}
				
				// accordion
				if($YJsgaccordion){
					$html .='<div id="'.$mod_name.'" class="'.$customChromeClass.'yjsgxhtml'.$firstLast.$clearRow.$allLast.$accordion_suffix.'">';	
					require( YJSG_MODULE_ACCORDION );
					$html .='</div>';
				}

				// slider 
				if($YJsgslides){
					$html .='<div id="'.$mod_name.'" class="'.$customChromeClass.'yjsgxhtml'.$firstLast.$clearRow.$allLast.$slider_suffix.'">';
					require( YJSG_MODULE_SLIDER );
					$html .='</div>';
				}

				
			}else{
				
				if(empty($modCustomChrome)){
					$modCustomChrome ='YJsgxhtml';
				}
				
				$html .='<div id="'.$mod_name.'" class="yjsgxhtml'.$firstLast.$clearRow.$allLast.$module_suffix.'">';
				$html .='<jdoc:include type="modules" name="'.$mod_name.'" style="'.$modCustomChrome.'" />';
				$html .='</div>';
				
			}
			

			
		  }
		$html .= '</div>';
		
		if(!empty($grid_suffix)){
			
			$add_grid_suffix = implode('',$grid_suffix);
			$html = str_replace('yjsg_grid','yjsg_grid'.$add_grid_suffix,$html);
			
		}
		

		if( $echo ){
		  echo $before.$html.$after;
		}else{
		  return $before.$html.$after;
		}
		
	}else{
		return;
	}

}