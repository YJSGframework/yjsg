<?php
	/**
	 * @author Constantin Boiangiu ( constantin.b@gmail.com )
	 * @copyright Constantin Boiangiu 2008
	 */	
defined('_JEXEC') or die;	

class JSON
{
	public $result;
	/**
	 * Class constructor
	 *
	 * @param array $array
	 */
	public function __construct( $array )
	{
		$this->json_encode($array);			
	}
	
	/**
	 * Json string builder. It calls itself if array value in key=>value pair is an array.
	 * It cand generate JSON strings from multidimensional array
	 *
	 * @param array $array
	 * @param string $separator
	 * @return void
	 */
	private function json_encode( $array = array(), $separator = '' )
	{
		$this->result .= '{';
		
		$pairs = array();
		foreach ($array as $key=>$value) 
		{
			if( is_array( $value ) )
			{
				$keys = array_keys($array);
				$last_key = end($keys);
				
				$this->result .= '"'.$key.'":';
				$this->json_encode( $value , ($key == $last_key ? '':',') );
			}
			else
				$pairs[] = '"'.$key.'":"'.$this->strip($value).'"'; 
		}
		$this->result .= implode(',',$pairs).'}'.$separator;
	}
	
	private function strip($text, $replace = ' ')
	{
		return preg_replace('!\s+!', $replace, addslashes($text));
	}
	
}