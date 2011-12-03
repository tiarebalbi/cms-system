<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * MillisToMinute helper
 *
 * @uses viewHelper Interactive_View_Helper
 */
class Interactive_View_Helper_SecondToHour {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function secondToHour($tempo) {

		$tempo = (int)$tempo->value;
		
		$number = ($tempo/60/60);
		
		return number_format($number, 2, '.', ' ')  . " Hora(s)";
		
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
