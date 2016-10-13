<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
define( '_JEXEC', 1 ); 
header("Content-Type: application/json");
$get_file_info  = pathinfo(__FILE__);
$jpath = preg_replace('/(\btemplates\b|\bmodules\b|\bcomponents\b|\bplugins\b)(.*)/','',$get_file_info['dirname']);

define('JPATH_BASE',rtrim($jpath,DIRECTORY_SEPARATOR));

require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'defines.php' );
require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php' );

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.plugin.helper');
jimport('joomla.session.session');

$mainframe 				= JFactory::getApplication('administrator');
$mainframe->initialise();
if (intval(JVERSION) >= 3) {
	JPluginHelper::importPlugin('system','yjsg');
}
$session 				= JFactory::getSession();
$user 					= JFactory::getUser();
$compile_link			= preg_replace('/(\btemplates\b|\bmodules\b|\bcomponents\b|\bplugins\b)(.*)/','',JURI::root());
$siteBase				= $compile_link;
$language				= JFactory::getLanguage();
$language->setLanguage(JComponentHelper::getParams('com_languages')->get('site'));

if(isset($_POST['task']))	{
	
	// nothing goes pass this
	
	if(intval(JVERSION) >= 3 ){
		JSession::checkToken() or jexit( '{"error":"'.JText::_( 'JINVALID_TOKEN' ).'"}' );
	}else{
		JRequest::checkToken() or jexit( '{"error":"'.JText::_( 'JINVALID_TOKEN' ).'"}' );
	}
	
	require('yjsgjson.php');
	$jform		= $mainframe->input->get('jform','', 'post');
	$data 		= array();

	if(isset($jform['assigned'])){
		$data['assigned']		= $jform['assigned'];
	}else{
		$data['assigned']		='';
	}
	
	$task					= $_POST['task'];
	$template_id 			= $_POST['YJSG_template_id'];
	$template_name 			= $jform['template'];
	$template_title			= $jform['title'];
	$home  					= $jform['home'];

	$params  				= $jform['params'];
	
	$get_color_value		= explode('|',$params['yjsg_get_styles']);
	$get_current_style		= $get_color_value[0];
	$custom_css				= $params['custom_css'];
	$compile_css   			= $params['compile_css'];
	$bootstrap_version   	= $params['bootstrap_version'];
	$yjsg_assigements		= $params['yjsg_assigements'];
	
	$yjsg 				= Yjsg::getInstance();
	$YjsgDbParams		= json_decode( $yjsg->getDbParams(  $template_id  ), true );
	
	if(isset($YjsgDbParams['bootstrap_version'])){
		
		$currentBootstrap	= $YjsgDbParams['bootstrap_version'];
		
	}else{
		
		$currentBootstrap	= 'bootstrap2';
	}
	
	if(isset($params['fontfacekit_font_family'])){
		$fontfacekit_font_family 	= $params['fontfacekit_font_family'];
	}
	$YJSGTEMPLATEPATH		= JPATH_SITE.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR.$template_name.DIRECTORY_SEPARATOR;
	$YJSGCOMPILER_LOG		= $YJSGTEMPLATEPATH."css_compiled".DIRECTORY_SEPARATOR."yjsg_compiler_log_".$get_current_style.".php";
	
	
	// now encode
	$params  				= json_encode($params);


	if($compile_css == 1){
		$current_style 		= $YJSGTEMPLATEPATH."css_compiled".DIRECTORY_SEPARATOR."template-".$get_current_style.".css";
	}else{
		$current_style 		= $YJSGTEMPLATEPATH."css_compiled".DIRECTORY_SEPARATOR."bootstrap-".$get_current_style.".css";
	}
	
	
	// if template is assigned we need the assigend Itemid to recreate files
	if(!empty($yjsg_assigements)){
		
		$compile_link			= $compile_link.'index.php?option=com_content&Itemid='.$yjsg_assigements;
		$siteBase				= $compile_link;
	
	}

	
	// create custom.css file
	$custom_css_file		= $YJSGTEMPLATEPATH."css".DIRECTORY_SEPARATOR."custom.css";
	$custom_css_content 	="/**".PHP_EOL."* custom.css file created by ".ucwords($template_name)." Template".PHP_EOL."* @package ".ucwords($template_name)." Template".PHP_EOL."* @author Youjoomla.com".PHP_EOL."* @website Youjoomla.com ".PHP_EOL."* @copyright	Copyright (c) since 2007 Youjoomla.com.".PHP_EOL."* @license PHP files are released under GNU/GPL V2 Copyleft License.CSS / LESS / JS / IMAGES are Copyrighted material".PHP_EOL."**/".PHP_EOL."/*".PHP_EOL." ADD ALL YOUR CUSTOM CSS OVERRIDES TO THIS FILE.".PHP_EOL." THIS WAY IF YOU MAKE A MISTAKE YOU CAN ALWAYS TURN CUSTOM CSS FILE OFF".PHP_EOL." AND REVERT BACK TO ORIGINAL TEMPLATE CSS".PHP_EOL." THIS FILE WILL LOAD VERY LAST AFTER ALL TEMPLATE CSS FILES.".PHP_EOL." SO YOU CAN OVERRIDE ANY CSS PART OF THE TEMPLATE YOU NEED.".PHP_EOL."*/".PHP_EOL."";
	
	if($custom_css == 1 && !JFile::exists($custom_css_file)){
		JFile::write($custom_css_file,$custom_css_content);
	}

	//load the language files
	$language 	= JFactory::getLanguage();
	$language->load('tpl_'.$template_name, JPATH_BASE);
	$language->load('plg_system_yjsg', JPATH_ADMINISTRATOR);
	
	// update db
	function update_db($params,$template_name,$template_id,$template_title,$home){
		// Update the mapping for menu items that this style IS assigned to.
		$db		= JFactory::getDbo();
		$user	= JFactory::getUser();
		global $data,$task,$compile_link;

		if (!empty($data['assigned']) && is_array($data['assigned'])) {
			JArrayHelper::toInteger($data['assigned']);
			
			
			// Update the mapping for menu items that this style IS assigned to.
			$query = $db->getQuery(true);
			$query->update('#__menu');
			$query->set('template_style_id='.(int)$template_id);
			$query->where('id IN ('.implode(',', $data['assigned']).')');
			$query->where('template_style_id!='.(int) $template_id);
			$query->where('checked_out in (0,'.(int) $user->id.')');
			$db->setQuery($query);
			$db->query();
		}

		// Remove style mappings for menu items this style is NOT assigned to.
		// If unassigned then all existing maps will be removed.
		$query = $db->getQuery(true);
		$query->update('#__menu');
		$query->set('template_style_id=0');
		if (!empty($data['assigned'])) {
			$query->where('id NOT IN ('.implode(',', $data['assigned']).')');
		}

		$query->where('template_style_id='.(int) $template_id);
		$query->where('checked_out in (0,'.(int) $user->id.')');
		$db->setQuery($query);
		$db->query();

	
		if(intval(JVERSION) >= 3 ){
			try {
				$query = $db->getQuery(true);
				$query->update("#__template_styles SET home='".$home."',params='". $db->escape($params) ."',title='". $template_title ."' WHERE template='". $template_name ."' AND id=". $template_id ."");
				$db->setQuery($query);
				$db->query(); 
			}catch (Exception $e){
					$response = array('error'=>wordwrap($e->getMessage(),60, "<br />", true));
					$json = new JSON($response);
					echo $json->result;
					exit;
			}	
		}else{
			$query = $db->getQuery(true);
			$query->update("#__template_styles SET home='".$home."', params='". $db->getEscaped($params) ."',title='". $template_title ."' WHERE template='". $template_name ."' AND id=". $template_id ."");
			$db->setQuery($query);
			$db->query(); 
		
			// Make sure there aren't any errors
			if ($db->getErrorNum()) {
				$response = array('error'=>wordwrap($db->getErrorMsg(),60, "<br />", true));
				$json = new JSON($response);
				echo $json->result;
				exit;
			}
		}
		
		$compile_link = strstr($compile_link, '?') ? $compile_link."&recompile=1" : $compile_link."?recompile=1";
		return JRoute::_($compile_link);
	}
		
	if($task == 'adminUpdate'){
		$compile_link = update_db($params,$template_name,$template_id,$template_title,$home);

		if($currentBootstrap != 'bootstrapoff' && (!JFile::exists($current_style) || !JFile::exists($YJSGCOMPILER_LOG))){
			
			$response = array('message_er'=> JText::_( 'YJSG_AJAX_RECOMPILED_ERROR' ));
			
		}else{
			
			$response = array('message'=>JText::_( 'YJSG_AJAX_SAVED' ));
			
		}
		
		$json = new JSON($response);
		echo $json->result;
		exit();
	}
	
	//copyTemplate
	if($task == 'copyTemplate'){
		
		$newName = JString::increment($template_title);
		// get new template id to be opened via ajax return
		function newtemplateId($newName){
			
			$db 	= JFactory::getDbo();
			$query = "SELECT id FROM #__template_styles WHERE title = '".$newName."'";
			$db->setQuery($query);
			$newtemplateID = $db->loadResult();
			
			return $newtemplateID;
		}		
		try{		
		

				$db 	= JFactory::getDbo();
				$query = "INSERT INTO #__template_styles( template, client_id, title,params)
							SELECT '".$template_name."',client_id,'".$newName."','".$db->getEscaped($params)."'
							FROM #__template_styles
							WHERE id =".$template_id."
						";
				$db->setQuery($query);
				$db->query();	
				
				if(intval(JVERSION) < 3 ){
					
					$errorMsg = preg_replace('/(\'{(.*?)}\')/s', '', $db->getErrorMsg());
					$errorMsg = str_replace('\'', '', $errorMsg);

					if ($db->getErrorNum()) {
						$response = array('error'=>JText::_( 'YJSG_TEMPLATE_COPIED_ERROR' ),'addclass'=>'alert-danger','templatecopy_error'=>$errorMsg);
						$json = new JSON($response);
						echo $json->result;
						exit;
					}
				}

				$response = array('message'=> JText::_( 'YJSG_TEMPLATE_COPIED' ),'newtemplateid'=>newtemplateId($newName));	
				$json = new JSON($response);
				echo $json->result;
				exit();			
				
		}catch (Exception $e){
			
					$errorMsg = preg_replace('/(\'{(.*?)}\')/s', '', $e->getMessage());
					$errorMsg = str_replace('\'', '', $errorMsg);
			
					$response = array('error'=> JText::_( 'YJSG_TEMPLATE_COPIED_ERROR' ),'addclass'=>'alert-danger','templatecopy_error'=>$errorMsg);
					$json = new JSON($response);
					echo $json->result;
					exit;
		}


	
	}
	
	
	
	// clear compiler cache
	if($task == 'clearCache'){
		// clear log
		if(JFile::exists($YJSGCOMPILER_LOG)){
			JFile::delete($YJSGCOMPILER_LOG);
		}
		// clear current
		if(JFile::exists($current_style)){
			JFile::delete($current_style);
		}


		if(!JFile::exists($YJSGCOMPILER_LOG) || !JFile::exists($current_style)){
			 
			  $compile_link = update_db($params,$template_name,$template_id,$template_title,$home);

			  
			  // switch link if site is offline
			  if($mainframe->getCfg('offline') == 1){
				  
				  $compile_link = $siteBase;
				  
			  }
	
			  $gotError 		= false;
			  $errorResponse 	='';
			  
			  
			  // use file_get_contents if no curl
			  if( ini_get('allow_url_fopen') &&  !function_exists('curl_init')) {	
				  
					@file_get_contents($compile_link);
					
					$check_page = @get_headers($compile_link,1);
					
					if($check_page['Content-Type'] == 'application/json'){
						
						$gotError = true;
						
						$errorResponse = JText::_( 'YJSG_AJAX_CACHE_ERROR' );
					}
					
					
					$fetchLinkiWith ='allow_url_fopen';
				
			  // if curl , use it 
			  }elseif(function_exists('curl_init')){
				  
					$runCURL = curl_init();
					
					curl_setopt($runCURL, CURLOPT_URL, $compile_link);
					curl_setopt($runCURL, CURLOPT_HEADER, 1);
					curl_setopt($runCURL, CURLOPT_RETURNTRANSFER, 1);
					curl_exec($runCURL);
					$check_page = curl_getinfo($runCURL, CURLINFO_CONTENT_TYPE);
					curl_close($runCURL);	
					
					if($check_page != 'text/html; charset=utf-8'){
						
						$gotError = true;
						
						$errorResponse = JText::_( 'YJSG_AJAX_CACHE_ERROR' );
					}
									
					$fetchLinkiWith ='curl_init';			  
			
			
			  // than we got nothing, front refresh will do the job
			  }else{
				  
				  $fetchLinkiWith ='none';
				  $gotError = true;
				  $errorResponse ='no allow_url_fopen no curl_init';
				  
			  }
	 
			  
			  if($gotError){
				  
				  $response = array('error'=> $errorResponse ,'fetchLinkiWith'=>$fetchLinkiWith,'addclass'=>'alert-danger');
				  
			  }else if($mainframe->getCfg('offline') == 1){
				  
				  $response = array('message'=> JText::_( 'YJSG_AJAX_CACHE_SAVED_OFFLINE' ),'fetchLinkiWith'=>$fetchLinkiWith);
				  
			  }else{
				  
				  $response = array('message'=> JText::_( 'YJSG_AJAX_CACHE_SAVED' ),'fetchLinkiWith'=>$fetchLinkiWith);
			  }
			  
			  
			  $json = new JSON($response);
			  echo $json->result;		  
			  exit();
		  
		}else{
			
			  $response = array('error'=> JText::_( 'YJSG_AJAX_CACHE_ERROR' ),'fetchLinkiWith'=>$fetchLinkiWith);
			  $json = new JSON($response);
			  echo $json->result;
			  exit();	
		  
		}
			  
		
	}

	if($task == 'checkBootstrap'){


		if(JFile::exists($YJSGCOMPILER_LOG)){	
			
			if ($bootstrap_version == $currentBootstrap ) {
				
			  $response = array('bootstrap'=> JText::_( 'YJSG_AJAX_OK_BSV' ).$bootstrap_version);
			  $json = new JSON($response);
			  echo $json->result;
			  exit();			
				
				
			}else{
				
				  if($currentBootstrap == 'bootstrapoff'){
				  
					   $response = array('message_er'=> JText::_( 'YJSG_AJAX_DIFF_BSV_OFF'));
					
				  }else if($currentBootstrap == 'bootstrap2'){
					  
					  $response = array('message_er'=> JText::_( 'YJSG_AJAX_DIFF_BSV' ). $currentBootstrap . JText::_( 'YJSG_AJAX_DIFF_BSV2' ),'addclass'=>'alert-danger');
					  
				  }else if($currentBootstrap == 'bootstrap3'){
					  
					  $response = array('message_er'=> JText::_( 'YJSG_AJAX_DIFF_BSV' ). $currentBootstrap . JText::_( 'YJSG_AJAX_DIFF_BSV2' ),'addclass'=>'alert-danger');
					  
				  }
				  
			  $json = new JSON($response);
			  echo $json->result;
			  exit();	
				
			}
		}else{
			
			  $response = array('error'=> JText::_( 'YJSG_AJAX_RECOMPILED_ERROR' ));
			  $json = new JSON($response);
			  echo $json->result;
			  exit();			
							
		}

	}

}else{
	
	echo JText::_( 'JGLOBAL_AUTH_ACCESS_DENIED' );
}