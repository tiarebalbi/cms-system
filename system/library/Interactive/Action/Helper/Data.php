<?php
/**
 * Action para manipulação de datas
 * @author tiare
 * @version 1.0
 */

/**
 * Data Action Helper 
 * 
 * @uses actionHelper Interactive_Action_Helper
 */
class Interactive_Action_Helper_Data extends Zend_Controller_Action_Helper_Abstract {
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
		
		$this->pluginLoader = new Zend_Loader_PluginLoader ();
	}
	
	public function direct() {
		
	}
	
	/**
	 * Conversor de Datas
	 * @param date $data
	 * @param string $formato
	 */
	public function converte($data, $formato)
	{
		$locale = new Zend_Locale("pt_BR");
		$date = new Zend_Date($data, false, $locale);
		return $date->get($formato, $locale);
	}
	
	public function getLastDayMonth($month)
	{
		return date('d',strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.date('Y').' 00:00:00'))));
	}
}
