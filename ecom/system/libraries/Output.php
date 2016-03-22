<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Output library
 * @version 1.0
 */
 
class Output {
	
	// Variable which contain output
	private $output;
	
	// Constructor
	public function __construct() {
		$this->ouput = '';
	}
	
	// ------------------------------------------
	
	/**
	 * setOutput
	 *
	 * @param string $value
	 *		Value of output
	 *
	 * @return void
	 */
	public function setOutput($value) {
		$this->output = $value;
	}
	
	/**
	 * getOutput
	 * @return string
	 */
	public function getOutput() {
		return $this->output;
	}
	
	/**
	 * appendOutput
	 * Add data in output
	 *
	 * @param string $data
	 *		Data that you want to add in output
	 *
	 * @return void
	 */
	public function appendOutput($data) {
		$this->output .= $data;
	}
	
	/**
	 * addHeader
	 * 
	 * @param mixed $header
	 *		Header(s) line(s) that you want to add
	 *
	 * @return void
	 */
	public function addHeader($header) {
		if (is_array($header) === TRUE) {
			foreach($header as $data)
				header($data);
		}
		else
			header($header);
	}
	
	/**
	 * setOutputType
	 *
	 * @param string $type
	 *		mime-type of output
	 *
	 * @return void
	 */
	public function setOutputType($type = 'text/html') {
		$this->addHeader('Content-Type: ' . $type);
	}
	
}

/* End of file Output.php */
/* Location : ./system/libraries/Output.php */