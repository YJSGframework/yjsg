<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// no direct access 
defined('_JEXEC') or die;

function yjsg_shortcodes($text) {
    
    $shortcodes = array(
        
        'yjsgparse' => array(
            "check" => "[yjsgparse",
            "type" => "yjsgparse",
            "match" => "/\[yjsgparse.*?url\=\"(.*?)\".*?days\=\"(.*?)\".*?hours\=\"(.*?)\".*?\]/s",
            "replace" => "/\[yjsgparse(.*?)\]/s"
        ),
        
        'yjsgmedia' => array(
            "check" => "[yjsgmedia",
            "type" => "yjsgmedia",
            "match" => "/\[yjsgmedia.*?link\=\"(.*?)\".*?poster\=\"(.*?)\".*?width\=\"(.*?)\".*?height\=\"(.*?)\".*?resp\=\"(.*?)\".*?id\=\"(.*?)\".*?\]/i",
            "replace" => "/\[yjsgmedia(.*?)\]/s"
        ),
        
        'yjsgnote' => array(
            "check" => "[yjsgnote",
            "type" => "yjsgnote",
            "match" => "/\[yjsgnote.*?color\=\"(.*?)\".*?close\=\"(.*?)\".*?title\=\"(.*?)\".*?border\=\"(.*?)\".*?radius\=\"(.*?)\".*?icon\=\"(.*?)\".*?\](.*?)\[\/yjsgnote\]/s",
            "replace" => "/\[yjsgnote(.*?)\[\/yjsgnote\]/s"
        ),
        'yjsgacs' => array(
            "check" => "[yjsgacs",
            "type" => "yjsgacs",
            "match" => "/\[yjsgacs.*?id\=\"(.*?)\"\](.*?)\[\/yjsgacs\]/s",
            "replace" => "/\[yjsgacs(.*?)\[\/yjsgacs\]/s"
        ),
        
        'yjsgstabs' => array(
            "check" => "[yjsgstabs",
            "type" => "yjsgstabs",
            "match" => "/\[yjsgstabs.*?id\=\"(.*?)\".*?type\=\"(.*?)\"\](.*?)\[\/yjsgstabs\]/s",
            "replace" => "/\[yjsgstabs(.*?)\[\/yjsgstabs\]/s"
        ),
        
        'yjsgfa' => array(
            "check" => "[yjsgfa",
            "type" => "yjsgfa",
            "match" => "/\[yjsgfa.*?name\=\"(.*?)\".*?\]/i",
            "replace" => "/\[yjsgfa(.*?)\]/s"
        ),
        
        'yjsgimgs' => array(
            "check" => "[yjsgimgs",
            "type" => "yjsgimgs",
            "match" => "/\[yjsgimgs.*?image\=\"(.*?)\".*?class\=\"(.*?)\".*?title\=\"(.*?)\".*?link\=\"(.*?)\".*?target\=\"(.*?)\".*?effect\=\"(.*?)\".*?\]/i",
            "replace" => "/\[yjsgimgs(.*?)\]/s"
        ),
        
        'yjsgpre' => array(
            "check" => "[yjsgpre",
            "type" => "yjsgpre",
            "match" => "/\[yjsgpre.*?pretty\=\"(.*?)\".*?scroll\=\"(.*?)\".*?\](.*?)\[\/yjsgpre\]/s",
            "replace" => "/\[yjsgpre.*?\[\/yjsgpre\]/s"
        )
        
    );
    
    if (JFile::exists(YJSGCUSTOMFOLDER . 'yjsgshortcodes' . YJDS . 'yjsg_shortcodes.php')) {
        
        include_once YJSGCUSTOMFOLDER . 'yjsgshortcodes' . YJDS . 'yjsg_shortcodes.php';
        
    }
    
    foreach ($shortcodes as $index => $shortcode) {
        if (strpos($text, $shortcode['check']) !== false) {
            $text = yjsg_shortcodes_replace($shortcode, $text);
        }
    }
    return $text;
}

