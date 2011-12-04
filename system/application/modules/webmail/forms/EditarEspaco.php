<?php

class Webmail_Form_EditarEspaco extends Zend_Form
{
	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
        $email = new Zend_Form_Element_Hidden("email");
        $email->setRequired();
        
        $dominio = new Zend_Form_Element_Hidden("dominio");
        $dominio->setRequired();
        
        $espaco = new Zend_Form_Element_Text("espaco");
        $espaco->setRequired()
        	  ->setLabel("Nova Espaço (MB):")
        	  ->addErrorMessage("Você deve escolher um valor entre 1 até 1000")
        	  ->addValidators(array(
        	  		new Zend_Validate_Int(),
        	  		new Zend_Validate_Between(array('min' => 1, 'max' => 1000))
        	  ))
        	  ->addDecorators($this->_decorator);
        
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Salvar")
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
        
        $this->addElements(array($espaco, $submit, $email, $dominio));
    }


}

