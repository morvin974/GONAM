<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends Model {

	public function selectStockCategories() {
		$pdo =& $this->pdodb->loadPDO('pkzone');
		$query = $pdo->query('SELECT * FROM `category`');
		return $query->fetchAll();
	}
	
	public function selectStockArticleByCategory($cat) {
		$pdo =& $this->pdodb->loadPDO('pkzone');
		$prep = $pdo->prepare('SELECT * FROM belong NATURAL JOIN article WHERE id_category = ?');
		$prep->execute(array(intval($cat)));
		return $prep->fetchAll();
	}
	
	public function selectStockArticle($art) {
		$pdo =& $this->pdodb->loadPDO('pkzone');
		$prep = $pdo->prepare('SELECT * FROM article WHERE id_article = ?');
		$prep->execute(array(intval($art)));
		return $prep->fetch();
	}
	
	public function getArticleStock($art) {
		$pdo =& $this->pdodb->loadPDO('pkzone');
		$prep = $pdo->prepare('SELECT article_stock FROM article WHERE id_article = ?');
		$prep->execute(array(intval($art)));
		return $prep->fetchColumn();
	}
	
	public function updateStock($art, $stock) {
		$pdo =& $this->pdodb->loadPDO();
		
		$prep = $pdo->prepare('SELECT article_stock FROM article WHERE id_article = ?');
		$prep->execute(array(intval($art)));
		$currentStock = $prep->fetchColumn();
		
		$pdo =& $this->pdodb->loadPDO('pkzone');
		$prep = $pdo->prepare('SELECT article_stock FROM article WHERE id_article = ?');
		$prep->execute(array(intval($art)));
		$stockStock = $prep->fetchColumn();
		
		$stockToAdd = $currentStock - intval($stock);
		if (($stockToAdd + $stockStock) < 0) {
			return false; // Stock insuffisant
		}
		
		$prep = $pdo->prepare('UPDATE article SET article_stock = article_stock + ? WHERE id_article = ?');
		$prep->execute(array($stockToAdd, $art));
		
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('UPDATE article SET article_stock = ? WHERE id_article = ?');
		$prep->execute(array(intval($stock), $art));
		return TRUE;
	}
	
	 public function creerArticle($article_brand,$article_description,$article_photo,$article_price_dutyfree,$article_stock,$article_title,$article_weight,$id_category,$idart){
		
        $pdo =& $this->pdodb->loadPDO() ;
		$pdo->query("set names UTF8");
        $selecPreparee = $pdo->prepare('INSERT INTO article(id_article,article_brand,article_description,article_photo,article_price_dutyfree,article_stock,article_title,article_weight,id_category, article_date, article_sold) values (?,?,?,?,?,?,?,?,?,now(),0)');
        $tableauArgs = array($idart,$article_brand,$article_description,$article_photo,$article_price_dutyfree,$article_stock,$article_title,$article_weight,$id_category);
        $selecPreparee->execute($tableauArgs);
    }
	
    public function listeArticle(){

        $pdo =& $this->pdodb->loadPDO();
        $pdo->query("set names UTF8");

        $req = $pdo->query('select avg(notice.notice_mark) as moyenne, article.id_article, article_title, article_price_dutyfree, article_photo, article_brand, article.article_stock, category.category_name, article.id_category from article 
										INNER join category on category.id_category=article.id_category
										LEFT JOIN comment ON comment.id_article=article.id_article
										LEFT join notice on comment.id_notice=notice.id_notice
										group by (article.id_article)		');
        return $req->fetchAll(PDO::FETCH_OBJ);

    }

	public function getMoyenne($id){
	    $pdo =& $this->pdodb->loadPDO();

		$selectAVG = $pdo->prepare('SELECT avg(notice.notice_mark) as moyenne FROM article
										INNER JOIN comment ON comment.id_article=article.id_article
										inner join notice on comment.id_notice=notice.id_notice
										where article.id_article =?');
		$selectAVG->execute(array($id));
		$moyenne = $selectAVG->fetch();
		
		if($moyenne['moyenne']==null){
			$moyenne=null;
		}else {
			$moyenne=$moyenne['moyenne'];
		}
		
		return $moyenne;
	}

    public function getArticle($id){
        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('SELECT article.id_article, `article_brand`, `article_description`, `article_photo`, `article_price_dutyfree`, `article_stock`, `article_title`, `article_weight`, `article_date`, `article_sold`, article.`id_category` FROM article
										INNER JOIN category ON category.id_category=article.id_category
										where article.id_article =?');
        $selectPreparee->execute(array($id));
										
        if($selectPreparee->rowCount()==1){
				return $selectPreparee->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }

    }
	
	public function listeArticleParCategorie($idcategorie){

        $pdo =& $this->pdodb->loadPDO();
        $pdo->query("set names UTF8");

        $req = $pdo->prepare('select avg(notice.notice_mark) as moyenne, article.id_article, article_title, article_price_dutyfree, article_photo, article_brand, article.article_stock, category.category_name, article.id_category from article 
										INNER join category on category.id_category=article.id_category
										LEFT JOIN comment ON comment.id_article=article.id_article
										LEFT join notice on comment.id_notice=notice.id_notice
										WHERE article.id_category=?
										group by (article.id_article)');
		$req->execute(array($idcategorie));
		if($req->rowCount()>0){
				 return $req->fetchAll(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }

    }
	
	public function getArticlesParCategories($idcategory){
        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('SELECT article.id_article, `article_brand`, `article_description`, `article_photo`, `article_price_dutyfree`, `article_stock`, `article_title`, `article_weight`, `article_date`, `article_sold`, article.`id_category` FROM article
										INNER JOIN category ON category.id_category=article.id_category
										WHERE article.id_category=?');
        $selectPreparee->execute(array($idcategory));
		
        if($selectPreparee->rowCount()>=1){
				return $selectPreparee->fetchAll(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }

    }

    public function modifierArticle($id){
        $pdo =& $this->pdodb->loadPDO();
		$pdo->query("set names UTF8");
        $rqe = $pdo->prepare('UPDATE article set
						article_brand=? ,
						article_description=?, 
						article_photo=?,
						article_price_dutyfree = ?,
						article_title = ? ,
						article_weight=? ,
						id_category=? ,
						article_sold=?
						WHERE id_article = ?');

        $tableauArgs = array($_POST['article_brand'],
            $_POST['article_description'],
            $_POST['article_photo'],
            $_POST['article_price_dutyfree'],
            $_POST['article_title'],
            $_POST['article_weight'],
            $_POST['id_category'],
			$_POST['article_sold'],
			$id);
        $rqe->execute($tableauArgs);

    }

    public function supprimerArticle($id){

        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('DELETE from article where id_article = ? ');
        $tableauArgs = array($id);
        $selectPreparee->execute($tableauArgs);

    }

    public function getListeArticleCategorie($idcategorie){
        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('SELECT * FROM article
                                          INNER JOIN category ON category.id_category=article.id_category
                                          where article.id_category = ?');
        $selectPreparee->execute(array($idcategorie));
        return  $selectPreparee->fetchAll(PDO::FETCH_OBJ);
    }
	
	/*	
	pour la page home
	*/
	public function getNouveauxArticles(){
		$pdo =& $this->pdodb->loadPDO();
		$req = $pdo->prepare('SELECT * FROM article ORDER BY article_date DESC LIMIT 0 , 5');
		$req->execute();
		return $req->fetchAll(PDO::FETCH_OBJ);
	}
	
	/*
	pour la page home
	*/
	public function getLesPlusVendus(){
		$pdo =& $this->pdodb->loadPDO();
		$req = $pdo->prepare('SELECT * FROM article WHERE article.article_stock>0 ORDER BY article_sold DESC LIMIT 0,5');
		$req->execute();
		return $req->fetchAll(PDO::FETCH_OBJ);
	}
	

	public function getLesMieuxNotes(){
		$pdo =& $this->pdodb->loadPDO();
		$req = $pdo->prepare('SELECT avg(notice.notice_mark) as moyenne, article.id_article, article_title, article_price_dutyfree, article_photo, article_brand FROM article
										INNER JOIN comment ON comment.id_article=article.id_article
										inner join notice on comment.id_notice=notice.id_notice
										where article_stock>0
										group by (article.id_article)
										ORDER BY moyenne DESC 
										LIMIT 0,5');
		$req->execute();
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

	/*
	Renvoie la quantité de l'article disponible en stock
	*/
	public function getStockArticle($idArticle){
		$pdo =& $this->pdodb->loadPDO();
		$req = $pdo->prepare('SELECT article.article_stock FROM article WHERE article.id_article=?');
		$req->execute(array($idArticle));
		$val = $req->fetch(PDO::FETCH_ASSOC);
		return $val['article_stock'];
	}
	
	/*
	Retourne s'il y a assez d'article en stock
	*/
	public function hasEnoughStock($id_article,$quantity){
		
	 return $this->getStockArticle($id_article) - $quantity;
	 
	}
	 
	public function isSold($id_article,$quantity){
   
		$pdo =& $this->pdodb->loadPDO();
        $deletePreparee = $pdo->prepare('UPDATE article set article_sold = article_sold + ? where id_article = ?');
        $tableauArgs = array($quantity, $id_article);
        $deletePreparee->execute($tableauArgs);
   
  }

}