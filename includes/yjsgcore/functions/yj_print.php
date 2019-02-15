<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
// no direct access 
defined('_JEXEC') or die('Restricted access');

class YJ_Dumper
{
	private static $_objects;
	private static $_output;
	private static $_depth;
	/**
	 * Converts a variable into a string representation.
	 * This method achieves the similar functionality as var_dump and print_r
	 * but is more robust when handling complex objects such as PRADO controls.
	 * @param mixed $var     Variable to be dumped
	 * @param integer $depth Maximum depth that the dumper should go into the variable. Defaults to 10.
	 * @return string the string representation of the variable
	 */
	public static function dump($var, $depth=10)
	{
		self::reset_internals();
		self::$_depth=$depth;
		self::dump_internal($var,0);
		$output = self::$_output;
		self::reset_internals();
		return $output;
	}
	private static function reset_internals()
	{
		self::$_output='';
		self::$_objects=array();
		self::$_depth=10;
	}
	private static function dump_internal($var,$level)
	{
		switch(gettype($var)) {
			case 'boolean':
				self::$_output.=$var?'true':'false';
				break;
			case 'integer':
				self::$_output.="$var";
				break;
			case 'double':
				self::$_output.="$var";
				break;
			case 'string':
				self::$_output.="'$var'";
				break;
			case 'resource':
				self::$_output.='{resource}';
				break;
			case 'NULL':
				self::$_output.="null";
				break;
			case 'unknown type':
				self::$_output.='{unknown}';
				break;
			case 'array':
				if(self::$_depth<=$level)
					self::$_output.='array(...)';
				else if(empty($var))
					self::$_output.='array()';
				else
				{
					$keys=array_keys($var);
					$spaces=str_repeat(' ',$level*4);
					self::$_output.="array\n".$spaces.'(';
					foreach($keys as $key)
					{
						self::$_output.="\n".$spaces."    [$key] => ";
						self::$_output.=self::dump_internal($var[$key],$level+1);
					}
					self::$_output.="\n".$spaces.')';
				}
				break;
			case 'object':
				if(($id=array_search($var,self::$_objects,true))!==false)
					self::$_output.=get_class($var).'(...)';
				else if(self::$_depth<=$level)
					self::$_output.=get_class($var).'(...)';
				else
				{
					$id=array_push(self::$_objects,$var);
					$class_name=get_class($var);
					$members=(array)$var;
					$keys=array_keys($members);
					$spaces=str_repeat(' ',$level*4);
					self::$_output.="$class_name\n".$spaces.'(';
					foreach($keys as $key)
					{
						$key_display=strtr(trim($key),array("\0"=>':'));
						self::$_output.="\n".$spaces."    [$key_display] => ";
						self::$_output.=self::dump_internal($members[$key],$level+1);
					}
					self::$_output.="\n".$spaces.')';
				}
				break;
		}
	}
}


/**
 * print_r() alternative
 *
 * @param mixed $value Value to debug
 */
function yj_print( $value ) {
	static $first_time = true;
	if ( $first_time ) {
		ob_start();
		echo '<style type="text/css">
		div.fw_print_r {
			max-height: 500px;
			overflow-y: scroll;
			background: #23282d;
			margin: 10px 30px;
			padding: 0;
			border: 1px solid #F5F5F5;
			border-radius: 3px;
			position: relative;
			z-index: 11111;
		}
		div.fw_print_r pre {
			color: #78FF5B;
			background: #23282d;
			text-shadow: 1px 1px 0 #000;
			font-family: Consolas, monospace;
			font-size: 12px;
			margin: 0;
			padding: 5px;
			display: block;
			line-height: 16px;
			text-align: left;
		}
		div.fw_print_r_group {
			background: #f1f1f1;
			margin: 10px 30px;
			padding: 1px;
			border-radius: 5px;
			position: relative;
			z-index: 11110;
		}
		div.fw_print_r_group div.fw_print_r {
			margin: 9px;
			border-width: 0;
		}
		</style>';
		echo str_replace( array( '  ', "\n" ), '', ob_get_clean() );
		$first_time = false;
	}
	if ( func_num_args() == 1 ) {
		echo '<div class="fw_print_r"><pre>';
		echo yj_htmlspecialchars( YJ_Dumper::dump( $value ) );
		echo '</pre></div>';
	} else {
		echo '<div class="fw_print_r_group">';
		foreach ( func_get_args() as $param ) {
			yj_print( $param );
		}
		echo '</div>';
	}
}

function yj_htmlspecialchars( $string ) {
	return htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
}