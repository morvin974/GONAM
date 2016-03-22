<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Vform helper
 * @version 1.0
 * @copyright	Copyright (c) 2014, C.Nicolas.
 * @license MIT
 */

if ( ! function_exists('hasErrorForm')) {
	
	function hasErrorForm() {
		$FW =& getInstance();

		if ( ! $FW->load->isLoaded('vform'))
			$FW->load->library('vform');

		return $FW->vform->hasError();
	}

}

if ( ! function_exists('getErrorForm')) {

	function getErrorForm($field = '') {
		$FW =& getInstance();

		if ( ! $FW->load->isLoaded('vform'))
			$FW->load->library('vform');

		return $FW->vform->getError($field);
	}

}

if ( ! function_exists('getPostData')) {

	function getPostData($field, $escaped = TRUE) {
		$FW =& getInstance();

		if ( ! $FW->load->isLoaded('vform'))
			$FW->load->library('vform');
			
		return $FW->vform->postData($field, $escaped);
	}

}

/* End of file : vform.php */
/* Location : ./system/helpers/vform.php */
