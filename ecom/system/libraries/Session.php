<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Session library
 * @version 1.0
 */
 
class Session {
	
	// Flash session name
	private $flashName;
	
	// Session cookie name
	private $cookieName;
	
	// Flash session array
	private $flashData = array();
	
	// Constructor
	public function __construct() {
		$TL =& getInstance();
		
		$this->flashName = $TL->config->get('sessionFlash');
		$this->cookieName = session_name();
		
		if (isset($_SESSION[$this->flashName]) && is_array($_SESSION[$this->flashName])) {
			
			foreach ($_SESSION[$this->flashName] as $key => $value) {
				$this->flashData[$key] = $value;
				unset($_SESSION[$this->flashName][$key]);
			}
			
			unset($_SESSION[$this->flashName]);
		}
		
		$TL->load->helper('session');
	}
	
	// ------------------------------------------
	
	/**
	 * setItem
	 * Set session item.
	 *
	 * @param string $name
	 *		Item name
	 *
	 * @param mixed $value
	 *		Item's value
	 *
	 * @return void
	 */
	public function setItem($name, $value) {
		$_SESSION[$name] = $value;
	}
	
	/**
	 * getItem
	 * Return session item. If item doesn't exists return an empty string.
	 *
	 * @param string $name
	 *		Item name
	 *
	 * @return mixed
	 */
	public function getItem($name) {
		if (isset($_SESSION[$name]))
			return $_SESSION[$name];
		else
			return '';
	}
	
	/**
	 * setFlash
	 * Set flash session item.
	 *
	 * @param string $name
	 *		Item name
	 *
	 * @param mixed $value
	 *		Item's value
	 *
	 * @return void
	 */
	public function setFlash($name, $value) {
		$_SESSION[$this->flashName][$name] = $value;
		$this->flashData[$name] = $value;
	}
	
	/**
	 * getFlash
	 * Return flash session item. If item doesn't exists return an empty string.
	 *
	 * @param string $name
	 *		Item name
	 *
	 * @return mixed
	 */
	public function getFlash($name) {
		if (isset($this->flashData[$name]))
			return $this->flashData[$name];
		else
			return '';
	}
	
	/**
	 * delItem
	 * Remove session item.
	 *
	 * @param string $name
	 *		Item name
	 *
	 * @return void
	 */
	public function delItem($name) {
		if (isset($_SESSION[$name]))
			unset($_SESSION[$name]);
	}
	
}

/* End of file Session.php */
/* Location : ./system/libraries/Session.php */