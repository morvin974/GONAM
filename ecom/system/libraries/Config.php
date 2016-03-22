<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Configuration libraries
 * @version 1.0
 */
 
class Config {

	// Array which contains all loaded settings
	private $settings = array();
	
	// Configurations directories
	private $modConfigDir;
	private $sysConfigDir;
	
	// Constructor
	public function __construct() {
		$this->modConfigDir = APPPATH . 'configs/';
		$this->sysConfigDir = SYSPATH . 'configs/';
		$this->settings['setting'] =& getConfig();
	}
	
	// ------------------------------------------
	
	/**
	 * load
	 * Load a new config file (for libraries or modules)
	 *
	 * @param string $file
	 *		File name
	 *
	 * @param string $alias
	 *		Alias (by default is setting)
	 *
	 * @return bool
	 */
	public function load($file, $alias = 'setting') {
		// If file is a module configuration file
		if (file_exists($this->modConfigDir . clearPath($file) . '.php')) {
			include($this->modConfigDir . clearPath($file) . '.php');
		}
		else if (file_exists($this->sysConfigDir . clearPath($file) . '.php')) { // For libraries
			include($this->sysConfigDir . clearPath($file) . '.php');
		}
		else {	// File doesn't exists
			return FALSE;
		}
		
		$this->settings[$alias] = (isset($this->settings[$alias])) ? array_merge($this->settings[$alias], $config) : $config;
		return TRUE;
	}
	
	/**
	 * get
	 * Get config item
	 *
	 * @param string $name
	 *		Name of case in settings array that you want to get
	 *
	 * @param string $alias = 'setting'
	 *		Alias (by default is setting)
	 *
	 * @return mixed
	 */
	public function get($name, $alias = 'setting') {
		// If case name doesn't exists in array, we can't return it [cpt. obvious]
		if ( ! isset($this->settings[$alias][$name]))
			return '';
		else
			return $this->settings[$alias][$name];
	}
	
	/**
	 * set
	 * Set config item. If the item doesn't exists, we create it.
	 *
	 * @param string $name
	 *		Name of item
	 *
	 * @param mixed $value
	 *		The new value of item that you want to set
	 *
	 * @param string $alias
	 *		Alias
	 *
	 * @return void
	 */
	public function set($name, $value, $alias = 'setting') {
		$this->settings[$alias][$name] = $value;
	}
	
}

/* End of file Config.php */
/* Location : ./system/libraries/Config.php */