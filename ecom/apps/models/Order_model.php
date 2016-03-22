<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Order_model extends Model {
	
		/*
		Créé une commande a partir du panier actif.
		*/
		public function createOrder($order_billing_address,$order_billing_city,$order_billing_postcode,$order_delivery_address,$order_delivery_city,$order_delivery_postcode,$order_delivery_price,$order_price_HT,$order_tax,$id_cart){
						
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			/*ID_FIRM , ORDER_DELIVERY_DATE , ORDER_STATUS et ORDER_BILLING_TYPE fixée en dur*/
			$addPreparee = $pdo->prepare('INSERT INTO `order`(`order_billing_address`, `order_billing_city`, `order_billing_postcode`, `order_billing_type`, `order_date`, `order_delivery_address`, `order_delivery_city`, `order_delivery_date`, `order_delivery_postcode`, `order_delivery_price`, `order_price_HT`, `order_status`, `order_tax`, `id_cart`, `id_firm`) VALUES (?,?,?,?,NOW(),?,?,NOW(),?,?,?,?,?,?,?);');
			$tab=array($order_billing_address,$order_billing_city,$order_billing_postcode,1,$order_delivery_address,$order_delivery_city,$order_delivery_postcode,$order_delivery_price,$order_price_HT,3,$order_tax,$id_cart,1);
			$addPreparee->execute($tab);
			
		}
		
		/*
		Retourne id_order, user_firstname, user_name et id_cart de TOUTES les commandes
		*/
		public function getListOrder(){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->query('select order_date,`order`.id_order, user_firstname, user_name, cart.id_cart from `order` 
					INNER JOIN cart on cart.id_cart=`order`.id_cart
					INNER JOIN `user` on `user`.id_user=cart.id_user');
					
			return $req->fetchAll(PDO::FETCH_OBJ);
			
		}

		/*
		Retourne la liste des articles dans l'order '$id_order' de l'user connecté
		*/
		public function getListArticleInOrder($id_order){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('SELECT `order`.id_order, article.id_article, cart.id_cart, cart.actif, article_brand, article_description, article_photo ,article_price_dutyfree, article_stock, article_title, article_weight, category_name, add_in_cart.quantity
								FROM cart
								INNER JOIN user ON user.id_user = cart.id_user
								INNER JOIN add_in_cart ON add_in_cart.id_cart = cart.id_cart
								INNER JOIN article ON article.id_article = add_in_cart.id_article
								INNER JOIN category ON category.id_category = article.id_category
								INNER JOIN delivery ON cart.id_delivery = delivery.id_delivery
                                INNER JOIN `order` ON `order`.id_cart = cart.id_cart
								WHERE `order`.id_order = ?
								AND cart.id_user = ?');
			
			$req->execute(array($id_order,$this->auth->getCurrentId()));
			
			return $req->fetchAll(PDO::FETCH_OBJ);
			
		}
		
		/*
		Retourne les commandes de l'user courant
		*/
		public function getOrderCurrentUser(){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('select order_status, order_date,order_price_HT,`order`.id_order, user_firstname, user_name, cart.id_cart from `order` 
					INNER JOIN cart on cart.id_cart=`order`.id_cart
					INNER JOIN `user` on `user`.id_user=cart.id_user
					WHERE `user`.id_user=?');
			$req->execute(array($this->auth->getCurrentId()));
					
			return $req->fetchAll(PDO::FETCH_OBJ);
			
		}
		
		/*
		Retourne la commande d'id '$id_order'
		*/
		public function getOrder($id_order){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('SELECT order_date, order_status, order_delivery_price, order_price_HT, user_firstname,user_name,`order`.id_order, article.id_article, cart.id_cart, cart.actif, article_brand, article_description, article_photo ,article_price_dutyfree, article_stock, article_title, article_weight, category_name, add_in_cart.quantity
								FROM cart
								INNER JOIN user ON user.id_user = cart.id_user
								INNER JOIN add_in_cart ON add_in_cart.id_cart = cart.id_cart
								INNER JOIN article ON article.id_article = add_in_cart.id_article
								INNER JOIN category ON category.id_category = article.id_category
								INNER JOIN delivery ON cart.id_delivery = delivery.id_delivery
                                INNER JOIN `order` ON `order`.id_cart = cart.id_cart
								WHERE `order`.id_order = ?');
			
			$req->execute(array($id_order));
			
			return $req->fetchAll(PDO::FETCH_OBJ);
			
		}
		
		//Retourne 1 si la commande existe
		public function orderExists($id_order){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('SELECT * from `order` WHERE id_order = ?');
			$req->execute(array($id_order));
			
			return $req->rowCount();	
			
		}	

		/*
		Retourne le nb de commande de l'user courant
		*/
		public function nbOrderCurrentUser(){
			
			$pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
			
			$req = $pdo->prepare('select `order`.id_order from `order`
					INNER JOIN cart on cart.id_cart=`order`.id_cart
					INNER JOIN `user` on `user`.id_user=cart.id_user
					WHERE `user`.id_user=?');
			$tab=array($this->auth->getCurrentId());
			$req->execute($tab);
			
			return $req->rowCount();
			
		}
		
	}
	
?>

