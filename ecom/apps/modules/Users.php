<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Controller {

	public function index() {
		$this->view();
	}

	public function view() {
		$this->load->model('Users_model', 'usermng');
	
		$nbPage = ceil($this->usermng->countAll() / 30);
		$page = (isset($_GET['page']) && (intval($_GET['page']) <= $nbPage)) ? intval($_GET['page']) : 1;
	
		$users = $this->usermng->readOrderLimit('user_name', true, (($page - 1) * 30), 30);
		$this->view->load('users/view.php', array(
			'users' 	=> $users,
			'page'		=> $page,
			'nbPage' 	=> $nbPage
		));
	}

	public function add() {
		$this->load->model('Users_model', 'usermng');
		$this->load->model('Groups_model', 'groupmng');
		$this->load->library('vform');

		$this->vform->addRules('uemail', 'E-mail', 'required|email|maxLength[124]|notEmpty');
		$this->vform->addRules('ufirst', 'Nom', 'required|notEmpty|maxLength[32]');
		$this->vform->addRules('uname', 'Prenom', 'required|notEmpty|maxLength[32]');
		$this->vform->addRules('ubirth', 'Date de naissance', 'required|notEmpty');
		$this->vform->addRules('upwd', 'Mot de passe', 'required|notEmpty|btwLength[4,24]');
		$this->vform->addRules('ucfm', 'Confirmer', 'required|notEmpty|matches[upwd]');
		$this->vform->addRules('ugroup', 'Groupe', 'required|notEmpty|isInt');
		$this->vform->addRules('ugender', 'Sexe', 'required|notEmpty');

		if ($this->vform->run()) {
			if (count($this->usermng->readOneByField('user_mail', $_POST['uemail']) === 0)) {
				if ($this->groupmng->isExists($_POST['ugroup'])) {
					$pwd_enc = $this->auth->hashPassword($_POST['upwd']);
					$this->usermng->create($_POST['ugroup'], $_POST['uemail'], $_POST['uname'], $_POST['ufirst'], $pwd_enc, $_POST['ubirth'], $_POST['ugender']);
					$this->load->model('Cart_model', 'cartmng');
					$userData = $this->usermng->readOneByField('user_mail', $_POST['uemail']);
					$this->cartmng->createCart($userData['id_user'], 1, 1);
					redirectTo(getURL('users', 'view'));
				}
				else {
					$this->_add_form('Groupe incorrecte');
				}
			}
			else {
				$this->_add_form('Adresse email déjà utilisé');
			}
		}
		else {
			$this->_add_form();
		}
	}
	
	private function _add_form($error = '') {
		$groups = $this->groupmng->readAll();
		$this->view->load('users/add.php', array(
			'groups' => $groups,
			'error' => $error
		));
	}

	public function edit() {
		$this->load->model('Users_model', 'usermng');
		$this->load->model('Groups_model', 'groupmng');

		$userExists = (isset($_GET['id']) && $this->usermng->hasUser($_GET['id'])) ? true : false;
		if ($userExists) {
			$this->load->library('vform');
			$this->vform->addRules('ufirst', 'Nom', 'required|notEmpty|maxLength[32]');
			$this->vform->addRules('uname', 'Prenom', 'required|notEmpty|maxLength[32]');
			$this->vform->addRules('ubirth', 'Date de naissance', 'required|notEmpty');
			$this->vform->addRules('upwd', 'Mot de passe', 'required|notEmpty|btwLength[4,24]');
			$this->vform->addRules('ucfm', 'Confirmer', 'required|notEmpty|matches[upwd]');
			$this->vform->addRules('ugroup', 'Groupe', 'required|notEmpty|isInt');
			$this->vform->addRules('ugender', 'Sexe', 'required|notEmpty');
			
			if ($this->vform->run()) {
				if ($this->groupmng->isExists($_POST['ugroup'])) {
					$pwd_enc = $this->auth->hashPassword($_POST['upwd']);
					$this->usermng->update($_GET['id'], $_POST['ugroup'], $_POST['uname'], $_POST['ufirst'], $_POST['ubirth'], $_POST['ugender']);
					
					if ($_POST['upwd'] != 'hello')
						$this->usermng->updatePwd($_GET['id'], $pwd_enc);
					
					redirectTo(getURL('users', 'edit', array('id' => $_GET['id'])));
				}
				else {
					$this->_edit_form('Groupe incorrecte');
				}
			}
			else {
				$this->_edit_form();
			}
		}
	}
	
	private function _edit_form($error = '') {
		$groups = $this->groupmng->readAll();
		$userData = $this->usermng->readOneByField('id_user', $_GET['id']);
		$this->view->load('users/edit.php', array(
			'groups' => $groups,
			'userData' => $userData,
			'error' => $error
		));
	}

}
