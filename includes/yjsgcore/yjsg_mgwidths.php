<?php 
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// mainbody grid widths
defined( '_JEXEC' ) or die( 'Restricted index access' );
	$leftblock   = '';
	$midblock    = '';
	$rightblock  = '';
	$insetblock  = '';
	$insettop    = '';

if ( $left  &&  $right && $inset ) {	
	$leftblock   = $leftcolumn.$widthdefined;
	$midblock    = $maincolumn.$widthdefined;
	$rightblock  = $rightcolumn.$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = (100 - (float)$midblock).$widthdefined;
	
}elseif ( $left && $right) {
    $insetdevide = (float)$insetcolumn /2;
	$leftblock   = ( (float)$leftcolumn + (float)$insetdevide ).$widthdefined;
	$midblock    = $maincolumn.$widthdefined;
	$rightblock  = ( (float)$rightcolumn + (float)$insetdevide).$widthdefined;
	$insettop    = (100 - (float)$midblock).$widthdefined;
	
	
}elseif ( $left && $inset) {
	$leftblock   = $leftcolumn.$widthdefined;
	$midblock    = ( (float)$maincolumn + (float)$insetcolumn ).$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = (100 - (float)$midblock).$widthdefined;
	
}elseif ( $right && $inset) {
	$rightblock  = $rightcolumn.$widthdefined;
	$midblock    = ( (float)$maincolumn + (float)$insetcolumn ).$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = (100 - (float)$midblock).$widthdefined;
	
}elseif ( $left) {
	$midblock   = ( (float)$maincolumn + (float)$rightcolumn + (float)$insetcolumn ).$widthdefined;
	$leftblock  = $leftcolumn.$widthdefined ;
	$insettop    = (100 - (float)$midblock).$widthdefined;
	
}elseif ( $right) {
	$midblock    = ( (float)$maincolumn + (float)$leftcolumn + (float)$insetcolumn ).$widthdefined;
	$rightblock  = $rightcolumn.$widthdefined ;
	$insettop    = (100 - (float)$midblock).$widthdefined;

}elseif ( $inset) {
	$midblock    = ( (float)$maincolumn + (float)$rightcolumn + (float)$leftcolumn ).$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined ;
	$insettop    = (100 - (float)$midblock).$widthdefined;

} else {
    $midblock    = ( (float)$leftcolumn + (float)$rightcolumn + (float)$maincolumn + (float)$insetcolumn ).$widthdefined;
	$insettop    ='0'.$widthdefined;
	}
	
	
// divide among yourself if component is off and no bodytop bodybottom
if((!$yjsg_bodytop_loaded || !$yjsg_bodybottom_loaded)){
	if ( $left  &&  $right && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = (float)$midblock /3;
		$leftblock   = ( (float)$leftcolumn+(float)$devide ).$widthdefined;
		$midblock    = '0'.$widthdefined;
		$rightblock  = ( (float)$rightcolumn+(float)$devide ).$widthdefined;
		$insetblock  = ( (float)$insetcolumn+(float)$devide ).$widthdefined;
		$insettop    = (100 - (float)$midblock).$widthdefined;
		
	}elseif  ( $left && $right && $turn_component_off == 1 ) {
		
		$devide		 = (float)$midblock /2;
		$midblock    = '0'.$widthdefined;
		$leftblock   = ( (float)$leftcolumn + (float)$devide ).$widthdefined;
		$rightblock  = ( (float)$rightcolumn + (float)$devide ).$widthdefined;
		$insettop    = (100 - (float)$midblock).$widthdefined;
		
	}elseif ( $right && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = (float)$midblock /2;
		$midblock    = '0'.$widthdefined;
		$rightblock  = ( (float)$rightcolumn + (float)$devide ).$widthdefined;
		$insetblock  = ( (float)$insetcolumn + (float)$devide ).$widthdefined;
		$insettop    = (100 - (float)$midblock).$widthdefined;
		
	}elseif  ( $left && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = (float)$midblock /2;
		$midblock    = '0'.$widthdefined;
		$leftblock   = ( (float)$leftcolumn + (float)$devide ).$widthdefined;
		$insetblock  = ( (float)$insetcolumn + (float)$devide ).$widthdefined;
		$insettop    = (100 - (float)$midblock).$widthdefined;
		
	}elseif ( $left && $turn_component_off == 1 ) {
	
		$midblock    = '0'.$widthdefined;
		$leftblock   = '100'.$widthdefined;
		$insettop    = '100'.$widthdefined;
	}elseif ( $right && $turn_component_off == 1 ) {
	
		$midblock    = '0'.$widthdefined;
		$rightblock  = '100'.$widthdefined;
		$insettop    = '100'.$widthdefined;
	}elseif ( $inset && $turn_component_off == 1 ) {
	
		$midblock    = '0'.$widthdefined;
		$insetblock  = '100'.$widthdefined;
		$insettop    = '100'.$widthdefined;
	}
}
?>