function yjsg_shortcodes_replace($shortcode, $text) {
    
    preg_match_all($shortcode['match'], $text, $matches, PREG_SET_ORDER);
    
    switch ($shortcode['type']) {
        
        
        case "yjsgparse":
            foreach ($matches as $index => $match) {
				
				
				
				
                
                if (!empty($matches[$index][1])) {
                    $days        = $matches[$index][2];
                    $hours       = $matches[$index][3];
					$allowjs	 = false;
					
					if (strpos($matches[$index][0],'allowjs') !== false) {
						$allowjs = true;					
					}
					
                    $replacement = yjsg_parse($matches[$index][1], $days, $hours,$allowjs);
                }
                
                $text = str_replace($matches[$index][0], $replacement, $text);
            }
            break;
        
        case "yjsgmedia":
            
            $media_enabled = false;
            if (strpos($text, 'mediaelement-and-player.min.js') !== false) {
                
                $media_enabled = true;
            }
            
            foreach ($matches as $index => $match) {
                
                $medialink = $matches[$index][1];
                $poster    = '';
                if (!empty($matches[$index][2])) {
                    $poster = ' poster="' . $matches[$index][2] . '"';
                }
                $width   = ' width="' . $matches[$index][3] . '"';
                $height  = ' height="' . $matches[$index][4] . '"';
                $tag     = 'video';
                $type    = 'video/mp4';
                $respond = ' yjsg-media-respond';
                if ($matches[$index][5] == 'no') {
                    $respond = '';
                }
                $addclass = '';
                $mediaid  = $matches[$index][6];
                
                if (strpos($medialink, 'mp3') !== false) {
                    
                    $poster   = '';
                    $width    = '';
                    $height   = '';
                    $tag      = 'audio';
                    $type     = 'audio/mp3';
                    $addclass = ' yjsg-audio';
                    
                }
                
                if (strpos($medialink, 'vimeo') !== false) {
                    
                    $poster   = '';
                    $type     = 'video/vimeo';
                    $addclass = ' yjsg-vimeo';
                    
                }
                
                if (strpos($medialink, 'youtu') !== false) {
                    
                    $poster   = '';
                    $type     = 'video/youtube';
                    $addclass = ' yjsg-youtube';
                    
                }
                
                
                $replacement = '<' . $tag . ' id="' . $mediaid . '" class="yjsg-media' . $addclass . $respond . '"' . $poster . $width . $height . '>';
                $replacement .= '<source src="' . $medialink . '" type="' . $type . '">';
                $replacement .= '</' . $tag . '>';
                
                if ($media_enabled) {
                    
                    $text = str_replace($matches[$index][0], $replacement, $text);
                    
                } else {
                    
                    $replacement = '<div class="yjtbox yjtb_yellow lineup">';
                    $replacement .= '<span class="yjtb_close"></span>';
                    $replacement .= '<span class="yjtboxicon fa fa-warning"></span>';
                    $replacement .= '<h4 class="yjtboxtitle">' . JText::_('YJSG_MEDIA_ELEMENT_MISSING_TITLE') . ':</h4>';
                    $replacement .= JText::_('YJSG_MEDIA_ELEMENT_MISSING');
                    $replacement .= '</div>';
                    $text = str_replace($matches[$index][0], $replacement, $text);
                    break;
                }
            }
            break;
        
        
        case "yjsgnote":
            foreach ($matches as $index => $match) {
                $color  = $matches[$index][1];
                $close  = $matches[$index][2];
                $title  = $matches[$index][3];
                $border = '';
                if ($matches[$index][4] != 'default') {
                    $border = ' ' . $matches[$index][4];
                }
                
                $radius = '';
                if ($matches[$index][5] != '0') {
                    $radius = ' ' . $matches[$index][5];
                }
                $icon   = '';
                $lineup = '';
                if ($matches[$index][6] != '') {
                    $icon   = '<span class="yjtboxicon ' . $matches[$index][6] . '"></span>';
                    $lineup = ' lineup';
                }
                $content = $matches[$index][7];
                
                $replacement = '<div class="yjtbox yjtb_' . $color . $radius . $border . $lineup . '">';
                if ($close == 'yes') {
                    $replacement .= '<span class="yjtb_close"></span>';
                }
                
                $replacement .= $icon;
                if (!empty($title)) {
                    $replacement .= '<h4 class="yjtboxtitle">' . $title . '</h4>';
                }
                $replacement .= $content;
                $replacement .= '</div>';
                $text = str_replace($matches[$index][0], $replacement, $text);
            }
            break;
        
        
        case "yjsgacs":
            
            foreach ($matches as $index => $match) {
                
                $re = '/\[yjsgacgroup.*?title\=\"((?><[^>]+>|[^"])*?)\".*?active\=\"(.*?)\"](.*?)\[\/yjsgacgroup\]/s';
                preg_match_all($re, $matches[$index][2], $groups, PREG_SET_ORDER);
                
                $replacement = '<div id="' . $matches[$index][1] . '" class="yjsgaccChrome">';
                foreach ($groups as $gindex => $group) {
                    $active = '';
                    if ($group[2] == 1) {
                        $active = ' active';
                    }
                    /* group start */
                    $replacement .= '<div class="yjsgaccGroup">';
                    $replacement .= '<div class="yjsgaccTrigger' . $active . '">';
                    $replacement .= '<a href="#">';
                    $replacement .= $group[1];
                    $replacement .= '</a>';
                    $replacement .= '</div>';
                    $replacement .= '<div class="yjsgaccContent">';
                    $replacement .= $group[3];
                    $replacement .= '</div>';
                    $replacement .= '</div>';
                    /* group end */
                }
                $replacement .= '</div>';
                $text = str_replace($matches[$index][0], $replacement, $text);
                
            }
            break;
        
        
        
        case "yjsgstabs":
            foreach ($matches as $index => $match) {
                
                $re = '/\[yjsgstabsgroup.*?title\=\"((?>\[[^]]+]|[^"])*?)\".*?active\=\"(.*?)\"](.*?)\[\/yjsgstabsgroup\]/s';
                preg_match_all($re, $matches[$index][3], $groups, PREG_SET_ORDER);
                
                $type = ' yjsgtabsnav';
                if ($matches[$index][2] != 'tabnav') {
                    $type = ' ' . $matches[$index][2];
                }
                global $text_direction;
                if ($text_direction == 1 && $matches[$index][2] == 'tabsleft') {
                    
                    $type = ' tabsright';
                }
                if ($text_direction == 1 && $matches[$index][2] == 'tabsright') {
                    
                    $type = ' tabsleft';
                }
                
                $replacement = '<div id="' . $matches[$index][1] . '" class="yjsgSimpleTabs yjsgtabs' . $type . '">';
                $replacement .= '<ul class="yjsgsliderPaginationTabs yjsgShortcodeTabs">';
                foreach ($groups as $gindex => $group) {
                    
                    $activetab = '';
                    
                    if ($group[2] == 1) {
                        $activetab = ' class="active"';
                    }
                    
                    $replacement .= '<li' . $activetab . '><a class="tabbutton" href="#' . $matches[$index][1] . 'tab' . $gindex . '">' . $group[1] . '</a></li>';
                }
                $replacement .= '</ul>';
                
                foreach ($groups as $gindex => $group) {
                    $activecontent = '';
                    if ($group[2] == 1) {
                        $activecontent = ' activeContent';
                    }
                    $replacement .= '<div id="' . $matches[$index][1] . 'tab' . $gindex . '" class="yjsgTabContent' . $activecontent . '">';
                    $replacement .= $group[3];
                    $replacement .= '</div>';
                }
                $replacement .= '</div>';
                $text = str_replace($matches[$index][0], $replacement, $text);
                
            }
            break;
        
        case "yjsgfa":
            foreach ($matches as $index => $match) {
                
                $replacement = '<span class="' . $matches[$index][1] . '"></span>';
                $text        = str_replace($matches[$index][0], $replacement, $text);
            }
            break;
        
        
        case "yjsgimgs":
            foreach ($matches as $index => $match) {
                
                $image       = $matches[$index][1];
                $class       = $matches[$index][2];
                $title       = $matches[$index][3];
                $link        = $matches[$index][4];
                $target      = $matches[$index][5];
                $effect      = $matches[$index][6];
                $parenttag   = 'span';
                $href        = '';
                $linktarget  = '';
                $fadedata    = '';
                $effectclass = ' yjt_' . $effect;
                
                if (!empty($link)) {
                    
                    $parenttag = 'a';
                    $href      = 'href="' . $link . '" ';
                    
                    if ($target == 'blank') {
                        
                        $linktarget = ' target="_blank"';
                    }
                    
                }
                if (strpos($effect, '|') !== false) {
                    
                    $effect      = explode('|', $effect);
                    $fadedata    = ' data-yjt_fadeto="' . $effect[1] . '" data-yjt_fadespeed="' . $effect[2] . '"';
                    $effectclass = ' yjt_fade';
                    
                }
                
                
                $replacement = '<' . $parenttag . ' class="yjt_imgs ' . $class . $effectclass . '" ' . $href . 'title="' . $title . '"' . $linktarget . $fadedata . '>';
                $replacement .= '<img src="' . $image . '" alt="' . $title . '" />';
                $replacement .= '</' . $parenttag . '>';
                
                $text = str_replace($matches[$index][0], $replacement, $text);
            }
            break;
        
        case "yjsgpre":
            foreach ($matches as $index => $match) {
                
                $pretty   = '';
                $scroll   = '';
                $preclass = '';
                if ($matches[$index][1] == 1) {
                    $pretty = 'prettyprint linenums';
                }
                if ($matches[$index][2] == 1) {
                    $scroll = ' pre-scrollable';
                }
                
                if ($matches[$index][1] == 1 || $matches[$index][2] == 1) {
                    
                    $preclass = ' class="' . $pretty . $scroll . '"';
                    
                }
                
                
                $get_pre = str_replace(array(
                    '{/',
					'{yj',
                    'yjsgpre}',
					'group}',
					'yjsgstabs}',
					'yjsgnote}',
					'yjsgacs}',
					'"}'
                ), array(
                    '[/',
					'[yj',
                    'yjsgpre]',
					'group]',
					'yjsgstabs]',
					'yjsgnote]',
					'yjsgacs]',
					'"]'
                ), $matches[$index][3]);
				
                $get_pre = clean_html_code($get_pre, "    ");
                
                $replacement = '<pre' . $preclass . '>';
                $replacement .= htmlentities($get_pre, ENT_QUOTES, 'UTF-8');
                $replacement .= '</pre>';
                
                $text = str_replace($matches[$index][0], $replacement, $text);
            }
            break;
            
    }
    
    if (JFile::exists(YJSGCUSTOMFOLDER . 'yjsgshortcodes' . YJDS . 'yjsg_shortcodes_replace.php')) {
        
        include YJSGCUSTOMFOLDER . 'yjsgshortcodes' . YJDS . 'yjsg_shortcodes_replace.php';
        
    }
    
    return $text;
}


