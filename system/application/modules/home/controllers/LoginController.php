<?php

class Home_LoginController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->layout()->setLayout('login');
    }

    public function indexAction()
    {
    	$this->view->headTitle()->append("Login");
    	
    	$form = new Default_Form_Login();
    	$this->view->form = $form;
    	
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
        if($this->getRequest()->isPost()){
        	
        	$data = $this->getRequest()->getPost();
        	
	       	if($form->isValid($data)){
	       	
		       	$login = new Interactive_Security_Auth_Application();
		       	$login->setTabela("conf_usuarios");
		       	$login->setCampoUsuario("login");
		       	$login->setCampoSenha("senha");
		       	$login->setTratamento("SHA1(CONCAT(?,salt)) AND status = 1");
		       	$login->setInstancia("administrador");
		       	
		       	if($login->autenticar($form->getValue("login"), $form->getValue("senha"))){

		       		$modulo = $this->_request->getParam("module");
		       		$controller = $this->_request->getParam("controller");
		       		$action = $this->_request->getParam("action");
		       		
		       		if($modulo == "home" && $controller == "login"){
		       			$this->_helper->redirector("index","index","default");
		       		}else{
		       			$this->_helper->redirector($action,$controller, $modulo);
		       		}
		       		
		       	}else{
		       		$this->_helper->flashMessenger->addMessage(array("error"=>$login->getError()));
		       		$this->_helper->redirector("index","login","home");
		       	}
	       	
	       	}else{
	       		$form->populate($data);
	      	}
        }
    }

    public function logoutAction()
    {
    	$this->view->headTitle()->append("Logout");
    	
    	Interactive_Security_Auth_Manager::logout("administrador");
    	
    	$this->_helper->flashMessenger->addMessage(array("success"=>"Você foi desconectado com sucesso."));
    	
    	$this->_helper->redirector("index","login","home");
    }

    public function forgotAction()
    {
        $this->view->headTitle()->append("Lembrete de Senha");
    }


}


