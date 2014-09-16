<?php 
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
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
	$insettop    = 100 - $midblock.$widthdefined;
	
}elseif ( $left && $right) {
    $insetdevide = $insetcolumn /2;
	$leftblock   = $leftcolumn+$insetdevide.$widthdefined;
	$midblock    = $maincolumn.$widthdefined;
	$rightblock  = $rightcolumn+$insetdevide.$widthdefined;
	$insettop    = 100 - $midblock.$widthdefined;
	
	
}elseif ( $left && $inset) {
	$leftblock   = $leftcolumn.$widthdefined;
	$midblock    = $maincolumn+$insetcolumn.$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = 100 - $midblock.$widthdefined;
	
}elseif ( $right && $inset) {
	$rightblock  = $rightcolumn.$widthdefined;
	$midblock    = $maincolumn+$insetcolumn.$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined;
	$insettop    = 100 - $midblock.$widthdefined;
	
}elseif ( $left) {
	$midblock   = $maincolumn + $rightcolumn + $insetcolumn.$widthdefined;
	$leftblock  = $leftcolumn.$widthdefined ;
	$insettop    = 100 - $midblock.$widthdefined;
	
}elseif ( $right) {
	$midblock    = $maincolumn + $leftcolumn + $insetcolumn.$widthdefined;
	$rightblock  = $rightcolumn.$widthdefined ;
	$insettop    = 100 - $midblock.$widthdefined;

}elseif ( $inset) {
	$midblock    = $maincolumn + $rightcolumn + $leftcolumn.$widthdefined;
	$insetblock  = $insetcolumn.$widthdefined ;
	$insettop    = 100 - $midblock.$widthdefined;

} else {
    $midblock    = $leftcolumn + $rightcolumn + $maincolumn + $insetcolumn.$widthdefined;
	$insettop    ='0'.$widthdefined;
	}
	
	
// divide among yourself if component is off and no bodytop bodybottom
if((!$yjsg_bodytop_loaded || !$yjsg_bodybottom_loaded)){
	if ( $left  &&  $right && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = $midblock /3;
		$leftblock   = $leftcolumn+$devide .$widthdefined;
		$midblock    = '0'.$widthdefined;
		$rightblock  = $rightcolumn+$devide .$widthdefined;
		$insetblock  = $insetcolumn+$devide .$widthdefined;
		$insettop    = 100 - $midblock.$widthdefined;
		
	}elseif  ( $left && $right && $turn_component_off == 1 ) {
		
		$devide		 = $midblock /2;
		$midblock    = '0'.$widthdefined;
		$leftblock   = $leftcolumn+$devide .$widthdefined;
		$rightblock  = $rightcolumn+$devide .$widthdefined;
		$insettop    = 100 - $midblock.$widthdefined;
		
	}elseif ( $right && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = $midblock /2;
		$midblock    = '0'.$widthdefined;
		$rightblock  = $rightcolumn+$devide .$widthdefined;
		$insetblock  = $insetcolumn+$devide .$widthdefined;
		$insettop    = 100 - $midblock.$widthdefined;
		
	}elseif  ( $left && $inset && $turn_component_off == 1 ) {
		
		$devide 	 = $midblock /2;
		$midblock    = '0'.$widthdefined;
		$leftblock   = $leftcolumn+$devide .$widthdefined;
		$insetblock  = $insetcolumn+$devide .$widthdefined;
		$insettop    = 100 - $midblock.$widthdefined;
		
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