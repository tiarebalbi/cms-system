<?php

final class Interactive_Security_Auth_Manager {


	/**
	 * Deleta a instancia criada para a autenticação
	 * @param string $instancia
	 * @return boolean 
	 */
	public static function logout($instancia = NULL){
		
		$auth = Zend_Auth::getInstance();
		
		if(!empty($instancia)){
			$auth->setStorage(new Zend_Auth_Storage_Session($instancia));
		}
		
		return $auth->clearIdentity();
	}
	
	/**
	 * Dados do usuário logado
	 * @param string $instancia
	 * @return array
	 */
	public static function getIdentity($instancia = NULL)
	{
		$auth = Zend_Auth::getInstance();
		
		if(!empty($instancia)){
			$auth->setStorage(new Zend_Auth_Storage_Session($instancia));
		}
		
		return $auth->getIdentity();
	}
	
	/**
	 * Realiza a verificação se o usuário esta logado ou não
	 * @param string $instancia
	 */
	public static function hasIdentity($instancia = NULL)
	{
		$auth = Zend_Auth::getInstance();
	
		if(!empty($instancia)){
			$auth->setStorage(new Zend_Auth_Storage_Session($instancia));
		}
	
		return $auth->hasIdentity();
	}
	
}

?>