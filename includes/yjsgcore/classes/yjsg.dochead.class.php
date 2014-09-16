<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Yjsg	Framework									        ||
|| # Copyright (C) 2010  Youjoomla.com. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla.com                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/

defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * YjsgDochead class, provides an easy interface to parse and print <head> HTML
 *
 * @package     Yjsg Framework
 * @since       2.0.0
 */
 
class YjsgDochead {
    
    
    /**
     * Global dochead array
     *
     * @var array
     * @since  2.0.0
     */
    
    public  $dochead = array();
    
    /**
     * Global document object
     *
     * @since  2.0.0
     */
    
    public static $document = null;
    
    /**
     * Global instance object
     *
     * @since  2.0.0
     */
    
    public static $_instance = null;
    
    
    
    /**
     * Get a document object.
     *
     * Returns the global {@link YjsgDochead} object, only creating it if it doesn't already exist.
     *
     * @return  YjsgDochead object
     *
     * @since   2.0.0
     */
	 
    public static function getDocument() {
        
        if ( !self::$document ) {
            self::$document = self::getInstance();
        }
        
        return self::$document;
    }
	
    
    /**
     * Returns the class instance
     *
     * @return  YjsgDochead instance
     *
     * @since   2.0.0
     */
    
    public static function getInstance() {
        
        
        if ( self::$_instance == null ) {
            self::$_instance = new YjsgDochead();
        }
        return self::$_instance;
    }
	
    
    /**
     * Populates dochead with title
     *
     * @return  array  title
     *
     * @since   2.0.0
     */
	 
    public function addPageTitle( $title = "" ) {
        
        $this->dochead['title'] = $title;
        
        return $this;
        
    }
	
	
    /**
     * Populates dochead with links
     *
     * @return  array  links
     *
     * @since   2.0.0
     */
	 
    public function addLinks( $link = "", $rel = "", $type = "" ) {
        
        $this->dochead['links'][$link] = array(
             'rel' => $rel,
            'type' => $type 
        );
        
        return $this;
    }
	
	
    /**
     * Populates dochead with meta
     *
     * @return  array  meta
     *
     * @since   2.0.0
     */
	 
    public function addMeta( $name, $content ) {
        
        $this->dochead['meta'][] = array(
             'name' => $name,
            'content' => $content 
        );
        
        return $this;
    }
	
	
    /**
     * Populates dochead with cssfiles
     *
     * @return  array  cssfiles
     *
     * @since   2.0.0
     */
	 
    public function addCss( $link, $media = "" ) {
        
        $this->dochead['cssfiles'][$link] = array(
             'media' => $media 
        );
        
        return $this;
    }
	
	
    /**
     * Populates dochead with cssinhead
     *
     * @return  array  cssinhead
     *
     * @since   2.0.0
     */
	 
    public function addCssInhead( $inhead ) {
        
        $this->dochead['cssinhead'][] = $inhead;
        
        return $this;
    }
	
    
    /**
     * Populates dochead with jsfiles
     *
     * @return  array  jsfiles
     *
     * @since   2.0.0
     */
	 
    public function addJs( $link, $type = "", $defer = "", $async = "" ) {
        
        $this->dochead['jsfiles'][$link] = array(
             'type' => $type,
            'defer' => $defer,
            'async' => $async 
        );
        
        return $this;
    }
    
    
    /**
     * Populates dochead with jsinhead
     *
     * @return  array  jsinhead
     *
     * @since   2.0.0
     */
    
    public function addJsInhead( $inhead ) {
        
        $this->dochead['jsinhead'][] = $inhead;
        
        return $this;
    }
    
    
    /**
     * Generates the head HTML and returns the results as a string
     *
     * @return  string  The head hTML
     *
     * @since   2.0.0
     */
    
    public function printHead() {
        
        
        $head    = $this->dochead;
        $tab     = '	';
        $endTag  = ' />';
        $endLine = "\n";
        $html    = '';
        
        
        
        // title
        if ( isset( $head['title'] ) ) {
            $html .= $tab . '<title>' . $head['title'] . '</title>' . $endLine;
        }
		
        // meta tags
        if ( isset( $head['meta'] ) ) {
            foreach ( $head['meta'] as $key => $meta ) {
                
                $html .= $tab . '<meta name="' . $meta['name'] . '" content="' . htmlspecialchars( $meta['content'] ) . '"' . $endTag . $endLine;
            }
        }
        
        // links
        if ( isset( $head['links'] ) ) {
            foreach ( $head['links'] as $linkSrc => $link ) {
                
                $html .= $tab . '<link href="' . $linkSrc . '"';
                if ( !empty( $link['rel'] ) ) {
                    $html .= ' rel="' . $link['rel'] . '"';
                }
                if ( !empty( $link['type'] ) ) {
                    $html .= ' type="' . $link['type'] . '"';
                }
                $html .= $endTag . $endLine;
                
            }
        }
        
        // css files links
        if ( isset( $head['cssfiles'] ) ) {
            foreach ( $head['cssfiles'] as $linkSrc => $link ) {
                
                $html .= $tab . '<link rel="stylesheet" href="' . $linkSrc . '"';
                if ( !empty( $link['media'] ) ) {
                    $html .= ' media="' . $link['media'] . '"';
                }
                $html .= ' type="text/css"';
                $html .= $endTag . $endLine;
                
                
            }
        }
        
        //inhead css
        if ( isset( $head['cssinhead'] ) ) {
            $cssInheadTag = false;
            foreach ( $head['cssinhead'] as $css => $inhead ) {
                
                $inheadCss[] = $inhead;
                
                $cssInheadTag = true;
            }
            
            if ( $cssInheadTag ) {
                
                $html .= $tab . '<style type="text/css">' . implode( $inheadCss ) . '</style>' . $endLine;
                
            }
        }
        
        // js files links
        if ( isset( $head['jsfiles'] ) ) {
            foreach ( $head['jsfiles'] as $linkSrc => $link ) {
                
                $html .= $tab . '<script src="' . $linkSrc . '"';
                
                if ( $link['defer'] ) {
                    $html .= ' defer="defer"';
                }
                if ( $link['async'] ) {
                    $html .= ' async="async"';
                }
                if ( empty( $link['type'] ) ) {
                    $html .= ' type="text/javascript"';
                } else {
                    $html .= ' type="' . $link['type'] . '"';
                }
                $html .= ' ></script>' . $endLine;
                
                
            }
        }
        
        
        //inhead js
        if ( isset( $head['jsinhead'] ) ) {
            $jsInheadTag = false;
            foreach ( $head['jsinhead'] as $js => $inhead ) {
                
                $inheadJs[] = $inhead;
                
                $jsInheadTag = true;
            }
            
            if ( $jsInheadTag ) {
                
                $html .= $tab . '<script type="text/javascript">' . $endLine . $tab . $tab . implode( $inheadJs ) . $endLine . $tab . '</script>' . $endLine;
                
            }
        }
        
        // print head
        
        echo $html;
        
    }
    
    
}