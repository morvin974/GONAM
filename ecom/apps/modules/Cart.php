<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Cart extends Controller {
	
		public function index(){
		
			$this->afficheCartActif();
			
		}
	
		/*
		Affiche le contenu du panier actif
		*/
		public function afficheCartActif(){

			$this->load->model('Cart_model');
			$this->load->model('Delivery_model');
			
			//Si le panier actif existe
			if($this->Cart_model->cartActiveExists()>0){
				
				//Si le panier n'est pas vide
				if($this->Cart_model->nbArticleInCartActive()>0){
					
					$list = $this->Cart_model->getArticleInCurrentCart();

					//recuperation des infos sur le panier prix, tva, livraison
					
					$delivery = $this->Delivery_model->getListDelivery();
					$idDelivery = $this->Cart_model->getIdDeliveryCart($this->Cart_model->getCurrentCartId());
					$infoDelivery = $this->Delivery_model->getDelivery($idDelivery);
					$infoCart = $this->Cart_model->getInfoCurrentCart();
					$tab=array($list, $infoCart, $delivery,$infoDelivery);
				
					$this->load->library('view');
					$this->view->load('viewCart/cart_list.php', array('data' => $tab));
					
				}
				else{
					
					$this->view->load('notice.php', array(
								'msg' => 'Il n\'y a pas d\'article dans le panier',
								'url' => getURL('home') // url de redirection
								));
					
				}
										
			}
			else{
				
				$this->view->load('notice.php', array(
								'msg' => 'Il n\'y a pas de panier à afficher',
								'url' => getURL('home') // url de redirection
								));
				
				
			}

		}
		

		/*
		Ajoute un certains nombre ($_POST) d'article ($_GET) dans le panier actif
		*/
		public function ajoutArticleInCart(){
		
			$this->load->model('Cart_model');
			$this->load->model('Article_model');
			
			if($this->auth->isLogin()){
			
				if($this->Cart_model->cartActiveExists()>0){
				
					if($this->Article_model->getStockArticle($_GET['idarticle'])>0){ // verif stock >0
						
						$id_cart = $this->Cart_model->getIdCartActif();
						$this->Cart_model->addInCart($_POST['quantity'],$_GET['idarticle'],$id_cart);
						$this->modifierMontantDuPanier();
						$this->afficheCartActif();
						
					}
					
					else {
						$this->view->load('notice.php', array(
									'msg' => 'Vous ne pouvez pas ajouter l\'article car il est indisponible (Article : '.$tab->article_title.')',
									'url' => getURL('article','fichearticle',array('idarticle'=>$_GET['idarticle'])) // url de redirection
									));
					}
				
				}
				else{
				
					$this->view->load('notice.php', array(
								'msg' => 'ERREUR pas de panier actif, vous devez vous identifier',
								'url' => getURL('account') // url de redirection
								));
				
				}
			
			}else{
			
				if(isset($_COOKIE['cart'])){
				
					$id_cart = $_COOKIE['cart'];
					$this->Cart_model->addInCart($_POST['quantity'],$_GET['idarticle'],$id_cart);
					$this->modifierMontantDuPanier();
					$this->view->load('notice.php', array(
								'msg' => 'L\'ajout a bien été effectué',
								'url' => getURL('cart') // url de redirection
								));
					//$this->afficheCartActif();
				
				}
				else{
					
					$this->Cart_model->createCart(null, 1, 1);
					$id_cart = $this->Cart_model->createCookieIdCart();

					$this->Cart_model->addInCart($_POST['quantity'],$_GET['idarticle'],$id_cart);
					$this->modifierMontantDuPanier();
					$this->view->load('notice.php', array(
								'msg' => 'L\'ajout a bien été effectué',
								'url' => getURL('cart') // url de redirection
								));
					//$this->afficheCartActif();
					
				}
				
			
			}					

		}
		
		
		/*
		Supprime l'article dans le panier actif
		*/
		public function supprimerArticleInCart(){
			
			$this->load->model('Cart_model');
			
			if($this->Cart_model->cartActiveExists()>0){
					
				$id_cart = $this->Cart_model->getIdCartActif();
				
				if($this->Cart_model->isInCart($id_cart,$_GET['idarticle'])>0){
					
					$this->Cart_model->removeInCart($_GET['idarticle']);
					$this->modifierMontantDuPanier();
					$this->afficheCartActif();
					
				}
				else {

						$this->view->load('notice.php', array(
								'msg' => 'Impossible de supprimer cet article car il n\'est pas dans votre panier ('.$tab->article_title.')',
								'url' => getURL('cart') // url de redirection
								));
					
				}
				
			}
			else{
				
						$this->view->load('notice.php', array(
								'msg' => 'ERREUR pas de panier actif, vous devez vous identifier',
								'url' => getURL('account') // url de redirection
								));
				
			}
			
			

		}
		
		/*
		Modifie la quantité d'article dans le panier actif et affiche le panier
		*/
		public function modifierArticleInCart(){
			
			$this->load->model('Cart_model');
			$this->load->model('Article_model');
			
			if($this->Cart_model->cartActiveExists()>0){
				
				$id_cart = $this->Cart_model->getIdCartActif();
			
				if($this->Cart_model->isInCart($id_cart,$_GET['idarticle'])>0){
					
					if($this->Article_model->getStockArticle($_GET['idarticle'])>0){
						if($_POST['quantite']>0){
							$this->Cart_model->modifQuantityInCart($_GET['idarticle'], $_POST['quantite']);
							$this->modifierMontantDuPanier();
							$this->afficheCartActif();
						}
						else{

							$this->view->load('notice.php', array(
								'msg' => 'Vous ne pouvez pas modifier la quantité à 0, supprimez l\'article à la place (Article : '.$tab->article_title.')',
								'url' => getURL('cart') // url de redirection
								));
						}
					}
					else {

						$this->view->load('notice.php', array(
								'msg' => 'Il n\'y a plus de stock disponible pour l\'article : '.$tab->article_title,
								'url' => getURL('cart') // url de redirection
								));
					}
				}
				else {

					$this->view->load('notice.php', array(
								'msg' => 'Impossible de modifier cet article car il n\'est pas dans votre panier ('.$tab->article_title.')',
								'url' => getURL('cart') // url de redirection
								));
				}
				
			}
			else{
				
						$this->view->load('notice.php', array(
								'msg' => 'ERREUR pas de panier actif, vous devez vous identifier',
								'url' => getURL('account') // url de redirection
								));
				
			}	
			
		}	
		
			
		/*
        Modification du montant du panier actif 
        */
        public function modifierMontantDuPanier(){
			
            $this->load->model('Cart_model');
            
			if($this->Cart_model->cartActiveExists()>0 || !isset($_COOKIE['cart'])){
				
				$list = $this->Cart_model->getArticleInCurrentCart();
				$montant=0;
				foreach($list as $value){
					
				   $montant=$montant + ($value->article_price_dutyfree * $value->quantity);
				   
				}
				
				$id_cart = $this->Cart_model->getIdCartActif();
				$this->Cart_model->modifCartPrice($montant);
				
			}
			else{
				
				$this->view->load('notice.php', array(
								'msg' => 'Il n\'y a pas de panier actif',
								'url' => getURL('home') // url de redirection
								));
							
			}	
			
			
        }
		
		
		public function setDelivery(){
			
			$this->load->model('Cart_model');
			$this->Cart_model->setDelivery($this->Cart_model->getCurrentCartId(),$_POST['id_delivery']);
			$this->view->load('notice.php', array(
								'msg' => 'Le livreur a bien été changé',
								'url' => getURL('cart') // url de redirection
								));
			
		}
		
		
	}



?>

