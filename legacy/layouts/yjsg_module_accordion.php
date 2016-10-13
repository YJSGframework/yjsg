<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );
$html .='<div id="'.$mod_name.'_accordion" class="yjsgaccChrome yjsgModsChrome yjsgChromes">';
$html .=implode($buildAccordion);
$html .='</div>';