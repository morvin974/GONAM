<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Date helper
 * @version 1.0
 */

if ( ! function_exists('dateFormat')) {
	function dateFormat($date, $format, $timezone = '') {
		$obj = ($timezone === '') ? new DateTime($date) : new DateTime($date, $timezone);
		$rtn = $obj->format($format);
		$obj = null;
		
		return $rtn;
	}
}

if ( ! function_exists('dateTimestamp')) {
	function dateTimestamp($date, $timezone = '') {
		$obj = ($timezone === '') ? new DateTime($date) : new DateTime($date, $timezone);
		$rtn = $obj->getTimestamp();
		$obj = null;
		
		return $rtn;
	}
}

/* End of file date.php */
/* Location : ./system/helpers/date.php */