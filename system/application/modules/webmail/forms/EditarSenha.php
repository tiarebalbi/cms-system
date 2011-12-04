<?php

class Webmail_Form_EditarSenha extends Zend_Form
{
	
	private $_decorator = array('ViewHelper','Description','Errors');

    public function init()
    {
        $email = new Zend_Form_Element_Hidden("email");
        $email->setRequired();
        
        $dominio = new Zend_Form_Element_Hidden("dominio");
        $dominio->setRequired();
        
        $senha = new Zend_Form_Element_Password("senha");
        $senha->setRenderPassword(true);
        $senha->setRequired()
        	  ->setLabel("Nova Senha:")
        	  ->addErrorMessage("Sua senha deve ter entre 6 à 12 caracteres")
        	  ->addValidators(array(
        	  		new Zend_Validate_StringLength(array("min"=>6,"max"=>12))
        	  ))
        	  ->addDecorators($this->_decorator);
        
        $confirmacao = new Zend_Form_Element_Password("confirmacao");
        $confirmacao->setRenderPassword(true);
        $confirmacao->setRequired()
		       ->setLabel("Confirme sua Senha:")
		       ->addDecorators($this->_decorator)
		       ->setAttrib("class", "small")
        	   ->addValidators(array(
        			new Zend_Validate_StringLength(array("min"=>6,"max"=>12)),
        			new Zend_Validate_Identical("senha"),
        			new Zend_Validate_NotEmpty()
        	    ));
        
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
        
        $this->addElements(array($senha, $confirmacao, $submit, $email, $dominio));
    }


}

