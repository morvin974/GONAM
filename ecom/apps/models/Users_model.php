<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends Model {

	public function create($group, $email, $name, $firstname, $password, $birthday, $gender) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('INSERT INTO `user` (`id_group`,`user_mail`,`user_firstname`,`user_name`,`user_gender`,`user_password`,`user_birthday`) VALUES (?,?,?,?,?,?,?)');
		return $prep->execute(array($group, $email, $firstname, $name, $gender, $password, $birthday));
	}

	public function update($id, $group,  $name, $firstname, $birthday, $gender) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('UPDATE `user` SET user_firstname = ? AND user_gender = ? AND user_name = ? AND id_group = ? WHERE id_user = ?');
		return $prep->execute(array($firstname, $gender, $name, $group, intval($id)));
	}

	public function updatePwd($id, $password) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('UPDATE `user` SET user_password = ? WHERE id_user = ?');
		return $prep->execute(array($password, intval($id)));
	}

	public function readAll() {
		$pdo =& $this->pdodb->loadPDO();
		$query = $pdo->query('SELECT * FROM user');
		return $query->fetchAll();
	}

	public function readOrderLimit($by, $order = true, $start = -1, $limit = 50) {
		$pdo =& $this->pdodb->loadPDO();
		
		$query = 'SELECT * FROM user ORDER BY :by';
		$query .= ($order) ? ' ASC' : ' DESC';
		$query .= ($start >= 0) ? ' LIMIT :start,:limit' : ' LIMIT :limit';
		
		$req = $pdo->prepare($query);
		$req->bindValue(':by', $by, PDO::PARAM_STR);
		$req->bindValue(':start', $start, PDO::PARAM_INT);
		$req->bindValue(':limit', $limit, PDO::PARAM_INT);
		
		$req->execute();
		return $req->fetchAll();
	}

	public function readOneByField($field, $value) {
		$pdo =& $this->pdodb->loadPDO();
		
		$prep = $pdo->prepare('SELECT * FROM user WHERE ' . $field . ' = :value');
		$prep->execute(array('value' => $value));
		return $prep->fetch();
	}
	
	public function countByEmail($email) {
		$pdo =& $this->pdodb->loadPDO();
		$query = $pdo->prepare('SELECT COUNT(*) FROM user WHERE user_mail = ?');
		$query->execute(array($email));
		return intval($query->fetchColumn());
	}

	public function readByField($field, $value) {
		$pdo =& $this->pdodb->loadPDO();

		$prep = $pdo->prepare('SELECT * FROM user WHERE :field = :value');
		$prep->execute(array('field' => $field, 'value' => $value));
		return $prep->fetchAll();
	}

	public function countAll() {
		$pdo =& $this->pdodb->loadPDO();
		$query = $pdo->query('SELECT COUNT(*) FROM user');
		return intval($query->fetchColumn());
	}

	public function hasGroup($gid) {
		$pdo =& $this->pdodb->loadPDO();

		$prep = $pdo->prepare('SELECT COUNT(*) FROM user WHERE id_group = ?');
		$prep->execute(array(intval($gid)));
		return ($prep->fetchColumn() > 0);
	}
	
	public function hasUser($id) {
		$pdo =& $this->pdodb->loadPDO();
		
		$prep = $pdo->prepare('SELECT COUNT(*) FROM user WHERE id_user = ?');
		$prep->execute(array($id));
		return ($prep->fetchColumn() > 0);
	}

}
