<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Auth library
 * @version 1.0
 */

class Auth {
	
	// Instance of framework
	private $TL;

	// Instance of pdo
	private $pdo;

	// Table in database that contains all users
	private $users_table;
	
	// Table in database that contains all groups
	private $groups_table;

	// Table in database that contains access
	private $access_table;
	
	// Column in user that contain user id
	private $uidColumn;

	// Access level of pages
	private $access_level = array();
	
	// Level of users
	private $users_level = array();

	// id of current user
	private $current_user = 0;

	// Constructor
	public function __construct() {
		$this->TL =& getInstance();
		$this->TL->config->load('auth', 'auth');

		// Set tables
		$this->users_table = $this->TL->config->get('users_table', 'auth');
		$this->groups_table = $this->TL->config->get('groups_table', 'auth');
		$this->access_table = $this->TL->config->get('access_table', 'auth');
		
		// Set columns
		$this->uidColumn = $this->TL->config->get('uid_column', 'auth');

		// Load session library if it's not loaded
		if ( ! $this->TL->load->isLoaded('session'))
			$this->TL->load->library('session');
		
		$this->TL->load->helper('auth');
		
		$this->pdo =& $this->TL->pdodb->loadPDO();
		$this->current_user = ($this->isLogin()) ? $this->TL->session->getItem('auth') : '0';
		$this->users_level['0'] = 0;
	}

	/**
	 * isLogin
	 * Check if client is connected and if is connected
	 * 
	 * @return bool
	 */
	public function isLogin() {
		if ($this->TL->session->getItem('auth') === '')
			return FALSE;

		if ( ! $this->hasUser($this->TL->session->getItem('auth'))) {
			$this->TL->session->delItem('auth');
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * hasUser
	 * Check if user exists in database
	 *
	 * @param int $userId
	 *		User id that you want to verify if exists in database.
	 * 
	 * @return bool
	 */
	public function hasUser($userId) {
		$prep = $this->pdo->prepare('SELECT COUNT(user_mail) FROM `' . $this->users_table . '` WHERE ' . $this->uidColumn . ' = ?');
		$prep->execute(array(intval($userId)));
		
		return (intval($prep->fetchColumn()) > 0);
	}
	
	/**
	 * authUser
	 * LogIn user with username and password
	 *
	 * @param string $username
	 *		Username of user
	 *
	 * @param string $pwd
	 * 		Password of user
	 *
	 * @return bool
	 */
	public function authUser($username, $pwd) {
		if ($this->isLogin()) {
			return FALSE;
		}
		
		$prep = $this->pdo->prepare('SELECT id_user as id, user_firstname, user_password FROM `' . $this->users_table . '` WHERE user_mail = ?');
		$prep->execute(array($username));

		if ($prep->rowCount() > 0) {
			$result = $prep->fetch();
			if ($result['user_password'] === $this->hashPassword($pwd)) {
				$this->TL->session->setItem('auth', $result['id']);
				$this->TL->session->setItem('user', htmlentities($result['user_firstname']));
				$this->current_user = $result['id'];
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * unAuth
	 * LogOut user
	 *
	 * @return bool
	 */
	public function unAuth() {
		if ( ! $this->isLogin())
			return FALSE;
		
		$this->TL->session->delItem('auth');
		$this->TL->session->delItem('user');
		return TRUE;
	}

	/**
	 * getCurrentId
	 * Return id of current connected user
	 *
	 * @return int
	 */
	public function getCurrentId() {
		return $this->current_user;
	}
	
	/**
	 * getUserLevel
	 * Get level of user and set class vars.
	 * 
	 * @param int $userId
	 *		User id
	 * 
	 * @return int
	 */
	public function getUserLevel($userId) {
		$intId = intval($userId);
		
		if (isset($this->users_level[$userId]))
			return $this->users_level[$userId];
		
		if ($this->hasUser($intId)) {
			$prep = $this->pdo->prepare('SELECT DISTINCT group_privileges FROM `' . $this->users_table
					. '` NATURAL JOIN `' . $this->groups_table . '` WHERE ' . $this->uidColumn . ' = ?');
			$prep->execute(array($intId));
			$result = $prep->fetch();
			$this->users_level[$userId] = $result['group_privileges'];
		}
		else {
			$this->users_level[$userId] = 0;
		}
		
		return $this->users_level[$userId];
	}
	
	/**
	 * hasLevel
	 * Verify if user has required level
	 * 
	 * @param int $userId
	 *		User Id
	 * 
	 * @param type $level
	 *		Level that you want to compare at user level
	 * 
	 * @return bool
	 */
	public function hasLevel($userId, $level) {
		$userLevel = $this->getUserLevel($userId);
		return ($this->users_level[$userId] >= $level);
	}
	
	/**
	 * getAccessLevel
	 * Get minimun access level for a page
	 * 
	 * @param string $module
	 *		Module that you want to get access level
	 * 
	 * @param string $method
	 *		Method that you want to get access level
	 * 
	 * @return int
	 */
	public function getAccessLevel($controller, $method = '') {
		$concat = ($method === '') ? $controller : $controller . '/' . $method;
		
		if (isset($this->access_level[$concat]))
			return $this->access_level[$concat];
		
		$cfgLevel = $this->TL->config->get('level', 'auth');
		$level = 0;
		
		if (is_array($cfgLevel) && isset($cfgLevel[$controller]))
			$level = $cfgLevel[$controller];
		
		if ($concat !== $controller && isset($cfgLevel[$concat]))
				$level = $cfgLevel[$concat];
		
		$prep = $this->pdo->prepare('SELECT level FROM ' . $this->access_table . ' WHERE '
				. 'page = ? OR page = ?');
		$prep->execute(array($controller, $concat));
		
		while ($data = $prep->fetch(PDO::FETCH_OBJ)) {
			if ($data->level > $level)
					$level = $data->level;
		}
		
		$this->access_level[$concat] = $level;
		return $level;
	}
	
	/**
	 * hasPassword
	 * Hash string in parameter
	 * 
	 * @param string $in
	 *		String to be crypt
	 * 
	 * @return string
	 */
	public function hashPassword($in) {
		$secretKey = $this->TL->config->get('secretKey');
		if (strlen($secretKey) > strlen($in))
			$pwd = sha1(substr($secretKey, -(strlen($in))) . $in);
		else
			$pwd = sha1($secretKey . $in);
		
		return $pwd;
	}

}

/* End of file Auth.php */
/*- Location : ./system/librairies/Auth.php */