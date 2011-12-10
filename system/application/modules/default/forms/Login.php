<?php

class Default_Form_Login extends Zend_Form
{

	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
    	
    	$user = new Zend_Validate_Db_RecordExists(array("table"=>"conf_usuarios","field"=>"login"));
    	$user->setMessages(array(Zend_Validate_Db_Abstract::ERROR_NO_RECORD_FOUND => "Usuário '%value%' não existe"));
    	
    	
    	$empty = new Zend_Validate_NotEmpty();
    	$empty->setMessages(array(Zend_Validate_NotEmpty::IS_EMPTY=>"Campo obrigatório"));
    	
    	$login = new Zend_Form_Element_Text("login");
    	$login->addValidators(array($user, $empty))
    		  ->setAttrib("class", "large")
    		  ->setLabel("Usuário:")
    		  ->setRequired()
    		  ->addDecorators($this->_decorator);
    	
    	$senha = new Zend_Form_Element_Password("senha");
    	$senha->addValidators(array($empty))
    		  ->setRequired()
    		  ->setAttrib("class", "large")
    		  ->setLabel("Senha:")
    		  ->addDecorators($this->_decorator);
    	
    	
        $submit = new Zend_Form_Element_Submit("submit");
    	$submit->setLabel("Entrar")
		       ->setAttrib("class","button")
		        ->setDecorators(array(
		    			array('ViewHelper',array('tag'=>'span'))
		    	)
		);

    	$this->setDecorators(array(
    			'FormElements',
    			array('HtmlTag',array('tag'=>'div')),
    			array('Form',array('class'=>'style'))
    	));
    	
    	
    	$this->addElements(array($login, $senha, $submit));
    	
    }


}

