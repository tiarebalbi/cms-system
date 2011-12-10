<?php

class Default_Form_Imagem extends Zend_Form
{

	private $_decorator = array('ViewHelper','Description','Errors');
	
    public function init()
    {
    	
    	$imagem = new  Zend_Form_Element_File("foto");
    	$imagem->setDestination("../public/upload/profile/tmp/");
    	$imagem->setMaxFileSize(2048000); // 2MB
    	$imagem->setRequired()
    		   ->addFilter(new Zend_Filter_File_Rename(array('overwrite' => true, "target"=>"../public/upload/profile/file_".date("dmyHis").".jpg")))
    		   ->addValidator('Extension', false, 'jpg')
    		   ->addValidator('Size', false, 2048000)
    		   ->setLabel("Imagem:");
    	
        $submit = new Zend_Form_Element_Submit("submit");
    	$submit->setLabel("Enviar")
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
    	
    	$this->setAttrib('enctype', 'multipart/form-data');
    	
    	$this->addElements(array($imagem, $submit));
    }


}

