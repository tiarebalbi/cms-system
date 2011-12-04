<?php

class Webmail_IndexController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    	$this->view->headTitle()->append("Webmail");
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
    	$resultado = $this->_helper->cpanel->getContas();
    	
    	if(isset($resultado["data"]["result"])){
    		
    		$this->view->erro = $resultado["data"]["reason"] ." - Por favor contate o setor administrativo para análise do erro encontrado.";
    		$this->view->resultado = array();
    		
    	}else{
    		
    		$this->view->resultado = $resultado["cpanelresult"]["data"];
    		
    	}
    	
    }

    public function editarSenhaAction()
    {
        $this->view->headTitle()->append("Alteração de Senha do E-Mail");
        $email = $this->_request->getParam("id");
        $dominio = $this->_request->getParam("dominio");
        
        $form = new Webmail_Form_EditarSenha();
        $this->view->form = $form;
        $form->email->setValue($email);
        $form->dominio->setValue($dominio);
        
        if($this->getRequest()->isPost())
        {
        	$data = $this->getRequest()->getPost();
        	
        	if($form->isValid($data)){
        		
        		$confirmacao = $this->_helper->cpanel->editarSenhaConta($form->getValue("senha"), $form->getValue("email"), $form->getValue("dominio"));
        		
        		if($confirmacao["cpanelresult"]["data"][0]["result"] == 1){
        			$this->_helper->flashMessenger->addMessage("Senha Alterada com Sucesso.");
        			$this->_helper->redirector("index","index","webmail");
        		}else{
        			$this->view->erro = "Ocorreu um erro '{$confirmacao["cpanelresult"]["data"][0]["reason"]}'";
        		}
        		
        	}else{
    			$form->populate($data);
    		}
        }
        	
        
    }

    public function editarEspacoAction()
    {
    	$this->view->headTitle()->append("Alteração de Espaço do E-Mail");
    	$email = $this->_request->getParam("id");
    	$dominio = $this->_request->getParam("dominio");
    	
    	$form = new Webmail_Form_EditarEspaco();
    	$this->view->form = $form;
    	
    	$form->email->setValue($email);
    	$form->dominio->setValue($dominio);
    	
    	if($this->getRequest()->isPost()){
    		$data = $this->getRequest()->getPost();
    		
    		if($form->isValid($data)){
    			
    			$confirmacao = $this->_helper->cpanel->editarEspacoConta($form->getValue("espaco"), $form->getValue("email"), $form->getValue("dominio"));
    			
    			if($confirmacao["cpanelresult"]["data"][0]["result"] == 1){
    				$this->_helper->flashMessenger->addMessage("Espaço Alterada com Sucesso.");
    				$this->_helper->redirector("index","index","webmail");
    			}else{
    				$this->view->erro = "Ocorreu um erro '{$confirmacao["cpanelresult"]["data"][0]["reason"]}'";
    			}
    			
    		}else{
    			$form->populate($data);
    		}
    	
    	}
    }

    public function novoAction()
    {
    	$this->view->headTitle()->append("Nova Conta de E-Mail");
    	
    	$form = new Webmail_Form_NovaConta();
    	$this->view->form = $form;
    	
    	if($this->getRequest()->isPost()){
    		$data = $this->getRequest()->getPost();
    		
    		if($form->isValid($data)){
    			
				$confirmacao = $this->_helper->cpanel->criarConta($form->getValue("email"), $form->getValue("senha"), $form->getValue("espaco"));
				
				if($confirmacao["cpanelresult"]["data"][0]["result"] == 1){
					$this->_helper->flashMessenger->addMessage("Conta Criada com Sucesso.");
					$this->_helper->redirector("index","index","webmail");
				}else{
					$this->view->erro = "Ocorreu um erro '{$confirmacao["cpanelresult"]["data"][0]["reason"]}'";
				}
    			
    		}else{
    			$form->populate($data);
    		}
    	}
    }

    public function excluirAction()
    {
    	$this->view->headTitle()->append("Exclusão de Conta de E-Mail");
    	$this->view->usuario = $usuario = $this->_request->getParam("id");
    	$this->view->dominio = $dominio = $this->_helper->cpanel->getDominio();
    	
		$form = new Webmail_Form_Exclusao();
		$this->view->form = $form;

		if($this->getRequest()->isPost()){
			
			$data = $this->getRequest()->getPost();
			
			if($form->isValid($data)){
				
				$confirmacao = $this->_helper->cpanel->excluirConta($usuario);
				
				if($confirmacao["cpanelresult"]["data"][0]["result"] == 1){
					$this->_helper->flashMessenger->addMessage("Conta Excluída com Sucesso.");
					$this->_helper->redirector("index","index","webmail");
				}else{
					$this->view->erro = "Ocorreu um erro '{$confirmacao["cpanelresult"]["data"][0]["reason"]}'";
				}
				
			}else{
				$form->populate($data);
			}
			
		}
    	
    }


}





