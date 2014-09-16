<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Document
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * DocumentHTML class, provides an easy interface to parse and display a HTML document
 *
 * @package     Joomla.Platform
 * @subpackage  Document
 * @since       11.1
 */
class JDocumentHTML extends YjsgJDocumentHTMLDefault
{
		/**
	 * Fetch the template, and initialise the params
	 *
	 * @param   array  $params  Parameters to determine the template
	 *
	 * @return  JDocumentHTML instance of $this to allow chaining
	 *
	 * @since   11.1
	 */
	protected function _fetchTemplate($params = array())
	{
		// Check
		$directory = isset($params['directory']) ? $params['directory'] : 'templates';
		$filter = JFilterInput::getInstance();
		$template = $filter->clean($params['template'], 'cmd');
		$file = $filter->clean($params['file'], 'cmd');

		if (!file_exists($directory . '/' . $template . '/' . $file))
		{
			$template = 'system';
		}

		// Load the language file for the template
		$lang = JFactory::getLanguage();
		// 1.5 or core then 1.6

		$lang->load('tpl_' . $template, JPATH_BASE, null, false, false)
			|| $lang->load('tpl_' . $template, $directory . '/' . $template, null, false, false)
			|| $lang->load('tpl_' . $template, JPATH_BASE, $lang->getDefault(), false, false)
			|| $lang->load('tpl_' . $template, $directory . '/' . $template, $lang->getDefault(), false, false);

		// Assign the variables
		$this->template = $template;
		$this->baseurl = JURI::base(true);
		$this->params = isset($params['params']) ? $params['params'] : new JRegistry;

		// Load
		$this->_template = $this->_loadTemplate(YJSGPATH.'includes/html/com_templates', 'index.php');

		return $this;
	}
}
