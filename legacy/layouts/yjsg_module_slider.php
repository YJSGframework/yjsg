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
defined( '_JEXEC' ) or die( 'Restricted index access' );
//
$navigation 	= $document->params->get('slider_navigation_'.$mod_name.$clonedPageId.'');
$pagination 	= $document->params->get('slider_pagination_'.$mod_name.$clonedPageId.'');

if(!$navigation && !$pagination){

	$navigation 	= $document->params->get('slider_navigation_'.$mod_name.'');
	$pagination 	= $document->params->get('slider_pagination_'.$mod_name.'');
	
}

$html .='<div class="yjsgModsChrome">';
$html .='<div id="yjsgsliderHolder'.$mod_name.'" class="yjsgsliderHolder">';
$html .='<div id="yjsgsliderChrome_'.$mod_name.'" class="yjsgsliderChrome yjsgChromes">';
$html .=implode($buildSlider);
$html .='</div>';
// controls
$html .='<div class="yjsgsliderControls">';
if($navigation == 1){
	$html .='<a class="yjsgsliderNav getslide prev" href="#" data-getslide="prev">';
	$html .='<i></i>';
	$html .='</a>';
	$html .='<a class="yjsgsliderNav getslide next" href="#" data-getslide="next">';
	$html .='<i></i>';
	$html .='</a>';
}
if($pagination == 1){
	$html .='<ul class="yjsgsliderPagination"></ul>';
}
$html .='</div>';
// end controls
$html .='<div class="yjsgsliderLoader"></div>';
$html .='</div>';
$html .='</div>';
