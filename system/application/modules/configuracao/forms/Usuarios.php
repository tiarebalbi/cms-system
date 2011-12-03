<?php

class Configuracao_Form_Usuarios extends Zend_Form
{
	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
        $id = new Zend_Form_Element_Hidden("id");
        $id->addDecorators($this->_decorator);
        
        $nome = new Zend_Form_Element_Text("nome");
        $nome->setLabel("Nome do Usuário:")
        	 ->setAttrib("class", "medium")
        	 ->addDecorators($this->_decorator)
        	 ->setRequired();
        
        $email = new Zend_Form_Element_Text("email");
        $email->setAttrib("class", "medium")
        	  ->setLabel("E-Mail:")
        	  ->setRequired()
        	  ->addDecorators($this->_decorator)
        	  ->addValidators(
        	  			array(
        	  					new Zend_Validate_Db_NoRecordExists(array("table"=>"conf_usuarios","field"=>"email")), 
        	  					new Zend_Validate_EmailAddress()
        	  			)
        	  );
        
        $login = new Zend_Form_Element_Text("login");
        $login->setRequired()
        	  ->setAttrib("class", "small")
        	  ->setLabel("Login:")
        	  ->addDecorators($this->_decorator)
        	  ->addValidator(new Zend_Validate_Db_NoRecordExists(array("table"=>"conf_usuarios","field"=>"login")));
        
        $senha = new Zend_Form_Element_Password("senha");
        $senha->renderPassword = true;
        $senha->setLabel("Senha:")
        	  ->setAttrib("class", "small pass_check")
        	  ->addDecorators($this->_decorator)
		      ->addErrorMessage("Sua senha deve ter entre 6 à 12 caracteres")
		      ->addValidators(array(
		        		new Zend_Validate_StringLength(array("min"=>6,"max"=>12))
		      ));
        
        $confirme = new Zend_Form_Element_Password("confirmacao");
        $confirme->renderPassword = TRUE;
        $confirme->addDecorators($this->_decorator)
       		     ->setRequired(true)
        		 ->setLabel("Confirmação da Senha:")
        		 ->setAttrib("class", "small")
        		 ->addValidators(array(
        			new Zend_Validate_StringLength(array("min"=>6,"max"=>12)),
        			new Zend_Validate_Identical("senha"),
        			new Zend_Validate_NotEmpty()
        		 ));
        
        $salt = new Zend_Form_Element_Hidden("salt");
        $salt->setRequired()
        	 ->setValue(sha1(md5(date("his").date("dmY"))));
        
        $hash = new Zend_Form_Element_Hidden("hash");
        $hash->addDecorators($this->_decorator);
        
        $nascimento = new Zend_Form_Element_Text("nascimento");
        $nascimento->setRequired()
        		   ->addDecorators($this->_decorator)
        		   ->setAttrib("class", "bigsmall dataNascimento")
        		   ->setLabel("Data de Nascimento:")
        		   ->addValidator(new Zend_Validate_Date(array('locale' => 'pt_BR')));
        
        $status = new Zend_Form_Element_Select("status");
        $status->options = array(true=>"Ativo",false=>"Inativo");
        $status->setRequired()
        	   ->addDecorators($this->_decorator)
        	   ->setAttrib("class", "bigsmall")
        	   ->setLabel("Status:");

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
        
        $this->addElements(array($nome, $email, $login, $senha, $confirme, $nascimento, $status, $id, $submit,  $salt, $hash));
        
    }


}

