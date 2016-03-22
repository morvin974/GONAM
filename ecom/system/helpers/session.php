<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Session helper
 * @version 1.0
 */
 
if ( ! function_exists('getSessionItem')) {

	function getSessionItem($name) {
		$TL =& getInstance();
		
		if ( ! $TL->load->isLoaded('session'))
			$TL->load->library('session');
			
		return $TL->session->getItem($name);
	}

}

if ( ! function_exists('getSessionFlash')) {

	function getSessionFlash($name) {
		$TL =& getInstance();
		
		if ( ! $TL->load->isLoaded('session'))
			$TL->load->library('session');
			
		return $TL->session->getFlash($name);
	}

}

/* End of file : session.php */
/* Location : ./system/helpers/session.php */