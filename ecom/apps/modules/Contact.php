<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends Controller {

	public function index() {
		$this->load->model('Firm_model', 'firmMng');
		$this->view->load('home/contact.php', array('data' => $this->firmMng->getfirm(1)));
	}

}