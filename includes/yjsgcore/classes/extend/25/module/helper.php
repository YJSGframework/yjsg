<?php
// no direct access
defined('_JEXEC') or die;

/**
 * Module helper class
 *
 * @package     Joomla.Legacy
 * @subpackage  Module
 * @since       11.1
 */
abstract class JModuleHelper extends YjsgJModuleHelperDefault
{
	/**
	 * An array to hold included paths
	 *
	 * @var    array
	 * @since  11.1
	 */
	protected static $includePaths = array();

	/**
	 * Render the module.
	 *
	 * @param   object  $module   A module object.
	 * @param   array   $attribs  An array of attributes for the module (probably from the XML).
	 *
	 * @return  string  The HTML content of the module output.
	 *
	 * @since   11.1
	 */
	public static function renderModule($module, $attribs = array())
	{
		static $chrome;

		if (constant('JDEBUG'))
		{
			JProfiler::getInstance('Application')->mark('beforeRenderModule ' . $module->module . ' (' . $module->title . ')');
		}

		$app = JFactory::getApplication();
		
		// Yjsg instance
		$yjsg = Yjsg::getInstance(); 

		// Record the scope.
		$scope = $app->scope;

		// Set scope to component name
		$app->scope = $module->module;

		// Get module parameters
		$params = new JRegistry;
		$params->loadString($module->params);

		// Get module path
		$module->module = preg_replace('/[^A-Z0-9_\.-]/i', '', $module->module);
		$path = JPATH_BASE . '/modules/' . $module->module . '/' . $module->module . '.php';

		// Load the module
		// $module->user is a check for 1.0 custom modules and is deprecated refactoring
		if (empty($module->user) && file_exists($path))
		{
			$lang = JFactory::getLanguage();
			// 1.5 or Core then 1.6 3PD
			$lang->load($module->module, JPATH_BASE, null, false, false) ||
				$lang->load($module->module, dirname($path), null, false, false) ||
				$lang->load($module->module, JPATH_BASE, $lang->getDefault(), false, false) ||
				$lang->load($module->module, dirname($path), $lang->getDefault(), false, false);

			$content = '';
			ob_start();
			include $path;
			$module->content = ob_get_contents() . $content;
			ob_end_clean();
		}

		// Load the module chrome functions
		if (!$chrome)
		{
			$chrome = array();
		}

		include_once JPATH_THEMES . '/system/html/modules.php';
		$chromePath 	= JPATH_THEMES . '/' . $app->getTemplate() . '/html/modules.php';
		//yjsg start
		
		if($yjsg->preplugin()){
		
			$yjsgChromePath = YJSGPATH . 'legacy' . YJDS . 'html' . YJDS . 'modules.php';
			
		}else{
			
			$yjsgChromePath = YJSGPATH . 'includes' . YJDS . 'html' . YJDS . 'modules.php';
		}
		
		
		
		//yjsg end		

		if (!isset($chrome[$chromePath]))
		{
			if (file_exists($chromePath))
			{
				include_once $chromePath;
			}
			//yjsg start
			elseif (file_exists($yjsgChromePath))
			{
				include_once $yjsgChromePath;
			}
			//yjsg end

			$chrome[$chromePath] = true;
		}

		// Make sure a style is set
		if (!isset($attribs['style']))
		{
			$attribs['style'] = 'none';
		}

		// Dynamically add outline style
		if (JRequest::getBool('tp') && JComponentHelper::getParams('com_templates')->get('template_positions_display'))
		{
			$attribs['style'] .= ' outline';
		}
		
		// yjsg grids preview
		if (JRequest::getBool('modulepositions'))
		{
			$attribs['style'] .= ' yjsg_module_positions';
		}

		foreach (explode(' ', $attribs['style']) as $style)
		{
			$chromeMethod = 'modChrome_' . $style;

			// Apply chrome and render module
			if (function_exists($chromeMethod))
			{
				$module->style = $attribs['style'];

				ob_start();
				$chromeMethod($module, $params, $attribs);
				$module->content = ob_get_contents();
				ob_end_clean();
			}
		}

		//revert the scope
		$app->scope = $scope;

		if (constant('JDEBUG'))
		{
			JProfiler::getInstance('Application')->mark('afterRenderModule ' . $module->module . ' (' . $module->title . ')');
		}

		return $module->content;
	}

