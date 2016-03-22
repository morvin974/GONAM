<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

	class Cart_model extends Model {
		
		/*
		Créé un panier actif
		*/
		public function createCartActive(){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$addPreparee = $pdo->prepare('INSERT INTO `cart`(`cart_price_HT`, `actif`, `id_delivery`, `id_user`) VALUES (0,1,1,?);');
			$tab=array($this->auth->getCurrentId());
			$addPreparee->execute($tab);
			
		}
		
		/*N.
		Créé un panier (avec parametres)
		*/
		public function createCart($user, $delivery, $actif) {
			$pdo =& $this->pdodb->loadPDO();
			
			$prep = $pdo->prepare('INSERT INTO cart (cart_price_HT, actif, id_delivery, id_user) VALUES (0,?,?,?)');
			return $prep->execute(array($actif, $delivery, $user));
		}
				
		/*N.
		Retourne les articles dans le panier actif de l'utilisateur co/avec un cookie
		*/
		public function getArticleInCurrentCart() {
			
			$pdo =& $this->pdodb->loadPDO();
			
			if ($this->auth->isLogin()) {
				$prep = $pdo->prepare('SELECT * FROM cart NATURAL JOIN add_in_cart NATURAL JOIN article WHERE id_user = ? AND actif = 1');
				$prep->execute(array($this->auth->getCurrentId()));
				return $prep->fetchAll(PDO::FETCH_OBJ);
			}
			else if (isset($_COOKIE['cart'])) {
				$prep = $pdo->prepare('SELECT * FROM cart NATURAL JOIN add_in_cart NATURAL JOIN article WHERE id_cart = ?');
				$prep->execute(array(intval($_COOKIE['cart'])));
				return $prep->fetchAll(PDO::FETCH_OBJ);
			}
			else {
				return array();
			}
			
		}
		
		/*
		Retourne la liste des articles achetés precedemment (présent dans un panier validé)
		*/
		public function getListArticleInCartPurchased(){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('SELECT `order`.id_order,order_delivery_date,order_status,order_date, article.id_article, cart.id_cart, cart.actif, article_brand, article_description, article_photo ,article_price_dutyfree, article_stock, article_title, article_weight, category_name, add_in_cart.quantity
								FROM cart
								INNER JOIN user ON user.id_user = cart.id_user
								INNER JOIN add_in_cart ON add_in_cart.id_cart = cart.id_cart
								INNER JOIN article ON article.id_article = add_in_cart.id_article
								INNER JOIN `order` ON `order`.id_cart = cart.id_cart
								INNER JOIN category ON category.id_category = article.id_category
								WHERE cart.actif =0
								AND cart.id_user =?
								ORDER BY order_date');
			$req->execute(array($this->auth->getCurrentId()));
			return $req->fetchAll(PDO::FETCH_OBJ);
		
		}
		
		/*
		Retourne le panier '$id_cart'
		*/
		public function getCart($id_cart){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$selectPreparee = $pdo->prepare('select * from cart where id_cart = ?');
			$selectPreparee->execute(array($id_cart));	
			return $selectPreparee->fetch(PDO::FETCH_OBJ);	
		
		}
		
		/*
		Retourne l'id du panier actif
		*/
		public function getIdCartActif(){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$selectPreparee = $pdo->prepare('select id_cart from cart where id_user = ? and actif = 1');
			if(!$this->auth->isLogin() && isset($_COOKIE['cart'])) return $_COOKIE['cart'];
			else  $selectPreparee->execute(array($this->auth->getCurrentId()));
			return $selectPreparee->fetchColumn();
		
		}
		
		/*N.
		Retourne l'id du cart actif
		*/
		public function getCurrentCartId() {
			$pdo =& $this->pdodb->loadPDO();
			
			if ($this->auth->isLogin()) {
				$prep = $pdo->prepare('SELECT id_cart FROM cart WHERE id_user = ? AND actif = 1');
				$prep->execute(array($this->auth->getCurrentId()));
				return $prep->fetchColumn();
			}
			else if (isset($_COOKIE['cart'])) {
				return $_COOKIE['cart'];
			}
			else {
				return -1;
			}
		}
		
		/*
		Retourne si l'article est dans le panier actif
		*/
		public function isInCart($id_cart,$id_article){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$req = $pdo->prepare('select * from add_in_cart where id_cart=? and id_article=?');
			$tab=array($id_cart,$id_article);
			$req->execute($tab);
			
			return $req->rowCount();
		
		}
		
		/*
		Ajoute l'article '$id_article' dans le panier
		*/		
		public function addInCart($quantity,$id_article,$id_cart){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			if($this->isInCart($id_cart,$id_article)>0){
			
				$modifPreparee1 = $pdo->prepare('update add_in_cart set quantity = quantity+? where id_cart = ? and id_article = ?');
				$tab1=array($quantity,$id_cart,$id_article);
				$modifPreparee1->execute($tab1);
			
			}
			else{
			
				$addPreparee = $pdo->prepare('INSERT INTO add_in_cart (quantity, id_article, id_cart) VALUES (?, ?, ?);');
				$tab2=array($quantity,$id_article,$id_cart);
				$addPreparee->execute($tab2);
			
			}
		
			
		}
		
		/*
		Supprime l'article dans le panier actif
		*/
		public function removeInCart($id_article){
			
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			$delPreparee = $pdo->prepare('DELETE FROM add_in_cart WHERE id_cart = ? and id_article = ?');
			$tab=array($this->getIdCartActif(),$id_article);
			if(!$this->auth->isLogin() && isset($_COOKIE['cart'])) $tab=array($_COOKIE['cart'],$id_article);
			else $tab=array($this->getIdCartActif(),$id_article);
			$delPreparee->execute($tab);
			
		}

		/*
		Modifie la quantité de l'article dans le panier actif
		*/
		public function modifQuantityInCart($id_article,$new_quantity){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$modifPreparee = $pdo->prepare('update add_in_cart set quantity = ? where id_cart = ? and id_article= ?');
			if(!$this->auth->isLogin() && isset($_COOKIE['cart'])) $tab=array($new_quantity,$_COOKIE['cart'],$id_article);
			else $tab=array($new_quantity,$this->getIdCartActif(),$id_article);
			$modifPreparee->execute($tab);
			
		}
	
		/*
		Modifie le prix HT du panier
		*/
		public function modifCartPrice($montant){
            $pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
			
            $modifPreparee = $pdo->prepare('update cart set cart_price_HT = ?  where id_cart = ? ');
			if(!$this->auth->isLogin() && isset($_COOKIE['cart'])) $tab=array($montant, $_COOKIE['cart']);
			else $tab=array($montant, $this->getIdCartActif());
            $modifPreparee->execute($tab);
			
			
		}

		/*
		Retourne des infos sur le panier actif
		*/
        public function getInfoCurrentCart(){
			
            $pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");

            $select= $pdo->prepare('SELECT tax_tva, cart.id_cart, cart.cart_price_HT, cart.id_delivery, delivery.delivery_price, delivery.delivery_name
                                    FROM cart, tax, delivery
                                    WHERE id_cart =? and cart.actif=1');

			if(!$this->auth->isLogin() && isset($_COOKIE['cart'])) $tab=array($_COOKIE['cart']);
			else $tab=array($this->getIdCartActif());
            $select->execute($tab);
            return $select->fetch(PDO::FETCH_OBJ);
			
        }
		
		/*
		Change la valeur 'actif' de 1 à 0
		Et retire les articles du stock
		*/
		public function validationCart(){
			
			$pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
			
			$list=$this->getArticleInCurrentCart();
			//$stock=0;
			foreach($list as $value){
				
				$id_article = $value->id_article;
				$stock = $value->article_stock;
				$stock=$stock - $value->quantity;
				
				$modifPreparee1 = $pdo->prepare('update article set article_stock = ?  where id_article = ? ');
				$tab1=array($stock,$id_article);
				$modifPreparee1->execute($tab1);
			
			}
			
			$modifPreparee2 = $pdo->prepare('update cart set actif = 0  where id_cart = ? ');
            $tab2=array($this->getIdCartActif());
            $modifPreparee2->execute($tab2);
			
			$this->createCartActive();
			
		}
		
		/*
		Retourne le nb d'article dans le panier actif
		*/
		public function nbArticleInCartActive(){
			
			$pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
			
			
			$req = $pdo->prepare('select * from add_in_cart where id_cart=?');
			if(!$this->auth->isLogin() && isset($_COOKIE['cart'])) $tab=array($_COOKIE['cart']);
			else $tab=array($this->getIdCartActif());
			$req->execute($tab);
			
			return $req->rowCount();
			
		}
		
		/*N.
		Retourne le nombre d'article dans le cart actif
		*/
		public function countArticleInCurrentCart() {
			$pdo =& $this->pdodb->loadPDO();
			
			if ($this->auth->isLogin()) {
				$prep = $pdo->prepare('SELECT COUNT(id_article) FROM cart NATURAL JOIN add_in_cart WHERE id_user = ? AND actif = 1');
				$prep->execute(array($this->auth->getCurrentId()));
				return $prep->fetchColumn();
			}
			else if (isset($_COOKIE['cart'])) {
				$prep = $pdo->prepare('SELECT COUNT(id_article) FROM add_in_cart WHERE id_cart = ?');
				$prep->execute(array(intval($_COOKIE['cart'])));
				return $prep->fetchColumn();
			}
			else {
				return 0;
			}
		}
		
		/*
		Retourne s'il y a un panier actif
		*/
		public function cartActiveExists(){
			
			$pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
			
			$req = $pdo->prepare('select * from cart where actif=1 and id_user=?');
			if(isset($_COOKIE['cart'])) return 1;			
			else $tab=array($this->auth->getCurrentId());
			
			$req->execute($tab);
			
			return $req->rowCount();
			
		}
		
		/*
		Retourne s'il y a un ou plusieurs panier ou actif=0 (commandes)
		*/
		public function cartPurchasedExists(){
			
			$pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
			
			$req = $pdo->prepare('select * from cart where actif=0 and id_user=?');
			$tab=array($this->auth->getCurrentId());
			$req->execute($tab);
			
			return $req->rowCount();
			
		}
		
		/*
		Retourne l'id du dernier panier créé
		*/
		public function getLastIdCart(){
		
			$pdo =& $this->pdodb->loadPDO();
            $pdo->query("set names UTF8");
            		
            $select= $pdo->query('SELECT id_cart FROM cart ORDER BY id_cart DESC LIMIT 0, 1');			
           	return $select->fetchColumn(/*PDO::FETCH_OBJ*/);			
		
		}
		
		/*N.
		Fusionne le cart de l'user non co en se connectant 
		*/
		public function loginFunsionCart() {
			$pdo =& $this->pdodb->loadPDO();
			
			if (isset($_COOKIE['cart'])) {
				$prep = $pdo->prepare('UPDATE add_in_cart SET id_cart = ? WHERE id_cart = ?');
				return $prep->execute(array($this->getCurrentCartId(), intval($_COOKIE['cart'])));
			}
			else {
				return false;
			}
			
		}
		
		public function createCookieIdCart(){
			
			$id_cart_cookie = $this->Cart_model->getLastIdCart();
			setcookie('cart', intval($id_cart_cookie), time()+604800, '/');
			return $id_cart_cookie;
			
		}
	
		public function setDelivery($id_cart,$id_delivery){
			
			$pdo =& $this->pdodb->loadPDO();
			$prep = $pdo->prepare('UPDATE cart SET id_delivery = ? WHERE id_cart = ?');
			return $prep->execute(array($id_delivery, $id_cart));
			
		}
		
		public function getIdDeliveryCart($id_cart){
		
			$pdo =& $this->pdodb->loadPDO();
			$pdo->query("set names UTF8");
			
			$selectPreparee = $pdo->prepare('select id_delivery from cart where id_cart = ?');
			$selectPreparee->execute(array($id_cart));	
			return $selectPreparee->fetchColumn();	
		
		}
		
		
		
	}
	
?>

