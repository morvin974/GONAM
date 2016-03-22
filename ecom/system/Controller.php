<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller class
 * @version 1.0
 */
 
class Controller {

	private static $instance;
	
	// Constructor
	public function __construct() {
		self::$instance =& $this;
		
		foreach (isLoaded() as $var => $class)
			$this->$var =& loadClass($class);
			
		$this->load =& loadClass('Load');
		$this->load->initialize();
	}
	
	public static function &getInstance() {
		return self::$instance;
	}
	
}

/* End of file Controller.php */
/* Location : ./system/Controller.php */