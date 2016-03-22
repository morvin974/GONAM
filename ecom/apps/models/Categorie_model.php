<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorie_model extends Model {

	public function creerCategorie($racine){
		
		$pdo =& $this->pdodb->loadPDO() ;
		
		if(!$racine){
			$selecPreparee = $pdo->prepare('INSERT INTO category(id_category, category_name, category_description, id_category_mother) values (NULL,?,?,?)');
			$tableauArgs = array($_POST['cat_name'],$_POST['cat_desc'],$_POST['cat_parent']);
			$selecPreparee->execute($tableauArgs);
		}
		else {
			$selecPreparee = $pdo->prepare('INSERT INTO category(id_category, category_name, category_description, id_category_mother) values (NULL,?,?,NULL)');
			$tableauArgs = array($_POST['cat_name'],$_POST['cat_desc']);
			$selecPreparee->execute($tableauArgs);
		}
	}
	
	public function listeCategorie(){
		
		$pdo =& $this->pdodb->loadPDO();
		$pdo->query("set names UTF8");
		
		$req = $pdo->query('select * from category');
		return $req->fetchAll(PDO::FETCH_OBJ);
		
	}
	
	public function getCategorie($id){
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->prepare('SELECT * FROM category where id_category = ?');
		$selectPreparee->execute(array($id));
		if($selectPreparee->rowCount()==1){
            return $selectPreparee->fetch(PDO::FETCH_OBJ);
        }
        else {
            return false;
        }

	}
	
	public function modifierCategorie($id){
		echo $_POST['cat_parent'];
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->prepare('UPDATE category set category_name = ? , category_description = ? , id_category_mother = ? where id_category = ? '); 
		$tableauArgs = array($_POST['cat_name'],$_POST['cat_desc'],$_POST['cat_parent'],$id);
		$selectPreparee->execute($tableauArgs);
	}
	
	public function supprimerCategorie($id){
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->prepare('DELETE from category where id_category = ? '); 
		$tableauArgs = array($id);
		$selectPreparee->execute($tableauArgs);
	}

    public function getEnfant($idcategory){
        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('SELECT * FROM category where id_category_mother = ?');
        $tab = array($idcategory);
        $selectPreparee->execute($tab);
		$tab = $selectPreparee->fetchAll(PDO::FETCH_OBJ);

		
		foreach ($tab as $value){
			if($this->getNombreEnfant($value->id_category)>0){
				
			}
		}
		
        return $tab;
    }

    public function getNombreEnfant($idcategory){
        $pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->prepare('SELECT * FROM category where id_category_mother = ?');
        $tab = array($idcategory);
        $selectPreparee->execute($tab);
        return $selectPreparee->rowCount();
    }
	
	public function getAllCategoriesRacines(){
		$pdo =& $this->pdodb->loadPDO();
        $selectPreparee = $pdo->query('SELECT * FROM category WHERE id_category_mother IS NULL');
        return $selectPreparee->fetchAll(PDO::FETCH_OBJ);
	}



}


?>
