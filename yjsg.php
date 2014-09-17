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

jimport('joomla.plugin.plugin');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');


class plgSystemYjsg extends JPlugin {
    
    
    /**
     * Yjsg instance
     *
     * @return	Yjsg
     * @since 2.0.0
     */
    
    
    public $yjsg;
    
    
    /**
     * Default template
     *
     * default assigned template
     * @return	string	
     * @since 2.0.0
     */
    
    public $default_template = "";
    
    /**
     * Edited template
     *
     * current edited template
     * @return	string
     * @since 2.0.0
     */
    
    public $edited_template = "";
    
    
    /**
     * Plugin based template
     *
     * is plugin based template
     * @return	string
     * @since 2.0.0
     */
    
    public $yjsg_newtmpl_check = 0;
    
    /**
     * Template conversion check
     *
     * does template need to be converted?
     * @return	string 
     * @since 2.0.0
     */
    
    public $yjsg_convert_check = 0;
    
    /**
     * Get application
     *
     * @since 2.0.0
     */
    
    public $app = "";
    
    /**
     * Get input
     *
     * @return	string
     * @since 2.0.0
     */
    
    public $input = "";
    
    /**
     * Get template view
     *
     * @return	bool
     * @since 2.0.0
     */
    
    public $templateView = false;
    
    /**
     * Run plugin
     *
     * @return	string
     * @since 2.0.0
     */
    
    public $run_plg = 0;
        
    /**
     * Construct
     *
     * @since 2.0.0
     */
    
    public function __construct($subject, $config) {
        
		
        parent::__construct($subject, $config);
        
        JLoader::register('Yjsg', dirname(__FILE__) . '/includes/yjsgcore/classes/yjsg.class.php', true);
        $this->yjsg = Yjsg::getInstance();
        
        defined('YJDS') or define('YJDS', DIRECTORY_SEPARATOR);
		defined('YJSGCUSTOMFOLDER') or define('YJSGCUSTOMFOLDER',JPATH_ROOT . YJDS . "templates" . YJDS . $this->yjsg->getDefaultTemplate() .YJDS. "custom" . YJDS);
		
        $this->loadLanguage();
        $this->app     = $this->yjsg->app;
        $this->user    = $this->yjsg->user;
        $this->option  = $this->Input('option');
        $this->view    = $this->Input('view');
        $id            = $this->Int('id');
        $exid          = $this->Int('extension_id');
        $task          = $this->Input('task');
        $this->canEdit = $this->user->authorise('core.edit', 'com_templates');
        $find_template = JPATH_SITE . YJDS . "templates" . YJDS . Yjsg::getDefaultTemplate() . YJDS . "custom" . YJDS;

        if ($this->option == 'com_templates' && $this->view == 'style') {
            $this->templateView = true;
        }
		
        if ($this->app->isAdmin()) {
            
            
            //get the edited template for back-end
            $this->edited_template = $this->getEditedTemplate($id, 0);
            
            
            // check if edited template is based on plugin
            if (!is_null($this->edited_template) && $this->yjsg->tmplVersion($this->edited_template) >= '2.0.0') {
                
                $this->yjsg_newtmpl_check = 1;
                
            }
            
            
            // check for conversion to turn on buttons in plugin admin
            if ($this->yjsg->yjtmpl() && $this->yjsg->tmplVersion(Yjsg::getDefaultTemplate()) == '1.0.16') {
                
                $this->yjsg_convert_check = 1;
                
            }
            
            // run the plugin in backend if template needs to be converted
            if ($this->canEdit && $this->option == 'com_plugins' && $this->view == 'plugin' && $this->yjsg_convert_check == 1 && $this->_name == 'yjsg') {
                
                $this->run_plg = 1;
                
            }
            
            // check media manager for modal and logo and make sure the element belongs to yjsg, if yes run the plugin
            if ($this->option == 'com_media' && $this->view == 'images' && $this->Input('author') == 'yjsg') {
                
                $this->run_plg = 1;
                
            }
            
            // if default template is not based on plugin and plugin runs, show msg
            if ($this->templateView && $this->yjsg_convert_check == 1 && ($this->edited_template == Yjsg::getDefaultTemplate())) {
                
                $this->app->enqueueMessage(JText::_('YJSG_OLD_TEMPLATE_FOUND'), 'warning');
                
            }
            
            // run plugin on form tasks for ajax save 
            if ($this->canEdit && $task == 'clearCache' || $task == 'adminUpdate' || $task == 'checkBootstrap' || $task == 'convertTemplate' || $task == 'checkTemplate' || $task == 'restoreTemplate' || $task == 'cleanupTemplate') {
                
                $this->run_plg = 1;
                
            }
            
            // default checks done run plugin for admin
            if ($this->canEdit && $this->templateView && $this->yjsg_newtmpl_check == 1) {
                
                $this->run_plg = 1;
            }
            
            // load the constants and override for admin
            if ($this->run_plg == 1) {
                
                $this->yjsgConstants();
                // load Extend J classes
                $this->yjsgExtendJoomla();
                
            }

			// check if we need to cleanup
			 if (  $this->edited_template == Yjsg::getDefaultTemplate() && $this->yjsg->cleanup() ) {
				
				 echo JText::_('YJSG_RUN_CLEANUP');
				 die;
			 }
            
        }
        
        
        
        
    }

    
    public function onAfterRoute() {
		
		
		if ($this->app->isAdmin()) {
			
			$this->YjsgCleanup();
			
		}
		
        
        if ($this->app->isSite()) {

            $this->default_template = $this->app->getTemplate();

            if ($this->yjsg->tmplVersion() > '1.0.16') {
                
                $this->run_plg = 1;
                
            }
            
			// check if we need to cleanup
			 if ( $this->yjsg->cleanup() ) {
				
				 echo JText::_('YJSG_RUN_CLEANUP');
				 die;
			 }
			 			
        }
        
        // load the constants and override frontend
        if ($this->run_plg == 1) {
            
            $this->yjsgConstants();
            // load Extend J classes		
            $this->yjsgExtendJoomla();
			
			// match messages for any J version
			
			if($this->app->isSite()){
			
				if (version_compare(JVERSION, '3.0', '<') && !class_exists('JDocumentRendererMessage')) {
					
				   require_once YJSGEXTEND . "25" . YJDS . 'html' . YJDS . 'message.php';
					
				}else if(version_compare(JVERSION, '2.5', '>') 
						&& !function_exists('renderMessage') 
						&& !JFile::exists(YJSGTEMPLATEPATH.'html'. YJDS . 'message.php')){
					
					require_once YJSGEXTEND . "30" . YJDS . 'html' . YJDS . 'message.php';					
					
				}
			}
			
        }
        
        
    }


