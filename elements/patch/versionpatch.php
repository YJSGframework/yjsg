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
defined('_JEXEC') or die('Restricted index access');

    $replaceInFiles = array(
        
        'templateDetails.xml'
        
        
    );

    // Bail out if not able to backup
    if (!JFolder::copy($templateFolder, $backupFolder)) {
        $response = array(
            'message' => JText::_('YJSG_NOT_ABLE_TO_BACKUP_TEMPLATE') . JText::_('YJSG_MANUAL_UPDATE_PROCESS'),
            'tupdate' => 'notwritable'
        );
        $json     = new JSON($response);
        echo $json->result;
        exit;
    }

    // replace in files
    foreach ($replaceInFiles as $replaceFiles) {

        $readFile = @file_get_contents($templateFolder . '/' . $replaceFiles);
        
		
			// bump yjsg version 
			preg_match_all('/(<yjsgversion>(.*?)<\/yjsgversion>)/s', $readFile, $versionbump,PREG_SET_ORDER);
			$bumpversion 	= $versionbump[0][2];
			$bumpversion 	= explode('.',$bumpversion);
			$newversion 	= $bumpversion[0].'.'.$bumpversion[1].'.'.($bumpversion[2] + 1);
			$readFile 		= preg_replace('/(<yjsgversion>(.*?)<\/yjsgversion>)/s', '<yjsgversion>'.$newversion.'</yjsgversion>', $readFile);
		
			JFile::write($templateFolder . '/' . $replaceFiles, $readFile);
        
    }


?>