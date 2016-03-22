<?php
/* ----------------------------------------------
 * Errors reporting
 * ----------------------------------------------
 */

	ini_set("display_errors", 1);
	error_reporting(E_ALL);
	
/* ----------------------------------------------
 * Sets contants
 * ----------------------------------------------
 */
	define('BASEPATH', './');
	define('SYSPATH', './system/');
	define('APPPATH', './apps/');
	
/* ----------------------------------------------
 * Load bootstrap
 * ----------------------------------------------
 */
 
	require_once SYSPATH . 'Core.php';
	
/* End of file index.php */
/* Location : ./index.php */
?>
