<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Controller {
	
	public function index() {
		if ($this->auth->isLogin()) {
			$this->home();
		}
		else {
			$this->login();
		}
	}
	
	public function home() {
		if (! $this->auth->isLogin())
			redirectTo(getURL('account', 'login'));
		
		$this->load->model('Users_model', 'usermng');
		$userData = $this->usermng->readOneByField('id_user', $this->auth->getCurrentId());
		
		$this->load->library('vform');
		$this->vform->addRules('password', 'Mot de passe', 'required|notEmpty|btwLength[6,24]');
		$this->vform->addRules('newpwd', 'Nouveau mot de passe', 'required|notEmpty|btwLength[6,24]');
		$this->vform->addRules('confpwd', 'Confirmer', 'required|notEmpty|matches[newpwd]');
		
		if ($this->vform->run()) {
			if ($this->auth->hashPassword($_POST['password']) == $userData['user_password']) {
				$this->usermng->updatePwd($this->auth->getCurrentId(), $this->auth->hashPassword($_POST['confpwd']));
			}
		}
		
		$this->load->model('Order_model', 'ordermng');
		$orderData = $this->ordermng->getOrderCurrentUser();
		
		$this->view->load('account/home.php', array(
			'user' => $userData,
			'order' => $orderData
		));
	}
	
	public function login() {
		if ($this->auth->isLogin())
			redirectTo(getURL('home'));
		
		$this->load->library('vform');
		$this->vform->addRules('user_mail', 'E-mail', 'required|notEmpty|maxLength[124]|email');
		$this->vform->addRules('user_password', 'Mot de passe', 'required|notEmpty|btwLength[6,24]');
		
		if ($this->vform->run()) {
			if ($this->auth->authUser($_POST['user_mail'], $_POST['user_password'])) {
				$this->load->model('Cart_model', 'cartmng');
				$this->cartmng->loginFunsionCart();
				
				$this->view->load('notice.php', array(
					'msg' => 'Connexion réussi. Bienvenue ' . htmlentities(getSessionItem('user')) . '.',
					'url' => getURL('home')
				));
			}
			else {
				$this->view->load('account/login.php', array(
					'error' => 'Adresse e-mail ou mot de passe incorrect(s) !'
				));
			}
		}
		else {
			$this->view->load('account/login.php', array('error' => ''));
		}
	}
	
	public function logout() {
		if ( ! $this->auth->isLogin())
			redirectTo(getURL('account'));
		
		$this->auth->unAuth();
		$this->view->load('notice.php', array(
			'msg' => 'Déconnexion réussi. À bientôt.',
			'url' => getURL('home')
		));
	}
	
	public function register() {
		
		$this->load->model('Users_model', 'usermng');
		$this->load->model('Groups_model', 'groupmng');
		$this->load->library('vform');
		$this->load->helper('date');
		
		$this->vform->addRules('user_mail', 'E-mail', 'required|email|maxLength[124]|notEmpty');
		$this->vform->addRules('user_name', 'Nom', 'required|notEmpty|maxLength[32]');
		$this->vform->addRules('user_firstname', 'Prenom', 'required|notEmpty|maxLength[32]');
		$this->vform->addRules('user_birthday', 'Date de naissance', 'required|notEmpty');
		$this->vform->addRules('user_password', 'Mot de passe', 'required|notEmpty|btwLength[6,24]');
		$this->vform->addRules('pwdconfirm', 'Confirmer', 'required|notEmpty|matches[user_password]');
		$this->vform->addRules('user_gender', 'Sexe', 'required|notEmpty');
		
		if ($this->vform->run()) {
			if ($this->usermng->countByEmail($_POST['user_mail']) == 0) {
				$pwd_enc = $this->auth->hashPassword($_POST['user_password']);
				$this->usermng->create(1, 
					$_POST['user_mail'], 
					$_POST['user_firstname'], 
					$_POST['user_name'], 
					$pwd_enc, 
					dateFormat($_POST['user_birthday'], 'Y-m-d'), 
					$_POST['user_gender']
				);
				
				$this->load->model('Cart_model', 'cartmng');
				$userData = $this->usermng->readOneByField('user_mail', $_POST['user_mail']);
				$this->cartmng->createCart($userData['id_user'], 1, 1);
				
				$this->view->load('notice.php', array(
					'url' => getURL('account'),
					'msg' => 'Inscription réussi, ne vous remerciont de votre confiance.'
				));
			}
			else {
				$this->_registerForm('Adresse e-mail non disponible, veuillez utiliser une autre adresse.');
			}
		}
		else {
			$this->_registerForm();
		}
	}
	
	private function _registerForm($error = '') {
		$this->view->load('account/register.php', array(
			'error' => $error
		));
	}
	
}
