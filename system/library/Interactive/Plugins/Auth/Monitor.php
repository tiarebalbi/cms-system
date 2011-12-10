<?php

class Interactive_Plugins_Auth_Monitor extends Zend_Controller_Plugin_Abstract {
	
	
	private $_instancia;
	
	public function __construct($instancia = NULL)
	{
		$this->_instancia = $instancia;
	}
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		
		$auth = Interactive_Security_Auth_Manager::hasIdentity($this->_instancia);
		
		if(!$auth){
			
			$request->setActionName("index")
			   		->setControllerName("login")
			   		->setModuleName("home");
		}
		
	}
}