<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Auth helper
 * @version 1.0
 */

if ( ! function_exists('isLogin')) {
	
	function isLogin() {
		$TL =& getInstance();
		
		if ( ! $TL->load->isLoaded('auth'))
			$TL->load->library('auth');
		
		return $TL->auth->isLogin();
	}
	
}

if ( ! function_exists('getCurrentAuthId')) {
		
	function getCurrentAuthId() {
		$TL =& getInstance();
		
		if ( ! $TL->load->isLoaded('auth'))
			$TL->load->library('auth');
		
		return $TL->auth->getCurrentId();
	}
	
}

if ( ! function_exists('hasAuthLevel')) {
	
	function hasAuthLevel($level) {
		$TL =& getInstance();
		
		if ( ! $TL->load->isLoaded('auth'))
		$TL->load->library('auth');
		
		return $TL->hasLevel(getCurrentAuthId(), $level);
	}
	
}

if ( ! function_exists('getAccessLevel')) {
	
	function getAccessLevel($controller, $method = '') {
		$TL =& getInstance();
		
		if ( ! $TL->load->isLoaded('auth'))
			$TL->load->library('auth');
		
		return $TL->auth->getAccessLevel($controller, $method);
	}
	
}

/* End of file auth.php */
/* Location : ./system/helpers/auth.php */