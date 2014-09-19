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
/*
discover Browsers version, name, mobile, OS 
$yjsgBrowser->Name
$yjsgBrowser->Version
$yjsgBrowser->isMobile
$yjsgBrowser->isIphone
$yjsgBrowser->isIpad
$yjsgBrowser->isIpod
$yjsgBrowser->isiOS
$yjsgBrowser->isAndroidOS
$yjsgBrowser->isBlackBerry
$yjsgBrowser->BlackBerryOS
$yjsgBrowser->isWinOS

*/
defined('_JEXEC') or die('Restricted index access');


class YjsgBrowser {
    
	
	
	public $useragent 		= '';
    public $Name 			= '';
    public $Version 		= '';
    public $isMobile 		= false;
    public $isIphone 		= false;
    public $isIpad 			= false;
    public $isIpod 			= false;
	public $isBlackBerry 	= false;
    public $isiOS 			= false;
    public $isAndroidOS 	= false;
    public $isBlackBerryOS 	= false;
	public $isWinOS 		= false;
	
	
	
    public function __construct() {
		
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            $this->getBrowsers();
            $this->setVars();
        }
		
    }
	
    /**
     * Get browsers
     *
     * @return  Name
	 * @return  Version
     *
     * @since   2.0.0
     */	
	
    public function getBrowsers() {
        $getBrowsers = array(
            "firefox",
            "msie",
            "opera",
            "chrome",
            "safari",
            "mozilla",
            "seamonkey",
            "konqueror",
            "netscape",
            "gecko",
            "navigator",
            "mosaic",
            "lynx",
            "amaya",
            "omniweb",
            "avant",
            "camino",
            "flock",
            "aol"
        );
		
        foreach ($getBrowsers as $browser) {
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->useragent, $match)) {
                $this->Name    = $match[1];
                $this->Version = $match[2];
                break;
            }
        }
    }
	
    /**
     * Set variables
     *
     * @return  Variable bool true
     *
     * @since   2.0.0
     */	
	 	
    public function setVars() {
		
		
        $getStrings = array(
		
            'isMobile' 			=> 'mobile|tablet',
            'isIphone' 			=> 'iphone',
            'isIpad' 			=> 'ipad',
            'isIpod' 			=> 'ipod',
            'isBlackBerry' 		=> 'playbook|rim tablet|blackberry|bb10|rim[0-9]+',
            'isiOS' 			=> 'mac os',
            'isAndroidOS' 		=> 'android',
            'isBlackBerryOS' 	=> 'rim tablet os',
			'isWinOS' 			=> 'windows'
			
        );
		
		
        foreach ($getStrings as $key => $pattern) {
            if (preg_match('/' . $pattern . '/', $this->useragent, $matches)) {
                $this->$key = true;
            }
        }
		
		
    }
	
    /**
     * backwards compatibility
     * @since   2.0.0
     */	
    public function isMobile() {
        return $this->isMobile;
    }
    public function isIphone() {
        return $this->isIphone;
    }
    public function isIpad() {
        return $this->isIpad;
    }
    public function isIpod() {
        return $this->isIpod;
    }
    public function isBlackBerry() {
        return $this->isBlackBerry;
    }
    public function isiOS() {
        return $this->isiOS;
    }
    public function isAndroidOS() {
        return $this->isAndroidOS;
    }
    public function BlackBerryOS() {
        return $this->BlackBerryOS;
    }
}