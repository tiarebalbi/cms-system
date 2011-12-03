<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * GlobalResume helper
 *
 * @uses viewHelper Interactive_View_Helper
 */
class Interactive_View_Helper_GlobalResume {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function globalResume($dados, $item) {

		$retorno = "";
		
		foreach($dados as $mes=>$parametros){
			if(isset($parametros[$item])){
				$retorno .= $parametros[$item] . ",";
			}else{
				$retorno .= 0 . ",";
			}
		}
		$retorno = substr($retorno, 0,-1);
		
		return $retorno;
	}
	
	/**
	 * Sets the view field 
	 * @param $view Zend_View_Interface
	 */
	public function setView(Zend_View_Interface $view) {
		$this->view = $view;
	}
}
