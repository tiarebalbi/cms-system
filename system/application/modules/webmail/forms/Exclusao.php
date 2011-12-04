<?php

class Webmail_Form_Exclusao extends Zend_Form
{

	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
    	$chave = new Zend_Form_Element_Text("chave");
    	$chave->addDecorators($this->_decorator)
    		  ->setLabel("Chave de Segurança:")
    		  ->setRequired()
    		  ->addErrorMessage("Preencha uma chave de segurança válida.")
    		  ->addValidator(new Zend_Validate_Db_RecordExists(array(
			        'table' => 'conf_usuarios',
			        'field' => 'salt'
			    )))
    	;
    	//TODO Fazer validação pelo usuário logado usando o exclude
    	
    	$submit = new Zend_Form_Element_Submit("submit");
    	$submit->setLabel("Sim, confirmo a exclusão")
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
    	
    	$this->addElements(array($chave, $submit));
    	
    }


}

