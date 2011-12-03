<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * Teste helper
 *
 * @uses viewHelper Zend_View_Helper
 */
class Zend_View_Helper_Teste {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function teste() {
		return Zend_Controller_Front::getInstance()->getBaseUrl();
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
