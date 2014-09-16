<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template element based on YJSimpleGrid Framework  ||
|| # Copyright (C) 2010  Youjoomla LLC. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla LLC                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
define( '_JEXEC', 1 );
header("Content-Type: application/json");
$jpath = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
define('JPATH_BASE',$jpath);
require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'defines.php' );
require_once ( JPATH_BASE .DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'framework.php' );

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.plugin.helper');
$mainframe 				= JFactory::getApplication('administrator');
$mainframe->initialise();
if (intval(JVERSION) >= 3) {
	JPluginHelper::importPlugin('system','yjsg');
}
$session 				= JFactory::getSession();
$user 					= JFactory::getUser();
$isAdmin 				= $user->get('isRoot');
$site_link				= str_replace('plugins/system/'.basename(dirname(dirname(__FILE__))).'/elements/','',JURI::root());

if($isAdmin && isset($_POST['task']) && ($_POST['task'] =='convertTemplate' || $_POST['task'] =='checkTemplate' || $_POST['task'] =='restoreTemplate' || $_POST['task'] =='cleanupTemplate'))	{
	// nothing goes pass this
	if(intval(JVERSION) >= 3 ){
		JSession::checkToken() or jexit( '{"error":"Invalid Token"}' );
	}else{
		JRequest::checkToken() or jexit( '{"error":"Invalid Token"}' );
	}
	
	require('yjsgjson.php');
	// get few params
	$post 					= $mainframe->input->getArray($_POST);
	$task					= $post['task'];
	$JTemplateFolder		= JPATH_ROOT.'/templates/';
	$templateFolder 		= $JTemplateFolder.YJSGDEFT;
	$newFolderName			= YJSGDEFT.'_Backup_'.YJSGV;
	$backupFolder			= JPATH_ROOT.'/templates/'.$newFolderName;
	$yjsg					= Yjsg::getInstance();
	$templateVersion		= $yjsg->tmplVersion(YJSGDEFT);
	
	
	if($task == 'checkTemplate'){
		
		
		
		if (!is_writable($templateFolder.'/index.php')) {
			
			
			$response = array('message'=> JText::_( 'YJSG_NOT_WRITABLE' ),'tupdate'=>'notwritable');
			
		     $json = new JSON($response);
		  	 echo $json->result;
		 	 exit();			
			 return;
		}
		
		
		if( $yjsg->preplugin() && $yjsg->cleanup() ){
			

		  $response = array('message'=> JText::_( 'YJSG_RUN_CLEANUP_PLG' ),'tupdate'=>'cleanup');
		  $json = new JSON($response);
		  echo $json->result;
		  exit();	
			
		}
		
		
		if($templateVersion == '1.0.16'){
			
			$response = array('message'=> JText::_( 'YJSG_TUPDATE_AVAILABLE' ).JText::_( 'YJSG_TUPDATE_AVAILABLE2' ).'<b>'.$backupFolder.'</b>'.JText::_( 'YJSG_TUPDATE_AVAILABLE3' ),'tupdate'=>'yes');
			
		}elseif(JFolder::exists($backupFolder) && $templateVersion > '1.0.16'){
			 
			 
			if (time()-filemtime($backupFolder) > 24 * 3600) {//24 * 3600
					 
					  // backup folder is older than 24h hide restore msg
					 $response = array('message'=> JText::_( 'YJSG_TUPDATE_COMPLETE' ).'<b>'.$backupFolder.'</b>','tupdate'=>'hide');
			  
			} else {
				
				   $response = array('message'=> JText::_( 'YJSG_TUPDATE_COMPLETE' ).'<b>'.$backupFolder.'</b>','tupdate'=>'done');
			}
			 
		}elseif($templateVersion < '1.0.16'){
			 
			 
			 $response = array('message'=> JText::_( 'YJSG_NEED_1016' ).JText::_( 'YJSG_MANUAL_UPDATE_PROCESS' ),'tupdate'=>'no');
			 
		}else{
			
			$response = array('message'=> JText::_( 'YJSG_NO_TUPDATE' ).YJSGV,'tupdate'=>'no');
		}
		
		  $json = new JSON($response);
		  echo $json->result;
		  exit();		
		
	}
	

	if($task == 'cleanupTemplate'){
		  
		  
		  include ('patch/cleanup.php');
		  $response = array('message'=> JText::_( 'YJSG_TUPDATE_COMPLETE' ).'<b>'.$backupFolder.'</b>','tupdate'=>'cleaned');

		  $json = new JSON($response);
		  echo $json->result;
		  exit();
		
	}

	
	if($task == 'convertTemplate'){
		  
		  
		  if($templateVersion == '1.0.16'){
			  
			  include ('patch/1016to20.php');
			  $response = array('message'=> JText::_( 'YJSG_TUPDATE_COMPLETE' ).'<b>'.$backupFolder.'</b>','tupdate'=>'done');
			  
		  }elseif($templateVersion == YJSGV){
			 
			 $response = array('message'=> JText::_( 'YJSG_NO_TUPDATE' ).YJSGV,'tupdate'=>'no');
			 
		  }else{

			 $response = array('error'=> JText::_( 'YJSG_TUPDATE_ERROR' ));
			 
		  }

 
		  $json = new JSON($response);
		  echo $json->result;
		  exit();
		
	}

	if($task == 'restoreTemplate'){
		
		if (!is_writable($templateFolder)){
			
			
			$response = array('message'=> JText::_( 'YJSG_NOT_WRITABLE_RESTORE' ),'tupdate'=>'error');
			
		}
		if (is_writable($templateFolder)){
			@JFolder::delete($templateFolder);
			//@JFolder::move($backupFolder,$templateFolder);
			@rename($backupFolder,$templateFolder);
			@JFile::copy($templateFolder.'/language/en-GB/en-GB.tpl_'.YJSGDEFT.'.ini',JPATH_ROOT.'/language/en-GB/en-GB.tpl_'.YJSGDEFT.'.ini');
		}
		
		if(!JFolder::exists($backupFolder) && JFolder::exists($templateFolder)){
			
			$response = array('message'=> JText::_( 'YJSG_TUPDATE_AVAILABLE_RESTORE' ).JText::_( 'YJSG_TUPDATE_AVAILABLE2' ).'<b>'.$backupFolder.'</b>'.JText::_( 'YJSG_TUPDATE_AVAILABLE3' ),'tupdate'=>'restored');
			
		}else{
			
			$response = array('message'=> JText::_( 'YJSG_TRESTORE_ERROR' ),'tupdate'=>'error');
		}
		
		  $json = new JSON($response);
		  echo $json->result;
		  exit();		
		
	}
	
		
	
}else{
	echo 'Restricted acsess';
}