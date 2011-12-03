<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * AvgTimeSite helper
 *
 * @uses viewHelper Interactive_View_Helper
 */
class Interactive_View_Helper_AvgTimeSite {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function avgTimeSite($tempo, $visitas) {
		$tempo = $tempo->value;
		$visitas = $visitas->value;
		
		$resultado = $tempo / $visitas;
		
		if($resultado < 60){
			return $resultado . " segundo(s)";
		}elseif($resultado < 3600){
			$resultado = number_format($resultado/60, 2, '.', ' ');
			return $resultado . " minuto(s)";
		}else{
			$resultado = number_format($resultado/60/60, 2, '.', ' ');
			return $resultado . " hora(s)";
		}
		
		return $resultado;
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
