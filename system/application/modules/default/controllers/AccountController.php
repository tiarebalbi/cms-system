<?php

class Default_AccountController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
		$this->view->headTitle()->append("Minha Conta");
		
		$dados = new Configuracao_Model_UsuariosMapper();
		$this->view->informacoes = $info =$dados->consultaLinha(array("id = ?"=>1));
    	
    }

}



