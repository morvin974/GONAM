<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Controller {

	public function index() {
		$this->view->load('admin.php');
	}
	
}