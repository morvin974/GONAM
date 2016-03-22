<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access extends Controller {

	public function index() {
		$this->view();
	}
	
	public function view() {
		$this->load->model('Access_model', 'access');
		$this->view->load('access/view.php', array(
			'data' => $this->access->readAll()
		));
	}
	
	public function add() {
		$this->load->library('vform');
		$this->vform->addRules('page', 'Page', 'required|notEmpty');
		$this->vform->addRules('level', 'Niveau requis', 'required|notEmpty|isInt');
		
		if ($this->vform->run()) {
			$this->load->model('Access_model', 'access');
			$this->access->add($_POST['page'], $_POST['level']);
			redirectTo(getURL('access'));
		}
		else {
			$this->view->load('access/add.php');
		}
	}
	
	public function del() {
		$this->load->model('Access_model', 'access');
		
		if (isset($_GET['page']) && $this->access->isExists($_GET['page'])) {
			$this->access->del($_GET['page']);
			redirectTo(getURL('access'));
		}
		else {
			showError(404);
		}
	}

}