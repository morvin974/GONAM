<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends Controller {
	
	public function add() {
		$this->load->model('Article_model');
		
		$this->load->library('vform');
		$this->vform->addRules('article_brand', 'Marque', 'required|notEmpty|maxLength[32]');		
		$this->vform->addRules('article_description', 'Description', 'required|notEmpty|maxLength[3200]');		
		$this->vform->addRules('article_photo', 'Photo', 'required|maxLength[128]');		
		$this->vform->addRules('article_price_dutyfree', 'Prix', 'required|notEmpty|isNumeric|maxLength[28]');
		$this->vform->addRules('article_title', 'Titre', 'required|notEmpty|maxLength[64]');
		$this->vform->addRules('article_weight', 'Masse', 'required|notEmpty|isNumeric|maxLength[8]');		
		
		if($this->vform->run()){
			$data = $this->Article_model->creerArticle($_POST['article_brand'],
				$_POST['article_description'],
				$_POST['article_photo'],
				$_POST['article_price_dutyfree'],
				0,
				$_POST['article_title'],
				$_POST['article_weight'],
				$_POST['id_category'],
				$_GET['art']
			);
					
			$this->view->load('notice.php', array(
				'msg' => 'L\'ajout a été effectué',
				'url' => getURL('article','admin') // url de redirection
			));
		}
		else {
			$this->_addForm();	
		}
	}
	
	private function _addForm() {
		$this->load->model('Article_model', 'artmng');
		$this->load->model('Categorie_model', 'catmng');
		
		if (isset($_GET['art'])) {
			$artData = $this->artmng->selectStockArticle($_GET['art']);
			$catData = $this->catmng->listeCategorie();
			
			$this->view->load('article/add.php', array(
				'artData' => $artData,
				'catData' => $catData
			));
		}
		else {
			showError('', 404);
		}
	}
	
	public function addSelect() {
		$this->load->model('Article_model', 'artmng');
		
		if (isset($_GET['cat'])) {
			$articles = $this->artmng->selectStockArticleByCategory($_GET['cat']);
			$this->view->load('article/addSelectArt.php', array(
				'articles' => $articles
			));
		}
		else {
			$categories = $this->artmng->selectStockCategories();
			$this->view->load('article/addSelect.php', array(
				'categories' => $categories
			));
		}
	}
	
	public function addStock() {
		$this->load->library('vform');
		$this->vform->addRules('article_stock', 'stock', 'required|isInt|lt[1000]');
	
		if ($this->vform->run()) {
			$this->load->model('Article_model', 'artmng');
			$this->artmng->updateStock($_GET['id'], $_POST['article_stock']);
		}
		
		redirectTo(getURL('article', 'modifierArticle', array('idarticle' => $_GET['id'])));
	}
	
	// --------------------------------------------------------------
	
	public function index() {
		$this->afficherListeArticle();
	}
	
	public function admin(){
		$this->load->library('view');
		$this->load->model('Article_model');
		
		$data = $this->Article_model->listeArticle();
		$this->view->load("Article_view/ArticleAdmin_view.php",array('data' => $data));
	}
	
	public function afficherListeArticle(){
	
		$this->load->model('Article_model');
		
		
		if(isset($_GET['idcategorie'])){ // pour une categorie
			$list = $this->Article_model->listeArticleParCategorie($_GET['idcategorie']);
			if($list==false){
				showError($this->lang->line('syserr_notfound'), 404, SYSPATH . 'includes/errors/404.php');
			}
			$categorie=true;
		} 
		else { // pour afficher tous les articles
			$list = $this->Article_model->listeArticle();
			$this->load->library('view') ;
			$categorie=false;
	
		}
		$this->load->library('view') ;
		$this->view->load("Article_view/ArticleList_view.php",array('data' => $list, 'categorie' => $categorie));
		
	}

    public function ficheArticle($idarticle=null){
        $this->load->model('Article_model');
        $this->load->model('Comment_model');
		
        $data = array();
        if((isset($_GET['idarticle']) || $idarticle!=null ) && $this->Article_model->getArticle($_GET['idarticle'])!=false){

			if($idarticle==null){
				$idarticle=$_GET['idarticle'];
			}
		
            if($this->Comment_model->getCommentArticle($idarticle)!=false){
                $data = array($this->Article_model->getArticle($idarticle),$this->Comment_model->getCommentArticle($idarticle), $this->Article_model->getMoyenne($idarticle) );
            }
            else {
                $data = array($this->Article_model->getArticle($idarticle));
            }

            $this->load->library('view');
            $this->view->load("Article_view/ArticleFiche_view.php", array('data' => $data));
        }
    }

    
    public function ajouterComment(){
        $this->load->model('Comment_model');
        $this->load->library('vform');
        $this->vform->addRules('mark', 'note', 'required|notEmpty|isInt');
        $this->vform->addRules('description', 'description', 'required|notEmpty|btwLength[2,200]');
		
			
				
		
		if($this->auth->getCurrentId()==0){ // pas connecter 
			$this->view->load('notice.php', array(
								'msg' => 'Vous devez vous connecter pour poster un commentaire',
								'url' => getURL('account') // url de redirection
								));
		}
		else {						
			if($this->Comment_model->ADejaPublierPourUnArticle($_GET['idarticle'])){ // a éjà publier un commentaire
			$this->view->load('notice.php', array(
								'msg' => 'Vous avez déjà publié un commentaire.',
								'url' => getURL('article','fichearticle',array('idarticle'=>$_GET['idarticle'])) // url de redirection
								));
				}
			else {
			
				if($this->vform->run()) {  
					$this->Comment_model->ajouterComment($_GET['idarticle'], $_POST['description'], $_POST['mark']);
					$this->ficheArticle($_GET['idarticle']);
					
				}
				else { // probleme formulaire
					$this->ficheArticle();
				}
			}
		}
    }
	
	
	public function afficherModifierArticle($idarticle=null){
		if($idarticle == null){
			$idarticle = $_GET['idarticle'];
		}
	
		$this->load->library('vform');
		
		$this->load->model('Categorie_model');
		$this->load->model('Article_model');
		
		$article = $this->Article_model->getArticle($idarticle);
		$cat = $this->Categorie_model->listeCategorie();
		$data = array($article, $cat);
		$stockInStock = $this->Article_model->getArticleStock($idarticle);
		$this->view->load("Article_view/ArticleModification_view.php",array('data' => $data, 'stock' => $stockInStock));
	
	}
	
	public function modifierArticle(){
		$this->load->library('vform');
		$this->load->model('Article_model');
		$this->vform->addRules('article_brand', 'Marque', 'required|notEmpty|maxLength[32]');	
		$this->vform->addRules('article_description', 'Description', 'required|notEmpty|maxLength[3200]');		
		$this->vform->addRules('article_photo', 'Photo', 'required|maxLength[128]');		
		$this->vform->addRules('article_price_dutyfree', 'Prix', 'required|notEmpty|isNumeric|maxLength[20]');
		$this->vform->addRules('article_title', 'Titre', 'required|notEmpty|maxLength[64]');
		$this->vform->addRules('article_weight', 'Masse', 'required|notEmpty|isNumeric|lt[1000]');			
		
		if($this->vform->run()){
			$data = $this->Article_model->modifierArticle($_GET['idarticle']);
			$this->view->load('notice.php', array(
				'msg' => 'La modification a bien été effectuée',
				'url' => getURL('article','admin') // url de redirection
			));
		}
		else {
			$this->afficherModifierArticle($_GET['idarticle']);	
		}
	}

}