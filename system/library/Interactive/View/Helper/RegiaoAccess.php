<?php
/**
 *
 * @author tiare
 * @version 
 */
require_once 'Zend/View/Interface.php';

/**
 * RegiaoAccess helper
 *
 * @uses viewHelper Interactive_View_Helper
 */
class Interactive_View_Helper_RegiaoAccess {
	
	/**
	 * @var Zend_View_Interface 
	 */
	public $view;
	
	/**
	 * 
	 */
	public function regiaoAccess($dados) {
		
		$retorno = "";
		
		foreach($dados as $item=>$parametros){
			if(!empty($parametros["country"])){
				$retorno .= "['{$parametros["country"]}', {$parametros["visits"]}],";
			}
			
		}
		
		if(empty($retorno)){
			$retorno = "['Nenhum registro', 0],";
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
