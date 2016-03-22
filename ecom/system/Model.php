<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Model class
 * @version 1.0
 */

class Model {

	/**
	 * __get
	 * Allows models to access at loaded classes using the same syntax
	 * as controllers.
	 *
	 * @param string $key
	 * @return object
	 */
	public function __get($key) {
		$FW =& getInstance();
		return $FW->$key;
	}
	
}

/* End of file Model.php */
/* Location : ./system/Model.php */