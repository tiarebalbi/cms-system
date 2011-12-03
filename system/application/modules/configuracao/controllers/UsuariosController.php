<?php

class Configuracao_UsuariosController extends Zend_Controller_Action
{

    public function init()
    {
    }

	public function indexAction()
    {
    	$this->view->headTitle()->append("Usuários");
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
    	$consulta = new Configuracao_Model_UsuariosMapper();
    	$this->view->resultado = $consulta->consultaTabela();

    }

    public function cadastrarAction()
    {
    	$this->view->headTitle()->append("Novo Registro");
    	
    	$this->view->headScript()->prependFile($this->view->baseUrl("js/library/mask/jquery.mask.js"),'text/javascript');
    	$this->view->headScript()->prependFile($this->view->baseUrl("js/library/password_strength/digitialspaghetti.password.min.js"),'text/javascript');
    	
    	$form = new Configuracao_Form_Usuarios();
    	$this->view->form = $form;
    	
    	if($this->getRequest()->isPost()){
    		
    		$data = $this->getRequest()->getPost();
    		
    		if($form->isValid($data)){
    			
    			$form->senha->setValue(sha1($data["senha"].$data["salt"]));
    			$novaData = $this->_helper->data->converte($data["nascimento"], "yyyy-MM-dd");
    			$form->nascimento->setValue($novaData);
    			
    			try {
    				$objeto = new Configuracao_Model_Usuarios($form->getValues());
    				$mapa = new Configuracao_Model_UsuariosMapper();
    				$mapa->salvar($objeto);

    				$this->_helper->flashMessenger->addMessage("Cadastro Realizado com Sucesso");
    				$this->_helper->redirector("index","usuarios","configuracao");
    				
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
    	$this->view->headScript()->prependFile($this->view->baseUrl("js/library/mask/jquery.mask.js"),'text/javascript');
    	$this->view->headScript()->prependFile($this->view->baseUrl("js/library/password_strength/digitialspaghetti.password.min.js"),'text/javascript');

    	$id = $this->_request->getParam("id");
    	
    	$form = new Configuracao_Form_Usuarios();
    	$this->view->form = $form;
    	
    	$mapa = new Configuracao_Model_UsuariosMapper();
    	$sub = $info = $mapa->consultaLinha(array("id = ?"=>$id));
    	
    	$info["nascimento"] = $this->_helper->data->converte($info["nascimento"], "dd/MM/yyyy");
    	
    	$info["senha"] = "";
    	
    	$form->populate($info);
    	
    	if($this->getRequest()->isPost()){
    	
    		$data = $this->getRequest()->getPost();
    	
    		if($info["email"] == $data["email"]){
    			$form->email->removeValidator("Zend_Validate_Db_NoRecordExists");
    		}
    		if($info["login"] == $data["login"]){
    			$form->login->removeValidator("Zend_Validate_Db_NoRecordExists");
    		}
    		
    		if(empty($data["senha"]) && empty($data["confirmacao"])){
    			$form->senha->setRequired(false);
    			$form->confirmacao->setRequired(false);
    		}
    		
    		if($form->isValid($data)){
    			
    			if(empty($data["senha"]) && empty($data["confirmacao"])){
    				$form->senha->setValue($sub["senha"]);
    			}else{
    				$form->senha->setValue(sha1($data["senha"].$data["salt"]));
    			}
    			
    			$novaData = $this->_helper->data->converte($data["nascimento"], "yyyy-MM-dd");
    			
    			$form->nascimento->setValue($novaData);
    			
    			try {
    				$objeto = new Configuracao_Model_Usuarios($form->getValues());
    				$mapa = new Configuracao_Model_UsuariosMapper();
    				$mapa->salvar($objeto);
    	
    				$this->_helper->flashMessenger->addMessage("Cadastro Atualizado com Sucesso");
    				$this->_helper->redirector("index","usuarios","configuracao");
    	
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
    	
    	$mapa = new Configuracao_Model_UsuariosMapper();
    	$this->view->info = $mapa->consultaLinha(array("id = ?"=>$id));
    	
    	$request = $this->_request->getParam("checked");
    	
    	if(isset($request) && $request == true){
    		$mapa->excluir(array("id = ?"=>$id));
    		$this->_helper->flashMessenger->addMessage("Cadastro Excluído com Sucesso");
    		$this->_helper->redirector("index","usuarios","configuracao");
    	}
    }
}