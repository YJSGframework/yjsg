<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' ); 
	// Yjsg slider

	$sliderModule = array();
	foreach($paramsArray as $paramIndex  => $paramVal){
		
		
		if($paramVal == 'YJsgslides' || $paramVal == 'YJsgtabs'){
			
			$sliderModule[$paramIndex] = $paramVal;
		}
		
	}
	
	$YjsgSliderScript = 0;
	$YjsgSliderPrint  = array();
	
	if (!empty($sliderModule)) {
		foreach($sliderModule as $sliderToLoad  => $slideType){
			
		
			$sliderLoading 		=  str_replace('_custom_chrome','',$sliderToLoad);

			$autoslide 			= $this->params->get('slider_autoslide_'.$sliderLoading.'');
			$effectduration 	= $this->params->get('slider_effectduration_'.$sliderLoading.'');
			$effect 			= $this->params->get('slider_effect_'.$sliderLoading.'');
			$slidermodule		= $sliderLoading;
			
			if($slideType == 'YJsgslides'){
				
				$type 		= 'slider';
				$controls	='.yjsgsliderControls';
				$pagination	='.yjsgsliderPagination';
				
			}else{
				
				$type 		= 'tabs';
				$controls	='.yjsgsliderControlsTabs';
				$pagination	='.yjsgsliderPaginationTabs';
			}
	
	
			if(!empty($clonedPageId)){
				
				$slidermodule = str_replace('-itemid'.$itemid,'',$sliderLoading);
			}
			if($this->countModules($slidermodule)){
				
				$YjsgSliderPrint[]='
						(function ($) {
							$(window).load(function(){
								$("#yjsgsliderChrome_'.$slidermodule.'").yjsgSlider({
									autoslide: '.$autoslide.',
									effectduration: '.$effectduration.',
									effect: \''.$effect.'\',
									type: \''.$type.'\',
									controls: \''.$controls.'\',
									pagination: \''.$pagination.'\'
								});			
							});
						})(jQuery);	
				';

				$YjsgSliderScript = 1;
			}
		}
	}
	if($YjsgSliderScript == 1){
	
		$document->addScript(YJSG_ASSETS.'src/touchSwipe.min.js');
		$document->addScript(YJSG_ASSETS.'src/yjsg.slider.min.js');
		if(!empty($YjsgSliderPrint)){
			$yjsg_js .=implode($YjsgSliderPrint);
		}

	}