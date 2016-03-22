<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Firm_model extends Model {

	public function creerfirm(){
		$pdo =& $this->pdodb->loadPDO() ;
		$selecPreparee = $pdo->prepare('INSERT INTO firm(firm_name,firm_description,firm_address,firm_city,firm_postcode,firm_phone,firm_fax,firm_mail) values (?,?,?,?,?,?,?,?)');
		$tableauArgs = array($_POST['firm_name'],$_POST['firm_desc'],$_POST['firm_adress'],$_POST['firm_city'],$_POST['firm_postcode'],$_POST['firm_phone'],$_POST['firm_fax'],$_POST['firm_mail']);
		$selecPreparee->execute($tableauArgs);
	}
	
	public function getAllfirm(){
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->query('SELECT * FROM firm');
		return  $selectPreparee->fetchall(PDO::FETCH_OBJ);
	}
	
	public function getfirm($id){
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->prepare('SELECT * FROM firm where id_firm = ?');
		$selectPreparee->execute(array($id));
		return  $selectPreparee->fetch(PDO::FETCH_OBJ);
	}
	
	public function modifierfirm($id){
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->prepare('UPDATE firm set firm_name = ?,firm_description = ?,firm_address = ?,firm_city = ?,firm_postcode = ?,firm_phone = ?,firm_fax = ?,firm_mail = ? where id_firm = ?'); 
		$tableauArgs = array($_POST['firm_name'],$_POST['firm_desc'],$_POST['firm_adress'],$_POST['firm_city'],$_POST['firm_postcode'],$_POST['firm_phone'],$_POST['firm_fax'],$_POST['firm_mail'],$id);
		$selectPreparee->execute($tableauArgs);
	}
	
	public function supprimerfirm($id){
		$pdo =& $this->pdodb->loadPDO();
		$selectPreparee = $pdo->prepare('DELETE FROM `firm` where id_firm = ? '); 
		$tableauArgs = array($id);
		$selectPreparee->execute($tableauArgs);

	}

}

