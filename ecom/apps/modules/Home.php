<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Controller {
	
	public function index() {
		$this->load->model('Article_model');
		$listeLesPlusVendus = $this->Article_model->getLesPlusVendus();
		$listeNouveaux = $this->Article_model->getNouveauxArticles();
		$listeLesMieuxNotés = $this->Article_model->getLesMieuxNotes();
		
		$data = array($listeNouveaux, $listeLesPlusVendus, $listeLesMieuxNotés);
		$this->load->library('view') ;
		$this->view->load("home/home.php", array('data' => $data));
	}
	
	/*public function index() {
		$this->view->load('home/view.php');
	}*/
	
	public function article() {
		$this->view->load('example/article.php');
	}
	
	public function liste() {
		$this->view->load('example/liste.php');
	}
	
	public function all() {
		$this->view->load('example/all.php');
	}
	
	public function notice() {
		$this->view->load('notice.php', array(
			'url' => 'hello',
			'msg' => 'Ceci est une notice d\'exemple. Lorem ipsum sit dolor amet.'
		));
	}
	
}
