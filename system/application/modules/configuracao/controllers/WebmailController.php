<?php

class Configuracao_WebmailController extends Zend_Controller_Action
{

    public function indexAction()
    {
    	$this->view->headTitle()->append("Webmail");
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
    	$consulta = new Configuracao_Model_WebmailMapper();
    	$this->view->resultado = $consulta->consultaTabela();

    }

    public function cadastrarAction()
    {
    	$this->view->headTitle()->append("Novo Registro");

    	$form = new Configuracao_Form_Webmail();
    	$this->view->form = $form;
    	
    	if($this->getRequest()->isPost()){
    		
    		$data = $this->getRequest()->getPost();
    		
    		if($form->isValid($data)){
    			
    			
    			try {
    				$objeto = new Configuracao_Model_Webmail($form->getValues());
    				$mapa = new Configuracao_Model_WebmailMapper();
    				$mapa->salvar($objeto);

    				$this->_helper->flashMessenger->addMessage("Cadastro Realizado com Sucesso");
    				$this->_helper->redirector("index","webmail","configuracao");
    				
    			} catch (Zend_Exception $e) {
    				
    				throw new Exception($e->getMessage());
    				
    			}
    			
    		}else{
    			$form->populate($data);
    		}
    	}
    }

    public function editarAction()
    {
    	$this->view->headTitle()->append("Alteração do Registro");
    	
    	$id = $this->_request->getParam("id");
    	
    	$form = new Configuracao_Form_Webmail();
    	$this->view->form = $form;
    	
    	$mapa = new Configuracao_Model_WebmailMapper();
    	$info = $mapa->consultaLinha(array("id = ?"=>$id));

    	$form->populate($info);
    	
    	if($this->getRequest()->isPost()){
    	
    		$data = $this->getRequest()->getPost();
    	
    		if($info["host"] == $data["host"]){
    			$form->host->removeValidator("Zend_Validate_Db_NoRecordExists");
    		}
    		
    		if($form->isValid($data)){
    	
    			try {
    				$objeto = new Configuracao_Model_Webmail($form->getValues());
    				$mapa = new Configuracao_Model_WebmailMapper();
    				$mapa->salvar($objeto);
    	
    				$this->_helper->flashMessenger->addMessage("Cadastro Atualizado com Sucesso");
    				$this->_helper->redirector("index","webmail","configuracao");
    	
    			} catch (Zend_Exception $e) {
    	
    				throw new Exception($e->getMessage());
    	
    			}
    	
    		}else{
    			$form->populate($data);
    		}
    	}
    }

    public function excluirAction()
    {
    	$this->view->headTitle()->append("Exclusão de Registro");
    	$id = $this->_request->getParam("id");
    	
    	$mapa = new Configuracao_Model_WebmailMapper();
    	$this->view->info = $mapa->consultaLinha(array("id = ?"=>$id));
    	
    	$request = $this->_request->getParam("checked");
    	
    	if(isset($request) && $request == true){
    		$mapa->excluir(array("id = ?"=>$id));
    		$this->_helper->flashMessenger->addMessage("Cadastro Excluído com Sucesso");
    		$this->_helper->redirector("index","webmail","configuracao");
    	}
    }
}
