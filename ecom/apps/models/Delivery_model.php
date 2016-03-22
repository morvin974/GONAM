<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Delivery_model extends Model {
	
		public function getListDelivery(){
		
			/*instance pdo*/
			$pdo =& $this->pdodb->loadPDO();
			/*Permet l'affichage des caracteres spéciaux*/
			$pdo->query("set names UTF8");
			
			$req = $pdo->query('select * from delivery');
					
			return $req->fetchAll(PDO::FETCH_OBJ);
			
			
			
	
		}
		
		/**********************
			AJOUT DELIVERY
		**********************/
		public function addDelivery($name,$price){

		
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$addPreparee = $pdo->prepare('INSERT INTO delivery(delivery_name,delivery_price) VALUES (?, ?);');
			
			$tab=array($name,$price);
			$addPreparee->execute($tab);
			
			
		}
		
		/**********************
			SUPPRESSION DELIVERY
		**********************/
		public function removeDelivery($id){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$delPreparee = $pdo->prepare('DELETE FROM delivery WHERE id_delivery = ?');
			$tab=array($id);
			$delPreparee->execute($tab);
		
		}
		
		/**********************
			MODIFICATION DELIVERY
		**********************/
		
		public function modifDelivery($id,$name,$price){
		
			
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
		
			$modifPreparee = $pdo->prepare('update delivery set delivery_name = ?, delivery_price = ? where id_delivery = ?');
			$tab=array($name,$price,intval($id));
			$modifPreparee->execute($tab);
			
	
		
		}
		
		public function getDelivery($id){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$selectPreparee = $pdo->prepare('select * from delivery where id_delivery = ?');
			$selectPreparee->execute(array($id));	
			return $selectPreparee->fetchAll(PDO::FETCH_OBJ);	
		
		}
		
		public function deliveryEstPresente($id){
			
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('select * from delivery where id_delivery=?');
			$tab=array($id);
			$req->execute($tab);

			return $req->rowCount();

			
		
		}

	
	
	}
	
?>

