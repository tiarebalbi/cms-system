<?php

class Webmail_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	
    	$mapa = new Configuracao_Model_WebmailMapper();
    	$info = $mapa->consultaLinha(array("id IS NOT NULL"));
    	
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





