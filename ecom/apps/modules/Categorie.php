<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Categorie extends Controller {
	
	public function index() {
		$this->load->library('view') ;
		$this->load->model('Categorie_model','cmod');	
		$data = $this->cmod->listeCategorie();
		$this->view->load("Categorie_view/Categorie_view.php",array('data' => $data));
		
	}
	
	public function admin(){
		$this->load->model('Categorie_model');
		$this->load->library('view') ;

		if(isset($_GET['idcategory'])){ // dans le cas enfant 
			$mere = $this->Categorie_model->getCategorie($_GET['idcategory']);
			$data = $this->Categorie_model->getEnfant($_GET['idcategory']); 
			$this->view->load('Categorie_view/CategorieAdmin_view.php', array('data' => $data, 'mere' => $mere));
		}
		else { // dans le cas categorie racine sans parent
	
			$data = $this->Categorie_model->getAllCategoriesRacines();
			$this->view->load('Categorie_view/CategorieAdmin_view.php', array('data' => $data));
		}
	}
	
	
	public function afficherCreerCategorie(){
			$this->load->model('Categorie_model','cmod');	
			$this->load->library('vform');
			$data = $this->cmod->listeCategorie();
			if(isset($_GET['idcategorie'])){
				$idcategorie=$_GET['idcategorie'];
				$this->view->load("Categorie_view/CategorieCreation_view.php",array('data' => $data, 'idcategorie' => $idcategorie ));
			}
			else {
				$this->view->load("Categorie_view/CategorieCreation_view.php",array('data' => $data));
			}
	}
	
	public function creerCategorie(){
		$this->load->model('Categorie_model','cmod');
		$this->load->library('vform');
		$this->vform->addrules('cat_name','Nom de la categorie','required|maxLength[124]');
		$this->vform->addrules('cat_desc','Descritpion','maxLength[800]');
		
		if($this->vform->run()){
		
			if($_POST['cat_parent']!=-1){
				$this->cmod->creerCategorie(false);
			}
			else {
				$this->cmod->creerCategorie(true);
			}
		}
		else{
			$this->afficherCreerCategorie();
		}
		
		$this->admin();
	}
	
	public function supprimerCategorie(){
		$this->load->model('Categorie_model','cmod');
		$this->cmod->supprimerCategorie($_POST['id_category']);
		$this->view->load("Categorie_view/CategorieCreer_view.php");
	}
	
	public function getCategorie($id){
		$this->load->model('Categorie_model','cmod');
		return $this->cmod->getCategorie($id);
	}
	
	public function afficherModificationCategorie(){
		$this->load->model('Categorie_model','cmod');
		$this->load->library('vform');
		
		$data = $this->cmod->getCategorie($_GET['id']) ;
		
		$this->view->load("Categorie_view/CategorieModfication_view.php",array('data' => $data , 'cat_parent' => $this->cmod->listeCategorie()));
		
	}
	
	public function modifierCategorie(){
		$this->load->model('Categorie_model','cmod');
		$this->load->library('vform');
		$this->vform->addrules('cat_name','Nom de la categorie','required|maxLength[124]');
		$this->vform->addrules('cat_desc','Descritpion','required|minLength[3]|maxLength[800]');
		if($this->vform->run()){
			$this->cmod->modifierCategorie($_GET['id']);
			$this->admin();
		}
		else{
			$this->afficherModificationCategorie();
		}
	}





}




?>
