<?php

class Webmail_IndexController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    	
    	$cpanel = new Interactive_Api_Cpanel("hostc4.com.br");
    	$cpanel->password_auth("rs36315", "481200");
    	$cpanel->set_output("json");
    	
    	$cpanel->set_debug(1);
    	
    	$info = $cpanel->api2_query("rs36315", "Email", "listpopswithdisk");
    	
    	$dados = Zend_Json::decode($info);
    }

    public function listarAction()
    {
        // action body
    }

    public function senhaAction()
    {
        // action body
    }


}





