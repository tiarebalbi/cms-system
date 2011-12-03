<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * Interactive_View_Helpers_Data helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Interactive_View_Helper_Data {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function data($data, $formato) {

		$locale = new Zend_Locale("pt_BR");
		$date = new Zend_Date($data, false, $locale);
		return $date->get($formato, $locale);
		
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
