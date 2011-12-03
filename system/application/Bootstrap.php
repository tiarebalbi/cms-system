<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initApplication()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace(array('Interactive_'));
	}
	
	
	protected function _initPlaceHorder()
	{
		$this->bootstrap("view");
		$view = $this->getResource("view");
		$view->doctype("HTML5");
		
		$view->headTitle()->setSeparator(" > ")->append("Interactive System");
		$view->headScript()->appendFile($view->baseUrl("js/library/tiptip/jquery.tipTip.minified.js"),'text/javascript');
		$view->headScript()->appendFile($view->baseUrl("js/library/dataTables/jquery.dataTables.min.js"),'text/javascript');
		$view->headScript()->appendFile($view->baseUrl("js/loader/default.js"),'text/javascript');
		
		$view->headLink()->appendStylesheet($view->baseUrl("css/default.css"));
		$view->headLink()->appendStylesheet($view->baseUrl("js/library/tiptip/tipTip.css"));
	}
	
	protected function _initNavigation()
	{
		$this->bootstrap("layout");
		$layout  = $this->getResource("layout");
		$view = $layout->getView();

		$config = new Zend_Config_Xml(APPLICATION_PATH . "/configs/navigation.xml", "nav");
		
		$nav = new Zend_Navigation($config);
		$view->navigation($nav);
		
	}
	
	protected function _initRoutes()
	{
		$this->bootstrap('FrontController');
		$this->_frontController = $this->getResource('FrontController');
		$router = $this->_frontController->getRouter();

		$router->addRoute('default',
				new Zend_Controller_Router_Route(
						':module/:controller/:action/*',
						array( 'module'=>"default",'controller'=>'index',"action"=>"index")
				)
		);		
	}
	
	protected function _initPlugins()
	{
		$this->bootstrap("view");
		$view = $this->getResource("view");
		
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new Interactive_Plugins_Loader_Javascript($view));
		$front->registerPlugin(new Interactive_Plugins_Install_Connection());
		
		$view->addHelperPath('Interactive/View/Helper/', 'Interactive_View_Helper');
		Zend_Controller_Action_HelperBroker::addPrefix('Interactive_Action_Helper');
		
	}
	
	
}

