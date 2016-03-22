<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Html library
 * @version 1.0
 * @copyright	Copyright (c) 2014, C.Nicolas.
 * @license MIT
 */
 
// ----------------------------------------------

class Html {
	// CSS script
	private $_css = array();
	
	// JavaScript script
	private $_js = array();
	
	// CSS directory
	private $_dirCss = '';
	
	// JavaScript directory
	private $_dirJs = '';
	
	// Page title
	private $_pageTitle = '';
	
	// Page encodage
	private $_pageEnc = 'utf-8';
	
	// Constructor
	public function __construct() {
		$TL =& getInstance();
		$TL->config->load('html', 'html');
		
		// Set default script
		$this->_css = $TL->config->get('cssDefault', 'html');
		$this->_js = $TL->config->get('jsDefault', 'html');
		
		// Set directories
		$this->_dirCss = $TL->config->get('cssDir', 'html');
		$this->_dirJs = $TL->config->get('jsDir', 'html');
		
		// Set default page title
		$this->_pageTitle = $TL->config->get('pageTitle', 'html');
		
		// Set page encodage
		$this->_pageEnv = $TL->config->get('pageEnc', 'html');
		
		// Load html helper
		$TL->load->helper('html');
	}
	
	// ------------------------------------------
	
	public function addCss($name, $file, $pos = -1) {
	
	}
	
	public function rmvCss($name) {
	
	}
	
	public function addJs($name, $file, $pos = -1) {
	
	}
	
	public function rmvJs($name) {
	
	}
	
	public function setTitle($title) {
	
	}
	
	public function getTitle() {
	
	}
	
	public function setEnc($enc) {
	
	}
	
	public function getEnc() {
	
	}
	
	// ------------------------------------------
	
	public function getJs() {
	
	}
	
	public function getCss() {
	
	}
	
	public function generateHeader() {
	
	}
	
}

/* End of file Html.php */
/* Location : ./system/libraries/Html.php */