<?php
/**
 * @package      YJSG Framework
 * @copyright    Copyright(C) since 2007  Youjoomla.com. All Rights Reserved.
 * @author       YouJoomla
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 * @websites     http://www.youjoomla.com | http://www.yjsimplegrid.com
 */
defined( '_JEXEC' ) or die( 'Restricted index access' );

/**
 * Output file via readfile
 */
if ( ! function_exists( '_yjsg_output_req_file' ) ){
	function _yjsg_output_req_file( $file_path ) {
		if ( is_file( $file_path ) ) {
			ob_start();
			echo JFile::read( $file_path );
			return ob_get_clean();
		}
		return false;
	}
}

/**
 * Safe render a view and return html
 * In view will be accessible only passed variables
 * Use this function to not include files directly and to not give access to current context variables (like $this)
 *
 * @param string $file_path
 * @param array $view_variables
 * @param bool $return In some cases, for memory saving reasons, you can disable the use of output buffering
 *
 * @return string HTML
 */
if ( ! function_exists( 'yjsg_render_view' ) ){
	function yjsg_render_view( $file_path, $view_variables = array(), $return = true ) {
		if ( ! is_file( $file_path ) ) {
			return '';
		}
		
		extract( $view_variables, EXTR_REFS );
		unset( $view_variables );
		if ( $return ) {
			ob_start();
			require $file_path;
			return ob_get_clean();
		} else {
			require $file_path;
		}
		
		return '';
	}
}


// Fast CSS minify
if ( ! function_exists( 'yjsg_minify_css' ) ){
	function yjsg_minify_css( $css ) {
		
		$css = preg_replace( '#\s+#', ' ', $css );
		$css = preg_replace( '#/\*.*?\*/#s', '', $css );
		$css = str_replace( '; ', ';', $css );
		$css = str_replace( ': ', ':', $css );
		$css = str_replace( ' {', '{', $css );
		$css = str_replace( '{ ', '{', $css );
		$css = str_replace( ', ', ',', $css );
		$css = str_replace( '} ', '}', $css );
		$css = str_replace( ';}', '}', $css );
	
		return trim( $css );
	}
}


/**
* Module animation options
*/
function yjsg_module_animation_options($params){
	
	return array(
		'animate'	=> $params->get('animate',0),
		'effect'	=> $params->get('animation_effect','yjsg-anim-fadeIn'),
		'duration' 	=> (int) $params->get('animation_duration',400),	
		'delay'		=> (int) $params->get('animation_delay', 0)
	);	
	
}

/**
* Animations data and class
*/
function yjsg_print_animation($options = array(),$class = false,$add_class = false){
	
	if( empty($options) ) {
		return;
	}
	
	$animate 	= $options['animate'];

	if( !$animate ) {
		return;
	}
	
	$effect 		= $options['effect'];
	$duration 		= (int) $options['duration'];	
	$delay 			= (int) $options['delay'];
	$data			= $animate ? ' data-anim-effect="'.$effect.'" data-anim-duration="'.$duration.'" data-anim-delay="'.$delay.'"' : '';

	$add_class		= $add_class ? ' '.$add_class :'';
	$print_class	= $animate ? ' yjsg-animate'.$add_class : '';
	
	if($class){
		return $print_class;
	}	
	
	if(!empty($data)){
		return $data;
	}	
}