// yjsgparse shortcode function
function yjsg_parse($path, $days = '', $hours = '', $allowjs = false) {
	
    $yjsgmediafolder = JPATH_SITE . YJDS . 'media' . YJDS . 'plg_system_yjsg' . YJDS;
    $indexContent    = '';
    $fileinfo        = @pathinfo($path);
    $filename        = str_replace('%20', ' ', $fileinfo['filename']) . '.txt';
	$folderinfo		 = preg_replace('#\/[^/]*$#', '', $path);
    $foldername      = strtolower(str_replace(array(
        'http://',
        'https://',
        'www.',
        '.',
        '%20'
    ), array(
        '',
        '',
        '',
        '-',
        ' '
    ), $folderinfo));
	
    
    $filepath = $yjsgmediafolder . 'yjsgparsed' . YJDS . $foldername . YJDS . $filename;
    $filepath = str_replace('/', YJDS, $filepath);
    $fileurl  = JURI::base() . 'media/plg_system_yjsg/yjsgparsed/' . $foldername . '/' . $filename;
    $local    = false;
    
    
    if (!JFolder::exists($yjsgmediafolder)) {
        JFolder::create($yjsgmediafolder . 'yjsgparsed');
        JFile::write($yjsgmediafolder . 'index.html', $indexContent);
        JFile::write($yjsgmediafolder . 'yjsgparsed' . YJDS . 'index.html', $indexContent);
    }
    
    // awesome cache cleanup method :)
    
    $day  = 24 * 3600;
    $hour = 60 * 60 * $hours;
    
    
    if ($days && $days > 0) {
        
        $cachetime = $day * $days + $hour;
        
    } else if (!$days && $hours) {
        
        $cachetime = $hour;
        
    } else {
        
        $cachetime = ($day * 10) + $hour;
    }
    
    if (time() - @filemtime($filepath) > $cachetime) {
        
        JFile::delete($filepath);
    }
    
    
    if (JFile::exists($filepath)) {
        
        
        $getContent = $fileurl;
        $local      = true;
        
    } else {
        
        $getContent = $path;
        $local      = false;
        
    }
    
    $getContent = str_replace(' ', '%20', $getContent);
    
    
    // curl default
    if (!$local && function_exists('curl_init')) {
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $getContent);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $data     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        if (empty($data)) {
            
            $content = JText::_('YJSG_ERROR_PROCESSING_URL') . $httpCode;
            
        } else if ($httpCode >= 200 && $httpCode < 300) {
            
             $content = yjsg_clean_html($data,$allowjs);
             JFile::write($filepath, $content);
            
            
        } else {
            
            $content = JText::_('YJSG_ERROR_PROCESSING_URL') . $httpCode;
        }
        
    // fallback to file_get_contents
    } elseif (!$local && ini_get('allow_url_fopen') && !function_exists('curl_init')) {
        
        $headers = get_headers($getContent);
        preg_match('/\D(\d{3})\D/', $headers[0], $match);
        $httpCode = $match[1];
        
        $data = @file_get_contents($getContent);
        
        
        if (empty($data)) {
            
            $content = JText::_('YJSG_ERROR_PROCESSING_URL') . $httpCode;
            
        } else if ($httpCode >= 200 && $httpCode < 300) {
            
                
       			$content = yjsg_clean_html($data,$allowjs);
                JFile::write($filepath, $content);
            
        } else {
            
            $content =  JText::_('YJSG_ERROR_PROCESSING_URL') . $httpCode;
        }
        
    // none, tell about it
    } else {
        
        $content = JText::_('YJSG_CURL_REQUIRED');
        
    }
	
	if ($local) {
		$content = JFile::read($filepath);
	}
    
    return $content;
}