    /**
     * Shorten the get call
     *
     * @return	string.
     */
    protected function Input($getOption) {
        
        return $this->app->input->get($getOption);
    }
    
    
    
    /**
     * Shorten the getInt call
     *
     * @return	string.
     */
    protected function Int($getInt) {
        
        return $this->app->input->getInt($getInt);
    }
    
	
	
    /**
     * Cleanup old classes on updates
	 *
	 * @return  void
     */
    protected function YjsgCleanup() {
		
        // cleanup on updates
        
        if (($this->Input('option') == 'com_joomlaupdate' && $this->Input('task') == 'update.install') || ($this->Input('option') == 'com_joomlaupdate' && $this->Input('layout') == 'complete')) {
            
			if(!JFolder::exists(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/')) return;
			
            JFolder::delete(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/');
            JFolder::create(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/');
            $indexContent = '';
            JFile::write(JPATH_SITE . '/plugins/system/yjsg/includes/yjsgcore/classes/extend/classes/index.html', $indexContent);
        }


    }   
    
    /**
     * Extend J classes
     *
	 * @return  void
     */
    
    public function yjsgExtendJoomla() {
        
            
		if (version_compare(JVERSION, '3.0', '<')) {
			
			$IsJversion                   = '25';
			$isView                       = 'JView';
			$YjsgJModuleHelperDefaultRead = JPATH_LIBRARIES . '/joomla/application/module/helper.php';
			$YjsgJViewDefaultRead         = JPATH_LIBRARIES . '/joomla/application/component/view.php';
			$YjsgJPaginationDefaultRead   = JPATH_LIBRARIES . '/joomla/html/pagination.php';
			$YjsgJDocumentHTMLDefaultRead = JPATH_LIBRARIES . '/joomla/document/html/html.php';
			$YjsgJFormFieldDefaultRead    = JPATH_LIBRARIES . '/joomla/form/field.php';
			
		} elseif (version_compare(JVERSION, '3.0', '>')) {
			
			$IsJversion = '30';
			$isView     = 'JViewLegacy';
			if (version_compare(JVERSION, '3.2', '<')) {
				$YjsgJModuleHelperDefaultRead = JPATH_LIBRARIES . '/legacy/module/helper.php';
			} else {
				$YjsgJModuleHelperDefaultRead = JPATH_LIBRARIES . '/cms/module/helper.php';
			}
			$YjsgJViewDefaultRead         = JPATH_LIBRARIES . '/legacy/view/legacy.php';
			$YjsgJPaginationDefaultRead   = JPATH_LIBRARIES . '/cms/pagination/pagination.php';
			$YjsgJDocumentHTMLDefaultRead = JPATH_LIBRARIES . '/joomla/document/html/html.php';
			$YjsgJFormFieldDefaultRead    = JPATH_LIBRARIES . '/joomla/form/field.php';
			$YjsgJLayoutFileDefaultRead   = JPATH_LIBRARIES . '/cms/layout/file.php';
		}
		
		
		
		// default files
		$YjsgJModuleHelperDefaultFile = YJSGEXTEND . "classes" . YJDS . "YjsgJModuleHelperDefault" . $IsJversion . ".php";
		$YjsgJViewDefaultFile         = YJSGEXTEND . "classes" . YJDS . "Yjsg" . $isView . "Default" . $IsJversion . ".php";
		$YjsgJPaginationDefaultFile   = YJSGEXTEND . "classes" . YJDS . "YjsgJPaginationDefault" . $IsJversion . ".php";
		$YjsgJDocumentHTMLDefaultFile = YJSGEXTEND . "classes" . YJDS . "YjsgJDocumentHTMLDefault" . $IsJversion . ".php";
		$YjsgJFormFieldDefaultFile    = YJSGEXTEND . "classes" . YJDS . "YjsgJFormFieldDefault" . $IsJversion . ".php";
		$YjsgJLayoutFileDefaultFile   = YJSGEXTEND . "classes" . YJDS . "YjsgJLayoutFileDefault" . $IsJversion . ".php";
		
		
		//extend JModuleHelper library class
		
		if (!JFile::exists($YjsgJModuleHelperDefaultFile)) {
			$YjsgJModuleHelperDefault = JFile::read($YjsgJModuleHelperDefaultRead);
			$YjsgJModuleHelperDefault = str_replace('class JModuleHelper', 'class YjsgJModuleHelperDefault', $YjsgJModuleHelperDefault);
			JFile::write($YjsgJModuleHelperDefaultFile, $YjsgJModuleHelperDefault);
		}
		
		require_once($YjsgJModuleHelperDefaultFile);
		jimport('joomla.application.module.helper');
		JLoader::register('JModuleHelper', YJSGEXTEND . $IsJversion . '/module/helper.php', true);
		
		//extend JView library class
		
		if (!JFile::exists($YjsgJViewDefaultFile)) {
			$YjsgJViewDefault = JFile::read($YjsgJViewDefaultRead);
			$YjsgJViewDefault = str_replace('class ' . $isView, 'class Yjsg' . $isView . 'Default', $YjsgJViewDefault);
			JFile::write($YjsgJViewDefaultFile, $YjsgJViewDefault);
		}
		
		require_once($YjsgJViewDefaultFile);
		jimport('joomla.application.component.view');
		JLoader::register($isView, YJSGEXTEND . $IsJversion . '/component/view.php', true);
		
		
		
		//extend JDocumentHTML and JFormField  library class for template admin
		
		if ($this->templateView && $this->canEdit && $this->app->isAdmin() && $this->yjsg_newtmpl_check == 1) {
			if (!JFile::exists($YjsgJDocumentHTMLDefaultFile)) {
				$YjsgJDocumentHTMLDefault = JFile::read($YjsgJDocumentHTMLDefaultRead);
				$YjsgJDocumentHTMLDefault = str_replace('class JDocumentHTML', 'class YjsgJDocumentHTMLDefault', $YjsgJDocumentHTMLDefault);
				JFile::write($YjsgJDocumentHTMLDefaultFile, $YjsgJDocumentHTMLDefault);
			}
			
			require_once($YjsgJDocumentHTMLDefaultFile);
			JLoader::register('JDocumentHTML', YJSGEXTEND . $IsJversion . '/html/html.php', true);
			
			
			
			if (!JFile::exists($YjsgJFormFieldDefaultFile)) {
				$YjsgJFormFieldDefault = JFile::read($YjsgJFormFieldDefaultRead);
				$YjsgJFormFieldDefault = str_replace('class JFormField', 'class YjsgJFormFieldDefault', $YjsgJFormFieldDefault);
				JFile::write($YjsgJFormFieldDefaultFile, $YjsgJFormFieldDefault);
			}
			
			require_once($YjsgJFormFieldDefaultFile);
			JLoader::register('JFormField', YJSGEXTEND . $IsJversion . '/form/field.php', true);
			
			
		}
		
		//extend JLayoutFile class
		if ($this->app->isSite() && version_compare(JVERSION, '3.1', '>')) {
			if (!JFile::exists($YjsgJLayoutFileDefaultFile)) {
				$YjsgJLayoutFileDefault = JFile::read($YjsgJLayoutFileDefaultRead);
				$YjsgJLayoutFileDefault = str_replace('class JLayoutFile', 'class YjsgJLayoutFileDefault', $YjsgJLayoutFileDefault);
				JFile::write($YjsgJLayoutFileDefaultFile, $YjsgJLayoutFileDefault);
			}	
			
			require_once($YjsgJLayoutFileDefaultFile);
			JLoader::register('JLayoutFile', YJSGEXTEND . $IsJversion . '/layout/file.php', true);	
		}
		
		//extend JPagination library class
		
		if (!JFile::exists($YjsgJPaginationDefaultFile)) {
			$YjsgJPaginationDefault = JFile::read($YjsgJPaginationDefaultRead);
			$YjsgJPaginationDefault = preg_replace('/class JPagination\b/i','class YjsgJPaginationDefault',$YjsgJPaginationDefault);
			JFile::write($YjsgJPaginationDefaultFile, $YjsgJPaginationDefault);
		}
		
		require_once($YjsgJPaginationDefaultFile);
		jimport('joomla.html.pagination');
		JLoader::register('JPagination', YJSGEXTEND . $IsJversion . '/pagination/pagination.php', true);
            
    }
    
    
    /**
     * Constants
     * 
	 * @return  void
	 *
     * @since 2.0.0
     */
    
    public function yjsgConstants() {
        
        
        defined('YJSGPATH') or define('YJSGPATH', dirname(__FILE__) . YJDS);
        defined('YJSGRUN') or define('YJSGRUN', 1);
        defined('YJSGV') or define('YJSGV', $this->yjsg->version);
        defined('YJSGDEFT') or define('YJSGDEFT', Yjsg::getDefaultTemplate());
        defined('YJSGTNAME') or define('YJSGTNAME', $this->default_template);
        defined('YJSGEXTEND') or define('YJSGEXTEND', YJSGPATH . 'includes' . YJDS . 'yjsgcore' . YJDS . 'classes' . YJDS . 'extend' . YJDS);
        if ($this->default_template != "") {
            defined('YJSGTEMPLATEPATH') or define('YJSGTEMPLATEPATH', JPATH_SITE . YJDS . 'templates' . YJDS . $this->default_template . YJDS);
            defined('YJSGSITE_PATH') or define('YJSGSITE_PATH', JURI::root() . 'templates/' . $this->default_template . '/');
        } else {
            defined('YJSGTEMPLATEPATH') or define('YJSGTEMPLATEPATH', JPATH_SITE . YJDS . 'templates' . YJDS . $this->edited_template . YJDS);
            defined('YJSGSITE_PATH') or define('YJSGSITE_PATH', JURI::root() . 'templates/' . $this->edited_template . '/');
        }
        defined('YJSGSITE_PLG_PATH') or define('YJSGSITE_PLG_PATH', JURI::root() . 'plugins/system/yjsg/');
        defined('YJSGCORE_FOLDER') or define('YJSGCORE_FOLDER', YJSGPATH . 'includes' . YJDS . 'yjsgcore' . YJDS);
        defined('YJSGCORE_PATH') or define('YJSGCORE_PATH', YJSGPATH . 'includes' . YJDS . 'yjsgcore' . YJDS . 'yjsg_core.php');
        defined('YJSGCOMPILER_LOG') or define('YJSGCOMPILER_LOG', YJSGTEMPLATEPATH . "css_compiled" . YJDS);
        defined('DS') or define('DS', DIRECTORY_SEPARATOR); // backwards compatibility
        defined('TEMPLATEPATH') or define('TEMPLATEPATH', YJSGTEMPLATEPATH); // backwards compatibility
        defined('YJSGSITE_BASEPATH') or define('YJSGSITE_BASEPATH', JURI::base(true) . '/templates/' . $this->default_template . '/');
        defined('YJSG_BASEPATH') or define('YJSG_BASEPATH', JURI::base(true) . '/plugins/system/yjsg/');
        defined('YJSG_ASSETS') or define('YJSG_ASSETS', JURI::base(true) . '/plugins/system/yjsg/assets/');
		
        if ($this->app->isSite()) {
            
            /**
             * make constants out of all files inside layouts folder
             *
             * yjsg_filename - YJSG_FILENAME name.
             * @since 2.0.0
             */
            $constants = array();
            
            
            if ($this->yjsg->preplugin()) {
                
                $layout_files = JFolder::files(YJSGPATH . YJDS . 'legacy' . YJDS . 'layouts');
                
            } else {
                
                $layout_files = JFolder::files(YJSGPATH . YJDS . 'includes' . YJDS . 'layouts');
            }
            
            
            
            foreach ($layout_files as $file) {
                $check_for_core = stripos($file, "yjsg_");
                if ($check_for_core !== false && $check_for_core == 0) {
                    
                    if ($this->yjsg->preplugin()) {
                        
                        $constants[strtoupper(str_replace(".php", "", $file))] = YJSGPATH . "legacy" . YJDS . "layouts" . YJDS . $file;
                        
                    } else {
                        
                        $constants[strtoupper(str_replace(".php", "", $file))] = YJSGPATH . "includes" . YJDS . "layouts" . YJDS . $file;
                    }
                    
                    
                    
                }
            }
            
            //check the template overrides, if they are there change constants 
            if (JFolder::exists(YJSGTEMPLATEPATH . YJDS . 'layouts')) {
                $template_layout_files = JFolder::files(YJSGTEMPLATEPATH . YJDS . 'layouts');
                foreach ($template_layout_files as $template_file) {
                    $check_for_core = stripos($template_file, "yjsg_");
                    if ($check_for_core !== false && $check_for_core == 0) {
                        $constants[strtoupper(str_replace(".php", "", $template_file))] = YJSGTEMPLATEPATH . "layouts" . YJDS . $template_file;
                    }
                }
            }
            
            //make constants
            if (!empty($constants)) {
                foreach ($constants as $row => $value) {
                    defined($row) or define($row, $value);
                }
            }
            
            // allow to override yjsg_head.php in template/layouts folder
            
            if ($this->yjsg->preplugin()) {
                
                $yjsgHeadFile = YJSGPATH . 'legacy' . YJDS . 'yjsgcore' . YJDS . 'yjsg_head.php';
                
            } else {
                
                $yjsgHeadFile = YJSGPATH . 'includes' . YJDS . 'yjsgcore' . YJDS . 'yjsg_head.php';
                
            }
            
            if (!defined('YJSG_HEAD')) {
                
                define('YJSG_HEAD', $yjsgHeadFile);
                
            }
            
            if (!defined('YJSG_LINKS')) {
                
                define('YJSG_LINKS', YJSGPATH . 'includes' . YJDS . 'yjsgcore' . YJDS . 'functions' . YJDS . 'yjsg_links.php');
                
            }
            
        }
        
        // make layout array for admin
        
        if ($this->canEdit && $this->app->isAdmin() && $this->templateView && $this->yjsg_newtmpl_check == 1) {
            $getpositions = file(YJSGTEMPLATEPATH . "index.php");
            $searchpoz    = array(
                'yjsg1',
                'yjsg2',
                'yjsg3',
                'yjsg4',
                'yjsg5',
                'yjsg6',
                'yjsg7',
                'YJSG_HEADERBLOCK',
				'yjsg_custom_headerblock',
                'YJSG_TOPMENU',
                'yjsg_loadlayout',
                'YJSG_FOOTER',
                'YJSG_PATHWAY',
                'newgrid1',
                'newgrid2',
                'newgrid3',
                'newgrid4',
                'newgrid5',
                'newgrid6',
                'newgrid7'
            );
            
            $matches      = array();
            $getpositions = implode('', $getpositions);
            
            foreach ($searchpoz as $val) {
                $pos = strpos($getpositions, $val);
                if ($pos !== false)
                    $matches[strtolower($val)] = $pos;
            }
            
            // preserve order of occurrence.
            asort($matches);
            $yjsglayout_array = array_keys($matches);
            $yjsglayout_array = json_encode($yjsglayout_array);
            defined('YJSGLAYOUT') or define('YJSGLAYOUT', $yjsglayout_array);
        }
        
        
        
    }
    
    /**
     * Get the editing template name
     *
     * @return	string	- template name
     * @since 2.0.0
     */
    public static function getEditedTemplate($templateId = "", $clientId = "", $default = "") {
        // Create a new query object.
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);
        
        if ($templateId !== "") {
            $query->where('id=' . (int) $templateId);
        }
        if ($clientId !== "") {
            $query->where('client_id=' . (int) $clientId);
        }
        if ($default !== "") {
            $query->where('a.home = 1');
        }
        
        // Select the required fields from the table.
        $query->select('a.template');
        $query->from($db->quoteName('#__template_styles') . ' AS a');
        
        // Make sure there aren't any errors
		try{
			
			$db->setQuery($query);
			$template_name = $db->loadResult();
			
		}catch (RuntimeException $e){
			echo $e->getMessage();
			exit;
		}  
		
		      
        return $template_name;
    }
    
    
    
    
    public function onBeforeCompileHead() {
        
        $document = JFactory::getDocument();
        
        // add bootstrap css to  modal	iframe if element is ours	
        if ($this->canEdit && $this->app->isAdmin() 
		&& intval(JVERSION) < 3 && $this->option == 'com_media' 
		&& $this->view == 'images' && $this->Input('author') == 'yjsg') {
            $document->addStyleSheet(YJSGSITE_PLG_PATH . 'assets/bootstrap3/css/bootstrap.min.css');
        }
        
		
		// check if template mootols is disabled:
		// TO DO: not able to do this since 3.x still depends on moo in some areas.
/*		$checkmootools   = Yjsg::tplParam('mootools_on');
		if(isset($checkmootools) && $checkmootools == 0
		&& ($this->view != 'images' && $this->view != 'form'))
		{
			unset($document->_scripts[JUri::root(true) . '/media/system/js/mootools-core.js']);
			unset($document->_scripts[JUri::root(true) . '/media/system/js/mootools-more.js']);
		}*/
		
		
        //yjsg rearange frontend css files, set yjsg styles last
        
        if ($this->app->isSite() && $this->run_plg == 1) {
            
            
            
            if (intval(JVERSION) > 2) {
                
                unset($document->_scripts[JUri::root(true) . '/media/jui/js/bootstrap.min.js']);
                unset($document->_scripts[JUri::root(true) . '/media/jui/js/bootstrap.js']);
                unset($document->_styleSheets[JUri::root(true) . '/media/jui/css/bootstrap-extended.css']);
                unset($document->_styleSheets[JUri::root(true) . '/media/jui/css/bootstrap-responsive.css']);
                unset($document->_styleSheets[JUri::root(true) . '/media/jui/css/bootstrap-rtl.css']);
                unset($document->_styleSheets[JUri::root(true) . '/media/jui/css/bootstrap.css']);
                unset($document->_styleSheets[JUri::root(true) . '/media/jui/css/icomoon.css']);
                
            }
            
            
            $css_file  = $document->params->get('css_file');
            $newStyles = array();
            
            
            $defaultStyles = array(
                'http://fonts.googleapis.com',
                'yjsg/assets/css',
                'yjsg/legacy/css',
                'yjsg/assets/src',
                'yjsg/assets/bootstrap2/css',
                'yjsg/assets/bootstrap3/css',
                'templates/' . $document->template
            );
            
            foreach ($document->_styleSheets as $path => $file) {
                
                foreach ($defaultStyles as $find) {
                    
                    if (strpos($path, $find) !== false) {
                        $newStyles[$path] = $document->_styleSheets[$path];
                        unset($document->_styleSheets[$path]);
                    }
                }
                
            }
            
            $newstyleSheets         = array_merge($document->_styleSheets, $newStyles);
            $document->_styleSheets = $newstyleSheets;
            // moving css files done
            
            
            // k2, vm, mijoshop joomla 3.x jquery load check
            $last_jsfiles_array = array();
            $k2check            = JPluginHelper::getPlugin('system', 'k2');
			$micheck            = JPluginHelper::getPlugin('system', 'mijoshopjquery');
            $vmcheck            = is_dir(JPATH_ROOT . YJDS . 'components' . YJDS . 'com_virtuemart' . YJDS);
            $unsetjq            = false;
            
            
            if (intval(JVERSION) > 2) {
                
                $unsetjq = true;
            }
            
            if ($k2check && $this->Input('tmpl') !='component'){
                $k2params = $this->app->getParams('com_k2');
                $k2jq     = str_replace('remote', '', $k2params->get('jQueryHandling'));
                
                if ($k2check && $k2jq > 0) {
                    
                    unset($document->_scripts['//ajax.googleapis.com/ajax/libs/jquery/' . $k2jq . '/jquery.min.js']);
                    unset($document->_scripts[JUri::root(true) . '/media/k2/assets/js/jquery-' . $k2jq . '.min.js']);
                    
                }
                
            }
            
            if ($vmcheck) {
                
                unset($document->_scripts['//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js']);
                unset($document->_scripts[JUri::root(true) . '/components/com_virtuemart/assets/js/jquery.min.js']);
                unset($document->_scripts[JUri::root(true) . '/components/com_virtuemart/assets/js/jquery.noConflict.js']);
            }
            
            if ($unsetjq) { // unset Yjsg jquery if Joomla 3.x
                
                unset($document->_scripts[YJSG_ASSETS . 'src/libraries/jquery.min.js']);
                unset($document->_scripts[YJSG_ASSETS . 'src/libraries/jquery-noconflict.js']);
            }

			// moving js files
			
			$defaultJsFiles 	= array();
			$newJs				= array();
			$defaultJsFiles[] 	= 'templates/' . $document->template;
			$defaultJsFiles[] 	= 'elements/src';
			
			// move require js to avoid cookie define conflict
			$defaultJsFiles[] 	= 'require.js';
			
			if ($k2check && $this->Input('tmpl') !='component'){
				
				$defaultJsFiles[] 	= 'k2.noconflict.js';
				$defaultJsFiles[] 	= 'k2.js';
			}
			
			if ($vmcheck){
				
				$defaultJsFiles[] 	= '1.8/jquery-ui.min.js';
				$defaultJsFiles[] 	= 'com_virtuemart';
			}
			
			if ($micheck){
				
				$defaultJsFiles[] 	= 'com_mijoshop';
				$defaultJsFiles[] 	= 'mijoshopjquery';
			}

			foreach ($document->_scripts as $path => $file) {
				
				foreach ($defaultJsFiles as $find) {
					
					if (strpos($path, $find) !== false) {
						$newJs[$path] = $document->_scripts[$path];
						unset($document->_scripts[$path]);
					}
				}
				
			}
			
			$newJsFiles         = array_merge($document->_scripts, $newJs);
			$document->_scripts = $newJsFiles;
	  
			// js files move done						
            
            
            
        }
        
    }
    
    
    function onAfterRender() {
        

		  // in case someone is overriding form field
		  
		  if ($this->app->isAdmin() &&  $this->run_plg == 1 && $this->templateView  ) {
			  
			 $body 		 	= Yjsg::getBody();
			 
			 
			 if(version_compare(JVERSION, '3.0', '<')){
			 // bug in usergroup field type output
				 $body 			= str_replace('jformparams', "jform_params_", $body);
			 }
			 
			  if(version_compare(JVERSION, '3.0', '<')){
				  
					$body 	= preg_replace('/title="(.*?)::(.*?)">/','data-original-title="$1" data-content="$2">', $body);
					$body 	= str_replace('hasTip', "adminLabel", $body);
					
			  }else{
				  
					$body 	= preg_replace('/title="(.*?)<\/strong><br \/>(.*?)">/','data-original-title="$1</strong>" data-content="$2">', $body);
					$body 	= str_replace('hasTooltip', "adminLabel", $body);
				  
			  }
			  Yjsg::setBody($body);
			
		 }
		 
      
        if ($this->app->isSite() && $this->run_plg == 1) {
            
            // add before and after body custom codes
			
			$body 		 = Yjsg::getBody();
            $afterbody   = Yjsg::tplParam('cc_after_body');
            $beforecbody = Yjsg::tplParam('cc_before_cbody');
			$bootstrapv  = Yjsg::tplParam('bootstrap_version');
			
			if(empty($bootstrapv)){
				
				$bootstrapv  ='bootstrapoff';
			}
            
			
            if (!empty($afterbody) || !empty($beforecbody)) {
                
               
                if (!empty($afterbody)) {
                    $body = preg_replace('/(<body.*?\">)(.*)/', "$0\n\t" . $afterbody, $body);
                }
                if (!empty($beforecbody)) {
                    $body = str_replace('</body>', "\n\t" . $beforecbody . "\n\t</body>", $body);
                }
                
                Yjsg::setBody($body);
            }
			
			
			// make pagination class names same in all jversions
			if($this->Input('view') == 'article'){
			
				$paginationreplace = array(
					'<ul class="pagenav">' => '<ul class="pager">',
					'pagenav-prev' => 'previous',
					'pagenav-next' => 'next'
				 );				
					
				 $body = str_replace(array_keys($paginationreplace), $paginationreplace, $body);
				 
				 if(version_compare(JVERSION, '3.0', '<')){
					 
					 
					 if ($this->yjsg->preplugin()) {
					 
				 		$body = preg_replace('/(<div class="pagination">(.*?)<ul>)/s', '<div class="jb_pagin"><ul class="pager">', $body);
						
					 } else {
						 
						 $body = preg_replace('/(<div class="pagination">(.*?)<ul>)/s', '<div class="yjsg-pager-links"><ul class="pager">', $body);
					 }
				 
				 }else{
					 
					 if ($this->yjsg->preplugin()) {
					 
						$body = preg_replace('/(<div class="pager">(.*?)<ul>)/s', '<div class="jb_pagin"><ul class="pager">', $body); 
						
					 }else {
						 
						$body = preg_replace('/(<div class="pager">(.*?)<ul>)/s', '<div class="yjsg-pager-links"><ul class="pager">', $body); 
					 }
				 }

				 Yjsg::setBody($body);  
				  
			}
			

			
			// yjsg shortcodes
			require_once YJSGPATH . 'includes/yjsgshortcodes/yjsg_shortcodes.php';
			$body 	= yjsg_shortcodes($body);
			Yjsg::setBody($body);
			
			// module positions
			if($this->app->input->getBool('modulepositions')){
				$rep ='<div class="yjsg-module-positions yjsquare">mainbody</div>';
				$body = preg_replace('/(<div class=\"yjsgarticle\">.*?<!--end news item -->)/s',$rep, $body);
				Yjsg::setBody($body);
			}

        }
    
    }

	
	public function onContentBeforeDisplay($context, $article, $params ){

		
		$ret_content ='';
		
		
		// present module positions page
		if($this->app->isSite() && $this->run_plg == 1 
		&& $this->Input('option') =='com_content'
		&& $context == 'com_content.article'
		&& $article->params->get('yjsg_module_positons') == 1 
		&& !$this->yjsg->preplugin()){
		
			$jinput = JFactory::getApplication()->input;
			$jinput->set("modulepositions","1"); 
			
		}

		
		// voting
		if ($this->app->isSite()
			&& $this->run_plg == 1
			&& $this->Input('option') =='com_content'
			&& ( $context == 'com_content.featured' || $context == 'com_content.article' || $context == 'com_content.category') 
			&& ( $article->params->get('show_vote') || $params->get('show_vote'))) {
				
				$dispatcher = JDispatcher::getInstance();
				if(intval(JVERSION) < 3){	
							
					$dispatcher->detach('plgContentVote');
					
				}else{
					
					$dispatcher->detach('PlgContentVote');
					
				}
				
			require_once YJSGPATH . 'includes/yjsgvote/yjsg_vote.php';
			$ret_content .= yjsg_vote($article, $params);
			return $ret_content;
				
		}

	}
	
	function addShortcodes(){
		
		
		if( $this->yjsg->yjtmpl() ){
			
			
			if($this->app->isSite()){
				
				$imagemedia = 'index.php?option=com_media&view=images&tmpl=component&asset=com_templates&author=yjsg&fieldid=';
				
			}else{
				
				$imagemedia = 'administrator/index.php?option=com_media&view=images&tmpl=component&asset=com_templates&author=yjsg&fieldid=';
			}
			
			
			$document = JFactory::getDocument();
			$document->addScriptDeclaration("
			var siteroot ='".JURI::root()."';
			var sitetemplate ='".Yjsg::getDefaultTemplate()."';
			var imagemedia='$imagemedia';
			");
			
			if(intval(JVERSION) < 3){
				$tipClass	= 'hasTip';
				$document->addScript(JURI::root( true ).'/plugins/system/yjsg/assets/src/libraries/jquery.min.js');
				$document->addScript(JURI::root( true ).'/plugins/system/yjsg/assets/src/libraries/jquery-noconflict.js');
			}
			

			$document->addScript(JURI::root( true ).'/plugins/system/yjsg/elements/src/yjsgshortcodes.js');	
			
			// Yjsg custom shortcodes from template
			if(JFolder::exists( YJSGCUSTOMFOLDER .'yjsgshortcodes'. YJDS )){
				
				$document->addScript(JURI::root( true ).'/templates/'. Yjsg::getDefaultTemplate() .'/custom/yjsgshortcodes/src/yjsgshortcodes.js');
			}
				
			$document->addStylesheet(JURI::root( true ).'/plugins/system/yjsg/elements/css/yjsgshortcodes.css');	
			
		}
	}
	
	
	// add shortcodes on k2 admin form 
	function onRenderAdminForm (){
		
		$this->addShortcodes();
		
	}
	
	
    function onContentPrepareForm($form, $data) {
        
 		if (!($form instanceof JForm)){
			
			$this->_subject->setError('JERROR_NOT_A_FORM');
			return false;
		}

		if( $this->yjsg->yjtmpl() ){
			
			//YJSG  mega menu 
			if ($form->getName() == 'com_menus.item') {
				JForm::addFormPath(JPATH_PLUGINS . YJDS . 'system' . YJDS . 'yjsg' . YJDS . 'includes' . YJDS . 'yjsgmegamenu');
				$form->loadFile('yjsg_mega_menu_params', false);
			}
			
			// Yjsg module additional params
			if ($form->getName() == 'com_modules.module') {
				if ($data && $data->client_id != 0)return;
				JForm::addFormPath(JPATH_PLUGINS . YJDS . 'system' . YJDS . 'yjsg' . YJDS . 'includes' . YJDS . 'yjsgmoduleoptions');
				$form->loadFile('yjsg_module_options', false);
				$this->addShortcodes();
				
				// Yjsg module additional params from template
				if (JFolder::exists(YJSGCUSTOMFOLDER."yjsgmoduleoptions" )) {
					JForm::addFormPath(YJSGCUSTOMFOLDER."yjsgmoduleoptions");
					$form->loadFile('yjsg_module_options', false, false , true);
				}	
			}

			// Module menu params 
			if ($form->getName() == 'com_modules.module') {
				if ($data && $data->module != 'mod_menu')return;
				$form->loadFile('yjsg_menu_module_options', false);			 
			}
			
			// Microdata article
			if ($form->getName() == 'com_content.article') {
				JForm::addFormPath(JPATH_PLUGINS . YJDS . 'system' . YJDS . 'yjsg' . YJDS . 'includes' . YJDS . 'yjsgmicrodata');
				$form->loadFile('yjsg_article_microdata', false);	
				$this->addShortcodes();		 
			}
			
			// Microdata category
			if ($form->getName() == 'com_menus.item' && $data['type'] == 'component' && strstr($data['link'], 'com_content')) {
				
				if (!strstr($data['link'], 'view=category&layout=blog') && !strstr($data['link'], 'view=featured'))return;
				JForm::addFormPath(JPATH_PLUGINS . YJDS . 'system' . YJDS . 'yjsg' . YJDS . 'includes' . YJDS . 'yjsgmicrodata');
				$form->loadFile('yjsg_category_microdata', false);			 
			}
			
			// Yjsg article
			if ($form->getName() == 'com_content.article') {
				JForm::addFormPath(JPATH_PLUGINS . YJDS . 'system' . YJDS . 'yjsg' . YJDS . 'includes' . YJDS . 'yjsgarticle');
				$form->loadFile('yjsg_article', false);
					
				// Yjsg article additional params from template
				if (JFolder::exists(YJSGCUSTOMFOLDER."yjsgarticle" )) {
					JForm::addFormPath(YJSGCUSTOMFOLDER."yjsgarticle");
					$form->loadFile('yjsg_article', false, false , true);
				}
			}

			
			
		}
		
        // template form
        if ($this->run_plg == 1 && $this->templateView) {
            
			// Check if JSN admin helper exists and disable adminbar
			if (class_exists('JSNConfigHelper')) {
				$jsnconfig = JSNConfigHelper::get('com_poweradmin');
				$jsnconfig->set('enable_adminbar', false);
			}

			// Template defaults
			JForm::addFormPath(JPATH_PLUGINS . YJDS . 'system' . YJDS . 'yjsg' . YJDS . 'includes' . YJDS . 'xml');
			
			if ($this->yjsg->preplugin($this->edited_template)) {
				
				$form->loadFile('default-options-legacy', false, false , true);
				
			}else{
				
				$form->loadFile('default-options', false, false , true);
				
			}
			
			
			
			$file = JPATH_SITE . YJDS . "templates" . YJDS . $this->edited_template . YJDS . "template-settings.xml";
			$xml  = JFactory::getXML($file, true);
			$form->load($xml, false,false,true);
            
            // load YjsgDochead class for template admin
            JLoader::register('YjsgDochead', YJSGPATH . 'includes/yjsgcore/classes/yjsg.dochead.class.php', true);
            $yjsgDoc = YjsgDochead::getDocument();
            
            
            if ($this->yjsg->hasUpdate() == 1) {
                
                $yjsgDoc->addJsInhead("var yjsgHasUpdate = 1;");
                
            } else {
                
                $yjsgDoc->addJsInhead("var yjsgHasUpdate = 0;");
            }
            
            //skip "reset to default" action for the following field types , they don't have default values
            
            $tpl_default = array();
            $skip_types  = array(
                'yjsgversion',
                'yjsgtextblank',
                'yjsgparamtitle',
                'yjsgparamtitle2',
                'yjhandler',
                'yjsgtime',
                'yjsgmultitext',
                'yjsglogo',
                'menuitem',
                'yjsgcheck'
            );
            
            $db_default = Yjsg::getDbParams($this->Int('id'));

			if(empty($db_default)){
				$db_default='{}';
			}
				foreach($form->getGroup('params') as $field){
					
					if (!in_array( strtolower($field->type), $skip_types)) {
						$tpl_default[$field->fieldname] = $field->value;
					}
				}
            
            $layout_file = YJSGTEMPLATEPATH . "css" . YJDS . "layout.css";
            $fontc       = $this->edited_template . '_' . filesize($layout_file) . filemtime($layout_file);
            
            
            // from JHtml::_('behavior.keepalive');
            $config      = JFactory::getConfig();
            $lifetime    = ($config->get('lifetime') * 60000);
            $refreshTime = ($lifetime <= 60000) ? 30000 : $lifetime - 60000;
            // Refresh time is 1 minute less than the liftime assigned in the configuration.php file.
            
            // the longest refresh period is one hour to prevent integer overflow.
            if ($refreshTime > 3600000 || $refreshTime <= 0) {
                $refreshTime = 3600000;
            }
            
            // now we ready. add  yjsg admin head tags 
            
            $yjsgDoc->addMeta('viewport', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no');
            $yjsgDoc->addCss(YJSGSITE_PLG_PATH . 'assets/bootstrap3/css/bootstrap.min.css');
            $yjsgDoc->addCss(YJSGSITE_PLG_PATH . 'admin/css/yjsg.css');
            $yjsgDoc->addJs(YJSGSITE_PLG_PATH . 'assets/src/libraries/jquery.min.js');
            $yjsgDoc->addJs(YJSGSITE_PLG_PATH . 'assets/bootstrap3/js/bootstrap.min.js');
            $yjsgDoc->addJs(YJSGSITE_PLG_PATH . 'assets/src/bootstrap-multiselect.js');
            $yjsgDoc->addJs(YJSGSITE_PLG_PATH . 'admin/src/yjsg.admin.plugins.js');
            $yjsgDoc->addJs(YJSGSITE_PLG_PATH . 'admin/src/yjsg.admin.js');
            $yjsgDoc->addJsInhead('var tplDefaults=' . json_encode($tpl_default) . ';var dbDefaults=' . $db_default . ';var fontc="' . $fontc . '";');
            $yjsgDoc->addJsInhead('var yjsglayout_array=' . YJSGLAYOUT . ';');
            $yjsgDoc->addJsInhead('var refreshTime=' . $refreshTime . ';');
            
        }
        
    }
}