<?php

class Estatisticas_IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->headScript()->prependFile($this->view->baseUrl("js/library/highcharts/highcharts.js"),'text/javascript');
    }

    public function indexAction()
    {
        $this->view->headTitle()->append("Relátorio de Acessos");
        
        $info = new Configuracao_Model_AnalyticsMapper();
        $resultado = $info->consultaLinha(array("profile IS NOT NULL"));

        try {
        
        	$client = Zend_Gdata_ClientLogin::getHttpClient($resultado["login"], $resultado["senha"], Zend_Gdata_Analytics::AUTH_SERVICE_NAME);
        
        	//Visão Global
			$grafico = $this->_helper->analytics->getResumeGlobal($client, $resultado["profile"]);
			$this->view->reportGlobalFeed = $grafico;
        	
			//Utilizacao do Site
			$this->view->reportSiteUsage = $adw = $this->_helper->analytics->getSiteUsage($client, $resultado["profile"]); 
			
			//Fonte do Tráfego
			$this->view->reportRegiaoAccess = $this->_helper->analytics->getRegiaoMensal($client, $resultado["profile"]);
			
			//Conteudo Acessado
			//ga:pageTitle
			
        } catch (Zend_Gdata_App_AuthException $e) {
        
        	//TODO mostra erro
        
        }
        
    }

}

