<?php

class Interactive_Plugins_Install_Connection extends Zend_Controller_Plugin_Abstract {
	
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		if(file_exists(APPLICATION_PATH . '/configs/database.xml')){
			
			$db = new Interactive_Install_Database();
			if(!$db->connect()){
				throw new Exception($db->getErro());
			}
			
		}
	}
}