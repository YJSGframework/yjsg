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
defined( '_JEXEC' ) or die( 'Restricted index access' ); ?>
<?php if( $show_fres == 1 || $show_rtlc == 1):?>
<?php
	/**
	 * Set URL for different theme settings
	 *
	 * $add_var contains the variable name and values that needs to be set. Format of this array is:
	 * $add_var = array( variable_name=> array( all variable possible values ) )
	 * 
	 * $replace_vars contains all variables that need to be unset from the current URI. It can contain multiple variables
	 * $replace_vars = array( variable_name=> array( all variable possible values ) )
	 * 
	 * Response is returned as array having the exact same order as the values array from $add_var. 
	 * 
	 * @param array $add_var
	 * @param array $replace_vars
	 * @return array
	 */
	function toolbox_urls( $add_var, $replace_vars ){
		
		$jinput 	= JFactory::getApplication()->input;
		$my_vars 	= $jinput->getArray($_GET);
		$my_request = JURI::current();
		$my_request = str_replace('&','&amp;',$my_request);
		
		// clean link of unwanted variables
		if( is_array( $replace_vars ) ){			
			foreach ( $replace_vars as $var=>$vals ){				
				$exp = '(&amp;)?(\?)?'.$var.'=('.implode('|', $vals).')';
				$my_request = preg_replace("#$exp#", '', $my_request);				
			}			
		}
		$liant = strstr($my_request, '?') ? '&amp;':'?';		
		$response = array();
		// determine the new variable
		$var = array_keys( $add_var );
		$new_var = $var[0];
		// check if variable is already set
		if( array_key_exists( $new_var, $my_vars ) ){
			
			$current_value = $my_vars[$new_var];
			foreach ( $add_var[$new_var] as $val )				
				$response[$val] = $my_request.$liant.$new_var.'='.$val;
				
		}else/* else, simply add variable to URI */{			
			foreach ( $add_var[$new_var] as $var=>$val )
				$response[$val] = $my_request.$liant.$new_var.'='.$val;
		}
		
		return $response;		
	}
	
	
// FONT	
	// create an array containing the variables that need to be unset
	$replace_vars = array(
		'change_direction'=>array(1, 2)
	);
	// create an array containing the new variable and its values. Only one variable can be passed
	$add_var = array(
		'change_font'=>array('increase', 'decrease')
	);
	/* 
		response is stored in $font_size into the same order ar the order from $add_vars values.
		To get a certain value, use it as $font_size['increase'] or $font_size['decrease'] in response	
	*/
	global $font_size;
	$font_size = toolbox_urls( $add_var, $replace_vars );
	
	
// RTL	
	$replace_vars = array(
		'change_font'=>array('increase', 'decrease')
	);
	$add_var = array(
		'change_direction'=>array(1, 2)
	);
	global $font_direction;
	$font_direction = toolbox_urls( $add_var, $replace_vars );
	
?>
<?php endif;?>