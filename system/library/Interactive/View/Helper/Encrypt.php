<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * Encrypt helper
 *
 * @uses viewHelper Interactive_View_Helper
 */
class Interactive_View_Helper_Encrypt {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * @param string $valor
	 */
	public function encrypt($valor) {

		$dado = new Interactive_Filter_Encryption();
		$valorIni = $dado->encrypt($valor);
		
		return $valorIni;
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
