<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TimeLine MF
 * An open source PHP micro-framework based on CodeIgniter Framework.
 *
 * @licence		MIT
 * @author 		TimeLine Dev.
 * @copyright	Copyright (c) 2014, TimeLine MF.
 */
 
// ------------------------------------------------------------------------

/* ------------------------------------------------------
 *	Helpers
 * ------------------------------------------------------
 */
	$autoload['helpers'] = array('url','html');
	
/* ------------------------------------------------------
 *	Langs
 * ------------------------------------------------------
 */
	$autoload['langs'] = array();
	
/* ------------------------------------------------------
 *	Libraries
 * ------------------------------------------------------
 */
	$autoload['libraries'] = array('session', 'view', 'pdodb');
	
/* ------------------------------------------------------
 *	Models
 * ------------------------------------------------------
 */
	$autoload['models'] = array();
	
/* ------------------------------------------------------
 *	Hooks
 * ------------------------------------------------------
 */
	$autoload['hooks'] = array('AuthHook');
	
/* End of file : autoload.php */
/* Location : ./system/configs/autoload.php */
