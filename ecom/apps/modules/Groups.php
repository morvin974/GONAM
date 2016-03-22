<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends Controller {

	public function index() {
		$this->view();
	}

	public function view() {
		$this->load->model('Groups_model', 'groups');
		
		$groupData = $this->groups->readAll();
		$this->view->load('groups/view.php', array(
			'groups' => $groupData
		));
	}

	public function add() {
		$this->load->model('Groups_model', 'groups');
		$this->load->library('vform');

		$this->vform->addRules('name', 'Nom', 'required|alphaExt|btwLength[2,24]');
		$this->vform->addRules('level', 'Niveau d\'accès', 'required|isInt|gt[-1]|lt[1000]');

		if ($this->vform->run()) {
			$this->groups->create($_POST['name'], $_POST['level']);
			$this->session->setFlash('groups', 'Groupe enregistré dans la base de donnée.');
			redirectTo( getURL('groups') );
		}
		
		$this->view->load('groups/add.php');
	}

	public function edit() {
		$this->load->model('Groups_model', 'groups');
		$this->load->library('vform');
		
		if (isset($_GET['id']) && $this->groups->isExists($_GET['id'])) {
			$this->vform->addRules('name', 'Nom', 'required|alphaExt|btwLength[2,24]');
			$this->vform->addRules('level', 'Niveau d\'accès', 'required|isInt|gt[-1]|lt[1000]');

			if ($this->vform->run()) {
				$this->groups->update($_GET['id'], $_POST['name'], $_POST['level']);
				$this->_editView($_GET['id'], true);
			}
			else {
				$this->_editView($_GET['id']);
			}
		}
		else {
			showError(404);
		}
	}

	private function _editView($id, $success = false) {
		$this->view->load('groups/edit.php', array(
			'group'		=> $this->groups->read($_GET['id']),
			'success'	=> $success
		));
	}

	public function del() {
		$this->load->model('Groups_model', 'groups');
		$this->load->model('Users_model', 'users');
		$this->load->library('vform');

		if (isset($_GET['id']) && $this->groups->isExists($_GET['id'])) {
			$this->vform->addRules('hidden_confirm', 'hidden_confirm', 'required');
			
			if ($this->vform->run()) {
				if ( ! $this->users->hasGroup($_GET['id'])) {
					$this->groups->delete($_GET['id']);
					$this->session->setFlash('groups', 'Groupe suprimé de la base de donnée.');
					redirectTo( getURL('groups') );
				}
				else {
					$this->_delView($_GET['id'], true);
				}
			}
			else {
				$this->_delView($_GET['id']);
			}
		}
		else {
			showError(404);
		}
	}

	private function _delView($note = false) {
		$this->view->load('groups/del.php', array(
			'group'		=> $this->groups->read($_GET['id']),
			'error'		=> $note
		));
	}

}
