<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * AuthHook
 * @version 1.0
 * @author Candia Nicolas
 */

class AuthHook {
	
	// Instance of framework
	private $TL;
	
	// Constructor
	public function __construct() {
		$this->TL =& getInstance();
		
		if ( ! $this->TL->load->isLoaded('auth'))
			$this->TL->load->library('auth');
		
		$this->verifyHasLevel();
	}
	
	// -------------------------------------------
	
	public function verifyHasLevel() {
		$minLevel = $this->TL->auth->getAccessLevel(
				strtolower($this->TL->router->getController()),
				$this->TL->router->getMethod()
		);
		
		if ( ! $this->TL->auth->hasLevel($this->TL->auth->getCurrentId(), $minLevel)) {
			showError('Vous n\'avez pas les droits requis pour accèder à cette page.', 403);
		}
	}
	
}

/* End of file AuthHook.php */
/* Location : ./apps/hooks/AuthHook */