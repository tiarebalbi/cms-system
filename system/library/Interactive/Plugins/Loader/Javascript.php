<?php

class Interactive_Plugins_Loader_Javascript extends Zend_Controller_Plugin_Abstract {
	
	/**
	 * Local onde fica armazenada a instancia do Zend_View podendo ter acesso a recursos da view
	 * @var Zend_View
	 */
	private $_view;
	
	/**
	 * Metodo construtor inicializando a varivel $_view;
	 * @param Zend_View $view
	 */
	public function __construct($view)
	{
		$this->_view = $view;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Zend_Controller_Plugin_Abstract::preDispatch()
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$this->autoLoaderFileAction();
		$this->autoLoaderFileControl();
		$this->autoLoaderFileModule();
	}
	
	/**
	 * Método para carregar dinamicamente o arquivo javascript do seu modulo caso ele exista
	 */
	public function autoLoaderFileModule()
	{
		$file  = "js/loader/";
		$file .= ucwords(strtolower(ucwords($this->_request->getModuleName())));
		$file .= ".js";
		
		if(file_exists("../public/".$file))
		{
			$this->_view->headScript()->appendFile($this->_view->baseUrl($file),'text/javascript');
		}	
		
	}
	
	/**
	 * Método para carregar dinamicamente o arquivo javascript do seu controller caso ele exista
	 */
	public function autoLoaderFileControl()
	{
		$file  = "js/loader/";
		$file .= ucwords(strtolower(trim($this->_request->getModuleName())));
		$file .= ucwords(strtolower(trim($this->_request->getControllerName())));
		$file .= ".js";
		
		if(file_exists("../public/".$file))
		{
			$this->_view->headScript()->appendFile($this->_view->baseUrl($file),'text/javascript');
		}
	}
	
	/**
	 * Método para carregar dinamicamente o arquivo javascript da sua action caso ela exista.
	 */
	public function autoLoaderFileAction()
	{
		$file  = "js/loader/";
		$file .= ucwords(strtolower(trim($this->_request->getModuleName())));
		$file .= ucwords(strtolower(trim($this->_request->getControllerName())));
		$file .= ucwords(strtolower(trim($this->_request->getActionName())));
		$file .= ".js";
		
		if(file_exists("../public/".$file))
		{
			$this->_view->headScript()->appendFile($this->_view->baseUrl($file),'text/javascript');
		}
	}
	
}