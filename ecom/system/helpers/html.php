<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Html helper
 * @version 1.0
 */

if ( ! function_exists('countArticleInCart')) {
	function countArticleInCart() {
		$TL =& getInstance();
		if ( ! isset($TL->cartmng))
			$TL->load->model('Cart_model', 'cartmng');
		return $TL->cartmng->countArticleInCurrentCart();
	}
}

if ( ! function_exists('getRootCategories')) {
	
	function getRootCategories() {
		$TL =& getInstance();
		$TL->load->model('Categorie_model', 'catmng');
		return $TL->catmng->getAllCategoriesRacines();
		//return array(0 => array('category_name' => 'a'));
	}
	
}