// cleanup html
function yjsg_clean_html($content,$allowjs) {
    
    $search = array(
        '@<.*?<body.*?>@si',
        '@<\/body.*?>@si',
        '@<\/html.*?>@si',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );
	
	if(!$allowjs){
		
		$search[] = '@<script[^>]*?>.*?</script>@si';
		
	}
    
    $content = preg_replace($search, '', $content);
    return $content;
}

//Function to seperate multiple tags one line
function fix_newlines_for_clean_html($fixthistext) {
    $fixthistext_array = explode("\n", $fixthistext);
    foreach ($fixthistext_array as $unfixedtextkey => $unfixedtextvalue) {
        //Makes sure empty lines are ignored
        if (!preg_match("/^(\s)*$/", $unfixedtextvalue)) {
            $fixedtextvalue                   = preg_replace("/>(\s|\t)*</U", "><", $unfixedtextvalue);
            $fixedtext_array[$unfixedtextkey] = $fixedtextvalue;
        }
    }
	if(!empty($fixedtext_array)){
		
    	return implode("\n", $fixedtext_array);
		
	}else{
		
		return 'missing code snippet';
		
	}
}

function clean_html_code($uncleanhtml, $indent = '	') {
    
    //Uses previous function to seperate tags
    $fixed_uncleanhtml = fix_newlines_for_clean_html($uncleanhtml);
    $uncleanhtml_array = explode("\n", $fixed_uncleanhtml);
    //Sets no indentation
    $indentlevel       = 0;
    foreach ($uncleanhtml_array as $uncleanhtml_key => $currentuncleanhtml) {
        //Removes all indentation
        $currentuncleanhtml = preg_replace("/\t+/", "", $currentuncleanhtml);
        $currentuncleanhtml = preg_replace("/^\s+/", "", $currentuncleanhtml);
        
        $replaceindent = "";
        
        //Sets the indentation from current indentlevel
        for ($o = 0; $o < $indentlevel; $o++) {
            $replaceindent .= $indent;
        }
        
        //If self-closing tag, simply apply indent
        if (preg_match("/<(.+)\/>/", $currentuncleanhtml)) {
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
        }
        //If doctype declaration, simply apply indent
        else if (preg_match("/<!(.*)>/", $currentuncleanhtml)) {
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
        }
        //If php 
        else if (preg_match("/<?php(.*)?>/", $currentuncleanhtml)) {
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
        }
        //If opening AND closing tag on same line, simply apply indent
        else if (preg_match("/<[^\/](.*)>/", $currentuncleanhtml) && preg_match("/<\/(.*)>/", $currentuncleanhtml)) {
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
        }
        //If closing HTML tag or closing JavaScript clams, decrease indentation and then apply the new level
        else if (preg_match("/<\/(.*)>/", $currentuncleanhtml) || preg_match("/^(\s|\t)*\}{1}(\s|\t)*$/", $currentuncleanhtml)) {
            $indentlevel--;
            $replaceindent = "";
            for ($o = 0; $o < $indentlevel; $o++) {
                $replaceindent .= $indent;
            }
            
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
        }
        //If opening HTML tag AND not a stand-alone tag, or opening JavaScript clams, increase indentation and then apply new level
        else if ((preg_match("/<[^\/](.*)>/", $currentuncleanhtml) && !preg_match("/<(link|meta|base|br|img|hr)(.*)>/", $currentuncleanhtml)) || preg_match("/^(\s|\t)*\{{1}(\s|\t)*$/", $currentuncleanhtml)) {
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
            
            $indentlevel++;
            $replaceindent = "";
            for ($o = 0; $o < $indentlevel; $o++) {
                $replaceindent .= $indent;
            }
        } else
        //Else, only apply indentation
            {
            $cleanhtml_array[$uncleanhtml_key] = $replaceindent . $currentuncleanhtml;
        }
    }
    //Return single string seperated by newline
    return implode("\n", $cleanhtml_array);
}

