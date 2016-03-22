<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View library
 * @version 1.0
 */
 
class View {
	
	// Framework instance
	private $FW;
	
	// Constructor
	public function __construct() {
		$this->FW =& getInstance();
	}
	
	// ------------------------------------------
	
	/**
	 * load
	 * Load view file and set to output.
	 *
	 * @param string $_file
	 *		The file that will be loaded
	 *
	 * @param array/object $_data
	 *		Variables that will be passed to the view (optional)
	 *
	 * @param bool $_dir
	 *		Location of views folder (optional, default is APPPATH . 'views/' (optional)
	 *
	 * @return bool
	 */
	public function load($_file, $_data = array(), $_dir = '') {
		if ($_dir === '')
			$_dir = APPPATH . 'views/';
			
		if ( ! file_exists($_dir . $_file))
			return FALSE;
			
		$data = $this->_objectToArray($_data);
		extract($_data);
		
		ob_start();
		include($_dir . $_file);
		$this->FW->output->appendOutput(ob_get_contents());
		ob_end_clean();
		
		return TRUE;
	}
	
	/**
	 * _objectToArray
	 * Takes an object as input and converts class variables to array key/values.
	 * @access private
	 * 
	 * @param object $object
	 *		Object that you want to convert
	 *
	 * @return array
	 */
	private function _objectToArray($object) {
		return (is_object($object)) ? get_object_vars($object) : $object;
	}
	
}

/* End of file View.php */
/* Location : ./system/libraries/View.php */