<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Router library
 * @version 1.0
 */
 
class Router {
	
	// Configuration library instance
	private $config;
	
	// Language library instance
	private $lang;
	
	// Constructor
	public function __construct() {
		$this->config =& loadClass('Config');
		$this->lang =& loadClass('Lang');
	}
	
	// ------------------------------------------
	
	/**
	 * getController
	 * Return controller name, by default controller is $_GET['m'] and
	 * if any controller is specified, we return the default controller in
	 * general configuration file.
	 *
	 * @return string
	 */
	public function getController() {
		if (isset($_GET[$this->config->get('controllerParam')]))
			return clearPath(urldecode($_GET[$this->config->get('controllerParam')]));
		else
			return clearPath($this->config->get('defaultController'));
	}
	
	/**
	 * getMethod
	 * Return method name, by default method is $_GET['a'] and if any method
	 * is specified, we return the default method in general configuration file.
	 *
	 * @return string
	 */
	public function getMethod() {
		if (isset($_GET[$this->config->get('methodParam')]))
			return urldecode($_GET[$this->config->get('methodParam')]);
		else
			return $this->config->get('defaultMethod');
	}
	
	/**
	 * launch
	 * Load right controller and call the correct method. If controller or method
	 * doesn't exists we make a 404 error.
	 *
	 * @return void
	 */
	public function launch() {
		$controller = ucfirst($this->getController());
		$method = $this->getMethod();
		
		if (file_exists(APPPATH . 'modules/' . $controller . '.php') === FALSE)
			showError($this->lang->line('syserr_notfound'), 404, SYSPATH . 'includes/errors/404.php');
		
		include_once(APPPATH . 'modules/' . $controller . '.php');
		
		if (class_exists($controller) === FALSE)
			showError($this->lang->line('syserr_notfound'), 404, SYSPATH . 'includes/errors/404.php');

		$app = new $controller();
		
		if (method_exists($app, $method) === FALSE)
			showError($this->lang->line('syserr_notfound'), 404, SYSPATH . 'includes/errors/404.php');
		
		
		$app->$method();
	}
	
}

/* End of file Router.php */
/* Location : ./system/libraries/Router.php */