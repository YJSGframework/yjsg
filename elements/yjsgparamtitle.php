<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - YJSG Framework                							||
|| # Copyright (C) since 2007  Youjoomla.com. All Rights Reserved.      ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         || 
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### || 
\*======================================================================*/
// no direct access
defined('_JEXEC') or die('Restricted access');

class JFormFieldYJSGParamTitle extends JFormField 
{		
	public $type = 'YJSGParamTitle';
	
	public function getInput()
	{

		
		return '
		<div class="yjsg_param_title_holder">
			<div class="yjsg_param_title">
				<div class="yjsg_param_title_l">
				'.JText::_($this->value).'
				</div>
			</div>
		</div>
			';
	}
	
	public function getLabel() {
		return false;
	}
}