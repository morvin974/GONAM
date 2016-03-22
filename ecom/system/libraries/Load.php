<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Loader library
 * @version 1.0
 */
 
class Load {
	
	// List of loaded base classes
	protected $baseClasses = array();

	// List of cached variables
	protected $cachedVars = array();

	// List of loaded classes
	protected $classes = array();

	// List of loaded files
	protected $loadedFiles = array();

	// List of loaded models
	protected $models = array();

	// List of loaded helpers
	protected $helpers = array();

	// --------------------------------------

	/**
	 * initialize
	 * Initialize the loader.
	 *
	 * @return object
	 */
	public function initialize() {
		$this->classes = array();
		$this->loadedFiles = array();
		$this->models = array();
		
		$this->baseClasses =& isLoaded();
		$this->_autoloader();
		return $this;
	}

	/**
	 * isLoaded
	 * Check if a class is already loaded.
	 *
	 * @param string $class
	 *		class name
	 *
	 * @return bool
	 */
	public function isLoaded($class) {
		return (isset($this->classes[$class]) === TRUE);
	}

	
	/**
	 * library
	 * Class loader.
	 *
	 * @param string $class
	 *		Class name
	 * 
	 * @param array $params
	 *		Optional parameters
	 *
	 * @param string $name
	 *		Name of var for the object that be instancied
	 *
	 * @return bool
	 */
	public function library($library, $params = array(), $name = '') {
		if ($library === '' || isset($this->baseClasses[$library]))
			return FALSE;

		if (is_array($params) === FALSE)
			$params = array();

		return $this->_loadClass($library, $params, $name);
	}

	/**
	 * model
	 * Model loader
	 *
	 * @param string $model
	 *		Model name
	 * 
	 * @param string $alias
	 *		Name of var for the object that be instancied
	 *
	 * @return bool
	 */
	public function model($model, $alias = '') {
		if ($model === '')
			return FALSE;
		
		$name = ($alias === '') ? $model : $alias;

		if (in_array($name, $this->models, TRUE) === TRUE)
			return TRUE;

		$instance =& getInstance();
		
		if (isset($instance->$name) === TRUE)
			showError('The model name you are trying to load is the name of ressource that is already being used : ' . htmlentities($name));

		if (file_exists(APPPATH . 'models/' . clearPath($model) . '.php') === FALSE)
			showError('Unable to locate model that you have specified : ' . htmlentities($model));

		if (class_exists('Model') === FALSE)
			require_once(SYSPATH . 'Model.php');

		require_once(APPPATH . 'models/' . clearPath($model) . '.php');
		
		$modelClass = ucfirst($model);
		$instance->$name = new $modelClass();
		$this->models[] = $name;
		return TRUE;
	}
	
	/**
	 * helper
	 * Load helper
	 *
	 * @param string $helper
	 *		Helper name
	 *
	 * @return void
	 */
	public function helper($helper) {
		if (in_array($helper, $this->helpers, TRUE))
			return;
			
		if (file_exists(SYSPATH . 'helpers/' . clearPath($helper) . '.php') !== TRUE)
			showError('Unable to load the requested file : helpers/' . htmlentities($helper) . '.php');
		
		include_once(SYSPATH . 'helpers/' . clearPath($helper) . '.php');
		$this->helpers[] = $helper;
		return;
	}
	
	/**
	 * _loadClass
	 * Loads the requested classes.
	 * @access private
	 *
	 * @param string $class
	 *		Class that is being loaded
	 *
	 * @param array $params
	 *		Optional parameters
	 *
	 * @param string $name
	 *		Name of var for the object that be instancied
	 *
	 * @return void
	 */
	private function _loadClass($class, $params = array(), $name = '') {
		$className = ucfirst(str_replace('.php', '', trim($class, '/')));
		$filepath = SYSPATH . 'libraries/' . clearPath($className) . '.php';
		
		if (in_array($filepath, $this->loadedFiles) === TRUE ) {
			if ($name !== '' && isset($FW->$name) === FALSE) {
				$FW =& getInstance();
				$this->_initClass($class, $params, $name);
			}
			return;
		}
		
		if (file_exists($filepath) === FALSE)
			showError('Unable ro load the requested class : ' . htmlentities($class));
			
		include_once($filepath);
		$this->loadedFiles[] = $filepath;
		$this->_initClass($class, $params, $name);
		return;
	}
	
	/**
	 * _initClass
	 * Instance classes
	 * @access private
	 *
	 * @param string $class
	 *		Class that is being instancied
	 *
	 * @param array $params
	 *		Optional parameters
	 *
	 * @param string $name
	 *		Name of var for the object that be instancied
	 *
	 * @return void
	 */
	private function _initClass($class, $params = array(), $name = '') {
		if (class_exists($class) === FALSE)
			showError('Non-existent class : ' . htmlentities($class));
			
		$class = strtolower($class);
		$classVar = ($name === '') ? $class : $name;
		
		$this->classes[$class] = $classVar;
		
		$FW =& getInstance();
		
		
		if (empty($params) === TRUE) {
			$FW->$classVar = new $class();
		}
		else {
			$r = new ReflectionClass($class);
			$FW->$classVar = $r->newInstanceArgs($params);
		}
	}
	
	/**
	 * _hook
	 * Load and execute hook
	 * @access private
	 *
	 * @param string $hook
	 *		Class name of hook (or file name without .php)
	 *
	 * @param string $method
	 *		Method to execute (optional)
	 *
	 * return void
	 */
	private function _hook($hook, $method = '') {
		$className = ucfirst(str_replace('.php', '', trim($hook, '/')));
		
		if (file_exists(APPPATH . 'hooks/' . clearPath($hook) . '.php') === FALSE)
			showError('Unable to load the requested file : hooks/' . htmlentities($hook) . '.php');
			
		include_once(APPPATH . 'hooks/' . clearPath($hook) . '.php');
		$handle = new $className();
		
		if ($method !== '' && method_exists($handle, $method) === TRUE)
			$handle->$method();
	}
	
	/**
	 * _autoloader
	 * Config file : configs/autoload.php contains an array that allow models, helpers,
	 * libraries, localization and hooks to be loaded automatically before call controller
	 * method.
	 * @access private
	 *
	 * @return void
	 */
	private function _autoloader() {
		if (file_exists(SYSPATH . 'configs/autoload.php') === FALSE)
			return;
			
		include_once(SYSPATH . 'configs/autoload.php');
		if (isset($autoload) === FALSE)
			return;
			
		// Load languages
		if (isset($autoload['langs']) && is_array($autoload['langs'])) {
			$FW =& getInstance();
			foreach ($autoload['langs'] as $lang) {
				$FW->lang->load($lang);
			}
		}
			
		// Load helpers
		if (isset($autoload['helpers']) && is_array($autoload['helpers'])) {
			foreach ($autoload['helpers'] as $helper)
				$this->helper($helper);
		}
		
		// Load libraries
		if (isset($autoload['libraries']) && is_array($autoload['libraries'])) {
			foreach ($autoload['libraries'] as $library) {
				$this->library($library);
			}
		}
		
		// Loads models
		if (isset($autoload['models']) && is_array($autoload['models'])) {
			foreach ($autoload['models'] as $model)
				$this->model($model);
		}
		
		// Loads hooks
		if (isset($autoload['hooks']) && is_array($autoload['hooks'])) {
			foreach ($autoload['hooks'] as $hook) {
				$this->_hook($hook);
			}
		}
		
		// End
	}
	
}

/* End of file Load.php */
/* Location : ./system/libraries/Load.php */
