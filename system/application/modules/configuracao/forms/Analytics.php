<?php

class Configuracao_Form_Analytics extends Zend_Form
{

	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
	
    	$id = new Zend_Form_Element_Hidden("id");
    	$id->addDecorators($this->_decorator);
    	
    	$login = new Zend_Form_Element_Text("login");
    	$login->addDecorators($this->_decorator)
    		  ->setAttrib("class", "small")
    		  ->setLabel("Usuário do Google Analytics:")
    		  ->setRequired();
    	
    	$senha = new Zend_Form_Element_Password("senha");
    	$senha->renderPassword = true;
    	$senha->setRequired()
    		  ->setLabel("Senha:")
    		  ->setAttrib("class", "small")
    		  ->addDecorators($this->_decorator);
    	
    	$profile = new Zend_Form_Element_Hidden("profile");
    	$profile->addDecorators($this->_decorator)
    		    ->setRequired()
    			->addValidator(new Zend_Validate_Db_NoRecordExists(array("table"=>"conf_analytics","field"=>"profile")));
    	
    	$submit = new Zend_Form_Element_Submit("submit");
    	$submit->setLabel("Consultar")
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
    	
    	$this->addElements(array($id, $login, $senha, $profile,$submit));
    }


}

