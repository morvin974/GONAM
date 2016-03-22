<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Auth configuration file
 * @version 1.0
 */

// ----------------------------------------------

$config = array();

/**
 * Database configuration
 * 
 * Tables minimals structures :
 * 
 * users[#id:int, ~group_id:int, username:varchar, password:varchar]
 * groups[#group_id:int, level:int]
 * access[#name:varchar, level:int]
 * 
 * Set names of users, groups and access tables in your database :
 */

$config['users_table'] = 'user';
$config['groups_table'] = 'group';
$config['access_table'] = 'access';

/**
 * Set name of user id column in your database :
 */

$config['uid_column'] = 'id_user';

/**
 * You can set minimal level for a page directly in this
 * file.
 * 
 * Example : $config['level']['example'] = 5;
 * Set minimal level for example module to 5.
 */
		
$config['level'] = array();

/* End of file auth.php */
/* Location : ./system/configs/auth.php */