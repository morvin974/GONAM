<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends Model {

	public function create($name, $level) {
		$pdo =& $this->pdodb->loadPDO();
		
		$prep = $pdo->prepare('INSERT INTO `group` (group_name, group_privileges) VALUES (?, ?)');
		return $prep->execute(array($name, intval($level)));
	}

	public function update($id, $name, $level) {
		$pdo =& $this->pdodb->loadPDO();
		
		$prep = $pdo->prepare('UPDATE `group` SET group_name = ?, group_privileges = ? WHERE id_group = ?');
		return $prep->execute(array($name, intval($level), intval($id)));
	}

	public function delete($id) {
		$pdo =& $this->pdodb->loadPDO();
		
		$prep = $pdo->prepare('DELETE FROM `group` WHERE id_group = ?');
		return $prep->execute(array(intval($id)));
	}

	public function readAll() {
		$pdo =& $this->pdodb->loadPDO();

		$query = $pdo->query('SELECT * FROM `group`');
		return $query->fetchAll();
	}

	public function read($id) {
		$pdo =& $this->pdodb->loadPDO();

		$prep = $pdo->prepare('SELECT * FROM `group` WHERE id_group = ? LIMIT 0,1');
		$prep->execute(array(intval($id)));
		return $prep->fetch();
	}
	
	public function isExists($id) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('SELECT COUNT(*) FROM `group` WHERE id_group = ?');
		$prep->execute(array(intval($id)));
		return ($prep->fetchColumn() > 0);
	}
	
}