// run shortcode on body match
//$text = preg_replace_callback("/<body[^>]*>(.*?)<\/body>/is","yjsg_run_shortcodes", $text);
function yjsg_run_shortcodes($matches) {
	
	return yjsg_shortcodes($matches[1]);
}

// clean string from shortcode tags
function yjsg_clean_shortcodes($str) {

		$cleanStr = preg_replace(array(
			'/yjsgparse/',
			'/yjsgpre/',
			'/yjsgimgs/',
			'/yjsgfa/',
			'/yjsgmedia/',
			'/yjsgstabsgroup/',
			'/yjsgstabs/',
			'/yjsgnote/',
			'/yjsgacgroup/',
			'/yjsgacs/',
			'/yjsgstabs/',
			'/url="(.*?)"/',
			'/link="(.*?)"/',
			'/poster="(.*?)"/',
			'/width="(.*?)"/',
			'/height="(.*?)"/',
			'/resp="(.*?)"/',
			'/id="(.*?)"/',
			'/title="(.*?)"/',
			'/type="(.*?)"/',
			'/active="(.*?)"/',
			'/color="(.*?)"/',
			'/name="(.*?)"/',
			'/target="(.*?)"/',
			'/class="(.*?)"/',
			'/image="(.*?)"/',
			'/border="(.*?)"/',
			'/radius="(.*?)"/',
			'/icon="(.*?)"/',
			'/close="(.*?)"/',
			'/effect="(.*?)"/',
			'/days="(.*?)"/',
			'/hours="(.*?)"/',
			 '/[^A-Za-z0-9?!\s]/i',
		), array(
			''
		), $str);

		return trim($cleanStr);

}
?>