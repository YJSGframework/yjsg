<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );


function yjsg_load_custom_chrome($mod_name,$modstyle='',$paramsArray,$thisChrome=''){

	$document			= JFactory::getDocument();
	global $clonedPageId;
	
	if(!empty($thisChrome)){
		
		$modCustomChrome 	= $thisChrome;
		
			if($thisChrome == 'YJsgslides'){
				$document->addScript(YJSGSITE_PLG_PATH.'src/touchSwipe.min.js');
				$document->addScript(YJSGSITE_PLG_PATH.'src/yjsgsite.slider.js');
			}
		
		
	}else{
		
		$modCustomChrome 	= $document->params->get($mod_name.'_custom_chrome'.$clonedPageId);
		
		
			// if page is cloned, new itemid is assigned to chromes params
			if($document->params->get($mod_name.'_custom_chrome'.$clonedPageId)){
				
				$modCustomChrome 	= $document->params->get($mod_name.'_custom_chrome'.$clonedPageId);
				
			}
		
	}
	
	$bootstrapVersion		= $document->params->get('bootstrap_version');
	
	
	
	$customGroups 			= array('YJsgtabs','YJsgaccordion','YJsgslides');
	
	
	if($modCustomChrome && in_array($modCustomChrome,$customGroups)){
		
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
		
		
		$html ='';
		
		// tabs and pills
		if($YJsgtabs){
			
			$html .='<div id="'.$mod_name.'_chrome" class="'.$customChromeClass.'">';
			require( YJSG_MODULE_TABS );																																																																																						
			$html .='</div>';
		}
		
		// accordion
		if($YJsgaccordion){
			$html .='<div id="'.$mod_name.'_chrome" class="'.$customChromeClass.'">';
			require( YJSG_MODULE_ACCORDION );
			$html .='</div>';
		}

		// slider 
		if($YJsgslides){
			$html .='<div id="'.$mod_name.'_chrome" class="'.$customChromeClass.'">';
			require( YJSG_MODULE_SLIDER );
			$html .='</div>';
		}
		
		
		$customChrome	= $html;
		
	}else{
		
		if(empty($modstyle)){
			$modstyle ='YJsgxhtml';
		}	
			
		$customChrome = '<jdoc:include type="modules" name="'.$mod_name.'" style="'.$modstyle.'" />';
	}
	
	

	
	echo $customChrome;
	
}