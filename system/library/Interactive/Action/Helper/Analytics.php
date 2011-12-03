<?php
/**
 *
 * @author tiare
 * @version 
 */
/**
 * Analytics Action Helper 
 * 
 * @uses actionHelper Interactive_Action_Helper
 */
class Interactive_Action_Helper_Analytics extends Zend_Controller_Action_Helper_Abstract {
	/**
	 * @var Zend_Loader_PluginLoader
	 */
	public $pluginLoader;
	
	/**
	 * Constructor: initialize plugin loader
	 * 
	 * @return void
	 */
	public function __construct() {
		// TODO Auto-generated Constructor
		$this->pluginLoader = new Zend_Loader_PluginLoader ();
	}
	
	/**
	 * Strategy pattern: call helper as broker method
	 */
	public function direct() {
	}
	
	public function feedResumeGlobal($client, $profile, $inicio, $fim)
	{
		$service = new Zend_Gdata_Analytics($client);
		
		$query = $service->newDataQuery()
						->setProfileId($profile)
						->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_VISITS)
						->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_NEW_VISITS)
						->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_PAGEVIEWS)
						->setStartDate($inicio)
						->setEndDate($fim)
						->setSort(Zend_Gdata_Analytics_DataQuery::METRIC_VISITS)
		;
		
		$result = $service->getDataFeed($query);
		
		$info = array();
		
		foreach($result as $row){
			$info["visits"] = $row->getMetric('ga:visits');
			$info["newVisits"] = $row->getMetric('ga:newVisits');
			$info["pageviews"] = $row->getMetric('ga:pageviews');
		}
		
		return $info;		
		
	}
	
	public function getResumeGlobal($client, $profile)
	{
		$gaResult = array();
		
		for($i = 1; $i<=date("m");$i++){
		
			$mes = ($i < 10 ? "0".$i : $i);
			
			$ultimoDia = date('d',strtotime('-1 second',strtotime('+1 month',strtotime($mes.'/01/'.date('Y').' 00:00:00'))));
			
			$inicio = date("Y")."-".$mes."-01";
		
			$fim = date("Y")."-".$mes."-".$ultimoDia;
			
			if($mes == date("m")){
				$gaResult[$mes] = $this->feedResumeGlobal($client, $profile, $inicio, $fim);
			}else{
				
				$global = new Estatisticas_Model_EstatisticaGlobalResumeMapper();
				$result = $global->consultaLinha(array("mes = ?"=>$mes, "profile = ?"=>$profile));
				
				if(empty($result["visitas"])){
					
					$gaResult[$mes] = $this->feedResumeGlobal($client, $profile, $inicio, $fim);
					
					$objeto = new Estatisticas_Model_EstatisticaGlobalResume();
					$objeto->setAno(date("Y"));
					$objeto->setMes($mes);
					$objeto->setNovas($gaResult[$mes]["newVisits"]);
					$objeto->setPageview($gaResult[$mes]["pageviews"]);
					$objeto->setVisitas($gaResult[$mes]["visits"]);
					$objeto->setProfile($profile);
					
					$global->salvar($objeto);
					
					
				}else{

					$gaResult[$mes]["visits"] = $result["visitas"];
					$gaResult[$mes]["newVisits"] = $result["novas"];
					$gaResult[$mes]["pageviews"] = $result["pageview"];
				}
				
			}
			
		}
		
		return $gaResult;
	}
	
	
	public function getSiteUsage($client, $profile)
	{
		$service = new Zend_Gdata_Analytics($client);
	
		//Configuração do Periodo
		$mes = date("m");
		$ultimoDia = date('d',strtotime('-1 second',strtotime('+1 month',strtotime($mes.'/01/'.date('Y').' 00:00:00'))));
		$inicio = date("Y")."-".$mes."-01";
		$fim = date("Y")."-".$mes."-".$ultimoDia;
		
		//Consulta
		$query = $service->newDataQuery()
		->setProfileId($profile)
		->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_VISITS)
		->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_NEW_VISITS)
		->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_PAGEVIEWS)
		->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_TIME_ON_SITE)
		->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_TIME_ON_PAGE)
		->setStartDate($inicio)
		->setEndDate($fim)
		;
	
		$result = $service->getDataFeed($query);
	
		$info = array();
	
		foreach($result as $row){
			$info["visits"] = $row->getMetric('ga:visits');
			$info["newVisits"] = $row->getMetric('ga:newVisits');
			$info["pageviews"] = $row->getMetric('ga:pageviews');
			$info["timeSite"] = $row->getMetric('ga:timeOnSite');
			$info["timePage"] = $row->getMetric('ga:timeOnPage');
			$info["newVisits"] = $row->getMetric('ga:newVisits');
		}
	
		return $info;
	
	}
	
	public function getRegiaoMensal($client, $profile)
	{
		$service = new Zend_Gdata_Analytics($client);
		
		//Configuração do Periodo
		$mes = date("m");
		$ultimoDia = date('d',strtotime('-1 second',strtotime('+1 month',strtotime($mes.'/01/'.date('Y').' 00:00:00'))));
		$inicio = date("Y")."-".$mes."-01";
		$fim = date("Y")."-".$mes."-".$ultimoDia;
		
		//Consulta
		$query = $service->newDataQuery()
						 ->setProfileId($profile)
						 ->addDimension(Zend_Gdata_Analytics_DataQuery::DIMENSION_COUNTRY)
						 ->addMetric(Zend_Gdata_Analytics_DataQuery::METRIC_VISITS)
						 ->setStartDate($inicio)
						 ->setEndDate($fim)
						 ->setMaxResults(20);
		
		$result = $service->getDataFeed($query);
		
		$info = array();
		$i = 0;
		foreach($result as $row){
			$info[$i]["country"] = $row->getDimension('ga:country');
			$info[$i]["visits"] = $row->getMetric('ga:visits');
			$i++;
		}
		
		return $info;
	}
}
