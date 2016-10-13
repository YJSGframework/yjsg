<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
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