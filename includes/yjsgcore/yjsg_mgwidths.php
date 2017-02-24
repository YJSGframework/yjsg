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
	$insettop    = (100 - (int)$midblock).$widthdefined;
	
}elseif ( $left && $right) {
    $insetdevide = (int)$insetcolumn /2;
	$leftblock   = ( (int)$leftcolumn + (int)$insetdevide ).$widthdefined;
	$midblock    = $maincolumn.$widthdefined;
	$rightblock  = ( (int)$rightcolumn + (int)$insetdevide).$widthdefined;
	$insettop    = (100 - (int)$midblock).$widthdefined;
	
	
}elseif ( $left && $inset) {
	$leftblock   = $leftcolumn.$widthdefined;
	$midblock    = ( (int)$maincolumn + (int)$insetcolumn ).$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = (100 - (int)$midblock).$widthdefined;
	
}elseif ( $right && $inset) {
	$rightblock  = $rightcolumn.$widthdefined;
	$midblock    = ( (int)$maincolumn + (int)$insetcolumn ).$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = (100 - (int)$midblock).$widthdefined;
	
}elseif ( $left) {
	$midblock   = ( (int)$maincolumn + (int)$rightcolumn + (int)$insetcolumn ).$widthdefined;
	$leftblock  = $leftcolumn.$widthdefined ;
	$insettop    = (100 - (int)$midblock).$widthdefined;
	
}elseif ( $right) {
	$midblock    = ( (int)$maincolumn + (int)$leftcolumn + (int)$insetcolumn ).$widthdefined;
	$rightblock  = $rightcolumn.$widthdefined ;
	$insettop    = (100 - (int)$midblock).$widthdefined;

}elseif ( $inset) {
	$midblock    = ( (int)$maincolumn + (int)$rightcolumn + (int)$leftcolumn ).$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined ;
	$insettop    = (100 - (int)$midblock).$widthdefined;

} else {
    $midblock    = ( (int)$leftcolumn + (int)$rightcolumn + (int)$maincolumn + (int)$insetcolumn ).$widthdefined;
	$insettop    ='0'.$widthdefined;
	}
	
	
// divide among yourself if component is off and no bodytop bodybottom
if((!$yjsg_bodytop_loaded || !$yjsg_bodybottom_loaded)){
	if ( $left  &&  $right && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = (int)$midblock /3;
		$leftblock   = ( (int)$leftcolumn+(int)$devide ).$widthdefined;
		$midblock    = '0'.$widthdefined;
		$rightblock  = ( (int)$rightcolumn+(int)$devide ).$widthdefined;
		$insetblock  = ( (int)$insetcolumn+(int)$devide ).$widthdefined;
		$insettop    = (100 - (int)$midblock).$widthdefined;
		
	}elseif  ( $left && $right && $turn_component_off == 1 ) {
		
		$devide		 = (int)$midblock /2;
		$midblock    = '0'.$widthdefined;
		$leftblock   = ( (int)$leftcolumn + (int)$devide ).$widthdefined;
		$rightblock  = ( (int)$rightcolumn + (int)$devide ).$widthdefined;
		$insettop    = (100 - (int)$midblock).$widthdefined;
		
	}elseif ( $right && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = (int)$midblock /2;
		$midblock    = '0'.$widthdefined;
		$rightblock  = ( (int)$rightcolumn + (int)$devide ).$widthdefined;
		$insetblock  = ( (int)$insetcolumn + (int)$devide ).$widthdefined;
		$insettop    = (100 - (int)$midblock).$widthdefined;
		
	}elseif  ( $left && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = (int)$midblock /2;
		$midblock    = '0'.$widthdefined;
		$leftblock   = ( (int)$leftcolumn + (int)$devide ).$widthdefined;
		$insetblock  = ( (int)$insetcolumn + (int)$devide ).$widthdefined;
		$insettop    = (100 - (int)$midblock).$widthdefined;
		
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