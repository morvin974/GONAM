<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Language library
 * @version 1.0
 */
 
class Lang {

	// Localization directory
	private $langDir;
	
	// List of loaded localization files
	private $isLoaded = array();
	
	// List of translation
	private $translation = array();
	
	// Current localization
	private $currentLang;
	
	// Constructor
	public function __construct() {
		$config =& getConfig();
		$this->langDir = APPPATH . 'langs/';
		
		$this->setLang($config['localization']);
		$this->load('system');
	}
	
	// ------------------------------------------
	
	/**
	 * load
	 * Load localization file. Localization file must be in lang directory.
	 * 
	 * @param string $file
	 *		Name of localization file that will be loaded (without .php)
	 *
	 * @param string $language
	 *		Language name (english, french ...). If any language name is
	 *		specified we take the $this->currentLang. (optional)
	 *
	 * @return bool
	 */
	public function load($file, $language = '') {
		$filename = clearPath($file) . '.lang.php';
		$language = ($language === '') ? $this->currentLang : clearPath($language);
		
		if (file_exists($this->langDir . $language . '/' . $filename)) {
			include($this->langDir . $language . '/' . $filename);
			
			if ( ! isset($lang) || ! is_array($lang))
				return FALSE;
			
			$this->isLoaded[$language][] = $file;
			$this->translation = array_merge($this->translation, $lang);
			return TRUE;
		}
		else {
			// showError('Unable to load the requested language file : ' . $this->langDir . $language . '/' . $filename);
			return FALSE;
		}
	}
	
	/**
	 * setLang
	 * Change the current language.
	 *
	 * @param string $localization
	 *		New current localization
	 *
	 * @return bool
	 */
	public function setLang($localization) {
		$localization = clearPath($localization);
		
		if ( ! is_dir($this->langDir . $localization))
			return FALSE;
			
		// If localization exists, we try to load new languages files
		if (isset($this->isLoaded[$this->currentLang])) {
			foreach ($file as $this->isLoaded[$this->currentLang]) {
				$this->load($file, $localization);
			}
		}
		
		$this->currentLang = $localization;
	}
	
	/**
	 * line
	 * Fetch a single line of text from translation list.
	 *
	 * @param string $line
	 *		Line that you want to fetch.
	 *
	 * @return string
	 */
	public function line($line) {
		$out = (isset($this->translation[$line])) ? $this->translation[$line] : '';
		return $out;
	}
	
}

/* End of file Lang.php */
/* Location : ./system/libraries/Lang.php */