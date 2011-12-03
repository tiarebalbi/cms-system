<?php

class Configuracao_Form_Webmail extends Zend_Form implements Interactive_Form_Implements_Params 
{

	private $_decorator = array('ViewHelper','Description','Errors');
	
	public function init()
	{
		
		$id = new Zend_Form_Element_Hidden("id");
		$id->addDecorators($this->_decorator);
		
		$host = new Zend_Form_Element_Text("host");
		$host->setRequired()
			 ->addDecorators($this->_decorator)
			 ->setLabel("Servidor:")
			 ->setAttrib("class", "small")
			 ->addValidator(new Zend_Validate_Db_NoRecordExists(array("table"=>"conf_webmail","field"=>"host")));
		
		$usuario = new Zend_Form_Element_Text("usuario");
		$usuario->setRequired()
				->setLabel("Usuário")
				->setAttrib("class", "small")
				->addDecorators($this->_decorator);
		
		$senha = new Zend_Form_Element_Password("senha");
		$senha->setRequired()
			  ->setLabel("Senha:")
			  ->setAttrib("class", "small")
			  ->addDecorators($this->_decorator);
			  
		$porta = new Zend_Form_Element_Text("porta");
		$porta->setRequired()
			  ->setAttrib("class", "small")
			  ->setLabel("Porta:")
			  ->addValidator(new Zend_Validate_Int())
			  ->addDecorators($this->_decorator);
		
		$conta = new Zend_Form_Element_Text("conta");
		$conta->setRequired()
			  ->setLabel("Conta:")
			  ->setAttrib("class", "small")
			  ->addDecorators($this->_decorator);
		
		$submit = new Zend_Form_Element_Submit("submit");
		$submit->setLabel("Salvar")
			   ->setAttrib("class","button")
			   ->setDecorators(array(
		    		  		array('ViewHelper',array('tag'=>'span'))
				));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag',array('tag'=>'div')),
				array('Form',array('class'=>'style'))
		));
		
		$this->addElements(array($host, $usuario, $senha, $porta, $conta, $id, $submit));
		
		
	}
}

