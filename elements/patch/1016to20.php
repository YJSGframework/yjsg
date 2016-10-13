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
		'images/logotm.jpg',
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
        'layouts/layout3.php',
        'images/system/calendar.png',
        'images/system/closebox.gif',
        'images/system/edit.png',
		'images/system/emailButton.png',
		'images/system/j_button2_blank.png',
		'images/system/j_button2_image.png',
		'images/system/j_button2_left.png',
		'images/system/j_button2_pagebreak.png',
		'images/system/j_button2_readmore.png',
		'images/system/pagination.png',
		'images/system/pdf_button.png',
		'images/system/printButton.png',
		'images/system/video-js.png',
		'images/system/whiteTrans.png',
		'images/indent1.png',
		'images/indent2.png',
		'images/indent3.png',
		'images/indent4.png',
		'images/li_white_rtl.png'
    );
    
    
    $replaceInFiles = array(
        
        'templateDetails.xml',
        'template-settings.xml',
        'index.php',
        'component.php',
        'error.php',
        'offline.php',
        '/language/en-GB/en-GB.tpl_' . YJSGDEFT . '.ini',
        '/custom/yjsg_template_custom.php'
        
        
    );
    $replaceStrings = array(
        'type="media" directory' => 'type="yjsgmedia" directory',
        'bacjground' => 'background',
        '<field name="TOP_MENU_SUB" type="yjsgtextblank" default="TOP_MENU_SUB"/>' => '',
        '<position>user25</position>' => '<position>user25</position>
		<position>offcanvas</position>',
        '<folder>yjsgcore</folder>' => '',
        '<folder>fonts</folder>' => '',
		'<authorEmail>youjoomlallc@gmail.com</authorEmail>' => '<authorEmail>templates@youjoomla.com</authorEmail>',
		'<copyright>Youjoomla.com</copyright>' => '<copyright>Copyright (C),FT Web Studio INC. All Rights Reserved.</copyright>',
        '<filename>template_thumbnail.png</filename>' => '<filename>template_thumbnail.png</filename>
		<filename>template_preview.png</filename>
		<filename>template-settings.xml</filename>',
        '<folder>less</folder>' => '',
        '<version>1.</version>' => '<version>1.0.0</version>',
        '<version>1.0</version>' => '<version>1.0.0</version>',
        '<field name="STYLE_SETTINGS_TAB" type="yjsgtextblank" default="STYLE_SETTINGS_TAB"/>' => '',
        '<field name="" type="yjsgtextblank" default="CUSTOM_CSS_SLABEL"/>' => '<field name="YJSG_STYLE_SUB" type="yjsgparamtitle" default="YJSG_STYLE_SUB" />',
        '<field name="STTEXT_LABEL" type="yjsgtextblank" default="STTEXT_LABEL"/>' => '',
        '<field name="ADD_F_SUB" type="yjsgtextblank" default="ADD_F_SUB"/>' => '',
        '<field name="ADTEXT_LABEL" type="yjsgtextblank" default="ADTEXT_LABEL"/>' => '',
        '<field name="GATEXT_LABEL" type="yjsgtextblank" default="GATEXT_LABEL"/>' => '',
        '<field name="ADV_SUB" type="yjsgtextblank" default="ADV_SUB"/>' => '',
        '<field name="ADVTEXT_LABEL" type="yjsgtextblank" default="ADVTEXT_LABEL"/>' => '',
        '<field name="STYLE_SUB" type="yjsgparamtitle" default="STYLE_SUB" />' => '',
        
        '<?php echo $this->baseurl; ?>/templates/<?php echo $template ?>/css/template.css' => '<?php echo JURI::base(); ?>plugins/system/yjsg/legacy/css/template.css',
        'version 1.0.16 Stable - 11-01-2013' => '@since 2.0.0',
       '<field name="" type="yjsgversion" default=""/>' => '<field name="yjsgcheck" type="yjsgcheck" addfieldpath="/templates/' . YJSGDEFT . '/elements"/>
	   <!-- This is only options place holder. Use template-settings.xml to edit fields -->',
        'templates/' . YJSGDEFT . '/elements' => 'plugins/system/yjsg/elements',
        'require( YJSGPATH."yjsgcore/yjsg_core.php")' => 'require( YJSGCORE_PATH )',
        'require( YJSGPATH."layouts/yjsg_headerblock.php")' => 'require( YJSG_HEADERBLOCK )',
        'require( YJSGPATH."yjsgcore/yjsg_head.php")' => 'require( YJSG_HEAD )',
        'require( YJSGPATH."layouts/yjsg_topmenu.php")' => 'require( YJSG_TOPMENU )',
        'require( YJSGPATH."layouts/".$yjsg_loadlayout.".php")' => 'require( $yjsg_loadlayout )',
        'require( YJSGPATH."layouts/yjsg_pathway.php")' => 'require( YJSG_PATHWAY )',
        'require( YJSGPATH."layouts/yjsg_footer.php")' => 'require( YJSG_FOOTER )',
        'require( YJSGPATH."layouts/yjsg_notices.php")' => 'require( YJSG_NOTICES )',
        'require( YJSGPATH."layouts/yjsg_mobilemenu.php")' => 'require( YJSG_MOBILEMENU )',
        'require( YJSGPATH."layouts/yjsg_panels.php")' => 'require( YJSG_PANELS )',
        '<?php echo JURI::base(); ?>templates/<?php echo $template ?>/css/template.css' => '<?php echo JURI::base(); ?>plugins/system/yjsg/legacy/css/template.css',
        'header grid located in this file' => 'header grid',
        'mainbody grids located in layout' => 'mainbody grids',
        '<body id="stylef<?php echo $default_font_family ?>" class="contentpane" style="font-size:<?php echo $css_font; ?>;">' => '<body id="stylef<?php echo $default_font_family ?>" class="contentpane">',
        "define( 'TEMPLATEPATH', dirname(__FILE__) );" => "",
        "define( 'YJSGPATH', TEMPLATEPATH.DIRECTORY_SEPARATOR);" => "if (!defined( 'YJSGRUN' )) {
	echo JText::_('YJSG_PLUGIN_NOT_FOUND');
	exit;
}",
        'YJSGPATH."layouts/' => '"layouts/',
        "yj_site.'/css" => "yj_site.'css",
        "yj_site.'/src" => "yj_site.'src",
        'items="3" size="5"' => 'items="3" size="2"',
        '<field type="yjhandler" name="yjhandler" />' => '',
        'default="" label="Body background type"' => 'default="pattern" label="Body background type"',
        '<field name="TMTEXT_LABEL" type="yjsgtextblank" default="TMTEXT_LABEL"/>' => '',
        '<field name="" type="yjsgtextblank"  default="HEAD_DIS_TXT"/>' => '',
        '<description>' => '<yjsgversion>2.0.0</yjsgversion>
	<yjsglegacy>1.0.16</yjsglegacy>
	<description>',
        '<field name="" type="yjsgtextblank"  default="Due to template structure header grid is disabled"/>' => '<field name="yjsg_header_width" type="yjsgmultitext" default="33|33|33" labels="Header1|Header2|Header3" items="3" size="5" class="serialize_multiple" label="GH_LABEL" description="GH_DESC" />',
        '<field name="sub_width"' => '<field name="menuendLevel" type="yjsglist" default="0" label="YJSG_DEF_MENU_ENDLEVEL_LABEL" description="YJSG_DEF_MENU_ENDLEVEL_DESC">
					<option value="0">JALL</option>
					<option value="1">J1</option>
					<option value="2">J2</option>
					<option value="3">J3</option>
					<option value="4">J4</option>
					<option value="5">J5</option>
					<option value="6">J6</option>
					<option value="7">J7</option>
					<option value="8">J8</option>
					<option value="9">J9</option>
					<option value="10">J10</option>
				</field>
				<field name="sub_width"',
        '<field name="TOP_MENU_YJ_LABEL" type="yjsgparamtitle" default="TOP_MENU_YJ_LABEL" />' => '<field name="YJSG_TOP_MENU_YJ_LABEL" type="yjsgparamtitle" default="YJSG_TOP_MENU_YJ_LABEL" />
				<field name="top_menu_location" type="yjsglist" default="0" label="YJSG_TOP_MENU_LOCATION_LABEL" description="YJSG_TOP_MENU_LOCATION_DESC">
					<option value="0">Flexible</option>
					<option value="1">In header</option>
				</field>',
        '<field name="maincolumn" type="yjsgtext"' => '<field name="maincolumn" type="yjsgsinglebox"',
        '<field name="insetcolumn" type="yjsgtext"' => '<field name="insetcolumn" type="yjsgsinglebox"',
        '<field name="leftcolumn" type="yjsgtext"' => '<field name="leftcolumn" type="yjsgsinglebox"',
        '<field name="rightcolumn" type="yjsgtext"' => '<field name="rightcolumn" type="yjsgsinglebox"',
        'label="MBC_LABEL" description="MBC_DESC"' => 'gridgroup="mainbody" clabel="mainbody"',
        'label="IC_LABEL" description="IC_DESC"' => 'customchrome="YJsgxhtml" gridgroup="mainbody" clabel="inset"',
        'label="LC_LABEL" description="LC_DESC"' => 'customchrome="YJsgxhtml" gridgroup="mainbody" clabel="left"',
        'label="RC_LABEL" description="RC_DESC"' => 'customchrome="YJsgxhtml" gridgroup="mainbody" clabel="right"',
        '<field name="SPII_LABEL" type="yjsgparamtitle" default="SPII_LABEL" />' => '',
        '<field name="define_itemid"  type="menuitem"' => '<field name="insettop" type="yjsgsinglebox" customchrome="YJsgxhtml" gridgroup="mainbody" clabel="insettop" />
				<field name="insetbottom" type="yjsgsinglebox" customchrome="YJsgxhtml" gridgroup="mainbody" clabel="insetbottom" />
				<field name="define_itemid"  type="menuitem" class="yjsgmultiselect"',
        '<field name="turn_topmenu_off" type="menuitem"' => '<field name="turn_topmenu_off" type="menuitem" class="yjsgmultiselect"',
        '<field name="component_switch" type="menuitem"' => '<field name="component_switch" type="menuitem" class="yjsgmultiselect"',
        '<field name="MG_SUB" type="yjsgtextblank" default="MG_SUB"/>' => '',
        '<field name="MGTEXT_LABEL" type="yjsgtextblank" default="MGTEXT_LABEL"/>' => '',
        ' label="G1_LABEL"  description="G1_DESC"' => '',
        ' label="GH_LABEL" description="GH_DESC"' => '',
        'label="G2_LABEL" description="G2_DESC"' => '',
        'label="G3_LABEL" description="G3_DESC"' => '',
        ' label="G4_LABEL" description="G4_DESC"' => '',
        ' label="GMBB_LABEL" description="GMBB_DESC"' => '',
        'label="G5_LABEL"  description="G5_DESC"' => '',
        ' label="G6_LABEL" description="G6_DESC"' => '',
        ' label="DEF_LAYOUT_LABEL" description="DEF_LAYOUT_DESC"' => '',
        ' label="SPII_SELECT_LABEL" description="SPII_SELECT_DESC"' => '',
        '<field name="DEF_GRID_SUB" type="yjsgtextblank" default="DEF_GRID_SUB"/>' => '',
        '<field name="DGTEXT_LABEL" type="yjsgtextblank" default="DGTEXT_LABEL"/>' => '',
        '<field name="MAINB_YJ_LABEL" type="yjsgparamtitle" default="MAINB_YJ_LABEL" />' => '',
        'name="STYLE_SETTINGS"' => 'name="YJSG_STYLE_SETTINGS"',
        'label="CUSTOM_CSS_LABEL"' => 'label="YJSG_CUSTOM_CSS_LABEL"',
        'description="CUSTOM_CSS_DESC"' => 'description="YJSG_CUSTOM_CSS_DESC"',
        'label="COLOR_LABEL"' => 'label="YJSG_COLOR_LABEL"',
        'description="COLOR_DESC"' => 'description="YJSG_COLOR_DESC"',
        'label="FONT_SIZE_LABEL"' => 'label="YJSG_FONT_SIZE_LABEL"',
        'description="FONT_SIZE_DESC"' => 'description="YJSG_FONT_SIZE_DESC"',
        'label="FONT_FAM_LABEL"' => 'label="YJSG_FONT_FAM_LABEL"',
        'description="FONT_FAM_DESC"' => 'description="YJSG_FONT_FAM_DESC"',
        'label="HTAG_OVR_LABEL"' => 'label="YJSG_HTAG_OVR_LABEL"',
        'description="HTAG_OVR_DESC"' => 'description="YJSG_HTAG_OVR_DESC"',
        'label="HTAG_OVR_TYPE_LABEL"' => 'label="YJSG_HTAG_OVR_TYPE_LABEL"',
        'description="HTAG_OVR_TYPE_DESC"' => 'description="YJSG_HTAG_OVR_TYPE_DESC"',
        'label="CSS_FONT_FAM_LABEL"' => 'label="YJSG_CSS_FONT_FAM_LABEL"',
        'description="CSS_FONT_FAM_DESC"' => 'description="YJSG_CSS_FONT_FAM_DESC"',
        'label="G_FONT_FAM_LABEL"' => 'label="YJSG_G_FONT_FAM_LABEL"',
        'description="G_FONT_FAM_DESC"' => 'description="YJSG_G_FONT_FAM_DESC"',
        'label="FFK_FONT_FAM_LABEL"' => 'label="YJSG_FFK_FONT_FAM_LABEL"',
        'description="FFK_FONT_FAM_DESC"' => 'description="YJSG_FFK_FONT_FAM_DESC"',
        'label="AFF_SELECTORS_LABEL"' => 'label="YJSG_AFF_SELECTORS_LABEL"',
        'description="AFF_SELECTORS_DESC"' => 'description="YJSG_AFF_SELECTORS_DESC"',
        '<field name="LOGO_SUB" type="yjsgtextblank" default="LOGO_SUB"/>' => '',
        '<field name="LGTEXT_LABEL" type="yjsgtextblank" default="LGTEXT_LABEL"/>' => '',
        '<field name="LOGO_YJ_TITLE" type="yjsgparamtitle" default="LOGO_YJ_TITLE" />' => '',
        'name="TOP_MENU_LABEL"' => 'name="YJSG_TOP_MENU_LABEL"',
        'description="TOP_MENU_LOCATION_DESC"' => 'description="YJSG_TOP_MENU_LOCATION_DESC"',
        'label="DEF_TOP_MENU_LABEL"' => 'label="YJSG_DEF_TOP_MENU_LABEL"',
        'description="DEF_TOP_MENU_DESC"' => 'description="YJSG_DEF_TOP_MENU_DESC"',
        'label="DEF_MENU_STYLE_LABEL"' => 'label="YJSG_DEF_MENU_STYLE_LABEL"',
        'description="DEF_MENU_STYLE_DESC"' => 'description="YJSG_DEF_MENU_STYLE_DESC"',
        'label="TOP_MENU_DISA_LABEL"' => 'label="YJSG_TOP_MENU_DIS_LABEL"',
        'description="TOP_MENU_DISA_DESC"' => 'description="YJSG_TOP_MENU_DIS_DESC"',
        'label="DEF_SITE_WIDTH_LABEL"' => 'label="YJSG_DEF_SITE_WIDTH_LABEL"',
        'description="DEF_SITE_WIDTH_DESC"' => 'description="YJSG_DEF_SITE_WIDTH_DESC"',
        'name="MG_LABEL"' => 'name="YJSG_LAYOUT_LABEL"',
        'name="LOGO_LABEL"' => 'name="YJSG_LOGO_LABEL"',
        'name="DEF_GRID_LABEL"' => 'name="YJSG_DEF_GRID_LABEL"',
        '<field name="" type="yjsgparamtitle" default="TOP_MENU_OFF_YJ_LABEL" />' => '<field name="YJSG_TOP_MENU_OFF_YJ_LABEL" type="yjsgparamtitle" default="YJSG_TOP_MENU_OFF_YJ_LABEL" />',
        'label="SUBW_LABEL"' => 'label="YJSG_SUBW_LABEL"',
        'description="SUBW_DESC"' => 'description="YJSG_SUBW_DESC"',
        'label="OFFSET_LABEL"' => 'label="YJSG_OFFSET_LABEL"',
        'description="OFFSET_DESC"' => 'description="YJSG_OFFSET_DESC"',
        'label="LOGO_IMAGE_LABEL"' => 'label="YJSG_LOGO_IMAGE_LABEL"',
        'description="LOGO_IMAGE_DESC"' => 'description="YJSG_LOGO_IMAGE_DESC"',
        'label="LOGO_WIDTH"' => 'label="YJSG_LOGO_WIDTH"',
        'description="LOGO_WIDTH_DESC"' => 'description="YJSG_LOGO_WIDTH_DESC"',
        'label="LOGO_HEIGHT"' => 'label="YJSG_LOGO_HEIGHT"',
        'description="LOGO_HEIGHT_DESC"' => 'description="YJSG_LOGO_HEIGHT_DESC"',
        'label="LOGO_OFF_LABEL"' => 'label="YJSG_LOGO_OFF_LABEL"',
        'description="LOGO_OFF_DESC"' => 'description="YJSG_LOGO_OFF_DESC"',
        'label="HEADER_BLOCK_OFF"' => 'label="YJSG_HEADER_BLOCK_OFF"',
        'description="HEADER_BLOCK_OFF_DESC"' => 'description="YJSG_HEADER_BLOCK_OFF_DESC"',
        'name="fontfacekit_font_family" type="folderlist"' => 'name="fontfacekit_font_family" type="yjsgfolderlist"',
		'directory="/templates/' . YJSGDEFT . '/css/fontfacekits"' => 'directory="css/fontfacekits"',
		'hide_default="blank"' => 'hide_default="true"'
        
    );
    
    $replaceIndex = array(
        '</body>' => '	<?php 
    if ($this->countModules(\'offcanvas\')) { 
        require( YJSG_OFFCANVAS );/* Off canvas panel */
    }
    ?>
</body>',
        'dir="<?php echo $this->direction; ?>"' => 'dir="<?php echo $this->direction; ?>" class="<jdoc:include type="htmlclass" />"'
    );
    

    // Bail out if no beforeCleanup folder
	if (!JFolder::exists($beforeCleanup)) {
		
		$nobackupMsg = JText::_('YJSG_INSTALLER_TMPL_NO_BACKUP1') . YJSGDEFT  . JText::_('YJSG_INSTALLER_TMPL_NO_BACKUP2');
		$response = array(
			'message' => $nobackupMsg,
			'tupdate' => 'notwritable'
		);
		$json     = new JSON($response);
		echo $json->result;
		exit;			
	}
	
    
   // Bail out if not able to backup
   if (!JFolder::copy($beforeCleanup, $backupFolder)) {
        $response = array(
            'message' => JText::_('YJSG_NOT_ABLE_TO_BACKUP_TEMPLATE') . JText::_('YJSG_MANUAL_UPDATE_PROCESS'),
            'tupdate' => 'notwritable'
        );
        $json     = new JSON($response);
        echo $json->result;
        exit;
    }
    
    
    // move dork file
    JFile::copy(YJSGPATH . 'elements/yjsgcheck.php', $templateFolder . '/elements/yjsgcheck.php');

    // move xml file
    JFile::copy(YJSGPATH . 'includes/xml/template-settings.xml', $templateFolder . '/template-settings.xml');
	
	JFile::copy(YJSGPATH . 'assets/images/yjsg.png', $templateFolder . '/images/system/yjsg.png');
	
	// copy thumb to preview
	JFile::copy($templateFolder . '/template_thumbnail.png', $templateFolder . '/template_preview.png');
    
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
    
    // replace in files
    foreach ($replaceInFiles as $replaceFiles) {
        
        
        $readFile = @file_get_contents($templateFolder . '/' . $replaceFiles);
        
        $readFile = strtr($readFile, $replaceStrings);
        
        if ($replaceFiles == 'index.php') {
            
            $readFile = strtr($readFile, $replaceIndex);
            
        }
        
        if ($replaceFiles == 'error.php') {
            
            
            $readFile = str_replace('dir="<?php echo $this->direction; ?>"', 'dir="<?php echo $this->direction; ?>" class="yjsg-page-error"', $readFile);
            $readFile = str_replace('<?php echo $this->baseurl; ?>/templates/<?php echo $template ?>/images/<?php echo $yjsg_get_styles; ?>/logo.png', '<?php echo $logo ?>', $readFile);
            
            $readFile = str_replace('$yjsg_params->get("default_font");', '$yjsg_params->get("default_font");
$logo 							= $this->baseurl.\'/templates/\'.$template.\'/images/\'.$yjsg_get_styles.\'/logo.png\';
if($yjsg_params->get("logo_image")){
  $logo 						= JURI::base().$yjsg_params->get("logo_image");
} ', $readFile);
            
            $readFile = str_replace('</head>', '<style type="text/css">a{color:#<?php echo $default_link_color?>;}</style></head>', $readFile);
            
        }
        
        
        if ($replaceFiles == 'component.php') {
            
            $readFile = str_replace('</body>', '	<?php echo $yjsg_js;// do not remove.these are site js vars ?>
</body>', $readFile);
            $readFile = str_replace('dir="<?php echo $this->direction; ?>"', 'dir="<?php echo $this->direction; ?>" class="<jdoc:include type="htmlclass" />"', $readFile);
            
        }
        
        
        if ($replaceFiles == 'templateDetails.xml') {
            
            
            $readFile = preg_replace('/(<field name="MBC_W_LABEL"(.*?)<\/field>|<field name="widthdefined_itmid"(.*?)<\/field>|<field name="SCRIPT_YJ_LABEL"(.*?)<\/field>|<field name="less_compiler_on"(.*?)<\/field>|<field name="buffer_front_recompile"(.*?)<\/field>|<!-- Top panel -->(.*?)<\/field>|<!-- bot panel -->(.*?)<\/field>|<!-- Side panel -->(.*?)<\/field>|jform_params_|<compatibility>(.*?)<\/compatibility>|<field name="use_compiled_css"(.*?)<\/field>|<field name="maincolumn_itmid"(.*?)description="SPII_RC_DESC" \/>|<field name="css_widthdefined"(.*?)<\/field>)/s', '', $readFile);
            
            
            
            
            
            
            $readFile = preg_replace('/(<description>(.*?)<\/description>)/s', '<description><![CDATA[<style type="text/css" media="all">#wrap1 {padding:10px 0;margin:20px auto;float:left;display:block;overflow:hidden;clear:both;max-width:500px;line-height:24px;height:auto!important;text-align:center!important;background:#F6F6F6;border:1px solid #DEDEDE;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;box-sizing: border-box;}.admin_t_name {font-size:18px;display:block;clear:both;text-align:center!important;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;box-sizing: border-box;margin:15px!important;}#wrap1 img {display:block;margin:0 auto;text-align:center!important;float:none!important;}.exinfo{font-size:14px;padding:10px;display:block;overflow:hidden;text-align:center!important;-webkit-box-sizing: border-box; -moz-box-sizing: border-box;box-sizing: border-box;}</style><div id="wrap1"><h2 class="admin_t_name">'.ucfirst(YJSGDEFT).' Joomla! Template</h2><img src="../templates/'.YJSGDEFT.'/template_thumbnail.png" /><h2 class="admin_t_name">is proudly powered by</h2><a href="http://www.yjsimplegrid.com" target="_blank"><span title="YJSimpleGrid Joomla! Template Framework by Youjoomla.com"><img src="../templates/'.YJSGDEFT.'/images/system/yjsg.png" border="0" title="Yjsglogo" alt="yjsglogo"/></span></a><h2 class="admin_t_name">YJSG Template Framework</h2><div class="exinfo">Thank you for downloading Youjoomla.com template. <br />For fast info visit following links: <br /><a href="http://yjsimplegrid.com/documentation/" target="_blank">Documentation</a> | <a href="http://www.joomlatemplates.youjoomla.info/'.YJSGDEFT.'/" target="_blank">Demo</a><br />If you need support please post new thread in our <a href="http://www.youjoomla.com/joomla_support/index.php" target="_blank">Forum</a>. <br />Have fun playing with your new template :) <br /><a href="http://www.youjoomla.com">Youjoomla.com</a></div></div>]]></description>', $readFile);
            
            
            
            
            $readFile = str_replace('items="3"', 'customchrome="YJsgxhtml|YJsgxhtml|YJsgxhtml" items="3"', $readFile);
            $readFile = str_replace('items="5"', 'customchrome="YJsgxhtml|YJsgxhtml|YJsgxhtml|YJsgxhtml|YJsgxhtml" items="5"', $readFile);
            
            
            
            $readFile = preg_replace('/(<!-- Additional Features -->(.*?)<!-- Advanced Options -->)/s', '<!-- Advanced Options -->', $readFile);
            $readFile = preg_replace('/(<!-- Advanced Options -->(.*?)<\/fieldset>)/s', '', $readFile);
			
			// change creation date
			$today = date('m-d-Y');
			$readFile = preg_replace('/(<creationDate>(.*?)<\/creationDate>)/s', '<creationDate>'.$today.'</creationDate>', $readFile);
			
			
			// bump file version 
			preg_match_all('/(<version>(.*?)<\/version>)/s', $readFile, $versionbump,PREG_SET_ORDER);
			$bumpversion 	= $versionbump[0][2];
			$bumpversion 	= explode('.',$bumpversion);
			$newversion 	= $bumpversion[0].'.'.$bumpversion[1].'.'.($bumpversion[2] + 1);
			$readFile 		= preg_replace('/(<version>(.*?)<\/version>)/s', '<version>'.$newversion.'</version>', $readFile);
            
			// cacth all params
            preg_match_all('/(<fields(.*?)<\/fields>)/s', $readFile, $templateSettings, PREG_SET_ORDER);

			$readFile = preg_replace('/(<!-- Style Settings -->(.*?)<\/fields>)/s', '</fields>', $readFile);
			
			if (class_exists('DOMDocument')) {
				$dom = new DOMDocument;
				$dom->preserveWhiteSpace = FALSE;
				$dom->loadXML($readFile);
				$dom->formatOutput = TRUE;
				$readFile =  $dom->saveXml();
			}
			
			           
        }
        
        if ($replaceFiles == 'template-settings.xml') {
  
				$readFile = str_replace('<!-- DEFAULTS -->', $templateSettings[0][0], $readFile);
				$readFile = preg_replace('/(<fieldset name="YJSG_VERSION_CHECK"(.*?)<\/fieldset>)/s', '', $readFile);
				
				
				if (class_exists('DOMDocument')) {	
					$dom = new DOMDocument;
					$dom->preserveWhiteSpace = FALSE;
					$dom->loadXML($readFile);
					$dom->formatOutput = TRUE;
					$readFile =  $dom->saveXml();	
				}

        }
        
        
        
        if ($replaceFiles == 'offline.php') {
            
            
            $readFile = str_replace('dir="<?php echo $this->direction; ?>"', 'dir="<?php echo $this->direction; ?>" class="yjsg-page-offline"', $readFile);
            $readFile = str_replace("<?php if(intval(JVERSION) >= 3 || JPluginHelper::getPlugin('system', 'JBootstrap')) { ?>", "", $readFile);
            $readFile = str_replace("<?php } ?>", "", $readFile);
		 	$readFile = str_replace("<?php echo JText::_('USERNAME') ?>", "<?php echo JText::_('YJSG_USERNAME') ?>", $readFile);
			$readFile = str_replace("<?php echo JText::_('PASSWORD') ?>", "<?php echo JText::_('YJSG_PASSWORD') ?>", $readFile);
			$readFile = str_replace("<?php echo JText::_('REMEMBER') ?>", "<?php echo JText::_('YJSG_REMEMBER') ?>", $readFile);
			$readFile = str_replace("<?php echo JText::_('JLOGIN') ?>", "<?php echo JText::_('YJSG_LOGIN') ?>", $readFile);
            $readFile = str_replace('<link href="<?php echo JURI::base(); ?>media/jui/css/bootstrap.min.css" rel="stylesheet" type="text/css" />', '<?php if($bootstrap_here) { ?>
		<link href="<?php echo YJSG_ASSETS; ?><?php echo $bootstrap_version ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<?php } ?>
		<style type="text/css">a{color:#<?php echo $default_link_color?>;}</style>', $readFile);
            
            $readFile = str_replace('$yjsg_params->get("default_font");', '$yjsg_params->get("default_font");
require( YJSGCORE_PATH );', $readFile);
            $readFile = str_replace('</body>', '		<script type="text/javascript" src="<?php echo YJSG_ASSETS.\'src/libraries/jquery.min.js\' ?>"></script>
		<script type="text/javascript" src="<?php echo YJSG_ASSETS.\'src/libraries/jquery-noconflict.js\' ?>"></script>
		<?php if($bootstrap_here) { ?>
		<script type="text/javascript" src="<?php echo YJSG_ASSETS.$bootstrap_version.\'/js/bootstrap.min.js\' ?>"></script>
		<?php } ?>
		<script type="text/javascript" src="<?php echo YJSG_ASSETS.\'src/yjsg.site.plugins.js\' ?>"></script>
		<script type="text/javascript" src="<?php echo YJSG_ASSETS.\'src/yjsg.site.js\' ?>"></script>
		<script type="text/javascript">
			var logo_w = <?php echo $logo_per_width ?>;
			var site_w = <?php echo $css_width ?>;
			var site_f = \'<?php echo $css_font ?>\';
			var sp=\'<?php echo $sp ?>\';
			var tp =\'<?php echo $this->template ?>\';
			var compileme =<?php echo $compileme ?>;
			var fontc =\'<?php echo $fontc ?>\';
			var yver =\'<?php echo $jver[0] ?>\';
			var yjsglegacy=\'1\';
			var yjsgrtl=\'<?php echo $text_direction ?>\';
			var bootstrapv=\'<?php echo $bootstrap_version ?>\';
			var offcanvas=0;
			var offcanvasW=\'<?php echo $offCanvasWidth ?>\';
		</script>
	</body>', $readFile);
            $readFile = str_replace('$logo =\'\'.$this->baseurl.\'/templates/\'.$template.\'/images/\'.$yjsg_get_styles.\'/logo.png\';', '$logo 		= $this->baseurl.\'/templates/\'.$template.\'/images/\'.$yjsg_get_styles.\'/logo.png\';
	if($yjsg_params->get("logo_image")){
	  $logo 	= JURI::base().$yjsg_params->get("logo_image");
	}', $readFile);
        }
        
        
        if ($replaceFiles == '/language/en-GB/en-GB.tpl_' . YJSGDEFT . '.ini') {
            
            $readFile = preg_replace('/(;FRONTPAGE LANG(.*?)Component disabled settings.")/s', 'COM_TEMPLATES_YJSG_VERSION_CHECK_FIELDSET_LABEL="YJSG System Check"
YJSG_CHECK ="YJSG Plugin Check"
YJSG_CHECK_TIP="This template runs on YJ Simple Grid Template Framework. YJSG plugin is required for this template."
YJSG_INS_PUB="YJSG Plugin"
YJSG_INS_PUB2="is installed and published."
YJSG_UNPUB="YJSG Plugin is unpublished."
YJSG_UNINS="YJSG Template Framework Plugin is required for this template but it is not installed."
YJSG_PLUGIN_NOT_FOUND="This template requires <a href="http://www.yjsimplegrid.com" target="_blank">YJSG Template Framework Plugin</a> to be installed and published."
YJSC_PUB_EXT="Click here to publish this extension."
YJSC_MAN_EXT="Click here to manage this extension."', $readFile);
            
            
        }
        
        JFile::delete($templateFolder . '/' . $replaceFiles);
        
        JFile::write($templateFolder . '/' . $replaceFiles, $readFile);
        
        
    }
    
    
    // delete old lang file
    JFile::delete(JPATH_ROOT . 'language/en-GB/en-GB.tpl_' . YJSGDEFT . '.ini');
    
    // add new lang file
    JFile::copy($templateFolder . '/language/en-GB/en-GB.tpl_' . YJSGDEFT . '.ini', JPATH_ROOT . '/language/en-GB/en-GB.tpl_' . YJSGDEFT . '.ini');


?>