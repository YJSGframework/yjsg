<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
/*
 * Modification of Lessphp Class darken lighten functions to be used outside LESS files
 * lessphp v0.3.8 
 * http://leafo.net/lessphp
 * adapted from http://lesscss.org
*/
defined( '_JEXEC' ) or die( 'Restricted index access' ); 
class Yjsgcolor {

	public function __construct($hex){
		$this->yjsgcolor = $hex;
	}

	function Yjsgcolor($hex){
		self::__construct($hex);
	}

	function coerceColor($value) {
			switch($value[0]) {
				case 'color': return $value;
				case 'raw_color':
					$c = array("color", 0, 0, 0);
					$colorStr = substr($value[1], 1);
					$num = hexdec($colorStr);
					$width = strlen($colorStr) == 3 ? 16 : 256;
	
					for ($i = 3; $i > 0; $i--) { // 3 2 1
						$t = $num % $width;
						$num /= $width;
	
						$c[$i] = $t * (256/$width) + $t * floor(16/$width);
					}
	
					return $c;
				case 'keyword':
					$name = $value[1];
					if (isset(self::$cssColors[$name])) {
						list($r, $g, $b) = explode(',', self::$cssColors[$name]);
						return array('color', $r, $g, $b);
					}
					return null;
			}
	}
	
	
	function assertColor($value, $error = "expected color value") {
		$color = $this->coerceColor($value);
		if (is_null($color)) echo "need color value";
		return $color;
	}

	function colorArgs($args) {
		if ($args[0] != 'list' || count($args[2]) < 2) {
			return array(array('color', 0, 0, 0), 0);
		}
		list($color, $delta) = $args[2];
		$color = $this->assertColor($color);
		$delta = floatval($delta[1]);

		return array($color, $delta);
	}

	function lib_lighten($args) {
		list($color, $delta) = $this->colorArgs($args);

		$hsl = $this->toHSL($color);
		$hsl[3] = $this->clamp($hsl[3] + $delta, 100);
		return $this->toRGB($hsl);
	}

	function lib_darken($args) {
		list($color, $delta) = $this->colorArgs($args);

		$hsl = $this->toHSL($color);
		$hsl[3] = $this->clamp($hsl[3] - $delta, 100);
		return $this->toRGB($hsl);
	}

	function toHSL($color) {
		if ($color[0] == 'hsl') return $color;

		$r = $color[1] / 255;
		$g = $color[2] / 255;
		$b = $color[3] / 255;

		$min = min($r, $g, $b);
		$max = max($r, $g, $b);

		$L = ($min + $max) / 2;
		if ($min == $max) {
			$S = $H = 0;
		} else {
			if ($L < 0.5)
				$S = ($max - $min)/($max + $min);
			else
				$S = ($max - $min)/(2.0 - $max - $min);

			if ($r == $max) $H = ($g - $b)/($max - $min);
			elseif ($g == $max) $H = 2.0 + ($b - $r)/($max - $min);
			elseif ($b == $max) $H = 4.0 + ($r - $g)/($max - $min);

		}

		$out = array('hsl',
			($H < 0 ? $H + 6 : $H)*60,
			$S*100,
			$L*100,
		);

		if (count($color) > 4) $out[] = $color[4]; // copy alpha
		return $out;
	}

	function toRGB_helper($comp, $temp1, $temp2) {
		if ($comp < 0) $comp += 1.0;
		elseif ($comp > 1) $comp -= 1.0;

		if (6 * $comp < 1) return $temp1 + ($temp2 - $temp1) * 6 * $comp;
		if (2 * $comp < 1) return $temp2;
		if (3 * $comp < 2) return $temp1 + ($temp2 - $temp1)*((2/3) - $comp) * 6;

		return $temp1;
	}

	function toRGB($color) {
		if ($color == 'color') return $color;

		$H = $color[1] / 360;
		$S = $color[2] / 100;
		$L = $color[3] / 100;

		if ($S == 0) {
			$r = $g = $b = $L;
		} else {
			$temp2 = $L < 0.5 ?
				$L*(1.0 + $S) :
				$L + $S - $L * $S;

			$temp1 = 2.0 * $L - $temp2;

			$r = $this->toRGB_helper($H + 1/3, $temp1, $temp2);
			$g = $this->toRGB_helper($H, $temp1, $temp2);
			$b = $this->toRGB_helper($H - 1/3, $temp1, $temp2);
		}

		$out = array('color', round($r*255), round($g*255), round($b*255));
		if (count($color) > 4) $out[] = $color[4]; // copy alpha
		return $out;
	}

	function clamp($v, $max = 1, $min = 0) {
		return min($max, max($min, $v));
	}

	function rgbaToHex($color) {
		if ($color[0] != 'color')
			throw new exception("color expected for rgbahex");

		return sprintf("#%02x%02x%02x",
			$color[1],$color[2], $color[3]);
	}
	
	
	//http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
	function Hex2RGB($hex) {
	   $hex = preg_replace("/[^0-9A-Fa-f]/", '', $hex);
	 
	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array('color',$r, $g, $b);
	   return $rgb; // returns an array with the rgb values
	}


	function lighter($percent){
		$percent = str_replace('%', '', $percent);
		$args = array('list', ',', array($this->Hex2RGB($this->yjsgcolor), array('%', $percent)));
		return $this->rgbaToHex($this->lib_lighten($args));
	}

	function darker($percent){
		$percent = str_replace('%', '', $percent);
		$args = array('list', ',', array($this->Hex2RGB($this->yjsgcolor), array('%', $percent)));
		return $this->rgbaToHex($this->lib_darken($args));
	}
}