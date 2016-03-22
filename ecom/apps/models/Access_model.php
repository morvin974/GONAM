<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_model extends Model {

	public function readAll() {
		$pdo =& $this->pdodb->loadPDO();
		$query = $pdo->query('SELECT * FROM access ORDER BY page');
		return $query->fetchAll();
	}
	
	public function add($page, $level) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('INSERT INTO access (page, level) VALUES (?,?)');
		return $prep->execute(array($page, intval($level)));
	}
	
	public function del($page) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('DELETE FROM access WHERE page = ?');
		return $prep->execute(array($page));
	}
	
	public function isExists($page) {
		$pdo =& $this->pdodb->loadPDO();
		$prep = $pdo->prepare('SELECT COUNT(*) FROM access WHERE page = ?');
		$prep->execute(array($page));
		return ($prep->fetchColumn() > 0);
	}

}