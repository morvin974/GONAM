<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Controller {

	public function index() {
	
		$this->afficheValidation();
	
	}

	/*
	Affiche le formulaire de validation de la commande
	*/
	public function afficheValidation(){
	
		//Si connecté
		if($this->auth->isLogin()==1){
			
			$this->load->model('Cart_model');
			$this->load->model('Order_model');
			$this->load->model('Article_model');
			$this->load->model('Delivery_model');	
		
			if($this->Cart_model->nbArticleInCartActive()>0){
				
				$this->load->library('vform');
			
				//RECUP DE : article_title, article_price_dutyfree, quantity, article_photo
				//id_article, id_cart, article_brand, article_description, article_stock,  article_weight, category_name
				$list = $this->Cart_model->getArticleInCurrentCart();
				
				$bool=1;
				foreach($list as $value){
				
					if($this->Article_model->hasEnoughStock($value->id_article,$value->quantity)<0){
					
						$bool=0;
					
					}
				
				}
				
				if($bool==1){
					
					// RECUP DE : tax_tva, id_cart, cart_price_HT, id_delivery, delivery_price, delivery_name
					$infoCart = $this->Cart_model->getInfoCurrentCart();
					$delivery = $this->Delivery_model->getListDelivery();
					$idDelivery = $this->Cart_model->getIdDeliveryCart($this->Cart_model->getCurrentCartId());
					$infoDelivery = $this->Delivery_model->getDelivery($idDelivery);
					
					$tab=array($list, $infoCart, $delivery, $infoDelivery);
					
					$this->load->library('view');
					$this->view->load('viewOrder/order_view.php', array('data' => $tab));
					
				}
				else{
					
					$this->view->load('notice.php', array(
						'msg' => 'Erreur, un des articles de votre panier n\'est pas assez approvisionné dans notre stock',
						'url' => getURL('cart') // url de redirection
					));
					
				}
				
				
				
			}
			else{

				$this->view->load('notice.php', array(
						'msg' => 'Le panier est vide, impossible de créer de commande',
						'url' => getURL('home') // url de redirection
				));
				
			}
			
		}else{
			
			$this->view->load('notice.php', array(
						'msg' => 'Vous n\'êtes pas connecté, veuillez vous connecter pour continuer',
						'url' => getURL('account') // url de redirection
			));
			
		}
	
		
		
	}
	
	/*
	Crée la commande (order), change le panier courant à 0 et en crée un a 1 et retire les articles du stock
	*/
	public function validerPanier(){
	
		//Si connecté
		if($this->auth->isLogin()==1){
			
			$this->load->model('Article_model');
			$this->load->model('Cart_model');
			$this->load->model('Order_model');
			$this->load->library('vform');
			
			$this->vform->addRules('order_delivery_address','Adresse de livraison','required|notEmpty|maxLength[128]');
			$this->vform->addRules('order_delivery_city','Ville de livraison','required|notEmpty|maxLength[32]');
			$this->vform->addRules('order_delivery_postcode','Code postal de livraison','required|notEmpty|exactLength[5]');
			$this->vform->addRules('order_billing_address','Adresse de facturation','required|notEmpty|maxLength[128]');
			$this->vform->addRules('order_billing_city','Ville de facturation','required|notEmpty|maxLength[32]');
			$this->vform->addRules('order_billing_postcode','Code postal de facturation','required|notEmpty|exactLength[5]');
			
			if($this->vform->run() && $this->Cart_model->nbArticleInCartActive()>0){
				
				$list = $this->Cart_model->getArticleInCurrentCart();
				$bool=1;
				foreach($list as $value){
				
					if($this->Article_model->hasEnoughStock($value->id_article,$value->quantity)<0){
					
						$bool=0;
					
					}
				
				}
				if($bool==1){
					
					$infoCart = $this->Cart_model->getInfoCurrentCart();
					
					$this->Order_model->createOrder($_POST['order_billing_address'],$_POST['order_billing_city'],$_POST['order_billing_postcode'],$_POST['order_delivery_address'],$_POST['order_delivery_city'],$_POST['order_delivery_postcode'],$infoCart->delivery_price,$infoCart->cart_price_HT,$infoCart->tax_tva,$this->Cart_model->getIdCartActif());
					
					foreach($list as $value){
				
						$this->Article_model->isSold($value->id_article,$value->quantity);
					
					}
					
					$this->Cart_model->validationCart();
					
					$this->view->load('notice.php', array(
						'msg' => 'Le panier à été commandé, retour à l\'accueil',
						'url' => getURL('home')
					));
						
				}
				else{

					$this->view->load('notice.php', array(
						'msg' => 'Erreur, un des articles de votre panier n\'est pas assez approvisionné dans notre stock',
						'url' => getURL('Cart') // url de redirection
					));
					
				}
				
			}
			else{
				
				$this->afficheValidation();
				
			}
			
		}
		else{
			
			$this->view->load('notice.php', array(
						'msg' => 'Vous n\'êtes pas connecté',
						'url' => getURL('home') // url de redirection
			));
			
		}
		
				
	}
	
	/*
	Affiche un historique de toutes les commandes
	*/
	public function listOrder(){
		
		$this->load->model('Order_model');
		$list=$this->Order_model->getListOrder();
		
		$this->load->library('view');
		$this->view->load('viewOrder/listOrder_admin_view.php', array('data' => $list));
		
	}
	
	/*
	Affiche des infos sur une certaine commande ($_GET)
	*/
	public function affichageInfoOrderAdmin(){
		
		$this->load->model('Order_model');
		
		if(isset($_GET['id_order']) && $_GET['id_order']!='' && $this->Order_model->orderExists($_GET['id_order'])>0){
			
			$info = $this->Order_model->getOrder($_GET['id_order']);
		
			$this->load->library('view');
			$this->view->load('viewOrder/infoOrder_admin_view.php', array('data' => $info));	
			
		}else{
		
			$this->view->load('notice.php', array(
					'msg' => 'Erreur, il n\'y a pas de commande à afficher',
					'url' => getURL('home') // url de redirection
			));
			
		}
		
	}
	
	/*
	Affiche des infos sur la commande precise (user)
	*/
	public function affichageInfoOrderUser(){
		
		$this->load->model('Order_model');
		
		if(isset($_GET['id_order']) && $_GET['id_order']!='' && $this->Order_model->orderExists($_GET['id_order'])>0){
			
			$info = $this->Order_model->getOrder($_GET['id_order']);
			
			$this->load->library('view');
			$this->view->load('viewOrder/infoOrder_user_view.php', array('data' => $info));	
			
		}else{
		
			$this->view->load('notice.php', array(
					'msg' => 'Erreur, il n\'y a pas de commande à afficher',
					'url' => getURL('home') // url de redirection
			));
			
		}
		
	}
	
	/*
	Affiche la liste des commandes de l'utilisateur connecté
	*/
	public function listOrderCurrentUser(){
		
		$this->load->model('Order_model');
		
		//Si connecté
		if($this->auth->isLogin()==1){
		
			if($this->Order_model->nbOrderCurrentUser()>0){
				
				$list = $this->Order_model->getOrderCurrentUser();
			
				$this->load->library('view');
				$this->view->load('viewOrder/listOrder_user_view.php', array('data' => $list));
				
			}
			else{
				
				$this->view->load('notice.php', array(
						'msg' => 'Erreur, il n\'y à pas encore eu de commandes',
						'url' => getURL('home') // url de redirection
				));
				
			}
			
		}
		else{
			
			$this->view->load('notice.php', array(
						'msg' => 'Vous n\'êtes pas connecté',
						'url' => getURL('home') // url de redirection
			));
			
		}
		

	}

}

?>
