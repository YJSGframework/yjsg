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
      
    $deleteFolders = array(
        'less',
        'yjsgcore',
        'fonts',
        'html/com_contact',
        'html/com_content',
        'html/com_finder',
        'html/com_mailto',
        'html/com_newsfeeds',
        'html/com_search',
        'html/com_tags',
        'html/com_users',
        'html/com_weblinks',
        'html/mod_breadcrumbs',
        'html/mod_custom',
        'html/mod_login',
        'html/mod_menu',
        'css/admin',
        'css/pie',
        'images/admin',
        'images/typ',
        'src/admin',
        'src/libraries',
        'src/video-js'
    );
    $deleteFiles   = array(
        'css/bootstrap-rtl.css',
        'css/joomladefaults.css',
        'css/menu_rtl.css',
        'css/newsitems.css',
        'css/template.css',
        'css/template_rtl.css',
        'css/typo.css',
        'css/video-js.min.css',
        'css/yjresponsive.css',
        'css/yjsg_layout.css',
        'src/donly.js',
        'src/dropd13.js',
        'src/mouseover13.js',
        'src/respond.js',
        'src/selectivizr-min.js',
        'src/sitescripts.js',
        'src/yjresponsive.js',
        'src/yjsge.js',
        'src/customadmin.js',
        'src/customadmin3x.js',
        'elements/yjhandler.php',
        'elements/yjsgjson.php',
        'elements/yjsglist.php',
        'elements/yjsglogo.php',
        'elements/yjsgmultitext.php',
        'elements/yjsgparamtitle.php',
        'elements/yjsgradio.php',
        'elements/yjsgtext.php',
        'elements/yjsgtextblank.php',
        'elements/yjsgtime.php',
        'elements/yjsgupdate.php',
        'elements/yjsgversion.php',
        'elements/yjsgbackgrounds.php',
        'elements/yjsgparamtitle2.php',
        'elements/yjsgcolor.php',
        'html/modules.php',
        'html/pagination.php',
        'layouts/left-mid-right.php',
        'layouts/left-right-mid.php',
        'layouts/mid-left-right.php',
        'layouts/yjsg_footer.php',
        'layouts/yjsg_headerblock.php',
        'layouts/yjsg_mobilemenu.php',
        'layouts/yjsg_notices.php',
        'layouts/yjsg_panels.php',
        'layouts/yjsg_pathway.php',
        'layouts/yjsg_register.php',
        'layouts/yjsg_tools.php',
        'layouts/yjsg_topmenu.php',
        'layouts/layout1.php',
        'layouts/layout2.php',
        'layouts/layout3.php'
    );
    

    

	
	 // backup template
	if (!JFolder::exists($backupFolder)) {
    	JFolder::copy($templateFolder, $backupFolder);
	}
    
    // Bail out if not able to backup
    if (!JFolder::exists($backupFolder)) {
        $response = array(
            'message' => JText::_('YJSG_NOT_ABLE_TO_BACKUP_TEMPLATE') . JText::_('YJSG_MANUAL_UPDATE_PROCESS'),
            'tupdate' => 'notwritable'
        );
        $json     = new JSON($response);
        echo $json->result;
        exit;
    }

    
    // delete folders
    foreach ($deleteFolders as $deleteFolder) {
        
        if (JFolder::exists($templateFolder . '/' . $deleteFolder)) {
            JFolder::delete($templateFolder . '/' . $deleteFolder);
        }
        
    }
    
    // delete files
    foreach ($deleteFiles as $deleteFile) {
        
        if (JFile::exists($templateFolder . '/' . $deleteFile)) {
            JFile::delete($templateFolder . '/' . $deleteFile);
        }
        
    }
    

    
?>