<?php

class Configuracao_Form_Database extends Zend_Form implements Interactive_Form_Implements_Params
{

	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
		$id = new Zend_Form_Element_Hidden("id");
		
		$server = new Zend_Form_Element_Text("server");
		$server->addDecorators($this->_decorator)
			   ->setLabel("Servidor:")
			   ->addValidator(new Zend_Validate_NotEmpty())
			   ->setAttrib("class", "small");
		
		$dbname = new Zend_Form_Element_Text("dbname");
		$dbname->setRequired(true)
			   ->setLabel("Nome da Base de Dados:")
			   ->addDecorators($this->_decorator)
			   ->setAttrib("class", "small");
		
		$usuario = new Zend_Form_Element_Text("usuario");
		$usuario->setRequired()
				->setLabel("Usuário:")
				->addDecorators($this->_decorator)
				->setAttrib("class", "small");
		
		$senha = new Zend_Form_Element_Password("senha");
		$senha->setRequired()
			  ->setAttrib("class", "small")
			  ->setLabel("Senha:")
			  ->addDecorators($this->_decorator);

		$ssl = new Zend_Form_Element_Select("ssl");
		$ssl->options = array(false=>"Inativo",true=>"Ativo");
		$ssl->addDecorators($this->_decorator)
			->setAttrib("class", "bigsmall")
			->setLabel("SSL:")
			->setRequired();

		$submit = new Zend_Form_Element_Submit("submit");
		$submit->setLabel("Alterar")
			   ->setAttrib("class","button")
			   ->setDecorators(array(
		    		  		array('ViewHelper',array('tag'=>'span'))
				));
		
		$this->setDecorators(array(
				'FormElements',
				array('HtmlTag',array('tag'=>'div')),
				array('Form',array('class'=>'style'))
		));
		
		$this->addElements(array($server, $dbname, $usuario, $senha, $ssl, $id, $submit));
    }

}