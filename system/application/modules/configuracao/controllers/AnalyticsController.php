<?php

class Configuracao_AnalyticsController extends Zend_Controller_Action
{

	public function indexAction()
    {
    	$this->view->headTitle()->append("Google Analytics");
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
    	$consulta = new Configuracao_Model_AnalyticsMapper();
    	$this->view->resultado = $resultado = $consulta->consultaTabela();
    	
    }

    public function configuracaoAction()
    {
    	$this->view->headTitle()->append("Novo Registro");
    	
    	$form = new Configuracao_Form_Analytics();
    	$this->view->form = $form;
    	
    	$mapa = new Configuracao_Model_AnalyticsMapper();
    	$result = $mapa->consultaTabela();
    	
    	$dados = array();
    	
    	foreach ($result as $item){
    		 $dados["login"] = $item->login;
    		 $dados["senha"] = $item->senha;
    	}
    	
    	$form->populate($dados);
    	
    	if($this->getRequest()->isPost()){

    		$data = $this->getRequest()->getPost();

    		$form->populate($data);
    		
    		try {
    			
    			
    			$client = Zend_Gdata_ClientLogin::getHttpClient($data["login"], $data["senha"], Zend_Gdata_Analytics::AUTH_SERVICE_NAME);
    			$service = new Zend_Gdata_Analytics($client);
    			$accounts = $service->getAccountFeed();
    					
    			$this->view->resultado = $accounts;
    			$this->view->statusConsulta = true;
    			
    			foreach ($accounts as $valor){
    				
    				$info = array();
    				$info["login"] = $data["login"];
    				$info["senha"] = $data["senha"];
    				$info["profile"] = $valor->profileId;
    				$info["account"] = $valor->accountId;
    				$info["webProfile"] = $valor->webPropertyId;
    				$info["titulo"] = $valor->title;
    				$info["updated"] = date("Y-m-d H:i:s");
    				
    				$objeto = new Configuracao_Model_Analytics($info);
    				$mapa = new Configuracao_Model_AnalyticsMapper();
    				
    				$consulta = $mapa->consultaLinha(array("profile = ?"=>$valor->profileId));
    				
    				if(empty($consulta["login"])){
    					$mapa->salvar($objeto);
    				}
	    				
    				
    			}
    		} catch (Zend_Gdata_App_AuthException $ae) {
    			
    			$this->view->erroConsulta = 'Ocorreu um erro na autenticação: ' . $ae->getMessage() . "\n";
    			$this->view->statusConsulta = false;  
    			  			
    		} catch (Zend_Exception $ae) {
    			
    			$this->view->erroConsulta = 'Ocorreu um erro na autenticação: ' . $ae->getMessage() . "\n";
    			$this->view->statusConsulta = false;    			
    		}
    		
    		
    		
    	}
    	
    }

    public function salvarAction()
    {
    	$this->view->headTitle()->append("Alteração do Registro");
    	$profile = $this->_request->getParam("profile");
    	
    	$mapa = new Configuracao_Model_AnalyticsMapper();
    	$mapa->excluir(array("profile <> ?"=>$profile));
 
    	$this->_helper->flashMessenger->addMessage("Cadastro Atualizado com Sucesso");
    	$this->_helper->redirector("index","analytics","configuracao");
    	
    }


}