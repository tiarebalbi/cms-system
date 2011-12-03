<?php

class Configuracao_DatabaseController extends Zend_Controller_Action
{

    public function init()
    {
    	
    }

    public function indexAction()
    {
        $this->view->headTitle()->append("Base de Dados");
        $db = new Interactive_Install_Database();
        $this->view->config = $config = $db->getConfig();
        
        
        $this->view->notificacao = $this->_helper->flashMessenger->getMessages();
        
        if($db->test($config->webhost, $config->database->params->username, $config->database->params->password, 
        		     $config->database->params->dbname, 'pdo_mysql')){
        	
        	$this->view->statusMsg = "Conexão Estabelecida com Sucesso";
        	$this->view->statusType = "note";
        	
        }else{
        	
        	$this->view->statusMsg = "Não foi possivel realizar uma conexão com o banco de dados.";
        	$this->view->statusType = "error";
        	
        }
        
    }

    public function editarAction()
    {
    	$this->view->headTitle()->append("Alteração de Cadastro");
    	
    	$form = new Configuracao_Form_Database();
    	$this->view->form = $form;
    	
    	$db = new Interactive_Install_Database();
    	$this->view->config = $config = $db->getConfig();
    	
    	$form->server->setValue($config->webhost);
    	$form->dbname->setValue($config->database->params->dbname);
    	$form->usuario->setValue($config->database->params->username);

    	if($this->getRequest()->isPost()){
    		
    		$data = $this->getRequest()->getPost();
    		
    		if($form->isValid($data)){
    			
    			if($db->test($data["server"], $data["usuario"], $data["senha"], $data["dbname"], "pdo_mysql")){
    				
    				$db->create($data["server"], $data["usuario"], $data["senha"], $data["dbname"], "pdo_mysql");
    				$db->install();
    				
    				$this->_helper->flashMessenger->addMessage("Informações Atualizadas com Sucesso!");
    				$this->_helper->redirector("index","database","configuracao");
    				
    			}else{
    				
    				$this->view->erroMsg = "Não foi possivel conectar ao banco com as informações abaixo.<br/>". $db->getErro();
    				
    			}
    			
    		}else{
    			
    			$form->populate($data);
    			
    		}
    	}
    	
    }


}