	/**
	 * Get the path to a layout for a module
	 *
	 * @param   string  $module  The name of the module
	 * @param   string  $layout  The name of the module layout. If alternative layout, in the form template:filename.
	 *
	 * @return  string  The path to the module layout
	 *
	 * @since   11.1
	 */
	public static function getLayoutPath($module, $layout = 'default')
	{
		$template = JFactory::getApplication()->getTemplate();
		$defaultLayout = $layout;


		// Yjsg instance
		$yjsg = Yjsg::getInstance(); 

		if (strpos($layout, ':') !== false)
		{
			// Get the template and file name from the string
			$temp = explode(':', $layout);
			$template = ($temp[0] == '_') ? $template : $temp[0];
			$layout = $temp[1];
			$defaultLayout = ($temp[1]) ? $temp[1] : 'default';
		}

		// Build the template and base path for the layout
		$tPath 		= JPATH_THEMES . '/' . $template . '/html/' . $module . '/' . $layout . '.php';
		//yjsg start
		if(JFactory::getApplication()->isSite()){
			
			
			if($yjsg->preplugin()){
				
				
				$yjsgPath 	= YJSGPATH . 'legacy' . YJDS . 'html' . YJDS . $module . YJDS . $layout . '.php';
				
			}else{
				
				$yjsgPath 	= YJSGPATH . 'includes' . YJDS . 'html' . YJDS . $module . YJDS . $layout . '.php';
			}
			
			
			
		}
		//yjsg end
		$bPath 		= JPATH_BASE . '/modules/' . $module . '/tmpl/' . $defaultLayout . '.php';
		$dPath 		= JPATH_BASE . '/modules/' . $module . '/tmpl/default.php';

		// If the template has a layout override use it
		if (file_exists($tPath))
		{
			return $tPath;
		}
		//yjsg start
		elseif (isset($yjsgPath) && file_exists($yjsgPath))
		{
			return $yjsgPath;
		}
		//yjsg end
		elseif (file_exists($bPath))
		{
			return $bPath;
		}
		else
		{
			return $dPath;
		}
	}

	/**
	 * Add a directory where JModuleHelper should search for module. You may
	 * either pass a string or an array of directories.
	 *
	 * @param   string  $path  A path to search.
	 *
	 * @return  array  An array with directory elements
	 *
	 * @since   11.1
	 */
	public static function addIncludePath($path = '')
	{
		// Force path to array
		settype($path, 'array');

		// Loop through the path directories
		foreach ($path as $dir)
		{
			if (!empty($dir) && !in_array($dir, self::$includePaths))
			{
				jimport('joomla.filesystem.path');
				array_unshift(self::$includePaths, JPath::clean($dir));
				
				//fix to override include path priority
				self::$includePaths = array_reverse(self::$includePaths);
			}
		}

		return self::$includePaths;
	}
	
	/**
	 * Get modules by position
	 *
	 * @param   string  $position  The position of the module
	 *
	 * @return  array  An array of module objects
	 *
	 * @since   11.1
	 */
	public static function &getModules($position)
	{
		$position = strtolower($position);
		$result = array();

		$modules =& JModuleHelper::_load();

		$total = count($modules);
		for ($i = 0; $i < $total; $i++)
		{
			if ($modules[$i]->position == $position)
			{
				$result[] = &$modules[$i];
			}
		}

		if (count($result) == 0)
		{
			if (JRequest::getBool('tp') && JComponentHelper::getParams('com_templates')->get('template_positions_display') || ( JRequest::getBool('modulepositions')))
			{
				$result[0] = JModuleHelper::getModule('mod_' . $position);
				$result[0]->title = $position;
				$result[0]->content = $position;
				$result[0]->position = $position;
			}
		}

		return $result;
	}
	
}
