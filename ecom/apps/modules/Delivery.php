<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Delivery extends Controller {
	
		public function index(){
		
			$this->afficheDelivery();	
		
		}
	
		//ADMIN : affiche la liste des moyens de livraison
		public function afficheDelivery(){
			
			/*Permet de charger le model*/
			$this->load->model('Delivery_model');
			
			/*utilisation du model*/
			$list = $this->Delivery_model->getListDelivery();
			
			/*Appel de la vue*/
			$this->load->library('view');
			$this->view->load('viewDelivery/delivery_list.php', array('data' => $list));
		
		}
		
		/**********************
			AJOUT DELIVERY
		**********************/
		public function formulaireAjoutDelivery(){
		
			$this->load->library('vform');
			
			$this->load->library('view');
			$this->view->load('viewDelivery/delivery_ajoutformulaire.php');
			
		}
	
		public function ajouteDelivery(){
			
			//Ajout de VFORM (permet de gerer des verif sur les champs
			$this->load->library('vform');
			//Ajout de la regle
			$this->vform->addRules('name','Name','required|notEmpty|maxLength[25]');
			$this->vform->addRules('price','Price','required|notEmpty|maxLength[11]|isNumeric|gt[0]');
			
			if($this->vform->run()){
			
				$this->load->model('Delivery_model');
				$this->Delivery_model->addDelivery($_POST['name'],$_POST['price']);
				
				$this->view->load('notice.php', array(
								'msg' => 'L\'ajout du moyen de livraison a été effectué',
								'url' => getURL('delivery') // url de redirection
								));
			
			}
			else{
			
				$this->formulaireAjoutDelivery();
			
			}
			
			
				
		}

		
		public function formModifierDelivery(){
		
			$this->load->model('Delivery_model');
			$this->load->library('vform');
		
			if($this->Delivery_model->deliveryEstPresente($_GET['id'])>0){
			
				//echo $_GET['id'];
				$this->load->model('Delivery_model');
				$delivery = $this->Delivery_model->getDelivery($_GET['id']);
		
				$this->load->library('view');
				$this->view->load('viewDelivery/delivery_formodif.php', array('data' => $delivery));
	
			
			}
			else{
			
				$this->view->load('notice.php', array(
								'msg' => 'Il n\'y a pas de delivery avec cette id',
								'url' => getURL('delivery') // url de redirection
								));
			
			}
			
			
					
			
		
		}
		
		public function modifierDelivery(){
						
				//Ajout de VFORM (permet de gerer des verif sur les champs)
				$this->load->library('vform');
				//Ajout de la regle
				$this->vform->addRules('name','Name','required|notEmpty|maxLength[25]');
				$this->vform->addRules('price','Price','required|notEmpty|maxLength[11]|isNumeric|gt[0]');
				
				if($this->vform->run()){
				
					$this->load->model('Delivery_model');
				
					$this->Delivery_model->modifDelivery($_GET['id_delivery'],$_POST['name'],$_POST['price']);
				
					$this->view->load('notice.php', array(
								'msg' => 'La modification a bien été effectuée',
								'url' => getURL('delivery') // url de redirection
								));
				
				}
				else{
				
					$this->formModifierDelivery();
				
				}

		
		}
		
		/**********************
			SUPPRESSION DELIVERY
		**********************/
		
		public function afficheSupprimerDelivery(){
		
			$this->load->model('Delivery_model');
			$list = $this->Delivery_model->getListDelivery();
			
			$this->load->library('view');
			$this->view->load('viewDelivery/delivery_listsuppr.php', array('data' => $list));
		
		}
		
		public function supprimerDelivery(){
		
			$this->load->model('Delivery_model');
			$this->load->library('view');
		
			$present = $this->Delivery_model->deliveryEstPresente($_GET['id']);
		
			if($present!=0){
		
				
				$list = $this->Delivery_model->removeDelivery($_GET['id']);
				$this->view->load('notice.php', array(
								'msg' => 'Le moyen de livraison a bien été supprimé',
								'url' => getURL('delivery') // url de redirection
								));
			
			}
			else{
			
				$this->view->load('notice.php', array(
								'msg' => 'Le moyen de livraison n\'existe pas',
								'url' => getURL('delivery') // url de redirection
								));
			
			}
			
		
		}
		
		
	
	
	}


?>

